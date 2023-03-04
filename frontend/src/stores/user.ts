import { defineStore } from "pinia";
import { ref } from "vue";

export const useUser = defineStore("user", () => {
  const url = "http://localhost";
  const users = ref<Object[] | undefined>();
  const userDetails = ref<Object | undefined>();

  async function getUsers(): Promise<void> {
    users.value = await (await fetch(`${url}/users`)).json();
  }

  async function getUser(id: number): Promise<void> {
    userDetails.value = undefined;
    userDetails.value = await (await fetch(`${url}/users/${id}`)).json();
  }

  return {
    getUsers,
    getUser,
    users,
    userDetails,
  };
});
