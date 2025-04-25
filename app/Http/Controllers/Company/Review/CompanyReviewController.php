<?php

namespace App\Http\Controllers\Company\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use App\Models\Company;
use App\Models\PackageCode;
use App\Models\Review;

class CompanyReviewController extends Controller
{
    public function createReview(Request $request)
    {
        return view('company.review.createReview');
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
