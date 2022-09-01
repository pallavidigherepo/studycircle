<template>
    <div>
        <template v-if="!preview">
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
            <form class="form-validation" @submit.prevent="submitForm(true)">
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
                                {{ t("templates.Board") }}: <span class="ml-2">{{ template ? template.board : null }}</span>
                            </div>
                            <div class="flex items-center mt-3">
                                <BookOpenIcon class="w-4 h-4 text-slate-500 mr-2" />
                                {{ t("templates.Standard") }}: <span class="ml-2">{{ template ? template.standard : null  }}</span>
                            </div>
                            <div class="flex items-center mt-3">
                                <ColumnsIcon class="w-4 h-4 text-slate-500 mr-2" />
                                {{ t("templates.Total Marks") }}: <span class="ml-2">{{ template ? template.total_marks : null }}</span>
                            </div>
                            <div class="flex items-center mt-3">
                                <ClockIcon class="w-4 h-4 text-slate-500 mr-2" />
                                {{ t("templates.Duration") }}: <span class="ml-2">{{ template ? template.duration : null }}</span>
                            </div>
                            <div class="flex items-center mt-3">
                                <PlayIcon class="w-4 h-4 text-slate-500 mr-2" />
                                {{ t("templates.Active") }}: <span class="ml-2">{{ template ? template.is_active : null }}</span>
                            </div>
                            <div class="flex items-center mt-3">
                                <ServerIcon class="w-4 h-4 text-slate-500 mr-2" />
                                {{ t("templates.Has Section") }}: <span class="ml-2">{{ template ? template.has_section : null }}</span>
                            </div>
                            <div v-if="!(template && template.has_section)" class="flex items-center mt-3">
                                <SidebarIcon class="w-4 h-4 text-slate-500 mr-2" />
                                {{ t("templates.Total Questions") }}:<span class="ml-2">{{ template ? template.total_questions : null }}</span>
                            </div>
                            <div v-if="!(template && template.has_section)" class="flex items-center mt-3">
                                <SidebarIcon class="w-4 h-4 text-slate-500 mr-2" />
                                {{ t("templates.Compulsory Questions") }}: <span class="ml-2">{{ template ? template.compulsory_questions : null }}</span>
                            </div>
                            <div v-if="!(template && template.has_section)" class="flex items-center mt-3">
                                <SidebarIcon class="w-4 h-4 text-slate-500 mr-2" />
                                {{ t("templates.Question type") }}:<span class="ml-2">{{ template ? template.type_name : null }}</span>
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
                                        <div v-if="template && !template.has_section" class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
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
                                                <div v-for="(error, index) of v$.subject_id.$errors"
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
                                                class="intro-y col-span-11 alert-warning-soft alert-dismissible mb-6 mt-5"
                                                v-slot="{ dismiss }"
                                                role="alert"
                                            >
                                                <div class="flex items-center">
                                                    <span><InfoIcon class="w-10 h-10 mr-2" /></span>
                                                    <span>{{ t("templates.While fetching questions make sure to have all the above selections like Difficulty level Subject Chapter and Topic If you have NOT selected these questions will be fetched without any conditions") }}</span>
                                                </div>
                                            </Alert>
                                            <!-- BEGIN: Notification -->
                                            <template v-for="(section, index) in template.sections" :key="index">
                                                <template v-if="section.name != null">
                                                    <div class="border-t mt-5 flex flex-col lg:flex-row px-2 sm:px-1">
                                                        <div>
                                                            <div class="mt-3 font-medium">{{ section.name }}</div>
                                                            <div class="mt-3">{{ section.description }}</div>
                                                            <div class="mt-3">
                                                                <div class="form-label xl:!mr-10">
                                                                    {{ t("templates.Question Type") }}
                                                                </div>
                                                                {{ section.type_name }}
                                                            </div>
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
                                                                    <button class="btn btn-primary ml-5" @click.prevent="fetchQuestions(section, index)">
                                                                        {{ t("templates.Fetch Questions") }}</button>
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
                                                                    <th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">#</th>
                                                                    <th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">
                                                                        {{ t("questions.QUESTION") }}
                                                                    </th>
                                                                    <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">
                                                                        {{ t("questions.MARKS") }}
                                                                    </th>
                                                                    <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">
                                                                        {{ t("questions.NEGATIVE MARKS") }}
                                                                    </th>
                                                                    <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">
                                                                        {{ t("common.ACTION") }}
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <template v-if="model.generated_questions.sections[index] && model.generated_questions.sections[index].questions.length > 0">
                                                                    <tr v-for="(question, qidx) in model.generated_questions.sections[index].questions" :key="qidx">
                                                                        <td class="border-b dark:border-darkmode-400">
                                                                            {{ question.id }}
                                                                        </td>
                                                                        <td class="border-b dark:border-darkmode-400">
                                                                            {{ question.question }}
                                                                        </td>
                                                                        <td class="text-center border-b dark:border-darkmode-400 w-32">
                                                                            {{ question.marks }}
                                                                        </td>
                                                                        <td class="text-center border-b dark:border-darkmode-400 w-32">
                                                                            {{ question.negative_marks }}
                                                                        </td>
                                                                        <td class="text-center border-b dark:border-darkmode-400 w-32">
                                                                            <div class="text-center items-center justify-center">

                                                                                <a class="text-danger items-center"
                                                                                   href="javascript:;"
                                                                                   @click.prevent="removeQuestion(question, index, qidx)">
                                                                                    <Trash2Icon class="w-4 h-4 mr-1" />
                                                                                </a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                                <template v-else>
                                                                    <tr>
                                                                        <td colspan="5" class="border-b dark:border-darkmode-400">
                                                                            No Questions.
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                                </tbody>
                                                            </table>
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
                                                        <button class="btn btn-primary ml-5" @click.prevent="fetchQuestions()">
                                                            {{ t("templates.Fetch Questions") }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="overflow-x-auto">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">#</th>
                                                        <th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">
                                                            {{ t("questions.QUESTION") }}
                                                        </th>
                                                        <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">
                                                            {{ t("questions.MARKS") }}
                                                        </th>
                                                        <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">
                                                            {{ t("questions.NEGATIVE MARKS") }}
                                                        </th>
                                                        <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">
                                                            {{ t("common.ACTION") }}
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <template v-if="model.generated_questions && model.generated_questions.length > 0">
                                                        <tr v-for="(question, qidx) in model.generated_questions" :key="qidx">
                                                            <td class="border-b dark:border-darkmode-400">
                                                                {{ question.id }}
                                                            </td>
                                                            <td class="border-b dark:border-darkmode-400">
                                                                {{ question.question }}
                                                            </td>
                                                            <td class="text-center border-b dark:border-darkmode-400 w-32">
                                                                {{ question.marks }}
                                                            </td>
                                                            <td class="text-center border-b dark:border-darkmode-400 w-32">
                                                                {{ question.negative_marks }}
                                                            </td>
                                                            <td class="text-center border-b dark:border-darkmode-400 w-32">
                                                                <div class="text-center items-center justify-center">

                                                                    <a class="text-danger items-center"
                                                                       href="javascript:;"
                                                                       @click.prevent="removeQuestion(question)">
                                                                        <Trash2Icon class="w-4 h-4 mr-1" />
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </template>
                                                    <template v-else>
                                                        <tr>
                                                            <td colspan="5" class="border-b dark:border-darkmode-400">
                                                                No Questions.
                                                            </td>
                                                        </tr>
                                                    </template>
                                                    </tbody>
                                                </table>
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
                    <router-link
                        class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52"
                        to="/templates">
                        {{ t("common.Cancel") }}
                    </router-link>

                    <button class="btn py-3 btn-primary w-full md:w-52" type="submit" @click="isOnline = true">
                        {{ t("generated_questions.Preview Generated Paper In Online Mode") }}
                    </button>

                    <button class="btn py-3 btn-primary w-full md:w-52" type="submit" @click="isOnline = false">
                        {{ t("generated_questions.Preview Generated Paper In Offline Mode") }}
                    </button>
                </div>
            </form>
            <!-- BEGIN: Modal Content -->
            <Modal :show="warningModalPreview" @hidden="warningModalPreview = false">
                <ModalBody class="p-0">
                    <div class="p-5 text-center">
                        <XCircleIcon class="w-16 h-16 text-warning mx-auto mt-3" />
                        <div class="text-3xl mt-5">Oops...</div>
                        <div class="text-slate-500 mt-2">{{ t("templates.Make sure you have selected your subject") }}</div>
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
            <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    {{ t("templates.Preview Generated Question Paper") }}
                </h2>
                <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                    <a href="javascript:;"
                       @click.prevent="preview=!preview"
                       class="btn box text-gray-700 dark:text-gray-300 mr-2 flex items-center ml-auto sm:ml-0">
                        <ArrowLeftCircleIcon class="w-4 h-4 mr-2"/>
                        {{ t("common.Back") }}
                    </a>
                </div>
            </div>
            <div class="intro-y box overflow-hidden mt-5">
                <div
                    class="border-b border-slate-200/60 dark:border-darkmode-400 text-center sm:text-left"
                >
                    <div class="flex flex-col lg:flex-row sm:px-1 pt-1 pb-1 sm:pb-10 border-b">
                        <div class="h-full p-5 items-center ">
                            <div class="font-semibold text-2xl">{{ userInfo.name }}</div>
                        </div>
                        <div class=" mt-10 lg:mt-0 lg:ml-auto text-center">
                            <div class="text-lg font-medium mt-2">{{ model.name }}</div>
                            <div class="text-lg font-medium mt-2">{{ t("templates.Standard") }} : {{ model.template.standard }}</div>
                            <div class="text-lg font-medium mt-2">{{ t("templates.Subject") }}: {{ model.subject_id}}</div>
                        </div>
                        <div class="lg:text-left mt-10 lg:mt-0 lg:ml-auto pr-2">
                            <div class="text-lg font-medium mt-2">Date: </div>
                            <div class="text-lg font-medium mt-2">{{ t("templates.Total Marks") }}: {{ template.total_marks }}</div>
                            <div class="text-lg font-medium mt-2" v-if="!template.has_section">{{ t("templates.Total Questions") }}: {{ template.total_questions }}</div>
                        </div>
                    </div>
                </div>
                <div class="border-b border-slate-200/60 dark:border-darkmode-400 text-center sm:text-left">
                    <div class="p-5" v-html="template.description"></div>

                </div>
                <div class="py-5 sm:py-10">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <template v-if="template.has_section">
                                <tr v-for="(section, index) in model.generated_questions.sections" :key="index">
                                    <template v-if="section.questions.length > 0">

                                        <td class="dark:border-darkmode-400 whitespace-nowrap">
                                            <div class="flex font-medium">Q&nbsp;{{ parseInt(index) + 1 }}.&nbsp;{{ section.name }}</div>
                                            <div class="text-right font-medium">({{ section.total_marks}})</div>

                                            <table class="border-none w-full ">
                                                <tr v-for="(question, qidx) in section.questions" :key="qidx">
                                                    <td  class="border-none whitespace-nowrap">{{ qidx + 1}})&nbsp;{{ question.question }}
                                                        <table class="w-full border-none">
                                                            <tr v-for="(answer, aidx) in question.answers" :key="aidx">
                                                                <td class="border-none whitespace-nowrap">
                                                                    {{aidx + 1}})&nbsp;
                                                                    <template v-if="isOnline">
                                                                            <input
                                                                                v-if="question.type_id == 1 || question.type_id == 3"
                                                                                :id="`is_correct-`+index"
                                                                                type="radio"
                                                                                class="form-check-input"                                                                            />
                                                                            <input
                                                                                v-if="question.type_id == 2"
                                                                                :id="`is_correct-`+index"
                                                                                type="checkbox"
                                                                                class="form-check-input"
                                                                            />
                                                                            {{answer.answer}}
                                                                    </template>
                                                                    <template v-else>{{answer.answer}}<template v-if="answer.is_correct">
                                                                        <div class="ml-5 btn btn-success">Correct Answer</div>
                                                                    </template></template>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-full border-none whitespace-nowrap bg-primary/80 box text-white flex items-center mb-2 mt-2">
                                                                    <span class="font-medium ">{{ t("questions.Note/Explanation") }}</span> :&nbsp;{{ question.note }}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>

                                                </tr>
                                            </table>
                                        </td>
                                    </template>
                                </tr>
                            </template>
                            <template v-else>
                                <tr v-for="(question, index) in model.generated_questions.questions" :key="index">
                                    <td>{{ question.question }}</td>
                                </tr>
                            </template>
                        </table>
                    </div>
                </div>
            </div>
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
const warningModalPreview = ref(false);
const isOnline = ref(false);

const model = ref({
    id: "",
    name: "",
    subject_id: "",
    chapter_id: "",
    topic_id: "",
    difficulty_level_id: "",
    is_auto: true,
    template_id: route.params.id,
    template : {},
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

async function fetchQuestions(section, index)  {
    if (!model.value.subject_id) {
        warningModalPreview.value = true;
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
    let url = "paper_generation="+true
        +"&board_id="+boardId.value
        +"&standard_id="+standardId.value
        +"&subject_id="+model.value.subject_id
        +"&chapter_id="+model.value.chapter_id
        +"&topic_id="+model.value.topic_id
        +"&difficulty_level_id="+model.value.difficulty_level_id
        +"&type_id="+typeId
        +"&limit="+ limit;

    const result = await axiosClient.get("/questions?"+ url);

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
                requiredIf(() => { return !template.value.has_section })
            ),
        },
        subject_id: {
            required: helpers.withMessage("Please select subject.", required),
        },
    };
});
const v$ = useVuelidate(rules, model);

async function submitForm(pre) {

    submitted.value = true;
    v$.value.$validate(); // checks all inputs

    if (!v$.value.$error) {
        isLoading.value = true;
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
                    router.push({ name: "GeneratedQuestionPapers" });
                })
                .catch((err) => {
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

function removeQuestion(question, sectionIndex, questionIndex) {
    if (template.value.has_section) {
        model.value.generated_questions.sections[sectionIndex].questions = model.value.generated_questions.sections[sectionIndex].questions.filter((q) => q !== question);
    } else {
        model.value.generated_questions = model.value.generated_questions.filter((q) => q !== question);
    }
}

function upperCaseFirst(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}
</script>

<style scoped>

</style>
