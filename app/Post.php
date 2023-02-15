<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'iframe',
        'excerpt',
        'published_at',
        'category_id',
    ];

    protected $dates = ['published_at'];

    protected static function boot(){
        parent::boot();
        static::deleting(function ($post) {
            $post->tags()->detach();
            $post->photos->each->delete();
        });
    }

    public function getRouteKeyName(){
        return 'url';
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function scopePublished($query){
        $query->whereNotNull('published_at')
            ->where('published_at','<=',Carbon::now())
            ->latest('published_at');
    }

    public static function create(array $attributes = []){
        $post = static ::query()->create($attributes);
        $post -> generateUrl();
        return $post;
    }

    public function generateUrl(){
        $url = str_slug($this->title);
        if($this->whereUrl($url)->exists()){
            $url = "{$url}-{$this->id}";
        }
        $this->url = $url;
        $this->save();
    }

    /*public function setTitleAttribute($title){
        $this->attributes['title'] = $title;
        $url = str_slug($title);
        $duplicateUrlCount = Post::where('url', 'LIKE', "{$url}%")->count();
        if($duplicateUrlCount){
            $url .= "-" . ++$duplicateUrlCount;
        }
        $this->attributes['url'] = $url;
        return $this;
    }*/

    public function setPublishedAtAttribute($published_at){
        $this->attributes['published_at'] = $published_at
            ? Carbon::parse($published_at)
            : null;
    }

    public function setCategoryIdAttribute($category_id){
        $this->attributes['category_id'] = Category::find($category_id)
            ? $category_id
            : Category::create(['name' => $category_id])->id;
    }

    public function syncTags($tags){
        $tagIds = collect($tags)->map(function($tag){
            return Tag::find($tag)
                ? $tag
                : Tag::create(['name' => $tag])->id;
        });
        return $this->tags()->sync($tagIds);
    }
}
