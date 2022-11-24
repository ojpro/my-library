import {createRouter, createWebHistory} from "vue-router";
import Home from "@/Pages/Home.vue";
import Upload from "@/Pages/Upload.vue";
import Books from "@/Pages/Books.vue";

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
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router