@extends('admin.layout')

@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Todos los Roles</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.posts.index') }}">Posts</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
    <h1>Roles</h1>
    <p>{{ auth()->user()->name }}</p>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">DataTable de los Roles</h3>
                            @can('create', Spatie\Permission\Models\Role::class)
                                <a href="{{ route('admin.roles.create') }}" type="button" class="btn btn-primary float-right">
                                    <i class="fas fa-plus"></i> Crear Rol</a>
                            @endcan
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="post-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Identificador</th>
                                        <th>Nombre</th>
                                        <th>Permisos</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->display_name }}</td>
                                            <td>{{ $role->permissions->pluck('display_name')->implode(', ') }}</td>
                                            <td>
                                                {{-- <a href="{{ route('admin.roles.show', $role) }}"
                                                    class="btn btn-xs btn-default"><i class="far fa-eye"></i></a> --}}
                                                @can('update', $role)
                                                    <a href="{{ route('admin.roles.edit', $role) }}"
                                                        class="btn btn-xs btn-info"><i class="far fa-edit"></i></a>
                                                @endcan
                                                @if ($role->id !== 1)
                                                    @can('delete', $role)
                                                        <form method="POST" action="{{ route('admin.roles.destroy', $role) }}"
                                                            style="display: inline">
                                                            {{ csrf_field() }} {{ method_field('DELETE') }}
                                                            <button class="btn btn-xs btn-danger"
                                                                onclick="return confirm('¿Quieres eliminar el Rol?')">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Por Identificador</th>
                                        <th>Por Identificación de Nombre</th>
                                        <th>Por Nombre</th>
                                        <th>Por Permisos</th>
                                        <th>Que hacer</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{ url('/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('/adminlte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('/adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('/adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(function() {
            //Tables
            @can('create', Spatie\Permission\Models\Role::class)
                $('#post-table').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#post-table_wrapper .col-md-6:eq(0)');
            @else
                $('#post-table').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true
                }).buttons().container().appendTo('#post-table_wrapper .col-md-6:eq(0)');
            @endcan
        });
    </script>
@endpush
