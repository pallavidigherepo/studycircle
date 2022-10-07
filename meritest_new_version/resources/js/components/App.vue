<template>
	<div>	
		<!-- start Container Wrapper -->
		<div class="container-wrapper">

			<!-- start Header -->
			<the-header />
			<!-- end Header -->

			<!-- start Main Wrapper -->
			<div class="main-wrapper scrollspy-container">
				<router-view></router-view>
			</div>
			<!-- end Main Wrapper -->
			
			<!-- start Footer Wrapper -->
			<the-footer />
			<!-- end Footer Wrapper -->
			
		</div>
		<!-- end Container Wrapper -->
	</div>
    
</template>

<script>
import TheHeader from '../layout/v2/TheHeader.vue';
import TheFooter from '../layout/v2/TheFooter.vue';
export default {
    components: {
        TheHeader,
        TheFooter
    }

}
</script>

<style>
</style>