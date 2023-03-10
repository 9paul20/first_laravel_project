@extends('admin.layout')


@section('content')
    <h1>Crear Usuario</h1>
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Crear Un Usuario</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.users.store') }}">
                @include('admin\partials\error-messages')
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Un Nombre y Apellido" value="{{ old('name') }}">
                  </div>
                  <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="ejemplo@direccion.com" value="{{ old('email') }}">
                  </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="form-group card card-primary card-outline col-md-5" style="margin-right:10px">
                        <div class="box-header card-header">
                            <h3>Roles</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                @include('admin.users.roles.checkboxes')
                            </div>
                        </div>
                    </div>
                    <div class="form-group card card-primary card-outline col-md-5" style="margin-left:10px">
                        <div class="box-header card-header">
                            <h3>Permisos</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                @include('admin.users.permissions.checkboxes', ['model' => $user])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <span class="help block">La contraseña se genará automaticamente y se enviará al correo</span>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-block">Crear Cuenta</button>
                </div>
              </form>
            </div>
@endsection
