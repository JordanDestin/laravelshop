<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
//import { formatPrice } from "../helper";
import {formatPrice} from "../../../helper/index"
import useUserBack from "../../../composable/admin/user/userBack";

const { getOrdersUser, orderUsers } = useUserBack();

const route = useRoute();

onMounted(async () => {
  await getOrdersUser(route.params.id);
});
</script>

<template>
  <div class="bg-white shadow-lg rounded-sm border border-slate-200 relative">
    <header class="px-5 py-4">
      <h2 class="font-semibold text-slate-800">
        Mes commandes <span class="text-slate-400 font-medium">442</span>
      </h2>
    </header>
    <div>
      
      <div
        class="overflow-x-auto"
        v-for="orderUser in orderUsers"
        :key="orderUser.id"
      >
    
        <table class="table-auto w-full divide-y divide-slate-200">
     
          <thead
            class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-slate-200"
          >
            <tr>
    
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Commande</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Date</div>
              </th>

              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Total</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap"></th>
            </tr>
          </thead>

          <tbody class="text-sm">
           
            <tr>


              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div>{{ orderUser.order_number }}</div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-medium text-slate-800">{{ orderUser.created_at }}</div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="text-left font-medium text-emerald-500">
                  {{ formatPrice(orderUser.total_order) }}
                </div>
              </td>
              <td>
                <button
                  type="button"
                  class="inline-flex justify-center rounded-md border border-transparent bg-black px-4 py-2 text-sm font-medium text-white hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                >
                  <!-- <router-link
                    :to="{ path: '/detail-order/' + listOrder.id }"
                  > -->
                    voir
                  <!-- </router-link> -->
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped></style>
