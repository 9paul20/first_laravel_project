<template>
    <section class="posts container">
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
    <!-- fin del div.posts.container -->
</template>

<script>
export default {
    data() {
        return {
            posts: []
        }
    }, mounted() {
        axios
            .get(`/api/categories/${this.$route.params.category}`)
            .then((response) => {
                console.log(response.data);
                this.posts = response.data.data;
            })
            .catch((err) => {
                console.log(err.response.data)
            });
    }
}
</script>

<style></style>
