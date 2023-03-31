<template>
    <div>
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{ t("fees.Fees") }}
            </h2>
        </div>
        <div class="pos intro-y grid grid-cols-12 gap-6 mt-5">
            <!-- BEGIN: Fee Content -->
            <div class="intro-y col-span-12 lg:col-span-12">
                <!-- BEGIN: HTML Table Data -->

                <div class="intro-y box p-5">
                    <div class="overflow-x-auto scrollbar-hidden">
                        <div class="w-full grid grid-cols-12 gap-6 mt-5">
                            <div class="intro-y
                                    col-span-12
                                    flex flex-wrap
                                    sm:flex-nowrap
                                    items-center
                                    mt-2">
                                <div v-if="datatableoptions.export" class="dropdown">
                                    <button aria-expanded="false" class="dropdown-toggle btn btn-primary ml-2" data-tw-toggle="dropdown">
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
                                                <a class="dropdown-item" href="javascript:;" @click.prevent="exportMe('xlsx')">
                                                    <FileTextIcon class="w-4 h-4 mr-2"/>
                                                    {{ t("common.Export to Excel") }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:;" @click.prevent="exportMe('csv')">
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
                                <div v-if="datatableoptions.import" class="dropdown">
                                    <button aria-expanded="false" class="dropdown-toggle btn btn-primary ml-2" data-tw-toggle="dropdown">
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
                            </div>
                            <div class="
                                    intro-y
                                    col-span-12
                                    flex flex-wrap
                                    sm:flex-nowrap
                                    items-center
                                    mt-2
                                  ">
                                <h2><FilterIcon></FilterIcon></h2>
                                <div class="md:block mx-auto text-slate-500">
                                    <div class="grid grid-cols-12 gap-6">
                                        <div class="col-span-3 flex flex-wrap md:block mx-auto">
                                            <TomSelect id="form-batch"
                                                       v-model="model.batch_id"
                                                       :options="{
                                                            allowEmptyOption: false,
                                                            create: false,
                                                            placeholder: 'All Standard',
                                                            autocomplete: 'off',
                                                       }"
                                                       class="w-56"
                                                       placeholder="Select Batch">
                                                <option>{{ t('fees.All Batches') }}</option>
                                                <option v-for="(standard, indexs) in standards" :key="indexs" :value="indexs">
                                                    {{ standard }}
                                                </option>
                                            </TomSelect>
                                        </div>
                                        <div class="col-span-3 flex flex-wrap md:block mx-auto">
                                            <TomSelect id="form-standard"
                                                       v-model="model.standard_id"
                                                       :options="{
                                                            allowEmptyOption: false,
                                                            create: false,
                                                            placeholder: 'All Standard',
                                                            autocomplete: 'off',
                                                       }"
                                                       class="w-56"
                                                       placeholder="Select Standard">
                                                <option>{{ t('fees.All Standards') }}</option>
                                                <option v-for="(standard, indexs) in standards" :key="indexs" :value="indexs">
                                                    {{ standard }}
                                                </option>
                                            </TomSelect>
                                        </div>
                                        <div class="col-span-3 flex flex-wrap md:block mx-auto">
                                            <TomSelect id="form-fee-type"
                                                       v-model="model.fee_type_id"
                                                       :options="{
                                                            allowEmptyOption: false,
                                                            create: false,
                                                            placeholder: 'All Fee Types',
                                                            autocomplete: 'off',
                                                       }"
                                                       class="w-56"
                                                       placeholder="Select Fee Type">
                                                <option>{{ t('fees.All Fee Types') }}</option>
                                                <option v-for="(feeType, indexs) in feeTypes" :key="indexs" :value="indexs">
                                                    {{ feeType }}
                                                </option>
                                            </TomSelect>
                                        </div>
                                        <div class="col-span-3 flex flex-wrap">
                                            <input v-model="model.student_name"
                                                   :placeholder="t('fees.Student Name') + '...'"
                                                   class="form-control w-56 pr-10 w-full mr-5"
                                                   type="text" @keyup="searchMe($event)"/>
                                            <SearchIcon class="w-4 h-4 absolute my-auto inset-y-0 mr-1 right-0"/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- BEGIN: Data List -->
                            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                                <table class="table table-hover mt-2">
                                    <thead>
                                    <tr>
                                        <th class="uppercase whitespace-nowrap" scope="col"
                                            :class="{ 'table-report__action w-56': !'id' }">
                                            <div class="flex items-center justify-between">
                                                {{ t("fees.ID") }}
                                                <span v-if="'id' === sortBy">
                                                  <ChevronUpIcon v-if="sortOrder === 'asc'" class="w-4 h-4 text-gray-400"></ChevronUpIcon>
                                                  <ChevronDownIcon v-else class="w-4 h-4 text-gray-400"></ChevronDownIcon>
                                                </span>
                                            </div>
                                        </th>
                                        <th class="uppercase whitespace-nowrap" scope="col"
                                            :class="{ 'table-report__action w-56': !'batch_id' }">
                                            <div class="flex items-center justify-between">
                                                {{ t("fees.STUDENT") }}
                                                <span v-if="'student' === sortBy">
                                                  <ChevronUpIcon v-if="sortOrder === 'asc'" class="w-4 h-4 text-gray-400"></ChevronUpIcon>
                                                  <ChevronDownIcon v-else class="w-4 h-4 text-gray-400"></ChevronDownIcon>
                                                </span>
                                            </div>
                                        </th>
                                        <th class="uppercase whitespace-nowrap" scope="col"
                                            :class="{ 'table-report__action w-56': !'batch_id' }">
                                            <div class="flex items-center justify-between">
                                                {{ t("fees.BATCH") }}
                                                <span v-if="'batch_id' === sortBy">
                                                  <ChevronUpIcon v-if="sortOrder === 'asc'" class="w-4 h-4 text-gray-400"></ChevronUpIcon>
                                                  <ChevronDownIcon v-else class="w-4 h-4 text-gray-400"></ChevronDownIcon>
                                                </span>
                                            </div>
                                        </th>
                                        <th class="uppercase whitespace-nowrap" scope="col"
                                            :class="{ 'table-report__action w-56': !'batch_id' }">
                                            <div class="flex items-center justify-between">
                                                {{ t("fees.STANDARD") }}
                                                <span v-if="'standard' === sortBy">
                                                  <ChevronUpIcon v-if="sortOrder === 'asc'" class="w-4 h-4 text-gray-400"></ChevronUpIcon>
                                                  <ChevronDownIcon v-else class="w-4 h-4 text-gray-400"></ChevronDownIcon>
                                                </span>
                                            </div>
                                        </th>
                                        <th class="uppercase whitespace-nowrap" scope="col"
                                            :class="{ 'table-report__action w-56': !'batch_id' }">
                                            <div class="flex items-center justify-between">
                                                {{ t("fees.FEE TYPE") }}
                                                <span v-if="'fee_type' === sortBy">
                                                  <ChevronUpIcon v-if="sortOrder === 'asc'" class="w-4 h-4 text-gray-400"></ChevronUpIcon>
                                                  <ChevronDownIcon v-else class="w-4 h-4 text-gray-400"></ChevronDownIcon>
                                                </span>
                                            </div>
                                        </th>
                                        <th class="uppercase whitespace-nowrap" scope="col"
                                            :class="{ 'table-report__action w-56': !'batch_id' }">
                                            <div class="flex items-center justify-between">
                                                {{ t("fees.AMOUNT") }}
                                                <span v-if="'amount' === sortBy">
                                                  <ChevronUpIcon v-if="sortOrder === 'asc'" class="w-4 h-4 text-gray-400"></ChevronUpIcon>
                                                  <ChevronDownIcon v-else class="w-4 h-4 text-gray-400"></ChevronDownIcon>
                                                </span>
                                            </div>
                                        </th>
                                        <th class="uppercase whitespace-nowrap" scope="col"
                                            :class="{ 'table-report__action w-56': !'batch_id' }">
                                            <div class="flex items-center justify-between">
                                                {{ t("fees.BALANCE") }}
                                                <span v-if="'balance' === sortBy">
                                                  <ChevronUpIcon v-if="sortOrder === 'asc'" class="w-4 h-4 text-gray-400"></ChevronUpIcon>
                                                  <ChevronDownIcon v-else class="w-4 h-4 text-gray-400"></ChevronDownIcon>
                                                </span>
                                            </div>
                                        </th>
                                        <th class="uppercase whitespace-nowrap" scope="col"
                                            :class="{ 'table-report__action w-56': !'batch_id' }">
                                            <div class="flex items-center justify-between">
                                                {{ t("fees.STATUS") }}
                                                <span v-if="'status' === sortBy">
                                                  <ChevronUpIcon v-if="sortOrder === 'asc'" class="w-4 h-4 text-gray-400"></ChevronUpIcon>
                                                  <ChevronDownIcon v-else class="w-4 h-4 text-gray-400"></ChevronDownIcon>
                                                </span>
                                            </div>
                                        </th>
                                        <th class="uppercase whitespace-nowrap" scope="col"
                                            :class="{ 'table-report__action w-56': !'batch_id' }">
                                            <div class="flex items-center justify-between">
                                                {{ t("fees.ACTION") }}
                                            </div>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <template v-if="items">
                                        <tr v-for="(item, index) in items.data"
                                            :key="index"
                                            class="intro-x">
                                            <td class="whitespace-nowrap">
                                                <div class="flex items-center">
                                                    {{ item.id}}
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap">
                                                <div class="flex items-center">
                                                    {{ item.student}}
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap">
                                                <div class="flex items-center">
                                                    {{ item.batch}}
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap">
                                                <div class="flex items-center">
                                                    {{ item.standard}}
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap">
                                                <div class="flex items-center">
                                                    {{ item.fee_type}}
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap">
                                                <div class="flex items-center">
                                                    {{ item.amount_to_pay}}
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap">
                                                <div class="flex items-center">
                                                    {{ item.balance}}
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap">
                                                <div class="flex items-center">
                                                    {{ item.status}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex items-center">
                                                    <a class="flex items-center mr-3" href="javascript:;"
                                                       @click.prevent="showMe(item)">
                                                        <EyeIcon class="w-4 h-4 mr-1"/>
                                                        {{ t("common.Show") }}
                                                    </a>
                                                    <a class="flex items-center mr-3" href="javascript:;"
                                                       @click.prevent="editMe(item)">
                                                        <CheckSquareIcon class="w-4 h-4 mr-1"/>
                                                        {{ t("common.Edit") }}
                                                    </a>
                                                    <a class="flex items-center text-danger"
                                                       href="javascript:;"
                                                       @click.prevent="emit('deleteItem', item)">
                                                        <Trash2Icon class="w-4 h-4 mr-1"/>
                                                        {{ t("common.Delete") }}
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>

                                    </tbody>
                                    <template v-if="items">
                                        <tbody v-if="noRecords && !items.data.length">
                                        <tr class="intro-x bg-secondary">
                                            <td colspan="8" class="text-center">
                                                {{ t("common.Sorry, no records found") }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </template>


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

                        </div>
                    </div>
                </div>
                <!-- END: HTML Table Data -->
            </div>
            <!-- END: Fee Content -->
        </div>
    </div>
</template>

<script setup>
import {ref, onMounted, computed, reactive, watch} from "vue";

import { useVuelidate } from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators";

import store from "@/stores";

import { useI18n } from "vue-i18n";
import _ from "lodash";

// To show/hide modal

const options = {
    modelName: "FeeDiscount",
};

const { t } = useI18n();

// End of info

// Variables and actions related to Add/Edit.
let isEdit = ref(false);
let actionText = ref("Add");
let submitted = ref(false);
let message = ref("");
let isErrored = ref(false);
let selectedItem = ref("");

let model = ref({
    batch_id: "",
    standard_id: "",
    fee_type_id: "",
    student_name: "",
});

/*
const rules = computed(() => {
    return {
        name: {
            required: helpers.withMessage(
                "Please enter name.",
                required
            ),
        },
        amount: {
            required: helpers.withMessage(
                "Please enter amount.",
                required
            ),
        },
        expiry_date: {
            required: helpers.withMessage(
                "Please enter expiry date.",
                required
            )
        }
    };
});

const v$ = useVuelidate(rules, model);
*/

async function submitForm(event) {
    submitted.value = true;
    v$.value.$validate(); // checks all inputs

    if (!v$.value.$error) {
        //loading.value = true;

        await store
            .dispatch("fee_discounts/save", model.value)
            .then(() => {
                // After dispatch, we have to reset the model value
                if (!isEdit.value) {
                    model.value = JSON.parse(JSON.stringify(model));
                }
                isErrored.value = false;
                message.value = "";
                submitted.value = false;
                event.target.reset();
            })
            .catch((err) => {
                isErrored.value = true;
                if (err.response) {
                    message.value = err.response.data.message;
                }

            });

        //loading.value = false;
    } else {
        // if ANY fail validation

        return;
    }
}
// Begin: Edit item
function edit(item) {
    actionText.value = "Edit";
    isEdit.value = true;
    selectedItem.value = item.id;
    model.value = JSON.parse(JSON.stringify(item));
    //model.value.name = JSON.parse(item.name);
}
// End: Edit item

// Begin: Cancel editting
function cancel() {
    actionText.value = "Add";
    isEdit.value = false;
    selectedItem.value = "";
    model.value = JSON.parse(JSON.stringify(model));
}
// End: Cancel editing

// BEGIN: Delete
function deleteI(item) {
    store.dispatch("fee_discounts/delete", item.id);
}
// END: Delete
const noRecords = ref(false);
const datatableoptions = computed(
    () => store.getters["fees/datatable"]
);

const items = computed(() => {
    let records = store.getters["fees/fees"];

    if (records.data && parseInt(records.data.length) < 1) {
        noRecords.value = true;
    }
    return records;
});

const links = computed(() => store.getters["fees/meta"]);
const currentPage = ref(datatableoptions.value.defaultPage);

const perPageOptions = [10, 20, 30, 40, 50];
const fetchUrl = ref("");
const loading = ref(false);

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

onMounted(() => {
    store.dispatch("listStandard").then().catch();
    store.dispatch("listFeeTypes").then().catch();
    fetchList();
});
const standards = computed(() => store.getters.listStandards);
const feeTypes = computed(() => store.getters.listFeeTypes);

function fetchList() {
    loading.value = true;
    /*if (props.showData) {
        url.value += "&item=" + props.showData;
    }*/
    store
        .dispatch("fees/list", {url: url.value})
        .then(() => {
            loading.value = false;
        })
        .catch();
}

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

// Begin: Sorting related
let sortBy = ref("id");
let sortOrder = ref("desc");

function sorting(field) {
    if (field === sortBy.value) {
        sortOrder.value = sortOrder.value === "asc" ? "desc" : "asc";
    } else {
        sortBy.value = field;
        sortOrder.value = "asc";
    }
    urlParams.column = sortBy.value;
    urlParams.order = sortOrder.value;
}

//End: Sorting

// Begin: Searching
const search = ref("");

function searchMe(event) {
    urlParams.search = search.value;
    //console.log(event)
}

// End: Searching
</script>

<style>
.active-row {
    background-color: lightgray;
}
</style>
