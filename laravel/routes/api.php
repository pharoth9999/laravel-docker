<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AudienceController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
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

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
*/
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

/*
|--------------------------------------------------------------------------
| TASK 3 – ELOQUENT RELATIONSHIP APIS (PUT HERE)
|--------------------------------------------------------------------------
| These are NOT protected by auth (unless required)
*/

Route::post('/authors', [AuthorController::class, 'store']);
Route::post('/articles', [ArticleController::class, 'store']);
Route::post('/audiences', [AudienceController::class, 'store']);
Route::post('/subscribe', [AudienceController::class, 'subscribe']);
Route::post('/comments', [CommentController::class, 'store']);

Route::get('/author/{name}/articles', [AuthorController::class, 'articles']);
Route::get('/author/{name}/audiences', [AuthorController::class, 'audiences']);
Route::get('/article/{name}/audiences', [ArticleController::class, 'audiences']);
Route::get('/audience/{name}/comments', [AudienceController::class, 'comments']);
Route::get('/comments', [CommentController::class, 'index']);
