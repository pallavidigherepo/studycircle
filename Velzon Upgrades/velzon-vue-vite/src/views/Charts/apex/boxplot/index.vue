<script setup>
import { reactive, computed } from 'vue';

import Layout from "@/layouts/main.vue";
import PageHeader from "@/components/page-header.vue";

import { boxChart as originalBoxChart, boxplotScatterChart as originalBoxplotScatterChart } from "./data";

// Create deep copies of chart configurations to avoid mutation
const boxChart = reactive(JSON.parse(JSON.stringify(originalBoxChart)));
const boxplotScatterChart = reactive(JSON.parse(JSON.stringify(originalBoxplotScatterChart)));

const boxChartOptions = computed(() => JSON.parse(JSON.stringify(boxChart.chartOptions)));
const boxChartSeries = computed(() => JSON.parse(JSON.stringify(boxChart.series)));

const boxplotScatterChartOptions = computed(() => JSON.parse(JSON.stringify(boxplotScatterChart.chartOptions)));
const boxplotScatterChartSeries = computed(() => JSON.parse(JSON.stringify(boxplotScatterChart.series)));
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
            <BCardTitle>Basic Box Chart</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="boxChartSeries"
              :options="boxChartOptions"></apexchart>
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
            <BCardTitle>Boxplot with Scatter Chart</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="boxplotScatterChartSeries"
              :options="boxplotScatterChartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>
  </Layout>
</template>