<script setup lang="ts">

import {useI18n} from "vue-i18n";
import {onMounted, computed, ref} from "vue";
import {useRoute, useRouter} from "vue-router";
import store from '@/stores';
import axiosClient from "@/axios";
import {useVuelidate} from "@vuelidate/core";
import {helpers, minLength, minValue, numeric, required, requiredIf} from "@vuelidate/validators";
import TomSelect from "@/components/Base/TomSelect";
import { FormInput, FormSelect, FormCheck, FormTextarea, FormSwitch } from "@/components/Base/Form";
import Lucide from "@/components/Base/Lucide";
import Button from "@/components/Base/Button";
import { Dialog, Menu } from "@/components/Base/Headless";
import Table from "@/components/Base/Table";
import Alert from "@/components/Base/Alert";
import Preview from "@/components/GeneratedQuestionPaper/Preview.vue";

const route = useRoute();
const router = useRouter();
const {t} = useI18n();
const selectedSubjectId = ref("");
const selectedChapterId = ref("");
const selectedTopicId = ref("");
const chapters = ref([]);
const topics = ref([]);
const submitted = ref(false);
const isLoading = ref(false);
const isErrored = ref(false);
const message = ref("");
const template = ref();
const boardId = ref();
const standardId = ref();
const subjects = ref();
const preview = ref(false);
const successModalPreview = ref(false);
let warningModalPreview = ref(false);
const isOnline = ref(false);
const loading = ref(false);

const warningMessage = ref("");
const model = ref({
    id: "",
    name: "",
    subject_id: "",
    subject: "",
    chapter_id: "",
    topic_id: "",
    difficulty_level_id: "",
    is_auto: true,
    template_id: route.params.id,
    template: {},
    generated_questions: {
        sections: {}
    }
});
onMounted(() => {
    fetch();
    store.dispatch("listDifficultyLevel").then().catch();
});

const difficultyList = computed(() => store.getters.listDifficultyLevel);
const userInfo = computed(() => JSON.parse(sessionStorage.getItem("USER")));

const fetch = async () => {
    isLoading.value = true;
    try {
        let id = route.params.id;

        const result = await axiosClient.get(`/templates/${id}`);
        if (result.status != 200) {
            const error = new Error('Failed to fetch template')
            throw error;
        }
        template.value = JSON.parse(JSON.stringify(result.data.data));
        boardId.value = template.value.board_id;
        standardId.value = template.value.standard_id;
        model.value.template = template.value;

        await selectedStandard(standardId.value, boardId.value);
        isLoading.value = false;
    } catch (e) {
        message.value = e;
    } finally {
        isLoading.value = false;
    }
}

async function selectedStandard(standardId, boardId) {
    subjects.value = [];
    chapters.value = [];
    topics.value = [];
    const result = await axiosClient.get(`/subject_list/${boardId}/${standardId}`);
    if (result.status !== 200) {
        throw new Error("Failed to fetch chapter");
    } else {
        subjects.value = result.data;
    }
}

async function selectedSubject(subjectId) {
    model.value.generated_questions.sections = {};
    selectedSubjectId.value = subjectId;
    chapters.value = [];
    topics.value = [];
    const result = await axiosClient.get(`/chapter_list/${subjectId}`);
    if (result.status !== 200) {
        throw new Error("Failed to fetch chapter");
    } else {
        const resultSubject = await axiosClient.get(`/get_subject_name/${subjectId}`);
        model.value.subject = resultSubject.data;
        chapters.value = result.data;
    }
}

async function selectedChapter(chapterId) {
    selectedChapterId.value = chapterId;
    const result = await axiosClient.get(`/topic_list/${chapterId}`);
    if (result.status !== 200) {
        throw new Error("Failed to fetch topic");
    } else {
        topics.value = result.data;
    }
}

async function fetchQuestions(section, index) {
    if (!model.value.subject_id) {
        warningModalPreview.value = true;
        warningMessage.value = "Make sure you have selected your subject";
        return;
    }
    let typeId = "";
    let limit = "";

    if (!section && !index) {
        typeId = template.value.type_id;
        limit = template.value.total_questions;
    } else {
        typeId = section.type_id;
        limit = section.total_questions;
    }

    let url = "paper_generation=" + true
        + "&board_id=" + boardId.value
        + "&standard_id=" + standardId.value
        + "&subject_id=" + model.value.subject_id
        + "&chapter_id=" + model.value.chapter_id
        + "&topic_id=" + model.value.topic_id
        + "&difficulty_level_id=" + model.value.difficulty_level_id
        + "&type_id=" + typeId
        + "&limit=" + limit;

    const result = await axiosClient.get("/questions?" + url);

    if (result.status !== 200) {
        throw new Error("Failed to fetch questions");
    } else {
        if (!section && !index) {
            delete model.value.generated_questions.sections;
            model.value.generated_questions = result.data.data;
        } else {
            model.value.generated_questions.sections[index] = section;
            model.value.generated_questions.sections[index].questions = result.data.data;
        }
    }
}

// async function fetchQuestionsManually(section: any, index: any) {
//     if (!model.value.subject_id) {
//         warningModalPreview.value = true;
//         warningMessage.value = "Make sure you have selected your subject";
//         return;
//     }

//     let typeId = "";
//     let limit = "";

//     if (!section && !index) {
//         typeId = template.value.type_id;
//         limit = template.value.total_questions;
//     } else {
//         typeId = section.type_id;
//         limit = section.total_questions;
//     }

//     let url = "paper_generation=" + true
//         + "&board_id=" + boardId.value
//         + "&standard_id=" + standardId.value
//         + "&subject_id=" + model.value.subject_id
//         + "&chapter_id=" + model.value.chapter_id
//         + "&topic_id=" + model.value.topic_id
//         + "&difficulty_level_id=" + model.value.difficulty_level_id
//         + "&type_id=" + typeId
//         + "&limit=" + limit;

//     const result = await axiosClient.get("/questions?" + url);

//     if (result.status !== 200) {
//         throw new Error("Failed to fetch questions");
//     } else {
//         if (!section && !index) {
//             delete model.value.generated_questions.sections;
//             model.value.generated_questions = result.data.data;
//         } else {
//             model.value.generated_questions.sections[index] = section;
//             model.value.generated_questions.sections[index].questions = result.data.data;
//         }
//     }
    
// };

const rules = computed(() => {
    return {
        name: {
            required: helpers.withMessage(
                "Please enter name of paper.",
                required
            ),
        },
        difficulty_level_id: {
            required: helpers.withMessage(
                "Please select difficulty level.",
                requiredIf(() => {
                    return !template.value.has_section
                })
            ),
        },
        subject_id: {
            required: helpers.withMessage("Please select subject.", required),
        },
    };
});
const v$ = useVuelidate(rules, model);

async function submitForm(pre: any) {

    submitted.value = true;
    v$.value.$validate(); // checks all inputs
    if (template.value.has_section && !validateSectionQuestions()) {
        warningModalPreview.value = true;
        warningMessage.value = "Make sure you have added questions for each section.";
        return;
    }
    if (!v$.value.$error) {
        isLoading.value = true;
        warningMessage.value = "";
        if (pre) {
            preview.value = true;
            isLoading.value = false;
            submitted.value = false;
        } else {
            await store
                .dispatch("generated_questions/save", model.value)
                .then(() => {
                    isLoading.value = false;
                    submitted.value = false;
                    isErrored.value = false;
                    preview.value = false;
                    router.push({name: "GeneratedQuestionPapers"});
                })
                .catch((err: { response: { data: { message: string; }; }; }) => {
                    isLoading.value = false;
                    submitted.value = false;
                    isErrored.value = true;
                    if (err.response && err.response.data) {
                        message.value = err.response.data.message;
                    }

                });
        }
    } else {
        // if ANY fail validation
        return;
    }
}

function validateSectionQuestions() {
    if ((template.value.sections.length !== Object.keys(model.value.generated_questions.sections).length)) {
        return false;
    }
    for(const [key, value] of Object.entries(model.value.generated_questions.sections)) {
        if (value.questions.length <= 0) {
            return false;
        }
    }
    return true;
}

function removeQuestion(question, sectionIndex, questionIndex) {
    if (template.value.has_section) {
        model.value.generated_questions.sections[sectionIndex].questions = model.value.generated_questions.sections[sectionIndex].questions.filter((q) => q !== question);
    } else {
        model.value.generated_questions = model.value.generated_questions.filter((q) => q !== question);
    }
}

function back() {
    preview.value = !preview.value;
}
</script>

<template>
    <div>
        <template v-if="!preview">
            <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    Generate Question Paper
                </h2>
                <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                    <Button
                            variant="primary"
                                class="
                                        box
                                        mr-2
                                        flex
                                        items-center
                                        ml-auto
                                        sm:ml-0
                                    "
                                @click="router.push('/templates')"
                            ><Lucide icon="ArrowLeftCircle" class="w-4 h-4 mr-2" />Question Paper Formats
                    </Button>
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
                                    Question Paper Format Details
                                </div>

                            </div>
                            <div class="flex items-center">
                                <Lucide icon="ClipboardIcon" class="w-4 h-4 text-slate-500 mr-2"/>
                                Name: <span
                                class="underline decoration-dotted ml-1">{{ template ? template.name : null }}</span>
                            </div>
                            <div class="flex items-center mt-3">
                                <Lucide icon="CalendarIcon" class="w-4 h-4 text-slate-500 mr-2"/>
                                Board: <span class="ml-2">{{
                                    template ? template.board : null
                                }}</span>
                            </div>
                            <div class="flex items-center mt-3">
                                <Lucide icon="BookOpenIcon" class="w-4 h-4 text-slate-500 mr-2"/>
                                Standard: <span class="ml-2">{{
                                    template ? template.standard : null
                                }}</span>
                            </div>
                            <div class="flex items-center mt-3">
                                <Lucide icon="ColumnsIcon" class="w-4 h-4 text-slate-500 mr-2"/>
                                Total Marks: <span
                                class="ml-2">{{ template ? template.total_marks : null }}</span>
                            </div>
                            <div class="flex items-center mt-3">
                                <Lucide icon="ClockIcon" class="w-4 h-4 text-slate-500 mr-2"/>
                                Duration: <span class="ml-2">{{
                                    template ? template.duration : null
                                }}</span>
                            </div>
                            <div class="flex items-center mt-3">
                                <Lucide icon="PlayIcon" class="w-4 h-4 text-slate-500 mr-2"/>
                                Active: <span class="ml-2">{{
                                    template ? template.is_active : null
                                }}</span>
                            </div>
                            <div class="flex items-center mt-3">
                                <Lucide icon="ServerIcon" class="w-4 h-4 text-slate-500 mr-2"/>
                                Has Section: <span
                                class="ml-2">{{ template ? template.has_section : null }}</span>
                            </div>
                            <div v-if="!(template && template.has_section)" class="flex items-center mt-3">
                                <Lucide icon="SidebarIcon" class="w-4 h-4 text-slate-500 mr-2"/>
                                Total Questions:<span
                                class="ml-2">{{ template ? template.total_questions : null }}</span>
                            </div>
                            <div v-if="!(template && template.has_section)" class="flex items-center mt-3">
                                <Lucide icon="SidebarIcon" class="w-4 h-4 text-slate-500 mr-2"/>
                                Compulsory Questions: <span
                                class="ml-2">{{ template ? template.compulsory_questions : null }}</span>
                            </div>
                            <div v-if="!(template && template.has_section)" class="flex items-center mt-3">
                                <Lucide icon="SidebarIcon" class="w-4 h-4 text-slate-500 mr-2"/>
                                Question type:<span
                                class="ml-2">{{ template ? template.type_name : null }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-7 2xl:col-span-8">
                        <div class="box p-5 rounded-md">
                            <div
                                class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5"
                            >
                                <div class="font-medium text-base truncate">Generate</div>
                            </div>
                            <div class="overflow-auto lg:overflow-visible mt-3">
                                <!-- BEGIN: Subject, Chapter and Topic selection -->
                                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                    <div
                                        class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                        <Lucide icon="ChevronDownIcon" class="w-4 h-4 mr-2"/>
                                        Select Subject Chapter and topic
                                    </div>
                                    <div class="mt-5">
                                        <div
                                            class="form-inline flex items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label flex xl:w-64 xl:mr-10 flex items-center">
                                                <div class="text-left flex-grow">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">Paper Name
                                                        </div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            Required
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <FormInput id="form-name"
                                                       v-model.trim="model.name"
                                                       :class="{'border-danger': submitted && v$.name.$errors.length,}"
                                                       class="form-control"
                                                       placeholder="Paper name."
                                                       type="text"/>
                                                <div v-for="(error, index) of v$.name.$errors" :key="index"
                                                     class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="template && !template.has_section"
                                                class="form-inline flex items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label flex xl:w-64 xl:mr-10 flex items-center">
                                                <div class="text-left flex-grow">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">Choose Difficulty Level
                                                        </div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            Required
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <TomSelect id="form-level"
                                                           v-model="model.difficulty_level_id"
                                                           class="w-full" placeholder="Select Difficulty Level"
                                                           :class="{ 'border-danger': submitted && v$.difficulty_level_id.$errors.length,}"
                                                           :options="{
                                                      allowEmptyOption: false,
                                                      create: false,
                                                      placeholder: 'Select Difficulty Level',
                                                      autocomplete: 'off',
                                                    }">
                                                    <option>Select Difficulty Level</option>
                                                    <option v-for="(level, indexd) in difficultyList" :key="indexd"
                                                            :value="indexd">
                                                        {{ JSON.parse(level) }}
                                                    </option>
                                                </TomSelect>
                                                <div v-for="(error, index) of v$.difficulty_level_id.$errors"
                                                     :key="index" class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="form-inline flex items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label flex xl:w-64 xl:mr-10 flex items-center">
                                                <div class="text-left flex-grow">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">Subject
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <TomSelect id="form-subject"
                                                           v-model="model.subject_id"
                                                           :class="{ 'border-danger': submitted && v$.subject_id.$errors.length, }"
                                                           :options="{
                                                            allowEmptyOption: false,
                                                            create: false,
                                                            placeholder: 'Select Subject',
                                                            autocomplete: 'off',
                                                            onChange: selectedSubject,
                                                          }"
                                                           class="w-full"
                                                           placeholder="Select Subject">
                                                    <option>{{ t("templates.Select Subject") }}</option>
                                                    <option v-for="(subject, indexsub) in subjects" :key="indexsub"
                                                            :value="indexsub">
                                                        {{ JSON.parse(subject) }}
                                                    </option>
                                                </TomSelect>
                                                <FormInput type="hidden" v-model="model.subject" />
                                                <div v-for="(error, index) of v$.subject_id.$errors"
                                                     :key="index" class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="form-inline flex items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label flex xl:w-64 xl:mr-10 flex items-center">
                                                <div class="text-left flex-grow">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">Chapter
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <TomSelect id="form-chapter"
                                                           v-model="model.chapter_id"
                                                           :options="{
                                                            allowEmptyOption: false,
                                                            create: false,
                                                            placeholder: 'Select Chapter',
                                                            autocomplete: 'off',
                                                            onChange: selectedChapter,
                                                          }"
                                                           class="w-full"
                                                           placeholder="Select Chapter">
                                                    <option>All Chapters</option>
                                                    <option v-for="(chapter, indexchap) in chapters" :key="indexchap"
                                                            :value="indexchap">
                                                        {{ JSON.parse(chapter) }}
                                                    </option>
                                                </TomSelect>
                                            </div>
                                        </div>
                                        <div
                                            class="form-inline flex items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label flex xl:w-64 xl:mr-10 flex items-center">
                                                <div class="text-left flex-grow">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">Topic
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <TomSelect id="form-subject"
                                                           v-model="model.topic_id"
                                                           :options="{
                                                            allowEmptyOption: false,
                                                            create: false,
                                                            placeholder: 'Select Topic',
                                                            autocomplete: 'off',
                                                          }"
                                                           class="w-full"
                                                           placeholder="Select Topic">
                                                    <option>All Topics</option>
                                                    <option v-for="(topic, indextop) in topics" :key="indextop"
                                                            :value="indextop">
                                                        {{ JSON.parse(topic) }}
                                                    </option>
                                                </TomSelect>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END: Subject, Chapter and Topic selection -->

                                <template v-if="template && template.has_section">

                                    <div class="intro-y box overflow-hidden mt-5">
                                        <div class="border-b border-slate-200/60 dark:border-darkmode-400 sm:text-left">
                                            <div class="px-1 py-2 sm:px-1 sm:py-2">
                                                <div class="font-bold text-xl">Sections</div>
                                            </div>
                                            <!-- BEGIN: Notification -->
                                            <Alert variant="soft-warning" class="flex items-center mb-2">
                                                <Lucide icon="AlertCircle" class="w-6 h-6 mr-2" />
                                                While fetching questions make sure to have all the above selections like Difficulty level Subject Chapter and Topic If you have NOT selected these questions will be fetched without any conditions
                                            </Alert>
                                            <!-- <info :typeClass="'alert-warning-soft'"
                                                  :message="'templates.While fetching questions make sure to have all the above selections like Difficulty level Subject Chapter and Topic If you have NOT selected these questions will be fetched without any conditions'"/> -->

                                            <!-- BEGIN: Notification -->
                                            <template v-for="(section, index) in template.sections" :key="index">
                                                <template v-if="section.name != null">
                                                    <div class="border-t mt-5 flex flex-col lg:flex-row px-2 sm:px-1">
                                                        <div>
                                                            <div class="mt-3 font-medium">{{ section.name }}</div>
                                                            <div class="mt-3">{{ section.description }}</div>
                                                            <div class="flex mt-3">
                                                                <div class="form-label xl:!mr-10">
                                                                    {{ t("templates.Question Type") }}
                                                                </div>
                                                                {{ section.type_name }}
                                                            </div>
                                                            <div class="mt-3">

                                                                <div class="form-check flex form-switch">
                                                                    <div class="form-label xl:!mr-10">
                                                                        Fetch questions
                                                                    </div>
                                                                    <Button variant="primary" class="btn btn-primary"
                                                                            @click.prevent="fetchQuestions(section, index)">
                                                                            Fetch Questions Automatically
                                                                    </Button>
                                                                    <Button variant="primary" class="btn btn-primary"
                                                                            @click.prevent="fetchQuestions(section, index)">
                                                                            Fetch Questions Manually
                                                                    </Button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="lg:text-right mt-10 lg:mt-0 lg:ml-auto">
                                                            <div class="font-medium mt-3 text-left">
                                                                {{ section.total_marks }} Marks
                                                            </div>
                                                            <div class="font-medium mt-3 text-left">
                                                                {{ section.total_questions }}
                                                                Questions
                                                            </div>
                                                            <div class="font-medium mt-3 text-left">
                                                                {{ section.compulsory_questions }}
                                                                Compulsory Questions
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="py-2">
                                                        <div class="overflow-x-auto">
                                                            <Table class="table">
                                                                <Table.Thead>
                                                                <Table.Tr>
                                                                    <Table.Th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">
                                                                        #
                                                                    </Table.Th>
                                                                    <Table.Th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">
                                                                        QUESTION
                                                                    </Table.Th>
                                                                    <Table.Th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">
                                                                        MARKS
                                                                    </Table.Th>
                                                                    <Table.Th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">
                                                                        NEGATIVE MARKS
                                                                    </Table.Th>
                                                                    <Table.Th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">
                                                                        ACTION
                                                                    </Table.Th>
                                                                </Table.Tr>
                                                                </Table.Thead>
                                                                <Table.Tbody>
                                                                <template
                                                                    v-if="model.generated_questions.sections[index] &&
                                                                        model.generated_questions.sections[index].questions &&
                                                                        model.generated_questions.sections[index].questions.length > 0">
                                                                    <Table.Tr v-for="(question, qidx) in model.generated_questions.sections[index].questions"
                                                                        :key="qidx">
                                                                        <Table.Td class="border-b dark:border-darkmode-400">
                                                                            {{ question.id }}
                                                                        </Table.Td>
                                                                        <Table.Td class="border-b dark:border-darkmode-400">
                                                                            {{ question.question }}
                                                                        </Table.Td>
                                                                        <Table.Td class="text-center border-b dark:border-darkmode-400 w-32">
                                                                            {{ question.marks }}
                                                                        </Table.Td>
                                                                        <Table.Td class="text-center border-b dark:border-darkmode-400 w-32">
                                                                            {{ question.negative_marks }}
                                                                        </Table.Td>
                                                                        <Table.Td class="text-center border-b dark:border-darkmode-400 w-32">
                                                                            <div
                                                                                class="text-center items-center justify-center">

                                                                                <a class="text-danger items-center"
                                                                                   href="javascript:;"
                                                                                   @click.prevent="removeQuestion(question, index, qidx)">
                                                                                    <Lucide icon="Trash2Icon" class="w-4 h-4 mr-1"/>
                                                                                </a>
                                                                            </div>
                                                                        </Table.Td>
                                                                    </Table.Tr>
                                                                </template>
                                                                <template v-else>
                                                                    <Table.Tr>
                                                                        <Table.Td colspan="5"
                                                                            class="border-b dark:border-darkmode-400">
                                                                            No Questions.
                                                                        </Table.Td>
                                                                    </Table.Tr>
                                                                </template>
                                                                </Table.Tbody>
                                                            </Table>
                                                        </div>
                                                    </div>
                                                </template>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                                <template v-else>
                                    <div class="intro-y box overflow-hidden mt-5">
                                        <div class="border-b border-slate-200/60 dark:border-darkmode-400 sm:text-left">

                                            <div class="flex items-center">
                                                <div class="mt-3">
                                                    <div class="form-check flex form-switch">
                                                        <div class="form-label xl:!mr-10">
                                                            Section questions
                                                        </div>
                                                        <span class="mr-2">Auto</span>
                                                        <FormSwitch.Input id="form-is-active"
                                                               class="form-check-input"
                                                               type="checkbox"
                                                        />
                                                        <span class="ml-2">Manual</span>
                                                        <Button variant="primary" class="btn btn-primary ml-5"
                                                                @click.prevent="fetchQuestions()">
                                                                Fetch Questions
                                                        </Button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="overflow-x-auto">
                                                <Table class="table">
                                                    <Table.Thead>
                                                    <Table.Tr>
                                                        <Table.Th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">
                                                            #
                                                        </Table.Th>
                                                        <Table.Th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">
                                                            QUESTION
                                                        </Table.Th>
                                                        <Table.Th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">
                                                            MARKS
                                                        </Table.Th>
                                                        <Table.Th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">
                                                            NEGATIVE MARKS
                                                        </Table.Th>
                                                        <Table.Th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">
                                                            ACTION
                                                        </Table.Th>
                                                    </Table.Tr>
                                                    </Table.Thead>
                                                    <Table.Tbody>
                                                    <template
                                                        v-if="model.generated_questions && model.generated_questions.length > 0">
                                                        <Table.Tr v-for="(question, qidx) in model.generated_questions"
                                                            :key="qidx">
                                                            <Table.Td class="border-b dark:border-darkmode-400">
                                                                {{ question.id }}
                                                            </Table.Td>
                                                            <Table.Td class="border-b dark:border-darkmode-400">
                                                                {{ question.question }}
                                                            </Table.Td>
                                                            <Table.Td class="text-center border-b dark:border-darkmode-400 w-32">
                                                                {{ question.marks }}
                                                            </Table.Td>
                                                            <Table.Td class="text-center border-b dark:border-darkmode-400 w-32">
                                                                {{ question.negative_marks }}
                                                            </Table.Td>
                                                            <Table.Td class="text-center border-b dark:border-darkmode-400 w-32">
                                                                <div class="text-center items-center justify-center">

                                                                    <a class="text-danger items-center"
                                                                       href="javascript:;"
                                                                       @click.prevent="removeQuestion(question)">
                                                                       <Lucide icon="Trash2Icon" class="w-4 h-4 mr-1"/>
                                                                    </a>
                                                                </div>
                                                            </Table.Td>
                                                        </Table.Tr>
                                                    </template>
                                                    <template v-else>
                                                        <Table.Tr>
                                                            <Table.Td colspan="5" class="border-b dark:border-darkmode-400">
                                                                No Questions.
                                                            </Table.Td>
                                                        </Table.Tr>
                                                    </template>
                                                    </Table.Tbody>
                                                </Table>
                                            </div>
                                        </div>

                                    </div>

                                </template>
                            </div>
                        </div>
                    </div>
                    <!-- END: Selected template, board and standard -->

                </div>
                <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                    <Button
                        variant="secondary"
                        class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52"
                        @click="router.push('/templates')">
                        Cancel
                    </Button>

                    <Button variant="primary" class="btn py-3 btn-primary w-full md:w-52" type="submit" @click="isOnline = true">
                        Preview Generated Paper In Online Mode
                    </Button>

                    <Button variant="primary" class="btn py-3 btn-primary w-full md:w-52" type="submit" @click="isOnline = false">
                        Preview Generated Paper In Offline Mode
                    </Button>
                </div>
            </form>
            <!-- BEGIN: Modal Content -->
            <Dialog :open="warningModalPreview" @hidden="warningModalPreview = false">
                <Dialog.Panel class="p-0">
                    <div class="p-5 text-center">
                        <Lucide icon="XCircleIcon" class="w-16 h-16 text-warning mx-auto mt-3"/>
                        <div class="text-3xl mt-5">Oops...</div>
                        <div class="text-slate-500 mt-2">
                            {{ warningMessage }}
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <Button type="button" @click="warningModalPreview = false" class="btn w-24 btn-primary">
                            Ok
                        </Button>
                    </div>
                </Dialog.Panel>
            </Dialog>
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
                <Button
                    variant="secondary"
                    class="
                            box
                            mr-2
                            flex
                            items-center
                            ml-auto
                            sm:ml-0
                        "
                    @click="router.push('/templates')"
                >
                Cancel
                </Button>

                <Button variant="primary" class="btn py-3 btn-primary w-full md:w-52" type="button" @click="submitForm(false)">
                    Generate Paper
                </Button>
            </div>
        </template>
        <Loading v-if="isLoading" fixed></Loading>

    </div>
</template>
<style scoped>

</style>

function fetchQuestionsManually(section: any, index: any) {
  throw new Error("Function not implemented.");
}

function fetchQuestionsManually(section: any, index: any) {
  throw new Error("Function not implemented.");
}
