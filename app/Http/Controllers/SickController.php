<?php

namespace App\Http\Controllers;

use App\Models\Sick;
use Illuminate\Http\Request;

class SickController extends Controller
{
    public function index()
    {
        $sicks = Sick::all();
        return response()->json($sicks);
    }

    public function show($id)
    {
        $sick = Sick::findOrFail($id);
        return response()->json($sick);
    }

    public function showByStaff($staff_id)
    {
        $sicks = Sick::where('staff_id', $staff_id)->get();

        return response()->json($sicks);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'staff_id' => 'required|exists:staff,id'
        ]);

        $sick = Sick::create($validatedData);

        return response()->json($sick, 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'staff_id' => 'required|exists:staff,id'
        ]);

        $sick = Sick::findOrFail($id);
        $sick->update($validatedData);

        return response()->json($sick, 200);
    }

    public function destroy($id)
    {
        $sick = Sick::findOrFail($id);
        $sick->delete();

        return response()->json(['message' => 'Sick record deleted successfully'], 200);
    }
}
