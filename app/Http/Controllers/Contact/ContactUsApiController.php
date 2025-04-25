<?php

namespace App\Http\Controllers\Contact;

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
use App\Models\ContactUs;
use Illuminate\Validation\Rule;

class ContactUsApiController extends Controller
{
	public function addContactUsDetails(Request $request){
        $request->validate([
            'name'                 => 'required|string|max:255',
            'email'                => 'required|string|max:255',
            'subject'              => 'required|string|max:255',
            'message'              => 'required',
        ]);        
        try {
            $data                  	= DB::table('contactus')->insertGetId([
                'name'        		=> $request->name,
                'email'            	=> $request->email,
                'subject'        	=> $request->subject,
                'message'           => $request->message,
                'created_at'       	=> now(),
                'updated_at'       	=> now(),
            ]);

            return response()->json([
                'success'   => true,
                'message'   => 'Your request has been submitted successfully. Our team will contact you within 24 hours.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success'   => false,
                'message'   => 'Something went wrong.',
                'error'     => $e->getMessage(),
            ], 500);
        }
    }
}