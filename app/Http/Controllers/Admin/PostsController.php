<?php

namespace App\Http\Controllers\Admin;

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

    /*
    public function create(){
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories','tags'));
    }
    */

    public function store(Request $request){
        $this->validate($request,['title'=> 'required']);
        $post = Post::create([
            'title' => $request->get('title'),
            'url' => str_slug($request->get('title')),
        ]);
        return redirect()->route('admin.posts.edit', $post);
    }

    function edit(Post $post){
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('categories','tags', 'post'));
    }

    public function update(Post $post, Request $request){
        //Validación
        $this->validate($request, [
            'title' =>'required',
            'excerpt' =>'required',
            'body' =>'required',
            'published_at' =>'required',
            'category_id' =>'required',
            'tags' =>'required',
        ]);
        $post->title = $request->get('title');
        $post->url = str_slug($request->get('title'));
        $post->excerpt = $request->get('excerpt');
        $post->body = $request->get('body');
        $post->published_at = $request->has('published_at') ? Carbon::parse($request->get('published_at')) : null;
        $post->category_id = $request->get('category_id');
        $post->save();
        //Etiquetas
        $post->tags()->sync($request->get('tags'));
        return back()->with('flash','Tu post se há actualizado');
    }
    /*
    public function store(Request $request){
        //Validación
        $this->validate($request, [
            'title' =>'required',
            'excerpt' =>'required',
            'body' =>'required',
            'published_at' =>'required',
            'category_id' =>'required',
            'tags' =>'required',
        ]);
        $post = new Post;
        $post->title = $request->get('title');
        $post->url = str_slug($request->get('title'));
        $post->excerpt = $request->get('excerpt');
        $post->body = $request->get('body');
        $post->published_at = $request->has('published_at') ? Carbon::parse($request->get('published_at')) : null;
        $post->category_id = $request->get('category_id');
        $post->save();
        //Etiquetas
        $post->tags()->attach($request->get('tags'));
        return back()->with('flash','Tu post se há creado');
    }
    */
}
