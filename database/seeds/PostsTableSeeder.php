<?php

use App\Post;
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
        $post = new Post;
        $post->title = "Primer Post";
        $post->excerpt = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do";
        $post->body = "<p>Lorem ipsum dolor sit amet, consectetur adip</p>";
        $post->published_at = Carbon::now();
        $post->category_id = 1;
        $post->save();
    }
}
