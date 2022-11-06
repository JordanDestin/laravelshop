<script setup>

import { onMounted,ref } from 'vue';
import useProducts from '../composable/products';
import emitter from 'tiny-emitter/instance';
import Navbar from '../components/Navbar.vue';

//const emitter = new Emitter();

const { products, getProducts, addProduct } = useProducts();

// const addToCart = async(id) => {
//  await axios.get('/sanctum/csrf-cookie');
//  await axios.get('/api/user')
//   .then(async(res)=>{
//     let carCount = await addProduct(id);
//     console.log(carCount,"qsdqsd")
//     emitter.emit('cartCount', carCount);
//   })
//   .catch(err => console.log(err))    
// }

const addToCart = async(id) => {

    let carCount = await addProduct(id);

    console.log(carCount,"toto")
    emitter.emit('cartCount', carCount);

   
}


onMounted(getProducts);

</script>

<template>
  <div class="flex h-screen overflow-hidden">
    <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
      <main>
        <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- <Navbar/> -->
   


          <!-- Filters -->
          <div class="mb-4 border-b border-slate-200">
            <ul
              class="text-sm font-medium flex flex-nowrap -mx-4 sm:-mx-6 lg:-mx-8 overflow-x-scroll no-scrollbar"
            >
              <li
                class="pb-3 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8"
              >
                <a class="text-indigo-500 whitespace-nowrap" href="#0">View All</a>
              </li>
              <li
                class="pb-3 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8"
              >
                <a class="text-slate-500 hover:text-slate-600 whitespace-nowrap" href="#0"
                  >Courses</a
                >
              </li>
              <li
                class="pb-3 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8"
              >
                <a class="text-slate-500 hover:text-slate-600 whitespace-nowrap" href="#0"
                  >Digital Goods</a
                >
              </li>
              <li
                class="pb-3 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8"
              >
                <a class="text-slate-500 hover:text-slate-600 whitespace-nowrap" href="#0"
                  >Online Events</a
                >
              </li>
              <li
                class="pb-3 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8"
              >
                <a class="text-slate-500 hover:text-slate-600 whitespace-nowrap" href="#0"
                  >Crowdfunding</a
                >
              </li>
            </ul>
          </div>

          <!-- Page content -->
          <div>
            <!-- Cards 2 (Digital Goods) -->
            <div class="mt-8">
              <h2 class="text-xl leading-snug text-slate-800 font-bold mb-5">
                Digital Goods
              </h2>

  
              <div class="grid grid-cols-12 gap-6" >
                <!-- Card 1 -->
                <div
                  class="col-span-full sm:col-span-6 xl:col-span-3 bg-white shadow-lg rounded-sm border border-slate-200 overflow-hidden" v-for="product in products"
                >
                  <div class="flex flex-col h-full">
                    <!-- Image -->
                    <div class="relative">
                      <img
                        class="w-full"
                        :src=  "product.image" 
                        width="286"
                        height="160"
                        alt="Application 05"
                      />
                      <!-- Popular label -->
                      <div class="absolute top-0 right-0 mt-4 mr-4">
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
                          <span>Popular</span>
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
                            {{ product.price }}
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Card footer -->
                      <button class="btn btn-primary" @click="addToCart(product.id)">Ajouter au panier</button>
                    </div>
                  </div>
                </div>

     
              </div>
            </div>

            <!-- Cards 6 (Trending Now) -->
            <div class="mt-8">
              <h2 class="text-xl leading-snug text-slate-800 font-bold mb-5">
                Trending Now
              </h2>
              <div class="grid grid-cols-12 gap-6">
                <!-- Card 1 -->
                <div
                  class="relative col-span-full sm:col-span-6 xl:col-span-3 bg-white shadow-lg rounded-sm border border-slate-200 overflow-hidden"
                >
                  <!-- Image -->
                  <img
                    class="absolute w-full h-full object-cover"
                    src="#"
                    width="286"
                    height="160"
                    alt="Application 17"
                  />
                  <!-- Gradient -->
                  <div
                    class="absolute inset-0 bg-gradient-to-t from-slate-800 to-transparent"
                    aria-hidden="true"
                  ></div>
                  <!-- Content -->
                  <div class="relative h-full p-5 flex flex-col justify-end">
                    <h3 class="text-lg text-white font-semibold mt-16 mb-0.5">
                      Merchandise
                    </h3>
                    <a
                      class="text-sm font-medium text-indigo-400 hover:text-indigo-300"
                      href="#0"
                      >Explore -&gt;</a
                    >
                  </div>
                </div>

                <!-- Card 2 -->
                <div
                  class="relative col-span-full sm:col-span-6 xl:col-span-3 bg-white shadow-lg rounded-sm border border-slate-200 overflow-hidden"
                >
                  <!-- Image -->
                  <img
                    class="absolute w-full h-full object-cover"
                    src=""
                    width="286"
                    height="160"
                    alt="Application 18"
                  />
                  <!-- Gradient -->
                  <div
                    class="absolute inset-0 bg-gradient-to-t from-slate-800 to-transparent"
                    aria-hidden="true"
                  ></div>
                  <!-- Content -->
                  <div class="relative h-full p-5 flex flex-col justify-end">
                    <h3 class="text-lg text-white font-semibold mt-16 mb-0.5">
                      Audiobooks
                    </h3>
                    <a
                      class="text-sm font-medium text-indigo-400 hover:text-indigo-300"
                      href="#0"
                      >Explore -&gt;</a
                    >
                  </div>
                </div>

                <!-- Card 3 -->
                <div
                  class="relative col-span-full sm:col-span-6 xl:col-span-3 bg-white shadow-lg rounded-sm border border-slate-200 overflow-hidden"
                >
                  <!-- Image -->
                  <img
                    class="absolute w-full h-full object-cover"
                    src=""
                    width="286"
                    height="160"
                    alt="Application 19"
                  />
                  <!-- Gradient -->
                  <div
                    class="absolute inset-0 bg-gradient-to-t from-slate-800 to-transparent"
                    aria-hidden="true"
                  ></div>
                  <!-- Content -->
                  <div class="relative h-full p-5 flex flex-col justify-end">
                    <h3 class="text-lg text-white font-semibold mt-16 mb-0.5">
                      Design & Tech
                    </h3>
                    <a
                      class="text-sm font-medium text-indigo-400 hover:text-indigo-300"
                      href="#0"
                      >Explore -&gt;</a
                    >
                  </div>
                </div>

                <!-- Card 4 -->
                <div
                  class="relative col-span-full sm:col-span-6 xl:col-span-3 bg-white shadow-lg rounded-sm border border-slate-200 overflow-hidden"
                >
                  <!-- Image -->
                  <img
                    class="absolute w-full h-full object-cover"
                    src=""
                    width="286"
                    height="160"
                    alt="Application 20"
                  />
                  <!-- Gradient -->
                  <div
                    class="absolute inset-0 bg-gradient-to-t from-slate-800 to-transparent"
                    aria-hidden="true"
                  ></div>
                  <!-- Content -->
                  <div class="relative h-full p-5 flex flex-col justify-end">
                    <h3 class="text-lg text-white font-semibold mt-16 mb-0.5">
                      Apps & Software
                    </h3>
                    <a
                      class="text-sm font-medium text-indigo-400 hover:text-indigo-300"
                      href="#0"
                      >Explore -&gt;</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<style lang="scss" scoped></style>
