<template>
  <div clas="slick-hero-slider-wrapper">
    <div
      id="bootstrap-carousel-slider"
      class="carousel slide"
      data-ride="carousel"
      data-interval="2000"
    >
      <ol class="carousel-indicators">
        <li
           data-target="#bootstrap-carousel-slider"
          :class="{ 'active': index == 1 }"
          v-for="(slide, index) in slides"
          :key="slide.id"
          :data-slide-to="index-1"
        ></li>
      </ol>
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <!-- First slide -->
        <div
          v-for="(slide, index) in slides"
          :key="slide.id"
          class="item"
          :class="{ 'active': index == 1 }"
        >
          <div class="image">
            <img :src="slide.image" :alt="slide.caption" class="d-block w-100" />
          </div>
          <div class="carousel-caption d-none d-md-block">
            <h5 class="text-cetre">{{ slide.caption }}</h5>
            <p>{{ slide.description }}</p>
          </div>
        </div>
        <!-- /.item -->
      </div>
      <!-- /.carousel-inner -->
      
      <!-- Controls -->
      <a
        class="left carousel-control"
        href="#bootstrap-carousel-slider"
        role="button"
        data-slide="prev"
      >
        <span class="carousel-control-left"
          ><i class="pe-7s-angle-left" aria-hidden="true"></i
        ></span>
        <span class="sr-only">Previous</span>
      </a>
      <a
        class="right carousel-control"
        href="#bootstrap-carousel-slider"
        role="button"
        data-slide="next"
      >
        <span class="carousel-control-right"
          ><i class="pe-7s-angle-right" aria-hidden="true"></i
        ></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <!-- /.carousel -->
  </div>
</template>

<script setup>
const slides = {
  1: {
    image: "/src/assets/images/slides/need_a_website_with_mobile.png",
    caption: "Digital Marketing",
    description:
      "We will take care of complete digital marketing solutions according market requirements.",
  },
  2: {
    image: "/src/assets/images/slides/our_services.png",
    caption: "Digital Branding",
    description:
      "We will take care of complete digital branding solutions according market requirements.",
  },
  3: {
    image: "/src/assets/images/slides/our_products.png",
    caption: "Content generation",
    description:
      "We will take care of complete content generation for your website.",
  },
  /*4: {
    image: "/src/assets/images/slides/we_are_hiring_resize.png",
    caption: "SEO, SMM",
    description: "We will take care of complete SEO AND SMM of your website.",
  },
  5: {
    image: "/src/assets/images/slides/charity.jpeg",
    caption: "SEO, SMM",
    description: "We will take care of complete SEO AND SMM of your website.",
  },
  5: {
            image: '/src/assets/images/slides/04.jpeg',
            caption: 'Website design and development',
            description: 'We will take care of complete website design and development of your ideas',
        }*/
};
</script>

<style>
/*.agile {
    position: relative;
    display: block;
    min-height: 550px;
    max-width: 1550px;
}*/
.agile__nav-button {
  background: transparent;
  border: none;
  /*color: #fff;*/
  cursor: pointer;
  /*font-size: 24px;*/
  height: 100%;
  position: absolute;
  top: 0;
  transition-duration: 0.3s;
  width: 80px;
}
.agile__nav-button:hover {
  background-color: rgba(0, 0, 0, 0.5);
  opacity: 1;
}
.agile__nav-button--prev {
  left: 0;
}
.agile__nav-button--next {
  right: 0;
}

.agile__dots {
  bottom: 10px;
  left: 50%;
  position: absolute;
  transform: translateX(-50%);
}

.agile__dot {
  margin: 0 10px;
}
.agile__dot button {
  background-color: transparent;
  border: 1px solid #fff;
  border-radius: 50%;
  cursor: pointer;
  display: block;
  height: 10px;
  font-size: 0;
  line-height: 0;
  margin: 0;
  padding: 0;
  transition-duration: 0.3s;
  width: 10px;
}
.agile__dot--current button,
.agile__dot:hover button {
  background-color: #fff;
}
</style>