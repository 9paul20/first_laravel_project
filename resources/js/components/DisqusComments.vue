<template>
    <div class="content-post">
        <div class="comments">
            <div class="divider"></div>
            <div id="disqus_thread"></div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        (function () { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://zendero.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    }
}
</script>

<style></style>
