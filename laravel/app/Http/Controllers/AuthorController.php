<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    // Create author + user
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'username' => 'required|string',
            'author_name' => 'required|string',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->username,
            'email' => $request->username . '@mail.com',
            'password' => Hash::make('password'), // use bcrypt() also fine
        ]);

        // Create author
        $author = Author::create([
            'name' => $request->author_name,
            'user_id' => $user->id
        ]);

        return response()->json([
            'author' => $author,
            'user' => $user
        ], 201);
    }

    // Get all articles of author
    public function articles($name)
    {
        $author = Author::where('name', $name)->firstOrFail();
        return response()->json($author->articles);
    }

    // Get all audiences of author (HasManyThrough)
    public function audiences($name)
    {
        $author = Author::where('name', $name)->firstOrFail();
        return response()->json($author->audiences);
    }
}
