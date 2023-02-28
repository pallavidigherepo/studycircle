<template>
    <div class="mt-6 -mb-6 intro-y">
        <Alert :class="typeClass+ ' flex items-center mb-2'">
            <AlertCircleIcon class="w-6 h-6 mr-2" /> {{ t(message) }}
        </Alert>
    </div>
</template>

<script setup>

import {useI18n} from "vue-i18n";

const props = defineProps({
   message: {
       type: String,
       required: true,
   },
    showDismissButton: {
       default: false,
    },
    typeClass: {
       type: String,
        required: false,
        default: "alert-primary"
    }
});

const {t} = useI18n();
</script>

<style scoped>

</style>
