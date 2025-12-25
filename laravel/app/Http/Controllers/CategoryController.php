<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        return response()->json(['data' => []]);
    }

    public function createCategory(Request $request)
    {
        return response()->json(['created' => true], 201);
    }

    public function getCategory($categoryId)
    {
        return response()->json(['id' => $categoryId]);
    }

    public function updateCategory(Request $request, $categoryId)
    {
        return response()->json(['updated' => true]);
    }

    public function deleteCategory($categoryId)
    {
        return response()->json(['deleted' => true]);
    }
}
