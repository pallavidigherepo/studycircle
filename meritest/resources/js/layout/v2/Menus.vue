<template>
    <ul :class="attr" id="responsive-menu">
        <li>
            <router-link to="/">Home</router-link>
            <!--<router-link to="/">Home</router-link>-->
        </li>
        <li>
            <router-link to="/our-services">Our Services</router-link>
        </li>
        <li>
            <router-link to="/our-products">Our Products</router-link>
        </li>
        <li>
            <router-link to="/about-us">About Us</router-link>
        </li>
        <li>
            <router-link to="/careers" title="Careers">Careers</router-link>
        </li>
        <li>
            <router-link to="/our-team">Our Team</router-link>
        </li>
        <li>
            <router-link to="/contact-us">Contact Us</router-link>
        </li>
        <li>
            <router-link to="/blogs">Blogs</router-link>
            <!-- <a href="#">Blogs</a>
            <ul>
                <li><router-link to="/kvpy">KVPY</router-link></li>
                <li><router-link to="/mht-cet">MHT-CET</router-link></li>
            </ul> -->
        </li>
    </ul>
        
</template>

<script>
export default {
    props: {
        attr: {
            type: String,
            required: false,
            default: 'nav navbar-nav navbar-right'
        }
    }

}
</script>

<style>

</style>