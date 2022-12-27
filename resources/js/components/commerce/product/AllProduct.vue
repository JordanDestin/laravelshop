<script setup>
import { onMounted, watch, ref } from "vue";
import useProducts from "../../../composable/products";
import useCart from "../../../composable/cart";
import { formatPrice } from "../../../helper";
import { TailwindPagination } from "laravel-vue-pagination";
import emitter from "tiny-emitter/instance";
import Categories from "../../../components/Categories.vue";

const { products, getProducts, getProductTendance, productstendance } = useProducts();
const { addProductCart } = useCart();

const selectCategorie = ref("");

emitter.on("categoryId", function (id) {
  selectCategorie.value = id;
});

watch(selectCategorie, (current, previous) => {
  getProducts(1, current);
});

const currentPhoto = ref(0);

function prevSlider() {
  currentPhoto.value =
    currentPhoto.value - 4 === productstendance.value.length ? 0 : currentPhoto.value - 4;
}
function nextSlider() {
  currentPhoto.value =
    currentPhoto.value + 4 === productstendance.value.length ? 0 : currentPhoto.value + 4;
}

onMounted(async () => {
  await getProducts();
  await getProductTendance();
});
</script>

<template>
  <h2 class="text-xl leading-snug text-slate-800 font-bold mb-5 mt-5">
    Produit Tendance
  </h2>

  <div class="w-full">
    <!-- Slider wrapper -->
    <transition-group name="slide-fade" tag="div" class="slider">
      <div class="grid grid-cols-4 gap-6 relative">
        <!-- Single Slider -->
        <div
          class="slider__item"
          v-for="(item, index) in productstendance.slice(currentPhoto, currentPhoto + 4)"
          :key="index"
        >
          <div class="card bg-base-100 shadow-xl">
            <figure>
              <img
                class="w-full"
                :src="item.image"
                width="286"
                height="160"
                alt="Application 05"
              />
            </figure>
            <div class="card-body">
              <h2 class="card-title">{{ item.name }}</h2>
              <p>{{ item.description }}</p>
              <div class="flex items-center space-x-2">
                <div
                  class="inline-flex text-sm font-medium bg-emerald-100 text-emerald-600 rounded-full text-center px-2 py-0.5"
                >
                  {{ formatPrice(item.price) }}
                </div>
              </div>
              <div class="card-actions justify-end">
                <button class="btn btn-primary" @click="addProductCart(item.id)">
                  Buy Now
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- Single Slider end -->

        <!-- Arrows prev -->
        <button
          @click="prevSlider"
          class="w-10 h-10 rounded-full bg-white hover:shadow-lg active:scale-90 transition absolute left-2 top-24 text-gray-700 flex items-center justify-center opacity-50 hover:opacity-100"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M15.75 19.5L8.25 12l7.5-7.5"
            />
          </svg>
        </button>
        <!-- Arrows prev end -->

        <!-- Arrows next -->
        <button
          @click="nextSlider"
          class="w-10 h-10 rounded-full bg-white hover:shadow-lg active:scale-90 transition absolute right-2 top-24 text-gray-700 flex items-center justify-center opacity-50 hover:opacity-100"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M8.25 4.5l7.5 7.5-7.5 7.5"
            />
          </svg>
        </button>
        <!-- Arrows next end -->
      </div>
    </transition-group>
  </div>

  <Categories />
  <h2 class="text-xl leading-snug text-slate-800 font-bold mb-5 mt-5">
    Tous mes produit
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
                  {{ formatPrice(product.price) }}
                </div>
              </div>
            </div>
          </div>

          <button class="btn btn-primary" @click="addProductCart(product.id)">
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
</template>

<style scoped>
.slider__item {
  display: inline-block;
}

.slider-fade-enter-active,
.slider-fade-leave-active {
  transition: all 0.3s ease;
}

.slider-fade-enter,
.slider-fade-leave-to {
  opacity: 0;
  transform: translateX(-10%);
}
</style>
