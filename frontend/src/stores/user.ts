import { defineStore } from "pinia";
import { ref } from "vue";

const customFetch = async (url: string) =>
  await fetch(url, {
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
    },
  });

export const useUser = defineStore("user", () => {
  const url = "http://localhost";
  const users = ref<{ data: object[] } | undefined>();
  const userDetails = ref<object | undefined>();

  // Boolean users request status
  const usersRequestSuccess = ref<boolean>(false);
  // Boolean true while fetching data
  const usersIsFetching = ref<boolean>(true);
  // Fetching user error message
  const userRequestErrorMsg = ref<string | undefined>();

  // Boolean users request status
  const userDetailsRequestSuccess = ref<boolean>(false);
  // Boolean true while fetching data
  const userDetailsIsFetching = ref<boolean>(true);
  // Fetching user error message
  const userDetailsRequestErrorMsg = ref<string | undefined>();

  async function getUsers(): Promise<void> {
    usersIsFetching.value = true;
    users.value = undefined;
    const res = await customFetch(`${url}/users`);
    const json = await res.json();
    usersRequestSuccess.value = res.ok;
    users.value = json;
    // If request not ok
    // Will always response with message
    // Get error message
    if (!res.ok) {
      userRequestErrorMsg.value = json.message;
    }
    // After all set to false
    usersIsFetching.value = false;
  }

  async function getUser(id: number): Promise<void> {
    userDetailsIsFetching.value = true;
    userDetails.value = undefined;
    const res = await customFetch(`${url}/users/${id}`);
    const json = await res.json();
    userDetailsRequestSuccess.value = res.ok;
    userDetails.value = json;

    if (!res.ok) {
      userDetailsRequestErrorMsg.value = json.message;
    }

    // After all set to false
    userDetailsIsFetching.value = false;
  }

  return {
    getUsers,
    getUser,
    users,
    userDetails,
    usersRequestSuccess,
    userRequestErrorMsg,
    usersIsFetching,
    userDetailsRequestSuccess,
    userDetailsIsFetching,
    userDetailsRequestErrorMsg,
  };
});
