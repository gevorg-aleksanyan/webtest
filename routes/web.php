<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/auth/google',[\App\Http\Controllers\GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback',[\App\Http\Controllers\GoogleController::class, 'handle']);

Route::get('/files', function() {
//    Storage::disk('google')->put('test.txt1', 'hi');
   $files =  Storage::disk('google')->allFiles();
   return view('driveFile', compact('files'));
})->name('files');

Route::get('/download/{name}', function($name) {
    $download =  Storage::disk('google')->download($name);
    $download->send();
    return redirect()->back();
})->name('download');
