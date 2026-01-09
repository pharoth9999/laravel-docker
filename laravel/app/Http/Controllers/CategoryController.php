<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $user = auth()->user();

        $categories = Category::with('product')->get()->filter(function (Category $category) use ($user) {
            return $user?->can('view', $category);
        });

        return $categories->values();
    }

    public function createCategory(Request $request)
    {
        return ["message" => "Creating 1 new category"];
    }

    public function getCategory($categoryId)
    {
        $category = Category::with('product')->findOrFail($categoryId);

        $this->authorize('view', $category);

        return $category;
    }

    public function updateCategory(Request $request, $categoryId)
    {
        $category = Category::findOrFail($categoryId);

        $this->authorize('updateStatus', $category);

        $data = $request->validate([
            'status' => 'required|string',
        ]);

        $category->update($data);

        return $category->refresh();
    }

    public function deleteCategory($categoryId)
    {
        return ["message" => "Deleting 1 category base on given categoryId"];
    }
}
