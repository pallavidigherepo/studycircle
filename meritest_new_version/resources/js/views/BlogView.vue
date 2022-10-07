<template>
    <div>
        <breadcrumb :pageTitle="'Blog: '+blog.title"></breadcrumb>
        <div class="container">
            <div class="equal-content-sidebar-by-gridLex" v-html="blog.content">
            </div>
        </div>
    </div>
</template>

<script>
import '@/scrollspy_sidebar.js';
import { ref, onMounted, computed } from "vue";
import store from "@/store";
import { useRoute } from "vue-router";
//import moment from 'moment';

export default {
    setup() {
        const route = useRoute();
        // Variables and actions related to listing.

        const blog = computed(() => store.state.blogs.blog);
		
        const blogCategories = computed(() => store.state.blogs.blogCategories);

        onMounted(() => {
            store.dispatch("blogs/show", route.params.url).then(() => {
                //loading.value = false;
            });
        });

		
		function dateTime(value) {
		return moment(value).format('MMMM Do YYYY');
		}
		
        return {
            blog,
            blogCategories,
			dateTime
        }
    }
}

</script>

<style scoped>

</style>