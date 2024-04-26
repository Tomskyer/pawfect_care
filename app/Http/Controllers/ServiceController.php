<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\UserService;

class ServiceController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => ['required', 'integer'],
            'service_id' => ['required', 'integer'],
            'price' => ['required', 'integer'],
        ]);

        UserService::create([
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,
            'price' => $request->price,
        ]);

        return redirect()->back();
    }

    /**
     * Delete the user service.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $users_services = UserService::where('id', $request->id)->get();

        foreach($users_services as $user_service){
            $row = $user_service;
        }

        $row->delete();

        return redirect()->back();
    }
}
