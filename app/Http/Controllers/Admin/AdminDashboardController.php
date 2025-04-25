<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Session;
use concat;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Models\PackageCode;
use Illuminate\Validation\Rule;

class AdminDashboardController extends Controller
{
    public function index()
    {
        try {
            $user_id            = Session::get('user_id');
            $companies          = DB::table('companies')->where('user_id', $user_id)->count();
            $package_codes      = DB::table('package_codes')->where('user_id', $user_id)->count();
            $reviews_approve    = DB::table('reviews')->where('user_id', $user_id)->where('status', 'approve')->count();
            $reviews_pending    = DB::table('reviews')->where('user_id', $user_id)->where('status', 'pending')->count();
            return view('admin.dashboard',compact('companies','package_codes','reviews_approve','reviews_pending'));
        } catch (\Exception $e) {
            return redirect()->route('/')->with('error','Something went wrong');            
        }
    }
}