<template>
    <div>
        <base-dialog :title="'Build for students'" @close="$emit('close')">
            <template #default>
                <div>
                    <h5>Boost your exam preparation with Practice Test, Test Series for Banking, SSC, RRB &amp; All other Govt. Exams</h5>
                    <h6 class="text-blue">90% of students who use Meritest report higher grades.😊 #Search, Select &amp; Submit</h6>
                    <p>(Meritest explanations show you step-by-step approaches to solve tough problems. Find solutions in different subjects as per your need and fully verified by Meritest Experts.)</p>
                    <h5 class="text-org">How it works</h5>
                    <ul class="ml-15 list-group">
                        <li>Search Test</li>
                        <li>View Result </li>
                        <li>Huge Collections of Tests </li>
                        <li>Feedback/Comments on Tests </li>
                        <li>Forum Support &amp; Interactives Doubt Discussion on Forum with teachers</li>
                    </ul>
                    <p>Students can set up the basic guidelines of the exam, select the various type of questions (Chapterwise, Topicwise), time management, automatic result evaluations, reports for analyzing, and many more features</p>
                    <ul class="ml-15 list-group">
                        <li>Select different type of questions (Chapterwise, Topicwise) &amp; practice, Anywhere anytime.</li>
                        <li>Instant Result Evaluation</li>
                        <li>The questions can also set up according to the difficultly well and concerning its difficulty level, the result of the students will be evaluated.</li>
                        <li>If the student wishes to conduct a test topic-wise of a particular subject then it can also be affected in the online examination software. <strong>Question Bank management</strong> can also be done in the online examination systems, with all the most important questions can be added and with good reports of software, schools can share the same in well in advance of the examination.</li>
                        <li>The results in the assessments are the most significant for students’ future and career. So in online exams also results in evaluation are done automatically, as soon as the tests are submitted by the students in the allotted time-frame the <strong>software automatically shows the results</strong> by calculating negative marks, showing a review of each question, also shows the correct answers and tips. With all these outstanding features the <strong>teacher’s workload reduces</strong> to a great extent and they can even check and evaluate the application itself. In subjective type questions, teachers can log in to the application and rate the marking level of the students. Hence all the basic needs for generating <strong>student's report cards could be accomplished in the application.</strong></li>
                        <li><strong>Result Analysis and Dashboards:</strong> Analyzing student’s progress and knowledge is important for schools to maintain their reputation. So once the exams are finished the complete inspections and analysis is done by the teachers as well as the administrators. In online examination software the reports with details like mark sheets, graphical representation, dashboards, detailed reports of bright and weak students, and other numerous types of reports. Even the management team can use their special access in the software with the assessment dashboards and can <strong>check the overall result summary of their organization.</strong></li>
                        <li><strong>Important alerts:</strong></li>
                        <li>Getting the parents updated about their children’s academic progress is another crucial parameter for the educational institutes, hence the <strong>automated push notification, SMS, and email alerts</strong> are dropped using the online examination system. The schools can <strong>configure and send the alerts</strong> like timely reminders of the exam timetable, regular updates of results, exam report cards, mark sheets, regular assignments, question banks, and many more related to <strong>virtual assessment.</strong></li>
                        <li><strong>Actual Exam Like Interface:</strong> <strong>Online examination systems</strong> are used the most in current challenging times and will be used in the future too, as it provides improvements over the traditional examination as it is highly secured, no scope for cheating, customized reports, on-screen evaluation, multi-language support, easy management of question banks, remote supervision.</li>
                        <li>With all these mentioned features, without any hesitation, the school management should adopt the new inventions as they will only benefit from this <strong>fullproof online examination system.</strong></li>
                        <li><strong>Instant evaluation:</strong> This is the best part of using an online examination system. It eliminates any sort of manual effort in evaluating the test by making all of it automated. On one side where manual evaluation is high on inaccuracy and mistakes, online examination evaluation is by far the most accurate source of scoring tests. Also, it is instant and the detailed test report is generated as soon as the test is complete.</li>
                        <li><strong>In-depth test report with detailed solutions for each Question:</strong>  A comprehensive test report that is generated at the end of the test becomes the main mapping point of the entire student/candidate performance. The report generated constitutes multiple factors based on which the scores are displayed. Total scores, comparative scores, scores on each section, scores on each question, total percentage, number of answered questions, number of missed questions, and overall feedback are some of the sections available in the report generated.</li>
                        <li><strong>Save+ Bookmark:</strong> Save all importance Question &amp; Bookmark</li>
                        <li><strong>Interactive Dashboard:</strong> A simple presentation of scores is not that effective as the visual representation is! <strong><i>Online exam software has got an interactive dashboard that displays the scores in a graphical and statistical format.</i></strong> Also, the reports can be easily transferred and saved in a format of choice through import-export options.</li>
                        <li>Live Chat with Mentors (For Live Doubt Session)</li>
                        
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