<script setup>
import Layout from "@/layouts/main.vue"
import PageHeader from "@/components/page-header.vue"
import Visiters from "./visiters.vue"
// import Comments from "./comments.vue"
</script>


<template>
    <Layout>
        <PageHeader title="Blog" pageTitle="Dashboards" />

        <BRow>
            <Visiters/>
            <!-- <Comments/> -->
        </BRow>

    </Layout>
</template>