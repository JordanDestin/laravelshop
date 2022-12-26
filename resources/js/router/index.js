import { createRouter, createWebHistory } from "vue-router";

import Home from "../pages/Home.vue";
import Category from "../components/commerce/product/category/Category.vue"
import Login from "../pages/auth/Login.vue";
import Register from "../pages/auth/Register.vue";
import Cart from "../components/commerce/cart/Cart.vue";
import CartContent from "../components/commerce/cart/CartContent.vue";
import Account from "../components/commerce/account/Account.vue";
import Profile from "../components/commerce/account/profile/Profile.vue";
import Payment from "../pages/Payment.vue";
import Orders from "../components/commerce/account/order/Orders.vue";
import DetailOrder from "../components/commerce/account/order/DetailOrder.vue";
import ThankYou from "../components/ThankYou.vue";
import CancelStripe from "../components/CancelStripe.vue";
import Dashboard from "../components/admin/Dashboard.vue";
import CreateProduct from "../components/admin/product/CreateProduct.vue";
import ListProduct from "../components/admin/product/ListProduct.vue";
import ListCategory from "../components/admin/category/ListCategory.vue";
import Product from "../components/admin/product/Product.vue";
import ListOrder from "../components/admin/orders/ListOrder.vue";
import ListUser from "../components/admin/user/ListUser.vue";
import OrdersUser from "../components/admin/user/UserOrder.vue";
import ListAddress from "../components/commerce/account/address/ListAddress.vue";
import CreateAddress from "../components/commerce/account/address/CreateAddress.vue";
import Address from "../components/commerce/account/address/Address.vue";
import LoginAdmin from "../components/admin/auth/LoginAdmin.vue";
import ChoiceAdresse from "../components/commerce/cart/ChoiceAdress.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/category/:id",
        name: "category",
        component: Category,
    },
    {
        path: "/cart",
        name: "Cart",
        component: Cart,
    },
    {
        path: "/cartcontent",
        name: "CartContent",
        component: CartContent,
    },

    {
        path: "/choice-adress",
        name: "ChoiceAdresse",
        component: ChoiceAdresse,
        meta: { requiresAuth: true },
    },
    {
        path: "/createaddress",
        component: CreateAddress,
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
        beforeEnter: (to, from) => {
            if (localStorage.getItem("loggedIn")) {
                return "/";
            }
        },
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
        path: "/cancel-stripe",
        name: "CancelStripe",
        component: CancelStripe,
    },
    {
        path: "/account",
        name: "Account",
        component: Account,
        meta: { requiresAuth: true },
        children: [
            {
                path: "orders",
                component: Orders,
                meta: { requiresAuth: true },
            },
            {
                path: "/detail-order/:id",
                component: DetailOrder,
                meta: { requiresAuth: true },
            },
            {
                path: "profile",
                component: Profile,
                meta: { requiresAuth: true },
            },
            {
                path: "list-address",
                component: ListAddress,
                meta: { requiresAuth: true },
            },
            {
                path: "create-address",
                component: CreateAddress,
                meta: { requiresAuth: true },
            },
            {
                path: "/address/:id",
                component: Address,
                meta: { requiresAuth: true },
            },
        ],
    },

    {
        path: "/payment/:adressId",
        name: "payment",
        component: Payment,
        meta: { requiresAuth: true },
    },
    // ADMIN

    {
        path: "/login-back",
        name: "Login-back",
        component: LoginAdmin,
    },
    {
        path: "/dashboard",
        name: "dashboard",
        component: Dashboard,
        meta: { requiresAuthBack: true },
        children: [
            {
                path: "list-product",
                component: ListProduct,
            },
            {
                path: "product/:productid",
                component: Product,
            },
            {
                path: "create-product",
                component: CreateProduct,
            },
            {
                path: "list-category",
                component: ListCategory,
            },
            {
                path: "list-order",
                component: ListOrder,
            },
            {
                path: "list-user",
                component: ListUser,
            },
            {
                path: "order-user/:id",
                component: OrdersUser,
                meta: { requiresAuth: true },
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !JSON.parse(localStorage.getItem("loggedIn"))) {
        next({ name: "Login" });
    } else {
        next();
    }
});

router.beforeEach((to, from, next) => {
    if (
        to.meta.requiresAuthBack &&
        !JSON.parse(localStorage.getItem("loggedInBack"))
    ) {
        next({ path: "/login-back" });
    } else {
        next();
    }
});

export default router;
