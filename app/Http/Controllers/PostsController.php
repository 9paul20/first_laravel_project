<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        if ($post->isPublished() || auth()->check()) {
            if (request()->wantsJson()) {
                $post->load('owner', 'category', 'tags', 'photos');
                return $post;
            }
            return view('posts.show', compact('post'));
        } else {
            abort(404);
        }
    }
}