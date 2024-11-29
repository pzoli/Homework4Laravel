<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\utils\AuthFileUtils;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Log;
class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $password = Hash::make($validated['password']);
        try {
            AuthFileUtils::updateFile($request->user()->getAttributes(), $password);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        $request->user()->update([
            'password' => $password,
        ]);

        return back();
    }
}
