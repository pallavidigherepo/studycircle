<script setup>
import Layout from "../../../layouts/main.vue";
import PageHeader from "@/components/page-header.vue";
import Vue3ChartJs from "@j-t-mcc/vue3-chartjs";

import { line, pie, Doughnut, radar, bar, PolarArea } from "./data";

// You can directly expose them as `const` for the template
const lineChart = line;
const pieChart = pie;
const doughnutChart = Doughnut;
const radarChart = radar;
const barChart = bar;
const polarAreaChart = PolarArea;
</script>

<template>
  <Layout>
    <PageHeader title="Chartjs" pageTitle="Charts" />
    <BRow>
      <BCol lg="6">
        <BCard no-body>
          <BCardBody>
            <BCardTitle class="mb-4">Line Chart</BCardTitle>
            <vue3-chart-js class="chartjs-chart" v-bind="{ ...line }"></vue3-chart-js>
          </BCardBody>
        </BCard>
      </BCol>
      <BCol lg="6">
        <BCard no-body>
          <BCardBody>
            <BCardTitle class="mb-4">Bar Chart</BCardTitle>

            <vue3-chart-js class="chartjs-chart" v-bind="{ ...bar }"></vue3-chart-js>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <BRow>
      <BCol lg="6">
        <BCard no-body>
          <BCardBody>
            <BCardTitle class="mb-4">Pie Chart</BCardTitle>

            <vue3-chart-js :height="140" class="chartjs-chart" v-bind="{ ...pie }"></vue3-chart-js>
          </BCardBody>
        </BCard>
      </BCol>
      <BCol lg="6">
        <BCard no-body>
          <BCardBody>
            <BCardTitle class="mb-4">Donut Chart</BCardTitle>

            <vue3-chart-js :height="140" class="chartjs-chart" v-bind="{ ...Doughnut }"></vue3-chart-js>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <BRow>
      <BCol lg="6">
        <BCard no-body>
          <BCardBody>
            <BCardTitle class="mb-4">Polar area Chart</BCardTitle>

            <vue3-chart-js :height="140" class="chartjs-chart" v-bind="{ ...PolarArea }"></vue3-chart-js>
          </BCardBody>
        </BCard>
      </BCol>
      <BCol lg="6">
        <BCard no-body>
          <BCardBody>
            <BCardTitle class="mb-4">Radar Chart</BCardTitle>

            <vue3-chart-js :height="140" class="chartjs-chart" v-bind="{ ...radar }"></vue3-chart-js>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>
  </Layout>
</template>