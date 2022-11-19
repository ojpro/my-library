import Home from "@/Pages/Home.vue";
import Upload from "@/Pages/Upload.vue";
import {createRouter, createWebHistory} from "vue-router";

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
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router