<template>
	<div>
		<breadcrumb :pageTitle="'About Us'"></breadcrumb>
		<div class="container pt-60 pb-70">
					
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1 col-md-12 col-md-offset-0">
					<div class="quote bg-org">
						<h4>&ldquo;The use of online assessment tools is giving teachers a more fine-grained understanding of individual students&rsquo; skills, and assisting them to determine the necessary next steps to enable them to achieve their own learning goals. We are seeing more effective differentiation in classrooms as a result.&rdquo;</h4>

						<p>&mdash;&nbsp;Susan Mann</p>
					</div>
					<p><strong>MERITEST </strong>is an online exam software service provider brought to you by <strong>MERITEST SOLUTIONS Pvt Ltd.</strong><br />
					We have developed an innovative <strong>online examination solution</strong> for university, colleges, institutions and corporate to conduct examinations anywhere, anytime.</p>

					<p>Our examination process have very fast processing speed, which is secure and simple that saves your time and money.&nbsp;</p>

					<p>Use this <strong>test maker</strong> to create <strong>career </strong>booster <strong>Competitive Exam Online Test Series</strong> for <strong>Bank, SSC, Railways, LIC, RBI, CTET, GATE, Defence, UPSC, LAW, MBA, NET, BBA </strong>&amp; other {{ currentYear}} Exams. </p>
					<p>Use our <strong>online test generator</strong> which creates <strong>Engineering and Medical</strong> entrance exam like <strong>JEE Main, JEE Advanced, BITSAT, VITEEE, SRMJEEE, COMEDK, KIITEE, WBJEE, MHTCET, BCECE, NTA NEET, AIIMS, JIPMER, AFMC</strong> and many more for your convenience.</p>

					<p>We will manage the entire process of the examination platform as a service, including exam center supervision and candidate validation except administrative activities.</p>

					<p>The system can be used for all types of <strong>online assessment</strong> services like quizzes, tests, assessments, exams or get feedback from surveys and polls. <strong>MERITEST</strong> is delivered through a <strong>SaaS model</strong> where the application is provided as a service to customers across the internet platform.</p>

					<p><strong>FEATURES THAT MAKE MERITEST STAND OUT</strong></p>
					<br />
					<div class="row col-md-offset-0">
						<div class="col-md-6 bg-org min-ht col-md-offset-0">
							<h4><span class="text-white">Top 10 features from the Administrator&rsquo;s point of view</span></h4>
							<ul class="list-group-aboutus">
								<li class="list-group-item-aboutus"
									v-for="(admin, index) in admins"
									:key="index"
									>
									{{ admin }}	
								</li>
								<li><router-link to="/features">...and many more</router-link></li>
							</ul>
						</div>
						<div class="col-md-6 bg-blue min-ht">
							<h4><span class="text-white">Top 10 features from the Users&rsquo;s point of view</span></h4>
							<ul class="list-group-aboutus">
								<li class="list-group-item-aboutus"
									v-for="(user, index) in users"
									:key="index"
									>
									{{ user }}
								</li>
								<li><router-link to="/features">...and many more</router-link></li>
							</ul>
						</div>
					</div>

					<p>We will provide products as per your requirement <router-link to="/contact-us"><span class="text-org">(Contact Us)</span></router-link></p>

					<p><strong>MERITEST Exam software </strong>is developed by deep research in examination domain with highly qualified team which are specialized in creating best efficacy in <strong>online exam preparation software </strong>which is highly efficient in terms of reliability and speed.</p>

					<p><strong>Final Word:</strong></p>

					<p><strong>Online examination system </strong>is gateway towards modernization of conventional examination system. It will decrease your expenses and increase benefits. <strong>MERITEST</strong> always attempts to offer the best <strong>Online Examination Builder </strong>to you.</p>

					<p>We are pursuing to sustain and build on the remarkable success which we have enjoyed since <strong>MERITEST online exam tool </strong>launch. Our vision and focus then and now is to challenge the status of working proactively with our customers to find the optimum solutions and applications to assure &lsquo;sustainable&rsquo; long term relationships. These are exciting times for <strong>MERITEST </strong>and we think you will get a sense of our passion, expertise, reliability, and innovative nature as you browse through this website. <strong>We believe in &quot;Make a customer, not a sale&quot;.</strong></p>
					
				</div>
			</div>	
		</div>
		
		<div class="pt-80 pb-80 bg-light">
		
			<div class="container">
			
				<div class="row">
				
					<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-0">
					
						<div class="section-title">
							<h2 class="text-center">Our Team</h2>
						</div>
						<div class="user-profile-header clearfix">
							<div class="user-profile-wrapper">
								<div class="image">
									<img :src="getImage('profiles/sudhir_mishra.jpeg')" alt="Image" />
								</div>
								<div class="content">
									
									<h3 class="text-org">Sudhir Mishra</h3>
									<p class="labeling">Director &amp; CEO</p>
									
									<ul class="address-list">
									
										<li><i class="fa fa-envelope"></i> sudhir@meritest.in</li>
										
									</ul>
									
									<div class="social-a-wrapper mb-20 clearfix">

										<a href="#" class="facebook" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
										<a href="#" class="twitter" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
										<a href="#" class="google-plus" data-toggle="tooltip" data-placement="top" title="Google Plus"><i class="fa fa-google-plus"></i></a>
										<a href="#" class="pinterest" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a>
									
									</div>
									
								</div>
							</div>
							
							<div class="user-profile-wrapper">
								<div class="image">
									<img :src="getImage('profiles/pallavi_dighe.png')" alt="Image" />
								</div>
								<div class="content">
									
									<h3 class="text-org">Pallavi Dighe</h3>
									<p class="labeling">Director &amp; CTO</p>
									
									<ul class="address-list">
									
										<li><i class="fa fa-envelope"></i> pallavi@meritest.in</li>
										
									</ul>
									
									<div class="social-a-wrapper mb-20 clearfix">
										
										<a href="https://www.facebook.com/palsver/" data-toggle="tooltip" data-placement="right" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
										<a href="https://twitter.com/palsverma" data-toggle="tooltip" data-placement="right" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>
										<a href="https://www.linkedin.com/in/pallavi-dighe-8235817/" data-toggle="tooltip" data-placement="right" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a>
										<a href="https://in.pinterest.com/palsver/" data-toggle="tooltip" data-placement="right" title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>
									
									</div>
									
								</div>
							</div>
						</div>
					</div>
				
				</div>
				
			</div>
			
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
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
            ]
		}
	},
	computed: {
		currentYear() {
			return new Date().getFullYear();
		}
	},
    methods: {
      getImage(image)
      {
        return '/meritest/images/'+image;
      }
    }
}
</script>

<style scoped>

a {
	font-weight: bold;
	color: white;
}
</style>