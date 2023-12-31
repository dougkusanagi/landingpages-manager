<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteCloneController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return inertia('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(WebsiteCloneController::class)->group(function () {
    Route::get('/website-clone', 'index')->name('website-clone');
    Route::post('/clone-landing-page', 'clone')->name('website.clone');
})->middleware(['auth', 'verified']);

Route::controller(LandingPageController::class)->group(function () {
    Route::get('/landing-page', 'index')
        ->name('landing-page.index');

    Route::get('/landing-page/{landingPage}/edit', 'edit')
        ->name('landing-page.edit');

    Route::get('/landing-page/{landingPage}/load', 'load')
        ->name('landing-page.load');

    Route::get('/landing-page/{landingPage}/upload-ftp', 'uploadFtp')
        ->name('landing-page.upload-ftp');

    Route::post('/landing-page', 'store')
        ->name('landing-page.store');

    Route::PUT('/landing-page/update/{landingPage}', 'update')
        ->name('landing-page.update');

    Route::PUT('/landing-page/update-template/{id}', 'updateTemplate')
        ->name('landing-page.update-template');
})->middleware(['auth', 'verified']);


Route::get('/landing-page-builder/{id}', function () {
    $csrf = csrf_token();
    // return inertia('Builder', ['id' => $id, '_token' => $csrf]);
    return view('LandingPage/build', [
        // 'id' => $id,
        // '_token' => $csrf
    ]);
})->name('landing-page-builder');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
