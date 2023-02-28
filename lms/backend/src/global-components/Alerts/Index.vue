<template>
<!--    <Alert class="alert-primary-soft mb-2">
        <div class="flex items-center">
            <div class="font-medium text-lg">
                Awesome alert with additional info
            </div>
            <div class="text-xs bg-white px-1 rounded-md text-slate-700 ml-auto">
                New
            </div>
        </div>
        <div class="mt-3">
            Lorem Ipsum is simply dummy text of the printing and
            typesetting industry. Lorem Ipsum has been the industry's
            standard dummy text ever since the 1500s.
        </div>
    </Alert>-->
    <div class="alert alert-dismissible show flex items-center mb-2" role="alert"
        :class="status? 'alert-primary' : 'alert-danger'">
        <AlertOctagonIcon class="w-10 h-10 mr-2" />{{ message }}
        <template v-if="errors">
            <div v-for="(error, index) in errors" :key="index" class="intro-y w-full">

                <span v-for="(val, idx) in error.values">
                    <template v-if="idx == error.attribute">
                        ({{ val }})&nbsp;
                    </template>
                </span>
                {{ error.errors[index] }}
            </div>
        </template>
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
    },
    status: {
        type: Boolean,
        required: false
    },
    errors: {
        type: [Array, Object],
        required: false,
    }
});
</script>

<style>

</style>
