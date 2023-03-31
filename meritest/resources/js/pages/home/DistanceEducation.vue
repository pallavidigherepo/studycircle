<template>
    <div>
        <base-dialog :title="'Distance education'" @close="$emit('close')">
            <template #default>
                <div>
                    <h4>Create</h4>
                    <p>Quickly create great looking subjective/objective tests using multiple question types and formatting options.</p>
                    <h4>Publish</h4>
                    <p>Tests can either be published privately to a select group or open them up to everyone with a single link and registration page.</p>
                    <h4>Analyze</h4>
                    <p>Meritest instantly marks and grades your tests. Powerful analytical reports then allow you to perform in-depth analysis across all responses.</p>
                    <p><strong>Our online exam software provides stable stage for examiners to make and arrange various types of tests/exams for Distance Education like IGNOU, Symbiosis Distance Learning, Anna University Distance, Distance Learning MBA, Annamalai University.</strong></p>
                    <p>We also provide Practice Paper for</p>
                    <div>
                        <ul>
                            <li><p><strong>TOEFL – The Test of English as a Foreign Language.</strong></p></li>
                            <li><p><strong>IELTS – International English Language Testing System.</strong></p></li>
                            <li><p><strong>PTE – Pearson Test of English.</strong></p></li>
                            <li><p><strong>SAT – Scholastic Assessment Test.</strong></p></li>
                            <li><p><strong>ACT – American College Testing.</strong></p></li>
                            <li><p><strong>GRE – Graduate Record Examinations.</strong></p></li>
                        </ul>
                    </div>
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
