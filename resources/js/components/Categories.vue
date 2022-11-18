<script setup>
import { onMounted, ref } from "vue";
import useCategories from "../composable/categories";
import emitter from "tiny-emitter/instance";

const { getCategories, categories } = useCategories();

const selectCategory = (id) => {
  console.log(id);
  emitter.emit("categoryId", id);
};

defineEmits(["selectCategory"]);

onMounted(getCategories);
</script>

<template>
  
  <!-- Cards 6 (Trending Now) -->
  <div class="mt-8">
    <h2 class="text-xl leading-snug text-slate-800 font-bold mb-5">Trending Now</h2>
    <div class="grid grid-cols-12 gap-6">
      <!-- Card 1 -->
      <div
        class="relative col-span-full sm:col-span-6 xl:col-span-3 bg-white shadow-lg rounded-sm border border-slate-200 overflow-hidden"
        v-for="category in categories"
        :key="category.id"
      >
        <!-- Image -->
        <!-- <img
          class="absolute w-full h-full object-cover"
          src="#"
          width="286"
          height="160"
          alt="Application 17"
        /> -->
        <!-- Gradient -->

        <button type="button" @click="selectCategory(category.id)">
          <!-- <button type="button" @click="$emit(selectCategory,category.id)"> -->
          <div
            class="absolute inset-0 bg-gradient-to-t from-slate-800 to-transparent"
            aria-hidden="true"
          >
       
          </div>
          <!-- Content -->
          <div class="relative h-full p-5 flex flex-col justify-end">
            <h3 class="text-lg text-white font-semibold mt-16 mb-0.5">
              {{ category.name }}
            </h3>
          </div>
        </button>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped></style>
