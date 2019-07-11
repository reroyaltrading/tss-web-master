<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ScriptController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function script_index(Request $request)
    {
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        return view("scripts.index", ['user' => Auth::user(), 'permission' => $permission, 'tab' => 'admin']);
    }

    public function ajax_list_scripts(Request $request)
    {
        if($request->has("company_id"))
        {
            $company_id = $request->has("company_id");
            $scripts = DB::SELECT("SELECT s.*, c.name as company_name, cs.name as status_name FROM scripts s LEFT JOIN companies c ON c.id=s.company_id LEFT JOIN client_statuses cs ON cs.id=s.status_id WHERE company_id=?", [$company_id]);
        }else{
            $scripts = DB::SELECT("SELECT s.*, c.name as company_name, cs.name as status_name FROM scripts s LEFT JOIN companies c ON c.id=s.company_id LEFT JOIN client_statuses cs ON cs.id=s.status_id ", []);
        }

        return response()->json($scripts);
    }

    public function delete_script(Request $request)
    {
        $id = $request->input("id");
        DB::table('scripts')->where('id', $id)->delete();

        $response = array('deleted' => true, 'id' => $id);
        return response()->json($response);
    }

    public function home_edit_script($id)
    {
        $script = collect(DB::SELECT("SELECT s.*, c.name as company_name, cs.name as status_name FROM scripts s JOIN companies c ON c.id=s.company_id JOIN client_statuses cs ON cs.id=s.status_id WHERE s.id=?", [$id]))->first();
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        return view('scripts.create', ['script' => $script, 'user' => Auth::user(), 'permission' => $permission, 'tab' => 'admin' ]);
    }

    public function ajax_get_scripts_by_id(Request $request)
    {
        $id = $request->has("id");
        $script = collect(DB::SELECT("SELECT s.*, c.name as company_name, cs.name as status_name FROM scripts s JOIN companies c ON c.id=s.company_id JOIN client_statuses cs ON cs.id=s.status_id WHERE s.id=?", [$id]))->first();
        return response()->json($script);
    }

    public function home_create_script (Request $request)
    {
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        return view('scripts.create', ['user' => Auth::user(), 'id' => 0, 'permission' => $permission]);
    }

    public function ajax_get_scripts_by_status(Request $request)
    {
        $status_id = $request->input("status_id");
        $company_id = $request->input("company_id");

        $script = collect(DB::SELECT("SELECT * FROM scripts s WHERE s.company_id=? AND s.status_id=?", [$company_id, $status_id]))->first();
        return response()->json($script);
    }

    public function ajax_save_scripts(Request $request)
    {
        $name = $request->input("name");
        $content = $request->input("content");
        $company_id = $request->input("company_id");
        $status_id = $request->input("status_id");

        
        if($request->has("id"))
        {
            $id = $request->input("id");
            $operation = 'update';

            DB::table('scripts')->where('id', $id)->update(
                ['name' => $name, 'content' => $content, 'company_id' => $company_id, 'status_id' => $status_id]
            );
        }else{
            $operation = 'insert';
            $id = DB::table('scripts')->insertGetId(
                ['name' => $name, 'content' => $content, 'company_id' => $company_id, 'status_id' => $status_id]
            );
        }

        $response = array('created' => true, 'id' => $id, 'operation' => $operation);
        return response()->json($response);
    }
}
