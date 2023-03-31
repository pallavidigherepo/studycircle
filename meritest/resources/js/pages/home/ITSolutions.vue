<template>
    <div>
        <base-dialog :title="'IT Solutions'" @close="$emit('close')">
            <template #default>
                <div>
                    <p>We provide the responsive websites, LMS-based website &amp; Digital Marketing.</p>
                    <p>Website Design Services: Get a Custom Site Optimized for SEO and Mobile. As a full-service digital marketing agency, we also offer content marketing.</p>
                    <p>We manage Facebook, Pinterest, Twitter, Instagram, and LinkedIn.</p>
                    <router-link to="/contact-us">Contact Us</router-link>
                </div>
            </template>
        </base-dialog>
        
    </div>
</template>

<script>
import BaseDialog from '../../UI/BaseDialog.vue'

export default {
    components: {
        BaseDialog,
    },
    emits: ['close']
}
</script>
