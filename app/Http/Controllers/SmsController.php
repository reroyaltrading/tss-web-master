<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class SmsController extends Controller
{
    public function sms_index(Request $request)
    {
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        return view('sms.index', ['user' => Auth::user(), 'permission' => $permission, 'tab' => $mail ]);
    }
}
