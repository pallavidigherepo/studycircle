<script setup>
import { ref, reactive } from 'vue'
import Slider from '@vueform/slider'
import Layout from '@/layouts/main.vue'
import PageHeader from '@/components/page-header.vue';

// Simple value
const simpleValue = ref(10)
const sliderCustomzie = ref(300)

// Slider with label and ranges
const sliderWithLabel = reactive({
  value: 45,
  data: [15, 30, 45, 60, 75, 90, 120],
  range: [
    { label: "15 mins" },
    { label: "30 mins", isHide: true },
    { label: "45 mins" },
    { label: "1 hr", isHide: true },
    { label: "1 hr 15 mins" },
    { label: "1 hr 30 mins", isHide: true },
    { label: "2 hrs" },
  ],
  rangeValue: {}
})

// Other reactive data
const value = ref([20, 30, 40])
const merge = ref(10)
const format = reactive({
  prefix: "$",
  decimals: 2,
})
const loader = ref(null)
const loadingValue = ref(0)
const customStyle = ref(50)
const stepData = ref(10)
const rtlvalue = ref(50)
const orientation = ref("vertical")
const direction = ref("rtl")

// Methods
function callbackRange(val) {
  sliderWithLabel.rangeValue = val
}

function startLoad() {
  loader.value = setInterval(() => {
    loadingValue.value++
    if (loadingValue.value === 100) {
      clearInterval(loader.value)
    }
  }, 100)
}
</script>


<template>
  <Layout>
    <PageHeader title="Range Slider" pageTitle="Forms" />
    <BRow>
      <BCol cols="12">
        <BCard no-body>
          <BCardBody>
            <BCardTitle>Range slider</BCardTitle>
            <p class="card-title-desc">
              Cool, comfortable, responsive and easily customizable range slider
            </p>
            <BRow>
              <BCol md="6">
                <div class="p-3">
                  <h5 class="font-size-14 mb-5 mt-0">Default</h5>
                  <div class="p-3">
                    <Slider v-model="simpleValue" />
                  </div>
                </div>
              </BCol>
              <BCol md="6">
                <div class="p-3">
                  <h5 class="font-size-14 mb-5 mt-0">Min-Max</h5>
                  <div class="p-3">
                    <Slider v-model="sliderCustomzie" :min="100" :max="500" />
                  </div>
                </div>
              </BCol>
            </BRow>
            <BRow>
              <BCol md="6">
                <div class="p-3">
                  <h5 class="font-size-14 mb-5 mt-0">Range and Label</h5>
                  <div class="p-3">
                    <Slider v-model="sliderWithLabel.value" :data="sliderWithLabel.data" :range="sliderWithLabel.range"
                      @callbackRange="callbackRange" />
                  </div>
                </div>
              </BCol>
              <BCol md="6">
                <div class="p-3">
                  <h5 class="font-size-14 mb-5 mt-0">Loading</h5>
                  <div class="p-3">
                    <Slider v-model="loadingValue" :is-disabled="true" class="slider-red" />
                    <br />
                    <BButton size="sm" variant="light" @click="startLoad">Start</BButton>
                  </div>
                </div>
              </BCol>
            </BRow>
            <BRow>
              <BCol md="6">
                <div class="p-3">
                  <h5 class="font-size-14 mb-4 mt-0">Rtl</h5>
                  <div class="p-3">
                    <Slider v-model="rtlvalue" :direction="direction" :orientation="orientation" />
                  </div>
                </div>
              </BCol>
              <BCol md="6">
                <div class="p-3">
                  <h5 class="font-size-14 mb-5 mt-0">Format</h5>
                  <div class="p-3">
                    <Slider v-model="value" :merge="merge" :format="format" />
                  </div>
                </div>
              </BCol>
            </BRow>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>
  </Layout>
</template>
<style lang="scss">
@import '@vueform/slider/themes/default.css';
</style>
