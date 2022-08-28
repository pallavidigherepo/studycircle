<template>
    <div class="w-full mt-3 xl:mt-0 flex-1">
        <div
            class="relative pl-5 pr-5 xl:pr-10 py-10 bg-slate-50 dark:bg-transparent dark:border rounded-md"
        >
            <div class="w-20 flex text-slate-500 xl:mt-1 absolute top-0 right-0 mr-4">
                <a href="#"
                   class="xl:ml-5"
                   @click.prevent="addSection()">
                    <PlusIcon class="w-5 h-5" />
                </a>
                <a href="#" class="ml-3 xl:ml-5" @click.prevent="deleteSection()">
                    <Trash2Icon class="w-5 h-5" />
                </a>
            </div>
            <div>
                <div class="form-inline mt-5 first:mt-0">
                    <label class="form-label sm:w-20">{{ t("templates.Name") }}</label>
                    <div class="flex items-center flex-1 xl:pr-10">
                        <div class="flex-1">
                            <input type="text"
                                   class="form-control"
                                   placeholder="Name of Section"
                                   v-model="model.name"
                                   @change="dataChange"
                            />
                        </div>
                    </div>
                </div>

                <div class="form-inline mt-5 first:mt-0">
                    <label class="form-label sm:w-20">{{ t("templates.Description") }}</label>
                    <div class="flex items-center flex-1 xl:pr-10">
                        <div class="flex-1">
                            <textarea class="form-control"
                                      placeholder="Description"
                                      v-model="model.description"
                                      @change="dataChange"
                                      >
                            </textarea>
                        </div>
                    </div>
                </div>

                <div class="form-inline mt-5 first:mt-0">
                    <label class="form-label sm:w-20">{{ t("templates.Question Type") }}</label>
                    <div class="flex items-center flex-1 xl:pr-10">
                        <div class="flex-1">
                            <TomSelect id="form-type"
                                       v-model="model.type_id"
                                       placeholder="Select Type"
                                       :options="{
                                          allowEmptyOption: false,
                                          create: false,
                                          placeholder: 'Select Type',
                                          autocomplete: 'off',
                                          onChange: changeType,
                                          items:model.type_id,
                                        }"
                            >
                                <option>{{ t('questions.Select Question Type') }}</option>
                                <option v-for="(type, id) in questionTypes" :key="id" :value="id">
                                    {{ JSON.parse(type) }}
                                </option>
                            </TomSelect>
                        </div>
                    </div>
                </div>
                <div class="form-inline mt-5 first:mt-0">
                    <label class="form-label sm:w-20">{{ t("templates.Total Questions") }}</label>
                    <div class="flex items-center flex-1 xl:pr-10">
                        <div class="flex-1">
                            <input type="number"
                                   class="form-control"
                                   placeholder="Total Number of Questions"
                                   v-model="model.total_questions"
                                   @change="dataChange"
                            />
                        </div>
                    </div>
                </div>
                <div class="form-inline mt-5 first:mt-0">
                    <label class="form-label sm:w-20">{{ t("templates.Compulsory Questions") }}</label>
                    <div class="flex items-center flex-1 xl:pr-10">
                        <div class="flex-1">
                            <input type="number"
                                   class="form-control"
                                   placeholder="Compulsory Questions"
                                   v-model="model.compulsory_questions"
                                   @change="dataChange"
                            />
                        </div>
                    </div>
                </div>
                <div class="form-inline mt-5 first:mt-0">
                    <label class="form-label sm:w-20">{{ t("templates.Marks per Question") }}</label>
                    <div class="flex items-center flex-1 xl:pr-10">
                        <div class="flex-1">
                            <input type="number"
                                   class="form-control"
                                   placeholder="Marks per Question"
                                   v-model="model.marks_per_question"
                                   @change="dataChange"
                            />
                        </div>
                    </div>
                </div>
                <div class="form-inline mt-5 first:mt-0">
                    <label class="form-label sm:w-20">{{ t("templates.Total Marks") }}</label>
                    <div class="flex items-center flex-1 xl:pr-10">
                        <div class="flex-1">
                            <input type="text"
                                   class="form-control"
                                   placeholder="Total Marks"
                                   v-model="model.total_marks"
                                   @change="dataChange"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>

import store from "@/stores";
import { useI18n } from "vue-i18n";
import { ref, computed, watch } from "vue";

const { t } = useI18n();

const props = defineProps({
    section: Object,
    index: Number,
    questionTypes: Object,
    total_marks: Number,
});
const emit = defineEmits(["change", "addSection", "deleteSection"]);

const model = ref(JSON.parse(JSON.stringify(props.section)));

watch(model.value, async (oldVal, newVal) => {
    if (props.total_marks >= newVal.total_marks) {
        // TODO:
        /*console.log(model.value)
        console.log(props.total_marks);
        console.log(newVal.total_marks)*/
    }
})
// Emit the data change
function dataChange() {
    emit("change", model.value);
}
function changeType(type) {
    model.value.type_id = type;
    dataChange();
}
function addSection() {
    emit("addSection", props.index + 1);
}
function deleteSection() {
    emit("deleteSection", props.section);
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
<style scoped>

</style>
