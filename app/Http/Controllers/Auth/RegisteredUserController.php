<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Axlon\PostalCodeValidation\ValidationServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(int $role): View
    {
        return view('auth.register', [
            'role' => $role,
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'picture' => ['file', 'mimes:jpg,png,gif,webp', 'max:3072'],
            'postcode' => 'postal-code:GB',
        ]);
        $path = null;

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->storePublicly('profile_pictures');
        }

        $carer_verified = null;

        if ($request->role == 2) {
            $carer_verified = 'false';
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'picture' => $path,
            'postcode' => $request->postcode,
            'role' => $request->role,
            'carer_verified' => $carer_verified,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
