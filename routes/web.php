<?php

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

    Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index']);

    Route::middleware(['role:administrator'])->get('/staff', function () {

        return view('admin.staff');
    })->name('appoint-moderator');

    Route::post('/appoint-moderator', [\App\Http\Controllers\Admin\StaffController::class, 'appoint']);

    Route::middleware(['role:administrator'])->prefix("company")-> group( function () {

        Route::get('/create', function () {
            return view('admin.company.create');
        })->name('company-create');

        Route::get('/list', [\App\Http\Controllers\CompanyController::class, 'list'])->name('company-list');

        Route::get('/id/{id}', [\App\Http\Controllers\ReviewsController::class, 'list']);

        Route::post('/create', [\App\Http\Controllers\CompanyController::class, 'create_company']);

        Route::post('/delete', [\App\Http\Controllers\CompanyController::class, 'delete_company']);

        Route::post('/edit', [\App\Http\Controllers\CompanyController::class, 'edit_company']);

    });

    Route::prefix("review")->group( function () {

        Route::get('/confirmation', [\App\Http\Controllers\ReviewsController::class, 'get_unconfirmed_reviews'])->name('review-confirmation');

        Route::post('/confirm', [\App\Http\Controllers\ReviewsController::class, 'confirm_review']);

        Route::post('/delete', [\App\Http\Controllers\ReviewsController::class, 'remove_review']);

        Route::post('/edit', [\App\Http\Controllers\ReviewsController::class, 'edit_review']);

        Route::middleware(['role:administrator'])->get('/edit', function () {});
        Route::middleware(['role:administrator'])->get('/delete', function () {});
    });

});

Route::get('/company/{id}', [\App\Http\Controllers\ReviewsController::class, 'reviews']);
Route::post('/review', [\App\Http\Controllers\ReviewsController::class, 'add_review']);
