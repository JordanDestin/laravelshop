<script setup>
import { ref } from "vue";
import useAuth from "../../composable/auth";
import { useRouter } from "vue-router";

const { registerForm, validationErrors, processing, submitRegister } = useAuth();
</script>

<template>
  <main class="bg-white">
    <div class="relative flex">
      <!-- Content -->
      <div class="w-full">
        <div class="min-h-screen h-full flex flex-col after:flex-1">
          <div class="max-w-sm mx-auto px-4 py-8 bg-gray-100 mt-4 container">
            <!-- Form -->
            <form @submit.prevent="submitRegister">
              <div class="space-y-4">
                <div>
                  <label class="block text-sm font-medium mb-1" for="email">Nom</label>
                  <input
                    id="name"
                    type="text"
                    placeholder="Nom"
                    class="input w-full max-w-xs"
                    v-model="registerForm.name"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium mb-1" for="email"
                    >Adresse email</label
                  >
                  <input
                    id="email"
                    type="text"
                    placeholder="Adresse email"
                    class="input w-full max-w-xs"
                    v-model="registerForm.email"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium mb-1" for="password"
                    >Mot de passe</label
                  >
                  <input
                    id="password"
                    type="password"
                    placeholder="Mot de passe"
                    class="input w-full max-w-xs"
                    autoComplete="on"
                    v-model="registerForm.password"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium mb-1" for="password"
                    >Confirmation mot de passe</label
                  >
                  <input
                    id="password_confirmation"
                    type="password"
                    placeholder="Confirmation mot de passe"
                    class="input w-full max-w-xs"
                    autoComplete="on"
                    v-model="registerForm.password_confirmation"
                  />
                </div>
              </div>
              <div class="flex items-center justify-between mt-6">
                <button
                  class="btn bg-indigo-500 inline-flex justify-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-white hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                  type="submit"
                >
                  Connexion
                </button>
              </div>
            </form>
            <!-- Footer -->
            <div class="pt-5 mt-6 border-t border-slate-200">
              <div class="text-sm">
                Avez-vous déjà un compte?
                <router-link
                  class="font-medium text-indigo-500 hover:text-indigo-600"
                  to="/login"
                  >Connexion</router-link
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>
