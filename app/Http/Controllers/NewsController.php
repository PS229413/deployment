<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return News::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:60|unique:writers',
            'adminRights' => 'required',
        ]);
        return News::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return News::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $newsitem = News::find($id);
        return $newsitem->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $newsitem = News::find($id);
        $newsitem->delete();
    }
}
