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
		<!-- BEGIN: Wizard Layout -->
		<div class="intro-y box py-10 sm:py-20 mt-5">
			<div
				class="wizard flex flex-col lg:flex-row justify-center px-5 sm:px-20"
			>
				<div
					class="intro-x lg:text-center flex items-center lg:block flex-1 z-10"
				>
					<button class="w-10 h-10 rounded-full btn btn-primary">1</button>
					<div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">
						{{ $t('Basic selection') }}
					</div>
				</div>
				<div
					class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10"
				>
					<button class="w-10 h-10 rounded-full btn text-gray-600 bg-gray-200 dark:bg-dark-1">2</button>
					<div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700 dark:text-gray-600">
						{{ $t('Question and Solution') }}
					</div>
				</div>
				<div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
					<button class="w-10 h-10 rounded-full btn text-gray-600 bg-gray-200 dark:bg-dark-1">3</button>
					<div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700 dark:text-gray-600">
						{{ $t('Answers') }}
					</div>
				</div>
				<div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
					<button class="w-10 h-10 rounded-full btn text-gray-600 bg-gray-200 dark:bg-dark-1">4</button>
					<div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700 dark:text-gray-600">
						{{ $t('Preview') }}
					</div>
				</div>
				<div
				class="wizard__line hidden lg:block w-2/3 bg-gray-200 dark:bg-dark-1 absolute mt-5"
				></div>
			</div>
			<div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
				<keep-alive>
					<component :is="currentForm"></component>
				</keep-alive>
			</div>
		</div>
		<!-- END: Wizard Layout -->
	</div>
</template>
<script>
import { ref, reactive, computed, onMounted } from 'vue'

import BasicSelection from './Partials/BasicSelection.vue';
import QuesionSolution from  './Partials/QuestionSolution.vue';
import Answer from './Partials/Answer.vue';
import Preview from './Partials/Preview.vue';

export default {
	components: {
		BasicSelection,
		QuesionSolution,
		Answer,
		Preview
	},
	setup() {
		const currentForm = ref('BasicSelection');
		return {
			currentForm
		}
	},
}
</script>
