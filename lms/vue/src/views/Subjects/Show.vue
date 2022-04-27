<template>
<div>
  <div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">{{ t("subjects.Subject details") }}</h2>
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
  
  <TabGroup>
    <!-- BEGIN: Profile Info -->
    <div class="intro-y box px-5 pt-5 mt-5">
      <div
        class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5"
      >
        <div
          class="flex flex-1 px-5 items-center justify-center lg:justify-start"
        >
          
          <div class="ml-5">
            <div
              class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg"
            >
              {{ model.label }}
            </div>
            <div class="text-slate-500">{{ model.tags }}</div>
          </div>
        </div>
        <div
          class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0"
        >
          <div class="font-medium text-center lg:text-left lg:mt-3">
            Description
          </div>
          <div
            class="flex flex-col justify-center items-center lg:items-start mt-4"
            v-html="model.description"
          >
            
          </div>
        </div>
        <div
          class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-slate-200/60 dark:border-darkmode-400 pt-5 lg:pt-0"
        >
          <div class="text-center rounded-md w-20 py-3">
            <div class="font-medium text-primary text-xl">201</div>
            <div class="text-slate-500">Chapters</div>
          </div>
          <div class="text-center rounded-md w-20 py-3">
            <div class="font-medium text-primary text-xl">1k</div>
            <div class="text-slate-500">Topics</div>
          </div>
          
        </div>
      </div>
      <TabList
        class="nav-link-tabs flex-col sm:flex-row justify-center lg:justify-start text-center"
      >
        <Tab :fullWidth="false" class="py-4 flex items-center cursor-pointer">
          <BookOpenIcon class="w-4 h-4 mr-2" /> Chapters
        </Tab>
        <Tab :fullWidth="false" class="py-4 flex items-center cursor-pointer">
          <ShieldIcon class="w-4 h-4 mr-2" /> Topics
        </Tab>
      </TabList>
    </div>
    <!-- END: Profile Info -->
    <TabPanels class="mt-5">
      <TabPanel>
        <div class="grid grid-cols-12 gap-12">
          <component :is="selectedComponent" :subjectId="model.id" />          
        </div>
      </TabPanel>
      <TabPanel>
        <div class="grid grid-cols-12 gap-12">
          <!-- BEGIN: Chapters list -->
          <div class="intro-y box col-span-12 lg:col-span-12">
            <div
              class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400"
            >
              <h2 class="font-medium text-base mr-auto">Chapters</h2>
              <Dropdown class="ml-auto sm:hidden">
                <DropdownToggle
                  tag="a"
                  class="w-5 h-5 block"
                  href="javascript:;"
                >
                  <MoreHorizontalIcon class="w-5 h-5 text-slate-500" />
                </DropdownToggle>
                <DropdownMenu class="w-40">
                  <DropdownContent>
                    <DropdownItem>
                      <FileIcon class="w-4 h-4 mr-2" /> Download Excel
                    </DropdownItem>
                  </DropdownContent>
                </DropdownMenu>
              </Dropdown>
              <button class="btn btn-outline-secondary hidden sm:flex">
                <FileIcon class="w-4 h-4 mr-2" /> Download Excel
              </button>
            </div>
            <div class="p-5">
              <div class="relative flex items-center mt-5">
                
                <div class="ml-4 mr-auto">
                  <a href="" class="font-medium">Label</a>
                  <div class="text-slate-500 mr-5 sm:mr-5">
                    Tags
                  </div>
                </div>
                <div class="font-medium text-slate-600 dark:text-slate-500">
                  Action
                </div>
              </div>

              <div class="relative flex items-center mt-5" 
                    v-for="(chapter, index) in model.chapters" 
                    :key="index">
                
                <div class="ml-4 mr-auto">
                  <a href="" class="font-medium">{{ JSON.parse(chapter.label) }}</a>
                  <div class="text-slate-500 mr-5 sm:mr-5">
                    {{chapter.tags}}
                  </div>
                </div>
                <div class="font-medium text-slate-600 dark:text-slate-500">
                  Add
                </div>
              </div>
            </div>
          </div>
          <!-- END: Chapters list -->
        </div>
      </TabPanel>
    </TabPanels>
  </TabGroup>
</div>
</template>

<script setup>
import { onMounted, ref, shallowRef } from "vue";
import { useI18n } from "vue-i18n";
import { useRoute, useRouter } from "vue-router";
import axiosClient from "@/axios";
import store from "@/stores";
import ListChapters from "@/views/Subjects/Chapters.vue";

const route = useRoute();
const router = useRouter();

const { t } = useI18n();
const isLoading = ref(false);
const isErrored = ref(false);
const message = ref("");
const model = ref("");

const options = {
  modelName: "Chapter",
};
const listing = ref(true);
const selectedComponent = shallowRef(ListChapters);

const fetch = async () => {
  isLoading.value = true;
  try {
    let id = route.params.id;

    const result = await axiosClient.get(`/subjects/${id}`);
    
    if (result.status != 200) {
      const error = new Error("Failed to fetch subject");
      throw error;
    }
    model.value = JSON.parse(JSON.stringify(result.data.data));
    //selectedComponent.value = ListChapters;
  } catch (e) {
    isErrored.value = true;
    message.value = e;
  } finally {
    isLoading.value = false;
  }
};
onMounted(() => {
  fetch();
});


function add() {
  listing.value = false;

  router.push({ name: "CreateChapter" });
}

function edit(item) {
  listing.value = false;
  router.push({
    name: "EditChapter",
    params: { id: item.id },
  });
}

function show(item) {
  listing.value = false;
  router.push({
    name: "ShowChapter",
    params: { id: item.id },
  });
}

function deleteI(item) {
  store.dispatch("chapters/delete", item.id);
}
</script>

<style>
</style>