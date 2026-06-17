<?php

use App\Http\Controllers\VerseController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('verses.index'));

// Verse resource routes (full CRUD)
Route::resource('verses', VerseController::class);

// Nested note routes on a verse
Route::post('verses/{verse}/notes',         [VerseController::class, 'storeNote'])->name('verses.notes.store');
Route::delete('verses/{verse}/notes/{note}',[VerseController::class, 'destroyNote'])->name('verses.notes.destroy');
