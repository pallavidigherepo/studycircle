<template>
    <div>
        <div class="backdrop" @click="$emit('close')"></div>
        <dialog open class="dialog">
            <header>
                
                <slot name="header">
                    <h2>{{ title }}</h2>
                </slot>
                <a href="javascript:;" @click="$emit('close')" class="text-right ">
                     <div class="icon closeIcon">
                        <i class="fa fa-close"></i>
                    </div>
                </a>
            </header>
            <section>
                <slot></slot>
            </section>
        </dialog>
    </div>
</template>

<script>
export default {
    emits: ['close'],
    props: {
        title: {
            type: String,
            required: false,
            default: "Title here",
        }
    }
}
</script>

<style scoped>

</style>