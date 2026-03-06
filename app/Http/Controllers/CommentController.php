<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller implements HasMiddleware
{

    public static function middleware() {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comment = Comment::all();
        return $comment;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'content' => 'required',
            'post_id' => 'required|exists:posts,id'
        ]);

        $comment = $request->user()->comments()->create($fields);
        return $comment;
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return $comment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        Gate::authorize('modify', $comment);
        $fields = $request->validate([
            'content' => 'required'
        ]);

        $comment->update($fields);

        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        Gate::authorize('modify', $comment);
        $comment->delete();
        return ['message' => "The post ($comment->id) has been deleted"];
    }
}
