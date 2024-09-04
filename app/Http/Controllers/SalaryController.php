<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;

class SalaryController extends Controller
{
    public function index()
    {
        return Salary::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'amount' => 'required|numeric',
            'salary_date' => 'required|date',
        ]);

        return Salary::create($request->all());
    }

    public function show($id)
    {
        return Salary::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $salary = Salary::findOrFail($id);

        $request->validate([
            'staff_id' => 'sometimes|required|exists:staff,id',
            'amount' => 'sometimes|required|numeric',
            'salary_date' => 'sometimes|required|date',
        ]);

        $salary->update($request->all());

        return $salary;
    }

    public function destroy($id)
    {
        $salary = Salary::findOrFail($id);
        $salary->delete();

        return response()->json(['message' => 'Salary deleted successfully']);
    }

    public function getSalariesByMonthYear($month, $year)
    {
        $salaries = Salary::whereMonth('salary_date', $month)
            ->whereYear('salary_date', $year)
            ->get();

        return $salaries;
    }

    public function getSalariesByStaffId($staffId)
    {
        $salaries = Salary::where('staff_id', $staffId)->get();

        return $salaries;
    }
}
