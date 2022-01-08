<template>
    <div>
    <!-- start hero-header -->
        <div class="hero banner">
        
            <div class="container">
            
                <div class="row">
                
                    <div class="main-search-wrapper">
                
                        <h2 class="text-center">Which test would you like to give?</h2>
                        <p class="lead text-center">Practice makes a learner perfect.</p>

                        <div class="input-group">
                            <input type="text" class="form-control placeholder-type-writter">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button"><i class="ion-ios-search-strong"></i></button>
                            </span>
                        </div><!-- /input-group -->
                    
                        <div class="featured-sm-wrapper">
                            
                            <div class="GridLex-gap-30">
                
                                <div class="GridLex-grid-noGutter-equalHeight GridLex-grid-center">
                                
                                    <div class="GridLex-col-4_sm-4_xs-8_xss-12">
                                    
                                        <div class="featured-sm-item clearfix">
                                            
                                            <div class="icon">
                                                <i class="ion-clipboard"></i>
                                            </div>
                                            
                                            <div class="content">
                                                Many courses coming
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="GridLex-col-4_sm-4_xs-8_xss-12">
                                    
                                        <div class="featured-sm-item clearfix">
                                        
                                            <div class="icon">
                                                <i class="ion-person-stalker"></i>
                                            </div>
                                            
                                            <div class="content">
                                                Many students are joining us
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="GridLex-col-4_sm-4_xs-8_xss-12">
                                    
                                        <div class="featured-sm-item clearfix">
                                        
                                            <div class="icon">
                                                <i class="ion-ipad"></i>
                                            </div>
                                            
                                            <div class="content">
                                                Learn anywhere, anythime you like
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>

                        </div>
                        
                    </div>
                    
                    
                </div>
                
            </div>
            
        </div>
        <!-- end hero-header -->
        
        <div class="promo-box-bg-color bg-org">
        
            <div class="container">
            
                <div class="GridLex-gap-30">
                    
                    <div class="GridLex-grid-noGutter-equalHeight GridLex-grid-middle">
                    
                        <div class="GridLex-col-9_sm-8_xs-12_xss-12">
                        
                            <div class="GridLex-inner">
                            
                                <h3>Want to know more about us?</h3>
                                
                            </div>
                            
                        </div>
                        
                        <div class="GridLex-col-3_sm-4_xs-12_xss-12">
                        
                            <div class="GridLex-inner">
                                <router-link to="/about-us" class="btn btn-primary">About Us</router-link>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>

            </div>
            
        </div>
        <!-- start How It works -->
        <section class="section pb-70">
        
            <div class="container">
            
                <div class="row">
                
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                    
                        <div class="section-title">
                            <h2 class="text-center">Meritest Built For</h2>
                        </div>
                    </div>
                
                </div>
                
                <div class="row">
                    <a href="#" 
                        data-toggle="modal" 
                        @click.prevent="selectComp('BuildForTeachers')"
                        :id="`BuildForTeachers`">
                        <div class="col-sm-4">
                    
                            <div class="icon-featured">
                                
                                <h4>Teachers</h4>
                                <span class="icon text-primary"><i class="ion-ios-people-outline"></i></span>
                                <p>Create Question, Design Test, Assign Test, Generate Result.</p>
                            
                            </div>
                        
                        </div>
                    </a>
                    <a href="#" 
                        data-toggle="modal" 
                        @click.prevent="selectComp('BuildForStudents')"
                        :id="`BuildForStudents`">
                        <div class="col-sm-4">
                    
                            <div class="icon-featured">
                                
                                <h4>Students</h4>
                                <span class="icon text-primary"><i class="ion-ios-people-outline"></i></span>
                                <p>Learn and do exam practice anytime.</p>
                            
                            </div>
                        
                        </div>
                    </a>
                    <a href="#" 
                        data-toggle="modal" 
                        @click.prevent="selectComp('BuildForParents')"
                        :id="`BuildForParents`">
                        <div class="col-sm-4">
                        
                            <div class="icon-featured">
                                
                                <h4>Parents</h4>
                                <span class="icon text-primary"><i class="ion-ios-people-outline"></i></span>
                                <p>Get a complete track of you kid.</p>
                            
                            </div>
                        
                        </div>
                    </a>
                    
                </div>
                
            </div>
            
        </section>
        <!-- end How It works -->
        
        <div class="promo-box-bg-color bg-primary">
        
            <div class="container">
            
                <div class="GridLex-gap-30">
                    
                    <div class="GridLex-grid-noGutter-equalHeight GridLex-grid-middle">
                    
                        <div class="GridLex-col-9_sm-8_xs-12_xss-12">
                        
                            <div class="GridLex-inner">
                            
                                <h3>Know more about our features</h3>
                                
                            </div>
                            
                        </div>
                        
                        <div class="GridLex-col-3_sm-4_xs-12_xss-12">
                        
                            <div class="GridLex-inner">
                                <router-link to="/features" class="btn btn-customer-org">Features</router-link>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>

            </div>
            
        </div>
        <!-- start Online Software Services -->
        <section class="section">
        
            <div class="container">

                <div class="row">
                
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                    
                        <div class="section-title">
                            <h2 class="text-center">Meritest online exam software solutions</h2>
                        </div>
                    </div>
                
                </div>
                
                <div class="category-item-wrapper icon-block item-border mt-10">
                
                    <div class="GridLex-gap-20">   
                    
                        <div class="GridLex-grid-noGutter-equalHeight">  
                            
                            <div v-for="(service, index) in services" 
                                 :key="index"
                                 class="GridLex-col-2_sm-3_xs-4_xss-6">

                                <a href="#" 
                                    data-toggle="modal" 
                                    @click.prevent="selectComp(service.comp)"
                                    :id="service.comp">
                                    <div class="category-item">
                                        <div class="icon">
                                            <i :class="service.icon"></i>
                                        </div>
                                        <div class="content">
                                            <h6>{{ service.label }}</h6>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
        
        </section>
        <!-- end Online Software Services -->
        <div class="overflow-hidden">
        
            <div class="GridLex-grid-noGutter-equalHeight">
            
                <div class="GridLex-col-6_sm-12_xs-12 bg-img bg-org">
                
                    <div class="promo-box-03 overlay-danger">
                    
                        <div class="promo-box-03-inner">
                        
                            <h2 class="mb-20 text-white">Join a Student Community</h2>
                            <p class="mb-25">Join a Student community and avail many possibilities of your success. Join a Student community and avail many possibilities of your success.</p>
                            
                            <router-link to="/contact-us" class="btn btn-primary">Contact Us</router-link>
                            
                        </div>
                        
                    </div>
                    
                </div>
                
                <div class="GridLex-col-6_sm-12_xs-12 bg-img bg-blue">
                
                    <div class="promo-box-03 overlay-primary">
                        
                        <div class="promo-box-03-inner">
                        
                            <h2 class="mb-20 text-white">Join a Teacher Community</h2>
                            <p class="mb-25">Join teacher community and unlock features that will make your life much easier. Join teacher community and unlock features that will make your life much easier.</p>
                            
                            <router-link to="/contact-us" class="btn btn-customer-org">Contact Us</router-link>
                        
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        <!-- BEGIN: Component  -->

        <teleport to='#app'>
            <component v-if="selectComponent !== null" 
                        :is="selectComponent"
                        :id="selectComponent"
                        @close="closeMe"
                        ></component>
        </teleport>
        <!-- END: Component  -->
    </div>
</template>

<script>
import EducationalInstitutions from './home/EducationalInstitutions.vue';
import CoachingClasses from './home/CoachingClasses.vue';
import CollageUniversities from './home/CollageUniversities.vue';
import DistanceEducation from './home/DistanceEducation.vue';
import ITSolutions from './home/ITSolutions.vue';
import RecruitmentSurveys from './home/RecruitmentSurveys.vue';
import SchoolsOlympiads from './home/SchoolsOlympiads.vue';
import TrainingCertificate from './home/TrainingCertificate.vue';
import BuildForTeachers from './home/BuildForTeachers.vue';
import BuildForStudents from './home/BuildForStudents.vue';
import BuildForParents from './home/BuildForParents.vue';



export default {
    components: {
        EducationalInstitutions,
        CoachingClasses,
        CollageUniversities,
        DistanceEducation,
        ITSolutions,
        RecruitmentSurveys,
        TrainingCertificate,
        SchoolsOlympiads,
        BuildForTeachers,
        BuildForStudents,
        BuildForParents
    },
    data() {
        return {
            selectComponent: '',
            services: {
               educational: {
                   label: 'Educational Institutions',
                   icon: 'fa fa-university',
                   comp: 'EducationalInstitutions'
               },
               coaching: {
                   label: 'Coaching Classes',
                   icon: 'icon-screen-desktop',
                   comp: 'CoachingClasses',
               },
               schools: {
                   label: 'Schools and Olympiads',
                   icon: 'fa education-icon-schoolclass',
                   comp: 'SchoolsOlympiads',
               },
               collage: {
                   label: 'College and Universities',
                   icon: 'fa fa-graduation-cap',
                   comp: 'CollageUniversities',
               },
               recruitment: {
                   label: 'Recruitment & Surveys',
                   icon: 'fa fa-users',
                   comp: 'RecruitmentSurveys',
               },
               training: {
                   label: 'Trainig Certificate',
                   icon: 'fa education-icon-certificate3',
                   comp: 'TrainingCertificate',
               },
               distance: {
                   label: 'Distance education',
                   icon: 'fa fa-location-arrow',
                   comp: 'DistanceEducation',
               },
               it: {
                   label: 'IT Solutions',
                   icon: 'fa fa-tablet',
                   comp: 'ITSolutions',
               },
            }
        }
    },
    methods: {
        selectComp(comp) {
            this.selectComponent = comp;
        },
        closeMe() {
            this.selectComponent = "";
        }
    },
}
</script>

<style scoped>
</style>