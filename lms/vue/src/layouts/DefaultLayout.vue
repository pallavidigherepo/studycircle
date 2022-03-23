<template>
  <div>
    <dark-mode-switcher v-if="isDarkModeSwitcher" />
    <main-color-switcher v-if="isMainColorSwitcher" />
    <mobile-menu />
    <top-bar />
    <div class="wrapper">
      <div class="wrapper-box">
        <!-- BEGIN: Side Menu -->
        <side-menu />
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
          <router-view />
        </div>
        <!-- END: Content -->
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, onMounted, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import { helper as $h } from "@/utils/helper";
import TopBar from "@/components/Menus/TopBar.vue";
import MobileMenu from "@/components/Menus/MobileMenu.vue";
import SideMenu from "@/components/Menus/SideMenu.vue";
import DarkModeSwitcher from "@/components/Switchers/DarkMode/Index.vue";
import MainColorSwitcher from "@/components/Switchers/Color/Index.vue";
import dom from "@left4code/tw-starter/dist/js/dom";

const isDarkModeSwitcher = false;
const isMainColorSwitcher = false;

onMounted(() => {
  dom("body").removeClass("error-page").removeClass("login").addClass("main");
});
</script>
