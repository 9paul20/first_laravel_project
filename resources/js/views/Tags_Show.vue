<template>
    <section class="posts container">
        <!--  @if (isset($title))
            <h3>{{ $title }}</h3>
        @endif  -->

        <article v-for="post in posts" class="post" :key="post.id">
            <post-list-item :post="post" :key="post.id"></post-list-item>
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
</template>

<script>
export default {
    props: ['tag'],
    data() {
        return {
            posts: [],
        };
    },
    mounted() {
        axios
            .get(`/api/tags/${this.tag}`)
            .then((response) => {
                // console.log(response.data.data);
                this.posts = response.data.data;
            })
            .catch((err) => {
                console.log(err.response.data);
            });
    },
};
</script>

<style></style>
