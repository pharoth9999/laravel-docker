<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $user = $request->user();
    $token = $user->createToken('mobile')->accessToken;

    return response()->json(['token' => $token]);
});

Route::middleware('auth:api')->group(function () {
    Route::get('/me', fn(Request $request) => $request->user()->load('roles'));

    Route::controller(CategoryController::class)->prefix('categories')->group(function () {
        Route::get('/', 'getCategories');
        Route::post('/', 'createCategory');
        Route::get('/{categoryId}', 'getCategory');
        Route::patch('/{categoryId}/status', 'updateCategory');
        Route::delete('/{categoryId}', 'deleteCategory');
    });

    Route::get('/products', [ProductController::class, 'getProducts']);
    Route::post('/products', [ProductController::class, 'store']);
});
