<script setup lang="ts">
import { RouterLink, RouterView } from "vue-router";
import UserListComponent from "@/components/UserListComponent.vue";
import { storeToRefs } from "pinia";
import { useUser } from "@/stores/user";

const store = useUser();
const {
  userRequestErrorMsg,
  userDetailsRequestErrorMsg,
} = storeToRefs(store);
</script>

<template>
  <div
    v-if="userRequestErrorMsg || userDetailsRequestErrorMsg"
    class="h-7 bg-red-400 text-white px-5"
  >
    Errored: {{ userDetailsRequestErrorMsg || userRequestErrorMsg }}
  </div>
  <div class="font-light">
    <header>
      <div class="font-lightr">
        <nav class="shadow uppercase font-medium block w-full text-center py-2">
          <RouterLink to="/" class="uppercase">Weather App</RouterLink>
        </nav>
      </div>
    </header>
    <div class="flex">
      <UserListComponent />
      <hr />
      <RouterView />
    </div>
  </div>
</template>

<style scoped></style>
