<template>
    <!-- BEGIN: General Report -->
    <div class="col-span-12 mt-8">
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">{{ t("dashboard.General Report") }}</h2>
            <router-link :to="{name: 'Dashboard'}" class="ml-auto flex items-center text-primary">
                <RefreshCcwIcon class="w-4 h-4 mr-3" /> Reload Data
            </router-link>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <ShoppingCartIcon class="report-box__icon text-primary" />
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
                        <div class="text-base text-slate-500 mt-1">{{ t("dashboard.International Students") }}</div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <CreditCardIcon class="report-box__icon text-pending" />
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
                        <div class="text-base text-slate-500 mt-1">{{ t("dashboard.Play School Students") }}</div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <MonitorIcon class="report-box__icon text-warning" />
                            <div class="ml-auto">
                                <Tippy
                                    tag="div"
                                    class="report-box__indicator bg-success cursor-pointer"
                                    content="12% Higher than last month"
                                >
                                    12% <ChevronUpIcon class="w-4 h-4 ml-0.5" />
                                </Tippy>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">2.149</div>
                        <div class="text-base text-slate-500 mt-1">
                            {{ t("dashboard.International Teachers") }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <UserIcon class="report-box__icon text-success" />
                            <div class="ml-auto">
                                <Tippy
                                    tag="div"
                                    class="report-box__indicator bg-success cursor-pointer"
                                    content="22% Higher than last month"
                                >
                                    22% <ChevronUpIcon class="w-4 h-4 ml-0.5" />
                                </Tippy>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">152.040</div>
                        <div class="text-base text-slate-500 mt-1">
                            {{ t("dashboard.International Teachers") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: General Report -->
</template>

<script setup>
import {useI18n} from "vue-i18n";

const { t } = useI18n();
</script>

<style scoped>

</style>
