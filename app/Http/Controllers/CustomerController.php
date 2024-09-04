<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Attempt to find the user with the given credentials
        $customer = Customer::where('email', $credentials['email'])->first();

        // If the user exists and the password is correct
        if ($customer && Hash::check($credentials['password'], $customer->password)) {
            // Generate a token for the authenticated user
            $token = $customer->createToken('AuthToken')->plainTextToken;

            // Save the token to the user's api_token column
            $customer->forceFill([
                'api_token' => $token,
            ])->save();

            // Return the token in the response
            return response()->json(['token' => $token], 200);
        }

        // If authentication fails, return Unauthorized
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:6',
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'birthday' => 'required|date',
            'address' => 'required',
            'city' => 'required',
            'postcode' => 'required',
            'country' => 'required',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $customer = Customer::create($validatedData);

        return response()->json(['message' => 'Customer registered successfully'], 201);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Customer::all();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       return Customer::create($request->all());
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Customer::find($id);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $customer = Customer::find($id);
       return $customer->update($request->all());
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Customer::destroy($id);
    }
}
