<template>
    <div>
        <header class="container-flex space-between">
            <div class="date">
                <span class="c-gris">
                    {{ post.published_date }} / {{ post.owner.name }}
                </span>
            </div>
            <div class="post-category">
                <span class="category">
                    <category-link :category="post.category"></category-link>
                </span>
            </div>
        </header>
        <h1>{{ post.title }}</h1>
        <div class="divider"></div>
    </div>
</template>

<script>
export default {
    props: ['post']
}
</script>

<style></style>
