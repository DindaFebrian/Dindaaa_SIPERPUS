<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
<<<<<<< HEAD

    Route::get('/books', [BookController::class, 'index'])->name('book');
});

Route::group(['middleware' => ['role:pustakawan']], function () {
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::get('/book/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
    Route::post('/book/store', [BookController::class, 'store'])->name('book.store');
    Route::patch('/book/{id}/update', [BookController::class, 'update'])->name('book.update');
    Route::delete('/book/{id}/destroy', [BookController::class, 'destroy'])->name('book.destroy');
    Route::get('/book/print', [BookController::class, 'print'])->name('book.print');
    Route::get('/book/export', [BookController::class, 'export'])->name('book.export');


});

require __DIR__ . '/auth.php';
=======
});

require __DIR__.'/auth.php';
>>>>>>> 91b5aee3c87cbb6316ed269da00321fec7ee8dc2
