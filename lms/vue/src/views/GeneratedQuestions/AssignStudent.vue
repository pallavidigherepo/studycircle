<template>
    <div>
        <template v-if="!preview">
            <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    {{ t("generated_questions.Assign to Students") }}
                </h2>
                <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                    <router-link to="/generated_questions"
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
                      ">
                        <ArrowLeftCircleIcon class="w-4 h-4 mr-2"/>
                        {{ t("common.Back") }}
                    </router-link>
                </div>
            </div>
            <form class="form-validation" @submit.prevent="submitForm(true)">
                <div class="intro-y grid grid-cols-11 gap-5 mt-5">

                    <!-- BEGIN: Selected template, board and standard -->
                    <div class="col-span-12 lg:col-span-4 2xl:col-span-3">
                        <div class="box p-5 rounded-md">
                            <div
                                class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5"
                            >
                                <div class="font-medium text-base truncate">
                                    {{ t("generated_questions.Question Paper Details") }}
                                </div>

                            </div>
                            <div class="flex items-center">
                                <ClipboardIcon class="w-4 h-4 text-slate-500 mr-2"/>
                                {{ t("common.Name") }}: <span
                                class="underline decoration-dotted ml-1">{{ paperInfo ? paperInfo.name : null }}</span>
                            </div>
                            <div class="flex items-center mt-3">
                                <CalendarIcon class="w-4 h-4 text-slate-500 mr-2"/>
                                {{ t("templates.Board") }}: <span class="ml-2">{{
                                    paperInfo ? paperInfo.board : null
                                }}</span>
                            </div>
                            <div class="flex items-center mt-3">
                                <BookOpenIcon class="w-4 h-4 text-slate-500 mr-2"/>
                                {{ t("templates.Standard") }}: <span class="ml-2">{{
                                    paperInfo ? paperInfo.standard : null
                                }}</span>
                            </div>
                            <div class="flex items-center mt-3">
                                <ColumnsIcon class="w-4 h-4 text-slate-500 mr-2"/>
                                {{ t("templates.Total Marks") }}: <span
                                class="ml-2">{{ paperInfo ? paperInfo.template_info.total_marks : null }}</span>
                            </div>
                            <div class="flex items-center mt-3">
                                <ClockIcon class="w-4 h-4 text-slate-500 mr-2"/>
                                {{ t("templates.Duration") }}: <span class="ml-2">{{
                                    paperInfo ? paperInfo.template_info.duration : null
                                }}</span>
                            </div>

                            <div class="flex items-center mt-3">
                                <PlayIcon class="w-4 h-4 text-slate-500 mr-2"/>
                                {{ t("templates.Active") }}: <span class="ml-2">{{
                                    paperInfo ? paperInfo.template_info.is_active : null
                                }}</span>
                            </div>
                            <div class="flex items-center mt-3">
                                <ServerIcon class="w-4 h-4 text-slate-500 mr-2"/>
                                {{ t("templates.Has Section") }}: <span
                                class="ml-2">{{ paperInfo ? paperInfo.template_info.has_section : null }}</span>
                            </div>
                            <div v-if="!(paperInfo && paperInfo.template_info.has_section)" class="flex items-center mt-3">
                                <SidebarIcon class="w-4 h-4 text-slate-500 mr-2"/>
                                {{ t("templates.Total Questions") }}:<span
                                class="ml-2">{{ paperInfo ? paperInfo.template_info.total_questions : null }}</span>
                            </div>
                            <div v-if="!(paperInfo && paperInfo.template_info.has_section)" class="flex items-center mt-3">
                                <SidebarIcon class="w-4 h-4 text-slate-500 mr-2"/>
                                {{ t("templates.Compulsory Questions") }}: <span
                                class="ml-2">{{ paperInfo ? paperInfo.template_info.compulsory_questions : null }}</span>
                            </div>
                            <div v-if="!(paperInfo && paperInfo.template_info.has_section)" class="flex items-center mt-3">
                                <SidebarIcon class="w-4 h-4 text-slate-500 mr-2"/>
                                {{ t("templates.Question type") }}:<span
                                class="ml-2">{{ paperInfo ? paperInfo.template_info.type_name : null }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-7 2xl:col-span-8">
                        <div class="box p-5 rounded-md">
                            <div
                                class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5"
                            >
                                <div class="font-medium text-base truncate">{{ t("templates.Assign to Students") }}</div>
                            </div>
                            <div class="overflow-auto lg:overflow-visible mt-3">
                                <!-- BEGIN: Subject, Chapter and Topic selection -->
                                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                    <div
                                        class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                        <ChevronDownIcon class="w-4 h-4 mr-2"/>
                                        {{ t("generated_questions.Select Batch and Course of Students") }}
                                    </div>
                                    <div class="mt-5">
                                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{
                                                                t("students.Choose Batch")
                                                            }}
                                                        </div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <TomSelect id="form-level"
                                                           v-model="model.batch_id"
                                                           class="w-full"
                                                           placeholder="Select Batch"
                                                           :class="{ 'border-danger': submitted && v$.batch_id.$errors.length,}"
                                                           :options="{
                                                              allowEmptyOption: false,
                                                              create: false,
                                                              placeholder: 'Select Batch',
                                                              autocomplete: 'off',
                                                              onChange: selectedBatch
                                                            }">
                                                    <option>{{ t('questions.Select Batch') }}</option>
                                                    <option v-for="(batch, indexb) in batches" :key="indexb"
                                                            :value="indexb">
                                                        {{ batch }}
                                                    </option>
                                                </TomSelect>
                                                <div v-for="(error, index) of v$.batch_id.$errors"
                                                     :key="index" class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{
                                                                t("questions.Choose Course")
                                                            }}
                                                        </div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <TomSelect id="form-level"
                                                           v-model="model.course_id"
                                                           class="w-full"
                                                           placeholder="Select Course"
                                                           :class="{ 'border-danger': submitted && v$.course_id.$errors.length,}"
                                                           :options="{
                                                              allowEmptyOption: false,
                                                              create: false,
                                                              placeholder: 'Select Course',
                                                              autocomplete: 'off',
                                                              onChange: selectedCourse,
                                                            }">
                                                    <option>{{ t('questions.Select Course') }}</option>
                                                    <option v-for="(course, indexc) in courses"
                                                            :key="indexc"
                                                            :value="indexc">
                                                        {{ course }}
                                                    </option>
                                                </TomSelect>
                                                <div v-for="(error, index) of v$.course_id.$errors"
                                                     :key="index" class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END: Subject, Chapter and Topic selection -->
                                <div class="intro-y box overflow-hidden mt-5">
                                    <div class="border-b border-slate-200/60 dark:border-darkmode-400 sm:text-left">
                                        <div class="px-1 py-2 sm:px-1 sm:py-2">
                                            <div class="font-bold text-xl">{{ t("students.Students") }}</div>
                                        </div>
                                        <div class="py-2">
                                            <div class="overflow-x-auto">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">
                                                            #
                                                        </th>
                                                        <th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">
                                                            {{ t("students.Name") }}
                                                        </th>
                                                        <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">
                                                            {{ t("common.ACTION") }}
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <template
                                                        v-if="model.students.length > 0">
                                                        <tr v-for="(student, sidx) in model.students"
                                                            :key="sidx">
                                                            <td class="border-b dark:border-darkmode-400">
                                                                {{ student.id }}
                                                            </td>
                                                            <td class="border-b dark:border-darkmode-400">
                                                                {{ student.name }}
                                                            </td>
                                                            <td class="text-center border-b dark:border-darkmode-400 w-32">
                                                                <div
                                                                    class="text-center items-center justify-center">

                                                                    <a class="text-danger items-center"
                                                                       href="javascript:;"
                                                                       @click.prevent="removeStudent(student)">
                                                                        <Trash2Icon class="w-4 h-4 mr-1"/>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </template>
                                                    <template v-else>
                                                        <tr>
                                                            <td colspan="5"
                                                                class="border-b dark:border-darkmode-400">
                                                                {{ t("students.No Students") }}.
                                                            </td>
                                                        </tr>
                                                    </template>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Selected template, board and standard -->

                </div>
                <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                    <router-link
                        class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52"
                        to="/generated_question_papers">
                        {{ t("common.Cancel") }}
                    </router-link>

                    <button class="btn py-3 btn-primary w-full md:w-52" type="submit" @click="isOnline = true">
                        {{ t("generated_questions.Assign") }}
                    </button>
                </div>
            </form>
            <!-- BEGIN: Modal Content -->
            <Modal :show="warningModalPreview" @hidden="warningModalPreview = false">
                <ModalBody class="p-0">
                    <div class="p-5 text-center">
                        <XCircleIcon class="w-16 h-16 text-warning mx-auto mt-3"/>
                        <div class="text-3xl mt-5">Oops...</div>
                        <div class="text-slate-500 mt-2">
                            {{ warningMessage }}
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" @click="warningModalPreview = false" class="btn w-24 btn-primary">
                            Ok
                        </button>
                    </div>
                </ModalBody>
            </Modal>
            <!-- END: Modal Content -->
        </template>
        <template v-else>
            <Preview :data="model"
                     :preview="preview"
                     :userInfo="userInfo"
                     :template="template"
                     :isOnline="isOnline"
                     :isCreate="true"
                     @back="back" />

            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                <router-link
                    class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52"
                    to="/templates">
                    {{ t("common.Cancel") }}
                </router-link>

                <button class="btn py-3 btn-primary w-full md:w-52" type="button" @click="submitForm(false)">
                    {{ t("templates.Generate Paper") }}
                </button>
            </div>
        </template>
        <Loading v-if="isLoading" fixed></Loading>

    </div>
</template>

<script setup>

import {useI18n} from "vue-i18n";
import {onMounted, computed, ref} from "vue";
import {useRoute, useRouter} from "vue-router";
import store from '@/stores';
import axiosClient from "@/axios";
import {useVuelidate} from "@vuelidate/core";
import {helpers, minLength, minValue, numeric, required, requiredIf} from "@vuelidate/validators";
import Preview from "@/components/GeneratedQuestionPaper/Preview.vue";

const route = useRoute();
const router = useRouter();
const {t} = useI18n();
const submitted = ref(false);
const isLoading = ref(false);
const isErrored = ref(false);
const message = ref("");

const successModalPreview = ref(false);
let warningModalPreview = ref(false);
const warningMessage = ref("");
const isOnline = ref(false);

const paperInfo = ref();

const model = ref({
    id: "",
    batch_id: "",
    course_id: "",
    students: {},
});
onMounted(() => {
    store.dispatch("listCourses").then().catch();
    store.dispatch("listBatch").then().catch();
    fetch();
});

const batches = computed(() => store.getters.listBatches);
const courses = computed(() => store.getters.courseList);

const fetch = async () => {
    isLoading.value = true;
    try {
        let id = route.params.id;

        const result = await axiosClient.get(`/generated_questions/${id}`);
        if (result.status !== 200) {
            throw new Error('Failed to fetch template');
        }
        paperInfo.value = JSON.parse(JSON.stringify(result.data.data));
        isLoading.value = false;
    } catch (e) {
        message.value = e;
    } finally {
        isLoading.value = false;
    }
}
const selectedBatchId = ref();
const selectedCourseId = ref();

function selectedBatch(batchId) {
    selectedBatchId.value = batchId;
    dataChange();
}
function selectedCourse(courseId) {
    selectedCourseId.value = courseId;
    dataChange();
}
function dataChange()
{
    if (!selectedBatchId.value || !selectedCourseId.value) {
        return;
    }
    fetchStudents();
}

async function fetchStudents() {
    let url = "page=" + true
        + "&sort_field=name"
        + "&sort_order=asc"
        + "&per_page=10"
        + "&course_id="+selectedBatchId.value
        + "&batch_id="+selectedCourseId.value;

    const result = await axiosClient.get("/students?" + url);

    if (result.status !== 200) {
        throw new Error("Failed to fetch questions");
    } else {
        model.value.students = result.data.data;
    }
}

const rules = computed(() => {
    return {
        batch_id: {
            required: helpers.withMessage("Please select batch of students.", required),
        },
        course_id: {
            required: helpers.withMessage("Please select course of students.", required),
        },
    };
});
const v$ = useVuelidate(rules, model);

async function submitForm(pre) {

    submitted.value = true;
    v$.value.$validate(); // checks all inputs
    if (!v$.value.$error) {
        isLoading.value = true;
        warningMessage.value = "";
        await store
            .dispatch("generated_questions/save", model.value)
            .then(() => {
                isLoading.value = false;
                submitted.value = false;
                isErrored.value = false;
                preview.value = false;
                router.push({name: "GeneratedQuestionPapers"});
            })
            .catch((err) => {
                isLoading.value = false;
                submitted.value = false;
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

function removeStudent(student) {
    model.value.students = model.value.students.filter((q) => q !== student);
}
</script>

<style scoped>

</style>
