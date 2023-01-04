<script setup>

import Navbar from "../components/Navbar.vue";
import Categories from "../components/Categories.vue";
import Carousel from "../components/Carousel.vue";

import AllProduct from "../components/commerce/product/AllProduct.vue";

</script>

<template>
  <Navbar />
  <main>
    <div>
      <Carousel />
      <div class="mt-8 container w-full max-w-5xl mx-auto">
        <!-- <Categories /> -->
        <AllProduct />
      </div>
    </div>
  </main>
</template>
