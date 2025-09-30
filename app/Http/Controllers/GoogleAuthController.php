<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback()
    {
        try {
            // Ambil data user dari Google
            $googleUser = Socialite::driver('google')->user();

            // 1. Cari user berdasarkan google_id
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                // Jika user sudah ada, langsung login
                Auth::login($user);
                return redirect()->intended('/dashboard');
            }

            // 2. Jika tidak ada, cari berdasarkan email
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // Jika user ada tapi belum terhubung dengan Google, update google_id-nya
                $user->update(['google_id' => $googleUser->id]);
                Auth::login($user);
                return redirect()->intended('/dashboard');
            }

            // 3. Jika user benar-benar baru, buat akun baru
            $newUser = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'username' => strstr($googleUser->email, '@', true), // Ambil username dari email
                'google_id' => $googleUser->id,
                'password' => Hash::make(uniqid()), // Buat password acak karena tidak dibutuhkan
                'role_id' => 1, // Atur role default untuk user baru
            ]);
            
            // Tandai email sebagai terverifikasi karena berasal dari Google
            $newUser->markEmailAsVerified();

            Auth::login($newUser);

            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            // Jika terjadi error, kembalikan ke halaman login dengan pesan error
            report($e);
            return redirect('/login')->withErrors(['email' => 'Gagal melakukan otentikasi dengan Google. Silakan coba lagi.']);
        }
    }
}