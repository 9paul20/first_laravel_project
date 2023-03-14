<template>
    <post-list :posts="posts"></post-list>
</template>

<script>
export default {
    data() {
        return {
            posts: [],
        };
    }, mounted() {
        axios
            .get("/api/posts")
            .then((response) => {
                console.log(response.data);
                this.posts = response.data.data;
            })
            .catch((err) => {
                console.log(err.response.data)
            });
    },
};
</script>
