<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showDashboard(){
        return view("admin.dashboard.dashboard");
    }

    public function showLoginForm(){
        return view("admin.dashboard.login");
    }

    public function login(Request $request){
        $admin = Admin::where('username', $request->login_username)
                        ->where('password', md5($request->login_password))
                        ->first();
        if(!is_null($admin)){
            session()->put('admin_id', $admin->id);
            session()->put('admin_username', $admin->username);
            return view("admin.dashboard.dashboard");
        }
        return redirect()->back();
    }

    public function showSettings(){
        return view("admin.dashboard.settings");
    }

    public function logout(){
        session()->forget('admin_id');
        session()->forget('admin_username');
        return redirect("admin/login");
    }

    public function sendPasswordToEmail(){
    }
}
