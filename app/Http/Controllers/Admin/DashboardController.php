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

class DashboardController extends Controller
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

    // Company
    public function createCompany(Request $request){
        return view('admin.createCompany');
    }

    public function addCompany(Request $request){
        $request->validate([
            'email'       => 'required|string|email|unique:companies,email|max:255',
            'password'    => 'required|string|max:255',
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        
        try {
            $user_id            = Session::get('user_id');
            $data               = DB::table('companies')->insertGetId([
                'user_id'       => $user_id,
                'email'         => $request->email,
                'password'      => Hash::make($request->password),
                'name'          => $request->name,
                'description'   => $request->description,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            if($data){
                return redirect()->route('admin.viewCompany')->with('success','Company added successfully');
            }else{
                return redirect()->route('admin.createCompany')->with('error','Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.createCompany')->with('error','Something went wrong');            
        }
    }

    public function viewCompany(Request $request){
        try {
            $user_id    = Session::get('user_id');
            $companies  = Company::where('companies.user_id', $user_id)->with('packageCodes')->with('reviews')->get();
            if($companies->isNotEmpty()){
                return view('admin.viewCompany',compact('companies'));
            }else{
                return redirect()->route('admin.dashboard')->with('error','Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')->with('error','Something went wrong');            
        }
    }

    public function editCompany($id){
        try {
            $companies  = Company::where('companies.id', $id)->with('packageCodes')->with('reviews')->get();
            if($companies->isNotEmpty()){
                $companies = $companies[0];
                return view('admin.editCompany',compact('companies', 'id'));
            }else{
                return redirect()->route('admin.viewCompany')->with('error','Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.viewCompany')->with('error','Something went wrong');            
        }
    }

    public function updateCompany(Request $request, $id){
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        
        try {
            $user_id            = Session::get('user_id');
            $data               = DB::table('companies')->where('id', $id)->update([
                'name'          => $request->name,
                'description'   => $request->description,
                'updated_at'    => now(),
            ]);

            if($data){
                return redirect()->route('admin.viewCompany')->with('success','Company updated successfully');
            }else{
                return redirect()->route('admin.createCompany')->with('error','Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.createCompany')->with('error','Something went wrong');            
        }
    }

    public function deleteCompany($id){
        try {
            $companies  = Company::where('companies.id', $id)->with('packageCodes')->with('reviews')->get();
            if($companies->isNotEmpty()){
                if($companies[0]->packageCodes->isNotEmpty()){
                    return redirect()->route('admin.viewCompany')->with('error','Package Codes Exist');
                }

                if($companies[0]->reviews->isNotEmpty()){
                    return redirect()->route('admin.viewCompany')->with('error','Reviews Exist');
                }

                Company::where('id', $id)->delete();
                return redirect()->route('admin.viewCompany')->with('success','Company deleted successfully');
            }else{
                return redirect()->route('admin.viewCompany')->with('error','Company not exist');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.viewCompany')->with('error','Something went wrong');            
        }
    }
}