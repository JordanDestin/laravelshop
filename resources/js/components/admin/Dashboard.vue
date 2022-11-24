<script setup>
import NavbarBack from './NavbarBack.vue';




</script>

<template>
<NavbarBack/>

  <div class="drawer drawer-mobile">
    <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content r">
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
              <!-- <div class="grid grid-cols-2">
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
              <div class="grid grid-cols-2">
                <router-link to="/dashboard/list-order">
                  <div class="p-8">
                    <div
                      class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg mb-4"
                    >
                      Listes des Commandes
                    </div>
                  </div>
                </router-link>
                <router-link to="/dashboard/list-user">
                  <div class="p-8">
                    <div
                      class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg mb-4"
                    >
                      Listes des utilisateurs
                    </div>
                  </div>
                </router-link>
              </div> -->
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
    </div>
    <div class="drawer-side">
      <label for="my-drawer-2" class="drawer-overlay"></label>
      <ul class="menu p-4 w-80 bg-base-100 text-base-content">
        <!-- Sidebar content here -->
        <li>
          <router-link to="/dashboard/list-product"> Listes des produits </router-link>
        </li>
        <li>
          <router-link to="/dashboard/list-category"> Listes des catégories </router-link>
        </li>
        <li>
          <router-link to="/dashboard/list-order"> Listes des Commandes </router-link>
        </li>
        <li>
          <router-link to="/dashboard/list-user"> Listes des utilisateurs </router-link>
        </li>
      </ul>
    </div>
  </div>

  <!-- <div class="py-12">
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
          <div class="grid grid-cols-2">
            <router-link to="/dashboard/list-order">
              <div class="p-8">
                <div
                  class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg mb-4"
                >
                  Listes des Commandes
                </div>
              </div>
            </router-link>
            <router-link to="/dashboard/list-user">
              <div class="p-8">
                <div
                  class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg mb-4"
                >
                  Listes des utilisateurs
                </div>
              </div>
            </router-link>
          </div>

          <router-view></router-view>
        </div>
      </div>
    </div>
  </div> -->
</template>

<style lang="scss" scoped></style>
