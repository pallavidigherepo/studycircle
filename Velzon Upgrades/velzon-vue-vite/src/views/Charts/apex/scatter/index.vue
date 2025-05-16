<script setup>
import Layout from "@/layouts/main.vue";
import PageHeader from "@/components/page-header.vue";

import {
  basicScatterChart,
  dateTimeScatterChart,
  scatterImagesChart,
} from "./data";

const basicScatterChartData = basicScatterChart;
const dateTimeScatterChartData = dateTimeScatterChart;
const scatterImagesChartData = scatterImagesChart;
</script>

<template>
  <Layout>
    <PageHeader title="Scatter Charts" pageTitle="Apexcharts" />
    <BRow>
      <BCol lg="6">
        <BCard no-body>
          <BCardHeader class="justify-content-between d-flex align-items-center">
            <BCardTitle>Basic Scatter Chart</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="basicScatterChart.series"
              :options="basicScatterChart.chartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>
      <BCol lg="6">
        <BCard no-body>
          <BCardHeader class="justify-content-between d-flex align-items-center">
            <BCardTitle>Scatter - Datetime Chart</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="dateTimeScatterChart.series"
              :options="dateTimeScatterChart.chartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <BRow>
      <BCol lg="6">
        <BCard no-body>
          <BCardHeader class="justify-content-between d-flex align-items-center">
            <BCardTitle>Scatter Images Chart</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="scatterImagesChart.series"
              :options="scatterImagesChart.chartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>
  </Layout>
</template>
