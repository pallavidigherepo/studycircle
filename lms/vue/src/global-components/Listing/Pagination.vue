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
            <ul class="pagination">
            <li 
                v-for="(link, i) of links"
                :key="i"
                class="page-item"
            >
                <a
                    v-if="!link.url"
                    href="javascript:;"
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

                <a
                    v-else
                    href="#"
                    @click.prevent="emits('paginate', link.label)"
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
                
            </li>
            </ul>
        </nav>
        <select class="w-20 form-select mt-3 sm:mt-0">
            <option v-for="(perPage, index) in perPageOptions" 
                    :key="index" 
                    :value="perPage" 
                    @click="emits('perpage', perPage)">
                    {{perPage}}
            </option>
            
        </select>
    </div>
</template>

<script setup>
import { computed } from "vue";
const props = defineProps({
    links: {
        type: Object,
        required: false
    },
    curretPage: {
        type: Number,
        required: false,
        default: 1
    }
});
const emits = defineEmits(["paginate", "perpage", "changePage"]);

const perPageOptions = [10, 20, 30, 40, 50];

//console.log(links)
// const pagesNumber = computed(() => {
//     console.log(props.links);
//     if (!props.links.meta) {
//       return []
//     }
//     let from = props.links.meta.current_page - 4
//     if (from < 1) {
//       from = 1
//     }
//     let to = from + (4 * 2)
//     if (to >= props.links.meta.last_page) {
//       to = props.links.meta.last_page
//     }
//     let pagesArray = []
//     for (let page = from; page <= to; page++) {
//       pagesArray.push(page)
//     }
//     return pagesArray
// });

</script>

<style>

</style>