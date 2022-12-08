<script setup>
import { ref, onMounted, computed } from "vue";
import { formatPrice } from "../../../helper/index";
import Navbar from "../../Navbar.vue";
import useProfil from "../../../composable/account";
import useCart from "../../../composable/cart";
import axios from "axios";


const { getAllAddress, addresses } = useProfil();

const { cartContent,contents, increaseQuantity,decreaseQuantity, destroyProduct, totalcart, carCount } = useCart();

//const { cartCount } = useProducts();

// const cartTotals = computed(() => {
//   let price = Object.values(contents.value).reduce(
//     (acc, content) => (acc += content.price * content.quantity),
//     0
//   );

//   return formatPrice(price);
// });

const chekcout = () =>{

  console.log('couou')
  axios.post('/api/checkouttest')
  .then((response) =>{
    console.log(response)
  })
  .catch((err) => console.log(err));
}

const addressId = ref("");

onMounted(async () => {
  await cartContent();
  await getAllAddress();
});
</script>

<template>
  <Navbar />

  <div>
    <div class="flex justify-center my-6">
      <div
        class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5"
      >
        <header class="mb-2">
          <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">
            Mon panier ✨{{ formatPrice(totalcart) }} count {{ carCount }}
          </h1>
        </header>

        <div class="flex-1">
          <table class="w-full text-sm lg:text-base" cellspacing="0">
            <thead>
              <tr class="h-12 uppercase">
                <th class="hidden md:table-cell"></th>
                <th class="text-left">Produits</th>
                <th class="text-left"></th>
                <th class="lg:text-right text-left pl-5 lg:pl-0">
                  <span class="lg:hidden" title="Quantité">Qtd</span>
                  <span class="hidden lg:inline">Quantité</span>
                </th>
                <th class="hidden text-right md:table-cell">Prix unitaire</th>
                <th class="text-right">Prix total</th>
              </tr>
            </thead>
            <tbody>
              <template v-for="content in contents" v-bind:key="content.id">
                <tr>
                  <td class="hidden pb-4 md:table-cell">
                    <a href="#">
                      <img
                        :src="content.associatedModel.image"
                        class="w-20 rounded"
                        alt="Thumbnail"
                      />
                    </a>
                  </td>
                  <td>
                    {{ content.name }}
                  </td>

                  <td>
                    <button type="button" @click="destroyProduct(content.id)">
                      <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                        <path d="M13 15h2v6h-2zM17 15h2v6h-2z" />
                        <path
                          d="M20 9c0-.6-.4-1-1-1h-6c-.6 0-1 .4-1 1v2H8v2h1v10c0 .6.4 1 1 1h12c.6 0 1-.4 1-1V13h1v-2h-4V9zm-6 1h4v1h-4v-1zm7 3v9H11v-9h10z"
                        />
                      </svg>
                    </button>
                  </td>
                  <td class="justify-center md:justify-end md:flex mt-6">
                    <div class="w-20 h-10">
                      <div class="relative flex w-full h-8 space-x-5">
                        <button @click="decreaseQuantity(content.id)">-</button>
                        <p
                          class="w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black"
                        >
                          {{ content.quantity }}
                        </p>
                        <!-- <input
                                readonly
                                type="input"
                              
                                class="w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black" /> -->
                        <button @click="increaseQuantity(content.id)">+</button>
                      </div>
                    </div>
                  </td>
                  <td class="hidden text-right md:table-cell">
                    <span class="text-sm lg:text-base font-medium">{{
                      formatPrice(content.price)
                    }}</span>
                  </td>
                  <td class="text-right">
                    <span class="text-sm lg:text-base font-medium"
                      >{{ formatPrice(content.price * content.quantity) }}
                    </span>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
          <hr class="pb-6 mt-6" />
          <div>
            <header class="mb-2">
              <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Addresse</h1>
            </header>
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
          <div class="my-4 mt-6 -mx-2 lg:flex justify-end">
            <div class="lg:px-2 lg:w-1/2">
              <div class="p-4 bg-gray-100 rounded-full">
                <h1 class="ml-2 font-bold uppercase">Détails de la commande</h1>
              </div>
              <div class="p-4">
                <div class="flex justify-between pt-4 border-b">
                  <div
                    class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800"
                  >
                    Total : {{ formatPrice(totalcart) }}
                  </div>
                  <div
                    class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900"
                  ></div>
                </div>
                <router-link :to="{ path: '/payment/'+ addressId}">
                  <!-- <router-link to="/payment"> -->
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

                
                  <!-- <button
                    class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none"
                    @click="chekcout()"
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
                    <span class="ml-2 mt-5px">Passer commande test</span>
                  </button> -->
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
