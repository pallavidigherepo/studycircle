<script setup>
import { reactive } from 'vue';

import Layout from "@/layouts/main.vue";
import PageHeader from "@/components/page-header.vue";

import {
  basicCandlestickChart as originalBasicCandlestickChart,
  comboCandlestickBrushChart as originalComboCandlestickBrushChart,
  comboCandlestickChart as originalComboCandlestickChart,
  categoryXaxisChart as originalCategoryXaxisChart,
} from "./data";

// Create deep reactive copies
const basicCandlestickChart = reactive(JSON.parse(JSON.stringify(originalBasicCandlestickChart)));
const comboCandlestickBrushChart = reactive(JSON.parse(JSON.stringify(originalComboCandlestickBrushChart)));
const comboCandlestickChart = reactive(JSON.parse(JSON.stringify(originalComboCandlestickChart)));
const categoryXaxisChart = reactive(JSON.parse(JSON.stringify(originalCategoryXaxisChart)));
</script>

<template>
  <Layout>
    <PageHeader title="Candlestick Charts" pageTitle="Apexcharts" />
    <BRow>
      <BCol lg="6">
        <BCard no-body>
          <BCardHeader class="
              justify-content-between
              d-flex
              align-items-center
            ">
            <BCardTitle>Basic Candlestick Chart</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="basicCandlestickChart.series"
              :options="basicCandlestickChart.chartOptions"></apexchart>
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
            <BCardTitle>Candlestick Synced with Brush Chart (Combo)</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="200" dir="ltr" :series="comboCandlestickBrushChart.series"
              :options="comboCandlestickBrushChart.chartOptions"></apexchart>
            <apexchart class="apex-charts" height="150" dir="ltr" :series="comboCandlestickChart.series"
              :options="comboCandlestickChart.chartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <BRow>
      <BCol lg="6">
        <BCard no-body>
          <BCardHeader class="
              justify-content-between
              d-flex
              align-items-center
            ">
            <BCardTitle>Category X-Axis</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="categoryXaxisChart.series"
              :options="categoryXaxisChart.chartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>
  </Layout>
</template>