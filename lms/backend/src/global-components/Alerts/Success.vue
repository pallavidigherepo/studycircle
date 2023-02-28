<template>
    <div class="alert alert-primary alert-dismissible show flex items-center mb-2" role="alert">
        <AlertOctagonIcon class="w-6 h-6 mr-2" /> {{ message }}
        <!--<button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close">
            <XIcon class="w-4 h-4" />
        </button>-->
    </div>
</template>

<script setup>
const props = defineProps({
    message: {
        type: String,
        required: false
    }
});
</script>

<style>

</style>