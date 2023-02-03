<?php

use App\Post;
use App\Category;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

        $tag = new Tag;
        $tag->name = 'Tag 1';
        $tag->save();

        $tag = new Tag;
        $tag->name = 'Tag 2';
        $tag->save();

        $tag = new Tag;
        $tag->name = 'Tag 3';
        $tag->save();

        $tag = new Tag;
        $tag->name = 'Tag 4';
        $tag->save();

        $tag = new Tag;
        $tag->name = 'Tag 5';
        $tag->save();

        $post = new Post;
        $post->title = "Primer Post";
        $post->excerpt = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do";
        $post->body = "<p>Lorem ipsum dolor sit amet, consectetur adip</p>";
        $post->published_at = Carbon::now()->subDays(2);
        $post->category_id = 1;
        $post->save();

        $post = new Post;
        $post->title = "Segundo Post";
        $post->excerpt = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do";
        $post->body = "<p>Lorem ipsum dolor sit amet, consectetur adip</p>";
        $post->published_at = Carbon::now()->subDays(2);
        $post->category_id = 2;
        $post->save();

        $post = new Post;
        $post->title = "Tercer Post";
        $post->excerpt = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do";
        $post->body = "<p>Lorem ipsum dolor sit amet, consectetur adip</p>";
        $post->published_at = Carbon::now();
        $post->category_id = 2;
        $post->save();

        $post = new Post;
        $post->title = "Cuarto Post";
        $post->excerpt = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do";
        $post->body = "<p>Lorem ipsum dolor sit amet, consectetur adip</p>";
        $post->published_at = Carbon::now();
        $post->category_id = 1;
        $post->save();

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
