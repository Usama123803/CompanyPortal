<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;

class DashboardApiController extends Controller
{
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
            'experience'                        => 'required|string|max:255',
        ]);
        
        try {
            $company                            = DB::table('companies')->where('id', $request->company_id)->first();
            $package_codes                      = DB::table('package_codes')->where('id', $request->package_code)->first();
            $data                               = DB::table('reviews')->insertGetId([
                'user_id'                       => $company->user_id,
                'company_id'                    => $request->company_id,
                'packagecode_id'                => $request->package_code,
                'user_name'                     => $request->user_name,
                'email'                         => $request->email,
                'contact_no'                    => $request->contact_no,
                'package_code'                  => $package_codes->code,
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

            return response()->json([
                'success'   => true,
                'message'   => 'Reviews added successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success'   => false,
                'message'   => 'Failed to add reviews.',
                'error'     => $e->getMessage(),
            ], 500);
        }
    }
}