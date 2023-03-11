@extends('admin.layout')

@section('content')
    <div class="column">
        <div class="col-md-12">
            <h1>Datos de Usuario</h1>
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{ url('/adminlte/img/user4-128x128.jpg') }}"
                            alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{ $user->name }}</h3>

                    <p class="text-muted text-center">{{ $user->getRoleNames()->implode(', ') }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Publicaciones</b> <a class="float-right">{{ $user->posts->count() }}</a>
                        </li>
                    </ul>
                    @can('update', $user)
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-block"><b>Editar</b></a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h1>Posts del Usuario</h1>
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    @forelse ($user->posts as $post)
                        <a href="{{ route('posts.show', $post) }}" target="_blank">
                            <strong>{{ $post->title }}</strong>
                        </a>
                        <small class="text-muted"> Publicado el {{ $post->published_at->format('d/m/Y') }}</small><br>
                        <small class="text-muted">{{ $post->excerpt }}</small><br>
                        @unless($loop->last)
                            <hr>
                        @endunless
                    @empty
                        <strong>No tiene posts este usuario</strong>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h1>Roles del Usuario</h1>
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    @forelse ($user->roles as $role)
                        <strong>{{ $role->name }}</strong><br>
                        @if ($role->permissions->count())
                            <small class="text-muted">Permisos:
                                {{ $role->permissions->pluck('name')->implode(', ') }}</small><br>
                        @endif
                        @unless($loop->last)
                            <hr>
                        @endunless
                    @empty
                        <strong>No tiene roles este usuario</strong>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h1>Permisos del Usuario</h1>
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    @forelse ($user->permissions as $permission)
                        <small class="text-muted">{{ $permission->name }}</small><br>
                        @unless($loop->last)
                            <hr>
                        @endunless
                    @empty
                        <strong>No tiene permisos este usuario</strong>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
