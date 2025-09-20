<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('archives.index'));

Route::resource('archives', ArchiveController::class);
Route::get('archives/{archive}/download', [ArchiveController::class,'download'])->name('archives.download');

Route::resource('categories', CategoryController::class)->except(['show']);

Route::view('/about','about')->name('about');
