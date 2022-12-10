<!--suppress ALL -->
<template>
    <div>
        <template v-if="listing">
            <h2 class="intro-y text-lg font-medium mt-10">{{ t("inquiries.Inquiries") }}</h2>
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div
                    class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2"
                >
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
                <!-- BEGIN: Data List -->
                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <table class="table table-report -mt-2">
                        <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">{{ t("inquiries.CODE") }}</th>
                            <th class="text-center whitespace-nowrap">{{ t("inquiries.BATCH AND STANDARD") }}</th>
                            <th class="text-center whitespace-nowrap">{{ t("inquiries.DATE") }}</th>
                            <th class="text-center whitespace-nowrap">{{ t("inquiries.MOBILE") }}</th>
                            <th class="text-center whitespace-nowrap">{{ t("inquiries.STATUS") }}</th>
                            <th class="text-center whitespace-nowrap">{{ t("inquiries.ASSIGNED TO") }}</th>
                            <th class="text-center whitespace-nowrap">{{ t("common.ACTIONS") }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="(item, index) in items.data"
                            :key="index"
                            class="intro-x"
                        >
                            <td>
                                <div class="flex">
                                    {{ index + 1}}
                                </div>
                            </td>
                            <td>
                                <div class="text-slate-500 whitespace-nowrap">
                                    {{ item.unique_code }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap">
                                <span class="font-medium whitespace-nowrap">{{ item.batch }}</span>
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">
                                    {{ item.standard }}
                                </div>
                            </td>
                            <td class="text-center">{{ item.inquiry_date }}</td>
                            <td class="text-center">
                                <a :href="'tel:'+item.contact_mobile">
                                    <div
                                        class="flex items-center justify-center"
                                        >
                                        <PhoneIcon class="w-4 h-4 mr-2" />{{ item.contact_mobile }}
                                    </div>
                                </a>
                            </td>
                            <td class="w-40">
                                <div
                                    class="flex items-center justify-center"
                                >
                                    <button v-if="item.status == 'Open'" class="btn btn-danger-soft w-32 mr-2 mb-2">
                                        {{ item.status }}
                                    </button>

                                    <button v-if="item.status == 'Close'" class="btn btn-success w-32 mr-2 mb-2">
                                        {{ item.status }}
                                    </button>
                                    <button v-if="item.status == 'Waiting for Response'" class="btn btn-pending-soft w-32 mr-2 mb-2">
                                        {{ item.status }}
                                    </button>
                                    <button v-if="item.status == 'Accepted'" class="btn btn-primary w-32 mr-2 mb-2">
                                        {{ item.status }}
                                    </button>
                                    <button v-if="item.status == 'Rejected'" href="" class="btn btn-dark w-32 mr-2 mb-2">
                                        {{ item.status }}
                                    </button>
                                </div>
                            </td>
                            <td class="text-center">
                                <div
                                    class="flex items-center justify-center"
                                >
                                    <UserIcon class="w-4 h-4 mr-1" />{{ item.assigned }}
                                </div>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a href="javascript:;"
                                       class="flex items-center text-warning mr-2"
                                       @click.prevent="showFollowups(item)"
                                    >
                                        <MessageCircleIcon class="w-4 h-4 mr-1" />{{ t("inquiries.Comment") }}
                                    </a>

                                    <router-link :to="{ name: 'ShowInquiry', params: { id: item.id } }"
                                                 class="flex items-center text-primary mr-2">
                                        <EyeIcon class="w-4 h-4 mr-1"/>{{ t("common.Show") }}
                                    </router-link>
                                    <router-link :to="{ name: 'EditInquiry', params: { id: item.id } }"
                                                 class="flex items-center text-success mr-2">
                                        <Edit3Icon class="w-4 h-4 mr-1" />
                                        {{ t("common.Edit") }}
                                    </router-link>
                                    <a class="flex items-center text-danger"
                                       href="javascript:;"
                                       @click.prevent="deleteI(item)">
                                        <Trash2Icon class="w-4 h-4 mr-1"/>
                                        {{ t("common.Delete") }}
                                    </a>
<!--                                    <Dropdown>-->
<!--                                        <DropdownToggle tag="a" class="w-5 h-5 block" href="javascript:;">-->
<!--                                            <MoreHorizontalIcon class="w-5 h-5 text-slate-500" />-->
<!--                                        </DropdownToggle>-->
<!--                                        <DropdownMenu class="w-40">-->
<!--                                            <DropdownContent>-->
<!--                                                <DropdownItem>-->
<!--                                                    <MessageCircleIcon class="w-4 h-4 mr-2" />{{ t("inquiries.Add Comment") }}-->
<!--                                                </DropdownItem>-->
<!--                                                <DropdownItem>-->
<!--                                                    <router-link :to="{ name: ShowInquiry, params: { id: item.id } }" class="flex">-->
<!--                                                        <EyeIcon class="w-4 h-4 mr-2"/>{{ t("inquiries.View Details") }}-->
<!--                                                    </router-link>-->
<!--                                                </DropdownItem>-->
<!--                                                <DropdownItem>-->
<!--                                                    <router-link :to="{ name: EditInquiry, params: { id: item.id } }" class="flex">-->
<!--                                                        <Edit2Icon class="w-4 h-4 mr-2" />-->
<!--                                                    {{ t("common.Edit") }}-->
<!--                                                    </router-link>-->
<!--                                                </DropdownItem>-->
<!--                                                <DropdownItem>-->
<!--                                                    <TrashIcon class="w-4 h-4 mr-2" /> {{ t("common.Delete") }}-->
<!--                                                </DropdownItem>-->
<!--                                            </DropdownContent>-->
<!--                                        </DropdownMenu>-->
<!--                                    </Dropdown>-->
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END: Data List -->

                <!-- BEGIN: Pagination -->

                <Pagination
                    :currentPage="currentPage"
                    :links="links"
                    @paginate="getForPage"
                    @perpage="perPageValue"/>
                <!-- END: Pagination -->
            </div>

            <!-- BEGIN: Modal Content -->
            <Modal :show="headerFooterModalPreview"
                   size="modal-lg"
                   @hidden="headerFooterModalPreview = false">
                <ModalHeader>
                    <h2 class="font-medium text-base mr-auto">
                        {{ t("common.Import as CSV/Excel") }}
                    </h2>
                </ModalHeader>
                <CustomeAlert v-if="responseMessage"
                              :errors="responseErrors"
                              :message="responseMessage"
                              :status="responseStatus"
                              class="col-span-12 sm:col-span-6 flex"/>
                <ModalBody class="grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-12 text-center">
                        <slot name="info"></slot>
                        <div class="upload-btn-wrapper">
                            <button class="upload-btn">{{
                                    t("common.Upload file")
                                }}
                            </button>
                            <input id="modal-form-1" name="myfile" type="file" @change="importMe($event)"/>
                        </div>
                        <div class="col-span-12">
                            <div
                                class="alert alert-outline-warning alert-dismissible bg-warning/20 dark:bg-darkmode-400 dark:border-darkmode-400 mt-5 show"
                                role="alert" style="display: block;">

                                <div class="flex items-center"><span><svg class="lucide w-6 h-6 mr-3" fill="none"
                                                                          height="24"
                                                                          stroke="currentColor" stroke-linecap="round"
                                                                          stroke-linejoin="round" stroke-width="2"
                                                                          viewBox="0 0 24 24"
                                                                          width="24"
                                                                          xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z">
                    </path>
                    <line x1="12" x2="12" y1="9" y2="13"></line>
                    <line x1="12" x2="12.01" y1="17" y2="17"></line>
                  </svg></span><span class="text-slate-800 dark:text-slate-500">Supports CSV and Excel files.</span>

                                </div>
                            </div>

                            <div class="grid grid-cols-6 gap-6 mt-5">
                                <div class="col-span-6 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-4">
                                            <div class="flex text-center justify-center">

                                                <div class="">
                                                    <DownloadCloudIcon class="w-10 h-10 ml-0.5"/>
                                                </div>
                                            </div>
                                            <div class="text-base text-slate-500 mt-1">
                                                <button class="btn btn-primary h-20"
                                                        @click.prevent="exportMe('xlsx', true)">
                                                    {{ t('common.Download Template for EXCEL') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-6 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex text-center justify-center">

                                                <div class="">
                                                    <DownloadCloudIcon class="w-10 h-10 ml-0.5"/>
                                                </div>
                                            </div>
                                            <div class="text-base text-slate-500 mt-1">
                                                <button class="btn btn-primary h-20"
                                                        @click.prevent="exportMe('csv', true)">
                                                    {{ t('common.Download Template for CSV') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </ModalBody>
                <ModalFooter>
                    <button id="import-export-cancel-button"
                            class="btn btn-outline-secondary w-20 mr-1"
                            type="button"
                            @click="headerFooterModalPreview = false">
                        {{ t("common.Cancel") }}
                    </button>
                    <!-- <button type="button" class="btn btn-primary w-20">
                        {{ t("permissions.Import") }}
                        </button> -->
                </ModalFooter>
            </Modal>
            <!-- END: Modal Content -->
            <Loading v-if="loading" fixed></Loading>
            <inquiry-followups v-if="isFollowupCalled"
                               v-model="showFollowupValue"
                               :inquiryId="inquiryId"
                               :inquiryStatusId="inquiryStatusId" />
        </template>
        <template v-else>
            <router-view></router-view>
        </template>

    </div>

</template>
<script setup>
import {ref, onMounted, computed, watch, reactive} from "vue";
import {useI18n} from "vue-i18n";
import {useRoute, useRouter} from "vue-router";
import store from "@/stores";
import InquiryFollowups from "@/components/Inquiries/Followups.vue";
import _ from "lodash";

const route = useRoute();
const router = useRouter();

const headerFooterModalPreview = ref(false);
const {t} = useI18n();
const listing = ref(true);
const search = ref("");
const loading = ref(false);
const isFollowupCalled = ref(false);
onMounted(() => {
    if (
        route.name === "CreateInquiry" ||
        route.name === "EditInquiry" ||
        route.name === "ShowInquiry"
    ) {
        listing.value = false;
    } else {
        listing.value = true;
        fetchList();
    }
});
function fetchList() {
    loading.value = true;
    store
        .dispatch("inquiries/list", {url: url.value})
        .then(() => {
            loading.value = false;
        })
        .catch();
}

const noRecords = ref(false);
const datatableoptions = computed(
    () => store.getters["inquiries/datatable"]
);
const items = computed(() => {
    let records = store.getters["inquiries/inquiries"];

    if (records.data && parseInt(records.data.length) < 1) {
        noRecords.value = true;
    }
    return records;
});

const links = computed(() => store.getters["inquiries/meta"]);
const currentPage = ref(datatableoptions.value.defaultPage);

const perPageOptions = [10, 20, 30, 40, 50];
const urlParams = reactive({
    column: datatableoptions.value.defaultColumn,
    order: datatableoptions.value.defaultOrder,
    page: datatableoptions.value.defaultPage,
    search: datatableoptions.value.defaultSearch,
    perpage: datatableoptions.value.defaultPerPage,
});

const url = ref(
    "?page=" +
    urlParams.page +
    "&sort_field=" +
    urlParams.column +
    "&sort_order=" +
    urlParams.order +
    "&search=" +
    urlParams.search +
    "&per_page=" +
    urlParams.perpage
);

// Watch to current url parameters change and when this happens we update local url
watch(
    () => _.cloneDeep(urlParams),
    (newVal, oldVal) => {
        url.value =
            "?page=" +
            urlParams.page +
            "&sort_field=" +
            urlParams.column +
            "&sort_order=" +
            urlParams.order +
            "&search=" +
            urlParams.search +
            "&per_page=" +
            urlParams.perpage;
        fetchList();
    }
);


function getForPage(page) {
    if (page === "Next &raquo;") {
        urlParams.page = parseInt(urlParams.page) + 1;
    } else if (page === "&laquo; Previous" && parseInt(urlParams.page) > 1) {
        urlParams.page = parseInt(urlParams.page) - 1;
    } else {
        urlParams.page = page;
    }
}

function perPageValue(value) {
    urlParams.perpage = value;
}

watch(
    () => route.name,
    (to, from) => {
        if (to === "Inquiries") {
            listing.value = true;
            fetchList();
        } else {
            listing.value = false;
        }
    }
);

function add() {
    listing.value = false;
    router.push({ name: "CreateInquiry" });
}

function deleteI(item) {
    store.dispatch("inquiries/delete", item.id);
}

function searchMe()
{

}
function openModal() {
    //import_file.value = '';
    headerFooterModalPreview.value = true;
    responseMessage.value = "";
    responseStatus.value = false;
}
const showFollowupValue = ref(false);
const inquiryId = ref("");
const inquiryStatusId = ref("");
function showFollowups(item)
{
    isFollowupCalled.value = true;
    showFollowupValue.value = true;
    inquiryId.value = item.id;
    inquiryStatusId.value = item.inquiry_status_id;
}
</script>

<style scoped>

</style>
