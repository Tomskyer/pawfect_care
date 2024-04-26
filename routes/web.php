<?php

use App\Http\Controllers\CarerController;
use App\Http\Controllers\DogProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Dog;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    $users = User::all();
    $dogs = Dog::all();

    return view('dashboard', [
        'users' => $users,
        'dogs' => $dogs,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/service-store', [ServiceController::class, 'store'])->name('service.store');
    Route::delete('/service-delete', [ServiceController::class, 'destroy'])->name('service.delete');
    Route::get('/view-profile-dog/{id}', [DogProfileController::class, 'view'])->name('profile_dog.view');
    Route::get('/create-profile-dog', [DogProfileController::class, 'create'])->name('profile_dog.create');
    Route::delete('/delete-profile-dog', [DogProfileController::class, 'destroy'])->name('profile_dog.destroy');
    Route::post('register-dog', [DogProfileController::class, 'store'])->name('register-dog');
    Route::get('/edit-profile-dog', [DogProfileController::class, 'edit'])->name('profile_dog.edit');
    Route::get('/view-profile/{id}', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/edit-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/edit-profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
