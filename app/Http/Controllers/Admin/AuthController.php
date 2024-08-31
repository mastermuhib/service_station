<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Administrator;
use Auth;
use Redirect;
use Illuminate\Support\MessageBag;
use DB;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $this->validate($request, [
                'username' => 'required',
                'password' => 'required',
            ]);

            $cek = Administrator::where('email', $request->username)->whereNull('deleted_at')->get();
            
            if ($cek->isNotEmpty()) {
               
                if (Auth::guard('admin')->attempt(['email' => $request->username, 'password' => $request->password])) {
                    
                    return redirect()->intended('/admin/dashboard');

                } else {
                    $errors = new MessageBag(['message' => ['Your Email Or password invalid!. Please Check and Try Again!!!!']]);
                    //dd($errors);
                     return Redirect::back()->withErrors($errors);
                }
            } else {
                
                     $errors = new MessageBag(['message' => ['Email Tidak Terdaftar di System']]);
                    //dd($errors);
                     //Session::has('message')
                     Session::put('message', 'Email Tidak Terdaftar di System');
                     return Redirect::back()->with('message','Email Tidak Terdaftar di System');
            }
        } catch (\Exception $e) {
            $data['code']    = 500;
            $data['message'] = $e->getMessage();
            $data['line'] = $e->getLine();
            $data['controller'] = 'LoginController@login';
            return Redirect::back()->withErrors($data);
        }
    }

    public function logout(){
        try {
            $id_admin = Auth::guard('admin')->user()->id;
            date_default_timezone_set('Asia/Jakarta');
            $insert_log      = parent::LogAdmin(\Request::ip(),Auth::guard('admin')->user()->id,'Keluar dari System','Log Out');
            Auth::guard('admin')->logout();
            return redirect('/');
        } catch (\Exception $e) {
            $data['code']    = 500;
            $data['message'] = $e->getMessage();
            $data['line'] = $e->getLine();
            $data['controller'] = 'LoginController@logout';
            return response()->json($data);
        }
    }
 
    public function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!#$';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 11; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}
