<script setup>
import { onMounted } from "vue";
import useProfil from "../composable/profile";

const {
  addressForm,
  submitAddress,
  validationErrors,
  getAddress,
  addresses,
} = useProfil();

onMounted(async () => {
  getAddress();
});
</script>

<template>
  <div class="bg-white shadow-lg rounded-sm border border-slate-200 p-8">
    <div class="grid grid-cols-12 gap-6">
      <div
        class="col-span-full sm:col-span-6 xl:col-span-3 bg-white shadow-lg rounded-sm border border-slate-200 shadow-2xl"
        v-for="item in addresses"
        :key="item.id"
      >
        <div class="flex flex-col h-full">
          <!-- Card top -->
          <div class="grow p-5">
            <!-- Menu button -->
            <div class="relative">
              <header>
                <p>Addresse : {{ item.address }}</p>
                <p>Complément d'addresse : {{ item.addressbis }}</p>
                <p>Code postal : {{ item.postal }}</p>
                <p>Ville : {{ item.city }}</p>
              </header>
            </div>
            <!-- Card footer -->
            <div class="border-t border-slate-200">
              <div class="flex items-center justify-center">
                <svg class="w-4 h-4 fill-current text-slate-400 group-hover:text-slate-500 shrink-0 mr-2" viewBox="0 0 16 16">
                <path d="M11.7.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM4.6 14H2v-2.6l6-6L10.6 8l-6 6zM12 6.6L9.4 4 11 2.4 13.6 5 12 6.6z" />
              </svg>
                <span>Modifier mon adresse</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <form @submit.prevent="submitAddress">
      <div class="card-body">
        <div class="form-control">
          <label class="label">
            <span class="label-text">Addressse</span>
          </label>
          <input
            type="text"
            placeholder="Addressse"
            class="input input-bordered"
            v-model="addressForm.address"
          />
        </div>
        <div class="text-red-600 mt-1">
          <div v-for="message in validationErrors?.address">
            {{ message }}
          </div>
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Complément d'addressse</span>
          </label>
          <input
            type="text"
            placeholder="Complément d'addressse"
            class="input input-bordered"
            v-model="addressForm.addressbis"
          />
        </div>
        <div class="text-red-600 mt-1">
          <div v-for="message in validationErrors?.addressbis">
            {{ message }}
          </div>
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Code postale</span>
          </label>
          <input
            id="postal"
            type="text"
            placeholder="Code postale"
            class="input input-bordered"
            v-model="addressForm.postal"
          />
        </div>
        <div class="text-red-600 mt-1">
          <div v-for="message in validationErrors?.postal">
            {{ message }}
          </div>
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Ville</span>
          </label>
          <input
            id="city"
            type="text"
            placeholder="Ville"
            class="input input-bordered"
            v-model="addressForm.city"
          />
        </div>
        <div class="text-red-600 mt-1">
          <div v-for="message in validationErrors?.city">
            {{ message }}
          </div>
        </div>
        <div class="form-control mt-6">
          <button type="submit" class="btn btn-primary">Ajouter une addresse</button>
        </div>
      </div>
    </form>
  </div>
</template>

<style lang="scss" scoped></style>
