<template>
  <div>
    <breadcrumb :pageTitle="'Blogs'"></breadcrumb>
    <div class="equal-content-sidebar-wrapper">
      <div class="equal-content-sidebar-by-gridLex right-sidebar">
        <div class="container">
          <div class="GridLex-grid-noGutter-equalHeight">
            <div class="GridLex-col-9_sm-8_xs-12_xss-12">
              <div class="content-wrapper">
                <div class="blog-wrapper">
                  <div
                    class="blog-item"
                    v-for="(blog, index) in blogs.data"
                    :key="index"
                  >
                    <div class="blog-content">
                      <h3>
                        <router-link
                          :to="{ name: 'BlogView', params: { id: blog.id } }"
                          class="inverse"
						  :blog="blog.id"
                        >
                          {{ blog.title }}
                        </router-link>
                      </h3>
                      <ul class="blog-meta">
                        <li>by <a href="#">Admin</a></li>
                        <li>by January 09, 2016</li>
                        <li>
                          in <a href="#">Adventure</a>, <a href="#">Backpack</a>
                        </li>
                        <li>32 comments</li>
                      </ul>
                      <div
                        class="blog-entry"
                        v-html="blog.content.slice(0, 500)"
                      ></div>
                      <router-link
                        :to="{ name: 'BlogView', params: { id: blog.id } }"
						:blog="blog.id"
                        class="btn btn-primary btn-sm"
                      >
                        Read More <i class="fa fa-long-arrow-right"></i>
                      </router-link>
                    </div>
                  </div>
                </div>

                <!-- <div class="review-pager pager-wrappper mt-40">
                  <div class="row">
                    <div class="col-xs-12 col-sm-12">
                      <ul class="pagination">
                        <li>
                          <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                          </a>
                        </li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><span>...</span></li>
                        <li><a href="#">11</a></li>
                        <li><a href="#">12</a></li>
                        <li><a href="#">13</a></li>
                        <li>
                          <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>

            <div class="GridLex-col-3_sm-4_xs-12_xss-12">
              <aside class="sidebar-wrapper for-blog">
                <!-- <div class="sidebar-module">
                  <div class="sidebar-module-inner">
                    <div class="sidebar-mini-search">
                      <div class="input-group">
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Search for..."
                        />
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="button">
                            <i class="fa fa-search"></i>
                          </button>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="clear"></div> -->

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

                <!-- <div class="clear"></div>

                <div class="sidebar-module clearfix">
                  <h6 class="sidebar-title">Latest Posts</h6>

                  <div class="sidebar-module-inner">
                    <ul class="sidebar-post">
                      <li class="clearfix">
                        <a href="blog-single.html">
                          <div class="image">
                            <img
                              src="images/blog/01-sm.jpg"
                              alt="Popular Post"
                            />
                          </div>
                          <div class="content">
                            <h6>
                              Enough around remove to barton agreed regret
                            </h6>
                            <p class="recent-post-sm-meta">
                              <i class="fa fa-clock-o mr-5"></i>June 01, 2016
                            </p>
                          </div>
                        </a>
                      </li>
                      <li class="clearfix">
                        <a href="blog-single.html">
                          <div class="image">
                            <img
                              src="images/blog/02-sm.jpg"
                              alt="Popular Post"
                            />
                          </div>
                          <div class="content">
                            <h6>
                              Year well shot deny shew come now had. Shall downs
                              stand marry taken his for out
                            </h6>
                            <p class="recent-post-sm-meta">
                              <i class="fa fa-clock-o mr-5"></i>April 25, 2016
                            </p>
                          </div>
                        </a>
                      </li>
                      <li class="clearfix">
                        <a href="blog-single.html">
                          <div class="image">
                            <img
                              src="images/blog/03-sm.jpg"
                              alt="Popular Post"
                            />
                          </div>
                          <div class="content">
                            <h6>
                              Do related mr account brandon an up. Wrong for
                              never ready ham these witty him
                            </h6>
                            <p class="recent-post-sm-meta">
                              <i class="fa fa-clock-o mr-5"></i>March 20, 2016
                            </p>
                          </div>
                        </a>
                      </li>
                      <li class="clearfix">
                        <a href="blog-single.html">
                          <div class="image">
                            <img
                              src="images/blog/04-sm.jpg"
                              alt="Popular Post"
                            />
                          </div>
                          <div class="content">
                            <h6>
                              Our compass see age uncivil matters weather
                              forbade her minutes
                            </h6>
                            <p class="recent-post-sm-meta">
                              <i class="fa fa-clock-o mr-5"></i>March 05, 2016
                            </p>
                          </div>
                        </a>
                      </li>
                      <li class="clearfix">
                        <a href="blog-single.html">
                          <div class="image">
                            <img
                              src="images/blog/05-sm.jpg"
                              alt="Popular Post"
                            />
                          </div>
                          <div class="content">
                            <h6>Ready how but truth son new under.</h6>
                            <p class="recent-post-sm-meta">
                              <i class="fa fa-clock-o mr-5"></i>February 17,
                              2015
                            </p>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="clear"></div>

                <div class="sidebar-module clearfix">
                  <h6 class="sidebar-title">Popular Posts</h6>

                  <div class="sidebar-module-inner">
                    <ul class="sidebar-post">
                      <li class="clearfix">
                        <a href="blog-single.html">
                          <div class="image">
                            <img
                              src="images/blog/01-sm.jpg"
                              alt="Popular Post"
                            />
                          </div>
                          <div class="content">
                            <h6>Appetite welcomed interest the goodness boy</h6>
                            <p class="recent-post-sm-meta">
                              <i class="fa fa-comments mr-5"></i>5 comments
                            </p>
                          </div>
                        </a>
                      </li>
                      <li class="clearfix">
                        <a href="blog-single.html">
                          <div class="image">
                            <img
                              src="images/blog/02-sm.jpg"
                              alt="Popular Post"
                            />
                          </div>
                          <div class="content">
                            <h6>Wrong for never ready ham these witty him</h6>
                            <p class="recent-post-sm-meta">
                              <i class="fa fa-comments mr-5"></i>5 comments
                            </p>
                          </div>
                        </a>
                      </li>
                      <li class="clearfix">
                        <a href="blog-single.html">
                          <div class="image">
                            <img
                              src="images/blog/03-sm.jpg"
                              alt="Popular Post"
                            />
                          </div>
                          <div class="content">
                            <h6>Tell size come hard mrs and four fond are</h6>
                            <p class="recent-post-sm-meta">
                              <i class="fa fa-comments mr-5"></i>5 comments
                            </p>
                          </div>
                        </a>
                      </li>
                      <li class="clearfix">
                        <a href="blog-single.html">
                          <div class="image">
                            <img
                              src="images/blog/04-sm.jpg"
                              alt="Popular Post"
                            />
                          </div>
                          <div class="content">
                            <h6>Side need at in what dear ever upon</h6>
                            <p class="recent-post-sm-meta">
                              <i class="fa fa-comments mr-5"></i>5 comments
                            </p>
                          </div>
                        </a>
                      </li>
                      <li class="clearfix">
                        <a href="blog-single.html">
                          <div class="image">
                            <img
                              src="images/blog/05-sm.jpg"
                              alt="Popular Post"
                            />
                          </div>
                          <div class="content">
                            <h6>Same down want joy neat ask pain help</h6>
                            <p class="recent-post-sm-meta">
                              <i class="fa fa-comments mr-5"></i>5 comments
                            </p>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="clear"></div>

                <div class="sidebar-module clearfix">
                  <h6 class="sidebar-title">Archives</h6>

                  <div class="sidebar-module-inner">
                    <ul class="sidebar-archives">
                      <li>
                        <a href="#">January 2015<span>(25)</span></a>
                      </li>
                      <li class="active">
                        <a href="#">February 2015<span>(2)</span></a>
                      </li>
                      <li>
                        <a href="#">March 2015<span>(14)</span></a>
                      </li>
                      <li>
                        <a href="#">April 2015<span>(157)</span></a>
                      </li>
                      <li>
                        <a href="#">June 2015<span>(87)</span></a>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="clear"></div>

                <div class="sidebar-module clearfix">
                  <h6 class="sidebar-title">Tags</h6>

                  <div class="sidebar-module-inner">
                    <div class="tag-cloud clearfix">
                      <a href="#" class="tag-item">HTML5</a>
                      <a href="#" class="tag-item">CSS3</a>
                      <a href="#" class="tag-item">jQuery</a>
                      <a href="#" class="tag-item">Creative</a>
                      <a href="#" class="tag-item">Design</a>
                      <a href="#" class="tag-item">iOS</a>
                      <a href="#" class="tag-item">Android</a>
                      <a href="#" class="tag-item">Video</a>
                      <a href="#" class="tag-item">Markup</a>
                      <a href="#" class="tag-item">Programming</a>
                      <a href="#" class="tag-item">SEO</a>
                    </div>
                  </div>
                </div> -->
              </aside>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import store from "@/store";
// Variables and actions related to listing.
const blogs = computed(() => store.state.blogs.blogs);
const blogCategories = computed(() => store.state.blogs.blogCategories);

onMounted(() => {
  store.dispatch("blogs/list").then(() => {
    //loading.value = false;
  });
});
const filtered = computed(() => {});
/*filters(() => {
    truncate(text, length) {
      if (text.length > 30) {
        return text.substring(0, 30) + '...'
      } else {
        return text
      }
    }
  });*/
</script>

<style>
</style>