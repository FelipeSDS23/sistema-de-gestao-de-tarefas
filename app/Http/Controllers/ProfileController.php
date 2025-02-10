<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
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
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Checks if the user uploaded a profile photo
        if($request->hasFile('image')) {
            // Deletes the old image if it exists
            if ($request->user()->image != 'default.jpg') {
                // The old image path is stored in the database
                Storage::delete('profile_pictures/' . $request->user()->image);  // Remove a imagem antiga
            }
            // Gets the uploaded file
            $image = $request->file('image');
            // Create a unique name
            $imageUniqueName = uniqid('profile_', true) . '.' . $image->getClientOriginalExtension();
            // Saves to the storage/app/public/profile_pictures folder
            $uploadedFiles = $image->storeAs('profile_pictures', $imageUniqueName);
        }

        // Access the authenticated user
        $user = $request->user();

        // Updates the user with the request data (including the unique name of the image, if it has been changed
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'image' => $imageUniqueName
        ];
    
        // Updates the user with the data in the associative array
        $user->update($data);

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

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
