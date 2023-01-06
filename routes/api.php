<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ViewController;
use App\Models\Story;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function() {
    // User
    Route::get('/user', [AuthController::class, 'user']);
    Route::put('/user', [AuthController::class, 'update']);
    Route::put('/user/noimage', [AuthController::class, 'updateNoImage']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/userId', [AuthController::class, 'userId']);

    // Post
    Route::get('/posts', [PostController::class, 'index']); // all posts
    Route::post('/posts', [PostController::class, 'store']); // create post
    Route::get('/posts/{user_id}', [PostController::class, 'post_peruser']); // all posts
    Route::get('/post/{id}', [PostController::class, 'show']); // get single post
    Route::put('/posts/{id}', [PostController::class, 'update']); // update post
    Route::delete('/posts/{id}', [PostController::class, 'destroy']); // delete post

    // Comment
    Route::get('/posts/{id}/comments', [CommentController::class, 'index']); // all comments of a post
    Route::post('/posts/{id}/comments', [CommentController::class, 'store']); // create comment on a post
    Route::put('/comments/{id}', [CommentController::class, 'update']); // update a comment
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']); // delete a comment

    // Like
    Route::post('/posts/{id}/likes', [LikeController::class, 'likeOrUnlike']); // like or dislike back a post
    Route::post('/posts/{id}/likesOnly', [LikeController::class, 'like']); // like or dislike back a post4

    Route::post('/story/{id}/viewed ', [ViewController::class, 'store']); // like or dislike back a post
    // Search
    Route::post('/search', [SearchController::class, 'index']);

    // Post Video
    Route::post('/posts/video', [PostController::class, 'storeVideo']);

    // Stories
    Route::get('/stories', [StoryController::class, 'index']); // all posts
    Route::post('/storiesImage', [StoryController::class, 'indexImage']); // all posts
    Route::post('/stories', [StoryController::class, 'store']); // create post

    Route::get('/cek', function(){
        $cek =  Story::where('created_at', '<=', Date::now()->format('Y-m-d H:i:s'))->get();

        // dd(Date::now()->format('Y-m-d H:i:s') >= "2022-09-09 07:55:21");
        dd($cek);
    }); // all posts
});
