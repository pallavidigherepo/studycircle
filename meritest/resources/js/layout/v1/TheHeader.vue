<template>
    <header id="header">
	  
        <!-- start Navbar (Header) -->
        <nav class="navbar navbar-primary navbar-fixed-top navbar-sticky-function">
        
            <div id="top-header">
        
                <div class="container">
                
                    <div class="row">
                    
                        <div class="col-sm-6">
                            
                            <!--<div class="top-header-widget">
                                <ul class="top-header-dropdown">
                                    <li class="dropdown dropdown_hover">
                                        <a id="language-dropdown" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="ion-android-globe"></i> English
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="language-dropdown">
                                            <li><a href="#">English</a></li>
                                            <li><a href="#">Hindi</a></li>
                                            <li><a href="#">Marathi</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>-->
                            
                            <div class="top-header-widget">
                                <a href="tel:91-762-009-8848"><i class="ion-android-call"></i> <span class="number">+91 762 009 8848</span></a>
                            </div>
                        
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="top-header-widget pull-right">
                                <router-link to="/contact-us">
                                    <i class="fa fa-comments mr-3"></i> Support
                                </router-link>
                            </div>
                        </div>
                        
                    </div>
                
                </div>
                
            </div>

            <div class="container">
                
                <div class="navbar-header">
                    <router-link to="/" class="navbar-brand ">
                        <img :src="getLogo()" alt="Meritest" class="logo" />
                    </router-link>
                </div>
                
                <div id="navbar" class="collapse navbar-collapse navbar-arrow">
                
                    <ul class="nav navbar-nav navbar-right" id="responsive-menu">
                    
                        <li>
                            <router-link to="/">Home</router-link>
                        </li>
                        <li>
                            <router-link to="/about-us">About Us</router-link>
                        </li>
                        <li>
                            <router-link to="/features">Features</router-link>
                        </li>
                        <li>
                            <router-link to="/how-it-works">How It Works</router-link>
                        </li>
                        <li>
                            <router-link to="/contact-us">Contact Us</router-link>
                        </li>
                        <li>
                            <router-link to="/careers" title="Careers">Careers</router-link>
                        </li>
                        <li>
                            <a href="/kvpy" title="KVPY">KVPY {{ currentYear }}</a>
                        </li>
                        <!--<li>
                            <a href="/mht-cet" title="MHT-CET">MHT-CET {{ currentYear }}</a>
                        </li>-->
                        
                    </ul>
                
                </div>
                
            </div>

            <div id="slicknav-mobile"></div>
            
        </nav>
        <!-- end Navbar (Header) -->

    </header>
</template>

<script>
export default {
    methods: {
        getLogo()
        {
            return '/meritest/images/logo/150_height.png';
        },
    },
	computed: {
		currentYear() {
			return new Date().getFullYear();
		}
	},

}
</script>

<style scoped>
.navbar-nav a {
    font-size: large;
    font-weight: bold;
    color: #656566;
    font-variant-caps: all-small-caps;
}

.navbar-nav a:hover {
    color: #da380d;
}
</style>