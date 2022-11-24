<script setup>
import useAuthBack from "../../composable/admin/auth/authBack";

const { logoutBack } = useAuthBack();
</script>

<template>
  <div class="navbar bg-base-100">
    <div class="navbar-start">
      <div class="dropdown">
        <label tabindex="0" class="btn btn-ghost lg:hidden">
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
              d="M4 6h16M4 12h8m-8 6h16"
            />
          </svg>
        </label>
      </div>
      <a class="btn btn-ghost normal-case text-xl">daisyUI</a>
    </div>

    <div class="navbar-end">
      <button @click="logoutBack" type="button" class="btn">Déconnexion</button>
    </div>
  </div>
</template>

<style lang="scss" scoped></style>
