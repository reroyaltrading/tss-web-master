<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Redirect;
use App\User;
use Session;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ajax_permissions_list(Request $request)
    {
        $user_id = $request->input("id");
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [$user_id]))->first();
        return response()->json($permission);
    }

    public function ajax_permissions_save(Request $request)
    {
        $select_company_to_work = $request->input("select_company_to_work");
        $back_office_operator  = $request->input("back_office_operator");
        $front_office_operator = $request->input("front_office_operator");
        $user_id = $request->input("user_id");  

        $id = $request->input("id");

        DB::table('permissions')->where('id', $id)->update(
            ['select_company_to_work' => $select_company_to_work, 'back_office_operator' => $back_office_operator, 'front_office_operator' => $front_office_operator]
        );

        $response = array('created' => true, 'id' => $id);
        return response()->json($response);
    }
}
