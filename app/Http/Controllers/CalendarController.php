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

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function calendar_index(Request $request)
    {
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        return view("calendar.index", ['permission' => $permission, 'user' => Auth::user(), 'tab' => 'home']);
    }

    public function ajax_events_today()
    {
        $events = DB::SELECT(" SELECT cn.date_to_call, cn.client_id, u.name as user_name, c.name as client_name, c.phone, c.email FROM client_notes cn 
        JOIN users u  ON u.id=cn.created_by JOIN clients c ON cn.client_id=c.id WHERE cn.status_id=4 
        AND DATE(NOW()) = STR_TO_DATE(cn.date_to_call, '%m/%d/%Y')");
        return response()->json($events);
    }

    public function ajax_events_month()
    {
        $events = DB::SELECT(" SELECT cn.date_to_call, cn.client_id, u.name as user_name, c.name as client_name, c.phone, c.email FROM client_notes cn 
        JOIN users u  ON u.id=cn.created_by JOIN clients c ON cn.client_id=c.id WHERE cn.status_id=4 
        AND MONTH(NOW()) = MONTH(STR_TO_DATE(cn.date_to_call, '%m/%d/%Y')) AND YEAR(NOW()) = YEAR(STR_TO_DATE(cn.date_to_call, '%m/%d/%Y'))");
        return response()->json($events);
    }
}
