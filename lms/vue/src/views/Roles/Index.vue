<template>
  <div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">
        {{ t("roles.Roles") }}
      </h2>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
      <!-- BEGIN: Dtatatable Content -->
      <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: HTML Table Data -->

        <div class="intro-y box p-5">
          <div class="overflow-x-auto scrollbar-hidden">
            <Datatable
              module="roles"
              :importExportOptions="options"
              @editItem="edit"
              @deleteItem="deleteI"
            />
          </div>
        </div>
        <!-- END: HTML Table Data -->
      </div>
      <!-- END: Dtatatable Content -->
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import { useI18n } from "vue-i18n";

const options = {
  modelName: "Role",
};
const { t } = useI18n();
</script>

<style>
</style>