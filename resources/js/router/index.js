import {createRouter, createWebHistory} from "vue-router";
import Home from "@/Pages/Home.vue";
import Upload from "@/Pages/Upload.vue";
import Books from "@/Pages/Books.vue";
import Search from "@/Pages/Search.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: Home
    },
    {
        path: "/upload",
        name: "upload",
        component: Upload
    },
    {
        path: "/books",
        name: "books",
        component: Books
    },
    {
        path: "/search",
        name: "search",
        component: Search
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router