<template>
    <div class="mt-6 -mb-6 intro-y">
        <Alert :class="typeClass+ ' flex items-center mb-2'">
            <AlertCircleIcon class="w-6 h-6 mr-2" /> <strong>{{ t(message) }} <router-link v-if="goto" :to="goto">{{ gotoLabel }}</router-link></strong>
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
    },
    goto: {
        type: String,
        required: false,
    },
    gotoLabel: {
       type: String,
        required: false
    }
});

const {t} = useI18n();
</script>

<style scoped>

</style>
