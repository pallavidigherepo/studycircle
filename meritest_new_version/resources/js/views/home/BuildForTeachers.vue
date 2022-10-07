<template>
    <div>
        <base-dialog :title="'Build for teachers'" @close="$emit('close')">
            <template #default>
                <div>
                    <h5>For Teachers, trainers, instructors, coaches who are looking for a full-powered tool for creating online test and subjective/objective question paper</h5>
                    <h6><p class="text-blue">
                        You want to make an impact in your classroom? We’re here to help😊 #Search, Select &amp; Submit
                    </p></h6>
                    <h5 class="text-org">Create</h5>
                    <ul class="ml-10 list-group">
                        <li>Get more than 100 Test paper templates, more than 1,00,000 ready to use questions.</li>
                        <li>Get some great tools and inbuilt libraries to create new quiz with a few clicks.</li>
                        <li>
                            <h6>Some tools overviews are as follows:</h6>
                            <div class="ml-15">
                                <ul>
                                    <li>Easily import your existing questions using an excel sheet.</li>
                                    <li>Quickly create great looking subjective/objective tests using multiple question types and formatted options. </li>
                                    <li>Meritest allows you to make a test using existing templates <strong>OR</strong> you can create your own from scratch.</li>
                                    <li>We have around 9 question types those are ready to go question templates. </li>
                                    <li>We have single choice, multiple choice, match the pair, fill in the blanks, to many more advanced question types like hotspot and drag-and-drop.</li>
                                    <li>Pre-assign points for correct answers where you can save tons of manual grading time.</li>
                                        
                                    <li>User-friendly drag-and-drop interface.</li>
                                    <li>Offers a calculator function, which can show different questions that give results based on their cumulative score.</li>
                                    <li>You can save time with automatic grading</li>
                                    <li>Having Trouble? <router-link to="/contact-us">Contact Us</router-link> for More Details (Contact us)</li>
                                    
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <h5 class="text-org">Publish/Print</h5>
                    <ul class="ml-10 list-group">
                        <li>Tests can either be published privately to a select group or open them up to everyone with a single link and registration page.</li>
                        <li>Turn your quiz into a popup or announcement bar on your website.</li>
                    </ul>
                    <h5 class="text-org">Analyse</h5>
                    <p>Meritest provide powerful analytical reports, which allow you to perform in-depth analysis across all results. Meritest instantly create reports based on marks and grades of your tests according to questions.</p>
                    <ul class="ml-10 list-group">
                        <li>AI based automated grading, and much more.</li>
                        <li>Automated scoring for Quizzes and all results are compiled into beautiful charts and graphs.</li>
                        <li>Get access to auto-generated and analysed reports to gain quiz insights anytime, anywhere, on any device.</li>
                    </ul>
                    <h5 class="text-org">Extra Features</h5>
                    <ul class="ml-10 list-group">
                        <li>Create personal feedback or give feedback to their student(s) for each question.</li>
                        <li>Get access to the student’s answers, the time they spent on your quiz, and their score.</li>
                        <li>Create a multi-lingual quiz.</li>
                        <li>Create online surveys, generate online polls and forms using a form generator.</li>
                        <li>Share Analytical reports with Parents and Student through URL or Email.</li>
                        <li>Filter and compare data sets, and create custom reports.</li>
                        <li>Results are generated instantly and automatically. You can also see individual and group reports.</li>
                        <li>Add multiple choice, fill-in-the-blank, and numerous other question types.</li>
                        <li>We have rich customization options where you can add versatile styles and themes to differentiate your content. Then you can use flexible layouts and colour schemes for greater visibility.</li>
                        <li>Video and audio effects. You can include multimedia, add external links, pictures, math formulas for questions and answers, to engage your students.</li>
                        <li>Branching scenarios. Create individual learning paths, that appear depending on how well a learner is performing on the quiz. </li>
                        <li>Flexible scoring. Flexible testing rules allow you to set up the overall passing score for the test or assign points for each answer individually.</li>
                        <li>Variety of delivery options. Deliver quiz results for your official institutes email address, or your LMS.</li>
                        <li>Create custom messages to show quiz-takers based on their reports. (like Congratulations)</li>
                        <li>Share digital reports with a simple URL.</li>
                        <li>Advanced Search: Quickly find the questions that you need to help your students with. Filter your search according to Subject, Chapter, Subjective, PYQ’s, Difficulty Level and so on without too much of trouble.</li>
                        
                    </ul>
                    <h5 class="text-org">Attention 🚨 Must Read:</h5>
                    <p>Our online exam software provides stable stage for examiners to make and arrange various types of subjective and objective tests/exams for Olympiads and School Classes Class 8, Class 9, Class 10, Class 11 &nbsp; Class 12 as per latest board pattern.</p>
                    <p>Our online exam software provides stable stage for examiners to make and arrange various types of tests/exams for professional courses, engineering, medical colleges and universities as per latest exam pattern.</p>
                    <h5 class="text-org">Some Extra Benefits with Meritest </h5>
                    <ul class="ml-10 ">
                        <li>1.	Class Schedule Template</li>
                        <li>2.	Lesson Plan Template</li>
                        <li>3.	Report Card Template</li>
                        <li>4.	Certificate of Completion Template</li>
                        <li>5.	Mind Map Template</li>
                        <li>6.	Timeline Infographic Template</li>
                    </ul>
                    <h4 class="text-org">Conclusion</h4>
                    <p>Meritest is an end-to-end exam management software with completely customizable features for conducting both online and offline exams. Users have complete control over their exams and other assessment programs with us. We make the whole exam process appear a lot easier.</p>
                    <p>During challenging times like this, our solution provides contingency planning to conduct assessments, remotely. Meritest constantly supportg your remote assessment needs without any interruption. <router-link to="/contact-us"> Contact us</router-link> to learn more about our online examination software.</p>
                    <h5 class="text-org">Final Words</h5>
                    <p>Meritest Online exam software is the future of academic assessments, providing automated systems and robust processing skills with various improvements over conventional method. Meritest Assessment Software is very well-known platforms that are already helping out various institutes by catering as per exclusive needs and demands. The upcoming days will ensure greater developments and hassle-free operative experiences. Till then, these described methods will help you find the best platform available on the market right now.</p>
                    <h6 class="text-org">Suggested By Teachers, Parents &nbsp; Coaching Owners</h6>
                    <p>Thanks to the Meritest Solutions Pvt. Ltd., that help teachers to create and deliver everything from quizzes, Online Courses, Online Test to polls and many more.</p>
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