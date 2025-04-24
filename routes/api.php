<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CompanyLoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\DashboardApiController as AdminApiDashboard;
use App\Http\Controllers\Company\DashboardController as CompanyDashboard;
use App\Http\Controllers\Company\DashboardApiController as CompanyApiDashboard;

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

Route::get('getAllCompanyList', [AdminApiDashboard::class, 'getAllCompanyList']);
Route::post('getCompanyList', [AdminApiDashboard::class, 'getCompanyList']);
Route::post('addReview', [CompanyApiDashboard::class, 'addReview']);