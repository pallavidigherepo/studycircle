<template>
  <div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">
        {{ t("permissions.Permissions") }}
      </h2>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
      <!-- BEGIN: Post Content -->
      <div class="intro-y col-span-12 lg:col-span-8">
        <!-- BEGIN: HTML Table Data -->
        <div class="intro-y box p-5">
          <div class="overflow-x-auto scrollbar-hidden">
            <div class="grid grid-cols-12 gap-6 mt-5">
              <div
                class="
                  intro-y
                  col-span-12
                  flex flex-wrap
                  sm:flex-nowrap
                  items-center
                  mt-2
                "
              >
                <div class="dropdown">
                  <button
                    class="dropdown-toggle btn btn-primary ml-2"
                    aria-expanded="false"
                    data-tw-toggle="dropdown"
                  >
                    <span class="flex items-center justify-center">
                      {{ t("permissions.Export/Print") }}&nbsp;<DownloadIcon
                        class="w-4 h-4"
                      />
                    </span>
                  </button>
                  <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                      <!-- <li>
                        <a href="javascript:;" class="dropdown-item">
                          <PrinterIcon class="w-4 h-4 mr-2" />
                          {{ t("permissions.Print") }}
                        </a>
                      </li> -->
                      <li>
                        <a
                          href="javascript:;"
                          class="dropdown-item"
                          @click.prevent="exportMe('xlsx')"
                        >
                          <FileTextIcon class="w-4 h-4 mr-2" />
                          {{ t("permissions.Export to Excel") }}
                        </a>
                      </li>
                      <li>
                        <a
                          href="javascript:;"
                          class="dropdown-item"
                          @click.prevent="exportMe('csv')"
                        >
                          <FileTextIcon class="w-4 h-4 mr-2" />
                          {{ t("permissions.Export to CSV") }}
                        </a>
                      </li>
                      <!-- <li>
                        <a
                          href="javascript:;"
                          class="dropdown-item"
                          @click.prevent="exportMe('pdf')"
                        >
                          <FileTextIcon class="w-4 h-4 mr-2" />
                          {{ t("permissions.Export to PDF") }}
                        </a>
                      </li> -->
                    </ul>
                  </div>
                </div>
                <div class="dropdown">
                  <button
                    class="dropdown-toggle btn btn-primary ml-2"
                    aria-expanded="false"
                    data-tw-toggle="dropdown"
                  >
                    <span class="flex items-center justify-center">
                      {{ t("permissions.Import") }}&nbsp;<UploadIcon
                        class="w-4 h-4"
                      />
                    </span>
                  </button>
                  <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                      <li>
                        <a href="#" class="dropdown-item" @click="openModal">
                          <FileTextIcon class="w-4 h-4 mr-2" />
                          {{ t("permissions.CSV/Excel") }}
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="hidden md:block mx-auto text-slate-500">
                  {{ t("permissions.Showing") }} {{ permissions.from }}
                  {{ t("permissions.to") }} {{ permissions.to }}
                  {{ t("permissions.of") }} {{ permissions.total }}
                  {{ t("permissions.entries") }}
                </div>
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                  <div class="w-56 relative text-slate-500">
                    <input
                      type="text"
                      class="form-control w-56 pr-10 w-full"
                      placeholder="Search..."
                    />
                    <SearchIcon
                      class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0"
                    />
                  </div>
                </div>
              </div>
              <!-- BEGIN: Data List -->
              <div
                class="intro-y col-span-12 overflow-auto lg:overflow-visible"
              >
                <table class="table table-hover mt-2">
                  <thead>
                    <tr>
                      <th class="uppercase whitespace-nowrap">
                        {{ t("permissions.Id") }}
                      </th>
                      <th class="uppercase whitespace-nowrap">
                        {{ t("permissions.Name") }}
                      </th>
                      <th class="uppercase text-center whitespace-nowrap">
                        {{ t("permissions.Guard Name") }}
                      </th>
                      <th class="text-center whitespace-nowrap">
                        {{ t("permissions.Action") }}
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(permission, index) in permissions.data"
                      :key="index"
                      class="intro-x"
                      :class="{
                        'bg-secondary': permission.id == selectedPermission,
                      }"
                    >
                      <td class="whitespace-nowrap">{{ permission.id }}</td>
                      <td class="whitespace-nowrap">{{ permission.name }}</td>
                      <td class="text-center whitespace-nowrap">
                        {{ permission.guard_name }}
                      </td>
                      <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                          <a
                            class="flex items-center mr-3"
                            href="javascript:;"
                            @click.prevent="editItem(permission)"
                          >
                            <CheckSquareIcon class="w-4 h-4 mr-1" />
                            {{ t("permissions.Edit") }}
                          </a>
                          <a
                            class="flex items-center text-danger"
                            href="javascript:;"
                            @click.prevent="deleteItem(permission)"
                          >
                            <Trash2Icon class="w-4 h-4 mr-1" />
                            {{ t("permissions.Delete") }}
                          </a>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- END: Data List -->
              <!-- BEGIN: Pagination -->
              <Pagination
                :links="permissions.links"
                @paginate="getForPage"
                @perpage="perPageValue"
              />
              <!-- END: Pagination -->
            </div>
          </div>
        </div>
        <!-- END: HTML Table Data -->
      </div>
      <!-- END: Post Content -->
      <!-- BEGIN: Add/Edit permission -->
      <div class="col-span-12 lg:col-span-4">
        <div class="intro-y box p-5">
          <h2 class="text-lg font-medium mr-auto pt-5 pb-5">
            {{ t("permissions." + actionText) }}
            {{ t("permissions.Permissions") }}
          </h2>
          <div
            class="alert alert-danger show flex items-center mb-2"
            role="alert"
            v-if="isErrored"
          >
            <AlertOctagonIcon class="w-6 h-6 mr-2" />
            {{ message }}
          </div>
          <form @submit.prevent="submitForm" class="validate-form">
            <div>
              <label for="crud-form-1" class="form-label">{{
                t("permissions.Permission Name")
              }}</label>
              <input
                id="crud-form-1"
                type="text"
                class="form-control w-full"
                :placeholder="t('permissions.Permission Name')"
                v-model.trim="model.name"
                :class="{ 'border-danger': submitted && v$.name.$error }"
              />
              <span v-if="submitted && v$.name.$error" class="text-danger mt-2">
                {{ v$.name.$errors[0].$message }}
              </span>
            </div>
            <div class="text-right mt-5">
              <button
                type="button"
                class="btn btn-outline-secondary w-24 mr-1"
                @click.prevent="cancel"
              >
                {{ t("permissions.Cancel") }}
              </button>
              <button type="submit" class="btn btn-primary w-24">
                {{ t("permissions.Save") }}
              </button>
            </div>
          </form>
        </div>
      </div>
      <!-- END: Add/Edit permission -->
    </div>
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
      <CustomeAlert
            v-if="responseMessage"
            :message="responseMessage"
            :status="responseStatus"
            class="col-span-12 sm:col-span-6 flex"
          />
      <ModalBody class="grid grid-cols-12 gap-4 gap-y-3">
        
        <div class="col-span-12 sm:col-span-8">
          
          <label for="modal-form-1" class="form-label">{{
            t("permissions.Upload file")
          }}</label>
          <input
            id="modal-form-1"
            type="file"
            class="form-control"
            @change="importMe($event)"
          />
          <span class="text-primary">Please upload file of type .csv or .xlsx</span>
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
        <!-- <button type="button" class="btn btn-primary w-20">
          {{ t("permissions.Import") }}
        </button> -->
      </ModalFooter>
    </Modal>
    <!-- END: Modal Content -->
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";

import { useVuelidate } from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators";

import store from "@/stores";

import { useI18n } from "vue-i18n";

import useImportExport from "@/hooks/import_export.js";

// To show/hide modal
const headerFooterModalPreview = ref(false);

const options = {
  modelName: "Permission",
};
const { importMe, exportMe, responseStatus, responseMessage } =
  useImportExport(options);

const { t } = useI18n();

// Variables and actions related to listing.
const permissions = computed(() => store.state.permissions.permissions);

onMounted(() => {
  store.dispatch("permissions/list").then(() => {
    //loading.value = false;
  });
});
function openModal() {
  //import_file.value = '';
  headerFooterModalPreview.value = true;
  responseMessage.value = "";
  responseStatus.value = false;
}
function getForPage(link) {
  if (!link.url || link.active) {
    return;
  }
  store.dispatch("permissions/list", { url: link.url });
}

function perPageValue(value) {}
// End of info

// Variables and actions related to Add/Edit.
let isEdit = ref(false);
let actionText = ref("Add");
let submitted = ref(false);
let message = ref("");
let isErrored = ref(false);
let selectedPermission = ref("");

let model = ref({
  id: "",
  name: "",
});

const rules = computed(() => {
  return {
    name: {
      required: helpers.withMessage(
        "Please enter name of perimission.",
        required
      ),
    },
  };
});

const v$ = useVuelidate(rules, model);

async function submitForm(event) {
  submitted.value = true;
  v$.value.$validate(); // checks all inputs

  if (!v$.value.$error) {
    //loading.value = true;

    await store
      .dispatch("permissions/save", model.value)
      .then(() => {
        // After dispatch we have to reset the model value
        if (!isEdit.value) {
          model.value = JSON.parse(JSON.stringify(model));
        }
        isErrored.value = false;
        message.value = "";
        submitted.value = false;
        event.target.reset();
      })
      .catch((err) => {
        isErrored.value = true;
        message.value = err.response.data.message;
      });

    //loading.value = false;
  } else {
    // if ANY fail validation

    return;
  }
}

function editItem(item) {
  actionText.value = "Edit";
  isEdit.value = true;
  selectedPermission.value = item.id;
  model.value = JSON.parse(JSON.stringify(item));
}

function cancel() {
  actionText.value = "Add";
  isEdit.value = false;
  selectedPermission.value = "";
  model.value = JSON.parse(JSON.stringify(model));
}

// END: Add/Edit

// BEGIN: Delete
function deleteItem(permission) {
  store.dispatch("permissions/delete", permission.id);
}
// END: Delete
</script>

<style>
.active-row {
  background-color: lightgray;
}
</style>