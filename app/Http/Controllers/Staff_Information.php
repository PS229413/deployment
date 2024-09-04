<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StaffInformation;

class Staff_Information extends Controller
{
    public function index()
    {
        $staff = StaffInformation::all();
        return response()->json($staff);
    }

    public function getById($id)
    {
        $staff = StaffInformation::find($id);

        if (!$staff) {
            return response()->json(['message' => 'Staff information not found'], 404);
        }

        return response()->json($staff);
    }
    public function getByStaffId($staffId)
    {
        $staff = StaffInformation::where('staff_id', $staffId)->get();

        if ($staff->isEmpty()) {
            return response()->json(['message' => 'Staff information not found'], 404);
        }

        return response()->json($staff);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'postcode' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'identification_bsn' => 'nullable|string|max:255',
            'identification_id_card' => 'nullable|string|max:255',
            'identification_passport' => 'nullable|string|max:255',
            'phone_number_mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'staff_id' => 'required|exists:staff,id',
        ]);

        $staff = StaffInformation::create($validatedData);

        return response()->json(['message' => 'Staff information created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'postcode' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'identification_bsn' => 'nullable|string|max:255',
            'identification_id_card' => 'nullable|string|max:255',
            'identification_passport' => 'nullable|string|max:255',
            'phone_number_mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'staff_id' => 'required|exists:staff,id',
        ]);

        $staff = StaffInformation::findOrFail($id);
        $staff->update($validatedData);

        return response()->json(['message' => 'Staff information updated successfully']);
    }

    public function destroy($id)
    {
        $staff = StaffInformation::findOrFail($id);
        $staff->delete();

        return response()->json(['message' => 'Staff deleted successfully']);
    }
}

