<script setup>
import Navbar from "./Navbar.vue";
</script>

<template>
  <Navbar />

  <div class="mt-6">
    <div class="flex justify-center my-6">
      <div
        class="flex flex-col w-full p-8 text-gray-800  container"
      >
        <header class="mb-2">
          <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Mon Compte</h1>
        </header>

        
          <hr class="pb-6 mt-6" />
          <div class="grid grid-cols-2">
            <router-link to="/profile/settings">
              <div class="p-8">
                <div
                  class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg mb-4"
                >
                  Parametre
                </div>
              </div>
            </router-link>

            <router-link to="/profile/orders">
              <div class="p-8">
                <div
                  class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg mb-4"
                >
                  Commandes
                </div>
              </div>
            </router-link>
          </div>
          <div class="grid grid-cols-2">
            <router-link to="/profile/address">
              <div class="p-8">
                <div
                  class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg mb-4"
                >
                  Addresse
                </div>
              </div>
            </router-link>

         
          </div>
        

        <router-view></router-view>
      </div>
    </div>
  </div>
</template>
