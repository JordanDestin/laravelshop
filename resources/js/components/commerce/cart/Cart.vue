<script setup>
import { ref } from "vue";
import Navbar from "../../Navbar.vue";
import CartContent from "./CartContent.vue";
import ChoiceAdress from "../cart/ChoiceAdress.vue";
import PaymentVue from "../../../pages/Payment.vue";

const setps = [CartContent, ChoiceAdress, PaymentVue];

const currentStep = ref(0);

const nextStep = () => {
  currentStep.value++;
};
const previousStep = () => {
  currentStep.value--;
};
</script>

<template>
  <Navbar />
  <div class="px-4 pt-12 pb-8">
    <div class="max-w-md mx-auto w-full">
      <div class="relative">
        <div
          class="absolute left-0 top-1/2 -mt-px w-full h-0.5 bg-slate-200"
          aria-hidden="true"
        ></div>
        <ul class="relative flex justify-between w-full">
          <li>
            <router-link
              class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-indigo-500 text-white"
              to="/onboarding-01"
              >1</router-link
            >
          </li>
          <li>
            <router-link
              class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-slate-100 text-slate-500"
              to="/onboarding-02"
              >2</router-link
            >
          </li>
          <li>
            <router-link
              class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-slate-100 text-slate-500"
              to="/onboarding-03"
              >3</router-link
            >
          </li>
          <li>
            <router-link
              class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-slate-100 text-slate-500"
              to="/onboarding-04"
              >4</router-link
            >
          </li>
        </ul>
      </div>
    </div>
  </div>

  <component v-bind:is="setps[currentStep]"></component>

  <button
    type="submit"
    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
    v-on:click="previousStep"
 > 
    Précedent
  </button>

  <button
    type="submit"
    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
    v-on:click="nextStep"
  >
    Suivant
  </button>
</template>

<style lang="scss" scoped></style>
