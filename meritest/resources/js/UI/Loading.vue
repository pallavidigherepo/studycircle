<template>
    <div>
        <div class="backdrop"></div>
        <dialog open class="dialog">
            {{ message }}
        </dialog>
    </div>
</template>

<script>
export default {
    props: {
        message: {
            type: String,
            required: false,
            default: 'Please wait, while we are sending request.'
        }
    }
}
</script>

<style scoped>
.dialog {
    padding: 10px;
    text-align: center;
}
</style>