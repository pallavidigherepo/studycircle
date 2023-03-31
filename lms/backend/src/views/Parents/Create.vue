<template>
    <div>
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">{{ t("clients.Add Client") }}</h2>
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                <router-link
                    to="/clients"
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
                >
                    <ArrowLeftCircleIcon class="w-4 h-4 mr-2"/>
                    {{ t("common.Back") }}
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
                        <AlertOctagonIcon class="w-6 h-6 mr-2"/>
                        {{ message }}
                    </div>
                    <form @submit.prevent="submitForm" class="validate-form">
                        <div>
                            <label for="form-name" class="form-label">{{
                                    t("clients.Name")
                                }}</label>
                            <input
                                id="form-name"
                                type="text"
                                class="form-control"
                                placeholder="Enter name of client"
                                v-model.trim="model.client_name"
                                :class="{
                  'border-danger': submitted && v$.client_name.$errors.length,
                }"
                            />
                            <div
                                class="text-danger mt-2"
                                v-for="(error, index) of v$.client_name.$errors"
                                :key="index"
                            >
                                <div class="error-msg">{{ error.$message }}</div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="form-email" class="form-label">{{
                                    t("clients.Email")
                                }}</label>

                            <input
                                id="form-email"
                                type="text"
                                class="form-control"
                                placeholder="Enter email"
                                v-model.trim="model.client_email"
                                :class="{
                  'border-danger': submitted && v$.client_email.$errors.length,
                }"
                            />
                            <div
                                class="text-danger mt-2"
                                v-for="(error, index) of v$.client_email.$errors"
                                :key="index"
                            >
                                <div class="error-msg">{{ error.$message }}</div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="form-mobile-number" class="form-label">{{
                                    t("clients.Mobile Number")
                                }}</label>

                            <input
                                id="form-mobile-number"
                                type="text"
                                class="form-control"
                                placeholder="Enter mobile number"
                                v-model.trim="model.client_phone_number"
                                :class="{
                  'border-danger': submitted && v$.client_phone_number.$errors.length,
                }"
                            />
                            <div
                                class="text-danger mt-2"
                                v-for="(error, index) of v$.client_phone_number.$errors"
                                :key="index"
                            >
                                <div class="error-msg">{{ error.$message }}</div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="form-alt-mobile-number" class="form-label">{{
                                    t("clients.Alternate Mobile Number")
                                }}</label>

                            <input
                                id="form-alt-mobile-number"
                                type="text"
                                class="form-control"
                                placeholder="Enter alternate mobile number"
                                v-model.trim="model.client_alternate_phone_number"
                                :class="{
                  'border-danger': submitted && v$.client_alternate_phone_number.$errors.length,
                }"
                            />
                            <div
                                class="text-danger mt-2"
                                v-for="(error, index) of v$.client_alternate_phone_number.$errors"
                                :key="index"
                            >
                                <div class="error-msg">{{ error.$message }}</div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="form-address" class="form-label">{{
                                    t("clients.Address")
                                }}</label>

                            <input
                                id="form-address"
                                type="text"
                                class="form-control"
                                placeholder="Enter address"
                                v-model.trim="model.address"
                                :class="{
                  'border-danger': submitted && v$.address.$errors.length,
                }"
                            />
                            <div
                                class="text-danger mt-2"
                                v-for="(error, index) of v$.address.$errors"
                                :key="index"
                            >
                                <div class="error-msg">{{ error.$message }}</div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="form-website_url" class="form-label">{{
                                    t("clients.Website Url")
                                }}</label>

                            <input
                                id="form-website_url"
                                type="text"
                                class="form-control"
                                placeholder="Enter website url"
                                v-model.trim="model.website_url"
                            />
                        </div>
                        <div class="mt-3">
                            <label for="form-website_slogan" class="form-label">{{
                                    t("clients.Website Slogan")
                                }}</label>

                            <input
                                id="form-website_slogan"
                                type="text"
                                class="form-control"
                                placeholder="Enter website slogan"
                                v-model.trim="model.website_slogan"
                            />
                        </div>
                        <div class="mt-3">
                            <label for="form-sub-domain" class="form-label">{{
                                    t("clients.Sub domain")
                                }}</label>

                            <input
                                id="form-sub-domain"
                                type="text"
                                class="form-control"
                                placeholder="Enter address"
                                v-model.trim="model.assigned_subdomain"
                                :class="{
                  'border-danger': submitted && v$.assigned_subdomain.$errors.length,
                }"
                            />
                            <div
                                class="text-danger mt-2"
                                v-for="(error, index) of v$.assigned_subdomain.$errors"
                                :key="index"
                            >
                                <div class="error-msg">{{ error.$message }}</div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label"> {{ t("clients.Avatar") }} </label>
                            <div class="mt-1 flex items-center">
                                <img
                                    v-if="model.avatar"
                                    :src="model.avatar"
                                    :alt="model.client_name"
                                    class="w-64 h-48 object-cover"
                                />
                                <img v-else :alt="model.client_name" class="rounded-full"
                                     :src="`https://eu.ui-avatars.com/api/?size=50&name=` + model.client_name"/>

                                <button
                                    type="button"
                                    class="relative overflow-hidden ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    <input
                                        type="file"
                                        @change="onImageChoose"
                                        accept="image/png, image/jpeg, image/jpg"
                                        class="absolute left-0 top-0 right-0 bottom-0 opacity-0 cursor-pointer rounded-full"
                                    />
                                    {{ t("clients.Upload Avatar") }}
                                </button>

                            </div>
                        </div>
                        <!-- BEGIN: Slide Over Footer -->

                        <div class="text-right w-full bottom-0 mt-5">
                            <router-link
                                to="/clients"
                                class="btn btn-outline-secondary w-20 mr-1"
                            >
                                {{ t("common.Cancel") }}
                            </router-link>
                            <button type="submit" class="btn btn-primary w-20">
                                {{ t("common.Save") }}
                            </button>
                        </div>
                        <!-- END: Slide Over Footer -->
                    </form>
                </div>
                <!-- BEGIN: Post Content -->
            </div>
            <!-- END: Post Content -->
        </div>
        <Loading v-if="isLoading" fixed></Loading>
    </div>
</template>

<script setup>
import store from "@/stores";
import {ref, reactive, computed, onMounted} from "vue";
import {useRoute, useRouter} from "vue-router";

import {useVuelidate} from "@vuelidate/core";
import {required, helpers, email, minLength, numeric} from "@vuelidate/validators";
import {useI18n} from "vue-i18n";
import axiosClient from "@/axios";

const submitted = ref(false);

const isErrored = ref(false);
const message = ref("");
const isLoading = ref(false);

const route = useRoute();
const router = useRouter();
// Now we must get editing details for the selected item
const {t} = useI18n();
const model = reactive({
    id: null,
    client_name: '',
    client_email: '',
    avatar: '',
    address: '',
    website_url: '',
    website_slogan: '',
    client_phone_number: '',
    client_alternate_phone_number: '',
    assigned_subdomain: '',
});

const rules = computed(() => {
    return {
        client_name: {
            required: helpers.withMessage("Please enter name of client.", required),
        },
        client_email: {
            required: helpers.withMessage("Please enter email address.", required),
            email: helpers.withMessage("Please enter valid email address", email),
        },
        client_phone_number: {
            required: helpers.withMessage("Please enter mobile number.", required),
            minLength: helpers.withMessage("Please enter valid mobile number", minLength(10)),
            numeric: helpers.withMessage("Please enter valid mobile number", numeric),
        },
        client_alternate_phone_number: {
            minLength: helpers.withMessage("Please enter valid mobile number", minLength(10)),
            numeric: helpers.withMessage("Please enter valid mobile number", numeric),
        },
        assigned_subdomain: {
            required: helpers.withMessage("Please enter sub-domain name.", required),
        },
        address: {
            required: helpers.withMessage("Please enter address.", required),
        },
    };
});

const v$ = useVuelidate(rules, model);

async function submitForm() {
    submitted.value = true;
    v$.value.$validate(); // checks all inputs
console.log(v$.value)
    if (!v$.value.$error) {
        isLoading.value = true;
        await store
            .dispatch("clients/save", model)
            .then(() => {
                isLoading.value = false;
                submitted.value = false;
                router.push({name: "Clients"});
            })
            .catch((err) => {
                isLoading.value = false;
                isErrored.value = true;
                if (err.response) {
                    message.value = err.response.data.message;
                }
            });
    } else {
        // if ANY fail validation
        return;
    }
}


function onImageChoose(ev) {
    const file = ev.target.files[0];
    const reader = new FileReader();
    reader.onload = () => {
        // The field to send on backend and apply validations
        model.avatar = reader.result;
        ev.target.value = "";
    };
    reader.readAsDataURL(file);
}
</script>

<style scoped>
</style>
