<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function purchase_index(Request $request)
    {
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        return view('purchase.index', ['user' => Auth::user(), 'permission' => $permission, 'tab' => 'purchase' ]);
    }    

    public function ajax_purchases_list_client(Request $request)
    {
        $email = $request->input('email');
        $phone = $request->input('phone');
        $purchases = DB::SELECT("SELECT * FROM global_orders gor WHERE gor.billing_email='?' OR gor.billing_phone='?'", [ $email, $phone]);
        return response()->json($purchases);
    }

    public function ajax_purchases_list_top(Request $request)
    {
        $purchases = DB::SELECT("SELECT * FROM global_orders gor ORDER BY gor.id DESC LIMIT 90");
        return response()->json($purchases);
    }
}
