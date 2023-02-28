<template>
    <!-- BEGIN: Modal Content -->
    <Modal
      :show="headerFooterModalPreview"
      @hidden="headerFooterModalPreview = false"
    >
      <ModalHeader>
        <h2 class="font-medium text-base mr-auto">
          {{ t("permissions.Import as CSV/Excel") }}
        </h2>
      </ModalHeader>
      <ModalBody class="grid grid-cols-12 gap-4 gap-y-3">
        <div class="col-span-12 sm:col-span-6">
          <label for="modal-form-1" class="form-label">{{
            t("permissions.Upload file")
          }}</label>
          <input
            id="modal-form-1"
            type="file"
            class="form-control"
            @change="importMe($event)"
          />
        </div>
      </ModalBody>
      <ModalFooter>
        <button
          type="button"
          @click="headerFooterModalPreview = false"
          class="btn btn-outline-secondary w-20 mr-1"
        >
          {{ t("permissions.Cancel") }}
        </button>
        <button type="button" class="btn btn-primary w-20">
          {{ t("permissions.Import") }}
        </button>
      </ModalFooter>
    </Modal>
    <!-- END: Modal Content -->
</template>

<script>
export default {

}
</script>

<style>

</style>