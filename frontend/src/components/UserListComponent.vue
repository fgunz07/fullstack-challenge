<script lang="ts">
import { useUser } from "@/stores/user";
import { defineComponent } from "vue";
import { storeToRefs } from "pinia";

export default defineComponent({
  name: "UserListComponent",
  created() {
    this.getUsers();
  },
  setup() {
    const store = useUser();
    const { users, userDetails } = storeToRefs(store);

    return {
      users,
      userDetails,
      getUsers: store.getUsers,
      getUser: store.getUser,
    };
  },
});
</script>

<template>
  <h3 class="px-5 py-5 bg-gray-400 shadow-sm max-w-xs">Users</h3>

  <p v-if="!users">Fetching users ...</p>
  <ul v-if="users">
    <li
      class="cursor-pointer"
      @click="getUser(user.id)"
      v-for="user in users.data"
      :key="user.id"
    >
      {{ user.name }}
    </li>
  </ul>
  <div>
    <p v-if="!userDetails">Getting user info ...</p>
    <div v-if="userDetails">
      <code>{{ userDetails }}</code>
    </div>
  </div>
</template>
