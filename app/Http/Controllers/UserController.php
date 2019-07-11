<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Redirect;
use App\User;
use Session;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function user_index(Request $request)
    {
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        return view('user.index', ['user' => Auth::user(), 'permission' => $permission, 'tab' => 'admin']);
    }
    
    public function ajax_list_users(Request $request)
    {
        $users = DB::SELECT("SELECT id, name, email, phone FROM users u");
        return response()->json($users);
    }

    public function ajax_delete_user(Request $request)
    {
        $id = $request->input("id");
        DB::table('users')->where('id', '=', $id)->delete();

        $response = array('deleted' => true, 'id' => $id);
        return response()->json($response);
    }

    public function ajax_get_user(Request $request)
    {
        $id = $request->input("id");
        $user = collect(DB::SELECT("SELECT id, name, email, image, site, phone FROM users u WHERE u.id=?", [$id]))->first();
        return response()->json($user);
    }

    public function ajax_create_users(Request $request)
    {
        $name = $request->input("name");
        $email = $request->input("email");
        $password = $request->input("password");
        $phone = $request->input("phone");
        $site = $request->input("site");
        $profile_description = $request->input("profile_description", "");
        $default_locale =  $request->input("default_locale");
        $my_location =  $request->input("my_location");
        $shadow =  $request->input("shadow", 0);
        $update_password = strlen($request->input("password")) > 0;

        if($request->has("id"))
        {
            $id = $request->input("id");

            DB::table('users')->where('id', $id)->update(["name" => $name, "email" => $email, 'site' => $site, 'phone' => $phone, 
            'profile_description' => $profile_description, 'default_locale' => $default_locale, 'my_location' => $my_location]);
            
            if($update_password)
            {
                DB::table('users')->where('id', $id)->update(["password" => md5($password)]);
            }

        }else{
            $id = DB::table('users')->insertGetId(
                ["name" => $name, "email" => $email, "password" => md5($password), 'ic_shadow_user' => $shadow, 'phone' => $phone, 'site' => $site]
            );

            $permission_id = DB::table('permissions')->insertGetId(
                ['user_id' => $id]
            );
        }

        $response = array('created' => true, 'id' => $id);
        return response()->json($response);
    }
}
