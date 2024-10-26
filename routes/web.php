<?php

// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\GoogleSheetsController;

// Route::get('/auth/redirect', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
// Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
// Route::get('/sheets', [GoogleController::class, 'listSheets']);


// Route::get('/sheets/data/{spreadsheetId}/{range}', [GoogleSheetsController::class, 'getData']);
// Route::post('/sheets/data/{spreadsheetId}/{range}', [GoogleSheetsController::class, 'addData']);
// Route::delete('/sheets/data/{spreadsheetId}/{range}', [GoogleSheetsController::class, 'deleteData']);

Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle']);
// Route::get('/auth/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});