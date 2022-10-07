<template>
  <div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">
        {{ t("courses.Courses") }}
      </h2>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
      <!-- BEGIN: Post Content -->
      <div class="intro-y col-span-12 lg:col-span-8">
        <!-- BEGIN: HTML Table Data -->

        <div class="intro-y box p-5">
          <div class="overflow-x-auto scrollbar-hidden">
            <Datatable
              module="courses"
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
              <label for="course-type" class="form-label">{{
                t("courses.Choose course type")
              }}</label>
              <TomSelect
                  id="course-type"
                  v-model="model.type_ids"
                  placeholder = 'Select course type'
                  :options="{
                    allowEmptyOption: false,
                    maxItems: 3,
                    create: false,
                    placeholder: 'Select course type',
                    autocomplete: 'off'
                  }"
                  class="w-full"
                  multiple
                  :class="{
                    'border-danger': submitted && v$.type_ids.$errors.length,
                  }"
                >
                  <option
                    :value="index"
                    v-for="(courseType, index) in courseTypes"
                    :key="random(index)"
                  >
                    {{ JSON.parse(courseType) }}
                  </option>
                </TomSelect>
                
            </div>
            <div class="mt-3">
              <label for="course-code" class="form-label">{{
                t("courses.Code")
              }}</label>
              <input
                id="course_code"
                type="text"
                class="form-control w-full"
                :placeholder="t('courses.Course Code')"
                v-model.trim="model.course_code"
                :class="{ 'border-danger': submitted && v$.course_code.$error }"
              />
              <span v-if="submitted && v$.course_code.$error" class="text-danger mt-2">
                {{ v$.course_code.$errors[0].$message }}
              </span>
            </div>
            <div class="mt-3">
              <label for="course-name" class="form-label">{{
                t("courses.Name")
              }}</label>
              <input
                id="course-name"
                type="text"
                class="form-control w-full"
                :placeholder="t('courses.Name')"
                v-model.trim="model.name"
                :class="{ 'border-danger': submitted && v$.name.$error }"
              />
              <span v-if="submitted && v$.name.$error" class="text-danger mt-2">
                {{ v$.name.$errors[0].$message }}
              </span>
            </div>
            <div class="mt-3">
              <label for="course-language" class="form-label">{{
                t("courses.Choose Language")
              }}</label>
              <TomSelect
                  id="course-language"
                  v-model="model.language_id"
                  placeholder = 'Select Language'
                  :options="{
                    allowEmptyOption: false,
                    create: false,
                    placeholder: 'Select Language',
                    autocomplete: 'off'
                  }"
                  class="w-full"
                  :class="{
                    'border-danger': submitted && v$.language_id.$errors.length,
                  }"
                >
                  <option v-for="(language, index) in languages" 
                          :key="index" 
                          :value="index">{{ language}}</option>
              </TomSelect>
                
            </div>
            <div class="mt-3">
              <label for="course-tags" class="form-label">{{
                t("courses.Tags")
              }}</label>
              
              <TomSelect
                  id="course-tags"
                  v-model="model.tags_list"
                  :placeholder="t('Tags')"
                  :options="{
                    create: true
                  }"
                  class="w-full"
                  multiple
                >
                <option v-for="(tag, index) in model.tags_list" 
                          :key="index" 
                          :value="tag">{{ tag }}</option>
              </TomSelect>
                
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
  modelName: "Course",
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
  type_ids: [],
  name: "",
  course_code: "",
  tags_list: [],
  language_id: 1,
});

const rules = computed(() => {
  return {
    name: {
      required: helpers.withMessage(
        "Please enter name of course.",
        required
      ),
    },
    type_ids: {
      required: helpers.withMessage(
        "Please select at least one course type.",
        required
      ),
    },
    language_id: {
      required: helpers.withMessage(
        "Please select at least one language.",
        required
      ),
    },
    course_code: {
      required: helpers.withMessage(
        "Please enter course code.",
        required
      ),
    },
  };
});

const v$ = useVuelidate(rules, model);

async function submitForm(event) {
  submitted.value = true;
  v$.value.$validate(); // checks all inputs
//console.log(v$.value)
  if (!v$.value.$error) {
    //loading.value = true;

    await store
      .dispatch("courses/save", model.value)
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
  //submitted.value = false;
  actionText.value = "Edit";
  isEdit.value = true;
  selectedItem.value = item.id;
  model.value = JSON.parse(JSON.stringify(item));

}
// End: Edit item

// Begin: Cancel editting
function cancel() {
  submitted.value = false;
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
  store.dispatch("courses/delete", item.id);
}
// END: Delete

onMounted(() => {
  store.dispatch("listLanguages").then().catch();
  store.dispatch("listCourseTypes").then().catch();
});
const languages = computed(() => store.getters.languages);
const courseTypes = computed(() => store.getters.courseTypeList);

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