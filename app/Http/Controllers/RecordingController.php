<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class RecordingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function rec_index(Request $request)
    {
        $user_id = Auth::user()->id;
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [$user_id]))->first();
        return view('recording.index', ['user' => Auth::user(), 'permission' => $permission, 'tab' => 'records' ]);
    }

    public function api_recordings_list(Request $request)
    {
        $user_id = Auth::user()->id;
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [$user_id]))->first();

        $url_files = url("storage/app/recordings/");
        $sql = "SELECT r.*, concat('$url_files', '/', r.file_name) as file_location FROM recordings r";
        if(!$permission->back_office_operator)
        {
            $sql .= " WHERE r.user_id=$user_id";
        }
        $recordings = DB::SELECT($sql);
        return response()->json($recordings);
    }
}
