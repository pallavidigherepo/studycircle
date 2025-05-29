<script setup>
import { ref } from 'vue'
import { CountTo } from 'vue3-count-to'

const crmWidgets = ref([
  {
    id: 1,
    label: "Campaign Sent",
    badge: "ri-arrow-up-circle-line text-success",
    icon: "ri-space-ship-line",
    counter: 197,
    decimals: 0,
    suffix: "",
    prefix: "",
  },
  {
    id: 2,
    label: "Annual Profit",
    badge: "ri-arrow-up-circle-line text-success",
    icon: "ri-exchange-dollar-line",
    counter: 489.4,
    decimals: 1,
    suffix: "K",
    prefix: "$",
  },
  {
    id: 3,
    label: "Lead Conversation",
    badge: "ri-arrow-down-circle-line text-danger",
    icon: "ri-pulse-line",
    counter: 32.89,
    decimals: 2,
    suffix: "%",
    prefix: "",
  },
  {
    id: 4,
    label: "Daily Average Income",
    badge: "ri-arrow-up-circle-line text-success",
    icon: "ri-trophy-line",
    counter: 1596.5,
    decimals: 1,
    prefix: "$",
    separator: ",",
    suffix: "",
  },
  {
    id: 5,
    label: "Annual Deals",
    badge: "ri-arrow-down-circle-line text-danger",
    icon: "ri-service-line",
    counter: 2659,
    decimals: 0,
    separator: ",",
    suffix: "",
    prefix: "",
  },
])
</script>


<template>
  <BRow>
    <BCol xl="12">
      <BCard no-body class="crm-widget">
        <BCardBody class="p-0">
          <BRow class="row-cols-md-3 row-cols-1">
            <BCol
              v-for="(widget, index) in crmWidgets"
              :key="widget.id"
              lg
              :class="index !== crmWidgets.length - 1 ? 'border-end' : ''"
            >
              <div class="py-4 px-3" :class="{ 'mt-3 mt-md-0': index !== 0, 'mt-lg-0': index >= 3 }">
                <h5 class="text-muted text-uppercase fs-13 d-flex align-items-center justify-content-between">
                  {{ widget.label }}
                  <i :class="`${widget.badge} fs-18 ms-2`"></i>
                </h5>
                <div class="d-flex align-items-center">
                  <div class="flex-shrink-0">
                    <i :class="`${widget.icon} display-6 text-muted`"></i>
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <h2 class="mb-0">
                      {{ widget.prefix }}
                      <count-to
                        :startVal="0"
                        :endVal="widget.counter"
                        :duration="5000"
                        :decimals="widget.decimals || 0"
                        :separator="widget.separator || ''"
                      />
                      {{ widget.suffix }}
                    </h2>
                  </div>
                </div>
              </div>
            </BCol>
          </BRow>
        </BCardBody>
      </BCard>
    </BCol>
  </BRow>
</template>



<style setup>


</style>
