<?php

use App\Http\Controllers\CarerController;
use App\Http\Controllers\DogProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Dog;
use App\Models\Service;
use App\Models\ServiceUser;
use Illuminate\Http\Request;

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

Route::get('/owner-dashboard', function (Request $request) {
    $users = User::all();
    $dogs = Dog::all();
    $services = Service::all();
    $users_services = ServiceUser::all();

    $auth_postcode = Auth::user()->postcode;
    $result2 = app('geocoder')->geocode($auth_postcode)->get();
    if (isset($result2[0])) {
        $auth_coordinates = $result2[0]->getCoordinates();
        $auth_lat = $auth_coordinates->getLatitude();
        $auth_lng = $auth_coordinates->getLongitude();
    }

    $sorted_users = [];
    $distance = null;

    foreach($users as $user) {
        if($user->role == 2) {
            $profile_postcode = $user->postcode;
            $result1 = app('geocoder')->geocode($profile_postcode)->get();
            if (isset($result1[0])) {
                $profile_coordinates = $result1[0]->getCoordinates();
                $profile_lat = $profile_coordinates->getLatitude();
                $profile_lng = $profile_coordinates->getLongitude();
            }

            if (isset($profile_lat) && isset($profile_lng)) {
                $distance = calculateDistance($auth_lat, $auth_lng, $profile_lat, $profile_lng);
            }

            $sorted_users[] = (object) ['id' => $user->id, 'name' => $user->name, 'picture' => $user->picture, 'distance' => $distance, 'services' => $user->services()];
        }
    }
            
    usort($sorted_users, function ($object1, $object2) {
        if($object1->distance != null || $object2->distance != null) {
            return $object1->distance > $object2->distance; 
        }
    });

    $service = null;
    if ($request->service_id != null) {
        $service = Service::find($request->service_id);
    }
    
    return view('owner-dashboard', [
        'users' => $sorted_users,
        'dogs' => $dogs,
        'services' => $services,
        'selected_service' => $service,
        'users_services' => $users_services
    ]);

})->middleware(['auth', 'verified'])->name('owner-dashboard');

Route::get('/carer-dashboard', function () {
    $users = User::all();
    $dogs = Dog::all();

    return view('carer-dashboard', [
        'users' => $users,
        'dogs' => $dogs,
    ]);
})->middleware(['auth', 'verified'])->name('carer-dashboard');

Route::get('/admin-dashboard', function () {
    $users = User::all();
    $dogs = Dog::all();

    return view('admin-dashboard', [
        'users' => $users,
        'dogs' => $dogs,
    ]);
})->middleware(['auth', 'verified'])->name('admin-dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/service-store', [ServiceController::class, 'store'])->name('service.store');
    Route::delete('/service-delete', [ServiceController::class, 'destroy'])->name('service.delete');
    Route::get('/view-profile-dog/{id}', [DogProfileController::class, 'view'])->name('profile_dog.view');
    Route::get('/create-profile-dog', [DogProfileController::class, 'create'])->name('profile_dog.create');
    Route::get('/edit-profile-dog', [DogProfileController::class, 'edit'])->name('profile_dog.edit');
    Route::patch('/edit-profile-dog', [DogProfileController::class, 'update'])->name('profile_dog.update');
    Route::delete('/delete-profile-dog', [DogProfileController::class, 'destroy'])->name('profile_dog.destroy');
    Route::post('register-dog', [DogProfileController::class, 'store'])->name('register-dog');
    Route::get('/view-profile/{id}', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/edit-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/verify-profile', [ProfileController::class, 'verify'])->name('profile.verify');
    Route::delete('/edit-profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
