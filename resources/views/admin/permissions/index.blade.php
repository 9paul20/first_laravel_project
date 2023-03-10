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
                    <h1 class="m-0">Todos los Permisos</h1>
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
                        <li class="breadcrumb-item active"><a href="{{ route('admin.permissions.index') }}">Permisos</a>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
    <h1>Permisos</h1>
    <p>{{ auth()->user()->name }}</p>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">DataTable de los Permisos</h3>
                            {{-- @can('create', Spatie\Permission\Models\Permission::class) --}}
                            @can('create', Spatie\Permission\Models\Permission::class)
                                <a href="{{ route('admin.permissions.create') }}" type="button"
                                    class="btn btn-primary float-right"><i class="fas fa-plus"></i> Crear Permiso</a>
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
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->id }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->display_name }}</td>
                                            <td>
                                                {{-- <a href="{{ route('admin.permissions.show', $permission) }}"
                                                    class="btn btn-xs btn-default"><i class="far fa-eye"></i></a> --}}
                                                @can('update', $permission)
                                                    <a href="{{ route('admin.permissions.edit', $permission) }}"
                                                        class="btn btn-xs btn-info"><i class="far fa-edit"></i></a>
                                                @endcan
                                                @can('delete', $permission)
                                                    <form method="POST"
                                                        action="{{ route('admin.permissions.destroy', $permission) }}"
                                                        style="display: inline">
                                                        {{ csrf_field() }} {{ method_field('DELETE') }}
                                                        <button class="btn btn-xs btn-danger"
                                                            onclick="return confirm('¿Quieres eliminar el Rol?')">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Por Identificador</th>
                                        <th>Por Identificación de Nombre</th>
                                        <th>Por Nombre</th>
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
        @can('create', Spatie\Permission\Models\Permission::class)
            $(function() {
                //Tables
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
            });
        @else
            $(function() {
                //Tables
                $('#post-table').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true
                }).buttons().container().appendTo('#post-table_wrapper .col-md-6:eq(0)');
            });
        @endcan
    </script>
@endpush
