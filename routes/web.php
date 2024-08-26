<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\LuggageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReportController;

Route::get('/customers/create', [CustomerController::class, 'create'])->name('customer.create');
Route::post('/customers/create', [CustomerController::class, 'store'])->name('customer.store');

// Route to display the form or list of luggage items
Route::get('/', [LuggageController::class, 'index'])->name('luggage.index');

Route::get('/luggage/create', [LuggageController::class, 'create'])->name('luggage.create');

// Route to handle form submission and QR code generation
Route::post('/luggage/create', [LuggageController::class, 'store'])->name('luggage.store');

// Route for the search form
Route::get('/luggage/search', [LuggageController::class, 'searchForm'])->name('luggage.search.form');

// Route to handle the search request
Route::get('/luggage/search/results', [LuggageController::class, 'search'])->name('luggage.search');



Route::get('/report/{tripId}', [ReportController::class, 'show'])->name('report.show');

Route::get('/report/{tripId}/pdf', [ReportController::class, 'generatePdf'])->name('report.pdf');



Route::get('/luggage/success', function () {
    return view('luggage.success');
})->name('luggage.success');