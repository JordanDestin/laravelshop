<script setup>
import { onMounted, ref } from "vue";
import useCategories from "../composable/categories";
import emitter from "tiny-emitter/instance";

const { getCategories, categories } = useCategories();

const selectCategory = (id) => {
  console.log(id);
  emitter.emit("categoryId", id);
};

onMounted(getCategories);
</script>

<template>
  <div class="mt-8">
    <h2 class="text-xl leading-snug text-slate-800 font-bold mb-5">Catégories</h2>
    <div class="grid grid-cols-12 gap-6">
      <div
        class="relative col-span-full sm:col-span-6 xl:col-span-3 bg-white shadow-lg rounded-sm border border-slate-200 overflow-hidden"
        v-for="category in categories"
        :key="category.id"
      >
        <button type="button" @click="selectCategory(category.id)">
          <div class="" aria-hidden="true"></div>

          <div class="relative h-full p-5 flex flex-col justify-end">
            <h3 class="text-lg text-black font-semibold mt-16 mb-0.5">
              {{ category.name }}
            </h3>
          </div>
        </button>
      </div>
    </div>
  </div>
</template>
