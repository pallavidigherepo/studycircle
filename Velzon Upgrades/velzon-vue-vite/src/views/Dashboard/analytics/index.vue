<script setup>
import { AlertTriangleIcon } from '@zhuowenli/vue-feather-icons';
import Layout from "@/layouts/main.vue";
import PageHeader from "@/components/page-header.vue";

import Widget from "./widget.vue";
import AudiencesMetrics from "./audiences-metrics.vue";
import AudiencesSessions from "./audiences-sessions.vue";
import Country from "./country.vue";
import Referrals from "./referrals.vue";
import SessionsCounties from "./sessions-countries.vue";
import TopPages from "./top-pages.vue";
import Users from "./users.vue";

// No need to define components here; they are imported and automatically registered in the template
</script>

<template>
  <Layout>
    <PageHeader title="Analytics" pageTitle="Dashboards" />

    <BRow class="h-100">
      <BCol xxl="5">
        <BRow>
          <BCol xl="12" class="d-flex mb-4">
            <BCard no-body class="h-100 ">
              <BCardBody class="p-0 h-100 d-flex flex-column">
                <BAlert
                  variant="warning"
                  class="border-0 rounded-top rounded-0 m-0 d-flex align-items-center justify-content-between gap-2 flex-wrap"
                  show
                >
                  <alert-triangle-icon class="text-warning icon-sm me-2"></alert-triangle-icon>
                  <span class="text-truncate text-nowrap flex-grow-1">
                    Your free trial expired in <b>17</b> days.
                  </span>
                  <router-link
                    to="/pages/profile"
                    class="text-reset text-decoration-underline fw-bold flex-shrink-0 text-nowrap"
                  >
                    Upgrade
                  </router-link>
                </BAlert>

                <BRow class="align-items-end">
                  <BCol sm="8">
                    <div class="p-3">
                      <p class="fs-16 lh-base">
                        Upgrade your plan from a
                        <span class="fw-semibold">Free trial</span>, to ‘Premium
                        Plan’ 
                      </p><i class="mdi mdi-arrow-right"></i>
                      <div class="mt-3">
                        <router-link to="/pages/profile" class="btn btn-success">Upgrade Account!</router-link>
                      </div>
                    </div>
                  </BCol>
                  <BCol sm="4">
                    <div class="px-3">
                      <img src="@/assets/images/user-illustarator-2.png" class="img-fluid" alt="" />
                    </div>
                  </BCol>
                </BRow>
              </BCardBody>

            </BCard>
          </BCol>
        </BRow>
        
        <Widget />
        
      </BCol>
      <BCol xxl="7">
        <BRow class="h-100">
          <BCol xl="6" class="d-flex">
            <Country class="w-100" />
          </BCol>
          <BCol xl="6" class="d-flex">
            <SessionsCounties  class="w-100"/>
          </BCol>
        </BRow>
      </BCol>
    </BRow>
    
    <BRow class="h-100">
      <BCol xl="6">
        <AudiencesMetrics />
      </BCol>
      <BCol xl="6">
        <AudiencesSessions />
      </BCol>
    </BRow>

    <BRow class="h-100">
      <BCol xl="4" class="d-flex">
        <Users class="w-100" />
      </BCol>
      <BCol xl="4" class="d-flex">
        <Referrals class="w-100" />
      </BCol>
      <BCol xl="4" class="d-flex">
        <TopPages class="w-100" />
      </BCol>
    </BRow>
  </Layout>
</template>
<!-- <style scoped>
.card-body {
  display: flex;
  flex-direction: column;
  height: 100%;
}
</style> -->