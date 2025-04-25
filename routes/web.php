<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CompanyLoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\PackageCode\AdminPackageCodeDashboard;
use App\Http\Controllers\Admin\Company\AdminCompanyController;
use App\Http\Controllers\Admin\Review\AdminReviewController;
use App\Http\Controllers\Company\CompanyDashboardController;
use App\Http\Controllers\Company\Review\CompanyReviewController;
use App\Http\Controllers\Company\PackageCode\CompanyPackageCodeController;
use App\Http\Controllers\Contact\ContactUsController;

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
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Package Code
    Route::get('/admin/createPackageCode', [AdminPackageCodeDashboard::class, 'createPackageCode'])->name('admin.createPackageCode');
    Route::post('/admin/addPackageCode', [AdminPackageCodeDashboard::class, 'addPackageCode'])->name('admin.addPackageCode');
    Route::get('/admin/viewPackageCode', [AdminPackageCodeDashboard::class, 'viewPackageCode'])->name('admin.viewPackageCode');
    Route::get('/admin/editPackageCode/{id}', [AdminPackageCodeDashboard::class, 'editPackageCode'])->name('admin.editPackageCode');
    Route::post('/admin/updatePackageCode/{id}', [AdminPackageCodeDashboard::class, 'updatePackageCode'])->name('admin.updatePackageCode');
    Route::get('/admin/deletePackageCode/{id}', [AdminPackageCodeDashboard::class, 'deletePackageCode'])->name('admin.deletePackageCode');

    // Company
    Route::get('/admin/createCompany', [AdminCompanyController::class, 'createCompany'])->name('admin.createCompany');
    Route::post('/admin/addCompany', [AdminCompanyController::class, 'addCompany'])->name('admin.addCompany');
    Route::get('/admin/viewCompany', [AdminCompanyController::class, 'viewCompany'])->name('admin.viewCompany');
    Route::get('/admin/editCompany/{id}', [AdminCompanyController::class, 'editCompany'])->name('admin.editCompany');
    Route::post('/admin/updateCompany/{id}', [AdminCompanyController::class, 'updateCompany'])->name('admin.updateCompany');
    Route::get('/admin/deleteCompany/{id}', [AdminCompanyController::class, 'deleteCompany'])->name('admin.deleteCompany');
    
    // Review
    Route::get('admin/viewReview/{status?}', [AdminReviewController::class, 'viewReview'])->name('admin.viewReview');
    Route::get('admin/editReview/{id}', [AdminReviewController::class, 'editReview'])->name('admin.editReview');
    Route::post('admin/updateReview/{id}', [AdminReviewController::class, 'updateReview'])->name('admin.updateReview');
    Route::get('admin/deleteReview/{id}', [AdminReviewController::class, 'deleteReview'])->name('admin.deleteReview');
    Route::get('admin/approve/{id}', [AdminReviewController::class, 'approve']);
    Route::get('admin/pending/{id}', [AdminReviewController::class, 'pending']);

    // Conatct
    Route::get('admin/viewContactUsDetails', [ContactUsController::class, 'viewContactUsDetails'])->name('admin.viewContactUsDetails');
});

// Company routes
Route::prefix('company')->group(function () {
    Route::get('/login', [CompanyLoginController::class, 'showLoginForm'])->name('company.login');
    Route::post('/login', [CompanyLoginController::class, 'login']);
    
    Route::middleware('auth:company')->group(function () {
        Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('company.dashboard');
        Route::post('/logout', [CompanyLoginController::class, 'logout'])->name('company.logout');

        // Package Code
        Route::get('/createPackageCode', [CompanyPackageCodeController::class, 'createPackageCode'])->name('company.createPackageCode');
        Route::post('/addPackageCode', [CompanyPackageCodeController::class, 'addPackageCode'])->name('company.addPackageCode');
        Route::get('/viewPackageCode', [CompanyPackageCodeController::class, 'viewPackageCode'])->name('company.viewPackageCode');
        Route::get('/editPackageCode/{id}', [CompanyPackageCodeController::class, 'editPackageCode'])->name('company.editPackageCode');
        Route::post('/updatePackageCode/{id}', [CompanyPackageCodeController::class, 'updatePackageCode'])->name('company.updatePackageCode');
        Route::get('/deletePackageCode/{id}', [CompanyPackageCodeController::class, 'deletePackageCode'])->name('company.deletePackageCode');
        
        // Review
        Route::get('/createReview', [CompanyReviewController::class, 'createReview'])->name('company.createReview');
        Route::get('/viewReview/{status?}', [CompanyReviewController::class, 'viewReview'])->name('company.viewReview');
    });
});

require __DIR__.'/auth.php';