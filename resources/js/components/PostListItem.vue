<template>
    <div class="content-post">
        <post-header :post="post"></post-header>
        <div class="image-w-text">
            <div v-html="post.excerpt"></div>
        </div>
        <footer class="container-flex space-between">
            <div class="read-more">
                <!-- <a :href="`/blog/${post.url}`" class="text-uppercase c-green">Leer Post</a> -->
                <router-link :to="{ name: 'Posts_Show', params: { url: post.url } }" class="text-uppercase c-green">Leer
                    Post</router-link>
            </div>
            <div class="tags container-flex">
                <tag-header :post="post"></tag-header>
            </div>
        </footer>
    </div>
</template>

<script>
export default {
    props: ['post']
}
</script>

<style></style>
