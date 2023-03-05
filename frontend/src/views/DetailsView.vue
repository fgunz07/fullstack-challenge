<script setup>
import DetailsComponent from "@/components/DetailsComponent.vue";
import DetailsViewSkeleton from "@/components/DetailsViewSkeleton.vue";
import { storeToRefs } from "pinia";
import { useUser } from "@/stores/user";
import { useRoute } from "vue-router";

const store = useUser();

const route = useRoute();

store.getUser(route.params.id);

const { userDetailsIsFetching, userDetails, userDetailsRequestSuccess } =
  storeToRefs(store);
</script>

<template>
  <DetailsViewSkeleton v-if="userDetailsIsFetching" />
  <DetailsComponent
    v-if="!userDetailsIsFetching && userDetails && userDetailsRequestSuccess"
  />
</template>
