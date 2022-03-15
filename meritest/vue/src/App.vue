<template>
  <div>	
		<!-- start Container Wrapper -->
		<div class="container-wrapper">

			<!-- start Header -->
			<Header />
			<!-- end Header -->

			<!-- start Main Wrapper -->
			<div class="main-wrapper scrollspy-container">
				
				<router-view></router-view>
			</div>
			<!-- end Main Wrapper -->
			
			<!-- start Footer Wrapper -->
			<Footer />
			<!-- end Footer Wrapper -->
			
		</div>
		<!-- end Container Wrapper -->
	</div>
</template>

<script setup>

import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";


</script>