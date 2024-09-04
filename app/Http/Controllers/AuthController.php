<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * Get the token array structure.
     *
     * @param  string $token
     * @param  array $roles
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $roles, $requiredRoles = [])
    {
        $userHasRequiredRoles = empty($requiredRoles) || !array_diff($requiredRoles, $roles);

        if (!$userHasRequiredRoles) {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'You do not have the necessary roles to access this resource.',
            ], 403);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'roles' => $roles,
        ]);
    }

    /**
     * Check the roles of the user based on the provided token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function roleCheck(Request $request)
    {
        $token = $request->input('token');
        $roles = $request->input('roles', []);
        $requiredRoles = $request->input('requiredRoles', []);

        return $this->respondWithToken($token, $roles, $requiredRoles);
    }

    /**
     * Register a new staff member.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:staff',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $staff = Staff::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $role = Role::where('name', 'staff')->first();

        if (!$role) {
            $role = Role::create(['name' => 'staff']); // Create the role if it doesn't exist
        }

        $staff->roles()->attach($role->id); // Associate the role with the staff member

        $token = JWTAuth::claims(['role' => 'staff'])->fromUser($staff);
        $roles = $staff->roles()->pluck('name')->toArray();

        return response()->json([
            'message' => 'Staff member registered successfully',
            'access_token' => $token,
            'roles' => $roles,
        ], 201);
    }
}
