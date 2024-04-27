<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceUser;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

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

        ServiceUser::create([
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
        $service_user = ServiceUser::where('id', $request->id)->get();

        foreach($service_user as $s){
            $row = $s;
        }

        $row->delete();

        return redirect()->back();
    }
}
