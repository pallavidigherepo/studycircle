<template>
		<div>
				<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
						<h2 class="text-lg font-medium mr-auto">{{ $t('Add New Question')}}</h2>
						<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
								<router-link :to="{name: 'questions'}"
														class="btn box text-gray-700 dark:text-gray-300 mr-2 flex items-center ml-auto sm:ml-0"
														><ArrowLeftCircleIcon class="w-4 h-4 mr-2" />{{ $t('List all questions')}}
								</router-link>
						</div>
				</div>
				<div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
						<div class="intro-y box col-span-12 lg:col-span-12">
								<div class="p-5">
										<div class="alert alert-danger show flex items-center mb-2" role="alert" v-if="isErrored">
												<AlertOctagonIcon class="w-6 h-6 mr-2" />
												{{ message }}
										</div>
										<form @submit.prevent = "submitForm" class="validate-form">
												<div class="mt-3 ">
														<label for="board" class="form-label"
																>{{ $t('Board')}}</label
														>
														<TailSelect
																id="board"
																v-model="form.board_id"
																:options="{
																		search: true,
																		classNames: 'w-full'
																}"
														>
																<option value="">Select board</option>
																<option v-for="(board, index) in boards" 
																				:key="index" 
																				:value="index">{{ board}}</option>
																
														</TailSelect>
												</div>
												
												<div class="mt-3 ">
														<label for="standard" class="form-label"
																>{{ $t('Standard or class')}}</label
														>
														<TailSelect
																id="standard"
																v-model="form.standard_id"
																:options="{
																		search: true,
																		classNames: 'w-full'
																}"
														>
																<option value="">Select standard or class</option>
																<option v-for="(standard, index) in standards" 
																				:key="index" 
																				:value="index">{{ standard}}</option>
																
														</TailSelect>
												</div>
												
												<div class="mt-3">
														<label for="form-question" class="form-label">{{ $t('Question') }}</label>
														<editor
																		id="form-question"
																		v-model="form.question"
																		:class="{ 'border-theme-24': submitted && v$.question.$errors.length }"
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
													
														<div class="text-theme-24 mt-2" v-for="(error, index) of v$.question.$errors" :key="index">
																<div class="error-msg">{{ error.$message }}</div>
														</div>
												</div>
												<div class="mt-3">
														
														<label for="form-note" class="form-label">{{ $t('Note')}}</label>
																
														<editor
																id="form-note"
																v-model="form.note"
																:class="{ 'border-theme-24': submitted && v$.note.$errors.length }"
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
																
														<!-- END: Inbox Content -->
														<div class="text-theme-24 mt-2" v-for="(error, index) of v$.note.$errors" :key="index">
																<div class="error-msg">{{ error.$message }}</div>
														</div>
												</div>

												
												
												<div class="mt-3 ">
														<label for="level" class="form-label"
																>{{ $t('Difficulty level')}}</label
														>
														<TailSelect
																id="level"
																v-model="form.difficulty_level_id"
																:options="{
																		search: true,
																		classNames: 'w-full'
																}"
														>
																<option value="">Select difficulty level</option>
																<option v-for="(difficultyLevel, index) in difficultyLevels" 
																				:key="index" 
																				:value="index">{{ JSON.parse(difficultyLevel)}}</option>
																
														</TailSelect>
												</div>

												<div class="mt-3 ">
														<label for="language" class="form-label"
																>{{ $t('Language or Medium')}}</label
														>
														<TailSelect
																id="language"
																v-model="form.language_id"
																:options="{
																		search: true,
																		classNames: 'w-full'
																}"
														>
																<option v-for="(language, index) in languages" 
																				:key="index" 
																				:value="index">{{ language}}</option>
																
														</TailSelect>
												</div>

												<div class="mt-3">
														<label for="question-tags" class="form-label">{{ $t('Tags') }}</label>

														<tag v-model="form.tags" 
																:inputId="'question-tags'"
																:allowCustom="true"
																:showCount="true" />
														
												</div>                        
												
												<div class="mt-3 ">
														<label for="type" class="form-label"
																>{{ $t('Question type')}}</label
														>
														<TailSelect
																id="type"
																v-model="form.type_id"
																:options="{
																		search: true,
																		classNames: 'w-full'
																}"
																@change="selectQuestionType($event)"
														>
																<option value="">Select question type</option>
																<option v-for="(questionType, index) in questionTypes" 
																				:key="index" 
																				:value="index">{{ JSON.parse(questionType)}}</option>
																
														</TailSelect>
												</div>
												<keep-alive>
													<component :is="selectQuestionTypeComponent"></component>
												</keep-alive>
												<!-- BEGIN: Slide Over Footer -->
												
												<div class="text-right w-full bottom-0 mt-3">
														<router-link :to="{name: 'questions'}" class="btn btn-outline-secondary w-20 mr-1" >
																Cancel
														</router-link>
														<button type="submit" class="btn btn-primary w-20">
																Save
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

<script>
import { useStore } from 'vuex';
import { ref, reactive, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { required, helpers } from '@vuelidate/validators'

import Tag from '@/components/inputs/Tag.vue';

import useCrud from '@/hooks/crud.js'
import Editor from "@tinymce/tinymce-vue";


import SingleChoice from "@/components/Pages/Answers/SingleChoice.vue";
import MultipleChoiceVue from '@/components/Pages/Answers/MultipleChoice.vue';
import Paragraph from "@/components/Pages/Answers/Paragraph.vue";
import Miscellaneous from '@/components/Pages/Answers/Miscellaneous.vue';
import TrueFalse from "@/components/Pages/Answers/TrueFalse.vue";
import FillInTheBlanks from '@/components/Pages/Answers/FillInTheBlanks.vue';
import Audio from "@/components/Pages/Answers/Audio.vue";
import Image from '@/components/Pages/Answers/Image.vue';
import Video from '@/components/Pages/Answers/Video.vue';

export default {
	components: {
			Tag,
			editor: Editor,
			SingleChoice,
			MultipleChoiceVue,
			Paragraph,
			Miscellaneous,
			TrueFalse,
			FillInTheBlanks,
			Audio,
			Image,
			Video

	},
	setup(props, context) {
		const store = useStore();
		const router = useRouter();
		const languages = ref('');
		const boards = ref('');
		const standards = ref('');
		const difficultyLevels = ref('');
		const questionTypes = ref('');
		const subjects = ref('');
		const chapters = ref('');
		const topics = ref('');

		const selectQuestionTypeComponent = ref('');

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

		const form = reactive({
			id: '',
			board_id: '',
			standard_id: '',
			difficulty_level_id: '',
			type_id: '',
			question: '',
			note: null,
			tags: [],
			language_id: 1,
		});
		const initialState = {
			id: '',
			board_id: '',
			standard_id: '',
			difficulty_level_id: '',
			type_id: '',
			question: '',
			note: null,
			tags: [],
			language_id: 1,
		};

		
		const rules = computed(() => {
			return {
				question: {
						required: helpers.withMessage('Please enter question.', required),
				},
				note: {
						required: helpers.withMessage('Please enter note/explaination of question.', required),
				},
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
			}
		});

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

		const submitForm = async() => {
			try {
				let response = await submit();
				if (response) {
					clearForm();
					form.tags.length =0;
					router.push('/questions');
				} else {
					return response;
				}
			} catch (e) {

			}

		}
		return {
			form,
			rules,
			submitted,
			isLoading,
			isErrored,
			message,
			submit,
			v$,
			editItem,
			editMode,
			languages,
			clearForm,
			submitForm,
			boards,
			difficultyLevels,
			questionTypes,
			standards,
			subjects,
			chapters,
			topics,
			selectQuestionTypeComponent,
			selectQuestionType
		}
	},
	methods: {
			random(string) {
					var s = '';
					var randomchar = function() {
							var n = Math.floor(Math.random() * 62);
							if (n < 10) return n; //1-10
							if (n < 36) return String.fromCharCode(n + 55); //A-Z
							return String.fromCharCode(n + 61); //a-z
					}
					while (s.length < string) s += randomchar();
					return s;
			}
	},
}
</script>

<style>

</style>