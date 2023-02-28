<template>
    <div>
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{ t("templates.Question Paper Format Details") }}
            </h2>
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
<!--                <router-link v-if="template"
                             :to="{name: 'PaperGenerator', params: {id: template.id}}"
                             class="
                                btn
                                btn-warning-soft
                                mr-2
                                flex
                                items-center
                                ml-auto
                                sm:ml-0
                                ">
                    <ServerIcon class="w-4 h-4 mr-2"/>
                    {{ t("templates.List Generated Question Papers") }}
                </router-link>-->
                <router-link v-if="template"
                             :to="{name: 'PaperGenerator', params: {id: template.id}}"
                             class="
                                btn
                                btn-primary
                                mr-2
                                flex
                                items-center
                                ml-auto
                                sm:ml-0
                                ">
                    <ServerIcon class="w-4 h-4 mr-2"/>
                    {{ t("templates.Generate Question Paper") }}
                </router-link>
                <router-link v-if="template"
                             :to="{name: 'EditTemplate', params:{id:template.id}}"
                             class="
                                    btn
                                    btn-success
                                    mr-2
                                    flex
                                    items-center
                                    ml-auto
                                    sm:ml-0
                                  ">
                    <EditIcon class="w-4 h-4 mr-2"/>
                    {{ t("templates.Edit Template") }}
                </router-link>
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
                    {{ t("common.Back") }}
                </router-link>
            </div>
        </div>

        <div class="intro-y col-span-11 2xl:col-span-9">

            <!-- BEGIN: Board and Standard selection -->
            <div class="intro-y box p-5 mt-5">
                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                    <div
                        class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                        <ChevronDownIcon class="w-4 h-4 mr-2"/>
                        {{ t("templates.Selected Board & Standard/Class") }}
                    </div>
                    <div class="mt-5">

                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">{{
                                                t("templates.Board")
                                            }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                {{ template ? template.board : null }}
                            </div>
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">{{
                                                t("templates.Standard")
                                            }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                {{ template ? template.standard : null }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Board and Standard selection -->
            <!-- BEGIN: Information -->
            <div class="intro-y box p-5 mt-5">
                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                    <div
                        class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                        <ChevronDownIcon class="w-4 h-4 mr-2"/>
                        {{ t("templates.Information") }}
                    </div>
                    <div class="mt-5">

                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">{{
                                                t("common.Name")
                                            }}
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                {{ template ? template.name : null }}
                            </div>
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">{{
                                                t("templates.Total Marks")
                                            }}
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                {{ template ? template.total_marks : null }}
                            </div>
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">{{
                                                t("templates.Duration")
                                            }}
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                {{ template ? template.duration : null }} minutes
                            </div>
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">{{ t("templates.Is Active") }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                {{ template ? template.is_active : null }}
                            </div>
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">{{ t("templates.Has Section") }}</div>
                                    </div>

                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                {{ template ? template.has_section : null }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Information -->
            <div class="intro-y box p-5 mt-5" v-if="template && template.has_section">
                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                    <div
                        class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                        <ChevronDownIcon class="w-4 h-4 mr-2"/>
                        {{ t("templates.Sections") }}
                    </div>
                    <div class="mt-5 overflow-x-auto">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">#</th>
                                    <th class="whitespace-nowrap">{{ t("templates.Name") }}</th>
                                    <th class="whitespace-nowrap">{{ t("templates.Total Questions") }}</th>
                                    <th class="whitespace-nowrap">{{ t("templates.Compulsory Questions") }}</th>
                                    <th class="whitespace-nowrap">{{ t("templates.Total Marks") }}</th>
                                    <th class="whitespace-nowrap">{{ t("templates.Marks per Question") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(section, index) in template.sections" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ section.name }}</td>
                                    <td>{{ section.total_questions }}</td>
                                    <td>{{ section.compulsory_questions }}</td>
                                    <td>{{ section.total_marks }}</td>
                                    <td>{{ section.marks_per_question }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
        <Loading v-if="isLoading" fixed></Loading>
    </div>
</template>

<script setup>
import store from "@/stores";
import {ref, computed, onMounted} from "vue";
import {useRoute, useRouter} from "vue-router";

import {useI18n} from "vue-i18n";

const route = useRoute();
const router = useRouter();
const {t} = useI18n();

const message = ref("");
const isLoading = ref(false);

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

onMounted(() => {
    fetch();
});

const template = computed(() => store.getters['templates/template']);
</script>

<style scoped>

</style>
