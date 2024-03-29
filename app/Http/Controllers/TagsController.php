<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = $tag->posts()->published()->paginate(10);
        if (request()->wantsJson()) {
            return $posts;
        }
        return view('pages.home', [
            'title' => "Publicaciones de la etiqueta $tag->name",
            'posts' => $posts
        ]);
    }
}