<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CompanyLoginController;
use App\Http\Controllers\Admin\Company\CompanyApiController;
use App\Http\Controllers\Company\Review\ReviewApiController;
use App\Http\Controllers\Contact\ContactUsApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getAllCompanyList', [CompanyApiController::class, 'getAllCompanyList']);
Route::post('getCompanyList', [CompanyApiController::class, 'getCompanyList']);
Route::post('addReview', [ReviewApiController::class, 'addReview']);

Route::post('addContactUsDetails', [ContactUsApiController::class, 'addContactUsDetails']);