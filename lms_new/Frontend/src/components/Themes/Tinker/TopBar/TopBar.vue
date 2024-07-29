<script setup lang="ts">
import { ref, computed } from "vue";
import Lucide from "@/components/Base/Lucide";
import Breadcrumb from "@/components/Base/Breadcrumb";
import { FormInput } from "@/components/Base/Form";
import { Menu, Popover } from "@/components/Base/Headless";
import fakerData from "@/utils/faker";
import logoURL from "@/assets/images/logos/logo.png";
import _ from "lodash";
import { TransitionRoot } from "@headlessui/vue";
import store from "@/stores/index.js";

import axiosClient from "@/axios";

import { useRoute, useRouter } from "vue-router";
const route = useRoute();
const router = useRouter();

const searchDropdown = ref(false);
const showSearchDropdown = () => {
  searchDropdown.value = true;
};
const hideSearchDropdown = () => {
  searchDropdown.value = false;
};

const userInfo = computed(() => {
  const userItem = localStorage.getItem("USER");
  return userItem ? JSON.parse(userItem) : null;
});


async function logout() {
  await store.dispatch('auth/logout').then(() => {
    router.push('/login')
  }).catch(() => {

  });;

}
function profile() {
  router.push('/profile');
}

function resetPassword() {
  router.push('/reset_password');
}

</script>

<template>
  <!-- BEGIN: Top Bar -->
  <div
    class="relative z-[51] flex h-[67px] items-center border-b border-slate-200"
  >
    <!-- BEGIN: Breadcrumb -->
    <Breadcrumb class="hidden mr-auto -intro-x sm:flex">
      <Breadcrumb.Link to="/">Application</Breadcrumb.Link>
      <Breadcrumb.Link v-if="route.name !== 'Dashboard'" :active="true">{{ route.name }}</Breadcrumb.Link>
    </Breadcrumb>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Account Menu -->
    <Menu>
      <Menu.Button
        class="block w-8 h-8 overflow-hidden rounded-full shadow-lg image-fit zoom-in intro-x"
      >
        <img
          alt="Meritest: Learning Management System"
          :src="`https://eu.ui-avatars.com/api/?size=225&name=` + userInfo.name"
        />
      </Menu.Button>
      <Menu.Items class="w-56 mt-px text-white bg-primary">
        <Menu.Header class="font-normal">
          <div class="font-medium">{{ userInfo.name }}</div>
          <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">
            {{ userInfo.roles[0].name }}
          </div>
        </Menu.Header>
        <Menu.Divider class="bg-white/[0.08]" />
        <Menu.Item class="hover:bg-white/5"  @click="profile">
          <Lucide icon="User" class="w-4 h-4 mr-2" /> Profile
        </Menu.Item>
        
        <!-- <Menu.Item class="hover:bg-white/5"  @click="resetPassword">
          <Lucide icon="Lock" class="w-4 h-4 mr-2" /> Reset Password
        </Menu.Item> -->
        
        <Menu.Divider class="bg-white/[0.08]" />
        <a href="#" @click="logout">
        <Menu.Item class="hover:bg-white/5">
          <Lucide icon="ToggleRight" class="w-4 h-4 mr-2" /> Logout
        </Menu.Item>
        </a>
      </Menu.Items>
    </Menu>
  </div>
  <!-- END: Top Bar -->
</template>
