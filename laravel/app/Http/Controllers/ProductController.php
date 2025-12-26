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
}
