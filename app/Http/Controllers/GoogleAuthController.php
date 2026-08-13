<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')
            ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
            ->user();

        // Check if user already exists based on google_id
        $user = User::where('google_id', $googleUser->id)->first();

        if ($user) {
            // User exists, log them in
            Auth::login($user);
        } else {
            // Check if user exists with the same email
            $existingUser = User::where('email', $googleUser->email)->first();

            if ($existingUser) {
                // Update existing user with Google ID and Avatar
                $existingUser->update([
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                ]);
                // If they hadn't verified their email, consider it verified now since Google verified it
                if (!$existingUser->hasVerifiedEmail()) {
                    $existingUser->markEmailAsVerified();
                }
                Auth::login($existingUser);
            } else {
                // Create new user
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    // No password for Google authenticated users, but some DB configs require a random one
                    // if we didn't make the column nullable. We made it nullable, so we can omit it, 
                    // or provide a secure random string just in case.
                    'password' => bcrypt(Str::random(16)),
                ]);

                // Automatically mark email as verified since it's from Google
                $newUser->markEmailAsVerified();

                Auth::login($newUser);
            }
        }
        $redirectUrl = Auth::user()->is_admin ? '/admin' : '/';
        return redirect($redirectUrl)->with('success', 'Logged in successfully! Welcome! 🎉');
    }
}
