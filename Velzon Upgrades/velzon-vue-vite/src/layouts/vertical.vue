<script setup>
import { ref, onMounted, onBeforeUnmount, computed, watch } from 'vue';
import { useRouter } from 'vue-router';
import simplebar from 'simplebar-vue';
import { layoutComputed } from '@/state/helpers';

import NavBar from '@/components/nav-bar.vue';
import Menu from '@/components/menu.vue';
import RightBar from '@/components/right-bar.vue';
import Footer from '@/components/footer.vue';

// Reactive state
const isMenuCondensed = ref(false);
const hoverd = ref(localStorage.getItem('hoverd') === 'true');
const sidebarSize = ref('');

// Access router
const router = useRouter();

// Computed property for layout
const layout = computed(() => layoutComputed);

// Method to update the sidebar size
const updateSidebarSize = () => {
  if (window.innerWidth < 1025) {
    sidebarSize.value = 'sm';
    document.documentElement.setAttribute('data-sidebar-size', 'sm');
  } else {
    sidebarSize.value = 'lg';
    document.documentElement.setAttribute('data-sidebar-size', 'lg');
  }
};

// Initialize the active menu and toggle hover state
const initActiveMenu = () => {
  if (document.documentElement.getAttribute('data-sidebar-size') === 'sm-hover') {
    hoverd.value = true;
    localStorage.setItem('hoverd', 'true');
    document.documentElement.setAttribute('data-sidebar-size', 'sm-hover-active');
  } else if (document.documentElement.getAttribute('data-sidebar-size') === 'sm-hover-active') {
    hoverd.value = false;
    localStorage.setItem('hoverd', 'false');
    document.documentElement.setAttribute('data-sidebar-size', 'sm-hover');
  } else {
    document.documentElement.setAttribute('data-sidebar-size', 'sm-hover');
  }
};

// Toggle the menu
const toggleMenu = () => {
  document.body.classList.toggle('sidebar-enable');
  if (window.screen.width >= 992) {
    router.afterEach(() => {
      document.body.classList.remove('sidebar-enable');
      document.body.classList.remove('vertical-collpsed');
    });
    document.body.classList.toggle('vertical-collpsed');
  } else {
    router.afterEach(() => {
      document.body.classList.remove('sidebar-enable');
    });
    document.body.classList.remove('vertical-collpsed');
  }
  isMenuCondensed.value = !isMenuCondensed.value;
};

// Toggle right sidebar
const toggleRightSidebar = () => {
  document.body.classList.toggle('right-bar-enabled');
};

// Hide right sidebar
const hideRightSidebar = () => {
  document.body.classList.remove('right-bar-enabled');
};

// On mounted, initialize settings
onMounted(() => {
  if (hoverd.value) {
    document.documentElement.setAttribute('data-sidebar-size', 'sm-hover-active');
  }
  document.getElementById('overlay').addEventListener('click', () => {
    document.body.classList.remove('vertical-sidebar-enable');
  });

  if (window.screen.width < 1025) {
    document.documentElement.setAttribute('data-sidebar-size', 'sm');
  }

  window.addEventListener('resize', () => {
    document.body.classList.remove('vertical-sidebar-enable');
    document.querySelector('.hamburger-icon').classList.add('open');
    updateSidebarSize();
  });
});

// Cleanup on unmounted
onBeforeUnmount(() => {
  window.removeEventListener('resize', updateSidebarSize);
});
</script>

  
<template>
  <div id="layout-wrapper">
    <NavBar />
    <div>
      <!-- ========== Left Sidebar Start ========== -->
      <!-- ========== App Menu ========== -->
      <div class="app-menu navbar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box">
          <!-- Dark Logo-->
          <router-link to="/" class="logo logo-dark">
            <span class="logo-sm">
              <img src="@/assets/images/logo-sm.png" alt="" height="22" />
            </span>
            <span class="logo-lg">
              <img src="@/assets/images/logo-dark.png" alt="" height="17" />
            </span>
          </router-link>
          <!-- Light Logo-->
          <router-link to="/" class="logo logo-light">
            <span class="logo-sm">
              <img src="@/assets/images/logo-sm.png" alt="" height="22" />
            </span>
            <span class="logo-lg">
              <img src="@/assets/images/logo-light.png" alt="" height="17" />
            </span>
          </router-link>
          <BButton size="sm" class="p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover" @click="initActiveMenu">
            <i class="ri-record-circle-line"></i>
          </BButton>
        </div>

            
        <simplebar id="scrollbar" class="h-100" ref="scrollbar">
          <Menu></Menu>
        </simplebar>
        <div class="sidebar-background"></div>
      </div>
      <!-- Left Sidebar End -->
      <!-- Vertical Overlay-->
      <div class="vertical-overlay" id="overlay"></div>
    </div>
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="main-content">
      <div class="page-content">
        <!-- Start Content-->
        <BContainer fluid>
          <slot />
        </BContainer>
      </div>
      <Footer />
    </div>
    <RightBar />
  </div>
</template>