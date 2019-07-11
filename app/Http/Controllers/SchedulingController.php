<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class SchedulingController extends Controller
{
    public function scheduling_index()
    {
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        return view('scheduling.index', ['permission' => $permission, 'user' => Auth::user(), 'tab' => 'home' ]);
    }

    public function ajax_get_schedulling()
    {
        $calls = DB::SELECT(" SELECT DISTINCT cn.*, c.name as client_name, ast.user_id, u.phone as user_phone, u.name as user_name,
        convert_dates_varchar(cn.date_to_call, cn.time_to_call) as datetime_call_varchar, TIMESTAMPDIFF(MINUTE, NOW(), convert_dates_timing(cn.date_to_call, cn.time_to_call)) as time_difference, 
        convert_dates_timing(cn.date_to_call, cn.time_to_call) as datetime_call FROM client_notes cn JOIN clients c ON c.id=cn.client_id JOIN asigned_tasks ast ON ast.hash_import=c.hash_import
        JOIN users u ON u.id=ast.user_id WHERE TIMESTAMPDIFF(MINUTE, NOW(), convert_dates_timing(cn.date_to_call, cn.time_to_call))  <= 1440 AND cn.status_id=4
        AND TIMESTAMPDIFF(MINUTE, NOW(), convert_dates_timing(cn.date_to_call, cn.time_to_call))  > 0");

        return response()->json($calls);
    }
}
