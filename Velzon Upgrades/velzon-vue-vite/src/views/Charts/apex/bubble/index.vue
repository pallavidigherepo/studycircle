<script setup>
import { reactive } from 'vue';

import Layout from "@/layouts/main.vue";
import PageHeader from "@/components/page-header.vue";

import { simpleBubbleChart as originalSimpleBubbleChart, bubble3DChart as originalBubble3DChart } from "./data";

// Deep copy the chart configurations to prevent mutation of original data
const simpleBubbleChart = reactive(JSON.parse(JSON.stringify(originalSimpleBubbleChart)));
const bubble3DChart = reactive(JSON.parse(JSON.stringify(originalBubble3DChart)));
</script>

<template>
  <Layout>
    <PageHeader title="Boxplot Charts" pageTitle="Apexcharts" />
    <BRow>
      <BCol lg="6">
        <BCard no-body>
          <BCardHeader class="
              justify-content-between
              d-flex
              align-items-center
            ">
            <BCardTitle>Basic Bubble Chart</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="simpleBubbleChart.series"
              :options="simpleBubbleChart.chartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>
      <BCol lg="6">
        <BCard no-body>
          <BCardHeader class="
              justify-content-between
              d-flex
              align-items-center
            ">
            <BCardTitle>3D Bubble Chart</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="bubble3DChart.series"
              :options="bubble3DChart.chartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>
  </Layout>
</template>
