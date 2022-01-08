<template>
    <div class="breadcrumb-wrapper">
			
        <div class="container">
            
            <div class="row">
            
                <div class="col-xs-12 col-sm-8">
                    <ol class="breadcrumb">
                        <li><router-link to="/">Home</router-link></li>
                        <li class="active">{{ pageTitle }}</li>
                    </ol>
                </div>
                
                <div class="col-xs-12 col-sm-4 hidden-xs">
                    <p class="hot-line"> <a href="tel:91-762-009-8848"><i class="fa fa-phone"></i> Hot Line: +91 762 009 8848</a></p>
                </div>
                
            </div>
            
        </div>

    </div>
</template>

<script>
export default {
    props: {
        pageTitle: {
            type: String,
            required: false,
            default: 'Page'
        }
    }

}
</script>

<style>

</style>