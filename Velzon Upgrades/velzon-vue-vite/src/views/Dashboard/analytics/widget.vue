<script setup>
import { CountTo } from "vue3-count-to";

import {
  UsersIcon,
  ActivityIcon,
  ClockIcon,
  ExternalLinkIcon,
} from "@zhuowenli/vue-feather-icons";
</script>

<template>
   <BRow>
      <BCol md="6">
        <BCard no-body class="card-animate">
          <BCardBody>
            <div class="d-flex justify-content-between">
              <div>
                <p class="fw-medium text-muted mb-0">Users</p>
                <h2 class="mt-4 ff-secondary fw-semibold">
                  <count-to :startVal="0" :endVal="28.05" :duration="5000" :decimals="2"></count-to>k
                </h2>
                <p class="mb-0 text-muted">
                  <BBadge class="bg-light text-success mb-0">
                    <i class="ri-arrow-up-line align-middle"></i> 16.24 %
                  </BBadge>
                  vs. previous month
                </p>
              </div>
              <div>
                <div class="avatar-sm flex-shrink-0">
                  <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                    <UsersIcon class="text-info"></UsersIcon>
                  </span>
                </div>
              </div>
            </div>
          </BCardBody>

        </BCard>

      </BCol>


      <BCol md="6">
        <BCard no-body class="card-animate">
          <BCardBody>
            <div class="d-flex justify-content-between">
              <div>
                <p class="fw-medium text-muted mb-0">Sessions</p>
                <h2 class="mt-4 ff-secondary fw-semibold">
                  <count-to :startVal="0" :endVal="97.66" :duration="5000" :decimals="2"></count-to>k
                </h2>
                <p class="mb-0 text-muted">
                  <BBadge class="bg-light text-danger mb-0">
                    <i class="ri-arrow-down-line align-middle"></i> 3.96 %
                  </BBadge>
                  vs. previous month
                </p>
              </div>
              <div>
                <div class="avatar-sm flex-shrink-0">
                  <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                    <ActivityIcon class="text-info"></ActivityIcon>
                  </span>
                </div>
              </div>
            </div>
          </BCardBody>

        </BCard>

      </BCol>

    </BRow>
    
    <BRow>
      <BCol md="6">
      <BCard no-body class="card-animate">
        <BCardBody>
          <div class="d-flex justify-content-between">
            <div>
              <p class="fw-medium text-muted mb-0">Avg. Visit Duration</p>
              <h2 class="mt-4 cfs-22 ff-secondary fw-semibold">
                <CountTo :startVal="0" :endVal="3" :duration="5000" />m
                <CountTo :startVal="0" :endVal="40" :duration="5000" />sec
              </h2>
              <p class="mb-0 text-muted">
                <BBadge class="bg-light text-danger mb-0">
                  <i class="ri-arrow-down-line align-middle"></i> 0.24 %
                </BBadge>
                vs. previous month
              </p>
            </div>
            <div>
              <div class="avatar-sm flex-shrink-0">
                <span class="avatar-title bg-info-subtle rounded-circle ">
                  <ClockIcon class="text-info" ></ClockIcon>
                </span>
              </div>
            </div>
          </div>
        </BCardBody>
      </BCard>
    </BCol>
     
      <BCol md="6">
        <BCard no-body class="card-animate">
          <BCardBody>
            <div class="d-flex justify-content-between">
              <div>
                <p class="fw-medium text-muted mb-0">Bounce Rate</p>
                <h2 class="mt-4 ff-secondary fw-semibold">
                  <count-to :startVal="0" :endVal="33.48" :duration="5000" :decimals="2"></count-to>%
                </h2>
                <p class="mb-0 text-muted">
                  <BBadge class="bg-light text-success mb-0">
                    <i class="ri-arrow-up-line align-middle"></i> 7.05 %
                  </BBadge>
                  vs. previous month
                </p>
              </div>
              <div>
                <div class="avatar-sm flex-shrink-0">
                  <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                    <ExternalLinkIcon class="text-info"></ExternalLinkIcon>
                  </span>
                </div>
              </div>
            </div>
          </BCardBody>

        </BCard>

      </BCol>

    </BRow>
</template>
