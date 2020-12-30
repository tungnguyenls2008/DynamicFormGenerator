<?php

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

use App\Http\Controllers\FormDetailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('form', 'FormController');

Route::resource('showform', 'FormDetailController');

Route::resource('formdata', 'FormDataController');
Route::post('get-form-from-builder',[FormDetailController::class,'saveJsonFromFormBuilder'])->name('saveJsonFromFormBuilder');
