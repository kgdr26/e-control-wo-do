<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use \Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\user;
use Auth;
use Hash;
use Redirect;
use DB;

class MainController extends Controller
{
    function users(){
        $idn_user   = idn_user(auth::user()->id);
        $arr        = DB::select("SELECT * FROM users where is_active=1");
        $data = array(
            'title' => 'Users',
            'arr'   => $arr,
            'idn_user' => $idn_user
        );

        return view('Users.list')->with($data);
    }

    function upload_sto(){
        $idn_user   = idn_user(auth::user()->id);
        $data = array(
            'title' => 'Upload STO',
            'idn_user' => $idn_user
        );

        return view('STO.upload_sto')->with($data);
    }

    function listdatasto(){
        $arr    = DB::select("SELECT * FROM trx_sto ORDER BY id DESC");
        return response($arr);
    }

    function input_stowo(){
        $idn_user   = idn_user(auth::user()->id);
        $wo     = DB::select("SELECT * FROM trx_sto WHERE wo_state='Draft' ORDER BY id DESC");
        $data = array(
            'title' => 'Input STO WO',
            'wo'    => $wo,
            'idn_user' => $idn_user
        );

        return view('STO.input_stowo')->with($data);
    }

    function listdatawo(){
        $arr    = DB::select("SELECT * FROM trx_sto WHERE wo_state='Draft' ORDER BY id DESC");
        return response($arr);
    }

    function input_stodo(){
        $idn_user   = idn_user(auth::user()->id);
        $do    = DB::select("SELECT * FROM trx_sto WHERE wo_state='Done' AND do_state!='Done' ORDER BY id DESC");
        $data = array(
            'title' => 'Input STO DO',
            'do'    => $do,
            'idn_user' => $idn_user
        );

        return view('STO.input_stodo')->with($data);
    }

    function listdatado(){
        $arr    = DB::select("SELECT * FROM trx_sto WHERE wo_state='Done' AND do_state!='Done' ORDER BY id DESC");
        return response($arr);
    }
    

    // Upload Image
    function upload_profile(Request $request) : object {

        if($request->hasFile('add_foto')){
            $fourRandomDigit = rand(10,99999);
            $photo      = $request->file('add_foto');
            $fileName   = $fourRandomDigit.'.'.$photo->getClientOriginalExtension();

            $path = public_path().'/profile/';

            File::makeDirectory($path, 0777, true, true);

            $request->file('add_foto')->move($path, $fileName);

            return response($fileName);
        }elseif($request->hasFile('add_image')){
            $fourRandomDigit = rand(10,99999);
            $photo      = $request->file('add_image');
            $fileName   = $fourRandomDigit.'.'.$photo->getClientOriginalExtension();

            $path = public_path().'/assets/image/';

            File::makeDirectory($path, 0777, true, true);

            $request->file('add_image')->move($path, $fileName);

            return response($fileName);
        }elseif($request->hasFile('add_file')){
            $fourRandomDigit = rand(10,99999);
            $photo      = $request->file('add_file');
            $fileName   = $fourRandomDigit.'.'.$photo->getClientOriginalExtension();

            $path = public_path().'/assets/file/';

            File::makeDirectory($path, 0777, true, true);

            $request->file('add_file')->move($path, $fileName);

            return response($fileName);
        }else{
            return response('Failed');
        }

    }

    // Action Add
    function actionadd(Request $request) : object {
        $table      = $request['table'];
        $dt         = $request['data'];
        if($table == 'users'){
            $data   = array(
                'username'  => $dt['username'],
                'password'  => Hash::make($dt['password']),
                'pass'      => $dt['password'],
                'role_id'   => $dt['role_id'],
                'name'      => $dt['name'],
                'email'     => $dt['email'],
                'no_tlp'    => $dt['no_tlp'],
                'foto'      => $dt['foto'],
                'is_active' => 1,
                'update_by' => 1,
            );
        }else{
            $data   = $request['data'];
        }
        // $data       = $request['data'];
        DB::table($table)->insert([$data]);
        return response('success');
    }

    // Action Edit
    function actionedit(Request $request) : object {
        $table      = $request['table'];
        $id         = $request['id'];
        $whr        = $request['whr'];
        $dt         = $request['dats'];
        if($table == 'users'){
            $data   = array(
                'username'  => $dt['username'],
                'password'  => Hash::make($dt['password']),
                'pass'      => $dt['password'],
                'role_id'   => $dt['role_id'],
                'name'      => $dt['name'],
                'email'     => $dt['email'],
                'no_tlp'    => $dt['no_tlp'],
                'foto'      => $dt['foto'],
                'update_by' => 1,
            );
        }else{
            $data   = $request['dats'];
        }

        DB::table($table)->where($whr, $id)->update($data);
        return response('success');
    }

    function actioneditwmulti(Request $request) : object {
        $table      = $request['table'];
        $id1        = $request['id1'];
        $whr1       = $request['whr1'];
        $id2        = $request['id2'];
        $whr2       = $request['whr2'];
        $data       = $request['dats'];

        DB::table($table)->where($whr1, $id1)->where($whr2, $id2)->update($data);
        return response('success');
    }

    // Action Delete
    function actiondelete(Request $request) : object {
        $table      = $request['table'];
        $id         = $request['id'];
        $whr        = $request['whr'];
        $data   = array(
            'is_active' => 0,
            'update_by' => 1,
        );
        DB::table($table)->where($whr, $id)->update($data);
        return response('success');
    }

    // Action Show Data
    function actionshowdata(Request $request) : object {
        $id     = $request['id'];
        $field  = $request['field'];
        $table  = $request['table'];
        $arr['data']    = DB::table($table)->where($field, $id)->first();
        return response($arr);
    }

    function actionshowdatawmulti(Request $request) : object {
        $id1     = $request['id1'];
        $field1  = $request['field1'];
        $id2     = $request['id2'];
        $field2  = $request['field2'];
        $table   = $request['table'];
        $arr['data']    = DB::table($table)->where($field1, $id1)->where($field2, $id2)->first();
        return response($arr);
    }

    // Action List Data
    function actionlistdata(Request $request) : object {
        if($request['id'] == 0 || $request['id'] == null){
            $id     = 1;
        }else{
            $id     = $request['id'];
        }
        $field  = $request['field'];
        $table  = $request['table'];
        $arr    = DB::select("SELECT * FROM $table WHERE $field=$id AND is_active=1 ");
        return response($arr);
    }


    // Upload Excel
    function import(Request $request){
        
        $wo_no_db   = [];
        $do_no_db   = [];
        $arr        = DB::select("SELECT * FROM trx_sto");
        foreach($arr as $k => $v){
            array_push($wo_no_db, $v->pt_no);
            array_push($do_no_db, $v->do_no);
        }

        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        $spreadsheet = IOFactory::load($file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        unset($sheetData[0]);
        foreach ($sheetData as $key => $row) {
            if($row[1] == null){
                continue;
            }

            $so_no          = $row[0];
            $pt_no          = $row[1];
            $wo_state       = $row[2];
            // $wo_date        = date("Y-m-d H:i:s", strtotime($row[3]));
            $wo_date        = $row[3];
            $do_no          = $row[4];
            // $do_date        = date("Y-m-d H:i:s", strtotime($row[5]));
            $do_date        = $row[5];
            $do_state       = $row[6];
            $tgl_upload     = date('Y-m-d H:i:s');
            $update_by      = auth::user()->id;

            if (in_array($pt_no, $wo_no_db) || in_array($do_no, $do_no_db)){
                
            } else {
                DB::insert("INSERT INTO trx_sto (so_no, pt_no, wo_state, wo_date, do_no, do_date, do_state, tgl_upload, update_by) values (?, ?, ?, ?, ?, ?, ?, ?, ?)", [$so_no, $pt_no, $wo_state, $wo_date, $do_no, $do_date, $do_state, $tgl_upload, $update_by]);
            }
            
        }

        return redirect()->back()->with('success', 'Data imported successfully.');
    }

    //Export STO

    function exportsto($param){
        $exp               = explode(',', $param);
        $start_export      = $exp[0];
        $end_export        = $exp[1];
        $file       = 'tmp_sto.xlsx';
        $filename   = "template/$file";
        $arr        = downloadsto($filename,$start_export,$end_export);
        $name       = 'Export_data_STO_TGL_'.$start_export.'_Sampai_'.$end_export.'.xlsx';

        $count      = DB::select("SELECT * FROM trx_sto WHERE DATE(wo_date) BETWEEN '$start_export' AND '$end_export'");
        if(count($count) > 0){
            $writer = new Xlsx($arr);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="'. urlencode($name).'"');
            $writer->save('php://output');

        }else  {
            return Redirect::to("upload_sto")->withSuccess('Data report tidak tersedia !');
        }

        
    }

}
