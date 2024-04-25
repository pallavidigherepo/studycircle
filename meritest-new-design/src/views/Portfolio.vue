<template>
  <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
      <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
        <h5 class="fw-bold text-primary text-uppercase">Why Choose Us</h5>
        <h1 class="mb-0">We Are Here to Grow Your Business Exponentially</h1>
      </div>
      <div class="container-fluid py-1 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-1 mb-5">
          <div class="bg-white">
            <div class="text-center">
              <template v-for="(category, index) in categories" :key="index">
                <a href="#" class="btn m-2" @click.prevent="filter(category.value)" :class="{ 'btn-primary': currentCategory === category.value }">{{ category.name }}</a>
              </template>
            </div>
          </div>
        </div>
      </div>
      <div class="row g-5">
        <template v-for="(project, index) in projects" :key="index">
          <template v-if="currentCategory === 'all' || project.category.includes(currentCategory)">
            <div class="col-lg-3  wow zoomIn portfolio-bg" data-wow-delay="0.9s" :id="project.id">
              <h4 class="text-center">{{ project.name }}</h4>
              <p class="mb-0 text-center">{{ project.title }}</p>
              <div class="position-relative h-100" >
                <a href="#" @click.prevent="showPortfolio(project.id)" data-bs-toggle="modal" data-bs-target="#portfolioModal">
                  <img :alt="project.name" class="position-absolute w-100 rounded wow zoomIn" data-wow-delay="0.1s" src="@/assets/img/feature.jpg" style="object-fit: cover;">
                </a>
              </div>
            </div>
          </template>

        </template>
      </div>
    </div>
  </div>
  <!-- Full Screen Search Start -->
  <div class="modal fade" id="portfolioModal" tabindex="-1">
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
import { ref } from 'vue';

const currentCategory = ref('all');

const categories = [
  {
    name: 'All',
    value: 'all',
  },
  {
    name: 'Website Developed',
    value: 'website'
  },
  {
    name: 'SEO',
    value: 'seo'
  },
  {
    name: 'SMM',
    value: 'smm'
  }
];

const projects = [
    {
      name: 'ERA Sumthana',
      category: ['website', 'seo', 'smm'],
      title: 'ERA Sumthana Nagpur',
      cover: '',
      id: 'era',
    },
    {
      name: 'Healthy Life Aid',
      category: ['website', 'seo', 'smm'],
      title: 'Healthy Life Aid',
      cover: '',
      id: 'hla'
    },
    {
      name: 'Sales Zoomer',
      category: ['website', 'seo'],
      title: 'Sales Zoomer',
      cover: '',
      id: 'sz'
    },
    {
      name: 'Manasparsh: Mind Wellness',
      category: ['website', 'seo', 'smm'],
      title: 'Manasparsh, Mind Wellness Clinic',
      cover: '',
      id: 'mmw'
    },
    {
      name: 'Manasparsh: Dental Wellness',
      category: ['website', 'seo', 'smm'],
      title: 'Manasparsh, Dental Wellness Clinic',
      cover: '',
      id: 'mdw'
    },
    {
      name: 'Goswami Dairy',
      category: ['smm'],
      title: 'Goswami Dairy',
      cover: '',
      id: 'gd'
    }
];

function filter(category) {
  currentCategory.value = category;
}
const showPortfolioModal = ref(false);
function showPortfolio(projectId) {
  showPortfolioModal.value = true;
  alert(projectId)
}
</script>

<style scoped>

</style>