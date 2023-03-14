<template>
    <div>
        <span class="tag c-gris" v-for="tag in post.tags" :key="tag.id">
            <router-link :to="{ name: 'Tags_Show', params: { tag: tag.url } }">{{
                tag.name }}</router-link>
        </span>

    </div>
</template>

<script>
export default {
    props: ['post']
}
</script>

<style></style>
