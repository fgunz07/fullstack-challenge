<script>
import ListComponent from "./ListComponent.vue";

export default {
  components: {
    ListComponent,
  },

  data: () => ({
    apiResponse: null,
  }),

  created() {
    this.fetchData();
  },

  methods: {
    async fetchData() {
      const url = "http://localhost:8000/";
      this.apiResponse = await (await fetch(url)).json();
    },
  },
};
</script>

<template>
  <div v-if="!apiResponse" class="text-red-300">Pinging the api...</div>

  <div v-if="apiResponse">
    The api responded with: <br />

    <ul>
      <ListComponent />
    </ul>

    <code>
      {{ apiResponse }}
    </code>
  </div>
</template>
