<template>
  <div>
    <DarkModeSwitcher />
    <MainColorSwitcher />
    <div class="container sm:px-10">
      <div class="block xl:grid grid-cols-2 gap-4">
        <!-- BEGIN: Login Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
          <router-link :to="{name: 'Dashboard'}" class="-intro-x hidden md:flex">
              <img
                alt="Learning Management System"
                class="w-6"
                src="@/assets/images/logos/MT_icon.png"
              />
              <span class="text-white text-lg ml-3"> Meritest LMS </span>
            </router-link>
          <div class="my-auto">
            <img
              alt="Meritest Learning Management System"
              class="-intro-x w-1/2 -mt-16"
              src="@/assets/images/illustration.svg"
            />
            <div
              class="
                -intro-x
                text-white
                font-medium
                text-4xl
                leading-tight
                mt-10
              "
            >
              A few more clicks to <br />
              sign in to your account.
            </div>
          </div>
        </div>
        <!-- END: Login Info -->
        <!-- BEGIN: Login Form -->
        <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
          <div
            class="
              my-auto
              mx-auto
              xl:ml-20
              bg-white
              dark:bg-darkmode-600
              xl:bg-transparent
              px-5
              sm:px-8
              py-8
              xl:p-0
              rounded-md
              shadow-md
              xl:shadow-none
              w-full
              sm:w-3/4
              lg:w-2/4
              xl:w-auto
            "
          >
            <h2
              class="
                intro-x
                font-bold
                text-2xl
                xl:text-3xl
                text-center
                xl:text-left
              "
            >
              Sign In
            </h2>
            <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">
              A few more clicks to sign in to your account. Manage all your
              e-commerce accounts in one place
            </div>
            <div
              class="alert alert-danger show flex items-center mb-2"
              role="alert"
              v-if="errorMsg"
            >
              <AlertOctagonIcon class="w-6 h-6 mr-2" />
              {{ errorMsg }}
            </div>
            <form @submit.prevent="login">
              <div class="intro-x mt-8">
                <input
                  type="text"
                  class="intro-x login__input form-control py-3 px-4 block"
                  placeholder="Email"
                  v-model="user.email"
                />
                <input
                  type="password"
                  class="intro-x login__input form-control py-3 px-4 block mt-4"
                  placeholder="Password"
                  v-model="user.password"
                />
              </div>
              <div
                class="
                  intro-x
                  flex
                  text-slate-600
                  dark:text-slate-500
                  text-xs
                  sm:text-sm
                  mt-4
                "
              >
                <div class="flex items-center mr-auto">
                  <input
                    id="remember-me"
                    type="checkbox"
                    class="form-check-input border mr-2"
                    v-model="user.remember"
                  />
                  <label class="cursor-pointer select-none" for="remember-me"
                    >Remember me</label
                  >
                </div>
              </div>
              <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                <button
                  class="
                    btn btn-primary
                    py-3
                    px-4
                    w-full
                    xl:w-32 xl:mr-3
                    align-top
                  "
                  type="submit"
                >
                  Login
                </button>
              </div>
            </form>
          </div>
        </div>
        <!-- END: Login Form -->
      </div>
    </div>
      <Loading v-if="loading" fixed></Loading>
  </div>
</template>

<script setup>
import store from "@/stores";
import {useRoute, useRouter} from "vue-router";
import { ref } from "vue";

import DarkModeSwitcher from "@/components/Switchers/DarkMode/Index.vue";
import MainColorSwitcher from "@/components/Switchers/Color/Index.vue";

const router = useRouter();
const route = useRoute();
const user = {
  email: "",
  password: "",
  remember: false,
};

let loading = ref(false);
let errorMsg = ref("");

function login() {
  loading.value = true;
  store
    .dispatch("auth/login", user)
    .then(() => {
      loading.value = false;
      //console.log(route.redirectedFrom)
      if (!route.redirectedFrom || route.redirectedFrom.fullPath == '/') {
            router.push({
              name: "Dashboard",
          });
      } else {
          router.push({
              name: route.redirectedFrom.name
          });
      }
    })
    .catch((err) => {
      //console.log(err)
      loading.value = false;
      errorMsg.value = "The provided credentials are not correct.";
    });
}
</script>
