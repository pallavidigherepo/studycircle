<template>
    <div>
        <breadcrumb :pageTitle="'Features'"></breadcrumb>
        <base-card>
            <div class="row">
                
                <div class="col-sm-10 col-sm-offset-1 col-md-12 col-md-offset-0">
                
                    <div class="faq-wrapper">

							<div class="faq-section">
						
								<div class="panel-group bootstarp-accordion" id="faq-accordion" role="tablist" aria-multiselectable="true">
								
									<div class="panel">
										<div class="panel-heading" role="tab">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#faq-accordion" href="#faq-accordion-one-1" aria-expanded="true" aria-controls="faq-accordion-one-1"> <h4>Top features from the Administrator’s point of view</h4></a>
											</h4>
										</div>
										<div id="faq-accordion-one-1" class="panel-collapse collapse in" role="tabpanel">
											<div class="panel-body">
												<div class="faq-thread">
													
                                                    <ul class="list-group">
                                                        <li 
                                                            v-for="(admin, index) in initalAdmins" 
                                                            :key="index"
                                                            >
                                                            <span><i class="fa fa-arrow"></i>{{ admin }}</span>
                                                        </li>
                                                        
                                                    </ul>
                                                    <a href="#" 
                                                        class="btn btn-primary" 
                                                        @click.prevent="showMoreAdmin()"
                                                        v-if="!showMoreAdminBtn">{{ adminAnchorText }}</a>
                                                    <a href="#" 
                                                        class="btn btn-primary" 
                                                        @click.prevent="showLessAdmin()"
                                                        v-else>{{ adminAnchorText }}</a>
												</div>
											</div>
										</div>
									</div>
									<!-- end of panel -->

									<div class="panel">
										<div class="panel-heading" role="tab">
											<h4 class="panel-title">
												<a class="collapsed" role="button" data-toggle="collapse" data-parent="#faq-accordion" href="#faq-accordion-one-2" aria-expanded="false" aria-controls="faq-accordion-one-2"><h4>Top features from the User&rsquo;s point of view</h4></a>
											</h4>
										</div>
										<div id="faq-accordion-one-2" class="panel-collapse collapse" role="tabpanel">
											<div class="panel-body">
												<div class="faq-thread">
                                                    <ul class="list-group">
                                                        <li 
                                                            v-for="(user, index) in initalUsers" 
                                                            :key="index"
                                                            >
                                                            <span><i class="fa fa-arrow"></i>{{ user }}</span>
                                                        </li>
                                                        
                                                    </ul>
                                                    <a href="#" 
                                                        class="btn btn-primary" 
                                                        @click.prevent="showMoreUser()"
                                                        v-if="!showMoreUserBtn">{{ userAnchorText }}</a>
                                                    <a href="#" 
                                                        class="btn btn-primary" 
                                                        @click.prevent="showLessUser()"
                                                        v-else>{{ userAnchorText }}</a>
												</div>
											</div>
										</div>
									</div>
									<!-- end of panel -->
								</div>
								<!-- end of #accordion -->

							</div>

						</div>
                </div>
            
            </div>
        </base-card>
    </div>
</template>

<script>
export default {
    data() {
        return {
            adminAnchorText: "Show More",
            userAnchorText: "Show More",
            showAllAdmin: false,
            showAllUser: false,
            minAdmin: 5,
            minUser: 5,
            limit: 5,
            showMoreAdminBtn: false,
            showMoreUserBtn: false,
            admins: [
                'Analytical Report and Interactive Dashboard.',
                'Online quiz maker: Easy to add/import questions from word/excel format as per different topics & subjects.',
                'Support different types of questions including MCQ’s, Match the pairs Questions, Fill in the blanks, images, formulas, and videos.',
                'Configuration of question types with different difficulty levels according your requirements.',
                'Speed Exam: Create tests quickly by choosing the option Question Bank, Topic wise, Chapter wise, PYQ questions and download/share it with users or assign the date &amp; time to the test to limits availability.',
                'Instant Announcements,Send emails, notifications and share news, documents and videos on Web, Mobile, and Tablet which is accessible 24/7.',
                'Analyze the performance of students from different available reports.',
                'Publish the results automatically or by defining the date and time.',
                'Third-party integration is possible, i.e., SMS, email, online payment gateway etc.',
                'Sell your online test series and get monetary benefits.',
                'Create sub admins under your supervision and assign different roles and responsibilities to conduct exams.',
                'Import and Export of data in excel and available data formats.',
                'Fees management, Staff Management.',
            ],
            users: [
                'Analytical Result View and Interactive Dashboard.',
                'Synchronization of online test on Web and Mobile/Tablet which is accessible 24/7.',
                'Instant scorecard after submitting the online test.',
                'Identify questions/topics/sections that take most/least time.',
                'Question wise solution and explanation.',
                'Detailed reports are available for proper Test Analysis.',
                'Analyze performance by comparing with toppers.',
                'Bookmark questions and review them anytime.',
                'Focus on weak areas and concentrate more on it.',
                'Download the available Documents and Videos for exam prep.',
                'Homework/Assignment details.',
                'Attendance Checking.',
                'Weekly Progress Reports to boost your performance via Notifications alert..',
            ]
        }
    },
    computed: {
        initalAdmins() { 
            return this.admins ? this.admins.slice(0,this.minAdmin) : this.admins;
        },
        
        initalUsers() { 
            return this.users ? this.users.slice(0,this.minUser) : this.users;
        }
    },
    methods: {
        showMoreAdmin() {
            this.showMoreAdminBtn = true;
            this.minAdmin = this.admins.length;
            this.adminAnchorText = 'Show Less';
        },
        showLessAdmin() {
            this.showMoreAdminBtn = false;
            this.minAdmin = this.limit;
            this.adminAnchorText = 'Show More';
        },
        showMoreUser() {
            this.showMoreUserBtn = true;
            this.minUser = this.users.length;
            this.userAnchorText = 'Show Less';
        },
        showLessUser() {
            this.showMoreUserBtn = false;
            this.minUser = this.limit;
            this.userAnchorText = 'Show More';
        }
    },
}
</script>

<style scoped>
.list-group li {
    list-style: disclosure-closed;
}
</style>