<template>
  <div class="mt-5">
    <template v-if="isTrueFalse()">
      <select
        id="question_type"
        name="question_type"
        v-model="model.answer"
        class="
          mt-1
          block
          w-full
          py-2
          px-3
          border border-gray-300
          bg-white
          rounded-md
          shadow-sm
          focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
          sm:text-sm
        "
      >
        <option value="true">True</option>
        <option value="false">False</option>
      </select>
    </template>
    <template v-else>
      <!-- Answer index -->
      <template v-if="shouldHaveOptions()">
        
        <div class="form-inline mt-5 items-start first:mt-0">
          <label class="form-label mt-2 sm:w-20">{{ index + 1 }}</label>
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
                  v-if="type == 1 || type == 6"
                  :id="`is_correct`+index"
                  name="is_correct"
                  type="radio"
                  v-model="model.is_correct"
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
                  class="
                    form-check-input
                  "
                />
                  <label :for="`is_correct`+index" class="form-check-label">{{
                  t("questions.Is Correct")
                }}</label>
                </div>
              </div>
              <div class="w-20 flex text-slate-500 mt-3 xl:mt-0">
                <a href="#" 
                  class="xl:ml-5" 
                  v-if="!isTrueFalse()"
                  @click.prevent="addAnswer()">
                  <PlusIcon class="w-4 h-4" />
                </a>
                <a href="#" class="ml-3 xl:ml-5" @click.prevent="deleteAnswer()">
                  <Trash2Icon class="w-4 h-4" />
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
});
const emit = defineEmits(["change", "addAnswer", "deleteAnswer"]);

const model = ref(JSON.parse(JSON.stringify(props.answer)));

// Get question types from vuex
const questionTypes = computed(() => store.state.questionTypes);
function upperCaseFirst(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}
function getOptions() {
  return model.value.data.options;
}
function setOptions(options) {
  model.value.data.options = options;
}
// Check if the question should have options
function shouldHaveOptions() {
  return ["1", "2", "6"].includes(props.type);
}
// Check if the question is true/false
function isTrueFalse() {
  return ["5"].includes(props.type);
}
// Add option
function addOption() {
  setOptions([...getOptions(), { uuid: uuidv4(), text: "" }]);
  dataChange();
}
// Remove option
function removeOption(op) {
  setOptions(getOptions().filter((opt) => opt !== op));
  dataChange();
}
function typeChange() {
  if (shouldHaveOptions()) {
    setOptions(getOptions() || []);
  }
  dataChange();
}
// Emit the data change
function dataChange() {
  const data = model.value;
  if (!shouldHaveOptions()) {
    delete data.data.options;
  }
  emit("change", data);
}
function addAnswer() {
  emit("addAnswer", props.index + 1);
}
function deleteAnswer() {
  emit("deleteAnswer", props.answer);
}
</script>

<style>
</style>