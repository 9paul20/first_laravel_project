@extends('layout')

@section('content')

    <section class="posts container">

        @if(isset($title))
            <h3>{{ $title }}</h3>
        @endif

        @foreach($posts as $post)
		<article class="post">
            {{--@include($post->viewType('home')) en caso de querer usar el metodo de Post.php--}}
            @if($post->photos->count() === 1)
                @include('posts.photo')
            @elseif($post->photos->count() > 1)
                <div class="gallery-photos" data-masonry='{ "itemSelector":".grid-item", "columnWidth":464 }'>
                @foreach($post->photos->take(4) as $photo)
                    <figure class="grid-item grid-item--height2">
                        @if($loop->iteration === 4)
                            <div class="overlay">{{ $post->photos->count() }} Fotos</div>
                        @endif
                        <img src="{{ url('/storage/'.$photo->url) }}" class="img-responsive" alt="">
                    </figure>
                @endforeach
                </div>
            @elseif($post->iframe)
                <div class="video">
                    @include('posts.iframe')
                </div>
            @endif
			<div class="content-post">

				@include('posts.header')
                @include('posts.title')

				<div class="divider"></div>
				<p>{{ $post->excerpt }}</p>
				<footer class="container-flex space-between">
					<div class="read-more">
						<a href="{{ route('posts.show', $post) }}" class="text-uppercase c-green">Leer Post</a>
					</div>
					@include('posts.tags')
				</footer>
			</div>
		</article>
        @endforeach

	</section><!-- fin del div.posts.container -->

    {{ $posts->links() }}

@endsection
