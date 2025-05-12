<script setup>
import { ref } from 'vue';

const series = ref([
  {
    data: [
      {
        x: new Date(1538778600000),
        y: [6629.81, 6650.5, 6623.04, 6633.33],
      },
      {
        x: new Date(1538780400000),
        y: [6632.01, 6643.59, 6620, 6630.11],
      },
      {
        x: new Date(1538782200000),
        y: [6630.71, 6648.95, 6623.34, 6635.65],
      },
      {
        x: new Date(1538784000000),
        y: [6635.65, 6651, 6629.67, 6638.24],
      },
      {
        x: new Date(1538785800000),
        y: [6638.24, 6640, 6620, 6624.47],
      },
      {
        x: new Date(1538787600000),
        y: [6624.53, 6636.03, 6621.68, 6624.31],
      },
      {
        x: new Date(1538789400000),
        y: [6624.61, 6632.2, 6617, 6626.02],
      },
      {
        x: new Date(1538791200000),
        y: [6627, 6627.62, 6584.22, 6603.02],
      },
      {
        x: new Date(1538793000000),
        y: [6605, 6608.03, 6598.95, 6604.01],
      },
      {
        x: new Date(1538794800000),
        y: [6604.5, 6614.4, 6602.26, 6608.02],
      },
      {
        x: new Date(1538796600000),
        y: [6608.02, 6610.68, 6601.99, 6608.91],
      },
      {
        x: new Date(1538798400000),
        y: [6608.91, 6618.99, 6608.01, 6612],
      },
      {
        x: new Date(1538800200000),
        y: [6612, 6615.13, 6605.09, 6612],
      },
      {
        x: new Date(1538802000000),
        y: [6612, 6624.12, 6608.43, 6622.95],
      },
      {
        x: new Date(1538803800000),
        y: [6623.91, 6623.91, 6615, 6615.67],
      },
      {
        x: new Date(1538805600000),
        y: [6618.69, 6618.74, 6610, 6610.4],
      },
      {
        x: new Date(1538807400000),
        y: [6611, 6622.78, 6610.4, 6614.9],
      },
      {
        x: new Date(1538809200000),
        y: [6614.9, 6626.2, 6613.33, 6623.45],
      },
      {
        x: new Date(1538811000000),
        y: [6623.48, 6627, 6618.38, 6620.35],
      },
      {
        x: new Date(1538812800000),
        y: [6619.43, 6620.35, 6610.05, 6615.53],
      },
      //...continue with rest of the data as is
    ],
  },
]);

const chartOptions = ref({
  chart: {
    type: 'candlestick',
    height: 294,
    toolbar: {
      show: false,
    },
  },
  plotOptions: {
    candlestick: {
      colors: {
        upward: '#0AB39C',
        downward: '#F06548',
      },
    },
  },
  xaxis: {
    type: 'datetime',
  },
  yaxis: {
    tooltip: {
      enabled: true,
    },
    labels: {
      formatter: function (value) {
        return '$' + value;
      },
    },
  },
  tooltip: {
    shared: true,
    y: [
      {
        formatter: function (y) {
          if (typeof y !== 'undefined') {
            return y.toFixed(0);
          }
          return y;
        },
      },
      {
        formatter: function (y) {
          if (typeof y !== 'undefined') {
            return '$' + y.toFixed(2) + 'k';
          }
          return y;
        },
      },
      {
        formatter: function (y) {
          if (typeof y !== 'undefined') {
            return y.toFixed(0) + ' Sales';
          }
          return y;
        },
      },
    ],
  },
});
</script>


<template>
  <BCard no-body>
    <BCardHeader class="border-0 align-items-center d-flex">
      <BCardTitle class="mb-0 flex-grow-1">Market Graph</BCardTitle>
      <div class="hstack gap-1">
        <BButton type="button" variant="soft-secondary" size="sm">1H</BButton>
        <BButton type="button" variant="soft-secondary" size="sm">7D</BButton>
        <BButton type="button" variant="soft-secondary" size="sm">1M</BButton>
        <BButton type="button" variant="soft-secondary" size="sm">1Y</BButton>
        <BButton type="button" variant="soft-primary" size="sm">ALL</BButton>
      </div>
    </BCardHeader>
    <BCardBody class="p-0">
      <div class="bg-light-subtle border-top-dashed border border-start-0 border-end-0 border-bottom-dashed py-3 px-4">
        <BRow class="align-items-center">
          <BCol cols="6">
            <div class="d-flex flex-wrap gap-4 align-items-center">
              <h5 class="fs-19 mb-0">0.014756</h5>
              <p class="fw-medium text-muted mb-0">
                $75.69 <span class="text-success fs-11 ms-1">+1.99%</span>
              </p>
              <p class="fw-medium text-muted mb-0">
                High <span class="text-body fs-11 ms-1">0.014578</span>
              </p>
              <p class="fw-medium text-muted mb-0">
                Low <span class="text-body fs-11 ms-1">0.0175489</span>
              </p>
            </div>
          </BCol>
          <BCol cols="6">
            <div class="d-flex">
              <div class="d-flex justify-content-end text-end flex-wrap gap-4 ms-auto">
                <div class="pe-3">
                  <h6 class="mb-2 text-truncate text-muted">Total Balance</h6>
                  <h5 class="mb-0">$72.8k</h5>
                </div>
                <div class="pe-3">
                  <h6 class="mb-2 text-muted">Profit</h6>
                  <h5 class="text-success mb-0">+$49.7k</h5>
                </div>
                <div class="pe-3">
                  <h6 class="mb-2 text-muted">Loss</h6>
                  <h5 class="text-danger mb-0">-$23.1k</h5>
                </div>
              </div>
            </div>
          </BCol>
        </BRow>
      </div>
    </BCardBody>
    <BCardBody class="p-0 pb-3">
      <apexchart class="apex-charts" height="294" dir="ltr" :series="series" :options="chartOptions"></apexchart>

    </BCardBody>
  </BCard>
</template>
