<?php

namespace App\Http\Controllers\web;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Mail\web\ForgetPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\web\loginRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\web\registerRequest;
use App\Http\Requests\web\resetPasswordRequest;
use App\Http\Requests\web\forgetPasswordRequest;

class AuthController extends Controller
{
    // login
    public function loginView()
    {
        return view('web.auth.login');
    }
    public function loginMethod(loginRequest $request)
    {
        $data = $request->validated();
        if (Auth::attempt($data)) {
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'errors' => 'invalid email or password'
        ])->withInput();
    }
    // register
    public function registerView()
    {
        return view('web.auth.register');
    }
    public function registerMethod(registerRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        $user_role = Role::where('name', 'user_role_web')->first();
        if ($user_role) {
            $user->assignRole($user_role);
        }
        return redirect()->route('home');
    }
    // forget
    public function forgetPasswordView()
    {
        return view('web.auth.forget');
    }
    public function forgetPasswordMethod(forgetPasswordRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();
        if ($user) {
            $token = sha1(uniqid(mt_rand(), true));
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $user->email],
                ['token' => $token, 'created_at' => now()]
            );
            $resetLink = URL::temporarySignedRoute(
                'reset',
                now()->addMinutes(10),
                ['token' => $token]
            );
            Mail::to($user->email)->send(new ForgetPasswordMail($resetLink));
            return back()->with('success', 'Email sent successfully.');
        } else {
            return back()->withErrors(['email' => 'Email address not found.']);
        }
    }
    // reset
    public function resetPasswordView($token)
    {
        return view('web.auth.reset', ['token' => $token]);
    }
    public function resetPasswordMethod(resetPasswordRequest $request)
    {
        $data = $request->validated();
        $user = DB::table('password_reset_tokens')->where('token', $data['token'])->first();
        if ($user) {
            User::where('email', $user->email)
                ->update(['password' => Hash::make($data['password'])]);
            DB::table('password_reset_tokens')->where('token', $data['token'])->delete();
            return redirect()->route('login')->with('success', 'Password reset successfully.');
        }
        return back()->withErrors(['token' => 'Invalid token.']);
    }
    // logout
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
