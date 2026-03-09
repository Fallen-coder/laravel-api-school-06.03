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
    public function index(Post $post)
    {
        return $post->comments()->whereNull('flagged_at')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $fields = $request->validate([
            'content' => 'required'
        ]);


        $comment = $request->user()->comments()->create([
            'content' => $fields['content'],
            'post_id' => $post->id
        ]);

        return $comment;
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment,Post $post)
    {
        return $comment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment,Post $post)
    {
        Gate::authorize('modify', $comment);
        $fields = $request->validate([
            'content' => 'required'
        ]);

        $comment->update($fields);

        return $comment;
    }
    public function flag(Post $post, Comment $comment, Request $request)
    {
        if($request->user()->id !== $post->user_id){
            return response()->json([
                "message"=>"Only post author can flag comments"
            ],403);
        }

        $comment->flagged_at = now();
        $comment->save();

        return [
            "message"=>"Comment flagged"
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment,Post $post)
    {
        Gate::authorize('modify', $comment);
        $comment->delete();
        return ['message' => "The post ($comment->id) has been deleted"];
    }
}
