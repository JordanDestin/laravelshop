<script setup></script>

<template>
  <div class="flex justify-center my-6 ">
    <div
      class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5 text-center mt-10"
    >
      <p>Votre commande à été passé avec succès</p>

      <router-link to="/">
        <button
          type="button"
          class="inline-flex justify-center rounded-md border border-transparent bg-black px-4 py-2 text-sm font-medium text-white hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
        >
          Retour à la boutique
        </button>
      </router-link>
    </div>
  </div>
</template>

<style lang="scss" scoped></style>
