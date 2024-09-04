<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return response()->json($schedules);
    }

    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);
        return response()->json($schedule);
    }

    public function getSchedulesByStaff($staff_id)
    {
        $schedules = Schedule::where('staff_id', $staff_id)->get();

        return response()->json($schedules);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'staff_id' => 'required|exists:staff,id'
        ]);

        $schedule = Schedule::create($validatedData);

        return response()->json($schedule, 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'staff_id' => 'required|exists:staff,id'
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->update($validatedData);

        return response()->json($schedule, 200);
    }

    public function destroy($id)
    {
        $schedule = Schedule::find($id);
        if ($schedule) {
            $schedule->delete();
            return response()->json(['message' => 'Schedule deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Schedule not found'], 404);
        }
    }
}
