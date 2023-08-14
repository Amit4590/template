<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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
    return view('admin.dashboard');
});

Route::group(['prefix' => 'admin'],function(){

    /*******| Category Route Start |*******/

    Route::POST('category/{category}',[CategoryController::class,'update'])->name('category.update');
    Route::POST('category/{status}/{id}/status',[CategoryController::class,'status'])->name('category.status');
    Route::resource('category',CategoryController::class)->except(['show','update']);
    
    /*******| Category Route End |*******/

});