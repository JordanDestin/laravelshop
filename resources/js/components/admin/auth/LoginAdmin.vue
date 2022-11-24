<script setup>
import useAuthBack from "../../../composable/admin/auth/authBack";

const { loginFormBack, submitLoginBack } = useAuthBack();
</script>

<template>
  <main class="bg-white">
    <div class="relative flex">
      <div class="w-full">
        <div class="min-h-screen h-full flex flex-col after:flex-1">
          <div class="max-w-sm mx-auto px-4 py-8 bg-gray-100 mt-4 container">
            <form @submit.prevent="submitLoginBack">
              <div class="space-y-4">
                <div>
                  <label class="block text-sm font-medium mb-1" for="email"
                    >Adresse email</label
                  >
                  <input
                    id="email"
                    type="text"
                    placeholder="Adresse email"
                    class="input w-full max-w-xs"
                    v-model="loginFormBack.email"
                  />
                  <!-- <div class="text-red-600 mt-1">
                    <div v-for="message in validationErrors?.email">
                      {{ message }}
                    </div>
                  </div> -->
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
                    v-model="loginFormBack.password"
                  />
                  <!-- <div class="text-red-600 mt-1">
                    <div v-for="message in validationErrors?.password">
                      {{ message }}
                    </div>
                  </div> -->
                </div>
              </div>
              <div class="flex items-center justify-between mt-6">
                <div class="mr-1">
                  <router-link class="text-sm underline hover:no-underline" to=""
                    >Mot de passe oublié?</router-link
                  >
                </div>
                <button
                  class="btn bg-indigo-500 inline-flex justify-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-white hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                  type="submit"
                >
                  Connexion
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<style lang="scss" scoped></style>
