<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function view(Request $request, int $id): View
    {
        $users = User::where('id', $id)->get();

        foreach($users as $user) {
            $requested_user = $user;
        }

        return view('profile.view', [
            'requested_user' => $requested_user,
        ]);
    }

    /**
     * Display the edit profile screen.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        
        if ($request->hasFile('picture')) {
            if ($request->user()->picture != null) {
                Storage::delete($request->user()->picture);
            }
            $path = $request->file('picture')->storePublicly('profile_pictures');
            $request->user()->fill(['picture' => $path]);
        }

        $request->user()->fill($request->validated());
        
        $request->user()->save();
       

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        

        Auth::logout();
        
        Storage::delete($user->picture);
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
