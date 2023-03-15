import Home from "../views/Home.vue";
import About from "../views/About.vue";
import Archive from "../views/Archive.vue";
import Contact from "../views/Contact.vue";
import Posts_Show from "../views/Posts_Show.vue";
import Categories_Show from "../views/Categories_Show.vue";
import Tags_Show from "../views/Tags_Show.vue";
import notFound from "../views/404.vue";

export const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/about",
        name: "About",
        component: About,
    },
    {
        path: "/archive",
        name: "Archive",
        component: Archive,
    },
    {
        path: "/contact",
        name: "Contact",
        component: Contact,
    },
    {
        path: "/blog/:url",
        name: "Posts_Show",
        component: Posts_Show,
        props: true,
    },
    {
        path: "/categories/:category",
        name: "Categories_Show",
        component: Categories_Show,
        props: true,
    },
    {
        path: "/tags/:tag",
        name: "Tags_Show",
        component: Tags_Show,
        props: true,
    },
    {
        path: "*",
        component: notFound,
    },
];
