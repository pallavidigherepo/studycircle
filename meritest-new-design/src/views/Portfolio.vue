<template>
  <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
      <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
        <h5 class="fw-bold text-primary text-uppercase">Why Choose Us</h5>
        <h1 class="mb-0">We Are Here to Grow Your Business Exponentially</h1>
      </div>
      <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5 mb-5">
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
            <div class="col-lg-3  wow zoomIn portfolio-bg" data-wow-delay="0.9s">
              <h4 class="text-center">{{ project.name }}</h4>
              <p class="mb-0 text-center">{{ project.title }}</p>
              <div class="position-relative h-100" >
                <img :alt="project.name" class="position-absolute w-100 rounded wow zoomIn" data-wow-delay="0.1s" src="@/assets/img/feature.jpg" style="object-fit: cover;">
              </div>
            </div>
          </template>

        </template>
      </div>
    </div>
  </div>
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
    },
    {
      name: 'Healthy Life Aid',
      category: ['website', 'seo', 'smm'],
      title: 'Healthy Life Aid',
      cover: '',
    },
    {
      name: 'Sales Zoomer',
      category: ['website', 'seo'],
      title: 'Sales Zoomer',
      cover: '',
    },
    {
      name: 'Manasparsh: Mind Wellness',
      category: ['website', 'seo', 'smm'],
      title: 'Manasparsh, Mind Wellness Clinic',
      cover: '',
    },
    {
      name: 'Manasparsh: Dental Wellness',
      category: ['website', 'seo', 'smm'],
      title: 'Manasparsh, Dental Wellness Clinic',
      cover: '',
    },
    {
      name: 'Goswami Dairy',
      category: ['smm'],
      title: 'Goswami Dairy',
      cover: '',
    }
];

function filter(category) {
  currentCategory.value = category;
}
</script>

<style scoped>

</style>