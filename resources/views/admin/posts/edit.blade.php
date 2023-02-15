@extends('admin.layout')

@push('styles')
    <!-- daterange picker -->
    <link rel="stylesheet" href="/adminlte/plugins/daterangepicker/daterangepicker.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="/adminlte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/adminlte/plugins/summernote/summernote-bs4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Dropzone-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <div class="box">
        <div class="box-header">
            <div class="box-header">
                <h3 class="box-title">Crear Post</h3>
            </div>
        </div>
        <div class="box-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Creador del post</h3>
                </div>
                <form method="POST" action="{{ route('admin.posts.update', $post) }}">
                    {{ csrf_field() }} {{ method_field('PUT') }}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Titulo de la publicación</label>
                            <input type="text" class="form-control {{ $errors->has('title')? 'is-invalid' : '' }}" name="title" id="title" placeholder="Redacta tu titulo" value="{{ old('title', $post->title) }}">
                            @if ($errors->any())
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="excerpt">Extracto</label>
                            <input type="text" class="form-control {{ $errors->has('excerpt')? 'is-invalid' : '' }}" name="excerpt" id="excerpt" placeholder="Redacta el extracto del post" value="{{ old('excerpt', $post->excerpt) }}">
                            @if ($errors->any())
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('excerpt') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="body">Contenido</label>
                            <textarea name="body" id="body" >
                                {{-- Redacta <em>el</em> <u>cuerpo</u> del <strong>post</strong> --}}
                                {{ old('body', $post->body) }}
                            </textarea>
                            @if ($errors->any())
                                <strong class="text-danger">{{ $errors->first('body') }}</strong>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="iframe">Contenido HTML extra</label>
                            <textarea class="form-control" rows="3" name="iframe" id="iframe">
                                {{ old('iframe', $post->iframe) }}
                            </textarea>
                            @if ($errors->any())
                                <strong class="text-danger">{{ $errors->first('iframe') }}</strong>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Fecha</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" name="published_at" id="published_at" class="form-control datetimepicker-input {{ $errors->has('published_at')? 'is-invalid' : '' }}" data-target="#reservationdate" value="{{ old('published_at', $post->published_at ? $post->published_at->format('m/d/Y') : null) }}">
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @if ($errors->any())
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('published_at') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Categoria</label>
                            <div class="">
                                <select class="form-control select2 select2-blue {{ $errors->has('category_id')? 'is-invalid' : '' }}" data-dropdown-css-class="select2-blue" name="category_id" id="category_id">
                                    <option value="">Selecciona una categoria</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        @if ($errors->any())
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="tags">Etiquetas</label>
                            <div class="select2-blue">
                                <select class="select2" multiple
                                        name="tags[]" id="tags[]" data-dropdown-css-class="select2-blue"
                                        data-placeholder="Seleccione etiquetas" style="width: 100%;">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->any())
                                <strong class="text-danger">{{ $errors->first('tags') }}</strong>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="dropzone"></div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="fileup">Archivo a subir</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="fileup" id="fileup">
                                    <label class="custom-file-label" for="fileup">Buscar archivo</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Subir</span>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">Publicar</button>
                    </div>
                </form>
                <div class="row">
                    @if($post->photos->count())
                    @foreach($post->photos as $photo)
                        <form method="POST" action="{{ route('admin.photos.destroy', $photo) }}">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <div class="col-md-1">
                                <button class="btn btn-danger btn-xs" style="position: absolute"><i class="fas fa-times"></i></button>
                                <img class="img-responsive" src="/storage/{{ ($photo->url) }}" width="120" height="120">
                            </div>
                        </form>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        @endsection

        @push('scripts')
            <!-- InputMask -->
            <script src="/adminlte/plugins/moment/moment.min.js"></script>
            <script src="/adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>
            <!-- Tempusdominus Bootstrap 4 -->
            <script src="/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
            <!-- date-range-picker -->
            <script src="/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
            <!-- bootstrap color picker -->
            <script src="/adminlte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
            <!-- Summernote -->
            <script src="/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
            <!-- Select2 -->
            <script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
            <!--Dropzone-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            <script>
                $(function () {
                    //Date picker
                    $('#reservationdate').datetimepicker({
                    });
                    //Date and time picker
                    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
                    //Date range picker
                    $('#reservation').daterangepicker();
                    //Date range picker with time picker
                    $('#reservationtime').daterangepicker({
                        timePicker: true,
                        timePickerIncrement: 30,
                        locale: {
                            format: 'MM/DD/YYYY hh:mm A'
                        }
                    });
                    //Date range as a button
                    $('#daterange-btn').daterangepicker({
                            ranges   : {
                                'Today'       : [moment(), moment()],
                                'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                                'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                            },
                            startDate: moment().subtract(29, 'days'),
                            endDate  : moment()
                        },
                        function (start, end) {
                            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                        }
                    );
                    // Summernote
                    $('#body').summernote();
                    //Initialize Select2 Elements
                    $('.select2').select2({
                        tags: true,
                    });
                });
                var myDropzone = new Dropzone('.dropzone',{
                    url: '/admin/posts/{{ $post->url }}/photos',
                    acceptedFiles: 'image/*',
                    maxFilesize: 2,
                    paramName: 'photo',
                    thumbnailWidth: 200,
                    headers:{
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    dictDefaultMessage: 'Arrastra la imagen a subir',
                });
                myDropzone.on('error',function(file,res){
                    //console.log(res.errors.photo[0]);
                    var msg = res.errors.photo[0];
                    $('.dz-error-message:last > span').text(msg);
                });
                Dropzone.autoDiscover = false;
            </script>
    @endpush
