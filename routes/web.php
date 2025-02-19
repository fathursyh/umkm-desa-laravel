<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\AdminSubmissionController;
use App\Http\Controllers\NewsController;
use App\Models\News;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\ProductsController;

Route::get('/', function () {
    $latestNews = News::latest()->take(5)->get();

    return view('welcome', compact('latestNews'));
})->name('home');


Route::get('/tentang', [PresentationController::class, 'tentang'])->name('tentang');
Route::get('/umkm', [PresentationController::class, 'umkm'])->name('umkm');
Route::get('/staff', [PresentationController::class, 'staff'])->name('staff');
Route::get('/kontak', [PresentationController::class, 'kontak'])->name('kontak');
Route::get('/productview/{id}', [PresentationController::class,'productview'])->name('umkm.lihat');

// news
// Public routes for news
Route::get('/news', [NewsController::class, 'listNews'])->name('news.list');
Route::get('/news/{news:slug}', [NewsController::class, 'showUser'])->name('news.user.show');
Route::get('/news/load-more', [NewsController::class, 'loadMore'])->name('news.load-more');


Route::group(['prefix' => 'account'], function () {
    // Guest routes
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [LoginController::class, 'index'])->name('account.login');
        Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
    });

    // Authenticated routes
    Route::group(['middleware' => 'auth'], function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('account.logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('account.dashboard');

        // UMKM Submission Routes
        Route::resource('submissions', SubmissionController::class);
        Route::resource('products', ProductsController::class)->names([
            'index' => 'products.index',
            'create' => 'products.create',
            'store' => 'products.store',
            'show' => 'products.show',
            'edit' => 'products.edit',
            'update' => 'products.update',
            'destroy' => 'products.destroy',
        ]);

        // Admin routes
        Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
            Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm.index');
            Route::get('/umkm/{id}', [UmkmController::class, 'show'])->name('umkm.show');
            Route::post('/umkm/{id}/approve', [UmkmController::class, 'approve'])->name('umkm.approve');
            Route::post('/umkm/{id}/reject', [UmkmController::class, 'reject'])->name('umkm.reject');

            // Route::resource('admin/news', NewsController::class)->except(['show']);
            Route::resource('news', NewsController::class);
            // Submission routes
            Route::get('/submissions', [AdminSubmissionController::class, 'index'])->name('submissions.index');
            Route::get('/submissions/{submission}', [AdminSubmissionController::class, 'show'])->name('submissions.show');
            Route::post('/submissions/{submission}/approve', [AdminSubmissionController::class, 'approve'])->name('submissions.approve');
            Route::post('/submissions/{submission}/reject', [AdminSubmissionController::class, 'reject'])->name('submissions.reject');
            Route::post('/submissions/{submission}/revision', [AdminSubmissionController::class, 'requestRevision'])->name('submissions.revision');
        });
    });
});

Route::middleware(['guest'])->group(function () {
    Route::get('register/step1', [RegistrationController::class, 'step1'])->name('register.step1');
    Route::post('register/step1', [RegistrationController::class, 'storeStep1'])->name('register.step1.store');

    Route::get('register/step2', [RegistrationController::class, 'step2'])
        ->middleware('registration.step:2')
        ->name('register.step2');
    Route::post('register/step2', [RegistrationController::class, 'storeStep2'])
        ->middleware('registration.step:2')
        ->name('register.step2.store');

    Route::get('register/step3', [RegistrationController::class, 'step3'])
        ->middleware('registration.step:3')
        ->name('register.step3');
    Route::post('register/step3', [RegistrationController::class, 'storeStep3'])
        ->middleware('registration.step:3')
        ->name('register.step3.store');

    Route::get('register/step4', [RegistrationController::class, 'step4'])
        ->middleware('registration.step:4')
        ->name('register.step4');
    Route::post('register/step4', [RegistrationController::class, 'storeStep4'])
        ->middleware('registration.step:4')
        ->name('register.step4.store');
});
