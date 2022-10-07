<template>
    <div>
        <base-dialog :title="'School and Olympiads'" @close="$emit('close')">
            <template #default>
                <div>
                    <h4>Create</h4>
                    <p>Quickly create great looking subjective/objective tests using multiple question types and formatting options.</p>
                    <h4>Publish</h4>
                    <p>Tests can either be published privately to a select group or open them up to everyone with a single link and registration page.</p>
                    <h4>Analyze</h4>
                    <p>Meritest instantly marks and grades your tests. Powerful analytical reports then allow you to perform in-depth analysis across all responses.</p>
                    <p><strong>Our online exam software provides stable stage for examiners to make and arrange various types of  subjective and objective tests/exams for Olympiads and School Classes Class 8, Class 9, Class 10, Class 11 &amp; Class 12 as per latest board pattern.</strong></p>
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
