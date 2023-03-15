<template>
    <div>
        <paginator :url="`/api/tags/${this.tag}`" component-name="post-list"></paginator>
    </div>
</template>

<script>
export default {
    props: ['tag']
};
</script>

<style></style>
