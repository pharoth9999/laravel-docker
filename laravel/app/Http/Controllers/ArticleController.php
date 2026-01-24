<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Create article
    public function store(Request $request)
    {
        $author = Author::where('name', $request->author)->first();

        return Article::create([
            'name' => $request->article_name,
            'author_id' => $author->id
        ]);
    }

    // Get audiences of article
    public function audiences($name)
    {
        return Article::where('name', $name)
            ->first()
            ->audiences;
    }
}
