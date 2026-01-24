<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Create polymorphic comment
    public function store(Request $request)
    {
        $class = "App\\Models\\" . $request->type;
        $model = $class::find($request->id);

        return $model->comments()->create([
            'name' => $request->comment,
            'user_id' => $request->user_id
        ]);
    }

    // Get all comments with topic
    public function index()
    {
        return Comment::with('commentable')->get();
    }
}
