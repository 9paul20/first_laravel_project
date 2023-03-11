@extends('admin.layout')

@section('content')
    <div>
        <div class="card card-primary card-outline">
            <div class="box box-header card-header">
                <h3>Datos</h3>
            </div>
            <div class="card-body">
                @include('admin\partials\error-messages')
                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input name="email" id="email" type="email" value="{{ old('email', $user->email) }}"
                            class="form-control"">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input name="password" id="password" type="password" value="" class="form-control""
                            placeholder="Contraseña">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Repite la Contraseña:</label>
                        <input name="password_confirmation" id="password_confirmation" type="password" value=""
                            class="form-control"" placeholder="Repite la Contraseña">
                    </div>
                    <button class="btn btn-primary btn-block">Guardar cambios</button>
                </form>
            </div>
        </div>
        @can('updateUsersForRolesPermissions', $user)
            {{-- @role('Admin') --}}
            <div class="card card-primary card-outline">
                <div class="box-header card-header">
                    <h3>Roles</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <form method="POST" action="{{ route('admin.users.roles.update', $user) }}">
                            {{ csrf_field() }}{{ method_field('PUT') }}
                            @include('admin.users.roles.checkboxes')
                            <button class="btn btn-primary btn-block">Guardar Cambios</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="box-header card-header">
                    <h3>Permisos</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.permissions.update', $user) }}">
                        {{ csrf_field() }}{{ method_field('PUT') }}
                        @include('admin.users.permissions.checkboxes', ['model' => $user])
                        <button class="btn btn-primary btn-block">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        @else
            <div class="card card-primary card-outline">
                <div class="box-header card-header">
                    <h3>Roles</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse ($user->roles as $role)
                            <li class="list-group-item">{{ $role->name }}</li>
                        @empty
                            <li class="list-group-item">No Tiene Roles</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="box-header card-header">
                    <h3>Permisos</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse ($user->permissions as $permission)
                            <li class="list-group-item">{{ $permission->name }}</li>
                        @empty
                            <li class="list-group-item">No Tiene Permisos</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            {{-- @endrole --}}
        @endcan
    @endsection
