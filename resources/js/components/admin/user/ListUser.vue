<script setup>
import { onMounted, ref } from "vue";
import useUserBack from "../../../composable/admin/user/userBack";

const { getAllUsers, users } = useUserBack();

onMounted(async () => {
  await getAllUsers();
});
</script>

<template>
  <div class="bg-white shadow-lg rounded-sm border border-slate-200 relative">
    <header class="px-5 py-4">
      <h1 class="font-semibold text-slate-800">
        Mes utilisateurs <span class="text-slate-400 font-medium">442</span>
      </h1>
    </header>

    <div>
      <!-- Table -->
      <div class="overflow-x-auto">
        <table class="table-auto w-full divide-y divide-slate-200">
          <thead
            class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-slate-200"
          >
            <tr>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Nom utilisateur</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">email</div>
              </th>

              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap"></th>
            </tr>
          </thead>

          <tbody class="text-sm" v-for="user in users" :key="user.id">
            <tr>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div>{{ user.name }}</div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-medium text-slate-800">{{ user.email }}</div>
              </td>

              <td>
                <router-link :to="{ path: 'order-user/'+user.id }">
                <button
                  type="button"
                  class="inline-flex justify-center rounded-md border border-transparent bg-black px-4 py-2 text-sm font-medium text-white hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                >
                  voir
                </button>
            </router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- <TailwindPagination
        :data="products"
        @pagination-change-page="(page) => getAllUsers(page)"
        class="btn-group"
      /> -->
    </div>
  </div>
</template>

<style lang="scss" scoped></style>
