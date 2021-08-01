<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'mobile' => ["required", "unique:users,mobile"],
            'email' => ["nullable", "email", "unique:users,email"],
            'password' => ["required", "min:6"],
        ]);

        // Create new user
        try {
            $user = new User();
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->password = app('hash')->make($request->password);

            if ($user->save()) {
                $request->merge(['username' => $request->mobile ?? $request->email ?? null]);
                return $this->login($request);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function login(Request $request)
    {
        $mode = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';

        $this->validate($request, [
            'username' => ["required", "exists:users,$mode"],
            'password' => ["required"],
        ]);

        $request->merge(["$mode" => $request->username]);

        $credentials = request([$mode, 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function user()
    {
        $user = auth()->user();
        $response  = new UserResource($user);
        $response->default(['email', 'mobile', 'ability']);
        return $response;
    }

    public function passwordChange(Request $request)
    {
        $this->validate($request, [
            'password' => ["required"],
            'new_password' => ["required", "min:6", "not_in:$request->password"],
            'new_password_confirm' => ["required", "same:new_password",],
        ]);

        $user = auth()->user();
        if (app('hash')->check($request->password, $user->password)) {
            $user->password = app('hash')->make($request->get('new_password'));
            $user->save();

            return [
                'message' => 'Password change success.'
            ];
        }

        return response()->json([
            'message' => 'Password change failed.'
        ], 400);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
