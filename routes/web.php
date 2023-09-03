<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/i', \App\Http\Controllers\ImageController::class);


Route::get('/clean', function () {
    return view('templates.clean');
});

Route::get('/light-grey', function () {
    return view('templates.light-grey');
});
