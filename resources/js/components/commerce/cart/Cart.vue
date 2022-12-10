<script setup>
import { ref } from 'vue';
import Navbar from '../../Navbar.vue';
import CartContent from './CartContent.vue';
import ChoiceAdress from '../cart/ChoiceAdress.vue';
import PaymentVue from '../../../pages/Payment.vue';

const setps = [
    CartContent,
    ChoiceAdress,
    PaymentVue
];

const step = ref(0)

</script>


<template>
    <Navbar/>
    <div class="px-4 pt-12 pb-8">
              <div class="max-w-md mx-auto w-full">
                <div class="relative">
                  <div class="absolute left-0 top-1/2 -mt-px w-full h-0.5 bg-slate-200" aria-hidden="true"></div>
                  <ul class="relative flex justify-between w-full">
                    <li>
                      <router-link class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-indigo-500 text-white" to="/onboarding-01">1</router-link>
                    </li>
                    <li>
                      <router-link class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-slate-100 text-slate-500" to="/onboarding-02">2</router-link>
                    </li>
                    <li>
                      <router-link class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-slate-100 text-slate-500" to="/onboarding-03">3</router-link>
                    </li>
                    <li>
                      <router-link class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-slate-100 text-slate-500" to="/onboarding-04">4</router-link>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <component v-bind:is="setps [step]"></component>
       
            
</template>


<style lang="scss" scoped>

</style>