<template>
    <div>
        <base-dialog :title="'Educational Institutions'" @close="$emit('close')">
            <template #default>
                <div>
                    <p>
                        Easily Conduct online entrance exam for engineering, medical and management courses.
                    </p>
                    <p>
                    Superfast Create online entrance exam JEE main, JEE Advanced, NEET, CMAT.
                    These included CAT, JMET, XAT, Gitam SAT, NMAT, SNAP, MAT, state-specific exams.
                    Easy to create state wise other CET exams also.
                    <router-link to="/contact-us">Contact us Now</router-link></p>
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
