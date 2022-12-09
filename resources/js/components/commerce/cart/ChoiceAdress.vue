<script setup>
import { ref, onMounted } from "vue";
import Navbar from "../../Navbar.vue";
import ListAddress from "../account/address/ListAddress.vue";
import useProfil from "../../../composable/account";
import CreateAddress from "../account/address/CreateAddress.vue";

const { getAllAddress, addresses } = useProfil();

const addressId = ref("");

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
              <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Addresse</h1>
            </header>


 <CreateAddress/> 

            <div class="text-center pr-5 mb-6">
              <router-link to="/account">
                <button
                  type="button"
                  class="justify-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-white hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 bg-indigo-500"
                >
                  Ajouter une adrresse
                </button>
              </router-link>
            </div>
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
     
      </div>
    </div>
  </div>
</template>


<style lang="scss" scoped>

</style>