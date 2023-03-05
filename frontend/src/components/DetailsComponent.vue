<script>
import { defineComponent } from "vue";
import { useUser } from "@/stores/user";
import { storeToRefs } from "pinia";

export default defineComponent({
  computed: {
    date() {
      const today = Date.now();

      if (typeof this.userDetails.weather === "string") {
        return new Date(today);
      }

      return new Date(this.userDetails.weather.dt);
    },
    skyStatus() {
      return this.userDetails.weather.clouds.all > 50 ? "Cloudy" : "Clear";
    },
    weatherIsObject() {
      return typeof this.userDetails.weather === "object";
    },
    degreeCelsius() {
      return Math.round(this.userDetails.weather.main.temp - 273.15);
    },
  },
  setup() {
    const store = useUser();
    const { userDetails } = storeToRefs(store);
    return { userDetails, getUser: store.getUser };
  },
});
</script>

<template>
  <div
    class="md:flex md:flex-1 md:h-96 md:justify-center md:w-full border m-2 rounded-md overflow-hidden bg-opacity-40"
  >
    <div class="md:flex-1 mb-3 p-5">
      <div class="flex space-x-3">
        <p class="text-[8px] md:text-sm font-light">
          lat {{ userDetails.data.lat }}
        </p>
        <p class="text-[8px] md:text-sm font-light">
          lng {{ userDetails.data.lng }}
        </p>
      </div>

      <div class="flex">
        <svg
          class="h-4 mr-2"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 384 512"
        >
          <!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
          <path
            d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"
          />
        </svg>
        <h4 class="font-bold text-sm md:text-lg flex-1">
          {{ userDetails.data.name }}
          <span class="md:text-sm text-[10px] font-thin">{{
            userDetails.data.email
          }}</span>
        </h4>
        <div class="text-xs flex-1 text-right">{{ date }}</div>
      </div>
      <div v-if="!weatherIsObject">
        <h1 class="text-8xl md:text-9xl text-gray-400 text-center font-normal">
          {{ this.userDetails.weather }}
        </h1>
      </div>
      <div v-if="weatherIsObject">
        <h1 class="text-8xl md:text-9xl text-center font-normal">
          {{ degreeCelsius }}°
        </h1>
        <p
          class="capitalize text-xs md:text-sm block text-center font-light mb-5"
        >
          Mostly {{ skyStatus }}
        </p>

        <div class="flex justify-between">
          <div class="">
            <!-- Icon -->
            <svg
              class="h-4 w-3 font-light inline-block mr-1"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 512 512"
            >
              <!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
              <path
                d="M288 32c0 17.7 14.3 32 32 32h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H352c53 0 96-43 96-96s-43-96-96-96H320c-17.7 0-32 14.3-32 32zm64 352c0 17.7 14.3 32 32 32h32c53 0 96-43 96-96s-43-96-96-96H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H384c-17.7 0-32 14.3-32 32zM128 512h32c53 0 96-43 96-96s-43-96-96-96H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H160c17.7 0 32 14.3 32 32s-14.3 32-32 32H128c-17.7 0-32 14.3-32 32s14.3 32 32 32z"
              />
            </svg>
            <!-- Label -->
            <p class="font-medium text-xs inline-block">
              {{ userDetails.weather.main.pressure }}hpa
            </p>
          </div>

          <div class="">
            <!-- Icon -->
            <svg
              class="h-4 w-3 font-light inline-block mr-1"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 384 512"
            >
              <!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
              <path
                d="M192 512C86 512 0 426 0 320C0 228.8 130.2 57.7 166.6 11.7C172.6 4.2 181.5 0 191.1 0h1.8c9.6 0 18.5 4.2 24.5 11.7C253.8 57.7 384 228.8 384 320c0 106-86 192-192 192zM96 336c0-8.8-7.2-16-16-16s-16 7.2-16 16c0 61.9 50.1 112 112 112c8.8 0 16-7.2 16-16s-7.2-16-16-16c-44.2 0-80-35.8-80-80z"
              />
            </svg>
            <!-- Label -->
            <p class="font-medium text-xs inline-block">
              {{ userDetails.weather.main.humidity }}%
            </p>
          </div>

          <div class="">
            <!-- Icon -->
            <svg
              class="h-4 w-3 font-light inline-block mr-1"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 512 512"
            >
              <!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
              <path
                d="M288 32c0 17.7 14.3 32 32 32h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H352c53 0 96-43 96-96s-43-96-96-96H320c-17.7 0-32 14.3-32 32zm64 352c0 17.7 14.3 32 32 32h32c53 0 96-43 96-96s-43-96-96-96H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H384c-17.7 0-32 14.3-32 32zM128 512h32c53 0 96-43 96-96s-43-96-96-96H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H160c17.7 0 32 14.3 32 32s-14.3 32-32 32H128c-17.7 0-32 14.3-32 32s14.3 32 32 32z"
              />
            </svg>
            <!-- Label -->
            <p class="font-medium text-xs inline-block">
              {{ userDetails.weather.wind.speed }}m/s
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
