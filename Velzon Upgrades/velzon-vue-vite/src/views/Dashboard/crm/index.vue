<script setup>
import Layout from "@/layouts/main.vue"
import PageHeader from "@/components/page-header.vue"

import Widget from "./widget.vue"
import SalesForecast from "./forecast.vue"
import DealType from "./deal-type.vue"
import BalanceOverview from "./balance-overview.vue"
import DealStatus from "./deals-status.vue"
import Tasks from "./tasks.vue"
import UpcomingActivity from "./activities.vue"
import ClosingDeals from "./closing-deals.vue"
</script>


<template>
  <Layout>
    <PageHeader title="CRM" pageTitle="Dashboards" />
    
    <BRow>
      <BCol xl="12">
        <Widget />
      </BCol>
    </BRow>

    <BRow class="align-items-stretch">
      <BCol xxl="3" md="6" class="h-100">
        <div class="h-100 d-flex flex-column">
          <SalesForecast class="h-100 w-100" />
        </div>
      </BCol>

      <BCol xxl="3" md="6" class="h-100">
        <div class="h-100 d-flex flex-column">
          <DealType class="h-100 w-100" />
        </div>
      </BCol>

      <BCol xxl="6" class="h-100">
        <div class="h-100 d-flex flex-column">
          <BalanceOverview class="h-100 w-100" />
        </div>
      </BCol>
    </BRow>

    <BRow>
      <BCol xl="7">
          <DealStatus />
      </BCol>
      <BCol xl="5">
          <Tasks />
      </BCol>
    </BRow>
    <BRow>
      <BCol xxl="5">
          <UpcomingActivity />
      </BCol>
      <BCol xxl="7">
          <ClosingDeals />
      </BCol>
    </BRow>
  </Layout>
</template>
