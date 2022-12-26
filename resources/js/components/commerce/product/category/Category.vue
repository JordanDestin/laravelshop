<script setup>
import { onMounted, watch, ref } from "vue";
import { useRoute } from "vue-router";
import useProducts from "../../../../composable/products";
import Navbar from "../../../Navbar.vue";
import emitter from "tiny-emitter/instance";
import Categories from "../../../Categories.vue";

const route = useRoute();
const { products, getProducts } = useProducts();

const selectCategorie = ref("");

emitter.on("categoryId", function (id) {

  console.log(id,"sssssssssssssss")
  selectCategorie.value = id;
});



watch(selectCategorie, (current, previous) => {

  console.log(current,current)
    getProducts(1, current);
});

onMounted(async () => {
  //await getProducts();
  await getProducts(1, route.params.id);
});
</script>

<template>
  <Navbar />


  <div class="mt-8 container w-full max-w-5xl mx-auto">
    <h2 class="text-xl leading-snug text-slate-800 font-bold mb-5 mt-5">
      Ma Catégorie
    </h2>
    <div class="grid grid-cols-12 gap-6">
      <div
        class="col-span-full sm:col-span-6 xl:col-span-3 bg-white shadow-lg rounded-sm border border-slate-200 overflow-hidden"
        v-for="product in products.data"
        :key="product.id"
      >
       
        <div class="flex flex-col h-full">
          <div class="relative">
            <img
              class="w-full"
              :src="product.image"
              width="286"
              height="160"
              alt="Application 05"
            />
            <div class="absolute top-0 right-0 mt-4 mr-4" v-if="product.tendance">
              <div
                class="inline-flex items-center text-xs font-medium text-slate-100 bg-slate-900 bg-opacity-60 rounded-full text-center px-2 py-0.5"
              >
                <svg
                  class="w-3 h-3 shrink-0 fill-current text-amber-500 mr-1"
                  viewBox="0 0 12 12"
                >
                  <path
                    d="M11.953 4.29a.5.5 0 00-.454-.292H6.14L6.984.62A.5.5 0 006.12.173l-6 7a.5.5 0 00.379.825h5.359l-.844 3.38a.5.5 0 00.864.445l6-7a.5.5 0 00.075-.534z"
                  />
                </svg>
                <span>Tendance</span>
              </div>
            </div>
          </div>

          <div class="grow flex flex-col p-5">
            <div class="grow">
              <header class="mb-2">
                <h3 class="text-lg text-slate-800 font-semibold mb-1">
                  {{ product.name }}
                </h3>

                <h3 class="text-lg text-slate-800 font-semibold mb-1">
                  Catégorie: {{ product.category }}
                </h3>
                <div class="text-sm">
                  {{ product.description }}
                </div>
              </header>

              <div class="flex flex-wrap items-center justify-between mb-5">
                <div class="flex items-center space-x-2 mr-2">
                  <svg class="w-4 h-4 fill-current text-amber-500" viewBox="0 0 16 16">
                    <path
                      d="M10 5.934L8 0 6 5.934H0l4.89 3.954L2.968 16 8 12.223 13.032 16 11.11 9.888 16 5.934z"
                    />
                  </svg>

                  <div class="text-sm font-medium whitespace-nowrap">
                    <span>4.7</span> <span class="text-slate-400">(478)</span>
                  </div>
                </div>

                <div class="flex items-center space-x-2">
                  <div
                    class="inline-flex text-sm font-medium bg-emerald-100 text-emerald-600 rounded-full text-center px-2 py-0.5"
                  >
                    {{ product.price }}
                  </div>
                </div>
              </div>
            </div>

            <button class="btn btn-primary">Ajouter au panier</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
