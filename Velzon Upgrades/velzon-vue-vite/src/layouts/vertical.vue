<script setup>
import { ref, onMounted, onBeforeUnmount, computed, watch } from 'vue';
import { useRouter } from 'vue-router';
import simplebar from 'simplebar-vue';
import { layoutComputed } from '@/state/helpers';
import { useLayoutStore } from '@/state/modules/layout'
const store = useLayoutStore()

import NavBar from '@/components/nav-bar.vue';
import Menu from '@/components/menu.vue';
import RightBar from '@/components/right-bar.vue';
import Footer from '@/components/footer.vue';
import logoDark from '@/assets/images/logo-dark.png'
import logoLight from '@/assets/images/logo-light.png'

import sidebarImg1 from '@/assets/images/sidebar/img-1.jpg'
import sidebarImg2 from '@/assets/images/sidebar/img-2.jpg'
import sidebarImg3 from '@/assets/images/sidebar/img-3.jpg'
import sidebarImg4 from '@/assets/images/sidebar/img-4.jpg'

// Reactive state
const isMenuCondensed = ref(false);
const hoverd = ref(localStorage.getItem('hoverd') === 'true');
const sidebarSize = ref('');

// Access router
const router = useRouter();

// Computed property for layout
const layout = computed(() => store.layoutType)

const sidebarColorRef = ref(document.documentElement.getAttribute('data-sidebar'));

const sidebarImageAttr = ref(document.documentElement.getAttribute('data-sidebar-image'))

onMounted(() => {
  const observer = new MutationObserver(() => {
    sidebarImageAttr.value = document.documentElement.getAttribute('data-sidebar-image')
  })
  observer.observe(document.documentElement, { attributes: true, attributeFilter: ['data-sidebar-image'] })
})

const sidebarBgImage = computed(() => {
  switch (sidebarImageAttr.value) {
    case 'img-1': return sidebarImg1
    case 'img-2': return sidebarImg2
    case 'img-3': return sidebarImg3
    case 'img-4': return sidebarImg4
    default: return null
  }
})

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

onMounted(() => {
  const observer = new MutationObserver(() => {
    sidebarColorRef.value = document.documentElement.getAttribute('data-sidebar');
  });
  observer.observe(document.documentElement, { attributes: true, attributeFilter: ['data-sidebar'] });
});

const sidebarLogo = computed(() => {
  return sidebarColorRef.value === 'dark' || sidebarColorRef.value?.includes('gradient')
    ? logoLight
    : logoDark;
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
        <div v-if="sidebarBgImage" class="sidebar-bg-image">
          <img :src="sidebarBgImage" alt="Sidebar Background" />
        </div>
        <!-- LOGO -->
       <div class="navbar-brand-box">
          <router-link to="/" class="logo">
            <span class="logo-sm">
              <img :src="sidebarLogo" alt="logo" height="22" />
            </span>
            <span class="logo-lg">
              <img :src="sidebarLogo" alt="logo" height="17" />
            </span>
          </router-link>
          <BButton size="sm" class="p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover" @click="toggleMenu">
            <i class="ri-record-circle-line"></i>
          </BButton>
        </div>
        
        <simplebar id="scrollbar" class="h-100" ref="scrollbar">
          <Menu :key="layout"></Menu>
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

<style scoped>
.sidebar-bg-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;      /* Fills the sidebar width */
  height: 100%;     /* Fills the sidebar height */
  z-index: 0;
  pointer-events: none;
  opacity: 0.15;
}

.sidebar-bg-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
</style>