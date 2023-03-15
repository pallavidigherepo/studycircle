<template>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="
        intro-y
        col-span-12
        flex flex-wrap
        sm:flex-nowrap
        items-center
        mt-2
      ">
            <button v-if="datatableoptions.addNew" class="btn btn-primary shadow-md mr-2"
                    @click.prevent="emit('addModel', true)">
                {{ t("common.Add New") }}
            </button>
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
            <div class="hidden md:block mx-auto text-slate-500">
                <!-- {{ t(module+".Showing") }} {{ permissions.from }}
                    {{ t(module+".to") }} {{ permissions.to }}
                    {{ t(module+".of") }} {{ permissions.total }}
                    {{ t(module+".entries") }} -->
            </div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input v-model="search" :placeholder="t('common.Search') + '...'" class="form-control w-56 pr-10 w-full"
                           type="text" @keyup="searchMe($event)"/>
                    <SearchIcon class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0"/>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-hover mt-2">
                <thead>
                <tr>
                    <th v-for="(column, index) in datatableoptions.columns" :key="index"
                        :class="{ 'table-report__action w-56': !column.field }"
                        class="uppercase whitespace-nowrap" scope="col">
                        <template v-if="column.sort">
                            <a href="#" @click.prevent="sorting(column.field, sortOrder)">
                                <div class="flex items-center justify-between">
                                    <template v-if="column.label === 'ID' || column.label === 'ACTIONS'">{{
                                            t("common." + column.label)
                                        }}
                                    </template>
                                    <template v-else>{{
                                            t(module + "." + column.label)
                                        }}
                                    </template>

                                    <span v-if="column.field === sortBy">
                                      <ChevronUpIcon v-if="sortOrder === 'asc'" class="w-4 h-4 text-gray-400"></ChevronUpIcon>
                                      <ChevronDownIcon v-else class="w-4 h-4 text-gray-400"></ChevronDownIcon>
                                    </span>
                                </div>
                            </a>
                        </template>
                        <template v-else>
                            <template v-if="column.label === 'ID' || column.label === 'ACTIONS'">{{
                                    t("common." + column.label)
                                }}
                            </template>
                            <template v-else>{{ t(module + "." + column.label) }}</template>
                        </template>
                    </th>
                </tr>
                </thead>

                <tbody>
                <template v-if="items">
                    <tr v-for="(item, index) in items.data"
                        :key="index"
                        :class="{
                            'bg-secondary': item && item.id === selectedRow,
                        }"
                        class="intro-x">
                        <td v-for="(column, index) in datatableoptions.columns"
                            :key="index"
                            :class="{
                              'table-report__action w-56 items-center': !column.field,
                            }"
                            class="whitespace-nowrap">
                            <template v-if="!column.field">
                                <div class="flex items-center">
                                    <a v-if="column.actions.show" class="flex items-center mr-3" href="javascript:;"
                                       @click.prevent="showMe(item)">
                                        <EyeIcon class="w-4 h-4 mr-1"/>
                                        {{ t("common.Show") }}
                                    </a>
                                    <a v-if="column.actions.edit" class="flex items-center mr-3" href="javascript:;"
                                       @click.prevent="editMe(item)">
                                        <CheckSquareIcon class="w-4 h-4 mr-1"/>
                                        {{ t("common.Edit") }}
                                    </a>
                                    <a v-if="column.actions.delete" class="flex items-center text-danger"
                                       href="javascript:;"
                                       @click.prevent="emit('deleteItem', item)">
                                        <Trash2Icon class="w-4 h-4 mr-1"/>
                                        {{ t("common.Delete") }}
                                    </a>
                                </div>
                            </template>
                            <template v-else>
                                <template v-if="column.isJson">{{
                                        JSON.parse(item[column.field])
                                    }}
                                </template>
                                <template v-else-if="column.isImage">
                                    <div class="flex">
                                        <div class="w-12 h-12 zoom-in">
                                            <img
                                                :alt=item[column.field]
                                                :src=item[column.field]
                                                :content="`Uploaded at ${item[column.field]}`"
                                            />
                                        </div>
                                    </div>
                                </template>
                                <template v-else>{{ item[column.field] }}</template>
                            </template>
                        </td>
                    </tr>
                </template>

                </tbody>
                <template v-if="items">
                    <tbody v-if="noRecords && !items.data.length">
                    <tr class="intro-x bg-secondary">
                        <td :colspan="datatableoptions.columns.length" class="text-center">
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
</template>

<script setup>
import {ref, onMounted, computed, watch, reactive} from "vue";
import store from "@/stores";
import {useI18n} from "vue-i18n";
//import useImportExport from "@/hooks/import_export.js";
import _ from "lodash";

const props = defineProps({
    module: {
        type: String,
        required: true,
    },
    importExportOptions: {
        type: Object,
        required: false,
    },
    addEditOnSamePage: false,
    showData: {
        required: false,
        type: String,
        default: "",
    },
});
const emit = defineEmits(["addModel", "editItem", "showItem", "deleteItem"]);

// currentState = $props.module;
const headerFooterModalPreview = ref(false);
const {t} = useI18n();
const selectedRow = ref("");

const downloadFileName = ref('');
const modelName = props.importExportOptions.modelName;
const options = props.importExportOptions;
const responseStatus = ref(false);
const responseMessage = ref('');
const responseErrors = ref("");

const form = {
    export_as: ""
}

const import_file = ref({});

function importMe(e) {
    responseStatus.value = false;
    responseMessage.value = '';

    import_file.value = e.target.files[0];

    var allowedExtensions =
        import.meta.env.VITE_IMPORTS_ALLOWED.split(",");

    if (allowedExtensions.includes(e.target.files[0]["type"])) {
        proceedAction();
    } else {
        responseStatus.value = false;
        responseMessage.value = "Wrong file type.";
    }
    //console.log(import_file.value.size);
}

function proceedAction() {
    let formData = new FormData();
    formData.append("modelName", modelName);
    formData.append("import_file", import_file.value);
    if (options.selectedItem) {
        formData.append('selectedItem', options.selectedItem);
    }
    store
        .dispatch("importMe", formData)
        .then((res) => {
            responseStatus.value = res.data.success;
            responseMessage.value = res.data.message;
            responseErrors.value = res.data.failures ?? null;

            import_file.value = {};
            if (res.data.success == true) {
                setTimeout(() => {
                    headerFooterModalPreview.value = false;
                    responseStatus.value = false;
                    responseMessage.value = "";
                    fetchList();
                }, 1000);
            }
        })
        .catch((error) => {
            //error.response.data;
        });
}

async function exportMe(export_as, isDemo) {
    const demo = ref(false);

    let todayDate = new Date();

    let name = modelName + "-" + todayDate.getDate() + "-"
        + (todayDate.getMonth() + 1) + "-"
        + todayDate.getFullYear() + "-"
        + todayDate.getHours() + "-"
        + todayDate.getMinutes() + "-"
        + todayDate.getSeconds();
    if (!isDemo) {
        downloadFileName.value = name + "." + export_as;
    } else {
        downloadFileName.value = "Template for " + name + "." + export_as;
        demo.value = true;
    }
    const req = {
        fileName: downloadFileName.value,
        modelName: modelName,
        selectedItem: options.selectedItem ? options.selectedItem : "",
        demo: demo.value
    };

    await store.dispatch('exportMe', req)
        .then((response) => {
            if (response.status === 200) {
                form.export_as = "";
                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement("a");
                fileLink.href = fileURL;
                fileLink.setAttribute("download", downloadFileName.value);
                //fileLink.setAttribute('target', '_blank');
                document.body.appendChild(fileLink);
                fileLink.click();
            }
        })
        .catch();
}

// const { importMe, exportMe, responseStatus, responseMessage } = useImportExport(
//   props.importExportOptions
// );

function editMe(item) {
    selectedRow.value = item.id;
    emit("editItem", item);
}

function showMe(item) {
    selectedRow.value = item.id;
    emit("showItem", item);
}

function openModal() {
    //import_file.value = '';
    headerFooterModalPreview.value = true;
    responseMessage.value = "";
    responseStatus.value = false;
}

const noRecords = ref(false);
const datatableoptions = computed(
    () => store.getters[props.module + "/datatable"]
);

const items = computed(() => {
    let records = store.getters[props.module + "/" + props.module];

    if (records.data && parseInt(records.data.length) < 1) {
        noRecords.value = true;
    }
    return records;
});

const links = computed(() => store.getters[props.module + "/meta"]);
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
    fetchList();
});

function fetchList() {
    loading.value = true;
    if (props.showData) {
        url.value += "&item=" + props.showData;
    }
    store
        .dispatch(props.module + "/list", {url: url.value})
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

<style scoped>
.upload-btn-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
}

.upload-btn {
    border: 2px solid gray;
    color: gray;
    background-color: white;
    padding: 8px 20px;
    border-radius: 8px;
    font-size: 20px;
    font-weight: bold;
}

.upload-btn-wrapper input[type=file] {
    font-size: 100px;
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
}
</style>
