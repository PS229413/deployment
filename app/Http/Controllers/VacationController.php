<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacation;

class VacationController extends Controller
{
    public function index()
    {
        $vacations = Vacation::all();
        return response()->json($vacations);
    }

    public function show($id)
    {
        $vacation = Vacation::find($id);
        if (!$vacation) {
            return response()->json(['error' => 'Vacation not found'], 404);
        }
        return response()->json($vacation);
    }

    public function showByStaff($staff_id)
    {
        $vacations = Vacation::where('staff_id', $staff_id)->get();
        return response()->json($vacations);
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'reason' => 'required|string',
        ]);

        $vacation = Vacation::create($request->all());
        return response()->json($vacation, 201);
    }

    public function update(Request $request, $id)
    {
        // Validate request data
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'reason' => 'required|string',
        ]);

        // Find the vacation record by ID
        $vacation = Vacation::find($id);

        if (!$vacation) {
            return response()->json(['message' => 'Vacation record not found'], 404);
        }

        // Update the vacation record
        $vacation->start_date = $request->input('start_date');
        $vacation->end_date = $request->input('end_date');
        $vacation->reason = $request->input('reason');
        $vacation->save();

        return response()->json($vacation, 200);
    }

    public function destroy($id)
    {
        $vacation = Vacation::find($id);
        if (!$vacation) {
            return response()->json(['error' => 'Vacation not found'], 404);
        }

        $vacation->delete();
        return response()->json(['message' => 'Vacation deleted successfully'], 200);
    }
}
