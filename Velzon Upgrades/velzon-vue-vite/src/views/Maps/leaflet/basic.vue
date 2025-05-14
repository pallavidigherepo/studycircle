<script setup>
import { ref } from 'vue'
import { latLng } from 'leaflet'
import { LMap, LTileLayer, LMarker, LTooltip, LIcon } from '@vue-leaflet/vue-leaflet'

// Reactive variables
const zoom = ref(13)
const center = ref(latLng(47.41322, -1.219482))
const url = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
const attribution = '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
const withTooltip = ref(latLng(47.41422, -1.250482))
const showParagraph = ref(false)
const showMap = ref(true)
const mapOptions = {
  zoomSnap: 0.5
}

// Methods
function innerClick() {
  alert("Click!")
}
</script>


<template>
  <l-map
    :zoom="zoom"
    :center="center"
    :options="mapOptions"
    style="height: 400px; width: 100%"
  >
    <l-tile-layer :url="url" :attribution="attribution" />
    <l-marker :lat-lng="withTooltip">
      <l-tooltip :options="{ permanent: true, interactive: true }">
        <div @click="innerClick">
          I am a tooltip
          <p v-show="showParagraph">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sed
            pretium nisl, ut sagittis sapien. Sed vel sollicitudin nisi. Donec
            finibus semper metus id malesuada.
          </p>
        </div>
      </l-tooltip>
      <l-icon>
        <!-- <img src="@/assets/images/leaflet/marker-icon.png" /> -->
      </l-icon>
    </l-marker>
  </l-map>
</template>