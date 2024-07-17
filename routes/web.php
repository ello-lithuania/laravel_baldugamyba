<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProviderController;
use App\Models\Provider;
use App\Models\Category;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Models\Gallery;
use App\Http\Controllers\ClientRequestsController;
use App\Mail\ClientRequestCreated;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

Route::get('/', function () {
    $providers = Provider::latest()->orderBy('upgrade', 'desc')->paginate(8);
    $categories = Category::all();
    $now = Carbon::now();
    return view('welcome', compact('providers','categories','now'));
})->name('welcome');

Route::get('/test', function () {
    Mail::to('xinterx1@gmail.com')->send(new TestEmail());
    return 'Test email sent successfully!';
});

Route::get('/kontaktai', function () {
    return view('contacts');
})->name('contacts');

Route::get('/naudojimo-taisykles', function () {
    return view('privacy');
})->name('privacy');

Route::get('/dashboard', function () {
    $galleries = null;
    if(auth()->user()->provider_profile) {
        $galleries = Gallery::where('provider_id', auth()->user()->provider_profile->id)->with('images')->get();
    }
    $now = Carbon::now();
    return view('dashboard',compact('galleries','now'));
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/preview-email', function () {
    //$client = App\Models\ClientRequest::find(1); // Replace with actual order retrieval logic
    //return new ClientRequestCreated($client);
//});

Route::get('/prisijungti', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/prisijungti', [LoginController::class, 'login'])->name('login_now');
Route::post('/atsijungti', [LoginController::class, 'logout'])->name('logout');

Route::get('/sukurti-uzklausa', [ClientRequestsController::class, 'create'])->name('requests.create');
Route::post('/sukurti-uzklausa', [ClientRequestsController::class, 'store'])->name('requests.store');
Route::get('/rodyti-uzklausas', [ClientRequestsController::class, 'show'])->name('requests.show');
Route::get('/redaguoti-uzklausa/{client}', [ClientRequestsController::class, 'edit'])->name('requests.edit');
Route::post('/redaguoti-uzklausa/{client}', [ClientRequestsController::class, 'update'])->name('requests.update');
Route::delete('/istrinti-uzklausa/{client}', [ClientRequestsController::class, 'destroy'])->name('requests.destroy');

Route::get('/registruotis', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/registruotis', [RegisterController::class, 'register'])->name('register2');

Route::get('/uzregistruoti-veikla', [ProviderController::class, 'index'])->name('provider.register');
Route::post('/uzregistruoti-veikla', [ProviderController::class, 'store'])->name('provider.create');
Route::get('/redaguoti-profili', [ProviderController::class, 'edit'])->name('provider.edit');
Route::get('/prideti-kreditu', [ProviderController::class, 'creditAdd'])->name('provider.creditAdd');
Route::get('/patvirtinti-uzsakyma/{id}', [ProviderController::class, 'orderDone'])->name('order-accept');
Route::get('/patvirtinti-uzsakyma', [ProviderController::class, 'orderDone2'])->name('order-accept2');
Route::get('/atsauktas-uzsakymas', [ProviderController::class, 'orderCancel'])->name('order-cancel');
Route::post('/prideti-kreditu/{id}', [ProviderController::class, 'creditAdd2'])->name('provider.creditAdd2');
Route::get('/profilis/{provider}', [ProviderController::class, 'watch'])->name('provider.watch');

Route::get('/iskelti-skelbima/{provider}', function () {
    return view('provider.upgrade');
})->name('provider.upgrade');

Route::get('/iskelti-skelbima-dabar/{credits}', [ProviderController::class, 'upgrade'])->name('provider.upgrade2');

Route::put('/redaguoti-profili/{provider}', [ProviderController::class, 'update'])->name('provider.update');

Route::get('/paieska', [ProviderController::class, 'search'])->name('provider.search');
Route::get('/kategorija/{category}', [CategoryController::class, 'show'])->name('category.show');

Route::get('/galerija/prideti', [GalleryController::class, 'add'])->name('gallery.add');
Route::get('/galerija/{gallery}', [GalleryController::class, 'watch'])->name('gallery.watch');

Route::middleware('auth')->group(function () {


    Route::get('/galerija/redaguoti/{gallery}', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/galerija/redaguoti/{gallery}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::post('/galerija', [GalleryController::class, 'store'])->name('gallery.store');
    Route::delete('/galerija/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
