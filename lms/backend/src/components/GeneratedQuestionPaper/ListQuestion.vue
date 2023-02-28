<template>
    <table class="border-none w-full ">
        <tr v-for="(question, qidx) in questions" :key="qidx">
            <td class="border-none whitespace-nowrap">
                {{ qidx + 1 }})&nbsp;{{ question.question }}
                <table class="w-full border-none">
                    <tr v-for="(answer, aidx) in question.answers" :key="aidx">
                        <td class="border-none whitespace-nowrap">
                            {{ aidx + 1 }})&nbsp;
                            <template v-if="isOnline">
                                <input
                                    v-if="question.type_id == 1 || question.type_id == 3"
                                    :id="`is_correct-`+qidx"
                                    type="radio"
                                    class="form-check-input"
                                    name="is_correct"
                                />
                                <input
                                    v-if="question.type_id == 2"
                                    :id="`is_correct-`+qidx"
                                    type="checkbox"
                                    class="form-check-input"
                                    name="is_correct"
                                />
                                {{ answer.answer }}
                            </template>
                            <template v-else>{{ answer.answer }}</template>
                            <template v-if="answer.is_correct && showPreviewForTeacher">
                                <div class="ml-5 btn btn-success">{{ t("questions.Correct Answer") }}</div>
                            </template>
                        </td>
                    </tr>
                    <tr v-if="showPreviewForTeacher">
                        <td class="w-full border-none whitespace-nowrap bg-primary/80 box text-white flex items-center mb-2 mt-2">
                            {{ question.note }}
                        </td>
                    </tr>
                </table>
            </td>

        </tr>
    </table>
</template>

<script setup>
import {useI18n} from "vue-i18n";

const {t} = useI18n();
const props = defineProps({
    questions: Object,
    isOnline: Boolean,
    showPreviewForTeacher: Boolean,
})
</script>

<style scoped>

</style>
