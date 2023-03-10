<header class="container-flex space-between">
    @if (isset($post->published_at))
        <div class="date">
            <span class="c-gris">{{ $post->published_at->format('M d') }} / </span>
            <span class="c-gray-1">{{ $post->owner->name }}</span>
        </div>
    @else
        <div class="date">
            <span class="c-gris">Sin Fecha</span>
        </div>
    @endif
    @if (isset($post->published_at))
        <div class="post-category">
            <span class="category"><a
                    href="{{ route('categories.show', $post->category) }}">{{ $post->category->name }}</a></span>
        </div>
    @else
        <div class="post-category">
            <span class="category">Sin Categoria</span>
        </div>
    @endif
</header>
