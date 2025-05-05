<template>
  <div :style="style" ref="lavContainer"></div>
</template>

<script setup>
import { ref, defineProps, onMounted } from 'vue';
import lottie from 'lottie-web';

const props = defineProps({
  options: {
    type: Object,
    required: true,
  },
  height: {
    type: Number,
    default: 120,
  },
  width: {
    type: Number,
    default: 120,
  },
});

const style = ref({
  width: props.width ? `${props.width}px` : '100%',
  height: props.height ? `${props.height}px` : '100%',
  overflow: 'hidden',
  margin: '0 auto',
});

let anim;

onMounted(() => {
  anim = lottie.loadAnimation({
    container: document.querySelector('[ref="lavContainer"]'),
    renderer: 'svg',
    loop: props.options.loop !== false,
    autoplay: props.options.autoplay !== false,
    animationData: props.options.animationData,
    rendererSettings: props.options.rendererSettings,
  });

  
  emit('animCreated', anim);
});
</script>
