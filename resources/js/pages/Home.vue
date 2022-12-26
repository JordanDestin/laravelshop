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
import AllProduct from "../components/commerce/product/AllProduct.vue";

const { products, getProducts, addProduct } = useProducts();
const { getCategories, categories } = useCategories();

const addToCart = async (id) => {
  let carCount = await addProduct(id);
  emitter.emit("cartCount", carCount);
};

// const selectCategorie = ref("");

// emitter.on("categoryId", function (id) {
//   selectCategorie.value = id;
// });

// watch(selectCategorie, (current, previous) => {
//   getProducts(1, current);
// });

// onMounted(async () => {
//   await getProducts();
//   await getCategories();
// });
</script>

<template>
  <Navbar />
  
  <main>
    <div>
      <Carousel />
      <div class="mt-8 container w-full max-w-5xl mx-auto">
        <Categories />

        <AllProduct/>

      </div>
    </div>
  </main>
</template>

<style lang="scss" scoped></style>
