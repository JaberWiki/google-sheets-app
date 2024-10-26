<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\GoogleSheetsController;

Route::get('/user', function () {
    return Auth::user();
});
// Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle']);


Route::get('/sheets/data/{spreadsheetId}/{range}', [GoogleSheetsController::class, 'getData']);
Route::post('/sheets/data/{spreadsheetId}/{range}', [GoogleSheetsController::class, 'addData']);
Route::delete('/sheets/data/{spreadsheetId}/{range}', [GoogleSheetsController::class, 'deleteData']);

Route::get('/sheets', [GoogleSheetsController::class, 'listSheets']);
