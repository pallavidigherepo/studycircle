<template>
    <div
        class="
            intro-y
            col-span-12
            flex flex-wrap
            sm:flex-row sm:flex-nowrap
            items-center
        "
        >
        <nav class="w-full sm:w-auto sm:mr-auto pagination">
            <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
            <a
                v-for="(link, i) of links"
                :key="i"
                :disabled="!link.url"
                href="#"
                @click.prevent="emit('paginate', link)"
                aria-current="page"
                class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
                :class="[
                    link.active
                    ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                    : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                    i === 0 ? 'rounded-l-md bg-gray-100 text-gray-700' : '',
                    i === links.length - 1 ? 'rounded-r-md' : '',
                ]"
                v-html="link.label"
                >
            </a>
        </nav>
        <select class="w-20 form-select mt-3 sm:mt-0">
            <option v-for="(perPage, index) in perPageOptions" 
                    :key="index" 
                    :value="perPage" 
                    @change="emit('perpage', perPage)">
                    {{perPage}}
            </option>
            
        </select>
    </div>
</template>

<script setup>

const props = defineProps({
    links: {
        type: Object,
        required: false
    }
});
const emit = defineEmits(["paginate"]);

const perPageOptions = [10, 20, 30, 40, 50];
</script>

<style>

</style>