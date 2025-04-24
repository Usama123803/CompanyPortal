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
            $reviews  = Review::where('id', $id)->get();
            if($reviews->isNotEmpty()){
            	$reviews = $reviews[0];
            	$companies  = Company::where('id', $reviews->company_id)->first();
                return view('admin.editReview',compact('reviews','companies','id'));
            }else{
                return redirect()->route('admin.viewReview')->with('error','Review not exist');
            }
        } catch (\Exception $e) {
        	dd($e);
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