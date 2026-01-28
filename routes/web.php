<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TandartsController;
use App\Http\Controllers\AssistentController;
use App\Http\Controllers\MondhygienistController;
use App\Http\Controllers\PraktijkmanagementController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tandarts', [TandartsController::class, 'index'])
    ->middleware(['auth', 'role:tandarts,praktijkmanagement'])
    ->name('tandarts.index');

Route::get('/mondhygienist', [MondhygienistController::class, 'index'])
    ->middleware(['auth', 'role:mondhygienist'])
    ->name('mondhygienist.index');
Route::get('/assistent', [AssistentController::class, 'index'])
    ->middleware(['auth', 'role:assistent'])
    ->name('assistent.index');

Route::get('/praktijkmanagement', [PraktijkmanagementController::class, 'index'])
    ->middleware(['auth', 'role:praktijkmanagement'])
    ->name('praktijkmanagement.index');


Route::get('/praktijkmanagement/userroles', [PraktijkmanagementController::class, 'manageUserroles'])
    ->name('praktijkmanagement.userroles')
    ->middleware(['auth', 'role:praktijkmanagement']);

Route::get('/patient', [PatientController::class, 'index'])
    ->middleware(['auth', 'role:patient,praktijkmanagement'])
    ->name('patient.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';