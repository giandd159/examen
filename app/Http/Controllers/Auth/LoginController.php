<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\UserLoggedIn; // Agrega la importación del evento UserLoggedIn

class LoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Error de autenticación con Google.');
        }

        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            $user->google_id = $googleUser->getId();
            $user->save();
            Auth::login($user);
        } else {
            $newUser = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
            ]);
            Auth::login($newUser);
        }

        return redirect()->route('dashboard');
    }

    // Método para manejar el evento de inicio de sesión
    public function authenticated(Request $request, $user)
    {
        
        event(new UserLoggedIn($user)); 
        
        return redirect()->intended($this->redirectPath());
    }
}