<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ClientStatusController extends Controller
{
    public function ajax_list_statuses(Request $request)
    {
        $statuses = DB::SELECT("SELECT * FROM client_statuses cs ORDER BY cs.name");
        return response()->json($statuses);
    }
}
