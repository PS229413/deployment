<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsImage;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Image::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsImage $request)
    {
        try {
            return Image::create($request->all());
        } catch (ValidationException $e) {
            $errors = $e->errors();
            dd($errors, 'test');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Image::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'required|max:100|unique:news_images',
        ]);
        $newsimage = Image::find($id);
        return $newsimage->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $newsimage = Image::find($id);
        $newsimage->delete();
    }
}
