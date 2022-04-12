<template>
  <div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">
        {{ t("subjects.Add Subject") }}
      </h2>
      <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <router-link
          to="/subjects"
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
            <div>
              <label for="form-label" class="form-label">{{
                t("subjects.Label")
              }}</label>
              <input
                id="form-label"
                type="text"
                class="form-control"
                placeholder="Enter label of subject."
                v-model.trim="model.label"
                :class="{
                  'border-danger': submitted && v$.label.$errors.length,
                }"
              />
              <div
                class="text-danger mt-2"
                v-for="(error, index) of v$.label.$errors"
                :key="index"
              >
                <div class="error-msg">{{ error.$message }}</div>
              </div>
            </div>
            <div class="mt-3">
              <label for="form-description" class="form-label">{{
                t("subjects.Description")
              }}</label>

              <div class="mt-3 py-2">
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
              <label for="form-language" class="form-label">{{
                t("subjects.Choose Language")
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
                  v-for="(language, index) in languages"
                  :key="index"
                  :value="index"
                >
                  {{ language }}
                </option>
              </TomSelect>
            </div>
            <div class="mt-3">
              <label for="subject-icon" class="form-label">{{
                t("subjects.Icon")
              }}</label>
              <input
                type="text"
                id="subject-icon"
                v-model="model.icon"
                class="form-control"
                placeholder="Icon"
                :class="{ 'border-danger': submitted && v$.icon.$error }"
              />
              <span v-if="submitted && v$.icon.$error" class="text-danger mt-2">
                {{ v$.icon.$errors[0].$message }}
              </span>
            </div>
            <div class="mt-3">
              <label for="subject-tags" class="form-label">{{
                t("subjects.Tags")
              }}</label>
              <TomSelect
                id="subject-tags"
                v-model="model.tags_list"
                :placeholder="t('subjects.Tags')"
                :options="{
                  create: true,
                }"
                class="w-full"
                multiple
              >
                <option
                  v-for="(tag, index) in model.tags_list"
                  :key="index"
                  :value="tag"
                >
                  {{ tag }}
                </option>
              </TomSelect>
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
  label: "",
  description: null,
  icon: "",
  tags_list: [],
  language_id: 1,
});

const rules = computed(() => {
  return {
    label: {
      required: helpers.withMessage("Please enter label.", required),
    },
    description: {
      required: helpers.withMessage("Please enter description.", required),
    },
    icon: {
      required: helpers.withMessage("Please enter icon.", required),
    },
    language_id: {
      required: helpers.withMessage("Please select language.", required),
    },
  };
});

const v$ = useVuelidate(rules, model);

async function submitForm() {
  submitted.value = true;
  v$.value.$validate(); // checks all inputs

  if (!v$.value.$error) {
    isLoading.value = true;
    await store
      .dispatch("subjects/create", model)
      .then(() => {
        isLoading.value = false;
        submitted.value = false;
        router.push({ name: "Subjects" });
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
  store.dispatch("listLanguages").then().catch();
});
const languages = computed(() => store.getters.languages);

</script>

<style scoped>
</style>