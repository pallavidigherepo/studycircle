<template>
  <!-- BEGIN: Mobile Menu -->
  <div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <router-link :to="{ name: 'Dashboard' }" class="flex mr-auto">
<!--            <img alt="Meritest Learning Management System" class="w-20" src="@/assets/images/logos/logo-updated.png" />-->
            <img alt="Meritest Learning Management System" class="w-20" src="@/assets/images/logos/logo.png" />
        </router-link>
        <a href="javascript:;" id="mobile-menu-toggler">
            <BarChart2Icon
              class="w-8 h-8 text-white transform -rotate-90"
              @click="toggleMobileMenu"
            />
        </a>
    </div>
    <transition @enter="enter" @leave="leave">
      <ul
        v-if="activeMobileMenu"
        class="border-t border-white/[0.08] py-5 hidden"
      >
        <!-- BEGIN: First Child -->
        <template v-for="(menu, menuKey) in formattedMenu">
          <li
            v-if="menu === 'devider'"
            :key="menu + menuKey"
            class="menu__devider my-6"
          ></li>
          <li v-else :key="menu + menuKey">
            <a
              href="javascript:;"
              class="menu"
              :class="{
                'menu--active': menu.active,
                'menu--open': menu.activeDropdown,
              }"
              @click="linkTo(menu, router)"
            >
              <div class="menu__icon">
                <component :is="menu.icon" />
              </div>
              <div class="menu__title">
                {{ menu.title }}
                <div
                  v-if="menu.subMenu"
                  class="menu__sub-icon"
                  :class="{ 'transform rotate-180': menu.activeDropdown }"
                >
                  <ChevronDownIcon />
                </div>
              </div>
            </a>
            <!-- BEGIN: Second Child -->
            <transition @enter="enter" @leave="leave">
              <ul v-if="menu.subMenu && menu.activeDropdown">
                <li
                  v-for="(subMenu, subMenuKey) in menu.subMenu"
                  :key="subMenuKey"
                >
                  <a
                    href="javascript:;"
                    class="menu"
                    :class="{ 'menu--active': subMenu.active }"
                    @click="linkTo(subMenu, router)"
                  >
                    <div class="menu__icon">
                      <component :is="subMenu.icon" />
                    </div>
                    <div class="menu__title">
                      {{ subMenu.title }}
                      <div
                        v-if="subMenu.subMenu"
                        class="menu__sub-icon"
                        :class="{
                          'transform rotate-180': subMenu.activeDropdown,
                        }"
                      >
                        <ChevronDownIcon />
                      </div>
                    </div>
                  </a>
                  <!-- BEGIN: Third Child -->
                  <transition @enter="enter" @leave="leave">
                    <ul v-if="subMenu.subMenu && subMenu.activeDropdown">
                      <li
                        v-for="(lastSubMenu, lastSubMenuKey) in subMenu.subMenu"
                        :key="lastSubMenuKey"
                      >
                        <a
                          href="javascript:;"
                          class="menu"
                          :class="{ 'menu--active': lastSubMenu.active }"
                          @click="linkTo(lastSubMenu, router)"
                        >
                          <div class="menu__icon">
                            <ZapIcon />
                          </div>
                          <div class="menu__title">
                            {{ lastSubMenu.title }}
                          </div>
                        </a>
                      </li>
                    </ul>
                  </transition>
                  <!-- END: Third Child -->
                </li>
              </ul>
            </transition>
            <!-- END: Second Child -->
          </li>
        </template>
        <!-- END: First Child -->
      </ul>
    </transition>
  </div>
  <!-- END: Mobile Menu -->
</template>

<script setup>
import { computed, onMounted, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import { helper as $h } from "@/utils/helper";
import { useSideMenuStore } from "@/stores/side-menu";
import {
  activeMobileMenu,
  toggleMobileMenu,
  linkTo,
  enter,
  leave,
} from "@/menus/mobile_menu.js";
import { nestedMenu } from "@/menus";

const route = useRoute();
const router = useRouter();
const formattedMenu = ref([]);
const sideMenuStore = useSideMenuStore();
const mobileMenu = computed(() => nestedMenu(sideMenuStore.menu, route));

watch(
  computed(() => route.path),
  () => {
    formattedMenu.value = $h.toRaw(mobileMenu.value);
  }
);

onMounted(() => {
  formattedMenu.value = $h.toRaw(mobileMenu.value);
});
</script>
