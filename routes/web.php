<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/home', function () {

    return redirect()->route('home');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['role:administrator|moderator'])->prefix('dashboard')->group( function () {

    Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('dashboard');

    Route::middleware(['role:administrator'])->get('/staff', [\App\Http\Controllers\Admin\StaffController::class, 'index'])->name('appoint-moderator');

    Route::post('/appoint-moderator', [\App\Http\Controllers\Admin\StaffController::class, 'appoint']);

    Route::middleware(['role:administrator'])->prefix("company")-> group( function () {

        Route::get('/create', function () {
            return view('admin.company.create');
        })->name('company-create');

        Route::get('/list', [\App\Http\Controllers\Admin\CompanyController::class, 'getCompanies'])->name('company-list');

        Route::get('/{id}', [\App\Http\Controllers\Admin\CompanyController::class, 'getCompanyReviews'])->name('company-reviews-list');

        Route::post('/create', [\App\Http\Controllers\Admin\CompanyController::class, 'createCompany']);

        Route::post('/delete', [\App\Http\Controllers\Admin\CompanyController::class, 'deleteCompany']);

        Route::post('/edit', [\App\Http\Controllers\Admin\CompanyController::class, 'editCompany']);

    });

    Route::prefix("review")->group( function () {

        Route::get('/confirmation', [\App\Http\Controllers\Admin\ReviewsController::class, 'getUnconfirmedReviews'])->name('review-unconfirmed');

        Route::post('/confirm', [\App\Http\Controllers\Admin\ReviewsController::class, 'confirmReview']);

        Route::post('/delete', [\App\Http\Controllers\Admin\ReviewsController::class, 'deleteReview']);

        Route::post('/edit', [\App\Http\Controllers\Admin\ReviewsController::class, 'editReview']);

    });

});

Route::get('/company/{id}', [\App\Http\Controllers\CompanyController::class, 'getCompanyReviews']);
Route::post('/review/add', [\App\Http\Controllers\ReviewsController::class, 'addReview']);
