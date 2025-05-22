<template>
  <div @dragenter.prevent="toggleActive" @dragleave.prevent="toggleActive" @dragover.prevent
    @drop.prevent="toggleActive" :class="{ 'active-dropzone': active }" class="dropzone position-relative">
    <label for="dropzoneFile" class="stretched-link">Drag and Drop your files or Browse</label>
    <input type="file" id="dropzoneFile" class="dropzoneFile btn btn-primary" />
  </div>
</template>


<script setup>
import { ref } from 'vue';

const active = ref(false);

const toggleActive = () => {
  active.value = !active.value;
};
</script>
