<script setup>
import { ref } from 'vue'
import { latLng, latLngBounds } from 'leaflet'
import {
  LMap,
  LTileLayer,
  LMarker
} from '@vue-leaflet/vue-leaflet'

const zoom = ref(6)
const center = ref(latLng(47.41322, -1.219482))

const bounds = ref(
  latLngBounds([
    [40.70081290280357, -74.26963806152345],
    [40.82991732677597, -74.08716201782228]
  ])
)

const maxBounds = ref(
  latLngBounds([
    [40.70081290280357, -74.26963806152345],
    [40.82991732677597, -74.08716201782228]
  ])
)

const url = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
const attribution = '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'

const marker = ref(latLng(47.41322, -1.219482))
</script>


<template>
  <div>
    <l-map :zoom="zoom" :center="center" :bounds="bounds" :max-bounds="maxBounds" style="height: 400px; width: 100%">
      <l-tile-layer :url="url" :attribution="attribution" />
      <l-marker :lat-lng="marker" />
    </l-map>
  </div>
</template>