/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

import Vue from "vue";
import Router from "vue-router";

import { routes } from "./routes";

Vue.use(Router);

let router = new Router({
    routes,
    linkExactActiveClass: "active",
    // linkActiveClass: "active-route",
    mode: "history",
    scrollBehavior(to, from, savedPosition) {
        return { x: 0, y: 0 };
    },
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("post-list", require("./components/PostList.vue").default);
Vue.component(
    "post-list-item",
    require("./components/PostListItem.vue").default
);
Vue.component("post-header", require("./components/PostHeader.vue").default);
Vue.component("navigation", require("./components/Navigation.vue").default);
Vue.component("tag-header", require("./components/TagHeader.vue").default);
Vue.component(
    "category-link",
    require("./components/CategoryLink.vue").default
);
Vue.component("post-link", require("./components/PostLink.vue").default);
Vue.component(
    "disqus-comments",
    require("./components/DisqusComments.vue").default
);
Vue.component("paginator", require("./components/Paginator.vue").default);
Vue.component("pagination", require("./components/PaginationLink.vue").default);
Vue.component("social-links", require("./components/SocialLinks.vue").default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router,
});
