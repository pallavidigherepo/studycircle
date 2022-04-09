<template>
  <div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">
        {{ t("coursesTypes.Courses Types") }}
      </h2>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
      <!-- BEGIN: Post Content -->
      <div class="intro-y col-span-12 lg:col-span-8">
        <!-- BEGIN: HTML Table Data -->

        <div class="intro-y box p-5">
          <div class="overflow-x-auto scrollbar-hidden">
            <Datatable
              module="coursesTypes"
              :importExportOptions="options"
              @editItem="edit"
              @deleteItem="deleteI"
            />
          </div>
        </div>
        <!-- END: HTML Table Data -->
      </div>
      <!-- END: Post Content -->
      <!-- BEGIN: Add/Edit permission -->
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
              <label for="course-type-label" class="form-label">{{
                t("coursesTypes.Label")
              }}</label>
              <input
                id="course-type-label"
                type="text"
                class="form-control w-full"
                :placeholder="t('coursesTypes.Label')"
                v-model.trim="model.label"
                :class="{ 'border-danger': submitted && v$.label.$error }"
              />
              <span
                v-if="submitted && v$.label.$error"
                class="text-danger mt-2"
              >
                {{ v$.label.$errors[0].$message }}
              </span>
            </div>
            <div class="mt-3">
              <label for="course-type-description" class="form-label">{{
                t("coursesTypes.Description")
              }}</label>
              <input
                id="course-type-description"
                type="text"
                class="form-control w-full"
                :placeholder="t('coursesTypes.Course type description')"
                v-model.trim="model.description"
                :class="{
                  'border-danger': submitted && v$.description.$error,
                }"
              />
              <span
                v-if="submitted && v$.description.$error"
                class="text-danger mt-2"
              >
                {{ v$.description.$errors[0].$message }}
              </span>
            </div>
            <div class="mt-3">
              <label for="courses-types-icon" class="form-label">{{
                t("coursesTypes.Icon")
              }}</label>
              <input
                id="courses-types-icon"
                type="text"
                class="form-control w-full"
                placeholder="Course type icon"
                v-model="model.icon"
              />
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
      <!-- END: Add/Edit permission -->
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
  modelName: "CoursesType",
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
  label: "",
  description: "",
  icon: "",
});

const rules = computed(() => {
  return {
    label: {
      required: helpers.withMessage(
        "Please enter label of course type.",
        required
      ),
    },
    description: {
      required: helpers.withMessage(
        "Please enter description of course type.",
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
      .dispatch("coursesTypes/save", model.value)
      .then(() => {
        // After dispatch we have to reset the model value
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
  model.value.label = JSON.parse(item.label)
  model.value.description = JSON.parse(item.description)
}
// End: Edit item

// Begin: Cancel editting
function cancel() {
  actionText.value = "Add";
  isEdit.value = false;
  selectedItem.value = "";
  model.value = JSON.parse(JSON.stringify(model));
  //var element = document.querySelector(".bg-secondary");
  //element.classList.remove("bg-secondary");
  //document.querySelector(".bg-secondary").removeClass("bg-secondary");
  //console.log(dom("div.bg-secondary").removeClass("bg-secondary"));
  //console.log(document.getElementsByClassName('bg-secondary'));
}
// End: Cancel editting

// BEGIN: Delete
function deleteI(item) {
  store.dispatch("coursesTypes/delete", item.id);
}
// END: Delete
</script>

<style>
.active-row {
  background-color: lightgray;
}
</style>