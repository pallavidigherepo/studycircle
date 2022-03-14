<template>
        <!-- <div class="font-medium text-base">Basic Selection</div> -->
        
            <!-- <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5"> -->
				<div class="intro-y col-span-12 sm:col-span-6">
					<label for="board" class="form-label">{{ $t('Board')}}</label>
					<TailSelect
							id="board"
							v-model="form.board_id"
							:options="{
									search: true,
									classNames: 'w-full'
							}"
							:class="{ 'border-theme-24': submitted && v$.board_id.$errors.length }"
					>
							<option value="">Select board</option>
							<option v-for="(board, index) in boards" 
											:key="index" 
											:value="index">{{ board}}</option>
							
					</TailSelect>
					<div class="text-theme-24 mt-2" v-for="(error, index) of v$.board_id.$errors" :key="index">
						<div class="error-msg">{{ error.$message }}</div>
					</div>
				</div>
				<div class="intro-y col-span-12 sm:col-span-6">
					<label for="type" class="form-label">{{ $t('Question type')}}</label>
					<TailSelect
							id="type"
							v-model="form.type_id"
							:options="{
									search: true,
									classNames: 'w-full'
							}"
							@change="selectQuestionType($event)"
							:class="{ 'border-theme-24': submitted && v$.type_id.$errors.length }"
					>
							<option value="">Select question type</option>
							<option v-for="(questionType, index) in questionTypes" 
											:key="index" 
											:value="index">{{ JSON.parse(questionType)}}</option>
							
					</TailSelect>
					<div class="text-theme-24 mt-2" v-for="(error, index) of v$.type_id.$errors" :key="index">
						<div class="error-msg">{{ error.$message }}</div>
					</div>
				</div>
				<div class="intro-y col-span-12 sm:col-span-6">
                    <label for="standard" class="form-label">{{ $t('Standard or class')}}</label>
					<TailSelect
							id="standard"
							v-model="form.standard_id"
							:options="{
									search: true,
									classNames: 'w-full'
							}"
							:class="{ 'border-theme-24': submitted && v$.standard_id.$errors.length }"
					>
							<option value="">Select standard or class</option>
							<option v-for="(standard, index) in standards" 
											:key="index" 
											:value="index">{{ standard}}</option>
							
					</TailSelect>
					<div class="text-theme-24 mt-2" v-for="(error, index) of v$.standard_id.$errors" :key="index">
						<div class="error-msg">{{ error.$message }}</div>
					</div>
				</div>
				<div class="intro-y col-span-12 sm:col-span-6">
					<label for="level" class="form-label">{{ $t('Difficulty level')}}</label>
					<TailSelect
							id="level"
							v-model="form.difficulty_level_id"
							:options="{
									search: true,
									classNames: 'w-full'
							}"
							:class="{ 'border-theme-24': submitted && v$.difficulty_level_id.$errors.length }"
					>
							<option value="">Select difficulty level</option>
							<option v-for="(difficultyLevel, index) in difficultyLevels" 
											:key="index" 
											:value="index">{{ JSON.parse(difficultyLevel)}}</option>
							
					</TailSelect>
					
					<div class="text-theme-24 mt-2" v-for="(error, index) of v$.difficulty_level_id.$errors" :key="index">
						<div class="error-msg">{{ error.$message }}</div>
					</div>
				</div>
				<div class="intro-y col-span-12 sm:col-span-6">
                    <label for="language" class="form-label">{{ $t('Language or Medium')}}</label>
					<TailSelect
							id="language"
							v-model="form.language_id"
							:options="{
									search: true,
									classNames: 'w-full'
							}"
							:class="{ 'border-theme-24': submitted && v$.language_id.$errors.length }"
					>
							<option v-for="(language, index) in languages" 
											:key="index" 
											:value="index">{{ language}}</option>
							
					</TailSelect>
					
					<div class="text-theme-24 mt-2" v-for="(error, index) of v$.language_id.$errors" :key="index">
						<div class="error-msg">{{ error.$message }}</div>
					</div>
				</div>
				<!-- <div
					class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5"
				>
					<button class="btn btn-secondary w-24">Previous</button>
					<button class="btn btn-primary w-24 ml-2">Next</button>
				</div> -->
			<!-- </div> -->
        
        
   
</template>

<script>
import { ref, reactive, computed, onMounted } from 'vue'
import { useStore } from 'vuex';

import { required, helpers } from '@vuelidate/validators'

import useCrud from '@/hooks/crud.js'

export default {
    setup(props, context) {
		const store = useStore();
        const languages = ref('');
		const boards = ref('');
		const standards = ref('');
		const difficultyLevels = ref('');
		const questionTypes = ref('');
		const subjects = ref('');
		const chapters = ref('');
		const topics = ref('');

		const selectQuestionTypeComponent = ref('');
		const nextForm = ref('QuestionSolution');

		const mappedTypeComponents = {
			1: "SingleChoice",
			2: "MultipleChoice",
			3: "Paragraph",
			4: "Miscellaneous",
			5: "TrueFalse",
			6: "FillInTheBlanks",
			7: "Audio",
			8: "Image",
			9: "Video",
		};

        const initialState = {
			id: '',
			board_id: '',
			standard_id: '',
			difficulty_level_id: '',
			type_id: '',
			language_id: 1,
		};

        const form = reactive({
			id: '',
			board_id: '',
			standard_id: '',
			difficulty_level_id: '',
			type_id: '',
			language_id: 1,
		});

		
		const rules = computed(() => {
			return {
				board_id: {
						required: helpers.withMessage('Please select board of question.', required),
				},
				standard_id: {
						required: helpers.withMessage('Please select standard of question.', required),
				},
				difficulty_level_id: {
						required: helpers.withMessage('Please select difficulty level of question.', required),
				},
				type_id: {
						required: helpers.withMessage('Please select question type of question.', required),
				},
				language_id: {
						required: helpers.withMessage('Please select language of question.', required),
				},
			}
		});

        const getCreateOptions = async () => {
				
			const response = await axios.get('/api/v1/questions/options');
			boards.value = response.data.boards;
			standards.value = response.data.standards;
			difficultyLevels.value = response.data.difficultyLevels;
			questionTypes.value = response.data.questionTypes;
			subjects.value = response.data.subjects;
			chapters.value = response.data.chapters;
			topics.value = response.data.topics;
			languages.value = response.data.languages;
			
			if (response.status != 200) {
				const error = new Error('Failed to fetch options')
				throw error;
			}
		}

        onMounted(getCreateOptions) // on `mounted` call `options`

        // This will take care of change in question type.
		function selectQuestionType(event)
		{
			selectQuestionTypeComponent.value = null;
			if (mappedTypeComponents[event.target.value]) {
				selectQuestionTypeComponent.value = mappedTypeComponents[event.target.value];
			}
			
		}

		const options = {
			initialState,
			form,
			rules,
			create: 'questions/create',
			update: 'questions/update',
			moduleName: 'Subject(s)'
		}
		const {
			submitted,
			isLoading,
			isErrored,
			message,
			submit,
			v$,
			editItem,
			editMode,
			clearForm
			} = useCrud(options);

        const submitForm = async() => {
			try {
				let response = await submit();
				if (response) {
					context.emit("submitForm", {form, nextForm});
				} else {
					return response;
				}
			} catch (e) {

			}
		}

        return {
            submitForm,
            form,
            boards,
            standards,
            difficultyLevels,
            questionTypes,
            subjects,
            chapters,
            topics,
            languages,
			selectQuestionTypeComponent,
			selectQuestionType,
			submitted,
			isLoading,
			isErrored,
			message,
			submit,
			v$,
			editItem,
			editMode,
        }
    }
}
</script>

<style>

</style>