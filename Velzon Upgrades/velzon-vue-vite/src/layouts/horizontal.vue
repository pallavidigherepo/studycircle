<script setup>
import NavBar from "@/components/nav-bar.vue";
import RightBar from "@/components/right-bar.vue";
import Footer from "@/components/footer.vue";
import HorizontalMenu from "@/components/HorizontalMenu.vue";
import { watch, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { BContainer, BRow, BCol } from 'bootstrap-vue-next';
import { useLayoutStore } from "@/state/modules/layout.js";

const route = useRoute();

const initActiveMenu = (ele) => {
  setTimeout(() => {
    if (document.querySelector("#navbar-nav")) {
      let a = document
        .querySelector("#navbar-nav")
        .querySelector('[href="' + ele + '"]');

      if (a) {
        a.classList.add("active");
        let parentCollapseDiv = a.closest(".collapse.menu-dropdown");
        if (parentCollapseDiv) {
          parentCollapseDiv.classList.add("show");
          parentCollapseDiv.parentElement.children[0].classList.add(
            "active"
          );
          parentCollapseDiv.parentElement.children[0].setAttribute(
            "aria-expanded",
            "true"
          );
          if (
            parentCollapseDiv.parentElement.closest(
              ".collapse.menu-dropdown"
            )
          ) {
            parentCollapseDiv.parentElement
              .closest(".collapse")
              .classList.add("show");
            if (
              parentCollapseDiv.parentElement.closest(".collapse")
                .previousElementSibling
            )
              parentCollapseDiv.parentElement
                .closest(".collapse")
                .previousElementSibling.classList.add("active");
          }
        }
      }
    }
  }, 1000);
};

const onRoutechange = (ele) => {
  initActiveMenu(ele.path);
};

watch(
  () => route,
  (newRoute) => {
    onRoutechange(newRoute);
  },
  { immediate: true, deep: true }
);

onMounted(() => {
  if (document.querySelectorAll(".navbar-nav .collapse")) {
    let collapses = document.querySelectorAll(".navbar-nav .collapse");
    collapses.forEach((collapse) => {
      // Hide sibling collapses on `show.bs.collapse`
      collapse.addEventListener("show.bs.collapse", (e) => {
        e.stopPropagation();
        let closestCollapse = collapse.parentElement.closest(".collapse");
        if (closestCollapse) {
          let siblingCollapses =
            closestCollapse.querySelectorAll(".collapse");
          siblingCollapses.forEach((siblingCollapse) => {
            if (siblingCollapse.classList.contains("show")) {
              siblingCollapse.classList.remove("show");
              siblingCollapse.parentElement.firstChild.setAttribute("aria-expanded", "false");
            }
          });
        } else {
          let getSiblings = (elem) => {
            // Setup siblings array and get the first sibling
            let siblings = [];
            let sibling = elem.parentNode.firstChild;
            // Loop through each sibling and push to the array
            while (sibling) {
              if (sibling.nodeType === 1 && sibling !== elem) {
                siblings.push(sibling);
              }
              sibling = sibling.nextSibling;
            }
            return siblings;
          };
          let siblings = getSiblings(collapse.parentElement);
          siblings.forEach((item) => {
            if (item.childNodes.length > 2) {
              item.firstElementChild.setAttribute("aria-expanded", "false");
              item.firstElementChild.classList.remove("active");
            }
            let ids = item.querySelectorAll("*[id]");
            ids.forEach((item1) => {
              item1.classList.remove("show");
              item1.parentElement.firstChild.setAttribute("aria-expanded", "false");
              item1.parentElement.firstChild.classList.remove("active");
              if (item1.childNodes.length > 2) {
                let val = item1.querySelectorAll("ul li a");
                val.forEach((subitem) => {
                  if (subitem.hasAttribute("aria-expanded"))
                    subitem.setAttribute("aria-expanded", "false");
                });
              }
            });
          });
        }
      });
      // Hide nested collapses on `hide.bs.collapse`
      collapse.addEventListener("hide.bs.collapse", (e) => {
        e.stopPropagation();
        let childCollapses = collapse.querySelectorAll(".collapse");
        childCollapses.forEach((childCollapse) => {
          let childCollapseInstance = childCollapse;
          childCollapseInstance.classList.remove("show");
          childCollapseInstance.parentElement.firstChild.setAttribute("aria-expanded", "false");
        });
      });
    });
  }
});
</script>

<template>
  <div>
    <div id="layout-wrapper">
      <NavBar />
      <HorizontalMenu v-if="layoutType === 'horizontal'"/>
      <!-- ========== App Menu ========== -->
      
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
  </div>
</template>