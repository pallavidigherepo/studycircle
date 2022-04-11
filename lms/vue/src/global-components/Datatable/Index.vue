<template>
  <div class="grid grid-cols-12 gap-6 mt-5">
    <div
      class="
        intro-y
        col-span-12
        flex flex-wrap
        sm:flex-nowrap
        items-center
        mt-2
      "
    >
      <button
        class="btn btn-primary shadow-md mr-2"
        v-if="datatableoptions.addNew"
        @click.prevent="emit('addModel', true)"
      >
        {{ t("common.Add New") }}
      </button>
      <div class="dropdown" v-if="datatableoptions.export">
        <button
          class="dropdown-toggle btn btn-primary ml-2"
          aria-expanded="false"
          data-tw-toggle="dropdown"
        >
          <span class="flex items-center justify-center">
            {{ t("common.Export/Print") }}&nbsp;
            <DownloadIcon class="w-4 h-4" />
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
              <a
                href="javascript:;"
                class="dropdown-item"
                @click.prevent="exportMe('xlsx')"
              >
                <FileTextIcon class="w-4 h-4 mr-2" />
                {{ t("common.Export to Excel") }}
              </a>
            </li>
            <li>
              <a
                href="javascript:;"
                class="dropdown-item"
                @click.prevent="exportMe('csv')"
              >
                <FileTextIcon class="w-4 h-4 mr-2" />
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
      <div class="dropdown" v-if="datatableoptions.import">
        <button
          class="dropdown-toggle btn btn-primary ml-2"
          aria-expanded="false"
          data-tw-toggle="dropdown"
        >
          <span class="flex items-center justify-center">
            {{ t("common.Import") }}&nbsp;
            <UploadIcon class="w-4 h-4" />
          </span>
        </button>
        <div class="dropdown-menu w-40">
          <ul class="dropdown-content">
            <li>
              <a href="#" class="dropdown-item" @click="openModal">
                <FileTextIcon class="w-4 h-4 mr-2" />
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
          <input
            type="text"
            class="form-control w-56 pr-10 w-full"
            :placeholder="t('common.Search')+'...'"
            v-model="search"
            @keyup="searchMe($event)"
          />
          <SearchIcon class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" />
        </div>
      </div>
    </div>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
      <table class="table table-hover mt-2">
        <thead>
          <tr>
            <th
              v-for="(column, index) in datatableoptions.columns"
              :key="index"
              class="uppercase whitespace-nowrap"
              :class="{ 'table-report__action w-56': !column.field }"
              scope="col"
            >
              <template v-if="column.sort">
                <a href="#" @click.prevent="sorting(column.field, sortOrder)">
                  <div className="flex items-center justify-between">
                    <template v-if="column.label === 'ID' || column.label === 'ACTIONS'">{{ t("common." + column.label) }}</template>
                    <template v-else>{{ t(module + "." + column.label) }}</template>

                    <span v-if="column.field === sortBy">
                      <ChevronUpIcon
                        v-if="sortOrder === 'asc'"
                        class="w-4 h-4 text-gray-400"
                      ></ChevronUpIcon>
                      <ChevronDownIcon
                        v-else
                        class="w-4 h-4 text-gray-400"
                      ></ChevronDownIcon>
                    </span>
                  </div>
                </a>
              </template>
              <template v-else>
                <template v-if="column.label === 'ID' || column.label === 'ACTIONS'">{{ t("common." + column.label) }}</template>
                <template v-else>{{ t(module + "." + column.label) }}</template>
              </template>
            </th>
          </tr>
        </thead>
        
        <tbody>
          <tr
            v-for="(item, index) in items.data"
            :key="index"
            class="intro-x"
            :class="{
              'bg-secondary': item.id == selectedRow,
            }"
          >
            <td
              class="whitespace-nowrap"
              v-for="(column, index) in datatableoptions.columns"
              :key="index"
              :class="{
                'table-report__action w-56 items-center': !column.field,
              }"
            >
              <template v-if="!column.field">
                <div class="flex items-center">
                  <a
                    v-if="column.actions.edit"
                    class="flex items-center mr-3"
                    href="javascript:;"
                    @click.prevent="editMe(item)"
                  >
                    <CheckSquareIcon class="w-4 h-4 mr-1" />
                    {{ t("common.Edit") }}
                  </a>
                  <a
                    v-if="column.actions.delete"
                    class="flex items-center text-danger"
                    href="javascript:;"
                    @click.prevent="emit('deleteItem', item)"
                  >
                    <Trash2Icon class="w-4 h-4 mr-1" />
                    {{ t("common.Delete") }}
                  </a>
                </div>
              </template>
              <template v-else>
                <template v-if="column.isJson">{{ JSON.parse(item[column.field]) }}</template>
                <template v-else>{{ item[column.field] }}</template>
              </template>
            </td>
          </tr>
        </tbody>
        <!-- <tbody v-else>
          <tr>
            <td :colspan="datatableoptions.columns.length" class="text-center">Sorry, no records found.</td>
          </tr>
        </tbody> -->
      </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->

    <Pagination
      :links="links"
      :currentPage="currentPage"
      @paginate="getForPage"
      @perpage="perPageValue"
      
    />
    <!-- END: Pagination -->
    <!-- BEGIN: Modal Content -->
    <Modal
      :show="headerFooterModalPreview"
      @hidden="headerFooterModalPreview = false"
    >
      <ModalHeader>
        <h2 class="font-medium text-base mr-auto">
          {{ t("common.Import as CSV/Excel") }}
        </h2>
      </ModalHeader>
      <CustomeAlert
        v-if="responseMessage"
        :message="responseMessage"
        :status="responseStatus"
        class="col-span-12 sm:col-span-6 flex"
      />
      <ModalBody class="grid grid-cols-12 gap-4 gap-y-3">
        <div class="col-span-12 sm:col-span-8">
          <label for="modal-form-1" class="form-label">{{
            t("common.Upload file")
          }}</label>
          <input
            id="modal-form-1"
            type="file"
            class="form-control"
            @change="importMe($event)"
          />
          <span class="text-primary"
            >Please upload file of type .csv or .xlsx</span
          >
        </div>
      </ModalBody>
      <ModalFooter>
        <button
          type="button"
          @click="headerFooterModalPreview = false"
          class="btn btn-outline-secondary w-20 mr-1"
        >
          {{ t("common.Cancel") }}
        </button>
        <!-- <button type="button" class="btn btn-primary w-20">
            {{ t("permissions.Import") }}
            </button> -->
      </ModalFooter>
    </Modal>
    <!-- END: Modal Content -->
  </div>
</template>

<script setup>
import { ref, onMounted, computed, watch, reactive } from "vue";
import store from "@/stores";
import { useI18n } from "vue-i18n";
import useImportExport from "@/hooks/import_export.js";
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
});
const emit = defineEmits(["addModel", "editItem", "deleteItem"]);

// currentState = $props.module;
const headerFooterModalPreview = ref(false);
const { t } = useI18n();
const selectedRow = ref("");

const { importMe, exportMe, responseStatus, responseMessage } = useImportExport(
  props.importExportOptions
);

function editMe(item) {
  selectedRow.value = item.id;
  emit("editItem", item);
}
function openModal() {
  //import_file.value = '';
  headerFooterModalPreview.value = true;
  responseMessage.value = "";
  responseStatus.value = false;
}

const datatableoptions = computed(
  () => store.getters[props.module + "/datatable"]
);
const items = computed(() => store.getters[props.module + "/" + props.module]);
const links = computed(() => store.getters[props.module + "/meta"]);
const currentPage = ref(datatableoptions.value.defaultPage);

const perPageOptions = [10, 20, 30, 40, 50];
const fetchUrl = ref("");

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
  store
    .dispatch(props.module + "/list", { url: url.value })
    .then()
    .catch();
}
function getForPage(page) {
  if (page == "Next &raquo;") {
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
  if (field == sortBy.value) {
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
</style>