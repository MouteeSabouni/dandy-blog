<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('profile', ['user' => $user]);
    }

    public function updateProfile(User $user)
    {
        if ($user->id === auth()->id()) {
            $attributes = request()->validate([
                'name' => 'sometimes|required|string|min:3|max:96',
                'email' => 'sometimes|required|email:rfc,dns|max:96|unique:users,email'
            ]);
            $user->update($attributes);

            return back();
        } else {
            abort(403);
        }
    }

    public function updatePassword(User $user)
    {
        if (! $user->id === auth()->id()) {
            abort(403);
        }

        $attributes = request()->validate([
            'password_current' => 'required_with:password|min:8|max:96|string',
            'password' => 'sometimes|required|string|min:8|max:96|confirmed',
        ]);

        if (!Hash::check($attributes['password_current'], $user->password)) {
            throw ValidationException::withMessages([
                'password_current' => ['The provided current password does not match our records.']
            ]);
        }

        $attributes['password'] = Hash::make($attributes['password']);

        $user->update($attributes);

        return back()->with('status', 'Your password has been changed!');
    }

    public function destroy(User $user)
    {
        if ($user = auth()->user())
        {
            $user->delete();
            return redirect('/');
        } else {
            abort(403);
        }
    }
}
