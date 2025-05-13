<script setup>
import { ref, computed, watch, onMounted } from 'vue';
import Layout from "@/layouts/main.vue";
import PageHeader from "@/components/page-header.vue";
import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";
import Lottie from "@/components/widgets/lottie.vue";
import animationData from "@/components/widgets/msoeawqm.json";
import animationData1 from "@/components/widgets/gsqxdxog.json";
import Swal from "sweetalert2";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
import { application as appData } from "@/common/data";

// Reactive variables
const date6 = ref(null);
const createAppModal = ref(false);
const status = ref(null);
const status1 = ref(null);
const value = ref(null);
const value1 = ref(null);
const searchQuery = ref(null);
const page = ref(1);
const perPage = ref(8);
const pages = ref([]);
const statuscategory = ref('All');
const application = ref(appData);
const defaultOptions = ref({ animationData });
const defaultOptions1 = ref({ animationData: animationData1 });
const isType = ref(null);
const submitted = ref(false);
const dataEdit = ref(false);
const deleteModal = ref(false);
const event = ref({
  id: "",
  img: "",
  name: "",
  designation: "",
  date: "",
  contacts: "",
  type: "",
  status: ""
});
const rangeDateconfig = ref({
  mode: "range",
  dateFormat: "d M, Y",
});

// Computed properties
const displayedPosts = computed(() => paginate(application.value));
const resultQuery = computed(() => {
  if (searchQuery.value) {
    const search = searchQuery.value.toLowerCase();
    return displayedPosts.value.filter((data) => {
      return (
        data.name.toLowerCase().includes(search) ||
        data.designation.toLowerCase().includes(search) ||
        data.type.toLowerCase().includes(search) ||
        data.contacts.toLowerCase().includes(search) ||
        data.status.toLowerCase().includes(search)
      );
    });
  } else if (status.value !== null || value.value !== null) {
    return displayedPosts.value.filter((data) => {
      if (status.value != null && value.value != null) {
        if (status.value === data.status) {
          if (value.value === data.type) {
            return data;
          } else if (value.value == 'All') {
            return data;
          }
        } else if (value.value == 'All' && status.value == 'All') {
          return data;
        } else if (status.value == 'All') {
          if (value.value === data.type) {
            return data;
          }
        }
      } else if (status.value === data.status) {
        return data;
      } else if (value.value === data.type) {
        return data;
      } else if (status.value == 'All' || value.value == 'All') {
        return data;
      } else {
        return null;
      }
    });
  } else {
    return displayedPosts.value;
  }
});

// Watchers
watch(application, () => {
  setPages();
});

// Methods
const setPages = () => {
  let numberOfPages = Math.ceil(application.value.length / perPage.value);
  pages.value = [];
  for (let index = 1; index <= numberOfPages; index++) {
    pages.value.push(index);
  }
};

const paginate = (application) => {
  let from = page.value * perPage.value - perPage.value;
  let to = page.value * perPage.value;
  return application.slice(from, to);
};

const changecategory = (data) => {
  statuscategory.value = data;
};

const onChangeStatus = (e) => {
  statuscategory.value = e;
};

const onChangeType = (e) => {
  isType.value = e;
};

const SearchData = () => {
  resultQuery.value;
  status.value = status1.value;
  value.value = value1.value;
};

const onSort = (column) => {
  const sortedArray = [...application.value];
  sortedArray.sort((a, b) => {
    const res = a[column] < b[column] ? -1 : a[column] > b[column] ? 1 : 0;
    return res;
  });
  application.value = sortedArray;
};

const deleteMultiple = () => {
  let ids_array = [];
  var items = document.getElementsByName("chk_child");
  items.forEach(function (ele) {
    if (ele.checked == true) {
      var trNode = ele.parentNode.parentNode.parentNode;
      var newid = trNode.querySelector(".id a").innerHTML;
      var id = newid.slice(3);
      ids_array.push(id);
    }
  });
  if (typeof ids_array !== "undefined" && ids_array.length > 0) {
    if (confirm("Are you sure you want to delete this?")) {
      var cusList = application.value;
      ids_array.forEach(function (id) {
        cusList = cusList.filter(function (application) {
          return application.id != id;
        });
      });
      application.value = cusList;
      document.getElementById("checkAll").checked = false;
      var itemss = document.getElementsByName("chk_child");
      itemss.forEach(function (ele) {
        if (ele.checked == true) {
          ele.checked = false;
          ele.closest("tr").classList.remove("table-active");
        }
      });
    } else {
      return false;
    }
  } else {
    Swal.fire({
      title: "Please select at least one checkbox",
      confirmButtonClass: "btn btn-info",
      buttonsStyling: false,
      showCloseButton: true,
    });
  }
};

const handleSubmit = () => {
  if (dataEdit.value) {
    submitted.value = true;
    if (submitted.value && (event.value.name && event.value.designation && event.value.date && event.value.contacts && event.value.type && event.value.status)) {
      application.value = application.value.map(item => item.id.toString() == event.value.id.toString() ? { ...item, ...event.value } : item);
      createAppModal.value = false;
    }
  } else {
    submitted.value = true;
    if (submitted.value && (event.value.name && event.value.designation && event.value.date && event.value.contacts && event.value.type && event.value.status)) {
      const data = {
        id: (Math.floor(Math.random() * 100 + 20) - 20),
        img: require("@/assets/images/users/user-dummy-img.jpg"),
        ...event.value
      };
      application.value.unshift(data);
      createAppModal.value = false;
    }
  }
};

const editDetails = (data) => {
  dataEdit.value = true;
  createAppModal.value = true;
  event.value = { ...data };
  submitted.value = false;
};

const toggleModal = () => {
  createAppModal.value = true;
  dataEdit.value = false;
  event.value = {};
  submitted.value = false;
};

const deleteModalToggle = (data) => {
  deleteModal.value = true;
  event.value.id = data.id;
};

const deleteData = () => {
  if (event.value.id) {
    application.value = application.value.filter((item) => item.id != event.value.id);
    deleteModal.value = false;
  }
};

// Mounted hook
onMounted(() => {
  var checkAll = document.getElementById("checkAll");
  if (checkAll) {
    checkAll.onclick = function () {
      var checkboxes = document.querySelectorAll(
        '.form-check-all input[type="checkbox"]'
      );
      if (checkAll.checked == true) {
        checkboxes.forEach(function (checkbox) {
          checkbox.checked = true;
          checkbox.closest("tr").classList.add("table-active");
          document.getElementById('remove-actions').style.display = 'block';
        });
      } else {
        checkboxes.forEach(function (checkbox) {
          checkbox.checked = false;
          checkbox.closest("tr").classList.remove("table-active");
          document.getElementById('remove-actions').style.display = 'none';
        });
      }
    };
  }
});
</script>


<template>
  <Layout>
    <PageHeader title="Application" pageTitle="Jobs" />
    <BRow>
      <BCol lg="12">
        <BCard no-body id="applicationList">
          <BCardHeader class="border-0">
            <div class="d-md-flex align-items-center">
              <h5 class="card-title mb-3 mb-md-0 flex-grow-1">Job Application</h5>
              <div class="flex-shrink-0">
                <div class="d-flex gap-1 flex-wrap">
                  <BButton type="button" class="add-btn" variant="success" id="create-btn" @click="toggleModal">
                    <i class="ri-add-line align-bottom me-1"></i> Create Application
                  </BButton>
                  <BButton type="button" variant="info"><i class="ri-file-download-line align-bottom me-1"></i>Import
                  </BButton>
                  <BButton class="btn btn-soft-danger" id="remove-actions" @click="deleteMultiple"><i
                      class="ri-delete-bin-2-line"></i></BButton>
                </div>
              </div>
            </div>
          </BCardHeader>
          <BCardBody class="border border-dashed border-end-0 border-start-0">
            <BForm>
              <BRow class="g-3">
                <BCol xxl="5" sm="6">
                  <div class="search-box">
                    <input type="text" class="form-control search"
                      placeholder="Search for application ID, company, designation status or something..."
                      v-model="searchQuery">
                    <i class="ri-search-line search-icon"></i>
                  </div>
                </BCol>
                <BCol xxl="2" sm="6">
                  <div>
                    <flat-pickr v-model="date6" :config="rangeDateconfig" class="form-control" placeholder="Select date"></flat-pickr>
                  </div>
                </BCol>
                <BCol xxl="2" sm="4">
                  <div>
                    <Multiselect class="form-control" v-model="status1" :close-on-select="true" :searchable="true"
                      placeholder="Select Status" :create-option="true" :options="[
                        { value: 'All', label: 'All' },
                        { value: 'Approved', label: 'Approved' },
                        { value: 'New', label: 'New' },
                        { value: 'Pending', label: 'Pending' },
                        { value: 'Rejected', label: 'Rejected' },
                      ]" />
                  </div>
                </BCol>
                <BCol xxl="2" sm="4">
                  <div>

                    <Multiselect class="form-control" v-model="value1" :close-on-select="true" :searchable="true"
                      :create-option="true" placeholder="Select Type" :options="[
                        { value: 'All', label: 'All' },
                        { value: 'Full Time', label: 'Full Time' },
                        { value: 'Part Time', label: 'Part Time' },
                      ]" />
                  </div>
                </BCol>
                <BCol xxl="1" sm="4">
                  <div>
                    <BButton type="button" variant="primary" @click="SearchData" class="w-100"> <i
                        class="ri-equalizer-fill me-1 align-bottom"></i>
                      Filters
                    </BButton>
                  </div>
                </BCol>
              </BRow>
            </BForm>
          </BCardBody>
          <BCardBody class="pt-0">
            <div>
              <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                <li class="nav-item">
                  <BLink class="nav-link  All py-3" data-bs-toggle="tab" id="All" href="#" role="tab"
                    aria-selected="true" @click="changecategory('All')">
                    All Application
                  </BLink>
                </li>
                <li class="nav-item">
                  <BLink class="nav-link py-3 New" data-bs-toggle="tab" id="New" href="#" role="tab" aria-selected="false"
                    @click="changecategory('New')">
                    New
                  </BLink>
                </li>
                <li class="nav-item">
                  <BLink class="nav-link py-3 Pending" data-bs-toggle="tab" id="Pending" href="#" role="tab"
                    aria-selected="false" @click="changecategory('Pending')">
                    Pending
                    <BBadge variant="danger" class="align-middle ms-1">2</BBadge>
                  </BLink>
                </li>
                <li class="nav-item">
                  <BLink class="nav-link py-3 Approved" data-bs-toggle="tab" id="Approved" href="#" role="tab"
                    aria-selected="false" @click="changecategory('Approved')">
                    Approved
                  </BLink>
                </li>
                <li class="nav-item">
                  <BLink class="nav-link py-3 Rejected" data-bs-toggle="tab" id="Rejected" href="#" role="tab"
                    aria-selected="false" @click="changecategory('Rejected')">
                    Rejected
                  </BLink>
                </li>
              </ul>

              <div class="table-responsive table-card mb-1">
                <table class="table table-nowrap align-middle" id="jobListTable">
                  <thead class="text-muted table-light">
                    <tr class="text-uppercase">
                      <th scope="col" style="width: 25px;">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                        </div>
                      </th>
                      <th class="sort" data-sort="id" style="width: 140px;" @click="onSort('id')">Application ID</th>
                      <th class="sort" data-sort="company" @click="onSort('name')">Company Name</th>
                      <th class="sort" data-sort="designation" @click="onSort('designation')">Designation</th>
                      <th class="sort" data-sort="date" @click="onSort('date')">Apply Date</th>
                      <th class="sort" data-sort="contacts" @click="onSort('contacts')">Contacts</th>
                      <th class="sort" data-sort="type" @click="onSort('type')">Type</th>
                      <th class="sort" data-sort="status" @click="onSort('status')">Status</th>
                      <th class="sort" data-sort="city" @click="onSort('action')">Action</th>
                    </tr>
                  </thead>
                  <tbody class="list form-check-all" v-for="(data, index) of resultQuery" :key="index">
                    <tr v-if="statuscategory == 'All' || statuscategory == data.status">
                      <th scope="row">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                        </div>
                      </th>
                      <td class="id">
                        <BLink href="#" class="fw-medium link-primary">#VZ{{ data.id }}</BLink>
                      </td>
                      <td class="company">
                        <div class="d-flex align-items-center">
                          <div class="flex-shrink-0">
                            <img :src="data.img" alt="" class="avatar-xxs rounded-circle image_src object-fit-cover">
                          </div>
                          <div class="flex-grow-1 ms-2">{{ data.name }}</div>
                        </div>
                      </td>
                      <td class="designation">{{ data.designation }}</td>
                      <td class="date">{{ data.date }}</td>
                      <td class="contacts">{{ data.contacts }}</td>
                      <td class="type">{{ data.type }}</td>
                      <td class="status"><span class="badge text-uppercase" :class="{
                        'bg-success-subtle text-success': data.status == 'Approved',
                        'bg-warning-subtle text-warning': data.status == 'Pending',
                        'bg-danger-subtle text-danger': data.status == 'Rejected',
                        'bg-info-subtle text-info': data.status == 'New',
                      }">{{ data.status }}</span>
                      </td>
                      <td>
                        <ul class="list-inline hstack gap-2 mb-0">
                          <li class="list-inline-item" v-b-tooltip.hover title="View">
                            <router-link to="/jobs/details" class="text-primary d-inline-block">
                              <i class="ri-eye-fill fs-16"></i>
                            </router-link>
                          </li>
                          <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                            data-bs-placement="top" title="Edit">
                            <BLink class="text-primary d-inline-block edit-item-btn" @click="editDetails(data)">
                              <i class="ri-pencil-fill fs-16"></i>
                            </BLink>
                          </li>
                          <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                            data-bs-placement="top" title="Remove">
                            <BLink class="text-danger d-inline-block remove-item-btn" @click="deleteModalToggle(data)">
                              <i class="ri-delete-bin-5-fill fs-16"></i>
                            </BLink>
                          </li>
                        </ul>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="noresult" v-if="resultQuery.length < 1">
                  <div class="text-center">
                    <lottie class="avatar-xl" colors="primary:#121331,secondary:#08a88a" :options="defaultOptions"
                      :height="75" :width="75" />
                    <h5 class="mt-2">Sorry! No Result Found</h5>
                    <p class="text-muted mb-0">
                      We've searched more than 150+ result We did not find jobs for you search.
                    </p>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-end" v-if="resultQuery.length >= 1">
                <div class="pagination-wrap hstack gap-2">
                  <BLink class="page-item pagination-prev" href="#" :disabled="page <= 1" @click="page--">
                    Previous
                  </BLink>
                  <ul class="pagination listjs-pagination mb-0">
                    <li :class="{ active: pageNumber == page, disabled: pageNumber == '...', }"
                      v-for="(pageNumber, index) in pages" :key="index" @click="page = pageNumber">
                      <BLink class="page" href="#">{{ pageNumber }}</BLink>
                    </li>
                  </ul>
                  <BLink class="page-item pagination-next" href="#" :disabled="page >= pages.length" @click="page++">
                    Next
                  </BLink>
                </div>
              </div>
            </div>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <!-- create app modal  -->
    <BModal v-model="createAppModal" id="showModal" :title="dataEdit ? 'Edit Application' : 'Add Application'"
      header-class="bg-light p-3" title-class="exampleModalLabel" hide-footer class="v-modal-custom" centered>
      <BForm action="#" autocomplete="off" id="addform" class="tablelist-form">
        <input type="hidden" id="id-field" />

        <div class="mb-3 d-none" id="modal-id">
          <label for="applicationId" class="form-label">ID</label>
          <input type="text" id="applicationId" class="form-control" placeholder="ID" readonly />
        </div>

        <div class="text-center">
          <div class="position-relative d-inline-block">
            <div class="position-absolute  bottom-0 end-0">
              <label for="companylogo-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right"
                title="Select Image">
                <div class="avatar-xs cursor-pointer">
                  <div class="avatar-title bg-light border rounded-circle text-muted">
                    <i class="ri-image-fill"></i>
                  </div>
                </div>
              </label>
              <input class="form-control d-none" value="" id="companylogo-image-input" type="file"
                accept="image/png, image/gif, image/jpeg">
            </div>
            <div class="avatar-lg p-1">
              <div class="avatar-title bg-light rounded-circle">
                <img :src="event.img || require('@/assets/images/users/multi-user.jpg')" id="companylogo-img"
                  class="avatar-md h-auto rounded-circle object-fit-cover" />
              </div>
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="company-field" class="form-label">Company</label>
          <input type="text" id="company-field" class="form-control" placeholder="Enter company name" required
            v-model="event.name" :class="{ 'is-invalid': submitted && !event.name }" />
          <div class="invalid-feedback">Please enter a company name.</div>
        </div>

        <div class="mb-3">
          <label for="designation-field" class="form-label">Designation</label>
          <input type="text" id="designation-field" class="form-control" placeholder="Enter designation" required
            v-model="event.designation" :class="{ 'is-invalid': submitted && !event.designation }" />
          <div class="invalid-feedback">Please enter a designation.</div>
        </div>

        <div class="mb-3">
          <label for="date-field" class="form-label">Apply Date</label>
          <flat-pickr id="date-field" placeholder="Select date" class="form-control flatpickr-input" v-model="event.date"
            :config="timeConfig" :class="{ 'is-invalid': submitted && !event.date }"></flat-pickr>
          <div class="invalid-feedback">Please select a date.</div>
        </div>

        <div class="mb-3">
          <label for="contact-field" class="form-label">Contacts</label>
          <input type="text" id="contact-field" class="form-control" placeholder="Enter contact" required
            v-model="event.contacts" :class="{ 'is-invalid': submitted && !event.contacts }" />
          <div class="invalid-feedback">Please enter a contact number.</div>
        </div>

        <BRow class="gy-4 mb-3">
          <BCol md="6">
            <div>
              <label for="status-input" class="form-label">Status</label>
              <Multiselect placeholder="Select Status" :options="['Approved', 'New', 'Pending', 'Rejected']"
                v-model="event.status" :class="{ 'is-invalid': submitted && !event.status }" />
              <div class="invalid-feedback">Please select a status.</div>
            </div>
          </BCol>
          <BCol md="6">
            <div>
              <label for="type-input" class="form-label">Type</label>
              <Multiselect placeholder="Select Job Type" :options="['Full Time', 'Part Time']" v-model="event.type"
                :class="{ 'is-invalid': submitted && !event.type }" />
              <div class="invalid-feedback">Please select a type.</div>
            </div>
          </BCol>
        </BRow>

        <div class="hstack gap-2 justify-content-end mt-3">
          <BButton type="button" variant="light" id="close-modal" @click="createAppModal = false">Close</BButton>
          <BButton type="button" variant="success" id="add-btn" @click="handleSubmit">{{ dataEdit ? 'Update' :
            'Add' }}</BButton>
        </div>
      </BForm>
    </BModal>

    <!-- delete modal-->
    <BModal v-model="deleteModal" body-class="p-5 text-center" modal-class="flip" hide-footer no-close-on-backdrop
      centered>
      <div class="text-center">
        <div class="text-danger">
          <lottie class="avatar-xl" colors="primary:#405189,secondary:#f06548" :options="defaultOptions1" :height="75"
            :width="75" />
        </div>
        <div class="mt-4">
          <h3 class="mb-2">You are about to delete a order ?</h3>
          <p class="text-muted fs-lg mx-3 mb-0">Deleting your order will remove all of your information from our
            database.</p>
        </div>
      </div>
      <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
        <BButton type="button" variant="light" class="w-sm btn-hover" @click="deleteModal = false">Close</BButton>
        <BButton type="button" variant="danger" class="w-sm btn-hover" id="delete-record" @click="deleteData">Yes,Delete
          It!</BButton>
      </div>
    </BModal>
  </Layout>
</template>