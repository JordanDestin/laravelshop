<script setup></script>

<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="grid grid-cols-2">
            <router-link to="/dashboard/list-product">
              <div class="p-8">
                <div
                  class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg mb-4"
                >
                  Listes des produits
                </div>
              </div>
            </router-link>

            <router-link to="/dashboard/list-category">
              <div class="p-8">
                <div
                  class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg mb-4"
                >
                  Listes des catégories
                </div>
              </div>
            </router-link>
          </div>
          <!-- <div class="grid grid-cols-2">
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
          </div> -->

          <router-view></router-view>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped></style>
