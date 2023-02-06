@extends('admin.layout')

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
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Posts</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
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
                                                <a class="btn btn-xs btn-info"><i class="far fa-edit"></i></a>
                                                <a class="btn btn-xs btn-danger"><i class="fas fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Browser</th>
                                    <th>Browser</th>
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
