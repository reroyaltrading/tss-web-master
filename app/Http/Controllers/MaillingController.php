<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\Mail\SendMail;

class MaillingController extends Controller
{
    public function templates_index(Request $request)
    {
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        return view('mailling.templates', ['user' => Auth::user(), 'permission' => $permission, 'tab' => 'mail' ]);
    }

    public function compose_index(Request $request)
    {
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        return view('mailling.compose', ['user' => Auth::user(), 'permission' => $permission, 'tab' => 'mail' ]);
    }

    public function ajax_templates_list(Request $request)
    {
        $templates = DB::SELECT("SELECT mt.id, mt.name, mt.created_by, u.name as user_name, DATE_FORMAT(mt.created_at,'%d/%m/%Y') as created_at_formated, mt.created_at  FROM mail_templates mt JOIN users u ON u.id=mt.created_by");
        return response()->json($templates);
    }

    public function templates_create(Request $request)
    {
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        return view('mailling.template_editor', ['user' => Auth::user(), 'permission' => $permission, 'tab' => 'mail']);
    }

    public function templates_editor($id)
    {
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        $template = collect(DB::SELECT("SELECT * FROM mail_templates mt WHERE mt.id=?", [$id]))->first();
        return view('mailling.template_editor', ['user' => Auth::user(), 'permission' => $permission, 'template' => $template, 'tab' => 'mail']);
    }


    public function ajax_templates_delete(Request $request)
    {
        $id = $request->input("id");
        DB::table('mail_templates')->where('id', $id)->delete();
        $response = array('deleted' => true, 'id' => $id);
        return response()->json($response);
    }

    public function ajax_mailling_send(Request $request)
    {
        $client_name = $request->input("client_name");
        $client_email = $request->input("client_email");
        $client_id = $request->input("client_id");
        $template_id = $request->input("template_id");
        $content = $request->input("content", "no data");
        $title = $request->input("title");
        $user_id = Auth::user()->id;

        $id = DB::table('client_emails')->insertGetId(
            ['template_id' => $template_id, 'user_id'=> $user_id, 'client_id' => $client_id, 'content' => $content]
        );

        $data = array("from" => 'no-reply@blascke.com', 'subject' => $title, 'content' => $content);
        Mail::to($client_email)->send(new SendMail($data));

        $response = array('created' => true, 'id' => $id);
        return response()->json($response);
    }

    public function ajax_templates_get_one(Request $request)
    {
        $id = $request->input("id");
        $template = collect(DB::SELECT("SELECT * FROM mail_templates mt WHERE mt.id=?", [$id]))->first();
        return response()->json($template);
    }

    public function ajax_templates_save(Request $request)
    {
        $name = $request->input("name");
        $content = $request->input("content");
        $user_id = Auth::user()->id;
        
        if($request->has("id"))
        {
            $id = $request->input("id");
            $operation = 'update';

            DB::table('mail_templates')->where('id', $id)->update(
                ['name' => $name, 'content' => $content, 'updated_by' => $user_id]
            );
        }else{
            $operation = 'insert';
            $id = DB::table('mail_templates')->insertGetId(
                ['name' => $name, 'content' => $content, 'created_by' => $user_id]
            );
        }

        $response = array('created' => true, 'id' => $id, 'operation' => $operation);
        return response()->json($response);
    }
}
