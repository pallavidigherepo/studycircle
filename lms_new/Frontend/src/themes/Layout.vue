<script setup lang="ts">
import { useThemeStore, getTheme } from "@/stores/theme";
import ThemeSwitcher from "@/components/ThemeSwitcher";
import { onMounted, computed, ref } from "vue";

const themeStore = useThemeStore();
const Component = computed(() => getTheme(themeStore.theme).component);
const isThemeSwitcherOn = ref(false)
</script>

<template>
  <div>
    <ThemeSwitcher v-if="isThemeSwitcherOn" />
    <Component />
  </div>
</template>
