import { createRouter, createWebHistory } from "vue-router";

import Home from '../pages/Home.vue';
import Login from '../pages/auth/Login.vue';
import Register from '../pages/auth/Register.vue';
import CartContent from '../components/CartContent.vue';

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/cartcontent",
        name: "CartContent",
        component: CartContent,
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/register",
        name: "Register",
        component: Register,
    },
   
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;