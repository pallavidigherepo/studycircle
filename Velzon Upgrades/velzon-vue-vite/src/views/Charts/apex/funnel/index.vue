<script setup>
import { reactive } from 'vue';

import Layout from "@/layouts/main.vue";
import PageHeader from "@/components/page-header.vue";

import { funnelChart, pyramidChart } from "./data";

// Reactive chart data
const chartData = reactive({
  funnelChart,
  pyramidChart
});
</script>

<template>
  <Layout>
    <PageHeader title="Funnel Charts" pageTitle="Apexcharts" />
    <BRow>
      <BCol xl="6">
        <BCard no-body>
          <BCardHeader>
            <BCardTitle class="mb-0">Funnel Chart</BCardTitle>
          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="funnelChart.series"
              :options="funnelChart.chartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>

      <BCol xl="6">
        <BCard no-body>
          <BCardHeader>
            <BCardTitle class="mb-0">Pyramid</BCardTitle>
          </BCardHeader>
          <BCardBody>
            <div>
              <apexchart class="apex-charts" height="350" dir="ltr" :series="pyramidChart.series"
              :options="pyramidChart.chartOptions"></apexchart>
            </div>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>
  </Layout>
</template>