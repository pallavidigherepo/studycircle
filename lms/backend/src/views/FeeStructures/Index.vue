<template>
    <div>
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{ t("fee_structures.Fee Structures") }}
            </h2>
        </div>
        <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
            <!-- BEGIN: Post Content -->
            <div class="intro-y col-span-12 lg:col-span-8">
                <!-- BEGIN: HTML Table Data -->

                <div class="intro-y box p-5">
                    <div class="overflow-x-auto scrollbar-hidden">
                        <Datatable
                            module="fee_structures"
                            :importExportOptions="options"
                            @editItem="edit"
                            @deleteItem="deleteI"
                        />
                    </div>
                </div>
                <!-- END: HTML Table Data -->
            </div>
            <!-- END: Post Content -->
            <!-- BEGIN: Add/Edit fee structure -->
            <div class="col-span-12 lg:col-span-4">
                <div class="intro-y box p-5">
                    <h2 class="text-lg font-medium mr-auto pt-5 pb-5">
                        {{ t("common." + actionText) }}
                    </h2>
                    <div
                        class="alert alert-danger show flex items-center mb-2"
                        role="alert"
                        v-if="isErrored"
                    >
                        <AlertOctagonIcon class="w-6 h-6 mr-2" />
                        {{ message }}
                    </div>

                    <form @submit.prevent="submitForm" class="validate-form">
                        <div>
                            <label for="fee-category" class="form-label">{{
                                    t("fee_structures.Fee Category")
                                }}</label>
                            <TomSelect id="fee-category"
                                       v-model="model.fee_category_id"
                                       :class="{ 'border-danger': submitted && v$.fee_category_id.$errors.length, }"
                                       :options="{
                                        allowEmptyOption: false,
                                        create: false,
                                        placeholder: 'Select Fee Category',
                                        autocomplete: 'off',
                                        items: [model.fee_category_id]
                                      }"
                                       :placeholder="'Select Fee Category'"
                                       class="w-full">
                                <option>{{ t('fee_structures.Select Fee Category') }}</option>
                                <option v-for="(feeCategory, index) in feeCategories" :key="index" :value="index">
                                    {{ feeCategory }}
                                </option>
                            </TomSelect>
                            <span
                                v-if="submitted && v$.fee_category_id.$error"
                                class="text-danger mt-2"
                            >
                                {{ v$.fee_category_id.$errors[0].$message }}
                            </span>
                        </div>
                        <div>
                            <label for="fee-batch" class="form-label">{{
                                    t("fee_structures.Batch")
                                }}</label>
                            <TomSelect id="fee-batch"
                                   v-model="model.batch_id"
                                   :class="{ 'border-danger': submitted && v$.batch_id.$errors.length, }"
                                   :options="{
                                        allowEmptyOption: false,
                                        create: false,
                                        placeholder: 'Select Batch',
                                        autocomplete: 'off',
                                        items: [model.batch_id]
                                      }"
                                   :placeholder="'Select Batch'"
                                   class="w-full">
                                <option>{{ t('fee_structures.Select Batch') }}</option>
                                <option v-for="(batch, index) in batches" :key="index" :value="index">
                                    {{ batch }}
                                </option>
                            </TomSelect>
                            <span
                                v-if="submitted && v$.batch_id.$error"
                                class="text-danger mt-2"
                            >
                                {{ v$.batch_id.$errors[0].$message }}
                            </span>
                        </div>
                        <div>
                            <label for="fee-standard" class="form-label">{{
                                    t("fee_structures.Standard")
                                }}</label>
                            <TomSelect id="fee-standard"
                                       v-model="model.standard_id"
                                       :class="{ 'border-danger': submitted && v$.standard_id.$errors.length, }"
                                       :options="{
                                        allowEmptyOption: false,
                                        create: false,
                                        placeholder: 'Select Standard',
                                        autocomplete: 'off',
                                        items: [model.standard_id]
                                      }"
                                       :placeholder="'Select Standard'"
                                       class="w-full">
                                <option>{{ t('fee_structures.Select Standard') }}</option>
                                <option v-for="(standard, index) in standards" :key="index" :value="index">
                                    {{ standard }}
                                </option>
                            </TomSelect>
                            <span
                                v-if="submitted && v$.standard_id.$error"
                                class="text-danger mt-2"
                            >
                                {{ v$.standard_id.$errors[0].$message }}
                            </span>
                        </div>
                        <div class="mt-3">
                            <label for="fee-structures-amount" class="form-label">{{
                                    t("fee_structures.Amount")
                                }}</label>
                            <input
                                id="fee-discount-amount"
                                type="text"
                                class="form-control w-full"
                                :placeholder="t('fee_structures.Amount')"
                                v-model.trim="model.amount"
                                :class="{ 'border-danger': submitted && v$.amount.$error }"
                            />
                            <span
                                v-if="submitted && v$.amount.$error"
                                class="text-danger mt-2"
                            >
                                {{ v$.amount.$errors[0].$message }}
                            </span>
                        </div>
                        <div class="text-right mt-5">
                            <button
                                type="button"
                                class="btn btn-outline-secondary w-24 mr-1"
                                @click.prevent="cancel"
                            >
                                {{ t("common.Cancel") }}
                            </button>
                            <button type="submit" class="btn btn-primary w-24">
                                {{ t("common.Save") }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Add/Edit fee_discounts -->
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";

import { useVuelidate } from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators";

import store from "@/stores";

import { useI18n } from "vue-i18n";

// To show/hide modal

const options = {
    modelName: "FeeStructure",
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
    id: "",
    fee_category_id: "",
    batch_id: "",
    standard_id: "",
    amount: "",
});

const rules = computed(() => {
    return {
        fee_category_id: {
            required: helpers.withMessage(
                "Select fee category.",
                required
            ),
        },
        batch_id: {
            required: helpers.withMessage(
                "Select batch.",
                required
            ),
        },
        standard_id: {
            required: helpers.withMessage(
                "Select standard.",
                required
            ),
        },
        amount: {
            required: helpers.withMessage(
                "Please enter amount.",
                required
            ),
        }
    };
});

const v$ = useVuelidate(rules, model);

async function submitForm(event) {
    submitted.value = true;
    v$.value.$validate(); // checks all inputs

    if (!v$.value.$error) {
        //loading.value = true;

        await store
            .dispatch("fee_structures/save", model.value)
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
    store.dispatch("fee_structures/delete", item.id);
}
// END: Delete

onMounted(() => {
    store.dispatch("listStandard").then().catch();
    store.dispatch("listBatch").then().catch();
    store.dispatch("listFeeCategories").then().catch();
});

const standards = computed(() => store.getters.listStandards);
const batches = computed(() => store.getters.listBatches);
const feeCategories = computed(() => store.getters.listFeeCategories);

function random(string) {
    var s = '';
    var randomchar = function() {
        var n = Math.floor(Math.random() * 62);
        if (n < 10) return n; //1-10
        if (n < 36) return String.fromCharCode(n + 55); //A-Z
        return String.fromCharCode(n + 61); //a-z
    }
    while (s.length < string) s += randomchar();
    return s;
}
</script>

<style>
.active-row {
    background-color: lightgray;
}
</style>
