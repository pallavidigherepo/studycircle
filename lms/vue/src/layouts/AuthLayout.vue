<template>
  <div>
    <dark-mode-switcher v-if="isDarkModeSwitcher" />
    <main-color-switcher  v-if="isMainColorSwitcher" />
    <div class="container sm:px-10">
      
        <router-view />
    </div>
  </div>
</template>

<script setup>
import { onMounted } from "vue";

import DarkModeSwitcher from "@/components/Switchers/DarkMode/Index.vue";
import MainColorSwitcher from "@/components/Switchers/Color/Index.vue";

import dom from "@left4code/tw-starter/dist/js/dom";

const isDarkModeSwitcher = false;
const isMainColorSwitcher = false;

onMounted(() => {
  dom("body").removeClass("main").removeClass("error-page").addClass("login");
});
</script>
