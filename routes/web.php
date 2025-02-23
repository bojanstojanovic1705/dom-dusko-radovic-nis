<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\Admin\LoginController;

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

// Preusmeravamo osnovnu rutu na našu home stranicu
Route::get('/', [HomeController::class, 'index'])->name('home');

// O nama ruta
Route::get('/o-nama', function () {
    return view('about.index');
})->name('about.index');

// O nama rute
Route::get('/o-nama/ko-smo-mi', [AboutController::class, 'who'])->name('about.who');
Route::get('/o-nama/zaposleni', [AboutController::class, 'employees'])->name('about.employees');
Route::get('/o-nama/istorijat', [AboutController::class, 'history'])->name('about.history');

// Dokumenta rute
Route::get('/dokumenta', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/dokumenta/godisnji-izvestaji', [DocumentController::class, 'reports'])->name('documents.reports');
Route::get('/dokumenta/javne-nabavke', [DocumentController::class, 'procurement'])->name('documents.procurement');

// Vesti rute
Route::get('/vesti', [NewsController::class, 'index'])->name('news.index');
Route::get('/vesti/{news}', [NewsController::class, 'show'])->name('news.show');
Route::get('/vesti/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/vest/{slug}', [NewsController::class, 'show'])->name('news.show');

// Kontakt ruta
Route::get('/kontakt', [ContactController::class, 'index'])->name('contact');
Route::post('/kontakt', [ContactController::class, 'send'])->name('contact.send');

// Newsletter ruta
Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Legal rute
Route::get('/pravila-privatnosti', [LegalController::class, 'privacy'])->name('legal.privacy');
Route::get('/uslovi-koriscenja', [LegalController::class, 'terms'])->name('legal.terms');

// Admin rute
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth rute
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login']);
    });
    
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout')
        ->middleware('auth:admin');

    // Protected admin rute
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Rute za upravljanje dokumentima
        Route::resource('documents', \App\Http\Controllers\Admin\DocumentController::class);
        
        // Rute za upravljanje vestima
        Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
    });
});
