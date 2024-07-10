<script setup lang="ts">
import ThemeSwitcher from "@/components/ThemeSwitcher";
import logoUrl from "@/assets/images/logo.svg";
import illustrationUrl from "@/assets/images/illustration.svg";
import { FormInput, FormCheck } from "@/components/Base/Form";
import Button from "@/components/Base/Button";
import LoadingIcon from "@/components/Base/LoadingIcon";
import { reactive, ref, computed } from "vue";

import { useVuelidate } from '@vuelidate/core'
import { required, email, helpers } from '@vuelidate/validators'
import store from "@/stores/index.js";
import { useRouter, useRoute } from "vue-router";

interface ForgotPasswordPayload {
    email: string,
}

const model = reactive({
    email: '',
});
const rules = computed(() => {
    return {
        email: {
            required: helpers.withMessage("Please enter email address", required),
            email: helpers.withMessage("Please enter valid email address", email),
        },
    }
});

const v$ = useVuelidate(rules, model);

const errorMsg = ref();
const submitted = ref(false);
const loading = ref(false);
const msg = ref('');
function submit(payload: ForgotPasswordPayload)
{
    submitted.value = true;
    v$.value.$validate();
    if (v$.value.$error) {
        return false;
    }
    loading.value = true;
    
    try {
        store.dispatch('auth/forgot_password', payload)
            .then((response) => {
              if (response.success) {
                loading.value = false;
                submitted.value = false;
                msg.value = "We have sent you an email with reset password link. Please check it.";
              } else {
                loading.value = false;
                submitted.value = false;
                msg.value = '';
                errorMsg.value = JSON.stringify(response.errors);
              }
              return response.success;
            })
            .catch(() => {
                // loading.value = false;
                errorMsg.value = "Provided email address does not exists.";
            });

        //
        // console.log(response);
    } catch (e) {
        console.log(e);
    }

    return ;
}
</script>

<template>
  <div
    :class="[
      'p-3 sm:px-8 relative h-screen lg:overflow-hidden bg-primary xl:bg-white dark:bg-darkmode-800 xl:dark:bg-darkmode-600',
      'before:hidden before:xl:block before:content-[\'\'] before:w-[57%] before:-mt-[28%] before:-mb-[16%] before:-ml-[13%] before:absolute before:inset-y-0 before:left-0 before:transform before:rotate-[-4.5deg] before:bg-primary/20 before:rounded-[100%] before:dark:bg-darkmode-400',
      'after:hidden after:xl:block after:content-[\'\'] after:w-[57%] after:-mt-[20%] after:-mb-[13%] after:-ml-[13%] after:absolute after:inset-y-0 after:left-0 after:transform after:rotate-[-4.5deg] after:bg-primary after:rounded-[100%] after:dark:bg-darkmode-700',
    ]"
  >
    <ThemeSwitcher />
    <div class="container relative z-10 sm:px-10">
      <div class="block grid-cols-2 gap-4 xl:grid">
        <!-- BEGIN: Login Info -->
        <div class="flex-col hidden min-h-screen xl:flex">
          <a href="" class="flex items-center pt-5 -intro-x">
            <img
              alt="Midone Tailwind HTML Admin Template"
              class="w-6"
              :src="logoUrl"
            />
            <span class="ml-3 text-lg text-white"> Midone </span>
          </a>
          <div class="my-auto">
            <img
              alt="Midone Tailwind HTML Admin Template"
              class="w-1/2 -mt-16 -intro-x"
              :src="illustrationUrl"
            />
            <div
              class="mt-10 text-4xl font-medium leading-tight text-white -intro-x"
            >
              A few more clicks to <br />
              sign in to your account.
            </div>
            <div
              class="mt-5 text-lg text-white -intro-x text-opacity-70 dark:text-slate-400"
            >
              Manage all your e-commerce accounts in one place
            </div>
          </div>
        </div>
        <!-- END: Login Info -->
        <!-- BEGIN: Login Form -->
        <div class="flex h-screen py-5 my-10 xl:h-auto xl:py-0 xl:my-0">
          <div
            class="w-full px-5 py-8 mx-auto my-auto bg-white rounded-md shadow-md xl:ml-20 dark:bg-darkmode-600 xl:bg-transparent sm:px-8 xl:p-0 xl:shadow-none sm:w-3/4 lg:w-2/4 xl:w-auto"
          >
            <h2
              class="text-2xl font-bold text-center intro-x xl:text-3xl xl:text-left"
            >
              Forgot Password
            </h2>
            <div class="mt-2 text-center intro-x text-slate-400 xl:hidden">
              A few more clicks to sign in to your account. Manage all your
              e-commerce accounts in one place
            </div>
            <form @submit.prevent="submit(model)">
            <div class="mt-8 intro-x">
              <FormInput
                type="text"
                class="block px-4 py-3 intro-x login__input min-w-full xl:min-w-[350px]"
                placeholder="Email"
                v-model="model.email"
                :class="{
                    'border-danger': submitted && v$.email.$errors.length,
                }"
              />
              <div class="text-danger mt-2" v-for="(error, index) of v$.email.$errors"
                    :key="index">
                    <div class="error-msg">{{ error.$message }}</div>
                </div>
            </div>
            <div class="mt-5 text-center intro-x xl:mt-8 xl:text-left">
              <Button
                variant="primary"
                class="w-full px-4 py-3 align-top xl:w-32 xl:mr-3"
                type="submit"
              >
                Submit
                <LoadingIcon
                    icon="spinning-circles"
                    color="white"
                    class="w-4 h-4 ml-2"
                    v-if="submitted"
                  />
              </Button>
              <Button
                variant="outline-secondary"
                class="w-full px-4 py-3 mt-3 align-top xl:w-32 xl:mt-0"
                @click="$router.push('/login')"
              >
                Login
              </Button>
            </div>
            </form>
            <div
              class="mt-10 text-center intro-x xl:mt-24 text-slate-600 dark:text-slate-500 xl:text-left"
            >
              By signin up, you agree to our
              <a class="text-primary dark:text-slate-200" href="">
                Terms and Conditions
              </a>
              &
              <a class="text-primary dark:text-slate-200" href="">
                Privacy Policy
              </a>
            </div>
          </div>
        </div>
        <!-- END: Login Form -->
      </div>
    </div>
  </div>
</template>
