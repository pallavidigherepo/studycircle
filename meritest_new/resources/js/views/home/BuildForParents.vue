<template>
    <div>
        <base-dialog :title="'Build for parents'" @close="$emit('close')">
            <template #default>
                <div>
                    <h5 class="text-blue">Boost your child’s learning by using Meritest educational apps.</h5>
                    <h6 class="text-org">Support your child's learning at home.</h6>
                    <p>In a world of distractions, it’s hard for parents to be sure that their Child’s are focusing on the right kind of fun – something age appropriate, for example! While it’s great to let your child explore, why not let it happen over a slightly controlled environment?</p>
                    <p>‘Control’ doesn’t necessarily negate fun anymore, after all. Just look at Meritest to prove that. Its content for students is as varied as it is vast, and we think it’s an interesting take on student’s education in a digital world.</p>
                    <h5 class="text-org">How it helps you</h5>
                    <ul class="ml-15 list-group">
                        <li>View your kid’s progress through real-time reports.</li>
                        <li>Get online classroom resources (Like Homework Assignment) and links. </li>
                        <li>Quiz or testing tools can help you monitor your Child’s lacking’s and improvements. Through this, you can help bridge the gap in their learnings.</li>
                        <li>Regular tests/quizzes and other assessment tools can also give you a real-time indicator of your child’s progress and comprehension level with Other Student’s. </li>
                        <li>Therefore, using these relevant quiz/testing tools is a high-value resource. This will ensure that your child will have the highest level of education at home or in any other setting.</li>
                        <li>You can also get answer sheets, alternative versions of tests, and export them as Word or PDFs. It has Free, Plus, and Premium plans.</li>
                        <li>We highly recommend that you use these tools. </li>
                    </ul>
                    <h5 class="text-org">Benefits with Meritest.in</h5>
                    <ul class="ml-15 list-group">
                        <li>View your kid(s) progress cognitively 😉</li>
                        <li>PTM : Regular online parents Teachers Meeting using Meritest statistical reports using finest AI algorithms.</li>
                        <li>Parental Zone: A first of its kind, the Parent Zone will help you supervise your Child’s activities on the Meritest. You can also create a separate profile for each Child for a personalized experience. This is one report card you can’t miss!</li>
                        <li>Ad-Free Safe Environment: Meritest is an ad-free, safe and secure environment.</li>
                        <li>Child’s PROFILES: Create and manage kid(s) your profiles, each with their own viewing preferences, recommendations, and settings.</li>
                        <li>Watch on Any Device: Enjoy Meritest App on your mobile, tablet &amp; television.</li>

                    </ul>
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


<style scoped>
.list-group li {
    list-style: disclosure-closed;
}

.bullets-li {
    list-style-type: style disc;
}
</style>