<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Session;
use concat;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use App\Models\Company;
use App\Models\PackageCode;

class AdminCompanyController extends Controller
{
    // Company
    public function createCompany(Request $request){
        return view('admin.company.createCompany');
    }

    public function addCompany(Request $request){
        $request->validate([
            'email'             => 'required|string|email|unique:companies,email|max:255',
            'password'          => 'required|string|max:255',
            'name'              => 'required|string|max:255',
            'description'       => 'required',
            // 'companylogo'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        
        try {
            $user_id            = Session::get('user_id');
            $slug               = Str::slug($request->name);
            if (DB::table('companies')->where('slug', $slug)->exists()) {
                return redirect()->route('admin.createCompany')->with('error', 'Company already exist');
            }

            // Handle image upload
            if ($request->hasFile('companylogo')) {
                $file       = $request->file('companylogo');
                $filename   = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path       = public_path('uploads/company_logos/');

                // Create directory if it doesn't exist
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0755, true);
                }

                $file->move($path, $filename);
            }

            $data               = DB::table('companies')->insertGetId([
                'user_id'       => $user_id,
                'email'         => $request->email,
                'password'      => Hash::make($request->password),
                'name'          => $request->name,
                'slug'          => $slug,
                'description'   => $request->description,
                'companylogo'   => $filename ?? null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            if($data){
                return redirect()->route('admin.viewCompany')->with('success','Company added successfully');
            }else{
                return redirect()->route('admin.createCompany')->with('error','Something went wrong');
            }
        } catch (\Exception $e) {
            // dd($e);
            return redirect()->route('admin.createCompany')->with('error','Something went wrong');            
        }
    }

    public function viewCompany(Request $request){
        try {
            $user_id    = Session::get('user_id');
            $companies  = Company::where('companies.user_id', $user_id)->with('packageCodes')->with('reviews')->get();
            return view('admin.company.viewCompany',compact('companies'));
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')->with('error','Something went wrong');
        }
    }

    public function editCompany($id){
        try {
            $companies  = Company::where('companies.id', $id)->with('packageCodes')->with('reviews')->get();
            if($companies->isNotEmpty()){
                $companies = $companies[0];
                return view('admin.company.editCompany',compact('companies', 'id'));
            }else{
                return redirect()->route('admin.viewCompany')->with('error','Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.viewCompany')->with('error','Something went wrong');            
        }
    }

    public function updateCompany(Request $request, $id){
        $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'required',
        ]);
        
        try {
            $user_id            = Session::get('user_id');
            $slug               = Str::slug($request->name);
            if (DB::table('companies')->where('id', '!=', $id)->where('slug', $slug)->exists()) {
                return redirect()->route('admin.viewCompany')->with('error', 'Company already exist');
            }

            // Handle image upload
            if ($request->hasFile('companylogo')) {
                $file       = $request->file('companylogo');
                $filename   = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path       = public_path('uploads/company_logos/');

                // Create directory if it doesn't exist
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0755, true);
                }

                $file->move($path, $filename);
            }else{
                $filename      = $request->companylogoelse;
            }

            $data               = DB::table('companies')->where('id', $id)->update([
                'name'          => $request->name,
                'slug'          => $slug,
                'description'   => $request->description,
                'companylogo'   => $filename ?? null,
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