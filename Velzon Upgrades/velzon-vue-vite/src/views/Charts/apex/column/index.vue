<script setup>
import { ref, computed } from "vue";
import Layout from "@/layouts/main.vue";
import PageHeader from "@/components/page-header.vue";

import {
  basicColumnChart,
  columnDatalabelChart,
  stackedColumnsChart,
  columnStackedChart,
  columnMarkersChart,
  columnRotatedLabel,
  columnNegativeChart,
  rangeColumnChart,
  chartYearOption,
  quarterChartOption,
  distributedColumnchart,
  dynamicQuarterLoadedChart,
  groupedStackedChart,
  dumbbellChart
} from "./data";

// Refs with deep clones to preserve reactivity and immutability
const basicColumnChartRef = ref(JSON.parse(JSON.stringify(basicColumnChart)));
const columnDatalabelChartRef = ref(JSON.parse(JSON.stringify(columnDatalabelChart)));
const stackedColumnsChartRef = ref(JSON.parse(JSON.stringify(stackedColumnsChart)));
const columnStackedChartRef = ref(JSON.parse(JSON.stringify(columnStackedChart)));
const columnMarkersChartRef = ref(JSON.parse(JSON.stringify(columnMarkersChart)));
const columnRotatedLabelRef = ref(JSON.parse(JSON.stringify(columnRotatedLabel)));
const columnNegativeChartRef = ref(JSON.parse(JSON.stringify(columnNegativeChart)));
const rangeColumnChartRef = ref(JSON.parse(JSON.stringify(rangeColumnChart)));
const chartYearOptionChartRef = ref(JSON.parse(JSON.stringify(chartYearOption)));
const quarterChartOptionChartRef = ref(JSON.parse(JSON.stringify(quarterChartOption)));
const distributedColumnchartRef = ref(JSON.parse(JSON.stringify(distributedColumnchart)));
const dynamicQuarterLoadedChartRef = ref(JSON.parse(JSON.stringify(dynamicQuarterLoadedChart)));
const groupedStackedChartRef = ref(JSON.parse(JSON.stringify(groupedStackedChart)));
const dumbbellChartRef = ref(JSON.parse(JSON.stringify(dumbbellChart)));

// Computed properties
const basicColumnChartOptions = computed(() => basicColumnChartRef.value.chartOptions);
const basicColumnChartSeries = computed(() => basicColumnChartRef.value.series);

const columnDatalabelChartOptions = computed(() => columnDatalabelChartRef.value.chartOptions);
const columnDatalabelChartSeries = computed(() => columnDatalabelChartRef.value.series);

const stackedColumnsChartOptions = computed(() => stackedColumnsChartRef.value.chartOptions);
const stackedColumnsChartSeries = computed(() => stackedColumnsChartRef.value.series);

const columnStackedChartOptions = computed(() => columnStackedChartRef.value.chartOptions);
const columnStackedChartSeries = computed(() => columnStackedChartRef.value.series);

const columnMarkersChartOptions = computed(() => columnMarkersChartRef.value.chartOptions);
const columnMarkersChartSeries = computed(() => columnMarkersChartRef.value.series);

const columnRotatedLabelOptions = computed(() => columnRotatedLabelRef.value.chartOptions);
const columnRotatedLabelSeries = computed(() => columnRotatedLabelRef.value.series);

const columnNegativeChartOptions = computed(() => columnNegativeChartRef.value.chartOptions);
const columnNegativeChartSeries = computed(() => columnNegativeChartRef.value.series);

const rangeColumnChartOptions = computed(() => rangeColumnChartRef.value.chartOptions);
const rangeColumnChartSeries = computed(() => rangeColumnChartRef.value.series);

const chartYearOptionOptions = computed(() => chartYearOptionChartRef.value.chartOptions);
const chartYearSeries = computed(() => chartYearOptionChartRef.value.series);

const quarterChartOptions = computed(() => quarterChartOptionChartRef.value.chartOptions);
const quarterChartSeries = computed(() => quarterChartOptionChartRef.value.series);

const distributedColumnchartOptions = computed(() => distributedColumnchartRef.value.chartOptions);
const distributedColumnchartSeries = computed(() => distributedColumnchartRef.value.series);

const dynamicQuarterLoadedChartOptions = computed(() => dynamicQuarterLoadedChartRef.value.chartOptions);
const dynamicQuarterLoadedChartSeries = computed(() => dynamicQuarterLoadedChartRef.value.series);

const groupedStackedChartOptions = computed(() => groupedStackedChartRef.value.chartOptions);
const groupedStackedChartSeries = computed(() => groupedStackedChartRef.value.series);

const dumbbellChartOptions = computed(() => dumbbellChartRef.value.chartOptions);
const dumbbellChartSeries = computed(() => dumbbellChartRef.value.series);
</script>



<template>
  <Layout>
    <PageHeader title="Column Charts" pageTitle="Apexcharts" />
    <BRow>
      <BCol lg="6">
        <BCard no-body>
          <BCardHeader class="
              justify-content-between
              d-flex
              align-items-center
            ">
            <BCardTitle>Basic Column Charts</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="basicColumnChartSeries"
              :options="basicColumnChartOptions"></apexchart>
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
            <BCardTitle>Column with Data Labels</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="columnDatalabelChartSeries"
              :options="columnDatalabelChartOptions"></apexchart>
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
            <BCardTitle>Stacked Column Charts</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="stackedColumnsChartSeries"
              :options="stackedColumnsChartOptions"></apexchart>
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
            <BCardTitle>Stacked Column 100</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="columnStackedChartSeries"
              :options="columnStackedChartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>
    <BRow>
      <BCol xl="6">
        <BCard no-body>
          <BCardHeader>
            <BCardTitle class="mb-0">Grouped Stacked Columns</BCardTitle>
          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="groupedStackedChartSeries"
              :options="groupedStackedChartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>

      <BCol xl="6">
        <BCard no-body>
          <BCardHeader>
            <BCardTitle class="mb-0">Dumbbell Chart</BCardTitle>
          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="dumbbellChartSeries"
              :options="dumbbellChartOptions"></apexchart>
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
            <BCardTitle>Column with Markers</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="columnMarkersChartSeries"
              :options="columnMarkersChartOptions"></apexchart>
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
            <BCardTitle>Column with Rotated Labels</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="columnRotatedLabelSeries"
              :options="columnRotatedLabelOptions"></apexchart>
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
            <BCardTitle>Column with Nagetive Values</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="columnNegativeChartSeries"
              :options="columnNegativeChartOptions"></apexchart>
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
            <BCardTitle>Range Column Chart</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="rangeColumnChartSeries"
              :options="rangeColumnChartOptions"></apexchart>
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
            <BCardTitle>Dynamic Loaded Chart</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <div id="dynamicloadedchart-wrap">
              <div id="chart-year">
                <apexchart type="bar" height="330" ref="chart" :options="chartYearOption"
                  :series="chartYearSeries"></apexchart>
              </div>
              <div id="chart-quarter">
                <apexchart type="bar" height="330" ref="chartQuarter" :options="dynamicQuarterLoadedChartOptions"
                  :series="dynamicQuarterLoadedChartSeries"></apexchart>
              </div>
            </div>
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
            <BCardTitle>Distributed Columns Charts</BCardTitle>

          </BCardHeader>
          <BCardBody>
            <apexchart class="apex-charts" height="350" dir="ltr" :series="distributedColumnchartSeries"
              :options="distributedColumnchartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>
  </Layout>
</template>
