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
                    <h1 class="m-0">Todos los Posts</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            {{--<form metod="POST" action="{{ route('logout') }}">
                                {{ csrf_field() }}
                                <a type="button" href="{{ route('logout') }}">Cerrar Sesión</a>
                            </form>--}}
                            <a href="#" id="logout">Cerrar Session</a>
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

@section ('content')
    <h1>Posts</h1>
    <p>{{ auth()->user()->name }}</p>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">DataTable de los Posts</h3>
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-xl"><i class="fas fa-plus"></i> Crear Post</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="post-table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Titulo</th>
                                    <th>Extracto</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ $post->id }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->excerpt }}</td>
                                            <td>
                                                <a href="{{ route('posts.show',$post) }}" class="btn btn-xs btn-default" target="_blank"><i class="far fa-eye"></i></a>
                                                <a href="{{ route('admin.posts.edit',$post) }}" class="btn btn-xs btn-info"><i class="far fa-edit"></i></a>
                                                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" style="display: inline">
                                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                                    <button class="btn btn-xs btn-danger"
                                                    onclick="return confirm('¿Quieres eliminar la publicación?')">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Por Identificador</th>
                                    <th>Por Titulo</th>
                                    <th>Resumen</th>
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
        $(function () {
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
    </script>
@endpush
