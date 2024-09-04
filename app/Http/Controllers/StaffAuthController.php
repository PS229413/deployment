<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Attempt to find the user with the given email
        $user = Staff::where('email', $credentials['email'])->first();

        // If the user does not exist or the password is incorrect
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Generate a token for the authenticated user
        $token = $user->createToken('AuthToken')->plainTextToken;

        // Save the token to the user's api_token column
        $user->forceFill([
            'api_token' => $token,
        ])->save();

        // Fetch roles using Eloquent relationship if needed
        // Example: $roles = $user->roles()->pluck('name')->toArray();

        // Return the token and any additional data needed in the response
        return response()->json([
            'token' => $token,
            'staff' => $user, // Optionally include user data if needed
            // 'roles' => $roles // Include roles if needed
        ], 200);
    }


    public function logout(Request $request)
    {
        // Get the authenticated staff user
        $user = Auth::guard('staff')->user();

        // Check if the user is authenticated
        if ($user) {
            // Revoke the user's api_token
            $user->forceFill([
                'api_token' => null,
            ])->save();

            // Return a success response
            return response()->json(['message' => 'Logged out successfully'], 200);
        }

        // If the user is not authenticated, return an error response
        return response()->json(['error' => 'User not authenticated'], 401);
    }


    public function index()
    {
        $staff = Staff::all();
        return response()->json($staff);
    }

    public function show($id)
    {
        $staff = Staff::findOrFail($id);
        return response()->json($staff);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'birth' => 'required|date',
            'email' => 'required|string|email|unique:staff,email',
            'password' => 'required|string|min:8',
        ]);

        $staff = Staff::create([
            'name' => $request->name,
            'birth' => $request->birth,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($staff, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:50',
            'birth' => 'date',
            'email' => 'string|email',
            'password' => 'string|min:8',
        ]);

        $staff = Staff::findOrFail($id);
        $staff->update($request->all());

        return response()->json($staff, 200);
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return response()->json(['message' => 'Staff deleted successfully'], 200);
    }
}
