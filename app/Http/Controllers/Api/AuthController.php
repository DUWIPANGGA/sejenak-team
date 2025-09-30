<?php
namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        $userRoleId = DB::table('roles')->where('name', 'user')->value('id');
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|max:10',
            'email' => 'required|string|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'role_id' => $userRoleId
        ]);

        return $this->createSessionAndRespond($user, $request);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['code' => 401, 'status' => 'error', 'message' => 'Invalid email or password'], 401);
        }

        $user = Auth::user();
        return $this->createSessionAndRespond($user, $request, $token);
    }

    private function createSessionAndRespond(User $user, Request $request, $accessToken = null)
    {
        if (!$accessToken) {
            $accessToken = JWTAuth::fromUser($user);
        }

        $refreshToken = Str::random(64);

        UserSession::create([
            'user_id' => $user->id,
            'token' => hash('sha256', $accessToken),
            'refresh_token' => hash('sha256', $refreshToken),
            'expires_at' => Carbon::now()->addMinutes(config('jwt.ttl', 60)), // default JWTAuth TTL (60 menit)
            'last_used_at' => now(),
            'device_name' => $request->header('User-Agent'),
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'access_token' => $accessToken,
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'refresh_token' => $refreshToken,
            'refresh_expires_in' => 60 * 60 * 24 * 7, // contoh 7 hari
            'user' => $user->only(['id', 'name', 'email', 'username']),
        ]);
    }

    public function refresh(Request $request)
    {
        $request->validate([
            'refresh_token' => 'required|string',
        ]);

        $hashed = hash('sha256', $request->refresh_token);

        $session = UserSession::where('refresh_token', $hashed)
            ->where('expires_at', '>', now())
            ->first();

        if (!$session) {
            return response()->json(['code' => 401, 'status' => 'error', 'message' => 'Invalid or expired refresh token'], 401);
        }

        $user = $session->user;

        $newAccessToken = JWTAuth::fromUser($user);

        $session->update([
            'token' => hash('sha256', $newAccessToken),
            'expires_at' => Carbon::now()->addMinutes(config('jwt.ttl', 60)),
            'last_used_at' => now(),
        ]);

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'access_token' => $newAccessToken,
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }

    public function logout(Request $request)
    {
        try {
            $accessToken = JWTAuth::getToken();
            if ($accessToken) {
                $hashed = hash('sha256', $accessToken);
                UserSession::where('token', $hashed)->delete();
                JWTAuth::invalidate($accessToken);
            }

            if ($request->refresh_token) {
                $hashedRefresh = hash('sha256', $request->refresh_token);
                UserSession::where('refresh_token', $hashedRefresh)->delete();
            }

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Successfully logged out'
            ]);
        } catch (\Exception $e) {
            return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Failed to logout'], 500);
        }
    }

    public function me()
    {
        $user = JWTAuth::parseToken()->authenticate();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'user' => $user->only(['id', 'name', 'email', 'username', 'avatar', 'bio', 'role_id']),
        ]);
    }
}
