<script setup>
import { onMounted, ref } from "vue";
import useAuth from "../composable/auth";
import emitter from "tiny-emitter/instance";
import { useRouter } from "vue-router";
import useProducts from "../composable/products";

const router = useRouter();

const { processing, logout, user } = useAuth();

const { totalcart } = useProducts();

const cartCount = ref(0);

let isloged = false;

if (localStorage.getItem("loggedIn")) {
  isloged = true;
}

emitter.on("cartCount", function (count) {
  cartCount.value = count;
});
</script>

<template>
  <div class="navbar bg-base-100">
    <div class="flex-1">
      <router-link :to="{ path: '/' }">
        <button class="btn btn-ghost normal-case text-xl">Shop</button>
      </router-link>
    </div>
    <div class="flex-none">
      <!-- Search form -->
      <!-- <div class="max-w-xl mb-5">
        <form class="relative">
          <label for="app-search" class="sr-only">Search</label>
          <input
            id="app-search"
            class="form-input w-full pl-9 py-3 focus:border-slate-300"
            type="search"
            placeholder="Search…"
          />
          <button
            class="absolute inset-0 right-auto group"
            type="submit"
            aria-label="Search"
          >
            <svg
              class="w-4 h-4 shrink-0 fill-current text-slate-400 group-hover:text-slate-500 ml-3 mr-2"
              viewBox="0 0 16 16"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z"
              />
              <path
                d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z"
              />
            </svg>
          </button>
        </form>
      </div> -->
      <div class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-ghost btn-circle">
          <div class="indicator">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
              />
            </svg>

            <span class="badge badge-sm indicator-item">{{ cartCount }}</span>
          </div>
        </label>
        <div
          tabindex="0"
          class="mt-3 card card-compact dropdown-content w-52 bg-base-100 shadow"
        >
          <div class="card-body">
            <span class="font-bold text-lg">{{ cartCount }} Items</span>
            <span class="text-info">Subtotal: $999</span>
            <div class="card-actions">
              <router-link :to="{ path: '/cartcontent' }">
                <button class="btn btn-primary btn-block">View cart</button>
              </router-link>
            </div>
          </div>
        </div>
      </div>

      <div class="dropdown dropdown-end" v-if="!isloged">
        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-user"
              width="35"
              height="35"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <circle cx="12" cy="7" r="4" />
              <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
            </svg>
          </div>
        </label>
        <ul
          tabindex="0"
          class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52"
        >
          <li>
            <router-link to="/login"> se connecter </router-link>
          </li>
        </ul>
      </div>

      <div class="dropdown dropdown-end" v-else="isloged">
        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-user-check"
              width="30"
              height="30"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <circle cx="9" cy="7" r="4" />
              <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
              <path d="M16 11l2 2l4 -4" />
            </svg>
          </div>
        </label>
        <ul
          tabindex="0"
          class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52"
        >
          <li>
            <router-link to="/account">Mon compte</router-link>
          </li>

          <li>
            <button
              @click="logout"
              type="button"
              :class="{ 'opacity-25': processing }"
              :disabled="processing"
            >
              Me déconnecter
            </button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
