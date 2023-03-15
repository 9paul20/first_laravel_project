<template>
    <router-link :to="{ name: 'Categories_Show', params: { category: category.url } }">
        {{ category.name }}
    </router-link>
</template>

<script>
export default {
    props: ['category']
}
</script>

<style></style>
