<script setup>
import { onMounted, watch, ref } from "vue";
import useProducts from "../composable/products";
import useCategories from "../composable/categories";
import emitter from "tiny-emitter/instance";
import Navbar from "../components/Navbar.vue";
import Categories from "../components/Categories.vue";
import Carousel from "../components/Carousel.vue";
import { formatPrice } from "../helper";
import { TailwindPagination } from "laravel-vue-pagination";

const { products, getProducts, addProduct } = useProducts();
const { getCategories, categories } = useCategories();

const addToCart = async (id) => {
  console.log(id);
  let carCount = await addProduct(id);

  emitter.emit("cartCount", carCount);
};

const selectCategorie = ref("");

emitter.on("categoryId", function (id) {
  console.log(id, "coucou");
  selectCategorie.value = id;
});

watch(selectCategorie, (current, previous) => {
  getProducts(1, current);
});

onMounted(async () => {
  await getProducts();
  await getCategories();
});
</script>

<template>
  <Navbar />

  <main>
    <!-- Filters -->
    <!-- <div class="mb-4 border-b flex border-slate-200">
      <ul
        class="text-sm font-medium mx-4 sm:-mx-6 lg:-mx-8"
        v-for="category in categories"
        :key="category.id"
      >
        <li
          class="pb-3 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8"
        >
          <a class="text-indigo-500 whitespace-nowrap" href="#0">{{ category.name }}</a>
        </li>
      </ul>
    </div> -->

    <!-- Page content -->
    <div>
      <Carousel />

      <!-- Cards 2 (Digital Goods) -->
      <div class="mt-8 container w-full max-w-5xl mx-auto">
        <Categories />
        <h2 class="text-xl leading-snug text-slate-800 font-bold mb-5">Digital Goods</h2>

       

    

        <div class="grid grid-cols-12 gap-6">
          <!-- Card 1 -->
          <div
            class="col-span-full sm:col-span-6 xl:col-span-3 bg-white shadow-lg rounded-sm border border-slate-200 overflow-hidden"
            v-for="product in products.data"
            :key="product.id"
          >
            <div class="flex flex-col h-full">
              <!-- Image -->
              <div class="relative">
                <img
                  class="w-full"
                  :src="product.image"
                  width="286"
                  height="160"
                  alt="Application 05"
                />
                <!-- Popular label -->
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
              <!-- Card Content -->
              <div class="grow flex flex-col p-5">
                <!-- Card body -->
                <div class="grow">
                  <!-- Header -->
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
                  <!-- Rating and Price -->
                  <div class="flex flex-wrap items-center justify-between mb-5">
                    <!-- Rating -->
                    <div class="flex items-center space-x-2 mr-2">
                      <svg
                        class="w-4 h-4 fill-current text-amber-500"
                        viewBox="0 0 16 16"
                      >
                        <path
                          d="M10 5.934L8 0 6 5.934H0l4.89 3.954L2.968 16 8 12.223 13.032 16 11.11 9.888 16 5.934z"
                        />
                      </svg>
                      <!-- Rate -->
                      <div class="text-sm font-medium whitespace-nowrap">
                        <span>4.7</span> <span class="text-slate-400">(478)</span>
                      </div>
                    </div>
                    <!-- Price -->
                    <div class="flex items-center space-x-2">
                      <div
                        class="inline-flex text-sm font-medium bg-emerald-100 text-emerald-600 rounded-full text-center px-2 py-0.5"
                      >
                        {{ formatPrice(product.price) }}
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Card footer -->
                <button class="btn btn-primary" @click="addToCart(product.id)">
                  Ajouter au panier
                </button>
              </div>
            </div>
          </div>

          <TailwindPagination
            :data="products"
            @pagination-change-page="(page) => getProducts(page, selectCategorie)"
            class="btn-group"
          />
        </div>
      </div>
    </div>
  </main>
</template>

<style lang="scss" scoped></style>
