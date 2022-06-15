<template>
  <div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">
        {{ t("questions.Add Question") }}
      </h2>
      <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <router-link to="/questions" class="
            btn
            box
            text-gray-700
            dark:text-gray-300
            mr-2
            flex
            items-center
            ml-auto
            sm:ml-0
          ">
          <ArrowLeftCircleIcon class="w-4 h-4 mr-2" />{{ t("common.Back") }}
        </router-link>
      </div>
    </div>
    <div class="alert alert-danger show flex items-center mb-2" role="alert" v-if="isErrored">
      <AlertOctagonIcon class="w-6 h-6 mr-2" />
      {{ message }}
    </div>
    <form @submit.prevent="submitForm" class="validate-form">
    <div class="intro-y col-span-11 2xl:col-span-9">
      
      <!-- BEGIN: Board and Standard selection -->
      <div class="intro-y box p-5 mt-5">
        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
          <div
            class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
            <ChevronDownIcon class="w-4 h-4 mr-2" /> {{ t("questions.Select Board & Standard/Class")}}
          </div>
          <div class="mt-5">
            
            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
              <div class="form-label xl:w-64 xl:!mr-10">
                <div class="text-left">
                  <div class="flex items-center">
                    <div class="font-medium">{{
                    t("questions.Choose Board")
                }}</div>
                    <div
                      class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                      {{ t("common.Required")}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="w-full mt-3 xl:mt-0 flex-1">
                <TomSelect id="form-board" 
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
                          }">
                  <option>{{ t('questions.Select Board') }}</option>
                  <option v-for="(board, index) in boards" :key="index" :value="index">
                    {{ board }}
                  </option>
                </TomSelect>
              </div>
            </div>
            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
              <div class="form-label xl:w-64 xl:!mr-10">
                <div class="text-left">
                  <div class="flex items-center">
                    <div class="font-medium">{{
                        t("questions.Choose Standard")
                    }}</div>
                    <div
                      class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                      {{ t("common.Required")}}
                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="w-full mt-3 xl:mt-0 flex-1">
                <TomSelect id="form-standard" v-model="model.standard_id" placeholder="Select Standard" :options="{
                  allowEmptyOption: false,
                  create: false,
                  placeholder: 'Select Standard',
                  autocomplete: 'off',
                }" class="w-full" :class="{
  'border-danger': submitted && v$.standard_id.$errors.length,
}">
                  <option>{{ t('questions.Select Standard') }}</option>
                  <option v-for="(standard, indexs) in standards" :key="indexs" :value="indexs">
                    {{ standard }}
                  </option>
                </TomSelect>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END: Board and Standard selection -->
      <!-- BEGIN: Language and Difficulty level selection -->
      <div class="intro-y box p-5 mt-5">
        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
          <div
            class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
            <ChevronDownIcon class="w-4 h-4 mr-2" /> {{ t("questions.Select Difficulty level & Language")}}
          </div>
          <div class="mt-5">
            
            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
              <div class="form-label xl:w-64 xl:!mr-10">
                <div class="text-left">
                  <div class="flex items-center">
                    <div class="font-medium">{{
                    t("questions.Choose Difficulty Level")
                }}</div>
                    <div
                      class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                      {{ t("common.Required")}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="w-full mt-3 xl:mt-0 flex-1">
                <TomSelect id="form-level" v-model="model.difficulty_level_id" placeholder="Select Difficulty Level"
                  :options="{
                    allowEmptyOption: false,
                    create: false,
                    placeholder: 'Select Difficulty Level',
                    autocomplete: 'off',
                  }" class="w-full" :class="{
  'border-danger':
    submitted && v$.difficulty_level_id.$errors.length,
}">
                  <option>{{ t('questions.Select Difficulty Level') }}</option>
                  <option v-for="(level, indexd) in difficultyList" :key="indexd" :value="indexd">
                    {{ JSON.parse(level) }}
                  </option>
                </TomSelect>
              </div>
            </div>
            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
              <div class="form-label xl:w-64 xl:!mr-10">
                <div class="text-left">
                  <div class="flex items-center">
                    <div class="font-medium">{{
                        t("questions.Language")
                    }}</div>
                    <div
                      class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                      {{ t("common.Required")}}
                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="w-full mt-3 xl:mt-0 flex-1">
                <TomSelect id="form-language" v-model="model.language_id" placeholder="Select Language" :options="{
                  allowEmptyOption: false,
                  create: false,
                  placeholder: 'Select Language',
                  autocomplete: 'off',
                }" class="w-full" :class="{
  'border-danger': submitted && v$.language_id.$errors.length,
}">
                  <option v-for="(language, indexl) in languages" :key="indexl" :value="indexl">
                    {{ language }}
                  </option>
                </TomSelect>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END: Language and Difficulty level selection -->
      <!-- BEGIN: Subject, Chapter and Topic selection -->
      <div class="intro-y box p-5 mt-5">
        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
          <div
            class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
            <ChevronDownIcon class="w-4 h-4 mr-2" /> {{ t("questions.Select Subject, Chapter and Topic")}}
          </div>
          <div class="mt-5">
            
            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
              <div class="form-label xl:w-64 xl:!mr-10">
                <div class="text-left">
                  <div class="flex items-center">
                    <div class="font-medium">{{
                    t("questions.Choose Subject")
                }}</div>
                    <div
                      class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                      {{ t("common.Required")}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="w-full mt-3 xl:mt-0 flex-1">
                <TomSelect id="form-subject" v-model="model.subject_id" placeholder="Select Subject" :options="{
                  allowEmptyOption: false,
                  create: false,
                  placeholder: 'Select Subject',
                  autocomplete: 'off',
                  onChange: selectedSubject,
                }" class="w-full" :class="{
  'border-danger': submitted && v$.subject_id.$errors.length,
}">
                  <option>{{ t("questions.Select Subject") }}</option>
                  <option v-for="(subject, indexsub) in subjects" :key="indexsub" :value="indexsub">
                    {{ JSON.parse(subject) }}
                  </option>
                </TomSelect>
              </div>
            </div>
            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
              <div class="form-label xl:w-64 xl:!mr-10">
                <div class="text-left">
                  <div class="flex items-center">
                    <div class="font-medium">{{
                        t("questions.Choose Chapter")
                    }}</div>
                    <div
                      class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                      {{ t("common.Required")}}
                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="w-full mt-3 xl:mt-0 flex-1">
                <TomSelect id="form-chapter" v-model="model.chapter_id" placeholder="Select Chapter" :options="{
                  allowEmptyOption: false,
                  create: false,
                  placeholder: 'Select Chapter',
                  autocomplete: 'off',
                  onChange: selectedChapter,
                }" class="w-full" :class="{
  'border-danger': submitted && v$.chapter_id.$errors.length,
}">
                  <option>{{ t("questions.Select Chapter") }}</option>
                  <option v-for="(chapter, indexchap) in chapters" :key="indexchap" :value="indexchap">
                    {{ JSON.parse(chapter) }}
                  </option>
                </TomSelect>
              </div>
            </div>
            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
              <div class="form-label xl:w-64 xl:!mr-10">
                <div class="text-left">
                  <div class="flex items-center">
                    <div class="font-medium">{{
                    t("questions.Choose Topic")
                }}</div>
                    <div
                      class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                      {{ t("common.Required")}}
                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="w-full mt-3 xl:mt-0 flex-1">
                <TomSelect id="form-subject" v-model="model.topic_id" placeholder="Select Topic" :options="{
                  allowEmptyOption: false,
                  create: false,
                  placeholder: 'Select Topic',
                  autocomplete: 'off',
                }" class="w-full" :class="{
  'border-danger': submitted && v$.topic_id.$errors.length,
}">
                  <option>{{ t("questions.Select Topic") }}</option>
                  <option v-for="(topic, indextop) in topics" :key="indextop" :value="indextop">
                    {{ JSON.parse(topic) }}
                  </option>
                </TomSelect>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END: Subject, Chapter and Topic selection -->
      <!-- BEGIN: Question and Solution -->
      <div class="intro-y box p-5 mt-5">
        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
          <div
            class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
            <ChevronDownIcon class="w-4 h-4 mr-2" /> {{ t("questions.Question & Solution")}}
          </div>
          <div class="mt-5">
            
            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
              <div class="form-label xl:w-64 xl:!mr-10">
                <div class="text-left">
                  <div class="flex items-center">
                    <div class="font-medium">{{
                  t("questions.Question")
              }}</div>
                    <div
                      class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                      {{ t("common.Required")}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="w-full mt-3 xl:mt-0 flex-1">
                <input id="form-question" type="text" class="form-control" placeholder="Enter question."
                    v-model.trim="model.question" :class="{
                      'border-danger': submitted && v$.question.$errors.length,
                    }" />
                  <div class="form-help text-right">Maximum character 0/70</div>
                  <div class="text-danger mt-2" v-for="(error, index) of v$.question.$errors" :key="index">
                    <div class="error-msg">{{ error.$message }}</div>
                  </div>                
              </div>
            </div>
            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
              <div class="form-label xl:w-64 xl:!mr-10">
                <div class="text-left">
                  <div class="flex items-center">
                    <div class="font-medium">{{
                  t("questions.Description")
              }}</div>
                    <div
                      class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                      {{ t("common.Required")}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="w-full mt-3 xl:mt-0 flex-1">
                <editor id="form-description" v-model="model.description" :class="{
                    'border-danger': submitted && v$.description.$errors.length,
                  }" initialValue="<p>Initial editor content</p>"
                    apiKey="n10p1o42akootxkapivj4ecxefdo4zlaqd0ek0aa47ld9js7" :init="{
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
                    }">
                  </editor>
                  <div class="text-danger mt-2" v-for="(error, index) of v$.description.$errors" :key="index">
                    <div class="error-msg">{{ error.$message }}</div>
                  </div>           
              </div>
            </div>
            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
              <div class="form-label xl:w-64 xl:!mr-10">
                <div class="text-left">
                  <div class="flex items-center">
                    <div class="font-medium">{{
                  t("questions.Note/Explaination")
              }}</div>
                    <div
                      class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                      {{ t("common.Required")}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="w-full mt-3 xl:mt-0 flex-1">
                <editor id="form-note" v-model="model.note" :class="{
                  'border-danger': submitted && v$.note.$errors.length,
                }" initialValue="<p>Initial editor content</p>"
                  apiKey="n10p1o42akootxkapivj4ecxefdo4zlaqd0ek0aa47ld9js7" :init="{
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
                  }">
                </editor>
                  <div class="text-danger mt-2" v-for="(error, index) of v$.note.$errors" :key="index">
                    <div class="error-msg">{{ error.$message }}</div>
                  </div>                
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END: Subject, Chapter and Topic selection -->
      <!-- BEGIN: Product Variant (Details) -->
      <div class="intro-y box p-5 mt-5">
        <div
          class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5"
        >
          <div
            class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5"
          >
            <ChevronDownIcon class="w-4 h-4 mr-2" /> {{ t("questions.Select Question Type & Add Answer") }}
          </div>
          <div class="mt-5">
            
            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
              <div class="form-label xl:w-64 xl:!mr-10">
                <div class="text-left">
                  <div class="flex items-center">
                    <div class="font-medium">{{
                  t("questions.Choose Question Type")
              }}</div>
                    <div
                      class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                      {{ t("common.Required")}}
                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="w-full mt-3 xl:mt-0 flex-1">
                <TomSelect id="form-type" v-model="model.type_id" placeholder="Select Type" :options="{
                allowEmptyOption: false,
                create: false,
                placeholder: 'Select Type',
                autocomplete: 'off',
                onChange: changeType
              }" class="w-full" :class="{
  'border-danger': submitted && v$.type_id.$errors.length,
}">
                <option>{{ t('questions.Select Question Type') }}</option>
                <option v-for="(type, indext) in typeList" :key="indext" :value="indext">
                  {{ JSON.parse(type) }}
                </option>
              </TomSelect>
              </div>
            </div>
            <div
              class="form-inline items-start flex-col xl:flex-row mt-2 pt-2 first:mt-0 first:pt-0"
              v-if="model.type_id != '' && model.type_id != 'Select Question Type'"
            >
              
                
                <div class="form-label xl:w-64 xl:!mr-10">
                  <div class="text-left">
                    <div class="flex items-center">
                      <div class="font-medium">{{ t("questions.Answers")}}</div>
                    </div>
                    <div class="leading-relaxed text-slate-500 text-xs mt-3">
                      {{ t("questions.Add answers according to the type of question you have selected")}}
                    </div>
                  </div>
                </div>
                <div class="w-full mt-3 xl:mt-0 flex-1">
                  <div
                    class="relative pl-5 pr-5 xl:pr-10 py-10 bg-slate-50 dark:bg-transparent dark:border rounded-md"
                  >
                    <template v-if="model.type_id == 4">
                      <CreateAnswer :answer="{}" 
                                    :index="1" 
                                    :type="selectedType" 
                                    :typeParagraph="typeListParagraph"
                                    @change="answerChange"
                                    @addAnswer="addAnswer" 
                                    @deleteAnswer="deleteAnswer" />
                    </template>
                    <template v-else>
                      <div v-if="!model.answers.length" class="text-center text-gray-600">
                              {{ t("questions.You do not have any answers added yet") }}
                            </div>
                            <div class="xl:ml-20 xl:pl-5 xl:pr-20 first:mt-0 mt-5">
                              <button
                                class="btn btn-outline-primary border-dashed w-full"
                                type="button"
                                v-if="showAnswerButton == true" @click="addAnswer()"
                              >
                                <PlusIcon class="w-4 h-4 mr-2" /> {{ t("questions.Add Answer") }}
                              </button>
                            </div>
                          
                            <div class="mt-5">
                              
                              <div v-for="(answer, index) in model.answers" :key="answer.id">
                                <CreateAnswer :answer="answer" 
                                              :index="index" 
                                              :type="selectedType" 
                                              :typeParagraph="typeListParagraph"
                                              @change="answerChange"
                                              @addAnswer="addAnswer" 
                                              @deleteAnswer="deleteAnswer" />
                              </div>
                              
                            </div>
                    </template>
                      
                  </div>
                </div>
            </div>
            
          </div>
        </div>
      </div>
      <!-- END: Product Variant (Details) -->
      <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
        <router-link to="/subjects" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">
          {{ t("common.Cancel") }}
        </router-link>

        <button type="submit" class="btn py-3 btn-primary w-full md:w-52">
          {{ t("common.Save") }}
        </button>
      </div>
    </div>
    </form>
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
const showAnswerButton = ref(true);

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
  store.dispatch("listTypeParagraph").then().catch();
});
const languages = computed(() => store.getters.languages);
const boards = computed(() => store.getters.listBoards);
const standards = computed(() => store.getters.listStandards);
const difficultyList = computed(() => store.getters.listDifficultyLevel);
const typeList = computed(() => store.getters.listType);
const typeListParagraph = computed(() => store.getters.listTypeParagraph);
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
  if (selectedType.value == 5) {
    //return ;
  } else {
    const newAnswer = {
      id: "",
      answer: null,
      is_correct: false,
    };
    model.value.answers.splice(index, 0, newAnswer);
  }

}

function deleteAnswer(answer) {
  model.value.answers = model.value.answers.filter((q) => q !== answer);
}
function changeType(type) {
  selectedType.value = type;
  if (type == 5) {
    //  showAnswerButton.value = false;
  } else {
    showAnswerButton.value = true;
  }
}

function answerChange(answer) {
  // Important to explicitelly assign question.data.options, because otherwise it is a Proxy object
  // and it is lost in JSON.stringify()
  /*if (question.data.options) {
    question.data.options = [...question.data.options];
  }*/
  model.value.answers = model.value.answers.map((q) => {
    if (q.id === answer.id) {
      return JSON.parse(JSON.stringify(answer));
    }
    return q;
  });
}
</script>

<style scoped>
</style>