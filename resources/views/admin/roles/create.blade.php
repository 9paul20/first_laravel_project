@extends('admin.layout')


@section('content')
    <h1>Crear Rol</h1>
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Crear Un Rol</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @include('admin\partials\error-messages')
              <form method="POST" action="{{ route('admin.roles.store') }}">
                {{ csrf_field() }}
                @include('admin.roles.form')
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-block">Crear Rol</button>
                </div>
              </form>
            </div>
@endsection
