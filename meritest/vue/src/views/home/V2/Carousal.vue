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
          <!-- <div class="carousel-caption d-none d-md-block">
            <h5 class="text-cetre">{{ slide.caption }}</h5>
            <p>{{ slide.description }}</p>
          </div> -->
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
    image: "/src/assets/images/slides/1 (1600 × 550 px).png",
    caption: "Digital Marketing",
    description:
      "We will take care of complete digital marketing solutions according market requirements.",
  },
  2: {
    image: "/src/assets/images/slides/2 (1600 × 550 px).png",
    caption: "Digital Branding",
    description:
      "We will take care of complete digital branding solutions according market requirements.",
  },
  3: {
    image: "/src/assets/images/slides/3 (1600 × 550 px).png",
    caption: "Content generation",
    description:
      "We will take care of complete content generation for your website.",
  },/**/
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

<style scoped>
.image img {
  filter: none;
  width: 100%;
  /*height: 500px;
  */
}
.carousel-control{
  color: #057fd7;
}
.carousel-control, .carousel-control:focus {
  color: #da380d;
}

.carousel-indicators .active {
  background-color: #656566;
}
.carousel-indicators li {
  border: 1px solid #656566;
}
</style>