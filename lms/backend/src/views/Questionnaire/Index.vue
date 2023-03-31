<template>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: General Report -->
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">{{ t("templates.Questionnaire Dashboard") }}</h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                            <div class="report-box zoom-in">
                                <router-link to="/templates">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <ListIcon class="report-box__icon text-primary" />
                                            <div class="text-3xl font-medium leading-8 ml-5">{{ templateCount }}</div>
                                            <div class="text-base text-slate-500 ml-5 mt-1">{{ t("templates.Question Paper Formats") }}</div>
                                        </div>

                                    </div>
                                </router-link>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                            <div class="report-box zoom-in">
                                <router-link to="/generated_question_papers">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <ArchiveIcon class="report-box__icon text-pending" />
                                            <div class="text-3xl font-medium leading-8 ml-5">{{ generatedPaperCount }}</div>
                                            <div class="text-base text-slate-500 ml-5 mt-1">{{ t("templates.Generated Question Papers") }}</div>
                                        </div>

                                    </div>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: General Report -->
                <!-- BEGIN: Sales Report -->
                <div class="col-span-12 lg:col-span-12 mt-8">

                </div>
                <!-- END: Sales Report -->
            </div>
        </div>
        <div class="col-span-12 2xl:col-span-3">
            <div class="2xl:border-l -mb-10 pb-10">
                <div class="2xl:pl-6 grid grid-cols-12 gap-x-6 2xl:gap-x-0 gap-y-6">
                    <!-- BEGIN: Latest Templates -->
                    <div
                        class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12 mt-3 2xl:mt-8"
                    >
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">{{ t("templates.Latest Templates") }}</h2>
                        </div>
                        <div class="mt-5">
                            <div
                                v-for="(template, index) in latestTemplates"
                                :key="index"
                                class="intro-x"
                            >
                                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                    <div class="ml-4 mr-auto">
                                        <div class="font-medium">
                                            <router-link :to="{name: 'ShowTemplate', params: {id: template.id}}">
                                                {{ template.name }}
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <router-link
                                to="/templates"
                                class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500"
                            >{{ t("common.View More") }}</router-link
                            >
                        </div>
                    </div>
                    <!-- END: Latest Templates -->
                    <!-- BEGIN: Latest Templates -->
                    <div
                        class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12 mt-3 2xl:mt-8"
                    >
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">{{ t("generated_questions.Latest Question Papers") }}</h2>
                        </div>
                        <div class="mt-5">
                            <div
                                v-for="(questionPaper, index) in latestQuestionPaper"
                                :key="index"
                                class="intro-x"
                            >
                                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                    <div class="ml-4 mr-auto">
                                        <div class="font-medium">
                                            <router-link :to="{name: 'ShowGeneratedQuestionPaper', params: {id: questionPaper.id}}">
                                            {{ questionPaper.name }}
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <router-link
                                to="/templates"
                                class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500"
                            >{{ t("common.View More") }}</router-link
                            >
                        </div>
                    </div>
                    <!-- END: Latest Generated Question Papers -->
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {ref, provide, onMounted} from "vue";
import {useI18n} from "vue-i18n";
import axiosClient from "@/axios";

const {t} = useI18n();
const templateCount = ref(0);
const generatedPaperCount = ref(0);
const latestTemplates = ref([]);
const latestQuestionPaper = ref([]);
onMounted(() => {
    fetch();
});

async function fetch() {
    const result = await axiosClient.get(`/questionnaire`);
    templateCount.value = result.data.templateCount;
    generatedPaperCount.value = result.data.generatedQuestionPaperCount;
    latestTemplates.value = result.data.latestTemplates;
    latestQuestionPaper.value = result.data.latestQuestionPaper;
    if (result.status != 200) {
        const error = new Error('Failed to fetch question')
        throw error;
    }
}
</script>
