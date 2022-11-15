import { createRouter, createWebHistory } from "vue-router";

import Home from "../pages/Home.vue";
import Login from "../pages/auth/Login.vue";
import Register from "../pages/auth/Register.vue";
import CartContent from "../components/CartContent.vue";
import Profile from "../components/Profile.vue";
import Payment from "../pages/Payment.vue";
import Orders from "../components/Orders.vue";
import Settings from "../components/setting.vue";
import DetailOrder from "../components/DetailOrder.vue";
import ThankYou from "../components/ThankYou.vue";

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
    {
        path: "/thank-you",
        name: "Thankyou",
        component: ThankYou,
    },
    {
        path: "/profile",
        name: "Profile",
        component: Profile,
        meta: { requiresAuth: true },
        children: [
            {
                path: "orders",
                component: Orders,
            
            },
            {
                path: "settings",
                component: Settings,
            },
            {
                path: "/detail-order/:id",
                component: DetailOrder,
            },
        ],
    },
    
    {
        path: "/payment",
        name: "payment",
        component: Payment,
        meta: { requiresAuth: true },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !localStorage.getItem("loggedIn")) {
        next({ name: "Login" });
    } else {
        next();
    }
});

export default router;
