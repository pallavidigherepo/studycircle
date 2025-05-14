<script setup>
import { ref } from 'vue'
import { LMap, LTileLayer, LMarker, LIcon } from "@vue-leaflet/vue-leaflet"
import { latLng } from "leaflet"

// map config
const zoom = ref(6)
const center = ref(latLng(51.505, -0.09))
const url = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
const attribution = '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
const staticAnchor = [16, 37]

// markers
const markers = ref([
  {
    id: "m1",
    position: { lat: 51.505, lng: -0.09 },
    draggable: true,
    visible: true,
  },
  {
    id: "m2",
    position: { lat: 51.8905, lng: -0.09 },
    draggable: true,
    visible: true,
  },
  {
    id: "m3",
    position: { lat: 51.005, lng: -0.09 },
    draggable: true,
    visible: true,
  },
  {
    id: "m4",
    position: { lat: 50.7605, lng: -0.09 },
    draggable: true,
    visible: true,
  },
])
</script>


 <template>
  <l-map style="height: 400px; width: 100%" :zoom="zoom" :center="center">
    <l-tile-layer :url="url" :attribution="attribution" />
    <l-marker
      v-for="marker in markers"
      :key="marker.id"
      :visible="marker.visible"
      :draggable="marker.draggable"
      :lat-lng="marker.position"
    >
      <l-icon :icon-anchor="staticAnchor">
        <!-- <img src="@/assets/images/leaflet/marker-icon.png" /> -->
      </l-icon>
    </l-marker>
  </l-map>
</template> 