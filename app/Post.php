<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
        'user_id',
    ];

    protected $dates = ['published_at'];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($post) {
            $post->tags()->detach();
            $post->photos->each->delete();
        });
    }

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopePublished($query)
    {
        $query->with(['category', 'tags', 'owner', 'photos'])
            ->whereNotNull('published_at')
            ->where('published_at', '<=', Carbon::now())
            ->latest('published_at');
    }

    public function scopeByYearAndMonth($query)
    {
        return $query->selectRaw('YEAR(published_at) AS year,
                            MONTH(published_at) AS month,
                            MONTHNAME(published_at) AS monthname,
                            COUNT(*) AS posts')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->groupBy('year', 'month', 'monthname')
            ->orderByDesc(DB::raw('MAX(published_at)'));
    }

    public function isPublished()
    {
        return !is_null($this->published_at) && $this->published_at < today();
    }

    public static function create(array $attributes = [])
    {
        $attributes['user_id'] = auth()->id();
        $post = static::query()->create($attributes);
        $post->generateUrl();
        return $post;
    }

    public function generateUrl()
    {
        $url = str_slug($this->title);
        if ($this->whereUrl($url)->exists()) {
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

    public function setPublishedAtAttribute($published_at)
    {
        $this->attributes['published_at'] = $published_at
            ? Carbon::parse($published_at)
            : null;
    }

    public function setCategoryIdAttribute($category_id)
    {
        $this->attributes['category_id'] = Category::find($category_id)
            ? $category_id
            : Category::create(['name' => $category_id])->id;
    }

    public function syncTags($tags)
    {
        $tagIds = collect($tags)->map(function ($tag) {
            return Tag::find($tag)
                ? $tag
                : Tag::create(['name' => $tag])->id;
        });
        return $this->tags()->sync($tagIds);
    }

    public function scopeAllowed($query)
    {
        if (auth()->user()->can('view', $this)) {
            return $query;
        }
        return $query->where('user_id', auth()->id());
    }

    /*public function viewType($home = ''){
        if($this->photos->count() == 1):
            return 'posts.photo';
        elseif ($this->photos->count() > 1) :
            return $home === 'home' ? 'posts.carrousel-preview': 'posts.carrousel'
        elseif($this->iframe) :
            return 'posts.iframe';
        else:
            return 'posts.text'; --> en este proyecto es necesario crear las vistas carrousel, el carrousel-preview y text <--
    }*/
}