<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;

class CompanyLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('company.auth.login');
    }

    public function login(Request $request)
    {
        Auth::guard('company')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Session::forget('user_id');
        Session::forget('Company');
        Session::forget('company_id');

        $credentials = $request->only('email', 'password');
        if (Auth::guard('company')->attempt($credentials, $request->remember)) {
            $company    = DB::table('companies')->where('email',$request->email)->first();
            $user       = DB::table('users')->where('id',$company->user_id)->first();
            Session::put('Company','companyLogin');
            Session::put('user_id', $user->id);
            Session::put('company_id', $company->id);
            Session::put('user_name', $company->name);
            return redirect()->intended(route('company.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('company')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Session::forget('user_id');
        Session::forget('Company');
        Session::forget('company_id');

        return redirect()->route('company.login');
    }
}
