<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StorePostRequest;
use Carbon\Carbon;
use App\Post;
use App\Category;
use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'title'=> 'required|min:3'
        ]);
        $post = Post::create(
            $request->only('title')
        );
        return redirect()->route('admin.posts.edit', $post);
    }

    function edit(Post $post){
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('categories','tags', 'post'));
    }

    public function update(Post $post, StorePostRequest $request){
        $post->update($request->all());

        $post->syncTags($request->get('tags'));

        return redirect()
            ->route('admin.posts.edit', $post)
            ->with('flash','Tu post se há actualizado');
    }

    public function destroy(Post $post){
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('flash', 'Tu post se há eliminado');
    }
}
