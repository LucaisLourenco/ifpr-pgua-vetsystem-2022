<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('templates.main')->with('titulo');
})->middleware(['auth'])->name('index');

require __DIR__.'/auth.php';
