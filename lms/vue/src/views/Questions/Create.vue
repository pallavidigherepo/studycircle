<template>
  <div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">
        {{ t("questions.Add Question") }}
      </h2>
      <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <router-link
          to="/questions"
          class="
            btn
            box
            text-gray-700
            dark:text-gray-300
            mr-2
            flex
            items-center
            ml-auto
            sm:ml-0
          "
          ><ArrowLeftCircleIcon class="w-4 h-4 mr-2" />{{ t("common.Back") }}
        </router-link>
      </div>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
      <div class="intro-y box col-span-12 lg:col-span-12">
        <div class="p-5">
          <div
            class="alert alert-danger show flex items-center mb-2"
            role="alert"
            v-if="isErrored"
          >
            <AlertOctagonIcon class="w-6 h-6 mr-2" />
            {{ message }}
          </div>
          <form @submit.prevent="submitForm" class="validate-form">
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
              <div class="intro-y col-span-12 sm:col-span-6">
                <label for="form-board" class="form-label">{{
                  t("questions.Choose Board")
                }}</label>
                <TomSelect
                  id="form-board"
                  v-model="model.board_id"
                  :placeholder="'Select Board'"
                  :options="{
                    allowEmptyOption: false,
                    create: false,
                    placeholder: 'Select Board',
                    autocomplete: 'off',
                  }"
                  class="w-full"
                  :class="{
                    'border-danger': submitted && v$.board_id.$errors.length,
                  }"
                >
                  <!-- <option>{{ t('questions.Select Board')}}</option> -->
                  <option
                    v-for="(board, index) in boards"
                    :key="index"
                    :value="index"
                  >
                    {{ board }}
                  </option>
                </TomSelect>
              </div>
              <div class="intro-y col-span-12 sm:col-span-6">
                <label for="form-standard" class="form-label">{{
                  t("questions.Choose Standard")
                }}</label>
                <TomSelect
                  id="form-standard"
                  v-model="model.standard_id"
                  placeholder="Select Standard"
                  :options="{
                    allowEmptyOption: false,
                    create: false,
                    placeholder: 'Select Standard',
                    autocomplete: 'off',
                  }"
                  class="w-full"
                  :class="{
                    'border-danger': submitted && v$.standard_id.$errors.length,
                  }"
                >
                  <!-- <option>{{ t('questions.Select Standard')}}</option> -->
                  <option
                    v-for="(standard, indexs) in standards"
                    :key="indexs"
                    :value="indexs"
                  >
                    {{ standard }}
                  </option>
                </TomSelect>
              </div>
              <div class="intro-y col-span-12 sm:col-span-6">
                <label for="form-level" class="form-label">{{
                  t("questions.Choose Difficulty Level")
                }}</label>
                <TomSelect
                  id="form-level"
                  v-model="model.difficulty_level_id"
                  placeholder="Select Difficulty Level"
                  :options="{
                    allowEmptyOption: false,
                    create: false,
                    placeholder: 'Select Difficulty Level',
                    autocomplete: 'off',
                  }"
                  class="w-full"
                  :class="{
                    'border-danger':
                      submitted && v$.difficulty_level_id.$errors.length,
                  }"
                >
                  <!-- <option>{{ t('questions.Select Difficulty Level')}}</option> -->
                  <option
                    v-for="(level, indexd) in difficultyList"
                    :key="indexd"
                    :value="indexd"
                  >
                    {{ JSON.parse(level) }}
                  </option>
                </TomSelect>
              </div>
              <div class="intro-y col-span-12 sm:col-span-6">
                <label for="form-type" class="form-label">{{
                  t("questions.Choose Question Type")
                }}</label>
                <TomSelect
                  id="form-type"
                  v-model="model.type_id"
                  placeholder="Select Type"
                  :options="{
                    allowEmptyOption: false,
                    create: false,
                    placeholder: 'Select Type',
                    autocomplete: 'off',
                    //onChange: changeSelecttype
                  }"
                  class="w-full"
                  :class="{
                    'border-danger': submitted && v$.type_id.$errors.length,
                  }"
                >
                  <!-- <option>{{ t('questions.Select Question Type')}}</option> -->
                  <option
                    v-for="(type, indext) in typeList"
                    :key="indext"
                    :value="indext"
                  >
                    {{ JSON.parse(type) }}
                  </option>
                </TomSelect>
              </div>
              <div class="intro-y col-span-12 sm:col-span-6">
                <label for="form-subject" class="form-label">{{
                  t("questions.Choose Subject")
                }}</label>
                <TomSelect
                  id="form-subject"
                  v-model="model.type_id"
                  placeholder="Select Subject"
                  :options="{
                    allowEmptyOption: false,
                    create: false,
                    placeholder: 'Select Subject',
                    autocomplete: 'off',
                    onChange: selectedSubject
                  }"
                  class="w-full"
                  :class="{
                    'border-danger': submitted && v$.subject_id.$errors.length,
                  }"
                >
                  <option>{{ t('questions.Select Subject')}}</option>
                  <option
                    v-for="(subject, indexsub) in subjects"
                    :key="indexsub"
                    :value="indexsub"
                  >
                    {{ JSON.parse(subject) }}
                  </option>
                </TomSelect>
              </div>
              
              <div class="intro-y col-span-12 sm:col-span-6">
                <label for="form-language" class="form-label">{{
                  t("questions.Choose Language")
                }}</label>
                <TomSelect
                  id="form-language"
                  v-model="model.language_id"
                  placeholder="Select Language"
                  :options="{
                    allowEmptyOption: false,
                    create: false,
                    placeholder: 'Select Language',
                    autocomplete: 'off',
                  }"
                  class="w-full"
                  :class="{
                    'border-danger': submitted && v$.language_id.$errors.length,
                  }"
                >
                  <option
                    v-for="(language, indexl) in languages"
                    :key="indexl"
                    :value="indexl"
                  >
                    {{ language }}
                  </option>
                </TomSelect>
              </div>
            </div>
            <!-- BEGIN: Slide Over Footer -->
            <div class="text-right w-full bottom-0 mt-5">
              <router-link
                to="/subjects"
                class="btn btn-outline-secondary w-20 mr-1"
              >
                {{ t("common.Cancel") }}
              </router-link>
              <button type="submit" class="btn btn-primary w-20">
                {{ t("common.Save") }}
              </button>
            </div>
            <!-- END: Slide Over Footer -->
          </form>
        </div>
        <!-- BEGIN: Post Content -->
      </div>
      <!-- END: Post Content -->
    </div>
  </div>
</template>

<script setup>
import store from "@/stores";
import { ref, reactive, computed, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";

import { useVuelidate } from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators";
import { useI18n } from "vue-i18n";
import axiosClient from "@/axios";
import Editor from "@tinymce/tinymce-vue";

const submitted = ref(false);

const isErrored = ref(false);
const message = ref("");
const isLoading = ref(false);

const route = useRoute();
const router = useRouter();
// Now we must get editing details for the selected item
const { t } = useI18n();
const model = reactive({
  id: "",
  board_id: "",
  standard_id: "",
  difficulty_level_id: "",
  type_id: "",
  subject_id: "",
  language_id: 1,
});

const selectedSubjectId = ref("");
const selectedChapterId = ref("");
const selectedTopicId = ref("");

const rules = computed(() => {
  return {
    board_id: {
      required: helpers.withMessage("Please select board.", required),
    },
    standard_id: {
      required: helpers.withMessage("Please select standard.", required),
    },
    difficulty_level_id: {
      required: helpers.withMessage(
        "Please select difficulty level.",
        required
      ),
    },
    type_id: {
      required: helpers.withMessage("Please select question type.", required),
    },
    subject_id: {
      required: helpers.withMessage("Please select subject.", required),
    },
    language_id: {
      required: helpers.withMessage("Please select language.", required),
    },
  };
});

const v$ = useVuelidate(rules, model);

async function submitForm() {
  //
  submitted.value = true;
  v$.value.$validate(); // checks all inputs
  console.log(v$.value.$errors);
  if (!v$.value.$error) {
    isLoading.value = true;
    await store
      .dispatch("questions/create", model)
      .then(() => {
        isLoading.value = false;
        submitted.value = false;
        router.push({ name: "Questions" });
      })
      .catch((err) => {
        isLoading.value = false;
        isErrored.value = true;
        message.value = err.response.data.message;
      });
  } else {
    // if ANY fail validation
    return;
  }
}
onMounted(() => {
  store.dispatch("listBoard").then().catch();
  store.dispatch("listStandard").then().catch();
  store.dispatch("listDifficultyLevel").then().catch();
  store.dispatch("listType").then().catch();
  store.dispatch("listLanguages").then().catch();
  store.dispatch("listSubjects").then().catch();
});
const languages = computed(() => store.getters.languages);
const boards = computed(() => store.getters.listBoards);
const standards = computed(() => store.getters.listStandards);
const difficultyList = computed(() => store.getters.listDifficultyLevel);
const typeList = computed(() => store.getters.listType);
const subjects = computed(() => store.getters.listSubjects);

function selectedSubject(val) {
    selectedSubjectId.value = val;

}
</script>

<style scoped>
</style>