<script setup>
import { ref, onMounted } from "vue";
import Navbar from "../../Navbar.vue";
import ListAddress from "../account/address/ListAddress.vue";
import useProfil from "../../../composable/account";
import CreateAddress from "../account/address/CreateAddress.vue";

const { getAllAddress, addresses } = useProfil();

const addressId = ref("");
const editing = ref(false);

onMounted(async () => {
  await getAllAddress();
});
</script>

<template>
  <Navbar/>
  <div>
    <div class="flex justify-center my-6">
      <div
        class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5"
      >
        <div>
          <header class="mb-2">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Addresse de livraison</h1>
          </header>

          <div
            class="bg-white shadow-lg rounded-sm border border-slate-200 p-4 mb-6"
            draggable="true"
            v-for="item in addresses"
            :key="item.id"
          >
            <div class="sm:flex sm:justify-between sm:items-start">
              <!-- Left side -->
              <div class="grow mt-0.5 mb-3 sm:mb-0 space-y-3">
                <div class="flex items-center">
                  <!-- Checkbox button -->

                  <label class="items-center">
                    <input
                      type="radio"
                      class="radio radio-primary"
                      :value="item.id"
                      v-model="addressId"
                    />
                    <p class="font-medium text-slate-800 ml-2">
                      {{ item.address }}
                    </p>
                    <p class="font-medium text-slate-800 ml-2">
                      {{ item.addressbis }}
                    </p>
                    <p class="font-medium text-slate-800 ml-2">
                      {{ item.postal }}
                    </p>
                    <p class="font-medium text-slate-800 ml-2">
                      {{ item.city }}
                    </p>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center pr-5 mb-6">
          <button
            type="button"
            class="justify-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-white hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 bg-indigo-500 mb-5"
            @click="editing = true"
          >
            Ajouter une adrresse
          </button>
          <div
          
            v-if="editing"
          >
            <CreateAddress />
          </div>
        </div>

        <router-link :to="{ path: '/payment/' + addressId }">
          <button
            class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none"
          >
            <svg
              aria-hidden="true"
              data-prefix="far"
              data-icon="credit-card"
              class="w-8"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 576 512"
            >
              <path
                fill="currentColor"
                d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z"
              />
            </svg>
            <span class="ml-2 mt-5px">Passer commande</span>
          </button>
        </router-link>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped></style>
