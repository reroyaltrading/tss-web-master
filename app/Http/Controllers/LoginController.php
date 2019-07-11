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

class LoginController extends Controller
{
    public function login_index(Request $request)
    {
        if(Auth::check() || LoginHelper::IsRememberTokenValid($request)){
            return redirect('/dash/home.html');
        }else{
            $agent = new Agent();
            $isMobile = $request->input('isMobile', 0);
            return view('login.index', [ 'isMobile' => $isMobile, 'agent' => $agent]);
        }
    }

    public function recover()
    {
        return view('login.recover');
    }

    public function done_recover($hash)
    {
        $user = collect(DB::SELECT("SELECT u.id, u.name FROM password_recoveries pr JOIN users u ON u.id=pr.user_id WHERE pr.hash=?", [$hash]))->first();
        if(!empty($user))
        {
            return view('login.recoverdone', [ 'user' => $user, 'hash' => $hash]);
        }
    }

    public function signup(Request $request)
    {
        return view('login.index');
    }

    public function done_recovery_login(Request $request)
    {
        $hash = $request->input('hash');
        $password = $request->input('hash');
        $password_repeat = $request->input('password_repeat');

        if(strlen($password) > 0)
        {
            $user = collect(DB::SELECT("SELECT u.id, u.name FROM password_recoveries pr JOIN users u ON u.id=pr.user_id WHERE pr.hash=?", [$hash]))->first();
            DB::table('users')->where('id', $user->id)->update([ 'password' => md5($password)]);
            $revovered = true;
            $error = "";
        }else{
            $revovered = false;
            $error = 'Invalid password';
        }

        return response()->json(array('revovered' => $revovered, 'error' => $error));
    }

    public function auth_recover(Request $request)
    {

        $email = $request->input('username');
        $recovery_sent = true;
        $recovery_error = "";

        if(strlen($email) > 0)
        {
            $user = collect(DB::SELECT('SELECT * FROM users u WHERE u.email=?', [$email]))->first();

            if(!empty($user))
            {
                $to_name = $user->name;
                $to_email = $user->email;

                $hash = md5(date('y').date('m').$email);
                $data = array('name'=> $user->name, "hash" => $hash);
               

                $recovery_id = DB::table('password_recoveries')->insertGetId(
                    ["user_id" => $user->id, "hash" => $hash, "active" => 1]
                );        
                
                \Mail::send('emails.recovery', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)->subject('MeKontrol - Password Recovery');
                    $message->from('no-reply@blascke.com','MeKontrol');
                });
            }else
            {
                $recovery_sent = false;
                $recovery_error = "No user found for this e-mail";
            }
        }else
        {
            $recovery_sent = false;
            $recovery_error = "Email '".$email."' not valid";
        }

        return response()->json(array('revovered' => $recovery_sent, 'error' => $recovery_error));
    }

    public function auth_get_logout()
    {
        Auth::logout();
        return redirect()->route('login')->withCookie(cookie()->forget('remember_me'));
    }

    public function ajax_verify_app(Request $request)
    {
        $hash_key = md5(date('d.m.YY hh:mm:ss'));
        return response()->json(array('hash_key' => $hash_key, 'valid' => true));
    }

    public function ajax_login_outside(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $device = $request->input('device');
        $os = $request->input('os');
        $remember = $request->input('remember', false);

    	$user = collect(DB::SELECT(" SELECT * FROM users WHERE email=? AND password=?", [$username , md5($password)]))->first();

        $auth = false;
        $hasCookie = false;
        $remember_token = "";

        $hash = "";

        if(!empty($user))
    	{
            $auth = true;
            $user = Auth::loginUsingId($user->id);

            $hash = md5(uniqid().$user->id.date("d/m/Y h:m:s"));
            $id = DB::table('user_sessions')->insertGetId(
                ["latitude" => $latitude, "longitude" => $longitude, "os" => $os, 'device' => $device, 'user_id' => $user->id, 'hash' => $hash]
            );
        }

        return response()->json(
            array("auth" => $auth, "hash" => $hash, 
                "id" => !empty($user) ? $user->id : 0,
                "ic_admin" => !empty($user) ? $user->ic_admin : 0)
            )->withCookie(cookie()->forever('remember_token',  $hash));;
    }

    public function ajax_post_login(Request $request)
    {
    	$username = $request->input('username');
        $password = $request->input('password');
        $remember = $request->input('remember', false);

    	$user = collect(DB::SELECT(" SELECT * FROM users WHERE email=? AND password=?", [$username , md5($password)]))->first();

        $auth = false;
        $hasCookie = true;
        $remember_token = "";

        $cookie = "";

    	if(!empty($user))
    	{
    		$auth = true;
            $user = Auth::loginUsingId($user->id);
            
            if($remember)
            {
                //UPDATE users SET remember_token='' WHERE remember_token IS NULL AND id=1
                $hasCookie = true;
                \App\User::where('id', 1)->whereNull('remember_token')->update(['remember_token' => str_random(20)]);
                $user_token = collect(DB::SELECT(" SELECT remember_token FROM users WHERE id=?", [$user->id]))->first();
                $remember_token = $user_token->remember_token;
            }
    	}

        if($hasCookie)
        {
            return response()->json(array( 'auth' => $auth, 'user' => $user, 'remember_token'=> $remember_token))
            ->withCookie(cookie()->forever('remember_token',  $remember_token));
        }else{
            return response()->json(array( 'auth' => $auth, 'user' => $user, 'remember_token'=> $remember_token));
        }
    }
}

