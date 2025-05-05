<script setup>
import { useLayoutStore } from '@/state/modules/layout.js';

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
