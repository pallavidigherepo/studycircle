<template>
  
    <div class="footer-wrapper scrollspy-footer">
    
        <footer class="main-footer">
            
            <div class="container">
            
                <div class="row">
                
                    <div class="col-sm-12 col-md-3 mb-30">
                    
                        <div class="footer-logo logo">
                            <router-link to="/"><img :src="getLogo('logo/150_height.png')" alt="Meritest" class="logo" /></router-link>
                        </div>
                        
                        <p class="about-us-footer">
                            <strong>MERITEST </strong>is an online exam software service provider brought to you by <strong>MERITEST SOLUTIONS Pvt Ltd.</strong><br />
			We have developed an innovative <strong>online examination solution</strong> for university, colleges, institutions and corporate to conduct examinations anywhere, anytime. 
                        </p>
                    
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-6 mb-30">
                    
                        <!--<div class="newsletter-footer">
                        
                            <form action="#" method="post" class="row">
                                
                                <div class="col-xs-12 col-sm-12 col-md-8">

                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter your email address">
                                        <input type="submit" class="btn btn-submit" value="SUBSCRIBE">
                                    </div>
                                    
                                </div>
                                
                            </form>
                            
                        </div>-->

                        <ul class="menu-footer">
                            <li><router-link to="/">Home</router-link></li>
                            <li><router-link to="/about-us">About Us</router-link></li>
                            <li><router-link to="/features">Features</router-link></li>
                            <li><router-link to="/how-it-works">How It Works</router-link></li>
                            <li><router-link to="/contact-us">Contact Us</router-link></li>
                            <li><router-link to="/careers" title="Careers">Careers</router-link></li>
                            <li><a href="/kvpy" title="KVPY">KVPY {{ currentYear }}</a></li>
                            <!--<li><a href="/mht-cet" title="MHT-CET">MHT-CET {{ currentYear }}</a></li>-->
                            <li><a href="/sitemap.xml" target="_blank">Site Map</a></li>
                        </ul>
                    
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-3 mb-30">
                    
                        <div class="social-footer clearfix">
                            <a href="https://www.facebook.com/meritestdotin" target="_blank"><i class="fa fa-facebook-official"></i></a>
                            <a href="https://twitter.com/meritestdotin" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.linkedin.com/company/meritestdotin" target="_blank"><i class="fa fa-linkedin "></i></a>
                            <a href="https://www.pinterest.com/meritestdotin" target="_blank"><i class="fa fa-pinterest "></i></a>
                            <a href="https://www.quora.com/profile/meritestdotin" target="_blank"><i class="fa fa-quora "></i>Q</a>
                            <a href="https://medium.com/" target="_blank"><i class="fa fa-medium "></i></a>
                            <a href="https://www.youtube.com/channel/UC2jXBWiTxsr-KQlBexxPvXA" target="_blank"><i class="fa fa-youtube "></i></a>
                        </div>
                        
                        <p class="footer-address">
                            H.No. 2238/09, Vidya Nagar Wathoda Layout (Urban)<br />
                            Behind Ganesh Mandir<br />
                            NAGPUR, MAHARASHTRA 440008<br />
                            India <br />
                            <a href="tel:91-762-009-8848"><span class="block text-white font20 font700 line20 mt-5 mb-5">
                                +91 762 009 8848
                            </span></a>
                            <a href="mailto: support@meritest.in">support@meritest.in</a>
                        </p>
                    
                    </div>
                    
                </div>
                
            </div>
            
        </footer>
        
        <footer class="secondary-footer">
        
            <div class="container">
            
                <div class="row">
                
                    <div class="col-xs-12 col-sm-6">
                        <p class="copy-right">&#169; Copyright @{{currentYear}} <a title="MERITEST SOLUTIONS PRIVATE LIMITED." alt="MERITEST SOLUTIONS PRIVATE LIMITED.">MERITEST SOLUTIONS PRIVATE LIMITED.</a></p>
                    </div>
                    
                </div>
            
            </div>
            
        </footer>

    </div>
</template>

<script>
export default {
    data() { 
        return { 
            mobile_number: process.env.CONTACT_MOBILE_NUMBER, 
            email: process.env.CONTACT_EMAIL,  
        }
    },
    methods: {
        getLogo(img)
        {
            return '/meritest/images/'+img;
        }
    },
	computed: {
		currentYear() {
			return new Date().getFullYear();
		}
	},
}
</script>

<style scoped>

</style>