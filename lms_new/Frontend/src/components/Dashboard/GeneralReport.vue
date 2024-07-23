<script setup lang="ts">

import _ from "lodash";
import axios from "axios";
import Lucide from "@/components/Base/Lucide";
import Tippy from "@/components/Base/Tippy";
import { ref, provide, onMounted, computed, reactive, defineProps } from "vue";
import axiosClient from "@/axios";
import { useRouter } from "vue-router";
const router = useRouter();

const props = defineProps({
  response: {
    type: Object,
    required: true,
  },
});

</script>
<template>
   <div class="col-span-12" v-if="response">
        <div class="col-span-12" >
            <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
              <div
                :class="[
                  'relative zoom-in',
                  'before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-[\'\']',
                ]"
              >
                <div class="p-5 box">
                  <div class="flex">
                    <!-- <Lucide
                      icon="ShoppingCart"
                      class="w-[28px] h-[28px] text-primary"
                    /> -->
                    <div class="ml-auto">
                      <!-- <Tippy
                        as="div"
                        class="cursor-pointer bg-success py-[3px] flex rounded-full text-white text-xs pl-2 pr-1 items-center font-medium"
                        content="33% Higher than last month"
                      >
                        
                        <Lucide icon="ChevronUp" class="w-4 h-4 ml-0.5" />
                      </Tippy> -->
                    </div>
                  </div>
                  <div class="mt-6 text-3xl font-medium leading-8">
                    {{ response.general_report.user_count || 0 }}
                  </div>
                  <div class="mt-1 text-base text-slate-500">No.of Users</div>
                </div>
              </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
              <div
                :class="[
                  'relative zoom-in',
                  'before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-[\'\']',
                ]"
              >
                <div class="p-5 box">
                  <div class="flex">
                    <!-- <Lucide
                      icon="CreditCard"
                      class="w-[28px] h-[28px] text-pending"
                    /> -->
                    <div class="ml-auto">
                      <!-- <Tippy
                        as="div"
                        class="cursor-pointer bg-danger py-[3px] flex rounded-full text-white text-xs pl-2 pr-1 items-center font-medium"
                        content="2% Lower than last month"
                      >
                        
                        <Lucide icon="ChevronDown" class="w-4 h-4 ml-0.5" />
                      </Tippy> -->
                    </div>
                  </div>
                  <div class="mt-6 text-3xl font-medium leading-8">
                    {{ response.general_report.student_count || 0 }}
                  </div>
                  <div class="mt-1 text-base text-slate-500">No.of Students</div>
                </div>
              </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
              <div
                :class="[
                  'relative zoom-in',
                  'before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-[\'\']',
                ]"
              >
                <div class="p-5 box">
                  <div class="flex">
                    <!-- <Lucide
                      icon="Monitor"
                      class="w-[28px] h-[28px] text-warning"
                    /> -->
                    <div class="ml-auto">
                      <!-- <Tippy
                        as="div"
                        class="cursor-pointer bg-success py-[3px] flex rounded-full text-white text-xs pl-2 pr-1 items-center font-medium"
                        content="12% Higher than last month"
                      >
                        
                        <Lucide icon="ChevronUp" class="w-4 h-4 ml-0.5" />
                      </Tippy> -->
                    </div>
                  </div>
                  <div class="mt-6 text-3xl font-medium leading-8">
                    {{ response.general_report.course_count || 0 }}
                  </div>
                  <div class="mt-1 text-base text-slate-500">
                    no.Of Courses
                  </div>
                </div>
              </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
              <div
                :class="[
                  'relative zoom-in',
                  'before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-[\'\']',
                ]"
              >
                <div class="p-5 box">
                  <div class="flex">
                    <!-- <Lucide
                      icon="User"
                      class="w-[28px] h-[28px] text-success"
                    /> -->
                    <div class="ml-auto">
                      <!-- <Tippy
                        as="div"
                        class="cursor-pointer bg-success py-[3px] flex rounded-full text-white text-xs pl-2 pr-1 items-center font-medium"
                        content="22% Higher than last month"
                      >
                        
                        <Lucide icon="ChevronUp" class="w-4 h-4 ml-0.5" />
                      </Tippy> -->
                    </div>
                  </div>
                  <div class="mt-6 text-3xl font-medium leading-8">
                    {{ response.general_report.subject_count || 0 }}
                  </div>
                  <div class="mt-1 text-base text-slate-500">
                    no.of subject
                  </div>
                </div>
              </div>
            </div>
            </div>
        </div>
      </div>
</template>

