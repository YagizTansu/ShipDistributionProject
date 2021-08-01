<?php

use App\Http\Controllers\Admin\adminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Ship;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    $ships = Ship::get();
    return view('ships',compact('ships'));
})->name('ships');

Route::middleware(['auth:sanctum', 'verified'])->get('/ships', function () {
    $ships = Ship::get();
    return view('ships',compact('ships'));
})->name('ships');

Route::group( ['middleware' => ['auth:sanctum', 'verified','isAdmin'],'prefix' =>'admin'], function () {
    Route::get('ships/{id}',[adminController::class,'destroy'])->whereNumber('id')->name('ships.destroy');
    Route::resource('ships',adminController::class);
});
