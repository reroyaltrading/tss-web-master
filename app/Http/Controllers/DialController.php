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

class DialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function dialling_select_company(Request $request)
    {
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        $load_client = $request->has('client_id');
        $client_id = $request->input('client_id', 0);
        return view('dial.select', ['user' => Auth::user(), 'permission' => $permission,'tab' => 'home', 'load_client' =>  $load_client, 'client_id' => $client_id]);
    }

    public function dialling_noselector(Request $request)
    {
        $dialers = collect(DB::SELECT("SELECT ast.*, cps.name as company_name, cps.prefix, cs.name as status_name,
        (SELECT count(*) FROM clients ccs WHERE ccs.hash_import=ast.hash_import AND ccs.company_id=ast.company_id AND ccs.status_id=ast.status_id) as count_clients FROM asigned_tasks ast 
        JOIN client_statuses cs ON cs.id=ast.status_id JOIN companies cps ON cps.id=ast.company_id WHERE 
        ast.user_id=? AND (SELECT count(*) FROM clients ccs WHERE ccs.hash_import=ast.hash_import AND ccs.company_id=ast.company_id AND ccs.status_id=ast.status_id) > 0", [ Auth::user()->id ]))->first();

        return response()->json($dialers);
    }

    public function ajax_client_last_statuses(Request $request)
    {
        $id = $request->input("id");
        $last_statuses = DB::SELECT("SELECT cn.*, cs.name as status_name, u.name as operator FROM client_notes cn JOIN client_statuses cs ON cs.id=cn.status_id 
        JOIN users u ON u.id=cn.created_by WHERE cn.client_id = ? GROUP BY cn.status_id, cn.client_id  ORDER BY id DESC", [$id]);
        return response()->json($last_statuses);
    }
}
