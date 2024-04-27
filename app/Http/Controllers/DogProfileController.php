<?php

namespace App\Http\Controllers;

use App\Http\Requests\DogProfileUpdateRequest;
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
            'dog' => $requested_dog,
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
        $dogs = Dog::where('id', $request->id)->get();

        foreach ($dogs as $dog) {
            $requested_dog = $dog;
        }

        return view('profile_dog.edit', [
            'dog' => $requested_dog,
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
            'breed' => ['required', 'string', 'max:80'],
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
            'breed' => $request->breed,
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
    public function update(DogProfileUpdateRequest $request): RedirectResponse
    {
        $dogs = Dog::where('id', $request->id)->get();

        foreach ($dogs as $d) {
            $dog = $d;
        }

        if ($request->hasFile('picture')) {
            if ($dog->picture != null) {
                Storage::delete($dog->picture);
            }
            $path = $request->file('picture')->storePublicly('dog_pictures');
            $dog->fill(['picture' => $path]);
        }

        if ($request->neutered != null) {
            $neutered = 'true';
        } else {
            $neutered = 'false';
        }

        $dog->fill(['neutered' => $neutered]);

        $dog->fill($request->validated());

        $dog->save();

        return redirect()->back()->with('status', 'dog-profile-updated');
    }

    /**
     * Delete the dog's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $dogs = Dog::where('id', $request->id)->get();

        foreach ($dogs as $dog) {
            $row = $dog;
        }

        $row->delete();

        return redirect()->back();
    }
}
