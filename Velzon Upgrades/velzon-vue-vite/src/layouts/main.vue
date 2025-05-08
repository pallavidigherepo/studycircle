<script setup>
import { useLayoutStore } from '@/state/modules/layout.js';
import Vertical from '@/layouts/vertical.vue';  // Correct import path
import Horizontal from '@/layouts/horizontal.vue';
import TwoColumns from '@/layouts/twocolumn.vue';
const layoutStore = useLayoutStore();
</script>

<template>
  <div>
    <Vertical
      v-if="layoutStore.layoutType === 'vertical' || layoutStore.layoutType === 'semibox'"
      :layout="layoutStore.layoutType"
    >
      <slot />
    </Vertical>

    <Horizontal
      v-if="layoutStore.layoutType === 'horizontal'"
      :layout="layoutStore.layoutType"
    >
      <slot />
    </Horizontal>

    <TwoColumns
      v-if="layoutStore.layoutType === 'twocolumn'"
      :layout="layoutStore.layoutType"
    >
      <slot />
    </TwoColumns>
  </div>
</template>
