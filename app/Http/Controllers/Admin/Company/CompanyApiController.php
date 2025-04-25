<?php

namespace App\Http\Controllers\Admin\Company;

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

class CompanyApiController extends Controller
{
    public function getAllCompanyList(Request $request){
        try {
            $companies = Company::with('packageCodes')
                            ->with(['reviews' => function($query) {
                                $query->where('status', 'approve')
                                ->orderBy('id', 'desc');
                            }])->get();
            return response()->json([
                'success'   => true,
                'data'      => $companies,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success'   => false,
                'message'   => 'Failed to retrieve companies.',
                'error'     => $e->getMessage(),
            ], 500);
        }
    }

    public function getCompanyList(Request $request){
        try {
            $data = Company::where('companies.slug', $request->slug)->with('packageCodes')
                        ->with(['reviews' => function($query) {
                            $query->where('status', 'approve')
                            ->orderBy('id', 'desc');;
                        }])
                        ->first();
            return response()->json([
                'success'   => true,
                'data'      => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success'   => false,
                'message'   => 'Failed to retrieve companies.',
                'error'     => $e->getMessage(),
            ], 500);
        }
    }
}