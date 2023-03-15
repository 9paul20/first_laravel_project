<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function spa()
    {
        return view('pages.spa');
    }

    public function home()
    {
        //TODO: se pueden pregargar las consultas, lo que hacemos aqui es simplemente relacionar las consultas de la base de datos a pocas peticiones, ya que dependiendo de los objetos y referencias que llame el metodo, son consultas independientes, por lo que se reducen notoriamente y la optimización es notoria.
        //TODO: También lo que hacemos es que se pueden pregargar las consultas creando la variable de entorno $with en la clase prinicipal de Post o la que es correspondiente con cada proyecto
        // $query = Post::with(['category', 'tags', 'owner', 'photos'])->published();
        $query = Post::published();
        if (request('month')) {
            $query->whereMonth('published_at', request('month'));
        }
        if (request('year')) {
            $query->whereYear('published_at', request('year'));
        }
        $posts = $query->paginate(10);

        if (request()->wantsJson()) {
            return $posts;
        }
        // $posts = Post::published()->paginate(10);
        return view('pages.home', compact('posts'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function archive()
    {
        \DB::statement("SET lc_time_names = 'es_ES'");
        //TODO: Es recomendable trabajar con un dd() o return la variable archive, así se sabe como se van a regresar los valores y que valores está dando
        $archive = [
            'authors' => User::latest()->take(4)->get(),
            'categories' => Category::take(7)->get(),
            'posts' => Post::latest('published_at')->take(5)->get(),
            'archive' => Post::selectRaw('YEAR(published_at) year')
                ->selectRaw('month(published_at) month')
                ->selectRaw('monthname(published_at) monthname')
                ->selectRaw('COUNT(*) posts')
                ->groupBy('year', 'month', 'monthname')
                ->orderByRaw('MIN(published_at)')
                ->get()
        ];
        if (request()->wantsJson()) {
            return $archive;
        }
        // $archive = Post::byYearAndMonth()->get();
        return view('pages.archive', $archive);
    }

    public function contact()
    {
        return view('pages.contact');
    }
}