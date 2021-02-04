<?php

use Spatie\Valuestore\Valuestore;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

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

$settings = Valuestore::make(storage_path('app/settings.json'));

if ($settings->get('is_default_page') === true) {
    Route::get('/', function () {
        return redirect('/documents');
    });
} else {
    Route::view('/', 'about')->name('about');
}

// About
Route::view('/about', 'about')->name('about');

// Docs
Route::get('documents', [DocumentController::class, 'index'])->name('documents');
Route::get('documents/create', App\Http\Livewire\Documents\Create::class)->name('documents.create');
Route::get('documents/{document}/edit', App\Http\Livewire\Documents\Edit::class)->name('documents.edit');

// Settings
Route::view('/settings', 'settings.index')->name('settings');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
