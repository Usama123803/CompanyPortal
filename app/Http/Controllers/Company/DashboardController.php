<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use App\Models\Company;
use App\Models\PackageCode;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        $user_id            = Session::get('user_id');
        $company_id         = Session::get('company_id');
        $companies          = DB::table('companies')->where('user_id', $user_id)->where('id', $company_id)->first();
        $package_codes      = DB::table('package_codes')->where('user_id', $user_id)->where('company_id', $company_id)->count();
        $reviews_approve    = DB::table('reviews')->where('user_id', $user_id)->where('company_id', $company_id)->where('status', 'approve')->count();
        $reviews_pending    = DB::table('reviews')->where('user_id', $user_id)->where('company_id', $company_id)->where('status', 'pending')->count();
        return view('company.dashboard',compact('companies','package_codes','reviews_approve','reviews_pending'));
    }
}
