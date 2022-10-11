<template>
  <div>
    <template v-if="listing">
      <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
          {{ t("clients.Clients") }}
        </h2>
      </div>
      <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Datatable Content -->
        <div class="intro-y col-span-12 lg:col-span-12">
          <!-- BEGIN: HTML Table Data -->

          <div class="intro-y box p-5">
            <div class="overflow-x-auto scrollbar-hidden">
              <Datatable
                module="clients"
                :importExportOptions="options"
                @editItem="edit"
                @deleteItem="deleteI"
                @addModel="add"
              />
            </div>
          </div>
          <!-- END: HTML Table Data -->
        </div>
        <!-- END: Datatable Content -->
      </div>
    </template>
    <template v-else>
      <router-view></router-view>
    </template>
  </div>
</template>

<script setup>
import { ref, onMounted, computed, watch } from "vue";
import { useI18n } from "vue-i18n";
import { useRoute, useRouter } from "vue-router";
import store from "@/stores";

const route = useRoute();
const router = useRouter();

const options = {
  modelName: "Client",
};
const { t } = useI18n();
const listing = ref(true);

function add() {
  listing.value = false;
  router.push({ name: "CreateClient" });
}
onMounted(() => {
  if (route.name === "CreateClient" || route.name === "EditClient") {
    listing.value = false;
  }
});
watch(
  () => route.name,
  (to, from) => {
    if (to === "Clients") {
      listing.value = true;
    }
  }
);

function edit(item) {
  listing.value = false;
  router.push({
    name: "EditClient",
    params: { id: item.id },
  });
}

function deleteI(item) {
  store.dispatch("clients/delete", item.id);
}
</script>

<style scoped>
</style>
