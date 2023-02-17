@extends('layout')

@push('styles')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ url('/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('/adminlte/css/adminlte.min.css') }}">
@endpush

@section('meta-title', $post->title)
@section('meta-description', $post->excerpt)

@section('content')
    <article class="post container">
        @if($post->photos->count() === 1)
            <figure><img src="{{ url('/storage/'.$post->photos->first()->url) }}" alt="" class="img-responsive"></figure>
        @elseif($post->photos->count() > 1)
                <div class="card-body">
                    <div id="carouselExampleIndicators" name="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                        @foreach($post->photos as $photo)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ ($loop->index) }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                        @endforeach
                        </ol>
                        <div class="carousel-inner">
                        @foreach($post->photos as $photo)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img class="d-block w-100" src="{{ url('/storage/'.$photo->url) }}" alt="">
                            </div>
                        @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-left"></i>
                    </span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-right"></i>
                    </span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
        @elseif($post->iframe)
            <div class="video">
                <!--                    <iframe width="100%" height="480" src="https://www.youtube.com/embed/Zsqep7_9_mw?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>-->
                {!! $post->iframe !!}
            </div>
        @endif
        <div class="content-post">
            <header class="container-flex space-between">
                @if(isset($post->published_at))
                    <div class="date">
                        <span class="c-gris">{{ $post->published_at->format('M d') }}</span>
                    </div>
                @else
                    <div class="date">
                        <span class="c-gris">Sin Fecha</span>
                    </div>
                @endif
                @if(isset($post->published_at))
                        <div class="post-category">
                            <span class="category">{{ $post->category->name }}</span>
                        </div>
                    @else
                        <div class="post-category">
                            <span class="category">Sin Categoria</span>
                        </div>
                    @endif
            </header>
            <h1>{{ $post->title }}</h1>
            <div class="divider"></div>
            <div class="image-w-text">
                <div>
                    {!! $post->body !!}
                </div>
            </div>

            <footer class="container-flex space-between">
                @include('partials.social-links')
                <div class="tags container-flex">
                    @foreach($post->tags as $tag)
                        <span class="tag">#{{ $tag->name }}</span>
                    @endforeach
                </div>
            </footer>
            @include('partials.disqus-script')
        </div>
    </article>
@endsection

@push('scripts')
    <!-- jQuery -->
    <script src="{{ url('/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('/adminlte/js/adminlte.min.js') }}"></script>
    <!-- Zendero -->
    <script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
@endpush
