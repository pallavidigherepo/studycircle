<template>
  <div class="w-full mt-3 xl:mt-0 flex-1">
    <div>
        <div
          class="relative pl-5 pr-5 xl:pr-10 py-10 bg-slate-50 dark:bg-transparent dark:border rounded-md"
        >
          <div class="w-20 flex text-slate-500 xl:mt-1 absolute top-0 right-0 mr-4">
            <a href="#" 
              class="xl:ml-5" 
              @click.prevent="addQuestion()">
              <PlusIcon class="w-5 h-5" />
            </a>
            <a href="#" class="ml-3 xl:ml-5" @click.prevent="deleteQuestion()">
              <Trash2Icon class="w-5 h-5" />
            </a>
          </div>
          <div>
            <div class="form-inline mt-5 first:mt-0">
              <label class="form-label sm:w-20">{{ t("questions.Question") }}</label>
              <div class="flex items-center flex-1 xl:pr-10">
                  <div class="input-group flex-1">
                      <input type="text" 
                            class="form-control" 
                            placeholder="Question" 
                            v-model="model.question"
                            @change="dataChange" />
                      
                  </div>
              </div>
            </div>
            <div class="form-inline mt-5 first:mt-0">
                <label class="form-label sm:w-20">{{ t("questions.Description") }}</label>
                <div class="flex items-center flex-1 xl:pr-10">
                    <div class="input-group flex-1">
                        <textarea class="form-control" 
                                  placeholder="Description" 
                                  v-model="model.description"
                                  @change="dataChange">
                        </textarea>
                        
                    </div>
                </div>
            </div>
            <div class="form-inline mt-5 first:mt-0">
                <label class="form-label sm:w-20">{{ t("questions.Note/Explaination")}}</label>
                <div class="flex items-center flex-1 xl:pr-10">
                    <div class="input-group flex-1">
                        <textarea class="form-control" 
                                  placeholder="Note" 
                                  v-model="model.note" 
                                  @change="dataChange"></textarea>
                        
                    </div>
                </div>
            </div>
            <div class="form-inline mt-5 first:mt-0">
                <label class="form-label sm:w-20">{{ t("questions.Question type")}}</label>
                <div class="flex items-center flex-1 xl:pr-10">
                    <div class="w-full mt-3 xl:mt-0 flex-1">
                        <TomSelect id="form-type" v-model="model.type_id" placeholder="Select Type" 
                            :options="{
                              allowEmptyOption: false,
                              create: false,
                              placeholder: 'Select Type',
                              autocomplete: 'off',
                              onChange: changeType
                            }" >
                            <option>{{ t('questions.Select Question Type') }}</option>
                            <option v-for="(type, indext) in typeParagraph" :key="indext" :value="indext">
                              {{ JSON.parse(type) }}
                            </option>
                          </TomSelect>
                    </div>
                </div>
            </div>
            
            <div class="xl:ml-20 xl:pl-5 xl:pr-10 mt-5 first:mt-0" v-if="model.type_id != ''">
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
                
                <div v-for="(answer, indexanswer) in model.answers" :key="answer.id">
                  <AnswerEditor :answer="answer" 
                                :index="indexanswer" 
                                :type="model.type_id" 
                                @change="answerChange"
                                @addAnswer="addAnswer" 
                                @deleteAnswer="deleteAnswer" />
                </div>
            </div>
          </div>
        </div>
      </div>
  </div>    
</template>

<script setup>
import { ref } from "vue";
import { useI18n } from "vue-i18n";
import AnswerEditor from "@/components/QuestionAnswerEditor/Answer.vue";
import { number } from "@intlify/core-base";

const props = defineProps({
    question: Object,
    index: Number,
    questionIndex: Number,
    type: [String, Number],
    typeParagraph: Object,
    answer: Object
});
const emit = defineEmits(["change", "addQuestion", "deleteQuestion", "questionChange"]);
const { t } = useI18n();
const model = ref(JSON.parse(JSON.stringify(props.question)));
const selectedType = ref("");
const showAnswerButton = ref(true);

function addAnswer(index) {
    const newAnswer = {
      id: makeid(2),
      answer: null,
      is_correct: false,
    };
    
    model.value.answers.splice(index, 0, newAnswer);
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
  model.value.type_id = type;
  // if (shouldHaveOptions()) {
  //   setOptions(getOptions() || []);
  // }
  dataChange();
}

function answerChange(answer) {
  // Important to explicitelly assign question.data.options, because otherwise it is a Proxy object
  // and it is lost in JSON.stringify()
  if (props.question.answers) {
    props.question.answers = [...props.question.answers];
  }
  
  model.value.answers = model.value.answers.map((q) => {
    if (q.id === answer.id) {
      return JSON.parse(JSON.stringify(answer));
    }
    return q;
  });
  dataChange();
}
function dataChange(question) {
  //model.value.question = JSON.parse(JSON.stringify(question));
    const data = model.value;
    // if (!shouldHaveOptions()) {
    //   delete data.data.options;
    // }
  emit('change', data)
}
function addQuestion() {
  emit("addQuestion", props.questionIndex + 1);
}
function deleteQuestion() {
  emit("deleteQuestion", props.question);
}

function makeid(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}

</script>

<style>
</style>