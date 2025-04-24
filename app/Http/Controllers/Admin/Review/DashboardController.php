<?php

namespace App\Http\Controllers\Admin\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Session;
use concat;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Models\PackageCode;
use App\Models\Review;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
	// Review
    public function viewReview(Request $request, $status = NULL){
        try {
            $user_id = Session::get('user_id');
            if($status != NULL){
                $reviews = DB::table('reviews')->where('user_id',$user_id)->where('status',$status)->get();
            }else{
                $reviews = DB::table('reviews')->where('user_id',$user_id)->get();
            }

            if($reviews->isNotEmpty()){
                return view('admin.viewReview',compact('reviews'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')->with('error','Something went wrong');            
        }
    }

    public function editReview($id){
        try {
            $reviews           = Review::where('id', $id)->get();
            if($reviews->isNotEmpty()){
            	$reviews       = $reviews[0];
            	$companies     = Company::where('id', $reviews->company_id)->first();
                $package_codes = PackageCode::where('id', $reviews->packagecode_id)->get();
                return view('admin.editReview',compact('reviews','companies','package_codes','id'));
            }else{
                return redirect()->route('admin.viewReview')->with('error','Review not exist');
            }
        } catch (\Exception $e) {
        	dd($e);
            return redirect()->route('admin.viewReview')->with('error','Something went wrong');            
        }
    }

    public function updateReview(Request $request, $id){
        $request->validate([
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
            $data                               = DB::table('reviews')->where('id', $id)->update([
                'nusuk_booking_no'              => $request->nusuk_booking_no,
                'guide_name'                    => $request->guide_name,
                'accommodation'                 => $request->accommodation,
                'transportation'                => $request->transportation,
                'meal'                          => $request->meal,
                'guide_support_booking_process' => $request->guide_support_booking_process,
                'guide_support_hajj'            => $request->guide_support_hajj,
                'experience'                    => $request->experience,
                'updated_at'                    => now(),
            ]);

            if($data){
                return redirect()->route('admin.viewReview')->with('success','Review updated successfully');
            }else{
                return redirect()->route('admin.viewReview')->with('error','Something went wrong');
            }
        } catch (\Exception $e) {
            // dd($e);
            return redirect()->route('admin.viewReview')->with('error','Something went wrong');
        }
    }

    public function deleteReview($id){
        try {
            $reviews  = Review::where('id', $id)->get();
            if($reviews->isNotEmpty()){
                Review::where('id', $id)->delete();
                return redirect()->route('admin.viewReview')->with('success','Review deleted successfully');
            }else{
                return redirect()->route('admin.viewReview')->with('error','Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.viewReview')->with('error','Something went wrong');            
        }
    }

    public function approve($id){
        try {
            $user_id    = Session::get('user_id');
            $companies  = DB::table('reviews')->where('user_id',$user_id)->where('id',$id)->update(['status' => 'approve']);
            return redirect()->route('admin.viewReview')->with('success','Status updated successfully');            
        } catch (\Exception $e) {
            return redirect()->route('admin.viewReview')->with('error','Something went wrong');            
        }
    }

    public function pending($id){
        try {
            $user_id    = Session::get('user_id');
            $companies  = DB::table('reviews')->where('user_id',$user_id)->where('id',$id)->update(['status' => 'pending']);
            return redirect()->route('admin.viewReview')->with('success','Status updated successfully');            
        } catch (\Exception $e) {
            return redirect()->route('admin.viewReview')->with('error','Something went wrong');            
        }
    }
}