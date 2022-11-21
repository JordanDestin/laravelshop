<script setup>
import axios from "axios";
import { reactive, ref, onMounted, watch } from "vue";
import { useRoute } from "vue-router";
import { formatPrice } from "../helper/index";

const route = useRoute();
console.log(route.params.id, "iddddddddddddd");

const order = ref({
  name: "",
  order_number:"",
  total_quantity: "",
  price: "",
  total_price: "",
});

const getDetail = () => {
  axios
    .get("/api/order/" + route.params.id)
    .then((res) => {
        order.value =res.data.order;
      console.log(res, "detail");
    })
    .catch((err) => console.log(err));
};

onMounted(() => {
  getDetail();
});
</script>

<template>

  <div>
    <div class="flex justify-center my-6">
      <div
        class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5"
      >
        <header class="mb-2">
          <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">
             qsdqs
          </h1>
        </header>

        <div class="flex-1">
          <table class="w-full text-sm lg:text-base" cellspacing="0">
            <thead>
              <tr class="h-12 uppercase">
                <th class="hidden md:table-cell"></th>
                <th class="text-left">Produits</th>
                
                <th class="lg:text-right text-left pl-5 lg:pl-0">
                  <span class="lg:hidden" title="Quantité">Qtd</span>
                  <span class="hidden lg:inline">Quantité</span>
                </th>
                <th class="hidden text-right md:table-cell">Prix unitaire</th>
               
              </tr>
            </thead>
            <tbody>
              <template v-for="item in order" v-bind:key="item.id">
              
                <tr>
                  <td class="hidden pb-4 md:table-cell">
                    <a href="#">
                    <!-- <img
                        class="w-full"
                        :src="item.image"
                        width="50"
                        height="50"
                        alt="Application 05"
                      /> -->
                      <img :src="item.image" class="w-20 rounded" alt="Thumbnail" />
                    </a>
                  </td>
                  <td>{{ item.name }}</td>

                  <td class="justify-center md:justify-end md:flex mt-6">
                    <div class="w-20 h-10">
                      <div class="relative flex w-full h-8 space-x-5">
                        <p
                          class="w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black"
                        >
                        {{ item.total_quantity }}
                        </p>
                      </div>
                    </div>
                  </td>
                  <td class="hidden text-right md:table-cell">
                    <span class="text-sm lg:text-base font-medium">
                        {{ formatPrice(item.price) }}</span>
                  </td>
                 
                </tr>
              </template>
            </tbody>
          </table>
         
        </div>
      </div>
    </div>
  </div>
</template>
