<script setup>
import { reactive, computed } from 'vue';
import Layout from "@/layouts/main.vue";
import PageHeader from "@/components/page-header.vue";

import { basicRangeAreaChart, comboChart } from "./data";

const state = reactive({
  basicRangeAreaChart: JSON.parse(JSON.stringify(basicRangeAreaChart)),
  comboChart: JSON.parse(JSON.stringify(comboChart)),
});

const chartOptions = computed(() => {
  return JSON.parse(JSON.stringify(state.basicRangeAreaChart.chartOptions));
});

const chartSeries = computed(() => {
  return JSON.parse(JSON.stringify(state.basicRangeAreaChart.series));
});

const comboChartOptions = computed(() => {
  return JSON.parse(JSON.stringify(state.comboChart.chartOptions));
});

const comboChartSeries = computed(() => {
  return JSON.parse(JSON.stringify(state.comboChart.series));
});
</script>

<template>
  <Layout>
    <PageHeader title="Range Area Charts" pageTitle="Apexcharts" />
    <BRow>
      <BCol xl="6">
        <BCard no-body>
          <BCardHeader>
            <BCardTitle class="mb-0">Basic Range Area Chart</BCardTitle>
          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="chartSeries" :options="chartOptions">
            </apexchart>
          </BCardBody>
        </BCard>
      </BCol>


      <BCol xl="6">
        <BCard no-body>
          <BCardHeader>
            <BCardTitle class="mb-0">Combo</BCardTitle>
          </BCardHeader>
          <BCardBody>
            <div>
              <apexchart class="apex-charts" height="350" dir="ltr" :series="comboChartSeries"
                :options="comboChartOptions"></apexchart>
            </div>
          </BCardBody>
        </BCard>
      </BCol>
      
    </BRow>
  </Layout>
</template>