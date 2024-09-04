<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Get all id's from the products
     */
    public function getAllIds()
    {
        return Product::select('id')->get();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'kuin_id' => 'integer|required|unique:products',
            'name' => 'required|max:255',
            'description' => 'max:255',
            'sku' => 'required|unique:products|max:100',
            'stock' => 'required|integer|min:0',
            'supplier_price' => 'required|decimal|min:0',
            'price_margin' => 'required|decimal|min:0',
            'color' => 'max:100',
            'height' => 'float|min:0'
        ]);
        if($validation)
        {
            Product::create($request->all());
            return response()->json(['message' => 'Product created successfully']);
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
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $request->validate([
            'kuin_id' => 'integer|required|unique:products',
            'name' => 'required|max:255',
            'description' => 'max:255',
            'sku' => 'required|unique:products|max:100',
            'stock' => 'required|integer|min:0',
            'supplier_price' => 'required|decimal|min:0',
            'price_margin' => 'required|decimal|min:0',
            'color' => 'max:100',
            'height' => 'float|min:0'
        ]);
        if($validation)
        {
            $category = Product::find($id);
            $category->update($request->all());
            return response()->json(['message' => 'Product updated successfully']);
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
        Product::destroy($id);
        return response()->json(['message' => 'Product deleted successfully']);
    }
    public function getProductsByInput(Request $request)
    {
        $query = Product::query();

        if($request->has('priceMin'))
        {
            $query->whereRaw('(supplier_price * (price_margin + 1)) >= ?', [$request->input('priceMin')]);
        }
        if($request->has('priceMax'))
        {
            $query->whereRaw('(supplier_price * (price_margin + 1)) <= ?', [$request->input('priceMax')]);
        }
        if($request->has('name'))
        {
            $query->where('name', 'like', '%'.$request->input('name').'%');
        }
        if($request->has('color'))
        {
            $query->where('color', $request->input('color'));
        }
        if($request->has('widthMin'))
        {
            $query->where('width', '>=', $request->input('widthMin'));
        }
        if($request->has('widthMax'))
        {
            $query->where('width', '<=', $request->input('widthMax'));
        }
        if($request->has('heightMin'))
        {
            $query->where('height', '>=', $request->input('heightMin'));
        }
        if($request->has('heightMax'))
        {
            $query->where('height', '<=', $request->input('heightMax'));
        }
        if($request->has('depthMin'))
        {
            $query->where('depth', '>=', $request->input('depthMin'));
        }
        if($request->has('depthMax'))
        {
            $query->where('depth', '<=', $request->input('depthMax'));
        }
        if($request->has('weightMin'))
        {
            $query->where('weight', '>=', $request->input('weightMin'));
        }
        if($request->has('weightMax'))
        {
            $query->where('weight', '<=', $request->input('weightMax'));
        }
        $products = $query->get();
        return response()->json($products);
    }
    public function changeMargin(int $id, Request $request)
    {
        if($request->margin >= 1)
        {
            return response()->json('Margin must have a value between 0 and 1. Fill this field with a correct value', 400);
        }
        $product = Product::find($id);
        if($product == null)
        {
            return response()->json('Product not found', 404);
        }
        $product->update(['price_margin' => $request->margin]);
    }
    public function changeDiscount(int $id, Request $request)
    {
        if($request->discount >= 1)
        {
            return response()->json('Discount must have a value between 0 and 1. Fill this field with a correct value', 400);
        }
        $product = Product::find($id);
        if($product == null)
        {
            return response()->json('Product not found', 404);
        }
        $product->update(['discount' => $request->discount]);
    }
    public function changeStock(Request $request)
    {
        foreach($request->products as $products){
            $product = Product::find($products->id);
            $amount = $products->ordered;
            if($product->stock - $amount > -1)
            {
                return $product->update(['stock' => $product->stock - $amount]);
            }
            else
            {
                return response('Stock out of stock', 400);
            }
        }
        return null;
    }
    public function getFirst(int $amount) {
        return Product::take($amount)->get();
    }
    public function getAfterFirst(int $amount) {
        return Product::offset($amount)->limit(1000000000)->get();
    }
}
