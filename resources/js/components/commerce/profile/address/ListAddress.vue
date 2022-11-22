<script setup>
import { onMounted } from "vue";
import useProfil from "../../../../composable/profile";

const { getAllAddress, addresses, deleteAdress } = useProfil();

onMounted(async () => {
  getAllAddress();
});
</script>

<template>
  <div class="bg-white shadow-lg rounded-sm border border-slate-200 p-8">
    <div class="text-right pr-5 mb-6">
      <router-link :to="{ path: 'create-address' }">
        <button
          type="button"
          class="justify-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-white hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 bg-indigo-500"
        >
          Ajouter une adrresse
        </button>
      </router-link>
    </div>
    <div class="grid grid-cols-12 gap-6">
      <div
        class="col-span-full sm:col-span-6 xl:col-span-3 bg-white shadow-lg rounded-sm border border-slate-200 shadow-2xl"
        v-for="item in addresses"
        :key="item.id"
      >
      <div class="text-right">
        <button type="button" @click.prevent="deleteAdress(item.id)">
          <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
            <path d="M13 15h2v6h-2zM17 15h2v6h-2z" />
            <path
              d="M20 9c0-.6-.4-1-1-1h-6c-.6 0-1 .4-1 1v2H8v2h1v10c0 .6.4 1 1 1h12c.6 0 1-.4 1-1V13h1v-2h-4V9zm-6 1h4v1h-4v-1zm7 3v9H11v-9h10z"
            />
          </svg>
        </button>
      </div>
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
            <router-link :to="{ path: '/address/' + item.id }">
              <div class="border-t border-slate-200">
                <div class="flex items-center justify-center">
                  <svg
                    class="w-4 h-4 fill-current text-slate-400 group-hover:text-slate-500 shrink-0 mr-2"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M11.7.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM4.6 14H2v-2.6l6-6L10.6 8l-6 6zM12 6.6L9.4 4 11 2.4 13.6 5 12 6.6z"
                    />
                  </svg>
                  <span>Modifier mon adresse</span>
                </div>
              </div>
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped></style>
