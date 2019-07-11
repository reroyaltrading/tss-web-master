<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Redirect;
use App\User;
use Session;
use Jenssegers\Agent\Agent;
use Storage;
use App\Http\Helpers\LoginHelper;

class ImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function import_index(Request $request)
    {
        $permission = collect(DB::SELECT("SELECT * FROM permissions p WHERE p.user_id=?", [Auth::user()->id]))->first();
        return view('import.index', ['user' => Auth::user(), 'permission' => $permission, 'tab' => 'admin']);
    }

    public function ajax_imports_list(Request $request)
    {
        $imports = DB::SELECT("SELECT i.*, c.name as company_name, cs.name as status_name, u.name as user_name, (SELECT COUNT(*) FROM files f WHERE f.import_id=i.id ) total_files FROM imports i JOIN companies c ON c.id=i.company_id JOIN client_statuses cs ON cs.id=i.status_id JOIN users u ON u.id=i.user_id");
        return response()->json($imports);
    }

    public function ajax_imports_save(Request $request)
    {
        $status_id =  $request->input("status_id");
        $company_id =  $request->input("company_id");
        $user_id =  Auth::user()->id;

        $company = collect(DB::SELECT("SELECT * FROM companies c WHERE c.id=?", [$company_id]))->first();

        $hash_import = strtolower(substr($company, 0, 4).'-'.date('mm-dd-YYYY-hh-mm-ss'));

        $import_id = DB::table('imports')->insertGetId(
            ['status_id' => $status_id, 'user_id' => $user_id, 'company_id' => $company_id, 'hash_import' => $hash_import]
        );

        DB::table('files')->where('import_id', 0)->update(
            ['import_id' =>$import_id]
        );

        $response = array('created' => true, 'id' => $import_id);
        return response()->json($response);
    }

    public function ajax_cancel_upload_file(Request $request)
    {
        $user_id = Auth::user()->id;
        DB::table('files')->where('import_id', '=', 0)->where('user_id', '=', $user_id)->delete();
        return response()->json(array("deleted" => true));
    }

    public function ajax_post_upload_file(Request $request)
    {

    }

    public function ajax_imports_list_files(Request $request)
    {
        $id = $request->input("id");
        $files = DB::SELECT("SELECT * FROM files f WHERE f.import_id=?", [$id]);
        return response()->json($files);
    }

    public function ajax_file_import(Request $request)
    {
        try
        {            
            $file_id = $request->input("id");

            $file = collect(DB::SELECT("SELECT * FROM files f WHERE f.id=?", [$file_id]))->first();
            $import = collect(DB::SELECT("SELECT * FROM imports i WHERE i.id=?", [$file->import_id]))->first();

            $path = storage_path($file->location);
            //$data = \Excel::load($path)->get();
    
            $status_id = $import->status_id;
            $company_id = $import->company_id;
            $hash_import = $name = uniqid(date('HisYmd'));

            $collection = (new \App\Imports\ClientsImport)->toArray($path);

            foreach ($collection[0] as $item) {
                 $arr[] = [
                     'name' => $item[0], 
                     'phone' => $item[1],
                     'city' => $item[2],
                     'state_province' => $item[3],
                     'postal_code' => $item[4],
                     'optional_code' => $item[5],
                     'email' => $item[6],
                     'description' => $item[7],
                     'company_id' => $company_id,
                     'status_id' => $status_id,
                     'hash_import' => $hash_import
                 ];

                if(!empty($arr)){
                    \App\Client::insert($arr);
                }
             }

            DB::table('files')->where('id', '=', $file_id)->update([
                'processed' => 1
            ]);

            //new \App\Imposts\ClientsImport)->import('users.xlsx', 'local', \Maatwebsite\Excel\Excel::XLSX);
    
            return response()->json(array("imported" => true, 'description' => null));
        
        }catch(Exception $ex){
           $description = $ex->getMessage();
           return response()->json(array("imported" => true, "description" => $description));
        }
    }

    public function ajax_imports_delete(Request $request)
    {
        $id = $request->input("id");
        DB::table('imports')->where('id', $id)->delete();

        $response = array('deleted' => true, 'id' => $id);
        return response()->json($response);
    }

    public function ajax_upload_file(Request $request)
    {
         $nameFile = null;
         $upload = false;
         $destiny = "";
         $task_file_id = 0;
    
         if ($request->hasFile('file') && $request->file('file')->isValid()) {
            
        //     //try{
                $name = uniqid(date('HisYmd'));
                $extension = $request->file('file')->extension();
                $nameFile = "{$name}.{$extension}";
                $destiny = $request->file('file')->store('uploads'); 
                $upload = true; 
                $client_name = $request->file('file')->getClientOriginalName();

                 $task_file_id = DB::table('files')->insertGetId(
                     ['name' => $name, 'original_name' => $client_name, 'location' => "app/".$destiny, 'extension' => $extension, 'user_id' => Auth::user()->id]
                 );
             //}catch(Exception $ex){
             //    $description = $ex->getMessage();
             //}

         }

        return response()->json(array('uploaded' => $upload, 'storage' => "storage/app/".$destiny, 'file_name' => $nameFile));
    }

    public function ajax_get_dropzone()
    {
        return view("import.dropzone");
    }
}
