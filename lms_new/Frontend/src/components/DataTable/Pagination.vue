<script setup lang="ts">
import { computed } from "vue";

import Pagination from "@/components/Base/Pagination";
import { FormInput, FormSelect } from "@/components/Base/Form";

const props = defineProps({
    links: {
        type: Object,
        required: false
    },
    currentPage: {
        type: Number,
        required: false,
        default: 1
    }
});
const emits = defineEmits(["paginate", "perpage", "changePage"]);

const perPageOptions = [10, 20, 30, 40, 50];
</script>

<style>
.pagination {
    display: inline-flex;
    align-items: center;
}

.pagination .page-item {
    list-style: none;
    display: inline;
    margin: 0;
}
</style>

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
        <Pagination class="w-full sm:w-auto sm:mr-auto pagination">

            <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
            <ul class="pagination">
            <li
                v-for="(link, i) of links"
                :key="i"
                class="page-item"
            >
                <Pagination.Link
                    v-if="!link.url"
                    href="javascript:;"
                    aria-current="page"
                    class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap no-cursor"
                    :class="[
                        link.active
                        ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                        : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                        i === 0 ? 'rounded-l-md bg-gray-100 text-gray-700' : '',
                        i === links.length - 1 ? 'rounded-r-md' : '',
                    ]"
                    v-html="link.label"
                    >

                </Pagination.Link>

                <Pagination.Link
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

                </Pagination.Link>

            </li>
            </ul>
        </Pagination>
        <FormSelect class="w-20 mt-3 !box sm:mt-0">
            <option v-for="(perPage, index) in perPageOptions"
                    :key="index"
                    :value="perPage"
                    @click="emits('perpage', perPage)">
                    {{perPage}}
            </option>

        </FormSelect>
    </div>
</template>

