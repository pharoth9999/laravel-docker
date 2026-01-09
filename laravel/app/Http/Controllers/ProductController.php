<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getCategories()
    {
        return ["message" => "Getting list of categories"];
    }

    public function createCategory(Request $request)
    {
        return ["message" => "Creating 1 new category"];
    }

    public function getCategory($categoryId)
    {
        return ["message" => "Getting 1 category base on given categoryId"];
    }

    public function updateCategory($categoryId)
    {
        return ["message" => "Updating 1 category base on given categoryId"];
    }

    public function deleteCategory($categoryId)
    {
        return ["message" => "Deleting 1 category base on given categoryId"];
    }

    public function getProducts()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $user = $request->user();

        abort_unless($user && $user->can('products.create'), 403);

        $data = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'pricing' => 'required|numeric',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'string',
        ]);

        $data['created_by'] = $user->id;

        $product = Product::create($data);

        return response()->json($product, 201);
    }
}
