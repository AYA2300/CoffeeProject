<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials=[
            'email'=>$request->email,
            'password'=>$request->password
        ];


        if(!Auth::guard('web')->attempt($credentials)){
            return back()->withErrors([
                'email' => 'بيانات الدخول غير صحيحة.',
            ])->withInput($request->only('email'));
        }else{

            return redirect()->route('dashboard');
        }





        }

        // إعادة توجيه في حالة فشل تسجيل الدخول


    public function index(){
        return view('dashboard.index');
    }

    


}



