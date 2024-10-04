<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Mail\WebMail;
use Illuminate\Support\Facades\Mail;



class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function login_submit(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],

        ];

        if (Auth::guard('admin')->attempt($data)) {
            return redirect()->route('admin_dashboard')->with('success', 'Loign Succsessfull');
        } else {
            return redirect()->route('admin_login')->withErrors(['error' => 'Invalid Credentials']);
        }
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login')->with('success', 'Logout Succsessfull');
    }

    public function forget_password()
    {
        return view('admin.forget-password');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $admin_data = Admin::where('email', $request->email)->first();
        if (!$admin_data) {
            return redirect()->back()->withErrors(['error' => 'Email not found']);
        }

        $token = hash('sha256', time());
        $admin_data->token = $token;
        $admin_data->update();

        $reset_link  = url('admin/reset-password/' . $token . '/' . $request->email);
        $subject = "Reset Password";
        $message = "Please click on below link to reset your password<br><br>";
        $message .= "<a href='" . $reset_link . "'>Click Here!!</a>";

        Mail::to($request->email)->send(new WebMail($subject, $message));

        return redirect()->back()->with('success', 'Reset password link sent on your email');
    }

    public function reset_password($token, $email)
    {
        $admin_data = Admin::where('email',$email)->where('token',$token)->first();
        if(!$admin_data) {
            return redirect()->route('admin_login')->with('error','Invalid token or email');
        }
        return view('admin.reset-password', compact('token','email'));
    } 

    public function reset_password_submit(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $admin_data = Admin::where('email',$request->email)->where('token',$request->token)->first();
        $admin_data->password = Hash::make($request->password);
        $admin_data->token = "";
        $admin_data->update();

        return redirect()->route('admin_login')->with('success','Password reset successfully');
    }
}