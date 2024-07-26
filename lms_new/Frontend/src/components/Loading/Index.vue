<script setup lang="ts">
/**
 * 
 */
 import LoadingIcon from "@/components/Base/LoadingIcon";
</script>

<style scoped>
div.backdrop {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: #656566;
  z-index: 50;
  opacity: 0.5;
}

dialog {
  position: fixed;
  top: 35vh;
  align-content: center;
  left: 345px;
  /* left: 10%; */
  /* width: 80%; */
  z-index: 100;
  border-radius: 12px;
  border: none;
  box-shadow: 0 2px 8px #656566;
  padding: 0;
  margin: 0;
  overflow: hidden;
}


@media (min-width: 360px) {
  dialog {
    left: calc(100% - 12rem);
    width: 3rem;
  }
}

@media (min-width: 415px) {
  dialog {
    left: calc(70% - 12rem);
    width: 3rem;
  }
}
/* @media (min-width: 950px) {
  dialog {
    left: calc(100% - 20rem);
    width: 3rem;
  }
} */
</style>
<template>
    <div>
        <div class="backdrop"></div>
        <dialog open>
          <LoadingIcon icon="puff" class="w-8 h-8" />
        </dialog>
    </div>
    
</template>