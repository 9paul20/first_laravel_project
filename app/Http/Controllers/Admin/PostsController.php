<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StorePostRequest;
use Carbon\Carbon;
use App\Post;
use App\Category;
use App\Tag;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $posts = Post::allowed()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function store(Request $request){
        $this->authorize('create', new Post);
        $this->validate($request,[
            'title'=> 'required|min:3'
        ]);
        $post = Post::create($request->all());
        return redirect()->route('admin.posts.edit', $post);
    }

    function edit(Post $post){
        $this->authorize('update', $post);
        return view('admin.posts.edit', [
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'post' => $post
        ]);
    }

    public function update(Post $post, StorePostRequest $request){
        $post->update($request->all());
        $post->syncTags($request->get('tags'));
        return redirect()
            ->route('admin.posts.edit', $post)
            ->with('flash','Tu post se há actualizado');
    }

    public function destroy(Post $post){
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()
            ->route('admin.posts.index')
            ->with('flash', 'Tu post se há eliminado');
    }
}
