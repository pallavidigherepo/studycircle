<script setup>
import Layout from "../../../layouts/main.vue"
import PageHeader from "@/components/page-header.vue"

import Basic from "./basic.vue"
import Boundary from "./boundary.vue"
import Icons from "./icons.vue"
import Geometry from "./geometry.vue"
import Markers from "./markers.vue"
</script>


<template>
  <Layout>
    <PageHeader title="Leaflet" pageTitle="Maps" />

    <BRow>
      <BCol lg="6">
        <BCard no-body>
          <BCardBody>
            <BCardTitle class="mb-4">Example</BCardTitle>
            <Basic class="leaflet-map" />
          </BCardBody>
        </BCard>
      </BCol>
      <BCol lg="6">
        <BCard no-body>
          <BCardBody>
            <BCardTitle class="mb-4">Fixed Bounds</BCardTitle>
            <Boundary class="leaflet-map" />
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>
    <BRow>
      <BCol lg="6">
        <BCard no-body>
          <BCardBody>
            <BCardTitle class="mb-4">Custom Icon Example</BCardTitle>
            <Icons class="leaflet-map" />
          </BCardBody>
        </BCard>
      </BCol>
      <BCol lg="6">
        <BCard no-body>
          <BCardBody>
            <BCardTitle class="mb-4">Geometry Example</BCardTitle>
            <Geometry class="leaflet-map" />
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>
    <BRow>
      <BCol lg="6">
        <BCard no-body>
          <BCardBody>
            <BCardTitle class="mb-4">Draggable marker</BCardTitle>
            <Markers class="leaflet-map" />
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>
  </Layout>
</template>