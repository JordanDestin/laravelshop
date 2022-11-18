<script setup>
import { onMounted, reactive } from "vue";
import useCategories from "../../../composable/categories.js";
import useProductsBack from "../../../composable/admin/product/productBack";

const { getCategories, categories } = useCategories();
const { addProduct, validationErrors, isLoading } = useProductsBack();

const product = reactive({
  name: "",
  description: "",
  category_id: "",
  image: "",
  active: true,
  price: "",
  quantity_product: "",
  tendance: false,
});

console.log(product.image);

onMounted(getCategories);
</script>

<template>
  <div class="bg-white shadow-lg rounded-sm border border-slate-200 px-5 py-4">
    <header class="px-5 py-4">
      <h1 class="font-semibold text-slate-800">Création d'un produit</h1>
    </header>
    <div class="container">
      <form @submit.prevent="addProduct(product)">
        <!-- Title -->
        <div>
          <label for="product-name" class="block font-medium text-sm text-gray-700">
            Nom du produit
          </label>
          <input
            type="text"
            placeholder="Nom du produit"
            class="input input-bordered w-full"
            v-model="product.name"
          />
          <!-- <div class="text-red-600 mt-1">
            {{ errors.name }}
          </div> -->
          <div class="text-red-600 mt-1">
            <div v-for="message in validationErrors?.name">
              {{ message }}
            </div>
          </div>
        </div>
        <!-- Content -->
        <div class="mt-4">
          <label for="post-content" class="block font-medium text-sm text-gray-700">
            Description
          </label>

          <textarea
            class="textarea textarea-bordered w-full"
            placeholder="Description"
            v-model="product.description"
          ></textarea>
          <!-- <div class="text-red-600 mt-1">
                {{ errors.content }}
            </div> -->
            <div class="text-red-600 mt-1">
                <div v-for="message in validationErrors?.description">
                    {{ message }}
                </div>
            </div>
        </div>
        <!-- Category -->

        <div class="mt-4">
          <label for="post-category" class="block font-medium text-sm text-gray-700">
            Category
          </label>
          <select class="select select-bordered w-full" v-model="product.category_id">
            <option value="" selected>-- all categories --</option>
            <option v-for="category in categories" :value="category.id">
              {{ category.name }}
            </option>
          </select>
          <!-- <div class="text-red-600 mt-1">
                {{ errors.category_id }}
            </div> -->
            <div class="text-red-600 mt-1">
                <div v-for="message in validationErrors?.category_id">
                    {{ message }}
                </div>
            </div>
        </div>
        <div class="mt-4">
          <label for="post-category" class="block font-medium text-sm text-gray-700">
            Prix du produit
          </label>
          <input
            type="text"
            placeholder="Prix du produit"
            class="input input-bordered w-full"
            v-model="product.price"
          />
          <!-- <div class="text-red-600 mt-1">
                {{ errors.category_id }}
            </div> -->
            <div class="text-red-600 mt-1">
                <div v-for="message in validationErrors?.price">
                    {{ message }}
                </div>
            </div>
        </div>
        <div class="mt-4">
          <label for="post-category" class="block font-medium text-sm text-gray-700">
            Quantité
          </label>
          <input
            type="text"
            placeholder="Quantité"
            class="input input-bordered w-full"
            v-model="product.quantity_product"
          />
          <!-- <div class="text-red-600 mt-1">
                {{ errors.category_id }}
            </div> -->
            <div class="text-red-600 mt-1">
                <div v-for="message in validationErrors?.quantity_product">
                    {{ message }}
                </div>
            </div>
        </div>
        <div class="mt-4">
          <label for="post-category" class="block font-medium text-sm text-gray-700">
            Active
          </label>
          <input type="checkbox" class="toggle toggle-success" v-model="product.active" />
          <!-- <div class="text-red-600 mt-1">
                {{ errors.category_id }}
            </div> -->
            <div class="text-red-600 mt-1">
                <div v-for="message in validationErrors?.active">
                    {{ message }}
                </div>
            </div>
        </div>
        <div class="mt-4">
          <label for="post-category" class="block font-medium text-sm text-gray-700">
            Tendance
          </label>
          <input
            type="checkbox"
            class="toggle toggle-success"
            v-model="product.tendance"
          />
          <!-- <div class="text-red-600 mt-1">
                {{ errors.category_id }}
            </div> -->
            <div class="text-red-600 mt-1">
                <div v-for="message in validationErrors?.tendance">
                    {{ message }}
                </div>
            </div>
        </div>
        <div class="mt-4">
          <label for="post-category" class="block font-medium text-sm text-gray-700">
            Image
          </label>
          <input
            type="file"
            class="file-input file-input-bordered w-full max-w-xs"
            @change="product.image = $event.target.files[0]"
          />
          <!-- <div class="text-red-600 mt-1">
                {{ errors.category_id }}
            </div> -->
            <div class="text-red-600 mt-1">
                <div v-for="message in validationErrors?.image">
                    {{ message }}
                </div>
            </div>
        </div>
   
        <!-- Buttons -->
        <div class="mt-4 text-right">
          <button 
            :disabled="isLoading"
            class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded disabled:opacity-75 disabled:cursor-not-allowed"
            type="submit"
          >
            <div v-show="isLoading" class="inline-block animate-spin w-4 h-4 mr-2 border-t-2 border-t-white border-r-2 border-r-white border-b-2 border-b-white border-l-2 border-l-blue-600 rounded-full"></div>
                <span v-if="isLoading">Processing...</span>
                <span v-else>Save</span>
            Créer le produit
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<style lang="scss" scoped></style>
