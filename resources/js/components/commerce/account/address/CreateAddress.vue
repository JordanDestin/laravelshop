<script setup>
import useProfil from "../../../../composable/account";

const {
  addressForm,
  createAddress,
  validationErrors,
  getAddress,
  addresses,
} = useProfil();
</script>

<template>
  <div class="bg-white shadow-lg rounded-sm border border-slate-200 p-8 mb-4">
    <form @submit.prevent="createAddress">
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
