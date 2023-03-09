<template>
    <div>
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{ t("fee_discounts.Fee Discounts") }}
            </h2>
        </div>
        <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
            <!-- BEGIN: Post Content -->
            <div class="intro-y col-span-12 lg:col-span-8">
                <!-- BEGIN: HTML Table Data -->

                <div class="intro-y box p-5">
                    <div class="overflow-x-auto scrollbar-hidden">
                        <Datatable
                            module="fee_discounts"
                            :importExportOptions="options"
                            @editItem="edit"
                            @deleteItem="deleteI"
                        />
                    </div>
                </div>
                <!-- END: HTML Table Data -->
            </div>
            <!-- END: Post Content -->
            <!-- BEGIN: Add/Edit fee discount -->
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
                            <label for="fee-discount-name" class="form-label">{{
                                    t("fee_discounts.Name")
                                }}</label>
                            <input
                                id="fee-discount-name"
                                type="text"
                                class="form-control w-full"
                                :placeholder="t('fee_discounts.Name')"
                                v-model.trim="model.name"
                                :class="{ 'border-danger': submitted && v$.name.$error }"
                            />
                            <span
                                v-if="submitted && v$.name.$error"
                                class="text-danger mt-2"
                            >
                                {{ v$.name.$errors[0].$message }}
                            </span>
                        </div>
                        <div class="mt-3">
                            <label for="fee-discount-amount" class="form-label">{{
                                    t("fee_discounts.Amount")
                                }}</label>
                            <input
                                id="fee-discount-amount"
                                type="text"
                                class="form-control w-full"
                                :placeholder="t('fee_discounts.Amount')"
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
    id: "",
    name: "",
    amount: "",
});

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
    };
});

const v$ = useVuelidate(rules, model);

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
</script>

<style>
.active-row {
    background-color: lightgray;
}
</style>
