<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function login(Request $request)
    {
        $accessToken = $request->input('access_token');

        if (!$accessToken) {
            return response()->json([
                'success' => false,
                'message' => 'Missing Google access token'
            ], 400);
        }

        try {
            // Ambil data user dari Google pakai access token yang dikirim Flutter
            $googleUser = Socialite::driver('google')->userFromToken($accessToken);

            // Ambil data dasar user
            $email = $googleUser->getEmail();
            $name = $googleUser->getName();
            $avatar = $googleUser->getAvatar();
            $googleId = $googleUser->getId();

            // Cek apakah user sudah ada
            $user = User::where('google_id', $googleId)
                        ->orWhere('email', $email)
                        ->first();

            if (!$user) {
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'username' => Str::slug(explode('@', $email)[0]),
                    'google_id' => $googleId,
                    'avatar' => $avatar,
                    'password' => Hash::make(Str::random(16)),
                    'role_id' => 1,
                    'email_verified_at' => now(),
                ]);
            } else {
                $user->update(['avatar' => $avatar]);
            }

            // Buat token untuk API
            $token = $user->createToken('mobile_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'user' => $user,
                'token' => $token,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal login via Google',
                'error' => $e->getMessage(),
            ], 401);
        }
    }
}
