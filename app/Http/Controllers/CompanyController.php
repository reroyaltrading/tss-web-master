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

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function company_index(Request $request)
    {
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        return view('company.index', ['user' => Auth::user(), 'permission' => $permission, 'tab' => 'admin' ]);
    }

    public function ajax_list_companies(Request $request)
    {
        $companies = DB::SELECT("SELECT * FROM companies c ORDER BY c.name");
        return response()->json($companies);
    }

    public function ajax_company_delete(Request $request)
    {
        $id = $request->input("id");
        DB::table('companies')->where('id', $id)->delete();

        $response = array('deleted' => true, 'id' => $id);
        return response()->json($response);
    }

    public function ajax_company_save(Request $request)
    {
        $name = $request->input("name");
        $site = $request->input("site");
        $prefix = $request->input("prefix");
        
        if($request->has("id"))
        {
            $id = $request->input("id");
            $operation = 'update';

            DB::table('companies')->where('id', $id)->update(
                ['name' => $name, 'site' => $site, 'prefix' => $prefix]
            );
        }else{
            $operation = 'insert';
            $id = DB::table('companies')->insertGetId(
                ['name' => $name, 'site' => $site, 'prefix' => $prefix]
            );
        }

        $response = array('created' => true, 'id' => $id, 'operation' => $operation);
        return response()->json($response);
    }

    public function ajax_get_company(Request $request)
    {
        $id = $request->input("id");
        $company = collect(DB::SELECT("SELECT * FROM companies c WHERE c.id=? ORDER BY c.name", [$id]))->first();
        return response()->json($company);
    }

    public function ajax_list_companies_clients(Request $request)
    {
        $companies = DB::SELECT("SELECT * FROM companies c WHERE c.id IN (SELECT company_id FROM clients) ORDER BY c.name");
        return response()->json($companies);
    }

    public function ajax_get_hashes_company(Request $request)
    {
        $company_id = $request->input("company_id", 0);
        $hashes = DB::SELECT("SELECT DISTINCT c.hash_import as name FROM clients c WHERE c.company_id=?", [$company_id]);
        return response()->json($hashes);
    }

    public function ajax_load_statuses_hash_company(Request $request)
    {
        $company_id = $request->input("company_id");
        $hash = $request->input("hash");

        $statuses = DB::SELECT("SELECT * FROM client_statuses cs WHERE cs.id IN (SELECT DISTINCT c.status_id FROM clients c WHERE c.company_id=? AND c.hash_import=?)", [$company_id, $hash]);
        return response()->json($statuses);
    }
}
