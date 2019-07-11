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

class HomeController extends Controller
{
    public function home_index(Request $request)
    {
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        return view('home.index', ['user' => Auth::user(), 'permission' => $permission, 'tab' => 'home' ]);
        //return redirect('dash/dialing/select-company.html');
    }

}
