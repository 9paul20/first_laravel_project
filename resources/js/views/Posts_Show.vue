<template>
    <article class="post container">
        <!-- {{ --@include($post -> viewType()) en caso de querer usar el metodo de Post.php-- }} -->
        <!-- @if($post->photos->count() === 1)
                @include('posts.photo')
            @elseif($post->photos->count() > 1) -->
        <!-- @elseif($post->iframe)
                @include('posts.iframe')
            @endif -->
        <div class="content-post">
            <post-header :post="post"></post-header>
            <div class="image-w-text">
                <div v-html="post.body"></div>
            </div>

            <footer class="container-flex space-between">
                <div class="tags container-flex"></div>
                <div class="tags container-flex">
                    <span class="tag c-gris" v-for="tag in post.tags" :key="tag.id">
                        <a href="">#{{ tag.name }}</a>
                    </span>
                </div>
                <!-- @include('partials.social-links')
                    @include('posts.tags') -->
            </footer>
            <!-- @include('partials.disqus-script') -->
        </div>
        <disqus-comments></disqus-comments>
    </article>
</template>

<script>
export default {
    props: ['url'],
    data() {
        return {
            post: {
                owner: {},
                category: {}
            }
        }
    }, mounted() {
        axios
            .get(`/api/blog/${this.url}`)
            .then(response => {
                this.post = response.data;
            }).catch(err => {
                console.log(err.response.data)
            })
    }
}
</script>

<style></style>
