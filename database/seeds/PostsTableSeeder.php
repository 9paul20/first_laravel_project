<?php

use App\Post;
use App\Category;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('posts');
        User::truncate();
        Category::truncate();
        Tag::truncate();
        Post::truncate();

        $category = new Category;
        $category->name = 'Categoria 1';
        $category->save();

        $category = new Category;
        $category->name = 'Categoria 2';
        $category->save();

        $category = new Category;
        $category->name = 'Categoria 3';
        $category->save();

        $category = new Category;
        $category->name = 'Categoria 4';
        $category->save();

        $post = new Post;
        $post->title = "Primer Post";
        $post->url = str_slug("Primer Post");
        $post->excerpt = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do";
        $post->body = "<p>Lorem ipsum dolor sit amet, consectetur adip</p>";
        $post->iframe = "";
        $post->published_at = Carbon::now()->subDays()->format('Y-m-d H:i:s');
        $post->category_id = 1;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'Tag 1']));

        $post = new Post;
        $post->title = "Segundo Post";
        $post->url = str_slug("Segundo Post");
        $post->excerpt = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do";
        $post->body = "<p>Lorem ipsum dolor sit amet, consectetur adip</p>";
        $post->iframe = "";
        $post->published_at = Carbon::now()->subDays(2)->format('Y-m-d H:i:s');
        $post->category_id = 2;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'Tag 2']));

        $post = new Post;
        $post->title = "Tercer Post";
        $post->url = str_slug("Tercer Post");
        $post->excerpt = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do";
        $post->body = "<p>Lorem ipsum dolor sit amet, consectetur adip</p>";
        $post->iframe = "";
        $post->published_at = Carbon::now()->format('Y-m-d H:i:s');
        $post->category_id = 2;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'Tag 3']));

        $post = new Post;
        $post->title = "Cuarto Post";
        $post->url = str_slug("Cuarto Post");
        $post->excerpt = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do";
        $post->body = "<p>Lorem ipsum dolor sit amet, consectetur adip</p>";
        $post->iframe = "";
        $post->published_at = Carbon::now()->format('Y-m-d H:i:s');
        $post->category_id = 1;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'Tag 4']));

        $post = new Post;
        $post->title = "Quinto Post";
        $post->url = str_slug("Quinto Post");
        $post->excerpt = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do";
        $post->body = "<p>Lorem ipsum dolor sit amet, consectetur adip</p>";
        $post->iframe = "";
        $post->published_at = Carbon::now()->format('Y-m-d H:i:s');
        $post->category_id = 1;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'Tag 5']));

        $user= new User;
        $user->name = 'Uno';
        $user->email = 'uno@correo.com';
        $user->password = bcrypt('123');
        $user->save();

        $user= new User;
        $user->name = 'John Doe';
        $user->email = 'john@doe.com';
        $user->password = bcrypt('123');
        $user->save();
    }
}
