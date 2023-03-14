<template>
    <section class="posts container">
        <article class="post">
            <div class="content-post">
                <h3>Home</h3>
                <!-- <router-view></router-view> -->
            </div>
        </article>

        <!--  @if (isset($title))
            <h3>{{ $title }}</h3>
        @endif  -->

        <article v-for="post in posts" class="post" :key="post.id">
            <div class="content-post">
                <span class="c-gris">{{ post . published_date }} / {{ post . owner . name }}</span>
                <h1 v-text="post.title"></h1>
                <header class="container-flex space-between">
                    <!-- @if (isset($post->published_at)) -->
                    <div class="date">
                        <!-- <span class="c-gris">{{ $post->published_at->format('M d') }} / </span> -->
                        <!-- <span class="c-gray-1">{{ $post->owner->name }}</span> -->
                    </div>
                    <!-- @if (isset($post->published_at)) -->
                    <div class="post-category">
                        <!-- <span class="category"><a
                        href="{{ route('categories.show', $post->category) }}">{{ $post->category->name }}</a></span> -->
                    </div>
                    <!--
@else
-->
                    <div class="post-category">
                        <span class="category">{{ post . category . name }}</span>
                    </div>
                    <!-- @endif -->
                </header>
                <div class="divider"></div>
                <p v-html="post.excerpt"></p>
                <footer class="container-flex space-between">
                    <div class="read-more">
                        <a href="#" class="text-uppercase c-green">Leer Post</a>
                    </div>
                    <div class="tags container-flex">
                        <span class="tag c-gris" v-for="tag in post.tags" :key="tag.id">
                            <a href="">#{{ tag.name }}</a>
                        </span>
                    </div>
                </footer>
            </div>
        </article>
    <!--  @empty-->
        <article class="post" v-if="!posts.length">
            <div class="content-post">
                <h1>No Hay Publicaciones</h1>
                <div class="divider"></div>
            </div>
        </article>
        <!--  @endforelse-->
    </section>
    <!-- fin del div.posts.container -->
</template>

<script>
    export default {
        data() {
            return {
                posts: [],
            };
        },
        mounted() {
            axios
                .get("/api/posts")
                .then((response) => {
                    this.posts = response.data.data;
                })
                .catch((err) => {});
        },
    };
</script>
