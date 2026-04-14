<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');


Route::middleware('auth')->group(function () {
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
});

Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');


Route::get('/api/properties', [PropertyController::class, 'getPropertiesJson']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Calendar and visits (authenticated)
Route::middleware('auth')->group(function () {
    Route::get('/calendar', [VisitController::class, 'calendar'])->name('calendar');
    Route::get('/events', [VisitController::class, 'getEvents'])->name('events.get');
    Route::get('/my-visits', [VisitController::class, 'getUserVisits'])->name('visits.index');
    Route::get('/visits/{visit}', [VisitController::class, 'show'])->name('visits.show');
    Route::post('/visits', [VisitController::class, 'store'])->name('visits.store');
    Route::put('/visits/{visit}', [VisitController::class, 'update'])->name('visits.update');
    Route::delete('/visits/{visit}', [VisitController::class, 'destroy'])->name('visits.destroy');
    Route::post('/event/delete/{visit}', [VisitController::class, 'destroy'])->name('event.delete');
    Route::post('/events/update/{visit}', [VisitController::class, 'update'])->name('event.update');

    // Payment
    Route::post('/visits/{visit}/checkout', [PaymentController::class, 'createCheckoutSession'])->name('payment.checkout');
    Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
