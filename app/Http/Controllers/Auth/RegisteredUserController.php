<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
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
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Checks if the user uploaded a profile photo
        if($request->file('image')) {
            // Gets the uploaded file
            $image = $request->file('image');
            // Create a unique name
            $imageUniqueName = uniqid('profile_', true) . '.' . $image->getClientOriginalExtension();
            // Saves to the storage/app/public/profile_pictures folder
            $uploadedFiles = $image->storeAs('profile_pictures', $imageUniqueName);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $imageUniqueName ?? 'default.jpg',
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Defines the App's default settings
        Setting::create([
            'user_id' => Auth::user()->id
        ]);

        return redirect(route('dashboard', absolute: false));
    }
}
