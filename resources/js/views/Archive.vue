<template>
    <section class="pages container">
        <div class="page page-archive">
            <h1 class="text-capitalize">archive</h1>
            <p>Nam efficitur, massa quis fringilla volutpat, ipsum massa consequat nisi, sed eleifend orci sem sodales
                lorem. Curabitur molestie eros urna, eleifend molestie risus placerat sed.</p>
            <div class="divider-2" style="margin: 35px 0;"></div>
            <div class="container-flex space-between">
                <div class="authors-categories">
                    <h3 class="text-capitalize">authors</h3>
                    <ul class="list-unstyled">
                        <li v-for="author in authors" v-text="author.name"></li>
                        <!-- @foreach ($authors as $author)
                                <li><a href="">{{ $author -> name }}</a></li>
                            @endforeach -->
                    </ul>
                    <h3 class="text-capitalize">categories</h3>
                    <ul class="list-unstyled">
                        <li v-for="category in categories">
                            <category-link :category="category"></category-link>
                        </li>
                        <!-- @foreach ($categories as $category)
                                <li class="text-capitalize"><a
                                        href="{{ route('categories.show', $category) }}">{{ $category -> name }}</a></li>
                            @endforeach -->
                    </ul>
                </div>
                <div class="latest-posts">
                    <h3 class="text-capitalize">latest posts</h3>
                    <li v-for="post in posts">
                        <post-link :post="post">{{ post.title }}</post-link>
                    </li>
                    <!-- @foreach ($posts as $post)
                            <p><a href="{{ route('posts.show', $post) }}">{{ $post -> title }}</a></p>
                        @endforeach -->
                    <h3 class="text-capitalize">posts by month</h3>
                    <ul class="list-unstyled">
                        <li v-for="arch in archive" class="text-capitalize">
                            {{ arch.monthname }} {{ arch.year }} ({{ arch.posts }})
                        </li>
                        <!-- @foreach ($archive as $date)
                                <li class="text-capitalize"><a
                                        href="{{ route('home', ['year' => $date->year, 'month' => $date->month, 'monthname' => $date->monthname]) }}">{{ $date -> monthname }}
                                        - {{ $date -> year }} ({{ $date -> posts }} Posts)</a></li>
                            @endforeach -->
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            authors: [],
            categories: [],
            posts: [],
            archive: [],
        };
    }, mounted() {
        axios
            .get("/api/archive")
            .then((response) => {
                // console.log(response.data);
                this.authors = response.data.authors;
                this.categories = response.data.categories;
                this.posts = response.data.posts;
                this.archive = response.data.archive;
            })
            .catch((err) => {
                console.log(err.response.data)
            });
    },
}
</script>

<style></style>
