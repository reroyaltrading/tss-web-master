<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Redirect;
use App\User;
use Session;
use Jenssegers\Agent\Agent;
use App\Http\Helpers\LoginHelper;
use App\Exports;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function client_info($id)
    {
        $client = collect(DB::SELECT("SELECT * FROM clients c WHERE c.id=?", [$id]))->first();
        $notes = DB::SELECT("SELECT cn.*, c.name as client_name, u.name as user_name FROM client_notes cn JOIN clients c ON c.id=cn.client_id JOIN users u ON u.id=cn.created_by WHERE cn.client_id=?", [$id]);
        $messages = DB::SELECT("SELECT cm.*, u.name as user_name FROM client_messages cm JOIN users u ON u.id=cm.user_id WHERE cm.client_id=? ORDER BY cm.created_at DESC", [$id]);

        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        return view('client.info', ['client' => $client, 'notes' => $notes, 'messages' => $messages, 'user' => Auth::user(), 'permission' => $permission, 'tab' => 'admin']);
    }


    public function ajax_send_feedback(Request $request)
    {
        $description = $request->input("description");
        $count = $request->input("count");
        $client_id  = $request->input("client_id");
        $hash  = $request->input("hash_import");
        $user = Auth::user();

        $id = DB::table('client_feedbacks')->insertGetId(
            [ 'client_id' => $client_id, 'stars' => $count, 'description' => $description ]
        );

        $response = array('created' => true, 'id' => $id);
        return response()->json($response);
    }

    public function ajax_list_feedback(Request $request)
    {
        $feedbacks = DB::SELECT("SELECT * FROM client_feedbacks");
        return response()->json($feedbacks);
    }

    public function ajax_list_export(Request $request)
    {

        $company_id = $request->input("company_id", 0);
        $hash_import = $request->input("hash_import", 0);

        if($company_id > 0)
        {
            $clients = DB::SELECT("SELECT * FROM clients c WHERE c.company_id=? AND (hash_import=?  OR ? = 0)", [ $company_id, $hash_import]);
        }else{
            $clients = DB::SELECT("SELECT * FROM clients c");
        }

        $export = new \App\Exports\ClientsExport($clients);
    
        return \Excel::download($export, 'clients.xlsx');
    }

    public function ajax_list_clients(Request $request)
    {
        $page = $request->input("page", 0);
        $items_per_page = $request->input("items_per_page", 10);

        $company_id = $request->input("company_id", 0);
        $hash_import = $request->input("hash_import", 0);

        $inferior_limit = $page * $items_per_page;
        $superior_limit = ($page * $items_per_page) + $items_per_page;

        if($company_id > 0)
        {
            $clients = DB::SELECT("SELECT * FROM clients c WHERE c.company_id=? AND (hash_import=?  OR ? = 0) LIMIT ?,?;", [ $company_id, $hash_import, $hash_import, $inferior_limit, $superior_limit]);
            $total_clients = collect(DB::SELECT("SELECT count(*) as total FROM clients c WHERE c.company_id=? AND (hash_import=?  OR ? = 0)  LIMIT ?,?;", [ $company_id, $hash_import, $hash_import, $inferior_limit, $superior_limit]))->first()->total;
        }else{
            $clients = DB::SELECT("SELECT * FROM clients c  LIMIT ?,?;", [ $inferior_limit, $superior_limit]);
            $total_clients = collect(DB::SELECT("SELECT count(*) as total FROM clients c"))->first()->total;
            
        }

        $total_pages = ceil($total_clients / $items_per_page);


        $data = array('page' => $page, 'items_per_page' => $items_per_page,  'total_pages' => $total_pages,'clients' => $clients, 'inferior_limit' => $inferior_limit, 'superior_limit' => $superior_limit, 'total_clients' => $total_clients);
        return response()->json($data);
    }

    public function ajax_get_client(Request $request)
    {
        $id = $request->input('id');
        $client = collect(DB::SELECT("SELECT * FROM clients c WHERE c.id=?", [$id]))->first();
        return response()->json($client);
    }

    public function ajax_get_client_by_hash (Request $request)
    {
        $company_id = $request->input("id");
        $clients = DB::SELECT("SELECT * FROM clients c WHERE c.company_id=? AND is_locked = 0 ORDER BY c.name", [$company_id]);
        return response()->json($clients);
    }

    public function ajax_unloclall_clients()
    {
        DB::table('clients')->where('is_locked', 1)->update(
            ['is_locked' => 0]
        );

        $response = array('unlocked' => true, 'id' => 0);
        return response()->json($response);
    }

    public function ajax_lockall_clients()
    {
        DB::table('clients')->where('is_locked', 0)->update(
            ['is_locked' => 1]
        );

        $response = array('locked' => true, 'id' => 0);
        return response()->json($response);
    }

    public function ajax_unlock_client_by_hash(Request $request)
    {
        $hash = $request->input("hash");
        DB::table('clients')->where('hash_import', $hash)->update(
            ['is_locked' => 0]
        );

        $user = Auth::user();

        if(!empty($user))
        {
            DB::table('logs')->insertGetId(
                [ 'created_by' => $user->id, 'content' => 'User '.$user->name.' locked all clients of '.$hash ]
            );
        }

        $response = array('created' => true, 'id' => 0);
        return response()->json($response);
    }

    public function ajax_delete_client(Request $request)
    {
        $id = $request->input("id");
        DB::table('clients')->where('id', '=', $id)->delete();

        $response = array('deleted' => true, 'id' => $id);
        return response()->json($response);
    }

    public function ajax_lock_client_by_hash(Request $request)
    {
        $hash = $request->input("hash");
        DB::table('clients')->where('hash_import', $hash)->update(
            ['is_locked' => 1]
        );

        $user = Auth::user();

        if(!empty($user))
        {
            DB::table('logs')->insertGetId(
                [ 'created_by' => $user->id, 'content' => 'User '.$user->name.' locked all clients of '.$hash ]
            );
        }

        $response = array('created' => true, 'id' => 0);
        return response()->json($response);
    }

    public function ajax_get_notes_clients(Request $request)
    {
        $client_id = $request->input("id");
        $notes = DB::SELECT("SELECT cn.*, c.name as client_name, u.name as user_name, cs.name as status_name FROM client_notes cn LEFT JOIN client_statuses cs  ON cs.id=cn.status_id JOIN clients c ON c.id=cn.client_id JOIN users u ON u.id=cn.created_by WHERE cn.client_id=? ORDER BY cn.id DESC", [$client_id]);
        return response()->json($notes);
    }

    public function ajax_put_notes_clients(Request $request)
    {

        $date = $request->input("date_to_call");
        $time = $request->input("time_to_call");
        $status_id = $request->input("status_id");

        $created_by = $request->input("created_by", Auth::user()->id);
        $description = $request->input("description");
        $client_id = $request->input('client_id');

        $user_id = Auth::user()->id;

        $id = DB::table('client_notes')->insertGetId(
            ['created_by' => $created_by, 'user_id' => $user_id,'description' => $description, 'client_id' => $client_id, 'status_id' => $status_id, 'time_to_call' => $time, 'date_to_call' => $date]
        );

        DB::table('clients')->where('id', $client_id)->update(
            ['status_id' => $status_id]
        );

        // if((int) $status_id == 4)
        // {

        // }

        $response = array('created' => true, 'id' => $id);
        return response()->json($response);
    }

    public function ajax_get_client_log(Request $request)
    {
        $client_id = $request->input("id");
        $logs = DB::SELECT("SELECT * FROM client_log cl WHERE cl.client_id=?", [$client_id]);
        return response()->json($logs);
    }

    public function ajax_get_sms_client(Request $request)
    {
        $client_id = $request->input("client_id");
        $sms = DB::SELECT("SELECT cm.*, u.name as user_name FROM client_messages cm JOIN users u ON u.id=cm.user_id WHERE cm.client_id=? ORDER BY cm.created_at DESC", [$client_id]);
        return response()->json($sms);
    }

    public function ajax_save_sms_client(Request $request)
    {
        $client_id = $request->input("client_id");
        $user_id = $request->input("user_id", Auth::user()->id);
        $message_text = $request->input("message_text");

        $id = DB::TABLE("client_messages")->insertGetId(
            ["client_id" => $client_id, "user_id" => $user_id, "message_text" => $message_text]
        );

        $response = array('created' => true, 'id' => $id);
        return response()->json($response);
    }

    public function ajax_create_client_logs(Request $request)
    {
        $client_history = $request->input('client_history');
        $content = $request->input('content');
        $created_by = $request->input('created_by');
        
        $id = DB::table('client_history')->insertGetId(
            ["client_history" => $client_history, "content" => $content, 'created_by' => $created_by]
        );

        $response = array('created' => true, 'id' => $id);
        return response()->json($response);
    }    

    public function ajax_client_unlock(Request $request)
    {
        $id = $request->input("id");
        if(!empty($id))
        {
            DB::table('clients')->where('id', $id)->update(
                ['is_locked' => 0]
            );
        }

        return response()->json(array('unlocked' => !empty($id), 'id' => $id));
    }

    public function ajax_next_client(Request $request)
    {
        //DB::raw('LOCK TABLES clients WRITE');
        //DB::raw('UNLOCK TABLES');

        $status_id = $request->input("status_id", 0);
        $company_id = $request->input("company_id", 0);
        $hash_stamp = $request->input("hash_stamp");
        $client_id = $request->input("last_client_id", 0);

        $sql = "SELECT * FROM clients c WHERE c.status_id=$status_id AND company_id=$company_id AND hash_import='$hash_stamp' AND is_locked=0 AND id > $client_id";
        //print($sql);

        $client = collect(DB::SELECT($sql))->first();

        if(!empty($client->id))
        {
            DB::table('clients')->where('id', $client->id)->update(
                ['is_locked' => 1]
            );
        }

        // if(!empty($client_id))
        // {
        //     DB::table('clients')->where('id', $client_id)->update(
        //         ['is_locked' => 0]
        //     );
        // }

        return response()->json(array('client' => $client, 'found' => !empty($client)));
    }

    public function ajax_mails_list(Request $request)
    {
        $client_id = $request->input("client_id");
        $mails = DB::SELECT("SELECT ce.*, u.name as user_name, mt.name as template_name  FROM client_emails ce JOIN users u ON u.id=ce.user_id 
                JOIN mail_templates mt ON mt.id=ce.template_id WHERE ce.client_id=?", [$client_id]);
        return response()->json($mails);
    }
    
    public function client_index(Request $request)
    {
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        return view('client.index', ['user' => Auth::user(), 'permission' => $permission, 'tab' => 'admin']);
    }

    public function ajax_one_unlock_client(Request $request)
    {
        $client_id = $request->input("client_id");
        DB::table('clients')->where('id', $client_id)->update(
            ['is_locked' => 0]
        );

        $response = array('created' => true, 'id' => $client_id);
        return response()->json($response);
    }

    public function ajax_one_lock_client(Request $request)
    {
        $client_id = $request->input("client_id");
        DB::table('clients')->where('id', $client_id)->update(
            ['is_locked' => 1]
        );

        $response = array('created' => true, 'id' => $client_id);
        return response()->json($response);
    }

    public function ajax_create_clients(Request $request)
    {
        $name = $request->input("name");
        $phone = $request->input("phone");
        $city = $request->input("city");
        $state_province = $request->input("state_province");
        $postal_code = $request->input("postal_code");
        $optional_code = $request->input("optional_code");
        $email = $request->input("email");
        $status_id = $request->input("status_id", 1);
        $company_id = $request->input("company_id");
        $hash_import = $request->input("hash_import");
        $description = $request->input("description");
        $is_locked = $request->input("is_locked", 0);

        if($request->has("id"))
        {
            $id = $request->input("id");

            DB::table('clients')->where('id', $id)->update(
                ['name' => $name, 'phone' => $phone, 'city' => $city, 'state_province' => $state_province, 'postal_code' => $postal_code, 'optional_code' => $optional_code, 'email' => $email, 'status_id' => $status_id, 'company_id' => $company_id, 'hash_import' => $hash_import, 'is_locked' => $is_locked, "description" => $description]
            );
        }else{
            $id = DB::table('clients')->insertGetId(
                ['name' => $name, 'phone' => $phone, 'city' => $city, 'state_province' => $state_province, 'postal_code' => $postal_code, 'optional_code' => $optional_code, 'email' => $email, 'status_id' => $status_id, 'company_id' => $company_id, 'hash_import' => $hash_import, 'is_locked' => $is_locked, "description" => $description]
            );
        }

        $response = array('created' => true, 'id' => $id);
        return response()->json($response);
    }
}
