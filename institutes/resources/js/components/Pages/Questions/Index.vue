<template>
    <div>
        <template v-if="listing">
            <the-page-header :title="'Questions'"></the-page-header>
            <the-base-card>
                <the-base-header-card>
                    <router-link :to="{name: 'questionCreate'}" 
                                    @click="listing = !listing" 
                                    class="btn btn-primary shadow-md mr-2">{{ $t('Add New Question')}}</router-link>
                    
                    <add-dropdown></add-dropdown>
                    <div class="hidden md:block mx-auto text-gray-600">
                        
                    </div>
                    <base-search-card @search="search"></base-search-card>
                </the-base-header-card>
                <!-- BEGIN: Data List -->
                <the-base-data-list-card class="question-table-div">
                    <the-base-crud-table>
                        <thead>
                            <base-row-card :columns="columns" 
                                            :showHeaders="true" 
                                            @sorting="sort"
                                            :field="sortField"
                                            :direction="sortDirection"
                                            ></base-row-card>
                        </thead>
                        <tbody id="listing" v-if="!items">
                            <tr>
                                <td colspan="5" class="text-center">{{ $t('Sorry, no records found!')}}</td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                                                                    
                            <tr v-for="(item, index) in result" 
                                            :key="index" 
                                            :id="'list-'+item.id"
                                            >
                                <td class="border-b whitespace-nowrap">{{ item.id }}</td>
                                <td class="border-b whitespace">{{ item.question }}</td>
                                <td class="border-b whitespace">{{ item.tags.toString() }}</td>
                                <td class="border-b whitespace">{{ item.board }}</td>
                                <td class="border-b whitespace">{{ item.standard }}</td>
                                <td class="border-b whitespace-nowrap">
                                    <div class="flex justify-center items-center">
                                        <!--<router-link :to="{name: 'chapterEdit'}" 
                                            @click="listing = !listing" 
                                            class="btn btn-primary shadow-md mr-2">{{ $t('Add New Chapter')}} </router-link>-->
                                            
                                        <router-link :to="{name: 'subjectEdit', params: {id: item.id}}" 
                                            @click.prevent="listing = !listing" 
                                            class="flex items-center block p-2 transition duration-300 ease-in-out dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2  rounded-md "
                                            >
                                            <CheckSquareIcon class="w-4 h-4 mr-1" /> {{ $t('Edit')}}
                                        </router-link>
                                        <a class="flex items-center block p-2 transition duration-300 ease-in-out dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2  rounded-md text-theme-24" 
                                                href="#" 
                                                @click.prevent="removeItem(item)"
                                                > 
                                            <Trash2Icon class="w-4 h-4 mr-1" /> {{ $t('Delete')}}
                                        </a>
                                        <!--<router-link :to="{ name: 'chapterCreate' }"
                                                    class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2  rounded-md" >
                                            <EyeIcon class="w-4 h-4 mr-1" />
                                        </router-link>-->
                                    </div>
                                </td>       
                            </tr>
                        </tbody>
                    </the-base-crud-table>
                </the-base-data-list-card>
                <pagination align="center" v-if="showPagination && items" :data="items" @pagination="paginate"></pagination>
                <!-- End: Data List -->
            </the-base-card>            
        </template>
        <template v-else>
            <router-view></router-view>
        </template>
        
        <loading v-if="isLoading" fixed></loading>
    </div>
</template>

<script>
import { useStore } from 'vuex';
import { ref, reactive, computed, onMounted } from 'vue'
import { required, helpers } from '@vuelidate/validators'

import BaseDeleteModalCard from '@/components/UI/BaseDeleteModalCard.vue';

import Tag from '@/components/inputs/Tag.vue';

import useCrud from '@/hooks/crud.js'
import { useRoute, useRouter } from 'vue-router'

export default {
    components: {
        BaseDeleteModalCard,
        Tag,
    },
    setup(){
        const store = useStore();
        const listing = ref(true);
        const route = useRoute();
        const router = useRouter();

        const columns = {
            id: {
                label: "ID",
                sorting: true,
            },
            label: {
                label: "QUESTION",
                sorting: true,
            },
            label: {
                label: "BOARD",
                sorting: true,
            },
            label: {
                label: "STANDARD",
                sorting: true,
            },
            tags: {
                label: "TAGS",
                sorting: false,
            },
            actions: {
                label:"ACTIONS",
                sorting: false,
            }
        };

        const options = {
            fetch: 'questions/fetch',
            getters: 'questions/questions',
            delete: 'questions/delete',
            moduleName: 'Question(s)'
        }
        const { 
            items, 
            fetch, 
            paginate, 
            search, 
            sort, 
            params, 
            isLoading, 
            removeItem,
            parsed,
            editItem } = useCrud(options);

        onMounted(fetch(false));

        // This is very important from the create/edit form show.
        if (route.name === 'questions') {
            listing.value = true;
        } else {
            listing.value = false;
        }
        return {
            isLoading,
            columns,
            items,
            search,
            paginate, 
            sort,
            sortField: params.field,
            sortDirection: params.sort,
            editItem,
            removeItem,
            parsed,
            listing,
            fetch
        }
    },
    computed: {
        showPagination() {
            if ((this.items !== undefined) && (this.items.total / this.items.to > 1 || this.items.current_page != 1)) {
                return true;
            }
            return false;
        },

        result() {
            return this.items.data.map((item) => {
                return {
                    id: item.id,
                    label: JSON.parse(item.label),
                    icon: item.icon,
                    description: JSON.parse(item.description),
                    language_id: item.language_id,
                    tags: item.tagged.map((tag) => { return tag.tag_name})
                };
            });
        }
    },
    methods: {
        showDeleteModal(itemId) {
            this.selectedItem = itemId;
            this.openModal(this.options.deleteComponentName, itemId)
        },
    },
    watch: {
        '$route' (to, from) {
            if (to.name === 'questions') {
                this.listing = true;
                this.fetch(false);
            }
        }
    },
}
</script>
<style scoped>
.subject-table-div {
    width: 100%;
}
.active-row {
    background-color: chartreuse;
}
</style>