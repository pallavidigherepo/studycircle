<script setup>
import * as echarts from "echarts";
import worldJson from "@/components/widgets/world.json"; // Adjust path if needed
import { onMounted } from "vue";

onMounted(() => {
  const chartElement = document.getElementById("users-by-country");

  if (!chartElement) return;

  const userChart = echarts.init(chartElement);

  echarts.registerMap("world", worldJson, {
    Alaska: { left: -131, top: 25, width: 15 },
    Hawaii: { left: -110, top: 28, width: 5 },
    "Puerto Rico": { left: -76, top: 26, width: 2 },
  });

  const userOption = {
    tooltip: {
      trigger: "item",
      showDelay: 0,
      transitionDuration: 0.2,
    },
    series: [
      {
        name: "World",
        type: "map",
        map: "world",
        label: {
          show: false,
        },
      },
    ],
  };

  userChart.setOption(userOption);
});
</script>
<template>
    <BCard no-body>
        <BCardHeader class="align-items-center d-flex">
            <BCardTitle class="mb-0 flex-grow-1">Worldwide Top Creators</BCardTitle>
            <div class="flex-shrink-0">
                <BButton type="button" variant="soft-primary" size="sm">
                    Export Report
                </BButton>
            </div>
        </BCardHeader>

        <BCardBody>

            <div id="users-by-country" style="height: 269px"></div>
            <div class="mt-1">
                <p class="mb-1 d-flex bd-highlight"><img src="@/assets/images/flags/us.svg" alt="" height="15" class="rounded bd-highlight me-2"> United
                    States <span class="ms-auto bd-highlight">34%</span></p>
                <p class="mb-1 d-flex bd-highlight"><img src="@/assets/images/flags/russia.svg" alt="" height="15" class="rounded bd-highlight me-2">
                    Russia <span class="ms-auto bd-highlight">27%</span></p>
                <p class="mb-1 d-flex bd-highlight"><img src="@/assets/images/flags/spain.svg" alt="" height="15" class="rounded bd-highlight me-2">
                    Spain
                    <span class="ms-auto bd-highlight">21%</span>
                </p>
                <p class="mb-1 d-flex bd-highlight"><img src="@/assets/images/flags/italy.svg" alt="" height="15" class="rounded bd-highlight me-2">
                    Italy
                    <span class="ms-auto bd-highlight">13%</span>
                </p>
                <p class="mb-0 d-flex bd-highlight"><img src="@/assets/images/flags/germany.svg" alt="" height="15" class="rounded bd-highlight me-2">
                    Germany <span class="ms-auto bd-highlight">5%</span></p>
            </div>
        </BCardBody>
    </BCard>
</template>