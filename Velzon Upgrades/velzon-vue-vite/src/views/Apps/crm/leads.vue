<script setup>
import { ref, reactive, computed, onMounted, watch } from "vue";
import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
import Swal from "sweetalert2";
import axios from "axios";

import Layout from "@/layouts/main.vue";
import PageHeader from "@/components/page-header.vue";
import Lottie from "@/components/widgets/lottie.vue";
import animationData from "@/components/widgets/msoeawqm.json";
import animationData1 from "@/components/widgets/gsqxdxog.json";

const rightOffcanvas = ref(false);
const addLeadsModal = ref(false);
const submitted = ref(false);
const dataEdit = ref(false);
const deleteModal = ref(false);
const page = ref(1);
const perPage = ref(8);
const pages = ref([]);
const searchQuery = ref("");
const leads = ref([]);
const value = ref("");

const event = reactive({
  _id: "",
  leadsId: "",
  image_src: "",
  name: "",
  company: "",
  phone: "",
  score: "",
  tags: [],
  date: "",
  location: ""
});

const tagoption = [
  { value: "Lead", label: "Lead" },
  { value: "Partner", label: "Partner" },
  { value: "Exiting", label: "Exiting" },
  { value: "Long-tern", label: "Long-tern" }
];

const timeConfig = { enableTime: false, dateFormat: "d M, Y" };
const rangeDateconfig = { mode: "range", dateFormat: "d M, Y" };
const defaultOptions = { animationData };
const defaultOptions1 = { animationData: animationData1 };

const displayedPosts = computed(() => paginate(leads.value));
const resultQuery = computed(() => {
  if (searchQuery.value) {
    const search = searchQuery.value.toLowerCase();
    return displayedPosts.value.filter((data) =>
      ["leadsId", "name", "company", "score", "phone", "location", "date"].some(key =>
        data[key].toString().toLowerCase().includes(search)
      )
    );
  } else {
    return displayedPosts.value;
  }
});

function setPages() {
  let numberOfPages = Math.ceil(leads.value.length / perPage.value);
  pages.value = Array.from({ length: numberOfPages }, (_, i) => i + 1);
}

watch(leads, () => setPages());
// onMounted(() => {
//   axios.get("https://api-node.themesbrand.website/apps/lead")
//     .then((res) => {
//       const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
//       leads.value = res.data.data.map(row => {
//         const dd = new Date(row.date);
//         return {
//           ...row,
//           date: `${dd.getDate()} ${monthNames[dd.getMonth()]}, ${dd.getFullYear()}`,
//           image_src: `https://api-node.themesbrand.website/images/users/${row.image_src}`
//         };
//       });
//     })
//     .catch(console.error);
// });
onMounted(() => {
  axios.get("https://api-node.themesbrand.website/apps/lead")
    .then((res) => {
      const result = res.data;

      //console.log("API response:", result); // Debugging log

      if (Array.isArray(result?.data)) {
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        leads.value = result.data.map(row => {
          const dd = new Date(row.date);
          return {
            ...row,
            date: `${dd.getDate()} ${monthNames[dd.getMonth()]}, ${dd.getFullYear()}`,
            image_src: `https://api-node.themesbrand.website/images/users/${row.image_src}`
          };
        });
      } else {
        console.error("Expected array at res.data.data, but got:", result);
      }
    })
    .catch((error) => {
      console.error("API call failed:", error);
    });
});

function paginate(items) {
  const from = page.value * perPage.value - perPage.value;
  const to = page.value * perPage.value;
  return items.slice(from, to);
}

function handleSubmit() {
  submitted.value = true;
  if (!(event.name && event.company && event.score && event.phone && event.location && event.tags.length && event.date)) return;
  addLeadsModal.value = false;

  if (dataEdit.value) {
    axios.patch(`https://api-node.themesbrand.website/apps/lead/${event._id}`, event)
      .then((response) => {
        const updated = response.data.data;
        leads.value = leads.value.map(item => item._id === updated._id ? { ...item, ...updated } : item);
      })
      .catch(console.error);
  } else {
    const data = {
      _id: Math.floor(Math.random() * 100),
      image_src: require("@/assets/images/users/multi-user.jpg"),
      ...event
    };
    axios.post("https://api-node.themesbrand.website/apps/lead", data)
      .then((response) => {
        leads.value.unshift(response.data.data);
      })
      .catch(console.error);
  }
}

function editDetails(data) {
  dataEdit.value = true;
  addLeadsModal.value = true;
  Object.assign(event, data);
  submitted.value = false;
}

function toggleModal() {
  addLeadsModal.value = true;
  dataEdit.value = false;
  Object.assign(event, {});
  submitted.value = false;
}

function deleteModalToggle(data) {
  deleteModal.value = true;
  event._id = data._id;
}

function deleteData() {
  axios.delete(`https://api-node.themesbrand.website/apps/lead/${event._id}`)
    .then((res) => {
      if (res.data.status === "success") {
        leads.value = leads.value.filter(item => item._id !== event._id);
      }
    })
    .catch(console.error);
  deleteModal.value = false;
}

function deleteMultiple() {
  const ids_array = [];
  const items = document.getElementsByName("chk_child");
  items.forEach(function (ele) {
    if (ele.checked === true) {
      const trNode = ele.parentNode.parentNode.parentNode;
      const id = trNode.querySelector(".id a").innerHTML;
      ids_array.push(id);
    }
  });

  if (ids_array.length > 0) {
    if (confirm("Are you sure you want to delete this?")) {
      leads.value = leads.value.filter((lead) => !ids_array.includes(lead._id));
      document.getElementById("checkAll").checked = false;

      const childCheckboxes = document.getElementsByName("chk_child");
      childCheckboxes.forEach((ele) => {
        ele.checked = false;
        ele.closest("tr").classList.remove("table-active");
      });
    }
  } else {
    Swal.fire({
      title: "Please select at least one checkbox",
      confirmButtonClass: "btn btn-info",
      buttonsStyling: false,
      showCloseButton: true,
    });
  }
}

</script>


<template>
  <Layout>
    <PageHeader title="Leads" pageTitle="CRM" />
    <BRow>
      <BCol lg="12">
        <BCard no-body id="leadsList">
          <BCardHeader class="border-0">
            <BRow class="g-4 align-items-center">
              <BCol sm="3">
                <div class="search-box">
                  <input type="text" class="form-control search" v-model="searchQuery" placeholder="Search for..." />
                  <i class="ri-search-line search-icon"></i>
                </div>
              </BCol>
              <BCol sm="auto" class="ms-auto">
                <div class="hstack gap-2">
                  <BButton variant="soft-danger" id="remove-actions" @click="deleteMultiple">
                    <i class="ri-delete-bin-2-line"></i>
                  </BButton>
                  <BButton @click="rightOffcanvas = true" type="button" variant="info" data-bs-toggle="offcanvas"
                    href="#offcanvasExample">
                    <i class="ri-filter-3-line align-bottom me-1"></i> Fliters
                  </BButton>
                  <BButton type="button" variant="success" class="add-btn" id="create-btn" @click="toggleModal">
                    <i class="ri-add-line align-bottom me-1"></i> Add Leads
                  </BButton>
                  <BDropdown variant="link" class="card-header-dropdown"
                    toggle-class="btn btn-soft-info btn-icon fs-14" no-caret menu-class="dropdown-menu-end">
                    <template #button-content><i class="ri-settings-4-line"></i></template>
                    <BDropdownItem>Copy</BDropdownItem>
                    <BDropdownItem>Move to pipline</BDropdownItem>
                    <BDropdownItem>Add to exceptions</BDropdownItem>
                    <BDropdownItem>Switch to common form view</BDropdownItem>
                    <BDropdownItem>Reset form view to default</BDropdownItem>
                  </BDropdown>
                </div>
              </BCol>
            </BRow>
          </BCardHeader>
          <BCardBody>
            <div>
              <div class="table-responsive table-card">
                <table class="table align-middle" id="customerTable">
                  <thead class="table-light">
                    <tr>
                      <th scope="col" style="width: 50px">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="checkAll" value="option" />
                        </div>
                      </th>
                      <th class="sort" data-sort="name" @click="onSort('name')">Name</th>
                      <th class="sort" data-sort="company_name" @click="onSort('company')">Company</th>
                      <th class="sort" data-sort="leads_score" @click="onSort('score')">Leads Score</th>
                      <th class="sort" data-sort="phone" @click="onSort('phone')">Phone</th>
                      <th class="sort" data-sort="location" @click="onSort('location')">Location</th>
                      <th class="sort" data-sort="tags" @click="onSort('tags')">Tags</th>
                      <th class="sort" data-sort="date" @click="onSort('date')">Create Date</th>
                      <th class="sort" data-sort="action">Action</th>
                    </tr>
                  </thead>
                  <tbody class="list form-check-all">
                    <tr v-for="(data, index) of resultQuery" :key="index">
                      <th scope="row">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="chk_child" value="option1" />
                        </div>
                      </th>
                      <td class="id" style="display: none">
                        <BLink href="javascript:void(0);" class="fw-medium link-primary">{{ data._id }}</BLink>
                      </td>
                      <td class="">
                        <div class="d-flex align-items-center">
                          <div class="flex-shrink-0"><img :src="data.image_src" alt=""
                              class="user_image avatar-xs rounded-circle">
                          </div>
                          <div class="flex-grow-1 ms-2 name">{{ data.name }}</div>
                        </div>
                      </td>
                      <td class="company_name">{{ data.company }}</td>
                      <td class="leads_score">{{ data.score }}</td>
                      <td class="phone">{{ data.phone }}</td>
                      <td class="location">{{ data.location }}</td>
                      <td class="tags">
                        <span v-for="(tag, index) of data.tags" :key="index">
                          &nbsp;<BBadge variant="primary-subtle" class="bg-primary-subtle text-primary"> {{ tag
                          }}</BBadge>
                        </span>
                      </td>
                      <td class="date">{{ data.date }}</td>
                      <td>
                        <ul class="list-inline hstack gap-2 mb-0">
                          <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                            data-bs-placement="top" title="Call">
                            <BLink href="javascript:void(0);" class="text-muted d-inline-block">
                              <i class="ri-phone-line fs-16"></i>
                            </BLink>
                          </li>
                          <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                            data-bs-placement="top" title="Message">
                            <BLink href="javascript:void(0);" class="text-muted d-inline-block">
                              <i class="ri-question-answer-line fs-16"></i>
                            </BLink>
                          </li>
                          <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                            data-bs-placement="top" title="View">
                            <BLink href="javascript:void(0);"><i class="ri-eye-fill align-bottom text-muted"></i>
                            </BLink>
                          </li>
                          <li class="list-inline-item" @click="editDetails(data)">
                            <BLink class="edit-item-btn"><i class="ri-pencil-fill align-bottom text-muted"></i>
                            </BLink>
                          </li>
                          <li class="list-inline-item" @click="deleteModalToggle(data)">
                            <BLink class="remove-item-btn">
                              <i class="ri-delete-bin-fill align-bottom text-muted"></i>
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
                      We've searched more than 150+ Orders We did not find any
                      orders for you search.
                    </p>
                  </div>
                </div>
                <div class="d-flex justify-content-end p-3" v-if="resultQuery.length >= 1">
                  <div class="pagination-wrap hstack gap-2">
                    <BLink class="page-item pagination-prev" href="#" :disabled="page <= 1" @click="page--"> Previous
                    </BLink>
                    <ul class="pagination listjs-pagination mb-0">
                      <li :class="{ active: pageNumber == page, disabled: pageNumber == '...', }"
                        v-for="(pageNumber, index) in pages" :key="index" @click="page = pageNumber">
                        <BLink class="page" href="#" data-i="1" data-page="8">{{ pageNumber }}</BLink>
                      </li>
                    </ul>
                    <BLink class="page-item pagination-next" href="#" :disabled="page >= pages.length" @click="page++">
                      Next
                    </BLink>
                  </div>
                </div>
              </div>
            </div>
            <BOffcanvas v-model="rightOffcanvas" placement="end" title="Leads Filters" header-class="bg-light"
              body-class="p-0 overflow-hidden" footer-class="border-top p-3 text-center">
              <b-form action="" class="d-flex flex-column justify-content-end h-100">
                <div class="offcanvas-body">
                  <div class="mb-4">
                    <label for="datepicker-range"
                      class="form-label text-muted text-uppercase fw-semibold mb-3">Date</label>
                    <flat-pickr placeholder="Select date" v-model="event.date" :config="rangeDateconfig"
                      class="form-control flatpickr-input" id="demo-datepicker"></flat-pickr>
                  </div>
                  <div class="mb-4">
                    <label for="country-select"
                      class="form-label text-muted text-uppercase fw-semibold mb-3">Country</label>

                      <Multiselect
                        class="form-control"
                        v-model="value"
                        :close-on-select="true"
                        :searchable="true"
                        :create-option="true"
                        :options="[
                          { value: '', label: 'Select country' },
                          { value: 'Argentina', label: 'Argentina' },
                          { value: 'Belgium', label: 'Belgium' },
                          { value: 'Brazil', label: 'Brazil' },
                          { value: 'Colombia', label: 'Colombia' },
                          { value: 'Denmark', label: 'Denmark' },
                          { value: 'France', label: 'France' },
                          { value: 'Germany', label: 'Germany' },
                          { value: 'Mexico', label: 'Mexico' },
                          { value: 'Russia', label: 'Russia' },
                          { value: 'Spain', label: 'Spain' },
                          { value: 'Syria', label: 'Syria' },
                          { value: 'United Kingdom', label: 'United Kingdom' },
                          {
                            value: 'United States of America',
                            label: 'United States of America',
                          },
                        ]"
                      />
                  </div>
                  <div class="mb-4">
                    <label for="status-select"
                      class="form-label text-muted text-uppercase fw-semibold mb-3">Status</label>
                    <BRow class="g-2">
                      <BCol lg="6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" />
                          <label class="form-check-label" for="inlineCheckbox1">New Leads</label>
                        </div>
                      </BCol>
                      <BCol lg="6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                          <label class="form-check-label" for="inlineCheckbox2">Old Leads</label>
                        </div>
                      </BCol>
                      <BCol lg="6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" />
                          <label class="form-check-label" for="inlineCheckbox3">Loss Leads</label>
                        </div>
                      </BCol>
                      <BCol lg="6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="option4" />
                          <label class="form-check-label" for="inlineCheckbox4">Follow Up</label>
                        </div>
                      </BCol>
                    </BRow>
                  </div>
                  <div class="mb-4">
                    <label for="leadscore" class="form-label text-muted text-uppercase fw-semibold mb-3">Lead
                      Score</label>
                    <BRow class="g-2 align-items-center">
                      <BCol lg>
                        <input type="number" class="form-control" id="leadscore" placeholder="0" />
                      </BCol>
                      <BCol lg="auto">To</BCol>
                      <BCol lg>
                        <input type="number" class="form-control" id="leadscore" placeholder="0" />
                      </BCol>
                    </BRow>
                  </div>
                  <div>
                    <label for="leads-tags" class="form-label text-muted text-uppercase fw-semibold mb-3">Tags</label>
                    <BRow class="g-3">
                      <BCol lg="6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="marketing" value="marketing" />
                          <label class="form-check-label" for="marketing">Marketing</label>
                        </div>
                      </BCol>
                      <BCol lg="6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="management" value="management" />
                          <label class="form-check-label" for="management">Management</label>
                        </div>
                      </BCol>
                      <BCol lg="6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="business" value="business" />
                          <label class="form-check-label" for="business">Business</label>
                        </div>
                      </BCol>
                      <BCol lg="6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="investing" value="investing" />
                          <label class="form-check-label" for="investing">Investing</label>
                        </div>
                      </BCol>
                      <BCol lg="6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="partner" value="partner" />
                          <label class="form-check-label" for="partner">Partner</label>
                        </div>
                      </BCol>
                      <BCol lg="6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="lead" value="lead" />
                          <label class="form-check-label" for="lead">Leads</label>
                        </div>
                      </BCol>
                      <BCol lg="6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="sale" value="sale" />
                          <label class="form-check-label" for="sale">Sale</label>
                        </div>
                      </BCol>
                      <BCol lg="6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="owner" value="owner" />
                          <label class="form-check-label" for="owner">Owner</label>
                        </div>
                      </BCol>
                      <BCol lg="6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="banking" value="banking" />
                          <label class="form-check-label" for="banking">Banking</label>
                        </div>
                      </BCol>
                      <BCol lg="6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="banking" value="banking" />
                          <label class="form-check-label" for="banking">Exiting</label>
                        </div>
                      </BCol>
                      <BCol lg="6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="banking" value="banking" />
                          <label class="form-check-label" for="banking">Finance</label>
                        </div>
                      </BCol>
                      <BCol lg="6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="banking" value="banking" />
                          <label class="form-check-label" for="banking">Fashion</label>
                        </div>
                      </BCol>
                    </BRow>
                  </div>
                </div>
                <!--end offcanvas-body-->
                <div class="offcanvas-footer border-top p-3 text-center hstack gap-2">
                  <BButton variant="light" class="w-100">Clear Filter</BButton>
                  <BButton type="submit" variant="success" class="w-100">
                    Filters
                  </BButton>
                </div>
                <!--end offcanvas-footer-->
              </b-form>
            </BOffcanvas>
            <!--end offcanvas-->
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <BModal v-model="addLeadsModal" id="showmodal" hide-footer title-class="exampleModalLabel"
      :title="dataEdit ? 'Edit Lead' : 'Add Lead'" header-class="bg-light p-3" class="v-modal-custom" centered>
      <b-form action="" id="addform" class="tablelist-form" autocomplete="off">
        <input type="hidden" id="id" />
        <BRow class="g-3">
          <BCol lg="12">
            <div class="text-center">
              <div class="position-relative d-inline-block">
                <div class="position-absolute bottom-0 end-0">
                  <label for="lead-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right"
                    aria-label="Select Image" data-bs-original-title="Select Image">
                    <div class="avatar-xs cursor-pointer">
                      <div class="avatar-title bg-light border rounded-circle text-muted">
                        <i class="ri-image-fill"></i>
                      </div>
                    </div>
                  </label>
                  <input class="form-control d-none" value="" id="lead-image-input" type="file"
                    accept="image/png, image/gif, image/jpeg">
                </div>
                <div class="avatar-lg p-1">
                  <div class="avatar-title bg-light rounded-circle">
                    <img :src="event.image_src || '@/assets/images/users/user-dummy-img.jpg'" id="lead-img"
                      class="avatar-md rounded-circle object-fit-cover">
                  </div>
                </div>
              </div>
              <h5 class="fs-13 mt-3">Lead Image</h5>
            </div>
            <div>
              <label for="name-field" class="form-label">Name</label>
              <input type="text" id="customername" class="form-control" placeholder="Enter Name" v-model="event.name"
                :class="{ 'is-invalid': submitted && !event.name }" />
              <div class="invalid-feedback">Please enter a name.</div>
            </div>
          </BCol>
          <BCol lg="12">
            <div>
              <label for="company_name-field" class="form-label">Company Name</label>
              <input type="text" id="companyname" class="form-control" placeholder="Enter company name"
                v-model="event.company" :class="{ 'is-invalid': submitted && !event.company }" />
              <div class="invalid-feedback">Please enter a company name.</div>
            </div>
          </BCol>
          <BCol lg="6">
            <div>
              <label for="leads_score-field" class="form-label">Leads Score</label>
              <input type="text" id="leadsscore" class="form-control" placeholder="Enter lead score" v-model="event.score"
                :class="{ 'is-invalid': submitted && !event.score }" />
              <div class="invalid-feedback">Please enter a lead score.</div>
            </div>
          </BCol>
          <BCol lg="6">
            <div>
              <label for="phone-field" class="form-label">Phone</label>
              <input type="text" id="phone" class="form-control" placeholder="Enter phone no" v-model="event.phone"
                :class="{ 'is-invalid': submitted && !event.phone }" />
              <div class="invalid-feedback">Please enter a phone number.</div>
            </div>
          </BCol>
          <BCol lg="12">
            <div>
              <label for="location-field" class="form-label">Location</label>
              <input type="text" id="location" class="form-control" placeholder="Enter location" v-model="event.location"
                :class="{ 'is-invalid': submitted && !event.location }" />
              <div class="invalid-feedback">Please enter a location.</div>
            </div>
          </BCol>
          <div>
            <label for="" class="form-label">Tags</label>
            <Multiselect mode="tags" :close-on-select="true" :searchable="true" :create-option="false"
              :options="tagoption" v-model="event.tags" :class="{ 'is-invalid': submitted && !event.tags }" />
            <div class="invalid-feedback">Please select a tags.</div>
          </div>
          <BCol lg="12">
            <div>
              <label for="date-field" class="form-label">Created Date</label>
              <flat-pickr placeholder="Select date" :config="timeConfig" class="form-control flatpickr-input" id="date"
                v-model="event.date" :class="{ 'is-invalid': submitted && !event.date }"></flat-pickr>
              <div class="invalid-feedback">Please enter a date.</div>
            </div>
          </BCol>
        </BRow>
        <div class="modal-footer v-modal-footer">
          <div class="hstack gap-2 justify-content-end">
            <BButton type="button" variant="light" id="closemodal" @click="addLeadsModal = false">Close</BButton>
            <BButton type="submit" variant="success" id="add-btn" @click="handleSubmit">
              {{ dataEdit ? 'Update' : 'Add leads' }}
            </BButton>
          </div>
        </div>
      </b-form>
    </BModal>

    <!-- delete modal -->
    <BModal v-model="deleteModal" modal-class="zoomIn" hide-footer no-close-on-backdrop centered>
      <div class="mt-2 text-center">
        <lottie class="avatar-xl" colors="primary:#f7b84b,secondary:#f06548" :options="defaultOptions1" :height="100"
          :width="100" />
        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
          <h4>Are you sure ?You are about to delete a lead ?</h4>
          <p class="text-muted mx-4 mb-0">Deleting your lead will remove all of your information from our database.</p>
        </div>
      </div>
      <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
        <BButton variant="light" class="w-sm" @click="deleteModal = false">Close</BButton>
        <BButton variant="danger" class="w-sm" id="delete-record" @click="deleteData">Yes, Delete It!</BButton>
      </div>
    </BModal>
  </Layout>
</template>