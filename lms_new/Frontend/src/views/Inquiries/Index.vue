<template>
    <div>
      <template v-if="DataTable">
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
          <h2 class="text-lg font-medium mr-auto">
            {{ t("inquiries.Inquiry") }}
          </h2>
        </div>
        <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
          <!-- BEGIN: Datatable Content -->
          <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: HTML Table Data -->
  
            <div class="intro-y box p-5">
              <div class="overflow-x-auto scrollbar-hidden">
                <DataTable
                  module="inquiries"
                  :importExportOptions="options"
                  @editItem="edit"
                  @deleteItem="deleteI"
                  @addModel="add"
                />
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
<script setup lang="ts">
import {ref, onMounted, computed, watch, reactive} from "vue";
import {useI18n} from "vue-i18n";
import {useRoute, useRouter} from "vue-router";
import store from "@/stores";
import DataTable from "@/components/DataTable/Index.vue";
// import InquiryFollowups from "@/components/Inquiries/Followups.vue";
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
        .dispatch("inquiries/list")
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
            // fetchList();
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
const modelName = "Inquiry";
const downloadFileName = ref('');
const responseStatus = ref(false);
const responseMessage = ref('');
const responseErrors = ref("");
const options = {
    modelName: "Question",
};;

const form = {
    export_as: ""
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
        selectedItem: "",
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

function closeMe()
{
    showFollowupValue.value = false;
}
</script>

<style scoped>

</style>
