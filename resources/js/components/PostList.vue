<template>
    <section class="posts container">
        <article v-for="post in items" class="post" :key="post.id">
            <post-list-item :post="post" :key="post.id"></post-list-item>
        </article>
        <article class="post" v-if="!items.length">
            <div class="content-post">
                <h1>No Hay Publicaciones</h1>
                <div class="divider"></div>
            </div>
        </article>
    </section>
</template>

<script>
export default {
    props: ['items']
}
</script>

<style></style>
