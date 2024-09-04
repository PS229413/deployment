<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|unique:categories',
        ]);
        if($validation)
        {
            Category::create($request->all());
            return response()->json(['message' => 'Category created successfully']);
        }
        else
        {
            return response('Bad Request', 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Category::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $request->validate([
            'name' => 'required|unique:categories',
        ]);
        if($validation)
        {
            $category = Category::find($id);
            $category->update($request->all());
            return response()->json(['message' => 'Category updated successfully']);
        }
        else
        {
            return response('Bad Request', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
