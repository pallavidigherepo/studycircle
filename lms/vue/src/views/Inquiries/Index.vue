<template>
    <div>
        <template v-if="listing">
            <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    {{ t("inquiries.Inquiries") }}
                </h2>
            </div>
            <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
                <!-- BEGIN: Datatable Content -->
                <div class="intro-y col-span-12 lg:col-span-12">
                    <!-- BEGIN: HTML Table Data -->

                    <div class="intro-y box p-5">
                        <div class="overflow-x-auto scrollbar-hidden">
                            <div class="grid grid-cols-12 gap-6 mt-5">
                                <div class="
                                    intro-y
                                    col-span-12
                                    flex flex-wrap
                                    sm:flex-nowrap
                                    items-center
                                    mt-2
                                  ">

                                    <router-link to="/inquiries/create" class="btn btn-primary shadow-md mr-2"
                                            @click.prevent="add">
                                        {{ t("common.Add New") }}
                                    </router-link>
                                    <div class="dropdown">
                                        <button aria-expanded="false" class="dropdown-toggle btn btn-primary ml-2"
                                                data-tw-toggle="dropdown">
                                              <span class="flex items-center justify-center">
                                                {{ t("common.Export/Print") }}&nbsp;
                                                <DownloadIcon class="w-4 h-4"/>
                                              </span>
                                        </button>
                                        <div class="dropdown-menu w-40">
                                            <ul class="dropdown-content">
                                                <!-- <li>
                                                    <a href="javascript:;" class="dropdown-item">
                                                        <PrinterIcon class="w-4 h-4 mr-2" />
                                                        {{ t("permissions.Print") }}
                                                    </a>
                                                    </li> -->
                                                <li>
                                                    <a class="dropdown-item" href="javascript:;"
                                                       @click.prevent="exportMe('xlsx')">
                                                        <FileTextIcon class="w-4 h-4 mr-2"/>
                                                        {{ t("common.Export to Excel") }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:;"
                                                       @click.prevent="exportMe('csv')">
                                                        <FileTextIcon class="w-4 h-4 mr-2"/>
                                                        {{ t("common.Export to CSV") }}
                                                    </a>
                                                </li>
                                                <!-- <li>
                                                    <a
                                                        href="javascript:;"
                                                        class="dropdown-item"
                                                        @click.prevent="exportMe('pdf')"
                                                    >
                                                        <FileTextIcon class="w-4 h-4 mr-2" />
                                                        {{ t("permissions.Export to PDF") }}
                                                    </a>
                                                    </li> -->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button aria-expanded="false" class="dropdown-toggle btn btn-primary ml-2"
                                                data-tw-toggle="dropdown">
                                      <span class="flex items-center justify-center">
                                        {{ t("common.Import") }}&nbsp;
                                        <UploadIcon class="w-4 h-4"/>
                                      </span>
                                        </button>
                                        <div class="dropdown-menu w-40">
                                            <ul class="dropdown-content">
                                                <li>
                                                    <a class="dropdown-item" href="#" @click.prevent="openModal">
                                                        <FileTextIcon class="w-4 h-4 mr-2"/>
                                                        {{ t("common.CSV/Excel") }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="hidden md:block mx-auto text-slate-500">
                                        <!-- {{ t(module+".Showing") }} {{ permissions.from }}
                                            {{ t(module+".to") }} {{ permissions.to }}
                                            {{ t(module+".of") }} {{ permissions.total }}
                                            {{ t(module+".entries") }} -->
                                    </div>
                                    <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                                        <div class="w-56 relative text-slate-500">
                                            <input v-model="search" :placeholder="t('common.Search') + '...'"
                                                   class="form-control w-56 pr-10 w-full"
                                                   type="text" @keyup="searchMe($event)"/>
                                            <SearchIcon class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: HTML Table Data -->
                </div>
                <!-- END: Datatable Content -->
            </div>
        </template>
        <template v-else>
            <router-view></router-view>
        </template>
    </div>
</template>

<script setup>
import {ref, onMounted, computed, watch} from "vue";
import {useI18n} from "vue-i18n";
import {useRoute, useRouter} from "vue-router";
import store from "@/stores";

const route = useRoute();
const router = useRouter();

const {t} = useI18n();
const listing = ref(true);
onMounted(() => {
    if (
        route.name === "CreateInquiry" ||
        route.name === "EditInquiry" ||
        route.name === "ShowInquiry"
    ) {
        listing.value = false;
    }
});
watch(
    () => route.name,
    (to, from) => {
        if (to === "Inquiries") {
            listing.value = true;
        }
    }
);
</script>

<style scoped>

</style>
