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
                  <option>{{ t('questions.Select Board')}}</option>
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
                  <option>{{ t('questions.Select Standard')}}</option>
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
                  <option>{{ t('questions.Select Difficulty Level')}}</option>
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
              <div class="intro-y col-span-12 sm:col-span-6">
                <label for="form-subject" class="form-label">{{
                  t("questions.Choose Subject")
                }}</label>
                <TomSelect
                  id="form-subject"
                  v-model="model.subject_id"
                  placeholder="Select Subject"
                  :options="{
                    allowEmptyOption: false,
                    create: false,
                    placeholder: 'Select Subject',
                    autocomplete: 'off',
                    onChange: selectedSubject,
                  }"
                  class="w-full"
                  :class="{
                    'border-danger': submitted && v$.subject_id.$errors.length,
                  }"
                >
                  <option>{{ t("questions.Select Subject") }}</option>
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
                <label for="form-chapter" class="form-label">{{
                  t("questions.Choose Chapter")
                }}</label>
                <TomSelect
                  id="form-chapter"
                  v-model="model.chapter_id"
                  placeholder="Select Chapter"
                  :options="{
                    allowEmptyOption: false,
                    create: false,
                    placeholder: 'Select Chapter',
                    autocomplete: 'off',
                    onChange: selectedChapter,
                  }"
                  class="w-full"
                  :class="{
                    'border-danger': submitted && v$.chapter_id.$errors.length,
                  }"
                >
                  <option>{{ t("questions.Select Chapter") }}</option>
                  <option
                    v-for="(chapter, indexchap) in chapters"
                    :key="indexchap"
                    :value="indexchap"
                  >
                    {{ JSON.parse(chapter) }}
                  </option>
                </TomSelect>
              </div>
              <div class="intro-y col-span-12 sm:col-span-6">
                <label for="form-subject" class="form-label">{{
                  t("questions.Choose Topic")
                }}</label>
                <TomSelect
                  id="form-subject"
                  v-model="model.topic_id"
                  placeholder="Select Topic"
                  :options="{
                    allowEmptyOption: false,
                    create: false,
                    placeholder: 'Select Topic',
                    autocomplete: 'off',
                  }"
                  class="w-full"
                  :class="{
                    'border-danger': submitted && v$.topic_id.$errors.length,
                  }"
                >
                  <option>{{ t("questions.Select Topic") }}</option>
                  <option
                    v-for="(topic, indextop) in topics"
                    :key="indextop"
                    :value="indextop"
                  >
                    {{ JSON.parse(topic) }}
                  </option>
                </TomSelect>
              </div>
              
            </div>
            <div class="mt-3">
                <label for="form-question" class="form-label">{{
                  t("questions.Question")
                }}</label>
                <input
                  id="form-question"
                  type="text"
                  class="form-control"
                  placeholder="Enter question."
                  v-model.trim="model.question"
                  :class="{
                    'border-danger': submitted && v$.question.$errors.length,
                  }"
                />
                <div
                  class="text-danger mt-2"
                  v-for="(error, index) of v$.question.$errors"
                  :key="index"
                >
                  <div class="error-msg">{{ error.$message }}</div>
                </div>
            </div>
            <div class="mt-3">
              <label for="form-description" class="form-label">{{
                t("questions.Description")
              }}</label>

              <div class="py-2">
                <editor
                  id="form-description"
                  v-model="model.description"
                  :class="{
                    'border-danger': submitted && v$.description.$errors.length,
                  }"
                  initialValue="<p>Initial editor content</p>"
                  apiKey="n10p1o42akootxkapivj4ecxefdo4zlaqd0ek0aa47ld9js7"
                  :init="{
                    height: 200,
                    menubar: true,
                    plugins: [
                      'advlist autolink lists link image charmap',
                      'searchreplace visualblocks code fullscreen',
                      'print preview anchor insertdatetime media',
                      'paste code help wordcount table',
                    ],
                    toolbar:
                      'undo redo | formatselect | bold italic | \
                                alignleft aligncenter alignright | \
                                bullist numlist outdent indent | insert | help | \
                                tiny_mce_wiris_formulaEditor | tiny_mce_wiris_formulaEditorChemistry',
                  }"
                >
                </editor>
              </div>

              <!-- END: Inbox Content -->
              <div
                class="text-danger mt-2"
                v-for="(error, index) of v$.description.$errors"
                :key="index"
              >
                <div class="error-msg">{{ error.$message }}</div>
              </div>
            </div>
            <div class="mt-3">
              <label for="form-note" class="form-label">{{
                t("questions.Note/Explaination")
              }}</label>

              <div class="py-2">
                <editor
                  id="form-note"
                  v-model="model.note"
                  :class="{
                    'border-danger': submitted && v$.note.$errors.length,
                  }"
                  initialValue="<p>Initial editor content</p>"
                  apiKey="n10p1o42akootxkapivj4ecxefdo4zlaqd0ek0aa47ld9js7"
                  :init="{
                    height: 200,
                    menubar: true,
                    plugins: [
                      'advlist autolink lists link image charmap',
                      'searchreplace visualblocks code fullscreen',
                      'print preview anchor insertdatetime media',
                      'paste code help wordcount table',
                    ],
                    toolbar:
                      'undo redo | formatselect | bold italic | \
                                alignleft aligncenter alignright | \
                                bullist numlist outdent indent | insert | help | \
                                tiny_mce_wiris_formulaEditor | tiny_mce_wiris_formulaEditorChemistry',
                  }"
                >
                </editor>
              </div>

              <!-- END: Inbox Content -->
              <div
                class="text-danger mt-2"
                v-for="(error, index) of v$.note.$errors"
                :key="index"
              >
                <div class="error-msg">{{ error.$message }}</div>
              </div>
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
                    onChange: changeType
                  }"
                  class="w-full"
                  :class="{
                    'border-danger': submitted && v$.type_id.$errors.length,
                  }"
                >
                  <option>{{ t('questions.Select Question Type')}}</option>
                  <option
                    v-for="(type, indext) in typeList"
                    :key="indext"
                    :value="indext"
                  >
                    {{ JSON.parse(type) }}
                  </option>
                </TomSelect>
              </div>
            <hr />
            <div class="py-5 bg-white" v-if="model.type_id != ''">
              <h3 class="text-2xl flex items-center justify-between">
                {{ t('questions.Answers')}}

                <!-- Add new answer -->
                <button
                  type="button"
                  @click="addAnswer()"
                  class="flex items-center text-sm py-1 px-4 rounded-sm text-white bg-gray-600 hover:bg-gray-700"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                      clip-rule="evenodd"
                    />
                  </svg>
                  {{ t('questions.Add Answer') }}
                </button>
                <!--/ Add new question -->
              </h3>
              <div v-if="!model.answers.length" class="text-center text-gray-600">
                {{ t("questions.You don't have any answers created")}}
              </div>
              <div v-for="(answer, index) in model.answers" :key="answer.id">
                <CreateAnswer
                  :answer="answer"
                  :index="index"
                  :type="selectedType"
                  @change="answerChange"
                  @addAnswer="addAnswer"
                  @deleteAnswer="deleteAnswer"
                />
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
import CreateAnswer from "@/components/answers/Create.vue";

const submitted = ref(false);

const isErrored = ref(false);
const message = ref("");
const isLoading = ref(false);

const route = useRoute();
const router = useRouter();
// Now we must get editing details for the selected item
const { t } = useI18n();
const model = ref({
  id: "",
  board_id: "",
  standard_id: "",
  difficulty_level_id: "",
  type_id: "",
  subject_id: "",
  chapter_id: "",
  topic_id: "",
  language_id: 1,
  question: "",
  description: "",
  note: "",
  answers: [],
});

const selectedSubjectId = ref("");
const selectedChapterId = ref("");
const selectedTopicId = ref("");
const selectedType = ref("");
const chapters = ref([]);
const topics = ref([]);

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
    chapter_id: {
      required: helpers.withMessage("Please select chapter.", required),
    },
    topic_id: {
      required: helpers.withMessage("Please select topic.", required),
    },
    language_id: {
      required: helpers.withMessage("Please select language.", required),
    },
    question: {
      required: helpers.withMessage("Please enter question.", required),
    },
    description: {
      required: helpers.withMessage("Please enter description.", required),
    },
    note: {
      required: helpers.withMessage("Please enter note or explaination.", required),
    }
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

async function selectedSubject(subjectId) {
  selectedSubjectId.value = subjectId;
  chapters.value = [];
  topics.value = [];
  const result = await axiosClient.get(`/chapter_list/${subjectId}`);
  if (result.status != 200) {
    const error = new Error("Failed to fetch chapter");
    throw error;
  } else {
    chapters.value = result.data;
  }
}

async function selectedChapter(chapterId) {
  selectedChapterId.value = chapterId;
  const result = await axiosClient.get(`/topic_list/${chapterId}`);
  if (result.status != 200) {
    const error = new Error("Failed to fetch topic");
    throw error;
  } else {
    topics.value = result.data;
  }
}

function addAnswer(index) {
  const newAnswer = {
    id: "",
    answer: null,
    is_correct: false,
  };
  model.value.answers.splice(index, 0, newAnswer);
}

function changeType(type) {
  selectedType.value = type
}
</script>

<style scoped>
</style>