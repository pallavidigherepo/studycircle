<template>
    <div>
        <div class="backdrop"></div>
        <dialog open>
            <LoadingIcon :icon="'puff'" />
        </dialog>
    </div>
    
</template>

<script setup>

</script>

<style scoped>
div.backdrop {
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100%;
  background-color: #656566;
  z-index: 50;
}

dialog {
  position: fixed;
  top: 40vh;
  left: 10%;
  width: 80%;
  z-index: 100;
  border-radius: 12px;
  border: none;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26);
  padding: 0;
  margin: 0;
  overflow: hidden;
}


@media (min-width: 768px) {
  dialog {
    left: calc(70% - 20rem);
    width: 3rem;
  }
}
</style>