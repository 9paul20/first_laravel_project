@extends('admin.layout')


@section('content')
    <h1>Editar Permiso</h1>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar Un Permiso</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @include('admin\partials\error-messages')
        <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
            {{ method_field('PUT') }}
            @include('admin.permissions.form')
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-block">Actualizar Permiso</button>
            </div>
        </form>
    </div>
@endsection
