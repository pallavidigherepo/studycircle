<template>
    <div>
        <div class="title">Answers</div>
        <div
            v-for="index in defaultNumOptions"
            v-bind:key="index"
            class="p-4">
            <div class="grid grid-cols-12">
                <label :for="'answer-editor'+index">{{index}})</label>
                <label :for="'answer-is-correct'+index">Is correct?</label>
                <input :id="'answer-is-correct'+index" type="radio" name="is_correct" v-model="form.is_correct" class="form-check-input"> 
                
                <editor
                    :id="'answer-editor'+index"
                    v-model="form.answer"
                    initialValue="<p>Initial editor content</p>"
                    apiKey="n10p1o42akootxkapivj4ecxefdo4zlaqd0ek0aa47ld9js7"
                    :init="{
                        height: 200,
                        menubar: true,
                        width: 600,
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
        </div>
    </div>
</template>

<script>

import Editor from "@tinymce/tinymce-vue";

export default {
    
	components: {
		editor: Editor,
	},
    setup(props) {
        const defaultNumOptions = 4;
        const form = {
            answer: '',
            is_correct: ''
        }
        return {
            defaultNumOptions,
            form
        };
    }
}
</script>

<style scoped>


</style>


