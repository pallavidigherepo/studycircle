<template>
  <div>
    <breadcrumb :pageTitle="'Blogs'"></breadcrumb>
    <div class="equal-content-sidebar-wrapper">
      <div class="equal-content-sidebar-by-gridLex right-sidebar">
        <div class="container">
          <div class="GridLex-grid-noGutter-equalHeight">
            <div class="GridLex-col-12_sm-12_xs-12_xss-12">
              <div class="content-wrapper">
                <div class="blog-wrapper">
                  <div
                    class="blog-item"
                    v-for="(blog, index) in blogs"
                    :key="index"
                  >
                    <div class="blog-content">
                      <h3>
                        <router-link
                          :to="{ name: 'BlogView', params: { url: blog.url } }"
                          class="inverse"
                        >
                          {{ blog.title }}
                        </router-link>
                      </h3>
                      <ul class="blog-meta">
                        <li>Created on <strong>{{ dateTime(blog.created_at) }}</strong></li>
                        <li>Created by <strong>Sudhir Mishra</strong></li>
                      </ul>
                      <div
                        class="blog-entry"
                        v-html="blog.short_content.slice(0, 500)"
                      ></div>
                      <a
                        :href="'/blogs/'+blog.url"
                        class="btn btn-primary btn-sm"
                      >
                        Read More <i class="fa fa-long-arrow-right"></i>
                      </a>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- <div class="GridLex-col-3_sm-4_xs-12_xss-12">
              <aside class="sidebar-wrapper for-blog">
                
                <div class="sidebar-module clearfix">
                  <h6 class="sidebar-title">Categories</h6>

                  <div class="sidebar-module-inner">
                    <ul class="sidebar-category">
                      <li
                        v-for="(blogCategory, index) in blogCategories"
                        :key="index"
                      >
                        {{ blogCategory.name }}
                      </li>
                    </ul>
                  </div>
                </div>

              </aside>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, computed } from "vue";
import store from "@/store";
import moment from 'moment';

export default {
  setup() {
    // Variables and actions related to listing.
    const blogs = computed(() => store.state.blogs.blogs);
    const blogCategories = computed(() => store.state.blogs.blogCategories);

    onMounted(() => {
      store.dispatch("blogs/list").then(() => {
        //loading.value = false;
      });
    });
    function dateTime(value) {
      return moment(value).format('MMMM Do YYYY');
    }
    return {
      blogs,
      blogCategories,
      dateTime
    }
  },
};
</script>

<style>
</style>