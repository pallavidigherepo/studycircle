<template>
    <div>
        <!-- BEGIN: Slide Over Content -->
        <Modal
            size="modal-lg"
            backdrop="static"
            :slideOver="true"
            :show="headerFooterSlideOverPreview"
            @hidden="headerFooterSlideOverPreview = false"
        >
            <a
                @click="headerFooterSlideOverPreview = false"
                class="absolute top-0 left-0 right-auto mt-4 -ml-12"
                href="javascript:;"
            >
                <XIcon class="w-8 h-8 text-slate-400" />
            </a>
            <!-- BEGIN: Slide Over Header -->
            <ModalHeader class="p-5">
                <h2 class="font-medium text-base mr-auto">{{ t("inquiries.Add Followup") }}</h2>

            </ModalHeader>
            <!-- END: Slide Over Header -->
            <!-- BEGIN: Slide Over Body -->
            <form @submit.prevent="submitFollowupForm">
                <ModalBody>

                    <div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">{{ t("inquiries.Follow Up Type") }}</div>
                                        <div
                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                            {{ t("common.Required") }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                <TomSelect id="form-followup-type"
                                           v-model="followupModel.followup_type_id"
                                           :class="{ 'border-danger': followUpSubmitted && f$.followup_type_id.$errors.length, }"
                                           :options="{
                                                    allowEmptyOption: false,
                                                    create: false,
                                                    placeholder: 'Select Follow up Type',
                                                    autocomplete: 'off',

                                                  }"
                                           :placeholder="'Select Assignee'"
                                           class="w-full">
                                    <option>{{ t('inquiries.Select Follow up Type') }}</option>
                                    <option v-for="(type, index) in followupTypes" :key="index" :value="index">
                                        {{ type }}
                                    </option>
                                </TomSelect>

                                <div v-for="(error, index) of f$.followup_type_id.$errors" :key="index"
                                     class="text-danger mt-2">
                                    <div class="error-msg">{{ error.$message }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">{{ t("inquiries.Date to follow up") }}
                                        </div>
                                        <div
                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                            {{ t("common.Required") }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                <div class="relative w-56">
                                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                        <CalendarIcon class="w-4 h-4" />
                                    </div>
                                    <input v-model="followupModel.followup_date"
                                           :class="{ 'border-danger': followUpSubmitted && f$.followup_date.$errors.length, }"
                                           type="date"
                                           class="form-control pl-12" />
                                </div>
                                <div v-for="(error, index) of f$.followup_date.$errors" :key="index"
                                     class="text-danger mt-2">
                                    <div class="error-msg">{{ error.$message }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">{{ t("inquiries.Time to Follow Up") }}</div>
                                        <div
                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                            {{ t("common.Required") }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                <div class="relative w-56">
                                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                        <CalendarIcon class="w-4 h-4" />
                                    </div>
                                    <input v-model="followupModel.followup_time"
                                           :class="{ 'border-danger': followUpSubmitted && f$.followup_time.$errors.length, }"
                                           type="time"
                                           class="form-control pl-12" />
                                </div>
                                <div v-for="(error, index) of f$.followup_time.$errors" :key="index"
                                     class="text-danger mt-2">
                                    <div class="error-msg">{{ error.$message }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">{{ t("inquiries.Comment") }}</div>

                                    </div>

                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                    <textarea
                                        id="form-comment"
                                        class="form-control"
                                        placeholder="Enter comment/note of followup"
                                        v-model.trim="followupModel.comment"
                                        :class="{ 'border-danger': followUpSubmitted && f$.comment.$errors.length, }"
                                    ></textarea>
                                <div v-for="(error, index) of f$.comment.$errors" :key="index"
                                     class="text-danger mt-2">
                                    <div class="error-msg">{{ error.$message }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </ModalBody>
                <!-- END: Slide Over Body -->
                <!-- BEGIN: Slide Over Footer -->
                <ModalFooter class="w-full absolute bottom-0">
                    <button
                        type="button"
                        @click="headerFooterSlideOverPreview = false"
                        class="btn btn-outline-secondary w-20 mr-1"
                    >
                        {{ t("common.Cancel") }}
                    </button>
                    <button type="submit" class="btn btn-primary w-20">{{ t("common.Save") }}</button>
                </ModalFooter>
            </form>
            <!-- END: Slide Over Footer -->
        </Modal>
        <!-- END: Slide Over Content -->
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import {useRoute, useRouter} from "vue-router";
import {useI18n} from "vue-i18n";
import {email, helpers, minLength, maxLength, numeric, required} from "@vuelidate/validators";
import {useVuelidate} from "@vuelidate/core";
import store from "@/stores";
import axiosClient from "@/axios";

import CreateFollowUp from './CreateFollowup.vue';

const { t } = useI18n();
const route = useRoute();
const router = useRouter();

const followUpSubmitted = ref(false);
const followupModel = ref({
    followup_type_id: '',
    followup_date: '',
    followup_time: '',
    comment: '',
});
const followupRules = computed(() => {
    return{
        followup_type_id: {
            required: helpers.withMessage("Please select follow up type.", required),
        },
        followup_date: {
            required: helpers.withMessage("Please enter follow up date.", required),
        },
        followup_time: {
            required: helpers.withMessage("Please enter follow up time.", required),
        },
        comment: {
            required: helpers.withMessage("Please enter comment.", required),
        }
    }

});
const f$ = useVuelidate(followupRules, followupModel);


async function submitFollowupForm()
{
    followUpSubmitted.value = true;
    f$.value.$validate(); // checks all inputs
    if (!f$.value.$error) {
        isLoading.value = true;
        await store
            .dispatch("inquiry_followups/save", followupModel.value)
            .then(() => {
                isLoading.value = false;
                followUpSubmitted.value = false;
                isErrored.value = false;
                router.push({name: "Inquiries"});
            })
            .catch((err) => {
                isLoading.value = false;
                followUpSubmitted.value = false;
                isErrored.value = true;
                if (err.response && err.response.data) {
                    message.value = err.response.data.message;
                }
            });
    } else {
        // if ANY fail validation
        return;
    }
}

</script>

<style scoped>

</style>
