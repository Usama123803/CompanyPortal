<?php

namespace App\Http\Controllers\Company\PackageCode;

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

class CompanyPackageCodeController extends Controller
{
    public function createPackageCode(Request $request){
        try {
            $user_id    = Session::get('user_id');
            $company_id = Session::get('company_id');
            $companies  = DB::table('companies')->where('user_id',$user_id)->where('id',$company_id)->first();

            if($companies){
                return view('company.packagecode.createPackageCode',compact('companies'));
            }else{
                return redirect()->route('company.dashboard')->with('error','Something went wrong');
            }
        } catch (\Exception $e) {
            // dd($e);
            return redirect()->route('company.dashboard')->with('error','Something went wrong');            
        }
    }

    public function addPackageCode(Request $request){
        $request->validate([
            'company_id'        => 'required|max:255',
            'code'              => 'required|max:255',
            'type'              => 'required|string|max:255',
            'start_date'        => 'required|string|max:255',
            'end_date'          => 'required|string|max:255',
        ]);
        
        try {
            $user_id            = Session::get('user_id');
            $data               = DB::table('package_codes')->insertGetId([
                'user_id'       => $user_id,
                'company_id'    => $request->company_id,
                'code'          => $request->code,
                'type'          => $request->type,
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            if($data){
                return redirect()->route('company.viewPackageCode')->with('success','Package Code added successfully');
            }else{
                return redirect()->route('company.createPackageCode')->with('error','Something went wrong');
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('company.createPackageCode')->with('error','Something went wrong');            
        }
    }

    public function viewPackageCode(Request $request){
        try {
            $user_id        = Session::get('user_id');
            $company_id     = Session::get('company_id');
            $package_codes  = PackageCode::where('package_codes.user_id', $user_id)
                                ->where('package_codes.company_id',$company_id)
                                ->with(['company' => function($query) use ($company_id) {
                                    $query->where('id', $company_id);
                                }])->with('reviews')->get();
            if($package_codes){
                return view('company.packagecode.viewPackageCode',compact('package_codes'));
            }else{
                return redirect()->route('company.dashboard')->with('error','Something went wrong');
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('company.dashboard')->with('error','Something went wrong');            
        }
    }

    public function editPackageCode($id){
        try {
            $user_id            = Session::get('user_id');
            $company_id         = Session::get('company_id');
            $companies          = DB::table('companies')->where('id',$company_id)->first();
            $package_codes      = PackageCode::where('package_codes.id', $id)->with('company')->with('reviews')->get();
            if($package_codes->isNotEmpty()){
                $package_codes  = $package_codes[0];
                return view('company.packagecode.editPackageCode',compact('companies','package_codes', 'id'));
            }else{
                return redirect()->route('company.viewPackageCode')->with('error','Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->route('company.viewPackageCode')->with('error','Something went wrong');            
        }
    }

    public function updatePackageCode(Request $request, $id){
        $request->validate([
            'code'              => 'required|max:255',
            'type'              => 'required|string|max:255',
            'start_date'        => 'required|string|max:255',
            'end_date'          => 'required|string|max:255',
        ]);
        
        try {
            $data               = DB::table('package_codes')->where('id', $id)->update([
                'code'          => $request->code,
                'type'          => $request->type,
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
                'updated_at'    => now(),
            ]);

            if($data){
                return redirect()->route('company.viewPackageCode')->with('success','Package Code updated successfully');
            }else{
                return redirect()->route('company.createPackageCode')->with('error','Something went wrong');
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('company.createPackageCode')->with('error','Something went wrong');            
        }
    }

    public function deletePackageCode($id){
        try {
            $package_codes  = PackageCode::where('package_codes.id', $id)->with('company')->with('reviews')->get();
            if($package_codes->isNotEmpty()){                
                if($package_codes[0]->reviews->isNotEmpty()){
                    return redirect()->route('company.viewPackageCode')->with('error','Reviews Exist');
                }

                PackageCode::where('id', $id)->delete();
                return redirect()->route('company.viewPackageCode')->with('success','Package Code deleted successfully');
            }else{
                return redirect()->route('company.viewPackageCode')->with('error','Package Code not exist');
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('company.viewPackageCode')->with('error','Something went wrong');            
        }
    }
}