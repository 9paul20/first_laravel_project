<div class="buttons-social-media-share">
    <ul class="share-buttons">
        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ request()->fullUrl() }}&t={{ $post->title }}" title="Share on Facebook" target="_blank"><img alt="Share on Facebook" src="/img/flat_web_icon_set/color/Facebook.png"></a></li>
        <li><a href="https://twitter.com/intent/tweet?url={{ request()->fullUrl() }}&text={{ $post->title }}&via={{ config('app.name') }}&hashtags={{ config('app.name') }}" target="_blank" title="Tweet"><img alt="Tweet" src="/img/flat_web_icon_set/color/Twitter.png"></a></li>
        <li><a href="http://pinterest.com/pin/create/button/?url={{ request()->fullUrl() }}&description={{ $post->excerpt }}" target="_blank" title="Pin it"><img alt="Pin it" src="/img/flat_web_icon_set/color/Pinterest.png"></a></li>
    </ul>
</div>
