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

    public function viewPackageCode(Request $request){
        try {
            $user_id        = Session::get('user_id');
            $company_id     = Session::get('company_id');
            // $package_codes  = DB::table('package_codes')
            //                     ->where('package_codes.user_id',$user_id)
            //                     ->where('package_codes.company_id',$company_id)
            //                     ->join('companies','package_codes.company_id','companies.id')
            //                     ->select('package_codes.*','companies.name')
            //                     ->get();
            $package_codes  = PackageCode::where('package_codes.user_id', $user_id)->where('package_codes.company_id',$company_id)->with('company')->with('reviews')->get();
            if($package_codes){
                return view('admin.viewPackageCode',compact('package_codes'));
            }else{
                return redirect()->route('company.dashboard')->with('error','Something went wrong');
            }
        } catch (\Exception $e) {
            // dd($e);
            return redirect()->route('company.dashboard')->with('error','Something went wrong');            
        }
    }

    public function createReview(Request $request)
    {
        return view('company.createReview');
    }

    public function viewReview(Request $request, $status = NULL){
        try {
            $company_id = Session::get('company_id');

            if($status != NULL){
                $reviews    = DB::table('reviews')->where('company_id',$company_id)->where('status', $status)->get();
            }else{
                $reviews    = DB::table('reviews')->where('company_id',$company_id)->get();
            }

            if($reviews){
                return view('company.viewReview',compact('reviews'));
            }else{
                return redirect()->route('company.dashboard')->with('error','Something went wrong');
            }
        } catch (\Exception $e) {
            // dd($e);
            return redirect()->route('company.dashboard')->with('error','Something went wrong');            
        }
    }

    public function addReview(Request $request){
        $request->validate([
            'user_name'                         => 'required|string|max:255',
            'email'                             => 'required|string|max:255',
            'contact_no'                        => 'required|string|max:255',
            'package_code'                      => 'required|string|max:255',
            'nusuk_booking_no'                  => 'required|string|max:255',
            'guide_name'                        => 'required|string|max:255',
            'accommodation'                     => 'required|max:255',
            'transportation'                    => 'required|max:255',
            'meal'                              => 'required|max:255',
            'guide_support_booking_process'     => 'required|max:255',
            'guide_support_hajj'                => 'required|max:255',
            'experience'                        => 'required',
        ]);
        
        try {
            $company_id                         = Session::get('company_id');
            $data                               = DB::table('reviews')->insertGetId([
                'company_id'                    => $company_id,
                'user_name'                     => $request->user_name,
                'email'                         => $request->email,
                'contact_no'                    => $request->contact_no,
                'package_code'                  => $request->package_code,
                'nusuk_booking_no'              => $request->nusuk_booking_no,
                'guide_name'                    => $request->guide_name,
                'accommodation'                 => $request->accommodation,
                'transportation'                => $request->transportation,
                'meal'                          => $request->meal,
                'guide_support_booking_process' => $request->guide_support_booking_process,
                'guide_support_hajj'            => $request->guide_support_hajj,
                'experience'                    => $request->experience,
                'created_at'                    => now(),
                'updated_at'                    => now(),
            ]);

            // dd($data);

            if($data){
                return redirect()->route('company.createReview')->with('success','Company added successfully');
            }else{
                return redirect()->route('company.createReview')->with('error','Something went wrong');
            }
        } catch (\Exception $e) {
            // dd($e);
            return redirect()->route('company.createReview')->with('error','Something went wrong');            
        }
    }
}
