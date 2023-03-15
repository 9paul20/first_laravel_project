<template>
    <div>
        <paginator :url="`/api/categories/${this.category}`" component-name="post-list"></paginator>
    </div>
</template>

<script>
export default {
    props: ['category']
}
</script>

<style></style>
