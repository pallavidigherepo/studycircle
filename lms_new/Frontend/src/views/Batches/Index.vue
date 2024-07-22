<script setup lang="ts">
import { ref, computed } from "vue";
import fakerData from "@/utils/faker";
import Button from "@/components/Base/Button";
import { FormInput, FormLabel, FormSwitch } from "@/components/Base/Form";
import Lucide from "@/components/Base/Lucide";
import Tippy from "@/components/Base/Tippy";
import { ClassicEditor } from "@/components/Base/Ckeditor";
import { Menu, Tab } from "@/components/Base/Headless";

import { useVuelidate } from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators";


const editorData = ref("<p>Content of the editor.</p>");
import { useI18n } from "vue-i18n";
const { t } = useI18n();

const model = ref({
    id: "",
    name: "",
    is_active: "",
});

const rules = computed(() => {
    return {
        name: {
            required: helpers.withMessage(
                "Please enter name of batch.",
                required
            ),
        },
    };
});

const v$ = useVuelidate(rules, model);


// Begin: Cancel editing
function cancel() {
    actionText.value = "Add";
    isEdit.value = false;
    selectedItem.value = "";
    model.value = JSON.parse(JSON.stringify(model));
}
// End: Cancel editing

</script>

<template>
  <div class="flex flex-col items-center mt-8 intro-y sm:flex-row">
    <h2 class="mr-auto text-lg font-medium">Batches</h2>
  </div>
  <div class="grid grid-cols-12 gap-5 mt-5 intro-y">
    <!-- BEGIN: Post Content -->
    <div class="col-span-12 intro-y lg:col-span-8">
      <FormInput
        type="text"
        class="px-4 py-3 pr-10 intro-y !box"
        placeholder="Title"
      />
      <Tab.Group class="mt-5 overflow-hidden intro-y box">
        <Tab.List
          class="flex-col border-transparent dark:border-transparent sm:flex-row bg-slate-200 dark:bg-darkmode-800"
        >
          <Tab :fullWidth="false" v-slot="{ selected }">
            <Tab.Button
              :class="[
                'flex items-center justify-center w-full px-0 py-0 sm:w-40 text-slate-500',
                {
                  'hover:border-transparent hover:bg-transparent hover:text-slate-600 hover:dark:bg-transparent hover:dark:text-slate-300':
                    !selected,
                },
                {
                  'text-primary border-transparent dark:bg-darkmode-600 dark:border-x-transparent dark:border-t-transparent dark:text-white':
                    selected,
                },
              ]"
              as="button"
            >
              <Tippy
                content="Fill in the article content"
                class="flex items-center justify-center w-full py-4"
                aria-controls="content"
                aria-selected="true"
              >
                <Lucide icon="FileText" class="w-4 h-4 mr-2" />
                Content
              </Tippy>
            </Tab.Button>
          </Tab>
          <Tab :fullWidth="false" v-slot="{ selected }">
            <Tab.Button
              :class="[
                'flex items-center justify-center w-full px-0 py-0 sm:w-40 text-slate-500',
                {
                  'hover:border-transparent hover:bg-transparent hover:text-slate-600 hover:dark:bg-transparent hover:dark:text-slate-300':
                    !selected,
                },
                {
                  'text-primary border-transparent dark:bg-darkmode-600 dark:border-x-transparent dark:border-t-transparent dark:text-white':
                    selected,
                },
              ]"
              as="button"
            >
              <Tippy
                content="Adjust the meta title"
                class="flex items-center justify-center w-full py-4"
                aria-selected="false"
              >
                <Lucide icon="Code" class="w-4 h-4 mr-2" /> Meta Title
              </Tippy>
            </Tab.Button>
          </Tab>
          <Tab :fullWidth="false" v-slot="{ selected }">
            <Tab.Button
              :class="[
                'flex items-center justify-center w-full px-0 py-0 sm:w-40 text-slate-500',
                {
                  'hover:border-transparent hover:bg-transparent hover:text-slate-600 hover:dark:bg-transparent hover:dark:text-slate-300':
                    !selected,
                },
                {
                  'text-primary border-transparent dark:bg-darkmode-600 dark:border-x-transparent dark:border-t-transparent dark:text-white':
                    selected,
                },
              ]"
              as="button"
            >
              <Tippy
                content="Use search keywords"
                class="flex items-center justify-center w-full py-4"
                aria-selected="false"
              >
                <Lucide icon="AlignLeft" class="w-4 h-4 mr-2" />
                Keywords
              </Tippy>
            </Tab.Button>
          </Tab>
        </Tab.List>
        <Tab.Panels>
          <Tab.Panel class="p-5">
            <div
              class="p-5 border rounded-md border-slate-200/60 dark:border-darkmode-400"
            >
              <div
                class="flex items-center pb-5 font-medium border-b border-slate-200/60 dark:border-darkmode-400"
              >
                <Lucide icon="ChevronDown" class="w-4 h-4 mr-2" /> Text Content
              </div>
              <div class="mt-5">
                <ClassicEditor v-model="editorData" />
              </div>
            </div>
            <div
              class="p-5 mt-5 border rounded-md border-slate-200/60 dark:border-darkmode-400"
            >
              <div
                class="flex items-center pb-5 font-medium border-b border-slate-200/60 dark:border-darkmode-400"
              >
                <Lucide icon="ChevronDown" class="w-4 h-4 mr-2" />
                Caption & Images
              </div>
              <div class="mt-5">
                <div>
                  <FormLabel htmlFor="post-form-7">Caption</FormLabel>
                  <FormInput
                    id="post-form-7"
                    type="text"
                    placeholder="Write caption"
                  />
                </div>
                <div class="mt-3">
                  <FormLabel>Upload Image</FormLabel>
                  <div
                    class="pt-4 border-2 border-dashed rounded-md dark:border-darkmode-400"
                  >
                    <div
                      class="relative flex items-center px-4 pb-4 cursor-pointer"
                    >
                      <Lucide icon="Image" class="w-4 h-4 mr-2" />
                      <span class="mr-1 text-primary"> Upload a file </span> or
                      drag and drop
                      <FormInput
                        type="file"
                        class="absolute top-0 left-0 w-full h-full opacity-0"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </Tab.Panel>
        </Tab.Panels>
      </Tab.Group>
    </div>
    <!-- END: Post Content -->
    <!-- BEGIN: Post Info -->
    <div class="col-span-12 lg:col-span-4">
      <div class="p-5 intro-y box">
        <div>
          <FormLabel>{{ t("batches.Name") }}</FormLabel>
          <FormInput
                type="text"
                class="px-4 py-3 pr-10 intro-y !box"
                :placeholder="t('batches.Name')"
                v-model.trim="model.name"
            />
        </div>
        <FormSwitch class="flex flex-col items-start mt-3">
          <FormSwitch.Label htmlFor="post-form-5" class="mb-2 ml-0">{{ t("batches.Active") }}
          </FormSwitch.Label>
          <FormSwitch.Input id="post-form-5" type="checkbox" v-model="model.is_active" />
        </FormSwitch>
        <div class="text-right mt-5">
            <Button
                type="button"
                class="btn btn-outline-secondary w-24 mr-1"
                @click.prevent="cancel"
            >
                {{ t("common.Cancel") }}
            </Button>
            <Button type="submit" class="btn btn-primary w-24">
                {{ t("common.Save") }}
            </Button>
        </div>
      </div>
    </div>
    <!-- END: Post Info -->
  </div>
</template>
