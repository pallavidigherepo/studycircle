<template>
    <div class="slick-hero-slider-wrapper">
        <div class="slider">
            <agile autoplay :fade="true" :navButtons="false">
            
                <template v-slot:default>
                    
                    <div class="slick-item slide" v-for="(slide, index) in slides" :key="index">
                
                        <div class="image-bg" :style="`background-image:url('`+slide.image+`'); height: 500px; opacity: 2;`">
                        
                            <div class="container">
                            
                                <div class="row">
                
                                    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                        
                                        <div class="slick-hero-slider-caption">
                                            <h1 class="animation fromBottom transitionDelay4 transitionDuration6" style="color: #000000;">{{ slide.caption }}</h1>
                                            <p class="font22 line34 font300 font-roboto-condensed font19-xs mt-15 mb-30 animation fromBottom transitionDelay6 transitionDuration8" style="color: #000000;">{{ slide.description }}</p>
                                            <a href="#" class="animation fromBottom transitionDelay8 transitionDuration10"><span class="bg-primary">More Details</span></a>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </template>
                
            </agile>
        </div>
        

    </div>
</template>

<script>

import { VueAgile } from 'vue-agile'
export default {

    components: {
        agile: VueAgile
    },
    data() {
        return {
            //left: '<svg x="0px" y="0px" viewBox="0 0 24 24"><path d="M16.2,21c0.3,0,0.5-0.1,0.7-0.3c0.4-0.4,0.4-1,0-1.4L9.6,12L17,4.7c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0L6.8,12l8.8,8.7C15.7,20.9,16,21,16.2,21z"/></svg>',
            //right: '<svg x="0px" y="0px" viewBox="0 0 24 24"><path d="M7.8,21c-0.3,0-0.5-0.1-0.7-0.3c-0.4-0.4-0.4-1,0-1.4l7.4-7.3L7,4.7c-0.4-0.4-0.4-1,0-1.4s1-0.4,1.4,0l8.8,8.7l-8.8,8.7C8.3,20.9,8,21,7.8,21z"/></svg>',
            slides: {
                1: {
                    image: '/meritest/images/slides/1.jpeg',
                    caption: 'Digital Marketing',
                    description: 'We will take care of complete digital marketing solutions according market requirements.',
                },
                2: {
                    image: '/meritest/images/slides/2.jpeg',
                    caption: 'Digital Branding',
                    description: 'We will take care of complete digital branding solutions according market requirements.',
                },
                3: {
                    image: '/meritest/images/slides/03.jpeg',
                    caption: 'Content generation',
                    description: 'We will take care of complete content generation for your website.',
                },
                4: {
                    image: '/meritest/images/slides/04.jpeg',
                    caption: 'SEO, SMM',
                    description: 'We will take care of complete SEO AND SMM of your website.',
                },
                5: {
                    image: '/meritest/images/slides/04.jpeg',
                    caption: 'Website design and development',
                    description: 'We will take care of complete website design and development of your ideas',
                }
            }
        }
    }
}
</script>

<style>
.slick-hero-slider-caption {
    color: #000;
}
</style>