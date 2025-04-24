<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CompanyLoginController;
use App\Http\Controllers\Admin\PackageCode\DashboardController as PackageCodeDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Company\DashboardController as CompanyDashboard;
use App\Http\Controllers\Admin\Review\DashboardController as ReviewDashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminDashboard::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');

    // Package Code
    Route::get('/admin/createPackageCode', [PackageCodeDashboard::class, 'createPackageCode'])->name('admin.createPackageCode');
    Route::post('/admin/addPackageCode', [PackageCodeDashboard::class, 'addPackageCode'])->name('admin.addPackageCode');
    Route::get('/admin/viewPackageCode', [PackageCodeDashboard::class, 'viewPackageCode'])->name('admin.viewPackageCode');
    Route::get('/admin/editPackageCode/{id}', [PackageCodeDashboard::class, 'editPackageCode'])->name('admin.editPackageCode');
    Route::post('/admin/updatePackageCode/{id}', [PackageCodeDashboard::class, 'updatePackageCode'])->name('admin.updatePackageCode');
    Route::get('/admin/deletePackageCode/{id}', [PackageCodeDashboard::class, 'deletePackageCode'])->name('admin.deletePackageCode');

    // Company
    Route::get('/admin/createCompany', [AdminDashboard::class, 'createCompany'])->name('admin.createCompany');
    Route::post('/admin/addCompany', [AdminDashboard::class, 'addCompany'])->name('admin.addCompany');
    Route::get('/admin/viewCompany', [AdminDashboard::class, 'viewCompany'])->name('admin.viewCompany');
    Route::get('/admin/editCompany/{id}', [AdminDashboard::class, 'editCompany'])->name('admin.editCompany');
    Route::post('/admin/updateCompany/{id}', [AdminDashboard::class, 'updateCompany'])->name('admin.updateCompany');
    Route::get('/admin/deleteCompany/{id}', [AdminDashboard::class, 'deleteCompany'])->name('admin.deleteCompany');
    
    // Review
    Route::get('admin/viewReview/{status?}', [ReviewDashboard::class, 'viewReview'])->name('admin.viewReview');
    Route::get('admin/editReview/{id}', [ReviewDashboard::class, 'editReview'])->name('admin.editReview');
    Route::get('admin/updateReview/{id}', [ReviewDashboard::class, 'updateReview'])->name('admin.updateReview');
    Route::get('admin/deleteReview/{id}', [ReviewDashboard::class, 'deleteReview'])->name('admin.deleteReview');
    Route::get('admin/approve/{id}', [ReviewDashboard::class, 'approve']);
    Route::get('admin/pending/{id}', [ReviewDashboard::class, 'pending']);
});

// Company routes
Route::prefix('company')->group(function () {
    Route::get('/login', [CompanyLoginController::class, 'showLoginForm'])->name('company.login');
    Route::post('/login', [CompanyLoginController::class, 'login']);
    
    Route::middleware('auth:company')->group(function () {
        Route::get('/dashboard', [CompanyDashboard::class, 'index'])->name('company.dashboard');
        Route::post('/logout', [CompanyLoginController::class, 'logout'])->name('company.logout');

        // Package Code
        Route::get('/viewPackageCode', [CompanyDashboard::class, 'viewPackageCode'])->name('company.viewPackageCode');
        
        // Review
        Route::get('/createReview', [CompanyDashboard::class, 'createReview'])->name('company.createReview');
        Route::get('/viewReview/{status?}', [CompanyDashboard::class, 'viewReview'])->name('company.viewReview');
    });
});

require __DIR__.'/auth.php';