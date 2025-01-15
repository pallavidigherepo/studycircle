<script setup lang="ts">
import {ref, onMounted, computed, watch, reactive, defineProps} from "vue";
import store from "@/stores";
import {useI18n} from "vue-i18n";

import Button from "@/components/Base/Button";
import Table from "@/components/Base/Table";
import { FormInput, FormSelect } from "@/components/Base/Form";
import Lucide from "@/components/Base/Lucide";
import Tippy from "@/components/Base/Tippy";
import { Dialog, Menu } from "@/components/Base/Headless";
import Loading from "@/components/Loading/Index.vue";

import Pagination from "@/components/DataTable/Pagination.vue";
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
  border: 2px solid rgb(51, 11, 228);
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

<template>
  <div class="grid grid-cols-12 gap-6" :class="{'mt-5': datatableoptions.addNew}">
      <div class="
      intro-y
      col-span-12
      flex flex-wrap
      sm:flex-nowrap
      items-center
    " 
    :class="{'mt-2': datatableoptions.addNew}">
          <Button v-if="datatableoptions.addNew" variant="primary"  class="shadow-md mr-2"
                  @click.prevent="emit('addModel', true)">
              Add New
          </Button>
          <Menu>
          <div v-if="datatableoptions.export" class="dropdown">
              <Menu.Button aria-expanded="false" :as="Button" variant="primary" class="dropdown-toggle  ml-2" data-tw-toggle="dropdown">
                <span class="flex items-center justify-center">
                  Export/Print &nbsp;
                  <Lucide icon="Upload" class="w-4 h-4"/>
                </span>
              </Menu.Button>
              <Menu.Items class="dropdown-menu w-40">
                  <ul class="dropdown-content">
                      <li>
                          <a class="dropdown-item" href="javascript:;" @click.prevent="exportMe('xlsx')">
                              <Lucide icon="FileText" class="w-4 h-4 mr-2"/>
                              Export to Excel
                          </a>
                      </li>
                      <li>
                          <a class="dropdown-item" href="javascript:;" @click.prevent="exportMe('csv')">
                              <Lucide icon="FileText" class="w-4 h-4 mr-2"/>
                              Export to CSV
                          </a>
                      </li>
                      <!-- <li>
                          <a
                              href="javascript:;"
                              class="dropdown-item"
                              @click.prevent="exportMe('pdf')"
                          >
                              <Lucide icon="FileText" class="w-4 h-4 mr-2" />
                              {{ t("permissions.Export to PDF") }}
                          </a>
                          </li> -->
                  </ul>
              </Menu.Items>
          </div>
        </Menu>
        <Menu>
          <div v-if="datatableoptions.import" class="dropdown">
              <Menu.Button aria-expanded="false" :as="Button" variant="primary" class="dropdown-toggle ml-2" data-tw-toggle="dropdown">
                    <span class="flex items-center justify-center">
                    Import &nbsp;
                    <Lucide icon="DownloadIcon" class="w-4 h-4"/>
                    </span>
              </Menu.Button>
              <Menu.Items class="dropdown-menu w-40">
                  <ul class="dropdown-content">
                      <li>
                          <a class="dropdown-item" href="#" @click.prevent="openModal">
                            <Lucide icon="FileTextIcon" class="w-4 h-4"/>
                              CSV/Excel
                          </a>
                      </li>
                  </ul>
              </Menu.Items>
          </div>
        </Menu>
          <div class="hidden md:block mx-auto text-slate-500">
              <!-- {{ t(module+".Showing") }} {{ permissions.from }}
                  {{ t(module+".to") }} {{ permissions.to }}
                  {{ t(module+".of") }} {{ permissions.total }}
                  {{ t(module+".entries") }} -->
          </div>
          <div class="w-full mt-3 sm:w-auto sm:mt-0 sm:ml-auto md:ml-0">
              <div class="relative w-56 text-slate-500">
                  <FormInput v-model="search" placeholder=Search...  class="w-56 pr-10 !box"
                         type="text" @keyup="searchMe($event)"/>
                  <Lucide icon="SearchIcon" class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0"/>
              </div>
          </div>
      </div>
      <!-- BEGIN: Data List -->
      <div class="col-span-12 overflow-auto intro-y lg:overflow-visible">
          <Table class="border-spacing-y-[10px] border-separate -mt-2">
              <Table.Thead>
              <Table.Tr class="intro-x">
                  <Table.Th v-for="(column, index) in datatableoptions.columns" :key="index"
                      :class="{ 'table-report__action w-56': !column.field }"
                      class="uppercase border-b-0 whitespace-nowrap text-center" scope="col">
                      <template v-if="column.sort">
                          <a href="#" @click.prevent="sorting(column.field, sortOrder)">
                              <div class="flex items-center justify-between">
                                  <template v-if="column.label === 'ID' || column.label === 'ACTIONS'">{{
                                           (column.label)
                                      }}
                                  </template>
                                  <template v-else>{{
                                           (column.label)
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
                                 column.label
                              }}
                          </template>
                          <template v-else>{{ (column.label) }}</template>
                      </template>
                  </Table.Th>
              </Table.Tr>
              </Table.Thead>

              <Table.Tbody>
              <template v-if="items">
                  <Table.Tr v-for="(item, index) in items.data"
                      :key="index"
                      :class="{
                          'bg-secondary': item && item.id === selectedRow,
                      }"
                      class="intro-x">
                      <Table.Td v-for="(column, index) in datatableoptions.columns"
                          :key="index"
                          :class="{
                            'table-report__action w-56 items-center': !column.field,
                          }"
                          class="box rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] first:rounded-l-[0.6rem] first:border-l last:rounded-r-[0.6rem] last:border-r dark:bg-darkmode-600 whitespace-nowrap">
                          <template v-if="!column.field">
                              <div class="flex items-center">
                                  <a v-if="column.actions.show" class="flex items-center mr-3" href="javascript:;"
                                     @click.prevent="showMe(item)">
                                      <Lucide icon="Eye" class="w-4 h-4 mr-1"/>
                                      Show
                                  </a>
                                  <a v-if="column.actions.edit" class="flex items-center mr-3" href="javascript:;"
                                     @click.prevent="editMe(item)">
                                      <Lucide icon="CheckSquare" class="w-4 h-4 mr-1"/>
                                      Edit
                                  </a>
                                  <a v-if="column.actions.delete" class="flex items-center text-danger"
                                     href="javascript:;"
                                     @click.prevent="emit('deleteItem', item)">
                                      <Lucide icon="Trash2" class="w-4 h-4 mr-1"/>
                                      Delete
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
                      </Table.Td>
                  </Table.Tr>
              </template>

              </Table.Tbody>
              <template v-if="items">
                  <Table.Tbody v-if="noRecords && !items.data.length">
                  <Table.Tr class="intro-x bg-secondary">
                      <Table.Td :colspan="datatableoptions.columns.length" class="text-center">
                          Sorry, no records found
                      </Table.Td>
                  </Table.Tr>
                  </Table.Tbody>
              </template>
          </Table>
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
      <Dialog :open="headerFooterModalPreview"
             size="lg"
             @hidden="headerFooterModalPreview = false">
          
          <CustomeAlert v-if="responseMessage"
                        :errors="responseErrors"
                        :message="responseMessage"
                        :status="responseStatus"
                        class="col-span-12 sm:col-span-6 flex"/>
          <Dialog.Panel class="grid grid-cols-12 gap-4 gap-y-3">
            <Dialog.Title>
              <h2 class="font-medium text-base mr-auto">
                  Import as CSV/Excel
              </h2>
            </Dialog.Title>
              <div class="col-span-12 sm:col-span-14 text-center">
                  <slot name="info"></slot>
                  <div class="upload-btn-wrapper">
                      <Button class="upload-btn">Upload file
                      </Button>
                      <FormInput id="modal-form-1" name="myfile" type="file" @change="importMe($event)"/>
                  </div>
                  <div class="col-span-12">
                      <div
                          class="alert alert-outline-warning alert-dismissible bg-warning/20 dark:bg-darkmode-400 dark:border-darkmode-400 mt-5 mr-5 show"
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
                                            <Lucide icon="DownloadCloudIcon" class="w-4 h-4"/>
                                          </div>
                                      </div>
                                      <div class="text-base text-slate-500 mt-1">
                                          <Button variant="primary" class="btn btn-primary h-20"
                                                  @click.prevent="exportMe('xlsx', true)">
                                              Download Template for EXCEL
                                          </Button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-span-6 sm:col-span-6 xl:col-span-3 intro-y">
                              <div class="report-box zoom-in">
                                  <div class="box p-4">
                                      <div class="flex text-center justify-center">

                                          <div class="">
                                            <Lucide icon="DownloadCloudIcon" class="w-4 h-4"/>
                                          </div>
                                      </div>
                                      <div class="text-base text-slate-500 mt-1">
                                          <Button variant="primary" class="btn btn-primary h-20"
                                                  @click.prevent="exportMe('csv', true)">
                                              Download Template for CSV
                                          </Button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>
            
       
          <Dialog.Footer class="flex justify-start space-x-2">
              <Button id="import-export-cancel-Button"
                        variant="outline-secondary"
                      class="w-20 mr-1"
                      type="button"
                      @click="headerFooterModalPreview = false">
                  Cancel
              </Button>
              <Button type="button" variant="primary" class="w-20">
                  Import
             </Button>
          </Dialog.Footer>
        </Dialog.Panel>
      </Dialog>
      <!-- END: Modal Content -->
      <Loading v-if="loading" fixed></Loading>

  </div>
</template>