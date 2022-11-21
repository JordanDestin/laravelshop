<script setup>
import { ref } from "vue";
import useAuth from "../../composable/auth";
import { useRouter } from "vue-router";

const { registerForm, validationErrors, processing, submitRegister } = useAuth();
</script>

<template>
  <!-- <main class="bg-white">
    <div class="relative flex">
     
      <div class="w-full">
        <div class="min-h-screen h-full flex flex-col after:flex-1">
          <div class="max-w-sm mx-auto px-4 py-8 bg-gray-100 mt-4 container">
            
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
  </main> -->



  <div class="hero min-h-screen bg-base-200">
    <div class="hero-content flex-col lg:flex-row-reverse">
      <div class="text-center lg:text-left">
        <h1 class="text-5xl font-bold">Register now!</h1>
        <p class="py-6">
          Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi
          exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.
        </p>
      </div>
      <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
        <form @submit.prevent="submitRegister">
          <div class="card-body">

            <div class="form-control">
              <label class="label">
                <span class="label-text">Nom</span>
              </label>
              <input
                type="text"
                placeholder="Nom"
                class="input input-bordered"
                v-model="registerForm.name"
              />
            </div>
            <div class="text-red-600 mt-1">
              <div v-for="message in validationErrors?.name">
                {{ message }}
              </div>
            </div>
            <div class="form-control">
              <label class="label">
                <span class="label-text">Email</span>
              </label>
              <input
                type="text"
                placeholder="email"
                class="input input-bordered"
                v-model="registerForm.email"
              />
            </div>
            <div class="text-red-600 mt-1">
              <div v-for="message in validationErrors?.email">
                {{ message }}
              </div>
            </div>
            <div class="form-control">
              <label class="label">
                <span class="label-text">Password</span>
              </label>
              <input
                id="password"
                type="password"
                placeholder="password"
                class="input input-bordered"
                v-model="registerForm.password"
              />
            
            </div>
            <div class="form-control">
              <label class="label">
                <span class="label-text">Confirmation mot de passe</span>
              </label>
              <input
                id="password_confirmation"
                type="password"
                placeholder="Confirmation mot de passe"
                class="input input-bordered"
                v-model="registerForm.password_confirmation"
              />
           
            </div>
            <div class="form-control mt-6">
              <button type="submit" class="btn btn-primary">S'enregistrer</button>
            </div>
          </div>
        </form>
        <!-- Footer -->
        <div class="px-3  border-t border-slate-200">
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
</template>
