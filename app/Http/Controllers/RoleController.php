<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return Role::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles|max:60',
        ]);
        return Role::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Role::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::find($id);
        $request->validate([
            'name' => 'required|max:60|unique:roles,name,' . $role->id,
        ]);
        return $role->update($request->all());
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Role::destroy($id);
    }
}
