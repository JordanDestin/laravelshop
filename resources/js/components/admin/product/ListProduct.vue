<script setup>
import { onMounted, ref, watch } from "vue";
import { formatPrice } from "../../../helper";
import useProductsBack from "../../../composable/admin/product/productBack.js";
import useCategories from "../../../composable/categories.js";
import { TailwindPagination } from "laravel-vue-pagination";

const { products, getAllProducts } = useProductsBack();
const { getCategories, categories } = useCategories();

const selectCategory = ref("");

watch(selectCategory, (current, previous) => {
  getAllProducts(1, current);
});

onMounted(async () => {
  await getAllProducts();
  await getCategories();
});
</script>

<template>
  <div class="bg-white shadow-lg rounded-sm border border-slate-200 relative">
    <header class="px-5 py-4">
      <h1 class="font-semibold text-slate-800">
        Mes produits <span class="text-slate-400 font-medium">442</span>
      </h1>
    </header>
    <div class="text-right pr-5">
      <router-link :to="{ path: 'create-product' }">
      <button
        type="button"
        class="justify-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-white hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 bg-indigo-500"
      >
        Ajouter un produit
      </button>
    </router-link>
    </div>
    <div>
      
      <select
        v-model="selectCategory"
        class="inline-block mt-1rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mb-2"
      >
        <option value="" selected>-- all categories --</option>
        <option v-for="category in categories" :value="category.id">
          {{ category.name }}
        </option>
      </select>
      <!-- Table -->
      <div class="overflow-x-auto">
        <table class="table-auto w-full divide-y divide-slate-200">
          <thead
            class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-slate-200"
          >
            <tr>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Nom du produit</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Catégorie</div>
              </th>

              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Qantité</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Prix</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Active</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Tendance</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap"></th>
            </tr>
          </thead>

          <tbody class="text-sm" v-for="product in products.data" :key="product.id">
            <tr>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div>{{ product.name }}</div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-medium text-slate-800">{{ product.category }}</div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="text-left font-medium text-emerald-500">
                  {{ product.quantity_product }}
                </div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="text-left font-medium text-emerald-500">
                  {{ formatPrice(product.price) }}
                </div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="text-left font-medium text-emerald-500">
                  {{ product.active }}
                </div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="text-left font-medium text-emerald-500">
                  {{ product.tendance }}
                </div>
              </td>
              <td>
                <button
                  type="button"
                  class="inline-flex justify-center rounded-md border border-transparent bg-black px-4 py-2 text-sm font-medium text-white hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                >
                  voir
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <TailwindPagination
        :data="products"
        @pagination-change-page="(page) => getAllProducts(page, selectCategory)"
        class="btn-group"
      />
    </div>
  </div>
</template>

<style lang="scss" scoped></style>
