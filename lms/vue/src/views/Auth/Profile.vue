<template>
    <div>
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">My Profile</h2>
        </div>
        <TabGroup>
            <!-- BEGIN: Profile Info -->
            <div class="intro-y box px-5 pt-5 mt-5">
                <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
                    <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                            <img :alt="user.name" class="rounded-full"
                                :src="`https://eu.ui-avatars.com/api/?size=225&name=` + user.name" />
                        </div>
                        <div class="ml-5">
                            <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">
                                {{ user.name }}
                            </div>
                            <div class="text-slate-500">{{ user.designation }}</div>
                        </div>
                    </div>
                    <div
                        class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                        <div class="font-medium text-center lg:text-left lg:mt-3">
                            Contact Details
                        </div>
                        <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                            <div class="truncate sm:whitespace-normal flex items-center">
                                <MailIcon class="w-4 h-4 mr-2" />
                                {{ user.email }}
                            </div>
                            <!-- <div class="truncate sm:whitespace-normal flex items-center mt-3">
                                <InstagramIcon class="w-4 h-4 mr-2" /> Instagram
                                {{ user.name }}
                            </div>
                            <div class="truncate sm:whitespace-normal flex items-center mt-3">
                                <TwitterIcon class="w-4 h-4 mr-2" /> Twitter
                                {{ user.name }}
                            </div> -->
                        </div>
                    </div>
                    <div
                        class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-slate-200/60 dark:border-darkmode-400 pt-5 lg:pt-0">
                        <div class="text-center rounded-md w-20 py-3">
                            <div class="font-medium text-primary text-xl">201</div>
                            <div class="text-slate-500">Orders</div>
                        </div>
                        <div class="text-center rounded-md w-20 py-3">
                            <div class="font-medium text-primary text-xl">1k</div>
                            <div class="text-slate-500">Purchases</div>
                        </div>
                        <div class="text-center rounded-md w-20 py-3">
                            <div class="font-medium text-primary text-xl">492</div>
                            <div class="text-slate-500">Reviews</div>
                        </div>
                    </div>
                </div>
                <TabList class="nav-link-tabs flex-col sm:flex-row justify-center lg:justify-start text-center">
                    <Tab :fullWidth="false" class="py-4 flex items-center cursor-pointer">
                        <UserIcon class="w-4 h-4 mr-2" /> {{ t("auth.Profile") }}
                    </Tab>
                    <Tab :fullWidth="false" class="py-4 flex items-center cursor-pointer">
                        <ShieldIcon class="w-4 h-4 mr-2" /> {{ t("auth.Account") }}
                    </Tab>
                    <Tab :fullWidth="false" class="py-4 flex items-center cursor-pointer">
                        <LockIcon class="w-4 h-4 mr-2" /> {{ t("auth.Change Password") }}
                    </Tab>
                    <Tab :fullWidth="false" class="py-4 flex items-center cursor-pointer">
                        <SettingsIcon class="w-4 h-4 mr-2" /> {{ t("auth.Settings") }}
                    </Tab>
                </TabList>
            </div>
            <!-- END: Profile Info -->
            <TabPanels class="mt-5">
                <TabPanel>
                    <div class="grid grid-cols-12 gap-6">
                        <!-- BEGIN: Latest Uploads -->
                        <div class="intro-y box col-span-12 lg:col-span-6">
                            <div
                                class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                                <h2 class="font-medium text-base mr-auto">{{ t("auth.Latest Courses") }}</h2>

                            </div>
                            <div class="p-5">
                                <div class="overflow-x-auto">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="whitespace-nowrap">#</th>
                                                <th class="whitespace-nowrap">{{ t("courses.Name") }}</th>
                                                <th class="whitespace-nowrap">{{ t("courses.Code") }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(course, index) in profileCourses" :key="course.id">
                                                <td>{{ index + 1 }}</td>
                                                <td>{{ course.name }}</td>
                                                <td>{{ course.course_code }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!-- END: Latest Uploads -->
                        <!-- BEGIN: Work In Progress -->
                        <TabGroup class="intro-y box col-span-12 lg:col-span-6">
                            <div
                                class="mt-5 flex items-center px-5 py-5 sm:py-0 border-b border-slate-200/60 dark:border-darkmode-400">
                                <h2 class="font-medium text-base mr-auto">{{ t("auth.") }}</h2>

                            </div>
                            <div class="p-5">

                            </div>
                        </TabGroup>
                        <!-- END: Work In Progress -->

                        <!-- BEGIN: Subject -->
                        <div class="intro-y box col-span-12">
                            <div
                                class="flex items-center px-5 py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                                <h2 class="font-medium text-base mr-auto">{{ t("subjects.Subjects")}}</h2>

                            </div>
                            <div id="subjects" class="py-5">
                                <div class="overflow-x-auto">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="whitespace-nowrap">#</th>
                                                <th class="whitespace-nowrap">{{ t("subjects.Label") }}</th>
                                                <th class="whitespace-nowrap">{{ t("subjects.Icon") }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(subject, index) in profileSubjects" :key="subject.id">
                                                <td>{{ index + 1 }}</td>
                                                <td>{{ JSON.parse(subject.label) }}</td>
                                                <td>{{ subject.icon }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END: Subjects -->
                        <!-- BEGIN: New Authors -->
                        <div class="intro-y box col-span-12">
                            <div
                                class="flex items-center px-5 py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                                <h2 class="font-medium text-base mr-auto">{{ t("questions.Questions") }}</h2>

                            </div>

                            <div id="subjects" class="py-5">
                                <div class="overflow-x-auto">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="whitespace-nowrap">#</th>
                                                <th class="whitespace-nowrap">{{ t("questions.Question") }}</th>
                                                <th class="whitespace-nowrap">{{ t("questions.Board") }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(question, index) in profileQuestions" :key="question.id">
                                                <td>{{ index + 1 }}</td>
                                                <td>{{ question.question }}</td>
                                                <td>{{ question.board_id }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END: New Authors -->
                    </div>
                </TabPanel>
                <TabPanel>
                    <div class="grid grid-cols-12 gap-6">
                        <!-- BEGIN: Latest Uploads -->
                        <div class="intro-y box col-span-12 lg:col-span-12">
                            <div
                                class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                                <h2 class="font-medium text-base mr-auto">{{ t("auth.Account Information") }}</h2>

                            </div>
                            <form @submit.prevent="submitAccount">
                                <div class="p-5">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700"> Photo </label>
                                        <div class="mt-1 flex items-center">
                                            <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                            <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                            </span>
                                            <button type="button" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Change</button>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="avatar" class="form-label">{{ t("auth.Avatar")
                                        }}</label>
                                        <input id="avatar"
                                                type="file"
                                                class="form-control"
                                                placeholder="Avatar"
                                             />
                                        <!-- <div class="text-danger mt-2" v-for="(error, index) of v$.alt_email.$errors"
                                            :key="index">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div> -->
                                    </div>
                                    <div class="mt-3">
                                        <label for="alt-email" class="form-label">{{ t("auth.Alternate Email")
                                        }}</label>
                                        <input id="alt-email" type="email" class="form-control"
                                            placeholder="Enter Alternate Email" v-model.trim="modelAccount.alt_email"
                                            :class="{
                                                'border-danger': submitted && v$.alt_email.$errors.length,
                                            }" />
                                        <div class="text-danger mt-2" v-for="(error, index) of v$.alt_email.$errors"
                                            :key="index">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label for="mobile" class="form-label">{{ t("auth.Mobile Number") }}</label>
                                        <input id="mobile" type="text" class="form-control"
                                            placeholder="Enter Mobile Number" v-model.trim="modelAccount.mobile" :class="{
                                                'border-danger': submitted && v$.mobile.$errors.length,
                                            }" />
                                        <div class="text-danger mt-2" v-for="(error, index) of v$.mobile.$errors"
                                            :key="index">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label for="alt-mobile" class="form-label">{{ t("auth.Alternate Mobile Number")}}</label>
                                        <input id="alt-mobile" type="text" class="form-control"
                                            placeholder="Enter Alternate Mobile No"
                                            v-model.trim="modelAccount.alt_mobile" :class="{
                                                'border-danger': submitted && v$.alt_mobile.$errors.length,
                                            }" />
                                        <div class="text-danger mt-2" v-for="(error, index) of v$.alt_mobile.$errors"
                                            :key="index">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <label for="address" class="form-label">{{ t("auth.Address") }}</label>
                                        <textarea id="address" class="form-control" placeholder="Enter Address"
                                            v-model.trim="modelAccount.address" :class="{
                                                'border-danger': submitted && v$.address.$errors.length,
                                            }"></textarea>

                                        <div class="text-danger mt-2" v-for="(error, index) of v$.address.$errors"
                                            :key="index">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label for="alt-address" class="form-label">{{ t("auth.Alternate Address")}}</label>
                                        <textarea id="alt-address" class="form-control"
                                            placeholder="Enter Alternate Address"
                                            v-model.trim="modelAccount.alt_address" :class="{
                                                'border-danger': submitted && v$.alt_address.$errors.length,
                                            }"></textarea>

                                        <div class="text-danger mt-2" v-for="(error, index) of v$.alt_address.$errors"
                                            :key="index">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label for="gender" class="form-label">{{ t("auth.Gender") }}</label>
                                        <TomSelect id="gender" v-model="modelAccount.gender" placeholder="Select Gender"
                                            :options="{
                                                allowEmptyOption: false,
                                                create: false,
                                                placeholder: 'Select Gender',
                                                autocomplete: 'off',
                                                items: modelAccount.gender,
                                            }" class="w-full" :class="{
    'border-danger': submitted && v$.gender.$errors.length,
}">
                                            <option value="">{{ t('common.Select Gender') }}</option>
                                            <option value="male">{{ t('common.Male') }}</option>
                                            <option value="female">{{ t('common.Female') }}</option>
                                            <option value="other">{{ t('common.Other') }}</option>
                                        </TomSelect>

                                        <div class="text-danger mt-2" v-for="(error, index) of v$.gender.$errors"
                                            :key="index">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label for="qualification" class="form-label">{{
                                                t("auth.Qualification")
                                        }}</label>
                                        <input id="qualification" type="text" v-model="modelAccount.qualification"
                                            placeholder="Enter your qualification" class="form-control w-full" :class="{
                                                'border-danger': submitted && v$.qualification.$errors.length,
                                            }" />

                                        <div class="text-danger mt-2" v-for="(error, index) of v$.qualification.$errors"
                                            :key="index">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label for="designation" class="form-label">{{ t("auth.Designation") }}</label>
                                        <input id="designation" type="text" v-model="modelAccount.designation"
                                            placeholder="Enter your designation" class="form-control w-full" :class="{
                                                'border-danger': submitted && v$.designation.$errors.length,
                                            }" />

                                        <div class="text-danger mt-2" v-for="(error, index) of v$.designation.$errors"
                                            :key="index">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                                    </div>
                                    <div class="text-right mt-5 p-5">
                                        <button type="button" class="btn btn-outline-secondary w-24 mr-1"
                                            @click.prevent="cancel">
                                            {{ t("common.Cancel") }}
                                        </button>
                                        <button type="submit" class="btn btn-primary w-24">
                                            {{ t("common.Save") }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- END: Latest Uploads -->

                    </div>
                </TabPanel>
                <TabPanel>
                    <div class="grid grid-cols-12 gap-6">

                        <!-- BEGIN: Latest Uploads -->
                        <div class="intro-y box col-span-12 lg:col-span-12">
                            <div
                                class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                                <h2 class="font-medium text-base mr-auto">{{ t("auth.Change Password") }}</h2>

                            </div>
                            <form @submit.prevent="submitPasswordForm">
                                <div class="p-5">
                                    <div>
                                        <label for="password" class="form-label">{{ t("auth.Password") }}</label>
                                        <input id="password" type="password" class="form-control"
                                            placeholder="Enter Password" v-model.trim="modelPassword.password" :class="{
                                                'border-danger': submitted && vP$.password.$errors.length,
                                            }" />
                                        <div class="text-danger mt-2" v-for="(error, index) of vP$.password.$errors"
                                            :key="index">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label for="confirm-password" class="form-label">
                                            {{ t("auth.Confirm Password")}}
                                        </label>
                                        <input id="confirm-password" type="password" class="form-control"
                                            placeholder="Confirm Password" v-model.trim="modelPassword.confirm_password"
                                            :class="{
                                                'border-danger': submitted && vP$.confirm_password.$errors.length,
                                            }" />
                                        <div class="text-danger mt-2"
                                            v-for="(error, index) of vP$.confirm_password.$errors" :key="index">
                                            <div class="error-msg">{{ error.$message }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right mt-5 p-5">
                                    <button type="button" class="btn btn-outline-secondary w-24 mr-1"
                                        @click.prevent="cancel">
                                        {{ t("common.Cancel") }}
                                    </button>
                                    <button type="submit" class="btn btn-primary w-24">
                                        {{ t("common.Save") }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- END: Latest Uploads -->

                    </div>
                </TabPanel>

                <TabPanel>
                    <div class="grid grid-cols-12 gap-6">
                        <!-- BEGIN: Latest Uploads -->
                        <div class="intro-y box col-span-12 lg:col-span-12">
                            <div
                                class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                                <h2 class="font-medium text-base mr-auto">Settings</h2>

                            </div>
                            <div class="p-5">

                            </div>
                        </div>
                        <!-- END: Latest Uploads -->

                    </div>
                </TabPanel>
            </TabPanels>
        </TabGroup>
    </div>

</template>

<script setup>
import { ref, provide, computed, onMounted, reactive } from "vue";

import { useVuelidate } from "@vuelidate/core";
import { required, helpers, sameAs, minLength, email, numeric } from "@vuelidate/validators";

import store from "@/stores";

import { useI18n } from "vue-i18n";
import axiosClient from "@/axios";
const { t } = useI18n();

const user = computed(() => JSON.parse(sessionStorage.getItem("USER")));

const profileCourses = ref();
const profileSubjects = ref();
const profileQuestions = ref();

const modelAccount = ref({
    id: '',
    alt_email: '',
    mobile: '',
    alt_mobile: '',
    address: '',
    alt_address: '',
    gender: '',
    qualification: '',
    avatar: '',
    designation: '',
});

const modelPassword = reactive({
    id: '',
    password: '',
    confirm_password: '',
    isChangePassword: true,
});

const submitted = ref(false);
const rules = computed(() => {
    return {
        password: {
            required: helpers.withMessage("Please enter password.", required),
            minLength: helpers.withMessage("Enter password of minimum length 9.", minLength(9)),
        },
        confirm_password: {
            required: helpers.withMessage("Please enter confirm password.", required),
            sameAs: helpers.withMessage("Password and confirm password does not match.", sameAs(modelPassword.password))
        },
    };
});


const vP$ = useVuelidate(rules, modelPassword);

const accountRules = computed(() => {
    return {
        alt_email: {
            //required: helpers.withMessage("Please enter email address.", required),
            email: helpers.withMessage("Enter valid email address.", email),
        },
        mobile: {
            required: helpers.withMessage("Please enter mobile number.", required),
            numeric: helpers.withMessage("Enter valid mobile number.", numeric),
            minLength: helpers.withMessage("Enter valid mobile number with minimum length of 10 digits.", minLength(10)),
        },
        alt_mobile: {
            //required: helpers.withMessage("Please enter mobile number.", required),
            numeric: helpers.withMessage("Enter valid mobile number.", numeric),
            minLength: helpers.withMessage("Enter valid mobile number with minimum length of 10 digits.", minLength(10)),
        },
        address: {
            //required: helpers.withMessage("Please enter your address.", required),
        },
        alt_address: {
            //required: helpers.withMessage("Please enter alternate address.", required),
        },
        gender: {
            //required: helpers.withMessage("Please select your gender.", required),
        },
        qualification: {
            //required: helpers.withMessage("Please enter your qualification.", required),
        },
        designation: {
            //required: helpers.withMessage("Please enter your designation.", required),
        },
    };
});
const v$ = useVuelidate(accountRules, modelAccount);

const newProductsRef = ref();
const newAuthorsRef = ref();
const isLoading = ref(false);

async function submitPasswordForm() {
    submitted.value = true;
    vP$.value.$validate(); // checks all inputs

    if (!vP$.value.$error) {

        isLoading.value = true;
        await store
            .dispatch("auth/save", modelPassword)
            .then(() => {
                isLoading.value = false;
                submitted.value = false;
                //router.push({ name: "Chapters" });
            })
            .catch((err) => {
                isLoading.value = false;
                isErrored.value = true;
                //if (err.response) {
                message.value = err.response.data.message;
                //}

            });
    } else {
        // if ANY fail validation
        return;
    }
}



async function submitAccount() {
    submitted.value = true;
    v$.value.$validate(); // checks all inputs

    if (!v$.value.$error) {

        isLoading.value = true;
        await store
            .dispatch("auth/save", modelAccount.value)
            .then(() => {
                isLoading.value = false;
                submitted.value = false;
                //router.push({ name: "Chapters" });
            })
            .catch((err) => {
                isLoading.value = false;
                isErrored.value = true;
                //if (err.response) {
                message.value = err.response.data.message;
                //}

            });
    } else {
        // if ANY fail validation
        return;
    }
}

onMounted(() => {
    fetch();
    //store.dispatch("auth/profile");
});

const fetch = async () => {
    const result = await axiosClient.get('/profile');
    if (result.status !== 200) {
        const error = new Error('Failed to fetch profile information.')
        throw error;
    }
    modelAccount.value = JSON.parse(JSON.stringify(result.data));
    modelPassword.id = JSON.parse(JSON.stringify(result.data.id));
    profileCourses.value = result.data.user.courses;
    profileSubjects.value = result.data.user.subjects;
    profileQuestions.value = result.data.user.questions;
}
</script>
