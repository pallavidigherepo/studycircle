<template>
  <!-- Vendor Start -->
  <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5 mb-5">
      <div class="bg-white">
        <div class="owl-carousel vendor-carousel">
          <img src="@/assets/img/vendor-1.jpg" alt="">
          <img src="@/assets/img/vendor-2.jpg" alt="">
          <img src="@/assets/img/vendor-3.jpg" alt="">
          <img src="@/assets/img/vendor-4.jpg" alt="">
          <img src="@/assets/img/vendor-5.jpg" alt="">
          <img src="@/assets/img/vendor-6.jpg" alt="">
          <img src="@/assets/img/vendor-7.jpg" alt="">
          <img src="@/assets/img/vendor-8.jpg" alt="">
          <img src="@/assets/img/vendor-9.jpg" alt="">
        </div>
      </div>
    </div>
  </div>
  <!-- Vendor End -->
</template>

<script setup>
import {onMounted} from "vue";
onMounted(() => {
  vendors();
});
const vendors = () => {
  // Vendor carousel
  jQuery('.vendor-carousel').owlCarousel({
    loop: true,
    margin: 45,
    dots: false,
    autoplay: true,
    smartSpeed: 1000,
    responsive: {
      0:{
        items:2
      },
      576:{
        items:4
      },
      768:{
        items:6
      },
      992:{
        items:8
      }
    }
  });
}
</script>

<style scoped>

</style>