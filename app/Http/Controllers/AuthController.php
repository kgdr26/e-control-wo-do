<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Validator;
use Session;
use Hash;


class AuthController extends Controller
{
    public function ShowFormLogin()
    {
        if (Auth::check()) {
            if(auth::user()->role_id == 1){
                return redirect()->route('upload_sto');
            }else if(auth::user()->role_id == 2){
                return redirect()->route('input_stowo');
            }else if(auth::user()->role_id == 3){
                return redirect()->route('input_stodo');
            }else if(auth::user()->role_id == 4){
                return redirect()->route('upload_sto');
            }
        }
        return view('login');
    }

    public function login(Request $request)
    {

        $rules = [
            'username'  => 'required',
            'password'  => 'required'
        ];

        $messages = [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'username'       => $request->input('username'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            // return redirect()->route('dasbor');
            if(auth::user()->role_id == 1){
                return redirect()->route('upload_sto');
            }else if(auth::user()->role_id == 2){
                return redirect()->route('input_stowo');
            }else if(auth::user()->role_id == 3){
                return redirect()->route('input_stodo');
            }else if(auth::user()->role_id == 4){
                return redirect()->route('upload_sto');
            }

        } else {
            //Login Fail
            Session::flash('error', 'Username atau Password salah');
            return redirect()->route('login');
        }

    }

    public function logout(Request $request){
        header("cache-Control: no-store, no-cache, must-revalidate");
        header("cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        Session::flush();
        $request->session()->regenerate();
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }


}
