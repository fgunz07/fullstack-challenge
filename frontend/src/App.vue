<script setup lang="ts">
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
  <header>
    <div class="wrapper">
      <nav class="flex flex-row">
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/">Another Nav</RouterLink>
      </nav>
    </div>
  </header>
  <RouterView />
</template>

<style scoped>

</style>
