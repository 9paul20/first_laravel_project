<template>
    <router-link :to="{ name: 'Posts_Show', params: { url: post.url } }">
        <slot />
    </router-link>
</template>

<script>
export default {
    props: ['post']
}
</script>

<style></style>
