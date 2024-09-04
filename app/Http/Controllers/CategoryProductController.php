<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    /*
     * Assign a product to a category
     */
    public function addCategoryProduct(int $category, int $product)
    {
        if(!Category::find($category))
        {
            return response('The category with id ' .$category. ' is not found', 400);
        }
        if(!Product::find($product))
        {
            return response('The product with id ' .$product. ' is not found', 400);
        }
        $categoryProduct = CategoryProduct::where('category_id', $category)
            ->where('product_id', $product);
        if($categoryProduct->exists())
        {
            return response('The product with id ' .$product. ' already exists', 400);
        }
        CategoryProduct::create(['category_id' => $category, 'product_id' => $product]);
        return response()->json(['message' => 'Product is assigned to category successfully!']);
    }
    /*
     * Remove the assigning from a product to a category
     */
    public function removeCategoryProduct(int $category, int $product)
    {
        $categoryProduct = CategoryProduct::where('category_id', $category)
            ->where('product_id', $product);

        if ($categoryProduct) {
            $categoryProduct->delete();
            return true;
        }
        return false;
    }
}
