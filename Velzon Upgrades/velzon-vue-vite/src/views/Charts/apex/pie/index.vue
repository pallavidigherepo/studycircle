<script setup>
import { reactive } from "vue";
import Layout from "@/layouts/main.vue";
import PageHeader from "@/components/page-header.vue";

import {
  simplePieChart,
  donutChart,
  updatingDonutChart,
  gradientDonutChart,
  patternDonutChart,
  imagePieChart,
  monochromePieChart,
} from "./data";

// Make a reactive copy of updatingDonutChart so we can update series dynamically
const charts = reactive({
  simplePieChart,
  donutChart,
  updatingDonutChart: { ...updatingDonutChart }, // shallow copy to enable reactivity
  gradientDonutChart,
  patternDonutChart,
  imagePieChart,
  monochromePieChart,
});

function appendData() {
  const arr = [...charts.updatingDonutChart.series];
  arr.push(Math.floor(Math.random() * 100) + 1);
  charts.updatingDonutChart.series = arr;
}

function removeData() {
  if (charts.updatingDonutChart.series.length === 1) return;
  const arr = [...charts.updatingDonutChart.series];
  arr.pop();
  charts.updatingDonutChart.series = arr;
}

function randomize() {
  charts.updatingDonutChart.series = charts.updatingDonutChart.series.map(() =>
    Math.floor(Math.random() * 100) + 1
  );
}

function reset() {
  charts.updatingDonutChart.series = [44, 55, 13, 33];
}
</script>

<template>
  <Layout>
    <PageHeader title="Pie Charts" pageTitle="Apexcharts" />
    <BRow>
      <BCol lg="6">
        <BCard no-body>
          <BCardHeader class="justify-content-between d-flex align-items-center">
            <BCardTitle>Simple Pie Chart</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="300" dir="ltr" :series="simplePieChart.series"
              :options="simplePieChart.chartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>
      <BCol lg="6">
        <BCard no-body>
          <BCardHeader class="justify-content-between d-flex align-items-center">
            <BCardTitle>Simple Donut Chart</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="300" dir="ltr" :series="donutChart.series"
              :options="donutChart.chartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <BRow>
      <BCol lg="6">
        <BCard no-body>
          <BCardHeader class="justify-content-between d-flex align-items-center">
            <BCardTitle>Updating Donut Chart</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="300" dir="ltr" :series="updatingDonutChart.series"
              :options="updatingDonutChart.chartOptions"></apexchart>

            <div class="d-flex align-items-start flex-wrap gap-2 justify-content-center mt-4">
              <BButton id="add" variant="light" size="sm" @click="appendData">
                + ADD
              </BButton>

              <BButton id="remove" variant="light" size="sm" @click="removeData">
                - REMOVE
              </BButton>

              <BButton id="randomize" variant="light" size="sm" @click="randomize">
                RANDOMIZE
              </BButton>

              <BButton id="reset" variant="light" size="sm" @click="reset">
                RESET
              </BButton>
            </div>
          </BCardBody>
        </BCard>
      </BCol>
      <BCol lg="6">
        <BCard no-body>
          <BCardHeader class="justify-content-between d-flex align-items-center">
            <BCardTitle>Monochrome Pie Chart</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="300" dir="ltr" :series="monochromePieChart.series"
              :options="monochromePieChart.chartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <BRow>
      <BCol lg="6">
        <BCard no-body>
          <BCardHeader class="justify-content-between d-flex align-items-center">
            <BCardTitle>Gradient Donut Chart</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="300" dir="ltr" :series="gradientDonutChart.series"
              :options="gradientDonutChart.chartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>
      <BCol lg="6">
        <BCard no-body>
          <BCardHeader class="justify-content-between d-flex align-items-center">
            <BCardTitle>Patterned Donut Chart</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="300" dir="ltr" :series="patternDonutChart.series"
              :options="patternDonutChart.chartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <BRow>
      <BCol lg="6">
        <BCard no-body>
          <BCardHeader class="justify-content-between d-flex align-items-center">
            <BCardTitle>Pie Chart with Image Fill</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="300" dir="ltr" :series="imagePieChart.series"
              :options="imagePieChart.chartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>
  </Layout>
</template>
