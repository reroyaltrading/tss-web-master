<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    
    public function nextcalls(Request $request)
    {
        $calls = DB::SELECT(" SELECT DISTINCT cn.*, c.name as client_name, ast.user_id, u.phone as user_phone, u.name as user_name,
        convert_dates_varchar(cn.date_to_call, cn.time_to_call) as datetime_call_varchar, TIMESTAMPDIFF(MINUTE, NOW(), convert_dates_timing(cn.date_to_call, cn.time_to_call)) as time_difference, 
        convert_dates_timing(cn.date_to_call, cn.time_to_call) as datetime_call FROM client_notes cn JOIN clients c ON c.id=cn.client_id JOIN asigned_tasks ast ON ast.hash_import=c.hash_import
        JOIN users u ON u.id=ast.user_id WHERE TIMESTAMPDIFF(MINUTE, NOW(), convert_dates_timing(cn.date_to_call, cn.time_to_call))  <= 30 AND cn.status_id=4
        AND TIMESTAMPDIFF(MINUTE, NOW(), convert_dates_timing(cn.date_to_call, cn.time_to_call))  != 0");
        return response()->json($calls);
    }

    public function appointments(Request $request)
    {
        $appointments = DB::SELECT("SELECT a.*, convert_dates_timing(a.date, a.time) as time_date FROM appointments a WHERE TIMESTAMPDIFF(MINUTE, NOW(), convert_dates_timing(a.date, a.time))  <= 30 AND
        TIMESTAMPDIFF(MINUTE, NOW(), convert_dates_timing(a.date, a.time))  > 0");

        return response()->json($appointments);
    }

    public function users_on_appointment(Request $request)
    {
        $id = $request->input('id');
        $users = DB::SELECT("SELECT u.name, u.id, u.email,u.phone FROM appointment_ccs ccs JOIN users u ON u.id=ccs.user_id WHERE ccs.appointment_id=?", [$id]);
        return response()->json($users);
    }
}
