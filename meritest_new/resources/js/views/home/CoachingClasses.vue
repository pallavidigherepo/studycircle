<template>
    <div>
        <base-dialog :title="'Coaching classes'" @close="$emit('close')">
            <template #default>
                <div>
                    <p>Within a Minute Easily create competitive entrance online tests/exams for your Coaching class.</p>
                    <p>Create online test For Engineering and Medical entrance exam like IIT-JEE Main, JEE Advanced, KIIT, BITSAT, KCET, UPESEAT, GUJCET, VITEEE, SRMJEEE, AP EAMCET, KIITEE, WBJEE, MHTCET, BCECE, RPET/REAP,NTA NEET UG, NEET PG, AIIMS UG, AIIMS PG, AIMS CET, AIPVT, AMU CAT, AMUPMDC, AU MEE, BHU PMT, JIPMER, AFMC, ,BVU CET , CEE Kerala, CET Karnataka, CET Punjab, CMC Vellore, DMER, DUMET, EAMCET, GGSIPU CET, HPCPMT, SRMC, COMEDK, MET, Gate, NATA, KVPY, IISc, IISER, IIST. </p>
                    <p>Government competitive entrance exam test Series also Available 
Our online exam software provides stable stage for examiners to make and arrange various types of  subjective and objective tests/exams for your Coaching Classes Class 8, Class 9, Class 10, Class 11 &amp; Class 12 as per latest board pattern.</p>
                    <p><router-link to="/contact-us">Contact us Now</router-link></p>
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
