<template>
  <div class="mt-5">
    <template v-if="isTrueFalse()">
      
      <div class="flex-0">
        <div class="xl:flex items-center mt-0 first:mt-0">
          <div class="input-group flex-1">
            
            <select
              id="question_type"
              name="question_type"
              v-model="model.answer"
              class="form-select"
            >
              <option value="1">True</option>
              <option value="0">False</option>
            </select>
          </div>
        </div>
      </div>
    </template>
    <template v-else>
      <!-- Answer index -->
      <template v-if="shouldHaveOptions()">
        
        <div class="form-inline mt-5 items-start first:mt-0">
          <label class="form-label mt-2 sm:w-20">Option {{ index + 1 }}.</label>
          <div class="flex-1">
            <div class="xl:flex items-center mt-5 first:mt-0">
              <div class="input-group flex-1">
                <textarea
                  v-if="'answer-text' + index"
                  :name="'answer_' + index"
                  v-model="model.answer"
                  @change="dataChange"
                  :id="'answer_' + index"
                  class="form-control"
                ></textarea>
                
                <div class="input-group-text">
                  <input
                    v-if="type == 1 || type == 3"
                    :id="`is_correct`+index"
                    name="is_correct"
                    type="radio"
                    v-model="model.is_correct"
                    @change="dataChange"
                    class="
                      form-check-input
                    "
                  />
                  <input
                    v-if="type == 2"
                    :id="`is_correct`+index"
                    name="is_correct"
                    type="checkbox"
                    v-model="model.is_correct"
                    @change="dataChange"
                    class="
                      form-check-input
                    "
                  />
                  <label :for="`is_correct`+index" class="form-check-label">{{ t("questions.Is Correct") }}</label>
                </div>
              </div>
              <div class="w-20 flex text-slate-500 mt-3 xl:mt-0">
                <a href="#" 
                  class="xl:ml-5" 
                  v-if="!isTrueFalse()"
                  @click.prevent="addAnswer()">
                  <PlusIcon class="w-5 h-5" />
                </a>
                <a href="#" class="ml-3 xl:ml-5" @click.prevent="deleteAnswer()">
                  <Trash2Icon class="w-5 h-5" />
                </a>
              </div>
            </div>
          </div>
        </div>
      </template>
    </template>
  </div>
</template>

<script setup>
import store from "@/stores";
import { useI18n } from "vue-i18n";
import { ref, computed } from "vue";
import Editor from "@tinymce/tinymce-vue";

const { t } = useI18n();

const props = defineProps({
  answer: Object,
  index: Number,
  type: [String, Number],
  typeParagraph: Object,
});
const emit = defineEmits(["change", "addAnswer", "deleteAnswer"]);

const model = ref(JSON.parse(JSON.stringify(props.answer)));

// Get question types from vuex
const questionTypes = computed(() => store.state.questionTypes);
function upperCaseFirst(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}
// Check if the question should have options
function shouldHaveOptions() {
  return ["1", "2", "3"].includes(props.type);
}
// Check if the question is true/false
function isTrueFalse() {
  return ["4"].includes(props.type);
}
// Emit the data change
function dataChange() {
  const data = model.value;
  if (!shouldHaveOptions()) {
    delete data.answers;
  }
  emit("change", data);
}
function addAnswer() {
  emit("addAnswer", props.index + 1);
}
function deleteAnswer() {
  emit("deleteAnswer", props.answer);
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