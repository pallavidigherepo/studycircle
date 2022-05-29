<template>
  <div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">{{ t("users.Add User") }}</h2>
      <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <router-link
          to="/users"
          class="
            btn
            box
            text-gray-700
            dark:text-gray-300
            mr-2
            flex
            items-center
            ml-auto
            sm:ml-0
          "
          ><ArrowLeftCircleIcon class="w-4 h-4 mr-2" />Back
        </router-link>
      </div>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
      <div class="intro-y box col-span-12 lg:col-span-12">
        <div class="p-5">
          <div
            class="alert alert-danger show flex items-center mb-2"
            role="alert"
            v-if="isErrored"
          >
            <AlertOctagonIcon class="w-6 h-6 mr-2" />
            {{ message }}
          </div>
          <form @submit.prevent="submitForm" class="validate-form">
            <div>
              <label for="form-name" class="form-label">{{
                t("users.Name")
              }}</label>
              <input
                id="form-name"
                type="text"
                class="form-control"
                placeholder="Enter name of user"
                v-model.trim="user.name"
                :class="{
                  'border-danger': submitted && v$.name.$errors.length,
                }"
              />
              <div
                class="text-danger mt-2"
                v-for="(error, index) of v$.name.$errors"
                :key="index"
              >
                <div class="error-msg">{{ error.$message }}</div>
              </div>
              <!--<span v-if="submitted && v$.name.$error" class="text-theme-21 mt-2">
                                {{ v$.name.$errors[0].$message }}
                            </span>-->
            </div>
            <div class="mt-3">
              <label for="form-email" class="form-label">{{
                t("users.Email")
              }}</label>

              <input
                id="form-email"
                type="text"
                class="form-control"
                placeholder="Enter email"
                v-model.trim="user.email"
                :class="{
                  'border-danger': submitted && v$.email.$errors.length,
                }"
              />
              <div
                class="text-danger mt-2"
                v-for="(error, index) of v$.email.$errors"
                :key="index"
              >
                <div class="error-msg">{{ error.$message }}</div>
              </div>
              <!--<span v-if="submitted && v$.users.$error" class="text-theme-24 mt-2">
                                {{ v$.users.$errors[0].$message }}
                            </span>-->
            </div>
            <div class="mt-3">
              <label for="form-mobile-number" class="form-label">{{
                t("users.Mobile Number")
              }}</label>

              <input
                id="form-mobile-number"
                type="text"
                class="form-control"
                placeholder="Enter mobile number"
                v-model.trim="user.mobile_no"
                :class="{
                  'border-danger': submitted && v$.mobile_no.$errors.length,
                }"
              />
              <div
                class="text-danger mt-2"
                v-for="(error, index) of v$.mobile_no.$errors"
                :key="index"
              >
                <div class="error-msg">{{ error.$message }}</div>
              </div>
              <!--<span v-if="submitted && v$.users.$error" class="text-theme-24 mt-2">
                                {{ v$.users.$errors[0].$message }}
                            </span>-->
            </div>
            <div class="mt-3">
              <label for="form-role" class="form-label"
                >{{ t("users.Designation") }}
              </label>
              <div class="mt-2">
                <TomSelect
                  v-model="user.designation"
                  :options="{
                    placeholder: 'Select role',
                    allowEmptyOption: false,
                  }"
                  class="w-full"
                  :class="{
                    'border-danger': submitted && v$.designation.$errors.length,
                  }"
                >
                  <option value="">Select Role</option>
                  <option
                    :value="role.id"
                    v-for="(role, index) in roles"
                    :key="index"
                  >
                    {{ role }}
                  </option>
                </TomSelect>
              </div>
              <div
                class="text-danger mt-2"
                v-for="(error, index) of v$.designation.$errors"
                :key="index"
              >
                <div class="error-msg">{{ error.$message }}</div>
              </div>
              <!--<span v-if="submitted && v$.users.$error" class="text-theme-24 mt-2">
                                {{ v$.users.$errors[0].$message }}
                            </span>-->
            </div>
            <!-- BEGIN: Slide Over Footer -->

            <div class="text-right w-full bottom-0 mt-5">
              <router-link
                to="/users"
                class="btn btn-outline-secondary w-20 mr-1"
              >
                {{ t("users.Cancel") }}
              </router-link>
              <button type="submit" class="btn btn-primary w-20">
                {{ t("users.Save") }}
              </button>
            </div>
            <!-- END: Slide Over Footer -->
          </form>
        </div>
        <!-- BEGIN: Post Content -->
      </div>
      <!-- END: Post Content -->
    </div>
  </div>
</template>

<script setup>
import store from "@/stores";
import { ref, reactive, computed, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";

import { useVuelidate } from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators";
import { useI18n } from "vue-i18n";
import axiosClient from "@/axios";

const submitted = ref(false);

const isErrored = ref(false);
const message = ref("");
const isLoading = ref(false);

const route = useRoute();
const router = useRouter();
// Now we must get editing details for the selected item
const { t } = useI18n();
const user = reactive({
  id: null,
  name: "",
  email: "",
  mobile_no: "",
  designation: [],
});

const rules = computed(() => {
  return {
    name: {
      required: helpers.withMessage("Please enter name of user.", required),
    },
    email: {
      required: helpers.withMessage("Please enter email address.", required),

      // async isUnique (value) {
      //     if (value === '') return true
      //     return await axiosClient.get(`/users/is_email_exists/${value}/${user.id}`).then(({data}) => {
      //       if (data.message) {
      //         console.log(data)
      //         return data.message;
      //       } else {
      //         return true;
      //       }
      //     });

      //   }
    },
    mobile_no: {
      required: helpers.withMessage("Please enter mobile number.", required),
    },
    designation: {
      required: helpers.withMessage("Please select role of user.", required),
    },
  };
});

const v$ = useVuelidate(rules, user);

async function submitForm() {
  submitted.value = true;
  v$.value.$validate(); // checks all inputs

  if (!v$.value.$error) {
    isLoading.value = true;
    await store
      .dispatch("users/create", user)
      .then(() => {
        isLoading.value = false;
        submitted.value = false;
        router.push({ name: "Users" });
      })
      .catch((err) => {
        isLoading.value = false;
        isErrored.value = true;
        if (err.response.data) {
            message.value = err.response.data.message;
        }
      });
  } else {
    // if ANY fail validation
    return;
  }
}

onMounted(() => {
  store.dispatch("users/role_list");
});

const roles = computed(() => store.getters["users/roleList"]);
</script>

<style scoped>
</style>