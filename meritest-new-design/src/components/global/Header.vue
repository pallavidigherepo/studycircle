<template>
  <!-- Topbar Start -->
  <div class="container-fluid bg-dark px-5 d-none d-lg-block">
    <div class="row gx-0">
      <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
        <div class="d-inline-flex align-items-center" style="height: 45px;">
          <small class="me-3 text-light"><i class="fa fa-map-marker-alt me-2"></i>Wathoda Layout, Nagpur, INDIA</small>
          <small class="me-3 text-light"><i class="fa fa-phone-alt me-2"></i>+91 762 009 8848</small>
          <small class="text-light"><i class="fa fa-envelope-open me-2"></i>info@meritest.in</small>
        </div>
      </div>
      <div class="col-lg-4 text-center text-lg-end">
        <div class="d-inline-flex align-items-center" style="height: 45px;">
          <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="https://twitter.com/meritestdotin" target="_blank"><i class="fab fa-twitter fw-normal"></i></a>
          <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="https://www.facebook.com/meritestdotin" target="_blank"><i class="fab fa-facebook-f fw-normal"></i></a>
          <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="https://www.linkedin.com/company/meritestdotin" target="_blank"><i class="fab fa-linkedin-in fw-normal"></i></a>
          <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="#" target="_blank"><i class="fab fa-instagram fw-normal"></i></a>
          <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href="https://www.youtube.com/channel/UC2jXBWiTxsr-KQlBexxPvXA" target="_blank"><i class="fab fa-youtube fw-normal"></i></a>
        </div>
      </div>
    </div>
  </div>
  <!-- Topbar End -->

  <!-- Navbar & Carousel Start -->
  <div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
      <router-link to="/" class="navbar-brand p-0">
        <h1 class="m-0">
          <img alt="Meritest Solutions Pvt. Ltd." width="150" src="/src/assets/img/logo/logo.png" />
        </h1>
      </router-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
          <router-link to="/" class="nav-item nav-link">Home</router-link>
          <router-link to="/about" class="nav-item nav-link">About</router-link>
          <router-link to="/portfolio" class="nav-item nav-link">Portfolio</router-link>
          <router-link to="/services" class="nav-item nav-link">Services</router-link>
          <a href="https://www.meritest.in/blogs" target="_blank" class="nav-item nav-link">Blogs</a>
          <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Company</a>
            <div class="dropdown-menu m-0">
              <router-link to="/our-products" class="dropdown-item">Our Products</router-link>
              <router-link to="/our-team" class="dropdown-item">Our Team</router-link>
              <router-link to="/career" class="dropdown-item">Career</router-link>
            </div>
          </div>
          <router-link to="/contact" class="nav-item nav-link">Contact</router-link>
        </div>
        <button type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></button>
      </div>
    </nav>

    <div v-if="showCarousal" id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="w-100" src="/src/assets/img/carousel-1.jpg" alt="Image">
          <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
            <div class="p-3" style="max-width: 900px;">
              <h5 class="text-white text-uppercase mb-3 animated slideInDown">Creative & Innovative</h5>
              <h1 class="display-1 text-white mb-md-4 animated zoomIn">Creative & Innovative Digital Solution</h1>
              <a href="#" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Free Quote</a>
              <router-link to="/contact" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Contact Us</router-link>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img class="w-100" src="/src/assets/img/carousel-2.jpg" alt="Image">
          <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
            <div class="p-3" style="max-width: 900px;">
              <h5 class="text-white text-uppercase mb-3 animated slideInDown">Creative & Innovative</h5>
              <h1 class="display-1 text-white mb-md-4 animated zoomIn">Creative & Innovative Digital Solution</h1>
              <a href="#" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Free Quote</a>
              <router-link to="/contact" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Contact Us</router-link>
            </div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
              data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
              data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <div v-else class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
      <div class="row py-5">
        <div class="col-12 pt-lg-5 mt-lg-5 text-center">
          <h1 class="display-4 text-white animated zoomIn">{{ route.name }}</h1>
          <router-link to="/" class="h5 text-white">Home</router-link>
          <i class="far fa-circle text-white px-2"></i>
          <router-link :to="{name: route.name}" class="h5 text-white">{{ route.name }}</router-link>
        </div>
      </div>
    </div>
  </div>
  <!-- Navbar & Carousel End -->

  <!-- Full Screen Search Start -->
  <div class="modal fade" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
        <div class="modal-header border-0">
          <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex align-items-center justify-content-center">
          <div class="input-group" style="max-width: 600px;">
            <input type="text" class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword">
            <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Full Screen Search End -->
</template>
<script setup>

import { ref, onMounted, watch } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();
const showCarousal = ref(false);

onMounted(() => {
  showCarousal.value = route.name === "Home";
  stickyNavBar();
});
watch(
    () => route.name,
    (to, from) => {
      showCarousal.value = to === "Home";
    }
);

// Sticky Navbar
const stickyNavBar = () => {
  jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > 45) {
      jQuery('.navbar').addClass('sticky-top shadow-sm');
    } else {
      jQuery('.navbar').removeClass('sticky-top shadow-sm');
    }
  });
}

</script>
