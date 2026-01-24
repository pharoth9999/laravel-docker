<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Audience;
use App\Models\Article;
use Illuminate\Http\Request;

class AudienceController extends Controller
{
    // Create audience + user
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->username,
            'email' => $request->username . '@mail.com',
            'password' => bcrypt('password')
        ]);

        return Audience::create([
            'name' => $request->audience_name,
            'user_id' => $user->id,
            'article_id' => $request->article_id
        ]);
    }

    // Subscribe audience to article
    public function subscribe(Request $request)
    {
        $audience = Audience::where('name', $request->audience)->first();
        $article  = Article::where('name', $request->article)->first();

        return Audience::create([
            'name' => $audience->name,
            'user_id' => $audience->user_id,
            'article_id' => $article->id
        ]);
    }

    // Get comments of audience
    public function comments($name)
    {
        return Audience::where('name', $name)
            ->first()
            ->comments;
    }
}
