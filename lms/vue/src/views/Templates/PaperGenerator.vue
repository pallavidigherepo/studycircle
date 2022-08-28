<template>
    <div>
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{ t("templates.Generate Question Paper") }}
            </h2>
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                <router-link to="/templates"
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
                    {{ t("templates.Question Paper Formats") }}
                </router-link>
            </div>
        </div>
        <div class="intro-y grid grid-cols-11 gap-5 mt-5">

            <!-- BEGIN: Selected template, board and standard -->
            <div class="col-span-12 lg:col-span-4 2xl:col-span-3">
                <div class="box p-5 rounded-md">
                    <div
                        class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5"
                    >
                        <div class="font-medium text-base truncate">{{ t("templates.Question Paper Format Details") }}</div>

                    </div>
                    <div class="flex items-center">
                        <ClipboardIcon class="w-4 h-4 text-slate-500 mr-2" />
                        {{ t("templates.Format Name") }}: <span class="underline decoration-dotted ml-1">{{ template ? template.name: null}}</span>
                    </div>
                    <div class="flex items-center mt-3">
                        <CalendarIcon class="w-4 h-4 text-slate-500 mr-2" />
                        {{ t("templates.Board") }}: {{ template ? template.board : null }}
                    </div>
                    <div class="flex items-center mt-3">
                        <BookOpenIcon class="w-4 h-4 text-slate-500 mr-2" />
                        {{ t("templates.Standard") }}: {{ template ? template.standard : null  }}
                    </div>
                    <div class="flex items-center mt-3">
                        <ColumnsIcon class="w-4 h-4 text-slate-500 mr-2" />
                        {{ t("templates.Total Marks") }}: {{ template ? template.total_marks : null }}
                    </div>
                    <div class="flex items-center mt-3">
                        <ClockIcon class="w-4 h-4 text-slate-500 mr-2" />
                        {{ t("templates.Duration") }}: {{ template ? template.duration : null }}
                    </div>
                    <div class="flex items-center mt-3">
                        <PlayIcon class="w-4 h-4 text-slate-500 mr-2" />
                        {{ t("templates.Active") }}: {{ template ? template.is_active : null }}
                    </div>

                    <div class="flex items-center mt-3">
                        <ServerIcon class="w-4 h-4 text-slate-500 mr-2" />
                        {{ t("templates.Has Section") }}: {{ template ? template.has_section : null }}
                    </div>

                    <div v-if="!(template && template.has_section)" class="flex items-center mt-3">
                        <SidebarIcon class="w-4 h-4 text-slate-500 mr-2" />
                        {{ t("templates.Total Questions") }}: {{ template ? template.total_questions : null }}
                    </div>

                    <div v-if="!(template && template.has_section)" class="flex items-center mt-3">
                        <SidebarIcon class="w-4 h-4 text-slate-500 mr-2" />
                        {{ t("templates.Compulsory Questions") }}: {{ template ? template.compulsory_questions : null }}
                    </div>

                    <div v-if="!(template && template.has_section)" class="flex items-center mt-3">
                        <SidebarIcon class="w-4 h-4 text-slate-500 mr-2" />
                        {{ t("templates.Question type") }}: {{ template ? template.type_id : null }}
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-7 2xl:col-span-8">
                <div class="box p-5 rounded-md">
                    <div
                        class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5"
                    >
                        <div class="font-medium text-base truncate">{{ t("templates.Generate") }}</div>
                    </div>
                    <div class="overflow-auto lg:overflow-visible mt-3">
                        <!-- BEGIN: Subject, Chapter and Topic selection -->
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div
                                class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                <ChevronDownIcon class="w-4 h-4 mr-2"/>
                                {{ t("templates.Select Subject Chapter and topic") }}
                            </div>
                            <div class="mt-5">
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">{{
                                                        t("templates.Paper Name")
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
                                        <input id="form-name"
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
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">{{
                                                        t("questions.Choose Difficulty Level")
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
                                                   v-model="model.difficulty_level_id"
                                                   class="w-full" placeholder="Select Difficulty Level"
                                                   :class="{ 'border-danger': submitted && v$.difficulty_level_id.$errors.length,}"
                                                   :options="{
                                                  allowEmptyOption: false,
                                                  create: false,
                                                  placeholder: 'Select Difficulty Level',
                                                  autocomplete: 'off',
                                                }">
                                            <option>{{ t('questions.Select Difficulty Level') }}</option>
                                            <option v-for="(level, indexd) in difficultyList" :key="indexd" :value="indexd">
                                                {{ JSON.parse(level) }}
                                            </option>
                                        </TomSelect>
                                        <div v-for="(error, index) of v$.difficulty_level_id.$errors"
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
                                                        t("templates.Subject")
                                                    }}
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
                                        <div v-for="(error, index) of v$.difficulty_level_id.$errors"
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
                                                        t("templates.Chapter")
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <TomSelect id="form-chapter"
                                                   v-model="model.chapter_id"
                                                   :class="{ 'border-danger': submitted && v$.chapter_id.$errors.length, }"
                                                   :options="{
                                                        allowEmptyOption: false,
                                                        create: false,
                                                        placeholder: 'Select Chapter',
                                                        autocomplete: 'off',
                                                        onChange: selectedChapter,
                                                      }"
                                                   class="w-full"
                                                   placeholder="Select Chapter">
                                            <option>{{ t("templates.All Chapters") }}</option>
                                            <option v-for="(chapter, indexchap) in chapters" :key="indexchap"
                                                    :value="indexchap">
                                                {{ JSON.parse(chapter) }}
                                            </option>
                                        </TomSelect>
                                    </div>
                                </div>
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">{{
                                                        t("templates.Topic")
                                                    }}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <TomSelect id="form-subject"
                                                   v-model="model.topic_id"
                                                   :class="{ 'border-danger': submitted && v$.topic_id.$errors.length,}"
                                                   :options="{
                                                        allowEmptyOption: false,
                                                        create: false,
                                                        placeholder: 'Select Topic',
                                                        autocomplete: 'off',
                                                      }"
                                                   class="w-full"
                                                   placeholder="Select Topic">
                                            <option>{{ t("templates.All Topics") }}</option>
                                            <option v-for="(topic, indextop) in topics" :key="indextop" :value="indextop">
                                                {{ JSON.parse(topic) }}
                                            </option>
                                        </TomSelect>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- END: Subject, Chapter and Topic selection -->
                        <template  v-if="template && template.has_section">

                            <div class="intro-y box overflow-hidden mt-5">
                                <div class="border-b border-slate-200/60 dark:border-darkmode-400 sm:text-left">
                                    <div class="px-1 py-2 sm:px-1 sm:py-2">
                                        <div class="font-bold text-xl">{{ t("templates.Sections") }}</div>
                                    </div>
                                    <!-- BEGIN: Notification -->
                                    <Alert
                                        class="intro-y col-span-11 alert-warning alert-dismissible mb-6 mt-5"
                                        v-slot="{ dismiss }"
                                        role="alert"
                                    >
                                        <div class="flex items-center">
                                            <span><InfoIcon class="w-4 h-4 mr-2" /></span>
                                            <span>{{ t("templates.While fetching questions make sure to have all the above selections like Difficulty level Subject Chapter and Topic If you have NOT selected these questions will be fetched without any conditions") }}</span>
                                        </div>
                                    </Alert>
                                    <!-- BEGIN: Notification -->
                                    <tempate v-for="(section, index) in template.sections" :key="index">
                                        <template v-if="section.name != null">
                                            <div class="border-t mt-5 flex flex-col lg:flex-row px-2 sm:px-1">
                                                <div>
                                                    <div class="mt-3 font-medium">{{ section.name }}</div>
                                                    <div class="mt-3">{{ section.description }}</div>
                                                    <div class="mt-3">
                                                        <div class="form-check form-switch">
                                                            <div class="form-label xl:!mr-10">
                                                                {{ t("templates.Section questions") }}
                                                            </div>
                                                            <span class="mr-2">Auto</span>
                                                            <input id="form-is-active"
                                                                   class="form-check-input"
                                                                   type="checkbox"
                                                            />
                                                            <span class="ml-2">Manual</span>
                                                            <button class="btn btn-primary ml-5" @click.prevent="fetchQuestions">Fetch Questions</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="lg:text-right mt-10 lg:mt-0 lg:ml-auto">
                                                    <div class="font-medium mt-3 text-left">{{ section.total_marks }} {{ t("templates.Marks")}}</div>
                                                    <div class="font-medium mt-3 text-left">{{ section.total_questions }} {{ t("templates.Questions") }}</div>
                                                    <div class="font-medium mt-3 text-left">{{ section.compulsory_questions }} {{ t("templates.Compulsory Questions") }}</div>
                                                </div>
                                            </div>
                                            <div class="py-2">
                                                <div class="overflow-x-auto">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">
                                                                QUESTION
                                                            </th>
                                                            <th
                                                                class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap"
                                                            >
                                                                MARKS
                                                            </th>
                                                            <th
                                                                class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap"
                                                            >
                                                                ACTION
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="border-b dark:border-darkmode-400">
                                                                    Question
                                                                </td>
                                                                <td class="text-right border-b dark:border-darkmode-400 w-32">
                                                                    2
                                                                </td>
                                                                <td
                                                                    class="text-right border-b dark:border-darkmode-400 w-32 font-medium"
                                                                >
                                                                    Remove
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </template>
                                    </tempate>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            <!-- END: Selected template, board and standard -->

        </div>
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

const model = ref({
    id: route.params.id,
    name: "",
    subject_id: "",
    chapter_id: "",
    topic_id: "",
    difficulty_level_id: "",
    is_auto: true,
    generated_questions: [
        {
            sections: [
                {
                    questions: [{
                        id: '',
                        question: '',
                        description: '',
                        note: '',
                        marks: '',
                        negative_marks: '',
                        type_id: '',
                        answers: [
                            {
                                answer: '',
                                is_correct: null,
                            }
                        ],
                    }
                ]
            }]

        }
    ]
});
onMounted(() => {
    fetch();
    store.dispatch("listSubjects").then().catch();
    store.dispatch("listDifficultyLevel").then().catch();
});

const fetch = async () => {
    isLoading.value = true;
    try {
        let id = route.params.id;
        await store
            .dispatch("templates/show", id)
            .then(() => {
                isLoading.value = false;
            })
            .catch((err) => {
                isLoading.value = false;
            });
    } catch (e) {
        message.value = e;
    } finally {
        isLoading.value = false;
    }
};
const subjects = computed(() => store.getters.listSubjects);
const difficultyList = computed(() => store.getters.listDifficultyLevel);
const template = computed(() => store.getters['templates/template']);

async function selectedSubject(subjectId) {
    selectedSubjectId.value = subjectId;
    chapters.value = [];
    topics.value = [];
    const result = await axiosClient.get(`/chapter_list/${subjectId}`);
    if (result.status !== 200) {
        throw new Error("Failed to fetch chapter");
    } else {
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

async function fetchQuestions()
{
    const result = await axiosClient.post(`/questions/fetch`, model.value);
}

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
                required
            ),
        },
        subject_id: {
            required: helpers.withMessage("Please select subject.", required),
        },
    };
});
const v$ = useVuelidate(rules, model);
async function submitForm() {

    submitted.value = true;
    v$.value.$validate(); // checks all inputs
    //validateQuestionAnswers(); // Checks all question and answer inputs

    if (!v$.value.$error) {
        isLoading.value = true;
        if (model.value.type_id != 5) {
            delete model.value.questions;
        }
        let dataToPost = model.value;
        if (!model.value.add_question_manually) {
            dataToPost = setFormData();
        }
        await store
            .dispatch("questions/save", dataToPost)
            .then(() => {
                isLoading.value = false;
                submitted.value = false;
                isErrored.value = false;
                router.push({name: "Questions"});
            })
            .catch((err) => {
                isLoading.value = false;
                submitted.value = false;
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
</script>

<style scoped>

</style>
