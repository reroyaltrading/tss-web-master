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

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function task_index(Request $request)
    {
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        return view('task.index', ['user' => Auth::user(), 'permission' => $permission, 'tab' => 'admin']);
    }

    public function ajax_list_tasks(Request $request)
    {
        $imports = DB::SELECT("SELECT DISTINCT c.hash_import, cs.name as status_name, cs.id as status_id, cp.id as company_id, cp.name as company_name,
        (SELECT u.id FROM users u JOIN asigned_tasks ast ON ast.user_id=u.id WHERE ast.status_id=c.status_id AND ast.company_id=c.company_id AND ast.hash_import=c.hash_import) as user_id,
        (SELECT u.name FROM users u JOIN asigned_tasks ast ON ast.user_id=u.id WHERE ast.status_id=c.status_id AND ast.company_id=c.company_id AND ast.hash_import=c.hash_import) as user_name
        FROM clients c JOIN client_statuses cs ON c.status_id=cs.id JOIN companies cp ON cp.id=c.company_id");
        return response()->json($imports);
    }

    public function ajax_task_save(Request $request)
    {
        $status_id = $request->input("status_id");
        $company_id = $request->input("company_id");
        $user_id = $request->input("user_id");
        $hash_import = $request->input("hash_import");

        $whereArray = array('company_id' => $company_id,'status_id' => $status_id, 'hash_import' => $hash_import);
        
        $query = DB::table('asigned_tasks');
        $query->where('company_id', $company_id);
        $query->where('status_id', $status_id);
        $query->where('hash_import', $hash_import);
        $query->delete();

        $id = DB::table('asigned_tasks')->insertGetId(
            [ 'company_id' => $company_id, 'status_id' => $status_id, 'hash_import' => $hash_import, 'user_id' => $user_id]
        );

        $response = array('created' => true, 'id' => $id, 'user_id' => $user_id);
        return response()->json($response);
    }
}
