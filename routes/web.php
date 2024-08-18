<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\LuggageController;

// Route to display the form or list of luggage items
Route::get('/luggage', [LuggageController::class, 'index'])->name('luggage.index');


Route::get('/luggage/create', [LuggageController::class, 'create'])->name('luggage.create');

// Route to handle form submission and QR code generation
Route::post('/luggage/create', [LuggageController::class, 'store'])->name('luggage.store');

// Route to display details of a specific luggage item
Route::get('/luggage/{id}', [LuggageController::class, 'show'])->name('luggage.show');

// Route to handle search functionality
Route::get('/luggage/search', [LuggageController::class, 'search'])->name('luggage.search');


Route::get('/luggage/success', function () {
    return view('luggage.success');
})->name('luggage.success');