<template>
  <div>
    <!-- start slick hero slider -->
    <carousal></carousal>
    <!-- end slick hero slider -->
    <div class="promo-box-bg-color bg-org">
      <div class="container">
        <div class="GridLex-gap-30">
          <div class="GridLex-grid-noGutter-equalHeight GridLex-grid-middle">
            <div class="GridLex-col-9_sm-8_xs-12_xss-12">
              <div class="GridLex-inner">
                <h3>Want to know more about our services?</h3>
              </div>
            </div>

            <div class="GridLex-col-3_sm-4_xs-12_xss-12">
              <div class="GridLex-inner">
                <router-link to="/our-services" class="btn btn-primary"
                  >Our Services</router-link
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- start Why Us -->
    <OurProducts />
    <!-- end Why Us -->

    <section class="section pt-0">
      <div class="overflow-hidden half-image-content">
        <div class="GridLex-grid-noGutter-equalHeight">
          <div
            class="GridLex-col-6_sm-12_xs-12 bg-img grow_graph"            
          ></div>

          <div class="GridLex-col-6_sm-12_xs-12 bg-light">
            <div class="inner">
              <div class="promo-box-02">
                <h3 class="mb-20 text-primary">
                  Join us to grow your business
                </h3>
                <p
                  class="
                    font20
                    line30
                    font300
                    font-roboto-condensed
                    mb-20
                    font19-xs
                  "
                >
                  Grow your business according to present market need.
                </p>
                <p class="mb-25">
                  Meritest helps you to grow your business according to market
                  need. To know more about us
                </p>

                <a
                  href="https://www.facebook.com/meritestdotin"
                  class="btn btn-primary btn-facebook btn-social mt-5 mr-5"
                  target="_blank"
                  >Follow us on Facebook</a
                >
                <a
                  href="https://twitter.com/meritestdotin"
                  class="btn btn-primary btn-twitter btn-social mt-5"
                  target="_blank"
                  >Follow us on Twitter</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="overflow-hidden half-image-content">
        <div class="GridLex-grid-noGutter-equalHeight">
          <div class="GridLex-col-6_sm-12_xs-12 bg-light">
            <div class="inner">
              <div class="promo-box-02">
                <h3 class="mb-20 text-primary">
                  Website Design and Development
                </h3>
                <p
                  class="
                    font20
                    line30
                    font300
                    font-roboto-condensed
                    font19-xs
                    mb-20
                  "
                >
                  Have idea, but need to shape your idea?
                </p>
                <p class="mb-20">
                  Meritest will help you shape your ideas with all expertise.
                </p>
                <div class="mt-30">
                  <router-link
                    to="/our-services"
                    class="btn btn-primary btn-social mt-5"
                    >Our Services</router-link
                  >
                </div>
              </div>
            </div>
          </div>

          <div
            class="GridLex-col-6_sm-12_xs-12 bg-img home_services"
          ></div>
        </div>
      </div>
    </section>

    <!-- start Introduction -->
    <!-- <section class="section pt-0">
      <div class="container">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <div class="section-title">
              <h2 class="text-center">What Do You Want to Learn</h2>
            </div>
          </div>
        </div>

        <div class="GridLex-gap-30 mt-10">
          <div class="GridLex-grid-noGutter-equalHeight GridLex-grid-center">
            <div class="GridLex-col-3_sm-4_xs-6_xss-12">
              <div class="course-category-icon">
                <div class="icon text-primary">
                  <i class="icon-basket-loaded"></i>
                </div>
                <h4><a href="#">Business</a></h4>
                <div class="sub-category">
                  <a href="#">Finance</a>
                  <a href="#">Marketing</a>
                  <a href="#">Commerce</a>
                  <a href="#">Import/export</a>
                  <a href="#">More</a>
                </div>
              </div>
            </div>

            <div class="GridLex-col-3_sm-4_xs-6_xss-12">
              <div class="course-category-icon">
                <div class="icon text-primary">
                  <i class="icon-screen-desktop"></i>
                </div>
                <h4><a href="#">Computer &amp; IT</a></h4>
                <div class="sub-category">
                  <a href="#">Networking</a>
                  <a href="#">Database</a>
                  <a href="#">Programming</a>
                  <a href="#">Security</a>
                  <a href="#">More</a>
                </div>
              </div>
            </div>

            <div class="GridLex-col-3_sm-4_xs-6_xss-12">
              <div class="course-category-icon">
                <div class="icon text-primary">
                  <i class="icon-chemistry"></i>
                </div>
                <h4><a href="#">Science</a></h4>
                <div class="sub-category">
                  <a href="#">Biology</a>
                  <a href="#">Mathematics</a>
                  <a href="#">Chemistry</a>
                  <a href="#">Physics</a>
                  <a href="#">More</a>
                </div>
              </div>
            </div>

            <div class="GridLex-col-3_sm-4_xs-6_xss-12">
              <div class="course-category-icon">
                <div class="icon text-primary">
                  <i class="icon-music-tone-alt"></i>
                </div>
                <h4><a href="#">Music</a></h4>
                <div class="sub-category">
                  <a href="#">Production</a>
                  <a href="#">Ableton Live</a>
                  <a href="#">Fundamentals</a>
                  <a href="#">Guitar</a>
                  <a href="#">More</a>
                </div>
              </div>
            </div>

            <div class="GridLex-col-3_sm-4_xs-6_xss-12">
              <div class="course-category-icon">
                <div class="icon text-primary">
                  <i class="icon-vector"></i>
                </div>
                <h4><a href="#">Design</a></h4>
                <div class="sub-category">
                  <a href="#">Typography</a>
                  <a href="#">Lettering</a>
                  <a href="#">Logo</a>
                  <a href="#">Photoshop</a>
                  <a href="#">More</a>
                </div>
              </div>
            </div>

            <div class="GridLex-col-3_sm-4_xs-6_xss-12">
              <div class="course-category-icon">
                <div class="icon text-primary">
                  <i class="icon-camera"></i>
                </div>
                <h4><a href="#">Photography</a></h4>
                <div class="sub-category">
                  <a href="#">Digital Photography</a>
                  <a href="#">Editing</a>
                  <a href="#">Portrait</a>
                  <a href="#">Composition</a>
                  <a href="#">More</a>
                </div>
              </div>
            </div>

            <div class="GridLex-col-3_sm-4_xs-6_xss-12">
              <div class="course-category-icon">
                <div class="icon text-primary">
                  <i class="icon-note"></i>
                </div>
                <h4><a href="#">Writing</a></h4>
                <div class="sub-category">
                  <a href="#">Storytelling</a>
                  <a href="#">Copywriting</a>
                  <a href="#">Screenwriting</a>
                  <a href="#">Publishing</a>
                  <a href="#">More</a>
                </div>
              </div>
            </div>

            <div class="GridLex-col-3_sm-4_xs-6_xss-12">
              <div class="course-category-icon">
                <div class="icon text-primary">
                  <i class="icon-cup"></i>
                </div>
                <h4><a href="#">Culinary</a></h4>
                <div class="sub-category">
                  <a href="#">Cooking</a>
                  <a href="#">Food &amp; Drink</a>
                  <a href="#">Oysters</a>
                  <a href="#">Recipe Design</a>
                  <a href="#">More</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center mt-50">
          <a href="#" class="btn btn-primary">More Categories</a>
        </div>
      </div>
    </section> -->
    <!-- end Introduction -->

    <!-- start Top Offer -->
    <!-- <section class="section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <div class="section-title">
              <h2 class="text-center">Latest Courses</h2>
              <p>
                However venture pursuit he am mr cordial. Forming musical am
                hearing studied be luckily.
                <strong>Ourselves for determine</strong> attending how led
                gentleman sincerity.
              </p>
            </div>
          </div>
        </div>

        <div class="course-item-wrapper gap-20">
          <div class="GridLex-grid-noGutter-equalHeight GridLex-grid-center">
            <div class="GridLex-col-3_mdd-4_sm-6_xs-6_xss-12">
              <div class="course-item">
                <a href="#">
                  <div class="course-item-image">
                    <img
                      src="/src/assets/images/course-item/01.jpg"
                      alt="Image"
                      class="img-responsive"
                    />
                  </div>
                  <div class="course-item-top clearfix">
                    <div class="course-item-instructor">
                      <div class="image">
                        <img
                          src="/src/assets/images/testimonial/01.jpg"
                          alt="Image"
                          class="img-circle"
                        />
                      </div>
                      <span>Mark Lassoff </span>
                    </div>
                    <div class="course-item-price bg-danger">$19.56</div>
                  </div>
                  <div class="course-item-content">
                    <div class="rating-wrapper">
                      <div class="rating-item">
                        <input
                          type="hidden"
                          class="rating"
                          data-filled="fa fa-star"
                          data-empty="fa fa-star-o"
                          data-fractions="2"
                          data-readonly
                          value="3.5"
                        />
                      </div>
                      <span> (7 review)</span>
                    </div>
                    <h3 class="text-primary">
                      Foundations of Enterprise Development for Windows
                    </h3>
                    <p>
                      Create Code That Screams with C++! Hours of Video Lecture,
                      Lab Exercises and Dozens of Code Samples for You To Use!
                      Dave Pither-Patterson
                    </p>
                  </div>
                  <div class="course-item-bottom clearfix">
                    <div>
                      <i class="fa fa-folder-open-o"></i
                      ><span class="block"> Programming</span>
                    </div>
                    <div>
                      <i class="fa fa-pencil-square-o"></i
                      ><span class="block"> 15 Lessons</span>
                    </div>
                    <div>
                      <i class="fa fa-calendar-check-o"></i
                      ><span class="block"> 4.5 Hours</span>
                    </div>
                  </div>
                </a>
              </div>
            </div>

            <div class="GridLex-col-3_mdd-4_sm-6_xs-6_xss-12">
              <div class="course-item">
                <a href="#">
                  <div class="course-item-image">
                    <img
                      src="/src/assets/images/course-item/02.jpg"
                      alt="Image"
                      class="img-responsive"
                    />
                  </div>
                  <div class="course-item-top clearfix">
                    <div class="course-item-instructor">
                      <div class="image">
                        <img
                          src="/src/assets/images/testimonial/02.jpg"
                          alt="Image"
                          class="img-circle"
                        />
                      </div>
                      <span>Nicholas Mavrakis</span>
                    </div>
                    <div class="course-item-price bg-danger">$19.56</div>
                  </div>
                  <div class="course-item-content">
                    <div class="rating-wrapper">
                      <div class="rating-item">
                        <input
                          type="hidden"
                          class="rating"
                          data-filled="fa fa-star"
                          data-empty="fa fa-star-o"
                          data-fractions="2"
                          data-readonly
                          value="3.5"
                        />
                      </div>
                      <span> (7 review)</span>
                    </div>
                    <h3 class="text-primary">
                      Food Photography: Shooting at Restaurants
                    </h3>
                    <p>
                      She propriety immediate was improving. He or entrance
                      humoured likewise moderate. Much nor game son say feel.
                    </p>
                  </div>
                  <div class="course-item-bottom clearfix">
                    <div>
                      <i class="fa fa-folder-open-o"></i
                      ><span class="block"> Photography </span>
                    </div>
                    <div>
                      <i class="fa fa-pencil-square-o"></i
                      ><span class="block"> 15 Lessons</span>
                    </div>
                    <div>
                      <i class="fa fa-calendar-check-o"></i
                      ><span class="block"> 4.5 Hours</span>
                    </div>
                  </div>
                </a>
              </div>
            </div>

            <div class="GridLex-col-3_mdd-4_sm-6_xs-6_xss-12">
              <div class="course-item">
                <a href="#">
                  <div class="course-item-image">
                    <img
                      src="/src/assets/images/course-item/03.jpg"
                      alt="Image"
                      class="img-responsive"
                    />
                  </div>
                  <div class="course-item-top clearfix">
                    <div class="course-item-instructor">
                      <div class="image">
                        <img
                          src="/src/assets/images/testimonial/03.jpg"
                          alt="Image"
                          class="img-circle"
                        />
                      </div>
                      <span>Ange Ermolova</span>
                    </div>
                    <div class="course-item-price bg-danger">$19.56</div>
                  </div>
                  <div class="course-item-content">
                    <div class="rating-wrapper">
                      <div class="rating-item">
                        <input
                          type="hidden"
                          class="rating"
                          data-filled="fa fa-star"
                          data-empty="fa fa-star-o"
                          data-fractions="2"
                          data-readonly
                          value="3.5"
                        />
                      </div>
                      <span> (7 review)</span>
                    </div>
                    <h3 class="text-primary">
                      Introduction to HTML: Build a Portfolio Website
                    </h3>
                    <p>
                      Fulfilled direction use continual set him propriety
                      continued. Saw met applauded favourite deficient newspaper
                      questions consulted
                    </p>
                  </div>
                  <div class="course-item-bottom clearfix">
                    <div>
                      <i class="fa fa-folder-open-o"></i
                      ><span class="block"> Wed Design</span>
                    </div>
                    <div>
                      <i class="fa fa-pencil-square-o"></i
                      ><span class="block"> 15 Lessons</span>
                    </div>
                    <div>
                      <i class="fa fa-calendar-check-o"></i
                      ><span class="block"> 4.5 Hours</span>
                    </div>
                  </div>
                </a>
              </div>
            </div>

            <div class="GridLex-col-3_mdd-4_sm-6_xs-6_xss-12">
              <div class="course-item">
                <a href="#">
                  <div class="course-item-image">
                    <img
                      src="/src/assets/images/course-item/04.jpg"
                      alt="Image"
                      class="img-responsive"
                    />
                  </div>
                  <div class="course-item-top clearfix">
                    <div class="course-item-instructor">
                      <div class="image">
                        <img
                          src="/src/assets/images/testimonial/02.jpg"
                          alt="Image"
                          class="img-circle"
                        />
                      </div>
                      <span>Nicholas Mavrakis</span>
                    </div>
                    <div class="course-item-price bg-danger">$19.56</div>
                  </div>
                  <div class="course-item-content">
                    <div class="rating-wrapper">
                      <div class="rating-item">
                        <input
                          type="hidden"
                          class="rating"
                          data-filled="fa fa-star"
                          data-empty="fa fa-star-o"
                          data-fractions="2"
                          data-readonly
                          value="3.5"
                        />
                      </div>
                      <span> (7 review)</span>
                    </div>
                    <h3 class="text-primary">
                      Foundations of Enterprise Development for Windows
                    </h3>
                    <p>
                      Create Code That Screams with C++! Hours of Video Lecture,
                      Lab Exercises and Dozens of Code Samples for You To Use!
                      Dave Pither-Patterson
                    </p>
                  </div>
                  <div class="course-item-bottom clearfix">
                    <div>
                      <i class="fa fa-folder-open-o"></i
                      ><span class="block"> Programming</span>
                    </div>
                    <div>
                      <i class="fa fa-pencil-square-o"></i
                      ><span class="block"> 15 Lessons</span>
                    </div>
                    <div>
                      <i class="fa fa-calendar-check-o"></i
                      ><span class="block"> 4.5 Hours</span>
                    </div>
                  </div>
                </a>
              </div>
            </div>

            <div class="GridLex-col-3_mdd-4_sm-6_xs-6_xss-12">
              <div class="course-item">
                <a href="#">
                  <div class="course-item-image">
                    <img
                      src="/src/assets/images/course-item/05.jpg"
                      alt="Image"
                      class="img-responsive"
                    />
                  </div>
                  <div class="course-item-top clearfix">
                    <div class="course-item-instructor">
                      <div class="image">
                        <img
                          src="/src/assets/images/testimonial/01.jpg"
                          alt="Image"
                          class="img-circle"
                        />
                      </div>
                      <span>Mark Lassoff </span>
                    </div>
                    <div class="course-item-price bg-danger">$19.56</div>
                  </div>
                  <div class="course-item-content">
                    <div class="rating-wrapper">
                      <div class="rating-item">
                        <input
                          type="hidden"
                          class="rating"
                          data-filled="fa fa-star"
                          data-empty="fa fa-star-o"
                          data-fractions="2"
                          data-readonly
                          value="3.5"
                        />
                      </div>
                      <span> (7 review)</span>
                    </div>
                    <h3 class="text-primary">
                      Introduction to HTML: Build a Portfolio Website
                    </h3>
                    <p>
                      Fulfilled direction use continual set him propriety
                      continued. Saw met applauded favourite deficient ask him
                      cold feel
                    </p>
                  </div>
                  <div class="course-item-bottom clearfix">
                    <div>
                      <i class="fa fa-folder-open-o"></i
                      ><span class="block"> Wed Design</span>
                    </div>
                    <div>
                      <i class="fa fa-pencil-square-o"></i
                      ><span class="block"> 15 Lessons</span>
                    </div>
                    <div>
                      <i class="fa fa-calendar-check-o"></i
                      ><span class="block"> 4.5 Hours</span>
                    </div>
                  </div>
                </a>
              </div>
            </div>

            <div class="GridLex-col-3_mdd-4_sm-6_xs-6_xss-12">
              <div class="course-item">
                <a href="#">
                  <div class="course-item-image">
                    <img
                      src="/src/assets/images/course-item/06.jpg"
                      alt="Image"
                      class="img-responsive"
                    />
                  </div>
                  <div class="course-item-top clearfix">
                    <div class="course-item-instructor">
                      <div class="image">
                        <img
                          src="/src/assets/images/testimonial/04.jpg"
                          alt="Image"
                          class="img-circle"
                        />
                      </div>
                      <span>Suttira Ketkaew</span>
                    </div>
                    <div class="course-item-price bg-danger">$19.56</div>
                  </div>
                  <div class="course-item-content">
                    <div class="rating-wrapper">
                      <div class="rating-item">
                        <input
                          type="hidden"
                          class="rating"
                          data-filled="fa fa-star"
                          data-empty="fa fa-star-o"
                          data-fractions="2"
                          data-readonly
                          value="3.5"
                        />
                      </div>
                      <span> (7 review)</span>
                    </div>
                    <h3 class="text-primary">
                      Foundations of Enterprise Development for Windows
                    </h3>
                    <p>
                      Create Code That Screams with C++! Hours of Video Lecture,
                      Lab Exercises and Dozens of Code Samples for You To Use!
                      Dave Pither-Patterson
                    </p>
                  </div>
                  <div class="course-item-bottom clearfix">
                    <div>
                      <i class="fa fa-folder-open-o"></i
                      ><span class="block"> Programming</span>
                    </div>
                    <div>
                      <i class="fa fa-pencil-square-o"></i
                      ><span class="block"> 15 Lessons</span>
                    </div>
                    <div>
                      <i class="fa fa-calendar-check-o"></i
                      ><span class="block"> 4.5 Hours</span>
                    </div>
                  </div>
                </a>
              </div>
            </div>

            <div class="GridLex-col-3_mdd-4_sm-6_xs-6_xss-12">
              <div class="course-item">
                <a href="#">
                  <div class="course-item-image">
                    <img
                      src="/src/assets/images/course-item/07.jpg"
                      alt="Image"
                      class="img-responsive"
                    />
                  </div>
                  <div class="course-item-top clearfix">
                    <div class="course-item-instructor">
                      <div class="image">
                        <img
                          src="/src/assets/images/testimonial/03.jpg"
                          alt="Image"
                          class="img-circle"
                        />
                      </div>
                      <span>Ange Ermolova</span>
                    </div>
                    <div class="course-item-price bg-danger">$19.56</div>
                  </div>
                  <div class="course-item-content">
                    <div class="rating-wrapper">
                      <div class="rating-item">
                        <input
                          type="hidden"
                          class="rating"
                          data-filled="fa fa-star"
                          data-empty="fa fa-star-o"
                          data-fractions="2"
                          data-readonly
                          value="3.5"
                        />
                      </div>
                      <span> (7 review)</span>
                    </div>
                    <h3 class="text-primary">
                      Foundations of Enterprise Development for Windows
                    </h3>
                    <p>
                      Create Code That Screams with C++! Hours of Video Lecture,
                      Lab Exercises and Dozens of Code Samples for You To Use!
                      Dave Pither-Patterson
                    </p>
                  </div>
                  <div class="course-item-bottom clearfix">
                    <div>
                      <i class="fa fa-folder-open-o"></i
                      ><span class="block"> Programming</span>
                    </div>
                    <div>
                      <i class="fa fa-pencil-square-o"></i
                      ><span class="block"> 15 Lessons</span>
                    </div>
                    <div>
                      <i class="fa fa-calendar-check-o"></i
                      ><span class="block"> 4.5 Hours</span>
                    </div>
                  </div>
                </a>
              </div>
            </div>

            <div class="GridLex-col-3_mdd-4_sm-6_xs-6_xss-12">
              <div class="course-item">
                <a href="#">
                  <div class="course-item-image">
                    <img
                      src="/src/assets/images/course-item/08.jpg"
                      alt="Image"
                      class="img-responsive"
                    />
                  </div>
                  <div class="course-item-top clearfix">
                    <div class="course-item-instructor">
                      <div class="image">
                        <img
                          src="/src/assets/images/testimonial/02.jpg"
                          alt="Image"
                          class="img-circle"
                        />
                      </div>
                      <span>Nicholas Mavrakis</span>
                    </div>
                    <div class="course-item-price bg-danger">$19.56</div>
                  </div>
                  <div class="course-item-content">
                    <div class="rating-wrapper">
                      <div class="rating-item">
                        <input
                          type="hidden"
                          class="rating"
                          data-filled="fa fa-star"
                          data-empty="fa fa-star-o"
                          data-fractions="2"
                          data-readonly
                          value="3.5"
                        />
                      </div>
                      <span> (7 review)</span>
                    </div>
                    <h3 class="text-primary">
                      Food Photography: Shooting at Restaurants
                    </h3>
                    <p>
                      She propriety immediate was improving. He or entrance
                      humoured likewise moderate. Much nor game son say feel.
                    </p>
                  </div>
                  <div class="course-item-bottom clearfix">
                    <div>
                      <i class="fa fa-folder-open-o"></i
                      ><span class="block"> Photography </span>
                    </div>
                    <div>
                      <i class="fa fa-pencil-square-o"></i
                      ><span class="block"> 15 Lessons</span>
                    </div>
                    <div>
                      <i class="fa fa-calendar-check-o"></i
                      ><span class="block"> 4.5 Hours</span>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    <!-- end Top Offer -->

    <!-- start Top Destinations -->
    <!-- <section class="section pb-70">
      <div class="container">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <div class="section-title">
              <h2 class="text-center">How Edutute Works</h2>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-4">
            <div class="icon-featured">
              <h4>Learn at your own availability</h4>
              <span class="icon text-primary"
                ><i class="ion-ios-timer-outline"></i
              ></span>
              <p>
                Raising say express had chiefly detract demands she. Quiet led
                own cause three him marianne attended.
              </p>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="icon-featured">
              <h4>Learn by watching short video</h4>
              <span class="icon text-primary"
                ><i class="ion-ios-film-outline"></i
              ></span>
              <p>
                Prospect humoured mistress to by proposal marianne attended.
                Simplicity the far admiration preference everything.
              </p>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="icon-featured">
              <h4>Learn by real-time doing and pratacing</h4>
              <span class="icon text-primary"
                ><i class="ion-ios-compose-outline"></i
              ></span>
              <p>
                Our compass see age uncivil matters weather forbade her minutes.
                Ready how but truth son new under.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    <!-- end Top Destinations -->

    <!-- start Promo -->
    <!-- <div
      class="promo-box-bg-img"
      style="background-image: url('/src/assets/images/teacher-bg.jpg')"
    >
      <div class="container">
        <div class="row">
          <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
              <div class="section-title mb-30">
                <h2 class="text-center">Becoming our course contributor</h2>
                <p>
                  Engaged its was evident pleased husband. Ye goodness felicity
                  do disposal dwelling no. First am plate jokes to began of
                  cause an scale.
                </p>
              </div>

              <div class="text-center mt-40">
                <a href="#" class="btn btn-primary">Learn more</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <!-- end Promo -->
  </div>
</template>

<script setup>
//import Carousal from './V2/Carousal.vue';
import OurProducts from "./V2/OurProducts.vue";
</script>

<style scoped>

</style>