<template>
  <div>
    <!-- Answer index -->
    <div class="flex items-center justify-between">
      <h3 class="text-lg font-bold">{{ index + 1 }}. {{ model.answer }}</h3>

      <div class="flex items-center">
        <!-- Add new answer -->
        <button
          type="button"
          v-if=!isTrueFalse()
          @click="addAnswer()"
          class="
            flex
            items-center
            text-xs
            py-1
            px-3
            mr-2
            rounded-sm
            text-white
            bg-gray-600
            hover:bg-gray-700
          "
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
          {{ t("common.Add") }}
        </button>
        <!--/ Add new answer -->

        <!-- Delete answer -->
        <button
          type="button"
          @click="deleteAnswer()"
          class="
            flex
            items-center
            text-xs
            py-1
            px-3
            rounded-sm
            border border-transparent
            text-red-500
            hover:border-red-600
          "
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-4 w-4"
            viewBox="0 0 20 20"
            fill="currentColor"
          >
            <path
              fill-rule="evenodd"
              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
              clip-rule="evenodd"
            />
          </svg>
          {{ t("common.Delete") }}
        </button>
        <!--/ Delete answer -->
      </div>
    </div>
    <!--/ Answer index -->
    <div class="grid gap-3 grid-cols-12">
      <!-- Answer -->
      <template v-if="shouldHaveOptions()">
        <div class="mt-3 col-span-9">
          <label
            :for="'answer_' + index"
            class="block text-sm font-medium text-gray-700"
            >{{ t("questions.Answer") }}</label
          >
          <textarea 
            v-if="'answer-text'+index"
            :name="'answer_' + index"
            v-model="model.answer"
            @change="dataChange"
            :id="'answer_' + index"
            class="
              mt-1
              focus:ring-black-500 focus:border-black-500
              block
              w-full
              shadow-sm
              sm:text-sm
              border-gray-300
              rounded-md
            "
            ></textarea>
          <editor
            v-else
            :name="'answer_' + index"
            v-model="model.answer"
            @change="dataChange"
            :id="'answer_' + index"
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
          <!-- <span><a href="#" @click.prevent="!'answer-text'+index">Click here for editor</a></span> -->
        </div>
        <!--/ Answer -->

        <!-- Is Correct -->
        <div class="mt-3 col-span-3">
          <div class="flex items-center h-5">
            <input
              v-if="type == 1"
              id="is_correct"
              name="is_correct"
              type="radio"
              v-model="model.is_correct"
              class="
                focus:ring-black-500
                h-4
                w-4
                text-black-600
                border-gray-300
                rounded
              "
            />
            <input
              v-if="type == 2"
              id="is_correct"
              name="is_correct"
              type="checkbox"
              v-model="model.is_correct"
              class="
                focus:ring-indigo-500
                h-4
                w-4
                text-indigo-600
                border-gray-300
                rounded
              "
            />
          </div>
          <div class="ml-3 text-sm">
            <label for="is_correct" class="font-medium text-gray-700">{{
              t("questions.Is Correct")
            }}</label>
          </div>
        </div>
        <!--/ Is Correct -->
      </template>
      <template v-else-if="isTrueFalse()">
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
          ">
          <option value="true">True</option>
          <option value="false">False</option>
        </select>
      </template>
    </div>
    <hr class="my-4" />
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
  //console.log(["1", "2"].includes(props.type)); return ;
  return ["1", "2"].includes(props.type);
}
// Check if the question is true/false
function isTrueFalse() {
  //console.log(["1", "2"].includes(props.type)); return ;
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