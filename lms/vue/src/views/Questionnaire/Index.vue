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
                                            <div class="ml-auto">
                                                <Tippy
                                                    tag="div"
                                                    class="report-box__indicator bg-success cursor-pointer"
                                                    content="33% Higher than last month"
                                                >
                                                    33%
                                                    <ChevronUpIcon class="w-4 h-4 ml-0.5" />
                                                </Tippy>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-medium leading-8 mt-6">4.710</div>
                                        <div class="text-base text-slate-500 mt-1">{{ t("templates.Question Paper Formats") }}</div>
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
                                            <div class="ml-auto">
                                                <Tippy
                                                    tag="div"
                                                    class="report-box__indicator bg-danger cursor-pointer"
                                                    content="2% Lower than last month"
                                                >
                                                    2%
                                                    <ChevronDownIcon class="w-4 h-4 ml-0.5" />
                                                </Tippy>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-medium leading-8 mt-6">3.721</div>
                                        <div class="text-base text-slate-500 mt-1">{{ t("templates.Generated Question Papers") }}</div>
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
                    <!-- BEGIN: Transactions -->
                    <div
                        class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12 mt-3 2xl:mt-8"
                    >
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">Transactions</h2>
                        </div>
                        <div class="mt-5">
                            <div
                                v-for="(faker, fakerKey) in $_.take($f(), 5)"
                                :key="fakerKey"
                                class="intro-x"
                            >
                                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                    <div
                                        class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden"
                                    >
                                        <img
                                            alt="Midone Tailwind HTML Admin Template"
                                            :src="faker.photos[0]"
                                        />
                                    </div>
                                    <div class="ml-4 mr-auto">
                                        <div class="font-medium">
                                            {{ faker.users[0].name }}
                                        </div>
                                        <div class="text-slate-500 text-xs mt-0.5">
                                            {{ faker.dates[0] }}
                                        </div>
                                    </div>
                                    <div
                                        :class="{
                      'text-success': faker.trueFalse[0],
                      'text-danger': !faker.trueFalse[0],
                    }"
                                    >
                                        {{ faker.trueFalse[0] ? "+" : "-" }}${{ faker.totals[0] }}
                                    </div>
                                </div>
                            </div>
                            <a
                                href=""
                                class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500"
                            >View More</a
                            >
                        </div>
                    </div>
                    <!-- END: Transactions -->
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, provide } from "vue";
import {useI18n} from "vue-i18n";

const {t} = useI18n();

</script>
