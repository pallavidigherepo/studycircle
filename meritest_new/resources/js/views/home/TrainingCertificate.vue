<template>
    <div>
        <base-dialog :title="'Training Certificate'" @close="$emit('close')">
            <template #default>
                <div>
                    <p>Design online certificates for your online <span class="font-italic">training</span> programs and customize them to fit your brand by using our free <span class="font-italic">certificate maker</span> and <span class="font-italic">award maker</span>.</p>
                    <p>Easily create personalized printable award certificates for any occasion. Customize the certificates online in under 1 minute 100% free!</p>
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
