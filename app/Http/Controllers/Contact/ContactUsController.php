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

class ContactUsController extends Controller
{
	public function viewContactUsDetails(Request $request){            
        try {
            $data = ContactUs::get();
            return view('admin.contactus.viewContactUsDetails',compact('data'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('admin.dashboard')->with('error','Something went wrong');
        }
    }
}