<script setup>
import { onMounted } from "vue";
import useCategories from "../../../composable/categories";

const { getCategories, categories } = useCategories();

onMounted(getCategories);
</script>

<template>
  <div class="bg-white shadow-lg rounded-sm border border-slate-200 relative">
    <header class="px-5 py-4">
      <h2 class="font-semibold text-slate-800">
        Mes Catégories <span class="text-slate-400 font-medium">442</span>
      </h2>
    </header>
    <div>
      <!-- Table -->
      <div class="overflow-x-auto" >
        <table class="table-auto w-full divide-y divide-slate-200" >
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

             
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap"></th>
            </tr>
          </thead>

          <tbody class="text-sm" v-for="category in categories" :key="category.id">
            <tr>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div>{{ category.name }}</div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-medium text-slate-800">{{ category.created_at }}</div>
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
    
    </div>
  </div>
</template>

<style lang="scss" scoped></style>
