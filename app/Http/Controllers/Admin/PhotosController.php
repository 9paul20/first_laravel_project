<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Photo;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function store(Post $post){
        //Puede que no funcione, entonces hay que agregar o cambiar la instruccion en php.ini
        //  upload_tmp_dir = "C:\Users\{my_user}\AppData\Local\Temp" o la ruta "C:\Windows\Temp" 
        //return request()->all();
        $this->validate(request(), [
            'photo' => 'required|image|max:2048'
        ]);
        $post->photos()->create([
            'url' => request()->file('photo')->store('posts', 'public'),
        ]);
    }

    public function destroy(Photo $photo){
        $photo->delete();
        return back()->with('flash', 'Foto eliminada');
    }
}
