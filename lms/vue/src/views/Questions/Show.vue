<template>
  <div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">
        {{ t("questions.Question Details") }}
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

      <div class="intro-y col-span-11 2xl:col-span-9">

        <!-- BEGIN: Board and Standard selection -->
        <div class="intro-y box p-5 mt-5">
          <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
            <div
              class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
              <ChevronDownIcon class="w-4 h-4 mr-2" /> {{ t("questions.Selected Board & Standard/Class") }}
            </div>
            <div class="mt-5">
            
              <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                <div class="form-label xl:w-64 xl:!mr-10">
                  <div class="text-left">
                    <div class="flex items-center">
                      <div class="font-medium">{{
                          t("questions.Board")
                      }}</div>
                    </div>

                  </div>
                </div>
                <div class="w-full mt-3 xl:mt-0 flex-1">
                  {{ question ? question.board.name: null }}
                </div>
              </div>
              <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                <div class="form-label xl:w-64 xl:!mr-10">
                  <div class="text-left">
                    <div class="flex items-center">
                      <div class="font-medium">{{
                          t("questions.Standard")
                      }}</div>
                    </div>

                  </div>
                </div>
                <div class="w-full mt-3 xl:mt-0 flex-1">
                  {{ question? question.standard.name: null }}
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
              <ChevronDownIcon class="w-4 h-4 mr-2" /> {{ t("questions.Select Difficulty level & Language") }}
            </div>
            <div class="mt-5">

              <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                <div class="form-label xl:w-64 xl:!mr-10">
                  <div class="text-left">
                    <div class="flex items-center">
                      <div class="font-medium">{{
                          t("questions.Difficulty Level")
                      }}</div>
                      
                    </div>
                  </div>
                </div>
                <div class="w-full mt-3 xl:mt-0 flex-1">
                  {{ question ? JSON.parse(question.difficulty_level.name): null }}
                </div>
              </div>
              <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                <div class="form-label xl:w-64 xl:!mr-10">
                  <div class="text-left">
                    <div class="flex items-center">
                      <div class="font-medium">{{
                          t("questions.Language")
                      }}</div>
                      
                    </div>

                  </div>
                </div>
                <div class="w-full mt-3 xl:mt-0 flex-1">
                  {{ question ? (question.language_id==1 ? 'English': 'Other'): null }}
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
              <ChevronDownIcon class="w-4 h-4 mr-2" /> {{ t("questions.Select Subject, Chapter and Topic") }}
            </div>
            <div class="mt-5">

              <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                <div class="form-label xl:w-64 xl:!mr-10">
                  <div class="text-left">
                    <div class="flex items-center">
                      <div class="font-medium">{{
                          t("questions.Choose Subject")
                      }}</div>
                      
                    </div>
                  </div>
                </div>
                <div class="w-full mt-3 xl:mt-0 flex-1">
                  {{ question ? JSON.parse(question.subject.label): null }}
                </div>
              </div>
              <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                <div class="form-label xl:w-64 xl:!mr-10">
                  <div class="text-left">
                    <div class="flex items-center">
                      <div class="font-medium">{{
                          t("questions.Choose Chapter")
                      }}</div>
                      
                    </div>

                  </div>
                </div>
                <div class="w-full mt-3 xl:mt-0 flex-1">
                  {{ question ? JSON.parse(question.chapter.label): null }}
                </div>
              </div>
              <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                <div class="form-label xl:w-64 xl:!mr-10">
                  <div class="text-left">
                    <div class="flex items-center">
                      <div class="font-medium">{{
                          t("questions.Choose Topic")
                      }}</div>
                    </div>

                  </div>
                </div>
                <div class="w-full mt-3 xl:mt-0 flex-1">
                  {{ question ? JSON.parse(question.topic.label): null }}
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
              <ChevronDownIcon class="w-4 h-4 mr-2" /> {{ t("questions.Question & Solution") }}
            </div>
            <div class="mt-5">

              <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                <div class="form-label xl:w-64 xl:!mr-10">
                  <div class="text-left">
                    <div class="flex items-center">
                      <div class="font-medium">{{
                          t("questions.Question")
                      }}</div>
                      
                    </div>
                  </div>
                </div>
                <div class="w-full mt-3 xl:mt-0 flex-1">
                  {{ question ? question.question: null }}
                </div>
              </div>
              <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                <div class="form-label xl:w-64 xl:!mr-10">
                  <div class="text-left">
                    <div class="flex items-center">
                      <div class="font-medium">{{
                          t("questions.Description")
                      }}</div>
                    </div>
                  </div>
                </div>
                <div class="w-full mt-3 xl:mt-0 flex-1">
                  {{ question ? question.description: null }}
                </div>
              </div>
              <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                <div class="form-label xl:w-64 xl:!mr-10">
                  <div class="text-left">
                    <div class="flex items-center">
                      <div class="font-medium">{{
                          t("questions.Note/Explaination")
                      }}</div>
                    </div>
                  </div>
                </div>
                <div class="w-full mt-3 xl:mt-0 flex-1">
                  {{ question ? question.note: null }}
                </div>
              </div>
              <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                <div class="form-label xl:w-64 xl:!mr-10">
                  <div class="text-left">
                    <div class="flex items-center">
                      <div class="font-medium">{{
                          t("questions.Marks")
                      }}</div>
                    </div>
                  </div>
                </div>
                <div class="w-full mt-3 xl:mt-0 flex-1">
                  {{ question ? question.marks: null }}
                </div>
              </div>
              <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                <div class="form-label xl:w-64 xl:!mr-10">
                  <div class="text-left">
                    <div class="flex items-center">
                      <div class="font-medium">{{
                          t("questions.Negative Marks")
                      }}</div>
                    </div>
                  </div>
                </div>
                <div class="w-full mt-3 xl:mt-0 flex-1">
                  {{ question ? question.negative_marks: null }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END: Subject, Chapter and Topic selection -->
        <!-- BEGIN: Product Variant (Details) -->
        <div class="intro-y box p-5 mt-5">
          <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
            <div
              class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
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
                    </div>

                  </div>
                </div>
                <div class="w-full mt-3 xl:mt-0 flex-1">
                  {{ question ? JSON.parse(question.question_type.name): null }}
                </div>
              </div>
              <!-- <div class="form-inline items-start flex-col xl:flex-row mt-2 pt-2 first:mt-0 first:pt-0"
                v-if="model.type_id != '' && model.type_id != 'Select Question Type' && model.type_id != 5">
                <div class="form-label xl:w-64 xl:!mr-10">
                  <div class="text-left">
                    <div class="flex items-center">
                      <div class="font-medium" v-if="model.type_id != 5">{{ t("questions.Answers") }}</div>

                    </div>
                    <div class="leading-relaxed text-slate-500 text-xs mt-3" v-if="model.type_id != 5">
                      {{ t("questions.Add answers according to the type of question you have selected") }}
                    </div>
                  </div>
                </div>
                <div class="w-full mt-3 xl:mt-0 flex-1">
                  <div class="relative pl-5 pr-5 xl:pr-10 py-10 bg-slate-50 dark:bg-transparent dark:border rounded-md">
                    <template v-if="model.type_id == 4">
                      <AnswerEditor :answer="{}" :index="1" :type="selectedType" @change="answerChange"
                        @addAnswer="addAnswer" @deleteAnswer="deleteAnswer" />
                    </template>
                    <template v-else-if="model.type_id == 5">
                      <div v-if="!model.questions.length" class="text-center text-gray-600">
                        {{ t("questions.You do not have any questions added yet") }}
                      </div>
                      <div class="xl:ml-20 xl:pl-5 xl:pr-20 first:mt-0 mt-5">
                        <button class="btn btn-outline-primary border-dashed w-full" type="button"
                          @click="addQuestion()">
                          <PlusIcon class="w-4 h-4 mr-2" /> {{ t("questions.Add Question") }}
                        </button>
                      </div>
                      <div v-for="(question, index) in model.questions" :key="question.id">
                        <QuestionEditor :question="question" :questionIndex="index" :type="selectedType"
                          :typeParagraph="typeListParagraph" @change="questionChange" @addQuestion="addQuestion"
                          @deleteQuestion="deleteQuestion" />
                      </div>
                    </template>
                    <template v-else>
                      <div v-if="!model.answers.length" class="text-center text-gray-600">
                        {{ t("questions.You do not have any answers added yet") }}
                      </div>
                      <div class="xl:ml-20 xl:pl-5 xl:pr-20 first:mt-0 mt-5">
                        <button class="btn btn-outline-primary border-dashed w-full" type="button"
                          v-if="showAnswerButton == true" @click="addAnswer()">
                          <PlusIcon class="w-4 h-4 mr-2" /> {{ t("questions.Add Answer") }}
                        </button>
                      </div>

                      <div class="mt-5">

                        <div v-for="(answer, index) in model.answers" :key="answer.id">
                          <AnswerEditor :answer="answer" :index="index" :type="selectedType"
                            :typeParagraph="typeListParagraph" @change="answerChange" @addAnswer="addAnswer"
                            @deleteAnswer="deleteAnswer" />
                        </div>
                      </div>
                    </template>
                  </div>
                </div>
              </div>
              <div v-else-if="model.type_id == 5" class="intro-y box p-5 mt-5">
                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                  <div
                    class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                    <ChevronDownIcon class="w-4 h-4 mr-2" /> {{ t("questions.Questions of paragraph") }}
                    <div class="xl:ml-20 xl:pl-5 xl:pr-20 first:mt-0 mt-5">
                      <button class="btn btn-outline-primary border-dashed w-full" type="button" @click="addQuestion()">
                        <PlusIcon class="w-4 h-4 mr-2" /> {{ t("questions.Add Question") }}
                      </button>
                    </div>
                  </div>

                  <div class="mt-5">
                    <div v-if="!model.questions.length" class="text-center text-gray-600">
                      {{ t("questions.You do not have any questions added yet") }}
                    </div>

                    <div class="form-inline items-start flex-col xl:flex-row mt-2 pt-2 first:mt-0 first:pt-0"
                      v-for="(question, index) in model.questions" :key="question.id">
                      <div class="form-label xl:w-64 xl:!mr-10">
                        <div class="text-left">
                          <div class="flex items-center">
                            <div class="font-medium">{{ t("questions.Question") }} {{ index + 1 }}.</div>
                          </div>
                          <div class="leading-relaxed text-slate-500 text-xs mt-3">
                            {{ t("questions.Add questions and its answers accordingly") }}
                          </div>
                        </div>
                      </div>

                      <QuestionEditor :question="question" :index="index" :type="selectedType"
                        :typeParagraph="typeListParagraph" @change="questionChange" @addQuestion="addQuestion"
                        @deleteQuestion="deleteQuestion" />
                    </div>
                  </div>
                </div>
              </div> -->

            </div>

          </div>
        </div>
        <!-- END: Product Variant (Details) -->
        
      </div>
    <Loading v-if="isLoading" fixed></Loading>
  </div>
</template>

<script setup>
import store from "@/stores";
import { ref, computed, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";

import { useI18n } from "vue-i18n";

const route = useRoute();
const router = useRouter();
const { t } = useI18n();

const message = ref("");
const isLoading = ref(false);

const fetch = async() => {
    isLoading.value = true;
    try {
        let id = route.params.id;
        await store
                .dispatch("questions/show", id)
                .then(() => {
                    isLoading.value = false;
                })
                .catch((err) => {
                    isLoading.value = false;                    
                });
    } catch (e) {
        message.value = e;
    } finally {
        isLoading.value = false;
    }
};

onMounted(() => {
  fetch();
});

const question = computed(() => store.getters['questions/question']);
</script>

<style scoped>

</style>