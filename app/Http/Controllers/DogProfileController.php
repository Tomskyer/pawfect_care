<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Dog;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Providers\RouteServiceProvider;

class DogProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function view(Request $request, int $id): View
    {
        $dogs = Dog::where('id', $id)->get();

        foreach ($dogs as $dog) {
            $requested_dog = $dog;
        }

        return view('profile_dog.view', [
            'requested_dog' => $requested_dog,
        ]);
    }

    /**
     * Display the create dog profile screen.
     */
    public function create(Request $request): View
    {
        return view('profile_dog.create', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the edit dog profile screen.
     */
    public function edit(Request $request): View
    {
        return view('profile_dog.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'owner_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:6'],
            'birthdate' => ['required', 'date'],
            'size' => ['required', 'integer'],
            'picture' => ['file', 'mimes:jpg,png,gif,webp', 'max:3072'],
        ]);

        if ($request->neutered != null) {
            $neutered = 'true';
        }
        else {
            $neutered = 'false';
        }

        $path = null;

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->storePublicly('dog_pictures');
        }

        $dog = Dog::create([
            'owner_id' => $request->owner_id,
            'name' => $request->name,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'size' => $request->size,
            'neutered' => $neutered,
            'about' => $request->about,
            'picture' => $path,
        ]);

        $id = $request->user()->id;

        return redirect(route('profile.view', ['id' => $id]));
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     if ($request->hasFile('picture')) {
    //         if ($request->user()->picture != null) {
    //             Storage::delete($request->user()->picture);
    //         }
    //         $path = $request->file('picture')->storePublicly('profile_pictures');
    //         $request->user()->fill(['picture' => $path]);
    //     }

    //     $request->user()->fill($request->validated());

    //     $request->user()->save();


    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    /**
     * Delete the dog's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();


    //     Auth::logout();

    //     if ($user->picture != null) {
    //         Storage::delete($request->user()->picture);
    //     }
    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
}
