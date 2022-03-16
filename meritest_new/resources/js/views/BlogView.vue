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
                  <div class="blog-item blog-single">
                    <div class="blog-content">
                      <h3>{{ blog.title }}</h3>
                      <ul class="blog-meta">
                        <li>by <a href="#">Admin</a></li>
                        <li>by January 09, 2016</li>
                        <li>
                          in <a href="#">Adventure</a>, <a href="#">Backpack</a>
                        </li>
                        <li>32 comments</li>
                      </ul>

                      <div class="blog-entry" v-html="blog.content"></div>
                    </div>
                  </div>
                </div>

                <div class="clear mb-40"></div>
              </div>
            </div>

            <div class="GridLex-col-3_sm-4_xs-12_xss-12">
              <aside class="sidebar-wrapper for-blog">
                <!-- <div class="sidebar-module">
										<div class="sidebar-module-inner">
											<div class="sidebar-mini-search">
												<div class="input-group">
													<input type="text" class="form-control" placeholder="Search for...">
													<span class="input-group-btn">
														<button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
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

                <div class="clear"></div>

                <!-- <div class="sidebar-module clearfix">
														
										<h6 class="sidebar-title">Latest Posts</h6>
										
										<div class="sidebar-module-inner">
										
											<ul class="sidebar-post">
												<li class="clearfix">
													<a href="blog-single.html">
														<div class="image">
															<img src="images/blog/01-sm.jpg" alt="Popular Post" />
														</div>
														<div class="content">
															<h6>Enough around remove to barton agreed regret</h6>
															<p class="recent-post-sm-meta"><i class="fa fa-clock-o mr-5"></i>June 01, 2016</p>
														</div>
													</a>
												</li>
												<li class="clearfix">
													<a href="blog-single.html">
														<div class="image">
															<img src="images/blog/02-sm.jpg" alt="Popular Post" />
														</div>
														<div class="content">
															<h6>Year well shot deny shew come now had. Shall downs stand marry taken his for out</h6>
															<p class="recent-post-sm-meta"><i class="fa fa-clock-o mr-5"></i>April 25, 2016</p>
														</div>
													</a>
												</li>
												<li class="clearfix">
													<a href="blog-single.html">
														<div class="image">
															<img src="images/blog/03-sm.jpg" alt="Popular Post" />
														</div>
														<div class="content">
															<h6>Do related mr account brandon an up. Wrong for never ready ham these witty him</h6>
															<p class="recent-post-sm-meta"><i class="fa fa-clock-o mr-5"></i>March 20, 2016</p>
														</div>
													</a>
												</li>
												<li class="clearfix">
													<a href="blog-single.html">
														<div class="image">
															<img src="images/blog/04-sm.jpg" alt="Popular Post" />
														</div>
														<div class="content">
															<h6>Our compass see age uncivil matters weather forbade her minutes</h6>
															<p class="recent-post-sm-meta"><i class="fa fa-clock-o mr-5"></i>March 05, 2016</p>
														</div>
													</a>
												</li>
												<li class="clearfix">
													<a href="blog-single.html">
														<div class="image">
															<img src="images/blog/05-sm.jpg" alt="Popular Post" />
														</div>
														<div class="content">
															<h6>Ready how but truth son new under.</h6>
															<p class="recent-post-sm-meta"><i class="fa fa-clock-o mr-5"></i>February 17, 2015</p>
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
															<img src="images/blog/01-sm.jpg" alt="Popular Post" />
														</div>
														<div class="content">
															<h6>Appetite welcomed interest the goodness boy</h6>
															<p class="recent-post-sm-meta"><i class="fa fa-comments mr-5"></i>5 comments</p>
														</div>
													</a>
												</li>
												<li class="clearfix">
													<a href="blog-single.html">
														<div class="image">
															<img src="images/blog/02-sm.jpg" alt="Popular Post" />
														</div>
														<div class="content">
															<h6>Wrong for never ready ham these witty him</h6>
															<p class="recent-post-sm-meta"><i class="fa fa-comments mr-5"></i>5 comments</p>
														</div>
													</a>
												</li>
												<li class="clearfix">
													<a href="blog-single.html">
														<div class="image">
															<img src="images/blog/03-sm.jpg" alt="Popular Post" />
														</div>
														<div class="content">
															<h6>Tell size come hard mrs and four fond are</h6>
															<p class="recent-post-sm-meta"><i class="fa fa-comments mr-5"></i>5 comments</p>
														</div>
													</a>
												</li>
												<li class="clearfix">
													<a href="blog-single.html">
														<div class="image">
															<img src="images/blog/04-sm.jpg" alt="Popular Post" />
														</div>
														<div class="content">
															<h6>Side need at in what dear ever upon</h6>
															<p class="recent-post-sm-meta"><i class="fa fa-comments mr-5"></i>5 comments</p>
														</div>
													</a>
												</li>
												<li class="clearfix">
													<a href="blog-single.html">
														<div class="image">
															<img src="images/blog/05-sm.jpg" alt="Popular Post" />
														</div>
														<div class="content">
															<h6>Same down want joy neat ask pain help</h6>
															<p class="recent-post-sm-meta"><i class="fa fa-comments mr-5"></i>5 comments</p>
														</div>
													</a>
												</li>
											</ul>
										
										</div>
										
									</div>
									
									<div class="clear"></div> -->
              </aside>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, computed } from "vue";
import store from "@/store";
import { useRoute } from "vue-router";

export default {
    setup() {
        const route = useRoute();
        // Variables and actions related to listing.

        const blog = computed(() => store.state.blogs.blog);
        const blogCategories = computed(() => store.state.blogs.blogCategories);

        onMounted(() => {
            store.dispatch("blogs/show", route.params.id).then(() => {
                //loading.value = false;
            });
        });

        return {
            blog,
            blogCategories
        }
    }
}

</script>

<style>
</style>