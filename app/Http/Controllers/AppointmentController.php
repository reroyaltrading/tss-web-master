<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
        
    public function appointments_index()
    {
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        return view('appointments.index', ['user' => Auth::user(), 'permission' => $permission, 'tab' => 'admin']);
    }

    public function ajax_appointments_list(Request $request)
    {

        $page = $request->input("page", 0);
        $items_per_page = $request->input("items_per_page", 10);

        $company_id = $request->input("company_id", 0);
        $hash_import = $request->input("hash_import", 0);

        $inferior_limit = $page * $items_per_page;
        $superior_limit = ($page * $items_per_page) + $items_per_page;

        $user_id = Auth::user()->id;
        
        $appointments = DB::SELECT("SELECT a.*, u.name as user_name FROM appointments a JOIN users u ON u.id=a.created_by
        WHERE created_by=? OR a.id IN (SELECT ccs.appointment_id FROM appointment_ccs ccs WHERE ccs.user_id=?) LIMIT ?,?;", [ $user_id, $user_id, $inferior_limit, $superior_limit]);
        $total_appointments = collect(DB::SELECT("SELECT count(*) as total FROM appointments a JOIN users u ON u.id=a.created_by
        WHERE created_by=? OR a.id IN (SELECT ccs.appointment_id FROM appointment_ccs ccs WHERE ccs.user_id=?)", [ $user_id, $user_id]))->first()->total;

        $total_pages = ceil($total_appointments / $items_per_page);

        $data = array('page' => $page, 'items_per_page' => $items_per_page,  'total_pages' => $total_pages,'appointments' => $appointments, 'inferior_limit' => $inferior_limit, 'superior_limit' => $superior_limit, 'total_appointments' => $total_appointments);
        return response()->json($data);
    }

    public function ajax_appointments_send(Request $request)
    {
        
        $name = $request->input('name');
        $description = $request->input('description');
        $content = $request->input('content');
        $param_email = $request->input('emails');
        $time = $request->input('time');
        $date = $request->input('date');
        $user_id = Auth::user()->id;

        $appointment_id = DB::table('appointments')->insertGetId(
            [ 'description' => $description, 'content' => $content, 'time' => $time, 'date' => $date, 'created_by' => $user_id]
        );

        $emails = explode(";", $param_email);

        $to_name = Auth::user()->name;
        $to_email = Auth::user()->email;

        $data = array('content' => $content);

        foreach ($emails as $email) {
            $user = collect(DB::SELECT("SELECT * FROM users u WHERE u.email='?'", [$email]))->first();
            if(!empty($user)){
                DB::table('appointment_ccs')->insertGetId(['appointment_id' => $appointment_id, 'user_id' => $user->id ]);
            }
        }

        try
        {
            \Mail::send('emails.common', $data, function($message) use ($to_name, $to_email, $name,$emails) {
                $message->to($to_email, $to_name)->subject($name);
                foreach ($emails as $email) {
                $message->cc($email);
                }
                $message->from('no-reply@blascke.com','TSS');
            });
            
        } catch (Exception $e) {
            return response()->json(array('send' => false, 'error' => $e->getMessage()));
        }

        return response()->json(array('send' => true, 'error' => false));
    }
}
