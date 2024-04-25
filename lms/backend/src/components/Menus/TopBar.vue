<template>
  <!-- BEGIN: Top Bar -->
  <div
    class="top-bar-boxed h-[70px] z-[51] relative border-b border-white/[0.08] -mt-7 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 md:pt-0 mb-12">
    <div class="h-full flex items-center">
      <!-- BEGIN: Logo -->
      <router-link :to="{ name: 'Dashboard' }" class="-intro-x hidden md:flex">
<!--        <img alt="Meritest Learning Management System" class="w-20" src="@/assets/images/logos/logo-updated.png" />-->
          <img alt="Meritest Learning Management System" class="w-20" src="@/assets/images/logos/logo.png" />
      </router-link>
      <!-- END: Logo -->
      <!-- BEGIN: Breadcrumb -->
      <Breadcrumb />
      <!-- END: Breadcrumb -->

      <!-- BEGIN: Account Menu -->
      <div class="intro-x dropdown w-8 h-8" v-if="userInfo">
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110"
          role="button" aria-expanded="false" data-tw-toggle="dropdown">

          <img v-if="userInfo" :alt="userInfo.name" :src="`https://eu.ui-avatars.com/api/?name=` + userInfo.name" />
        </div>
        <div class="dropdown-menu w-56">
          <ul
            class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">

            <li class="p-2">
              <div class="font-medium" v-if="userInfo">
                {{ userInfo.name }}
              </div>
              <div class="text-xs text-white/60 mt-0.5 dark:text-slate-500">
                {{ userInfo.designation }}
              </div>
            </li>
            <li>
              <hr class="dropdown-divider border-white/[0.08]" />
            </li>
            <li>
              <router-link :to="{ name: 'Profile' }"
                class="dropdown-item hover:bg-white/5"
                @click="dom('.dropdown-menu').removeClass('show').addClass('hide');"
                >
                <UserIcon class="w-4 h-4 mr-2" /> Profile
              </router-link>
            </li>
            <li>
              <hr class="dropdown-divider border-white/[0.08]" />
            </li>
            <li>
              <a href="javascript:;" class="dropdown-item hover:bg-white/5" @click="logout">
                <ToggleRightIcon class="w-4 h-4 mr-2" /> Logout
              </a>
            </li>
          </ul>
        </div>
      </div>
      <!-- END: Account Menu -->
    </div>
  </div>
  <!-- END: Top Bar -->
</template>

<script setup>

import store from '@/stores';
import { ref, computed } from "vue";
import { useRouter } from 'vue-router';
import dom from "@left4code/tw-starter/dist/js/dom";

const router = useRouter();

const breadcrumb = ref('');

const searchDropdown = ref(false);
const showSearchDropdown = () => {
  searchDropdown.value = true;
};
const hideSearchDropdown = () => {
  searchDropdown.value = false;
};

//const userInfo = computed(() => store.state.auth.user.data);
const userInfo = computed(() => JSON.parse(sessionStorage.getItem("USER")));

function logout() {
  dom(".dropdown-menu").removeClass("show").addClass("hide");
  store.dispatch("auth/logout").then(() => {
    router.push({
      name: "Login",
    });
  });
}
</script>
