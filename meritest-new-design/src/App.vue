<template>
  <!-- Spinner Start -->
  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner"></div>
  </div>
  <!-- Spinner End -->
  <Header></Header>
  <router-view></router-view>
  <Testimonial />
  <Vendor />
  <Footer></Footer>
</template>

<script setup>
import Header from "./components/global/Header.vue";
import Footer from "./components/global/Footer.vue";

import {onMounted} from "vue";
import Testimonial from "@/components/home/Testimonial.vue";
import Vendor from "@/components/home/Vendor.vue";

onMounted(() => {
  spinner();
  matchMediaCall();
});
// Spinner
var spinner = function () {
  setTimeout(function () {
    if (jQuery('#spinner').length > 0) {
      jQuery('#spinner').removeClass('show');
    }
  }, 500);
};

const matchMediaCall = () => {
  // Dropdown on mouse hover
  const $dropdown = jQuery(".dropdown");
  const $dropdownToggle = jQuery(".dropdown-toggle");
  const $dropdownMenu = jQuery(".dropdown-menu");
  const showClass = "show";

  jQuery(window).on("load resize", function() {
    if (this.matchMedia("(min-width: 992px)").matches) {
      $dropdown.hover(
          function() {
            const $this = jQuery(this);
            $this.addClass(showClass);
            $this.find($dropdownToggle).attr("aria-expanded", "true");
            $this.find($dropdownMenu).addClass(showClass);
          },
          function() {
            const $this = jQuery(this);
            $this.removeClass(showClass);
            $this.find($dropdownToggle).attr("aria-expanded", "false");
            $this.find($dropdownMenu).removeClass(showClass);
          }
      );
    } else {
      $dropdown.off("mouseenter mouseleave");
    }
  });
}

</script>
