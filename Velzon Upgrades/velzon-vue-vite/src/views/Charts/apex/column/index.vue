<script setup>
import { reactive, computed } from 'vue';

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

// Reactive chart data (deep copied)
const charts = reactive({
  basicColumnChart: JSON.parse(JSON.stringify(basicColumnChart)),
  columnDatalabelChart: JSON.parse(JSON.stringify(columnDatalabelChart)),
  stackedColumnsChart: JSON.parse(JSON.stringify(stackedColumnsChart)),
  columnStackedChart: JSON.parse(JSON.stringify(columnStackedChart)),
  columnMarkersChart: JSON.parse(JSON.stringify(columnMarkersChart)),
  columnRotatedLabel: JSON.parse(JSON.stringify(columnRotatedLabel)),
  columnNegativeChart: JSON.parse(JSON.stringify(columnNegativeChart)),
  rangeColumnChart: JSON.parse(JSON.stringify(rangeColumnChart)),
  chartYearOptionChart: JSON.parse(JSON.stringify(chartYearOption)),
  quarterChartOptionChart: JSON.parse(JSON.stringify(quarterChartOption)),
  distributedColumnchart: JSON.parse(JSON.stringify(distributedColumnchart)),
  dynamicQuarterLoadedChart: JSON.parse(JSON.stringify(dynamicQuarterLoadedChart)),
  groupedStackedChart: JSON.parse(JSON.stringify(groupedStackedChart)),
  dumbbellChart: JSON.parse(JSON.stringify(dumbbellChart))
});

// Computed chart options and series
const computedChartProps = {};
for (const key in charts) {
  const base = key;
  computedChartProps[`${base}Options`] = computed(() => charts[base].chartOptions);
  computedChartProps[`${base}Series`] = computed(() => charts[base].series);
}
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
