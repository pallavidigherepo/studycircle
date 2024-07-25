<template>
    <div>
      <template v-if="DataTable">
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
          <h2 class="text-lg font-medium mr-auto">
            {{ t("fees.Fees") }}
          </h2>
        </div>
        <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
          <!-- BEGIN: Datatable Content -->
          <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: HTML Table Data -->
  
            <div class="intro-y box p-5">
              <div class="overflow-x-auto scrollbar-hidden">
                <DataTable
                  module="fees"
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
import {ref, onMounted, computed, reactive, watch} from "vue";

import {useVuelidate} from "@vuelidate/core";
import {required, helpers} from "@vuelidate/validators";
import DataTable from "@/components/DataTable/Index.vue";

import store from "@/stores";

import {useI18n} from "vue-i18n";
import _ from "lodash";
import axiosClient from "@/axios";
// import {AccordionGroup} from "@/global-components/accordion";

// To show/hide modal
const showPayNowPreview = ref(false);
const showTransactionHistory = ref(false);

const options = {
    modelName: "FeeDiscount",
};

const {t} = useI18n();

// End of info

// Variables and actions related to Add/Edit.
let isEdit = ref(false);
let actionText = ref("Add");
let submitted = ref(false);
let message = ref("");
let isErrored = ref(false);
let selectedItem = ref("");

const payHistory = ref();
const studentFeeStructure = ref();
const discountsForStudent = ref();

let model = ref({
    batch_id: "",
    standard_id: "",
    fee_type_id: "",
    student_name: "",
});

const transactionModel = ref({
    fee_id: '',
    uid: '',
    payment_method: '',
    amount: '',
});

const rules = computed(() => {
    return {
        payment_method: {
            required: helpers.withMessage(
                "Please select payment method.",
                required
            ),
        },
        amount: {
            required: helpers.withMessage(
                "Please enter amount.",
                required
            ),
        },
    };
});

const v$ = useVuelidate(rules, transactionModel.value);
const checkFeeBalance = ref("");

async function submitForm() {
    // Firstly check if user have made all the payments.
    checkFeeBalance.value = JSON.parse(JSON.stringify(
        await axiosClient
            .get('/check_fee_balance/' + transactionModel.value.fee_id)
            .then(function (data) {
                return data.data;
            })
    ));
    if (checkFeeBalance.value.balance !== 0) {
        submitted.value = true;
        v$.value.$validate(); // checks all inputs

        if (!v$.value.$error) {
            //loading.value = true;

            await store
                .dispatch("fee_transactions/save", transactionModel.value)
                .then((data) => {
                    showPayNowPreview.value = false;
                    payHistory.value = data.fee;
                    showTransaction(data.fee_transaction);
                    transactionModel.value = JSON.parse(JSON.stringify(transactionModel));
                    fetchList();
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
    } else {
        showPayNowPreview.value = false;
        alert('You have already made all the payments.');
    }

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

async function payNow(item) {
    showPayNowPreview.value = true;
    payHistory.value = JSON.parse(JSON.stringify(item));
    transactionModel.value.fee_id = item.id;
    // First get list of all the fee structures.
    studentFeeStructure.value = JSON.parse(JSON.stringify(
        await axiosClient
            .get('/fee_structure_list/' + item.standard_id + '/' + item.batch_id + '/' + item.fee_type_id)
            .then(function (data) {
                return data.data;
            })
    ));
    // If student is regular, then only check for discounts available.
    if (item.fee_type_id === 4) {
        // Get list of all the discounts available.
        discountsForStudent.value = JSON.parse(JSON.stringify(
            await axiosClient
                .get('/student_discounts/' + item.student_id)
                .then(function (data) {
                    return data.data;
                })
        ));
    }

}

const calculatedAmounts = ref({});
const cal = ref("");

function autoFillAmounts() {
    cal.value = transactionModel.value.amount;
    JSON.parse(JSON.stringify(studentFeeStructure.value.data)).forEach(function (item, index) {
        if (cal.value >= item.amount) {
            calculatedAmounts.value[item.fee_category] = item.amount;
        } else {
            calculatedAmounts.value[item.fee_category] = cal.value > 0 ? cal.value : 0;
        }
        cal.value -= item.amount;
    });
}
const studentFeeTransactions = ref();
async function paymentHistory(item) {
    showTransactionHistory.value = true;
    payHistory.value = JSON.parse(JSON.stringify(item));
    studentFeeTransactions.value = JSON.parse(JSON.stringify(
        await axiosClient
            .get('/fee_transactions?fee_id=' + item.id)
            .then(function (data) {
                return data.data;
            })
    ));
}
const downloadFileName = ref();

const form = {
    export_as: ""
}

async function exportMe(export_as, transaction) {
    const demo = ref(false);

    let todayDate = new Date();

    let name = "Transaction-" + todayDate.getDate() + "-"
        + (todayDate.getMonth() + 1) + "-"
        + todayDate.getFullYear() + "-"
        + todayDate.getHours() + "-"
        + todayDate.getMinutes() + "-"
        + todayDate.getSeconds();

    downloadFileName.value = name + "." + export_as;

    const req = {
        fileName: downloadFileName.value,
        modelName: "FeeTransaction",
        selectedItem: transaction.id,
        demo: false,
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
const showInvoiceModal = ref(false);
const printTransaction = ref();
function showTransaction(transaction)
{
    showInvoiceModal.value = true;
    printTransaction.value = JSON.parse(JSON.stringify(transaction));
    setTimeout(function() {window.print();}, 1500);
}
</script>

<style scoped>
/*.accordion .accordion-item:first-of-type {
    display: none;
}*/

</style>
