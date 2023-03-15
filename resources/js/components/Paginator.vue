<template>
    <div>
        <component :is="componentName" :items="items"></component>
        <pagination :pagination="pagination" />
    </div>
</template>

<script>
export default {
    props: ['url', 'componentName'],
    data() {
        return {
            items: [],
            pagination: {},
        }
    },
    mounted() {
        axios
            .get(`${this.url}?page=${this.$route.query.page || 1}`)
            .then((response) => {
                this.pagination = response.data;
                this.items = response.data.data;
                delete this.pagination.data;
            })
            .catch((err) => {
                console.log(err.response.data)
            });
    }
}
</script>

<style lang="scss">
.pagination {
    a.active {
        background-color: #1ABC9C;
        color: white;
    }
}
</style>
