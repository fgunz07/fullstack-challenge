<script lang="ts">
import { useUser } from "@/stores/user";
import { defineComponent } from "vue";
import { storeToRefs } from "pinia";
import UserListSkeleton from "./UserListSkeleton.vue";
import { RouterLink } from "vue-router";

export default defineComponent({
  name: "UserListComponent",
  components: {
    UserListSkeleton,
    RouterLink,
  },
  created() {
    this.getUsers();
  },
  setup() {
    const store = useUser();
    const { users, usersIsFetching, usersRequestSuccess, userRequestErrorMsg } =
      storeToRefs(store);

    return {
      users,
      usersIsFetching,
      usersRequestSuccess,
      userRequestErrorMsg,
      getUsers: store.getUsers,
      getUser: store.getUser,
    };
  },
});
</script>

<template>
  <UserListSkeleton v-if="usersIsFetching" />

  <div
    v-if="!usersIsFetching && usersRequestSuccess && users"
    class="flex md:flex-col md:max-h-screen md:px-2 md:w-64 overflow-x-auto w-auto justify-between no-scroll mb-2"
  >
    <RouterLink
      v-for="user in users.data"
      :key="user.id"
      :to="`/${user.id}`"
      @click="getUser(user.id)"
      class="md:mr-0 md:w-full mr-2 cursor-pointer flex-shrink-0 block h-14 w-36 border text-center py-3 my-1 rounded-md"
    >
      {{ user.name }}
    </RouterLink>
  </div>
</template>
