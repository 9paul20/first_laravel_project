@extends('admin.layout')


@section('content')
    <h1>Editar Rol</h1>
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Editar Un Rol</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @include('admin\partials\error-messages')
              <form method="POST" action="{{ route('admin.roles.update', $role) }}">
                {{ method_field('PUT') }}
                @include('admin.roles.form')
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-block">Actualizar Rol</button>
                </div>
              </form>
            </div>
@endsection
