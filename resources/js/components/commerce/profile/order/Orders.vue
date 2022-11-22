<script setup>
import { ref, onMounted } from "vue";
import { formatPrice } from "../../../../helper";
const listOrders = ref([]);

const order = async () => {
  await axios.get("/api/orders").then((response) => {
    listOrders.value = response.data.orders;
    console.log(listOrders.value);
  });
};

onMounted(async () => {
  let response = order();

  console.log(response, "resqdsdqsd");
});
</script>

<template>
  <div class="bg-white shadow-lg rounded-sm border border-slate-200 relative">
    <header class="px-5 py-4">
      <h2 class="font-semibold text-slate-800">
        Mes commandes <span class="text-slate-400 font-medium"></span>
      </h2>
    </header>
    <div>
      <!-- Table -->
      <div
        class="overflow-x-auto"
        v-for="(listOrder, index) in listOrders"
        :key="listOrder.id"
      >
        <table class="table-auto w-full divide-y divide-slate-200">
          <!-- Table header -->
          <thead
            class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-slate-200"
          >
            <tr>
              <!-- <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                <div class="flex items-center">
                  <label class="inline-flex">
                    <span class="sr-only">Select all</span>
                    <input
                      class="form-checkbox"
                      type="checkbox"
                      v-model="selectAll"
                      @click="checkAll"
                    />
                  </label>
                </div>
              </th> -->
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
            <!-- Row -->
            <tr>
              <!-- <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                <div class="flex items-center">
                  <label class="inline-flex">
                    <span class="sr-only">Select</span>
                    <input
                      :id="order.id"
                      class="form-checkbox"
                      type="checkbox"
                      :value="value"
                      @change="check"
                      :checked="checked"
                    />
                  </label>
                </div>
              </td> -->

              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div>{{ listOrder.order_number }}</div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-medium text-slate-800">{{ listOrder.created_at }}</div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="text-left font-medium text-emerald-500">
                  {{ formatPrice(listOrder.total_order) }}
                </div>
              </td>
              <td>
                <button
                  type="button"
                  class="inline-flex justify-center rounded-md border border-transparent bg-black px-4 py-2 text-sm font-medium text-white hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                >
                  <router-link
                    :to="{ path: '/detail-order/' + listOrder.id }"
                  >
                    voir
                  </router-link>
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
