<script setup>
import { ref, reactive, computed, onMounted, watch } from 'vue';
import Multiselect from '@vueform/multiselect';
import '@vueform/multiselect/themes/default.css';

import Layout from '@/layouts/main.vue';
import PageHeader from '@/components/page-header.vue';

import animationData from '@/components/widgets/msoeawqm.json';
import animationData1 from '@/components/widgets/gsqxdxog.json';
import Swal from 'sweetalert2';
import axios from 'axios';
import Lottie from '@/components/widgets/lottie.vue';

const timeConfig = {
  enableTime: false,
  dateFormat: 'd M, Y',
};

const date2 = ref(null);

const defaultOptions = { animationData };
const defaultOptions1 = { animationData: animationData1 };

const searchQuery = ref('');
const addContactModal = ref(false);
const page = ref(1);
const perPage = ref(8);
const pages = ref([]);

const tagoption = [
  { value: 'Lead', label: 'Lead' },
  { value: 'Partner', label: 'Partner' },
  { value: 'Exiting', label: 'Exiting' },
  { value: 'Long-tern', label: 'Long-tern' }
];

const contactsList = ref([]);

const submitted = ref(false);
const dataEdit = ref(false);
const deleteModal = ref(false);

const event = reactive({
  _id: '',
  image_src: '',
  name: '',
  company: '',
  designation: '',
  email: '',
  last_contacted: '',
  lead_score: '',
  phone: '',
  tags: [],
  time: ''
});

const displayedPosts = computed(() => {
  const from = (page.value - 1) * perPage.value;
  const to = page.value * perPage.value;
  return contactsList.value.slice(from, to);
});

const resultQuery = computed(() => {
  if (!searchQuery.value) return displayedPosts.value;
  const search = searchQuery.value.toLowerCase();
  return displayedPosts.value.filter((data) =>
    ['company', 'designation', 'email', 'image_src', 'last_contacted', 'lead_score', 'name', 'phone'].some(
      key => data[key]?.toString().toLowerCase().includes(search)
    )
  );
});

watch(contactsList, () => {
  setPages();
});

function handleSubmit() {
  submitted.value = true;

  const requiredFields = ['name', 'company', 'designation', 'email', 'phone', 'lead_score', 'tags'];
  const isValid = requiredFields.every((key) => event[key]);

  if (!isValid) return;

  if (dataEdit.value) {
    axios.patch(`https://api-node.themesbrand.website/apps/contact/${event._id}`, event)
      .then((response) => {
        const updated = response.data.data;
        contactsList.value = contactsList.value.map(item =>
          item._id === updated._id ? { ...item, ...updated } : item
        );
      }).catch(console.error);
  } else {
    const data = {
      _id: Math.floor(Math.random() * 1000),
      image_src: require('@/assets/images/users/multi-user.jpg'),
      last_contacted: dateFormat(),
      ...event
    };
    axios.post(`https://api-node.themesbrand.website/apps/contact`, data)
      .then((response) => {
        contactsList.value.unshift(response.data.data);
      }).catch(console.error);
  }

  addContactModal.value = false;
}

const direction = ref('asc');
function onSort(column) {
  direction.value = direction.value === 'asc' ? 'desc' : 'asc';
  contactsList.value.sort((a, b) => {
    const result = a[column] < b[column] ? -1 : a[column] > b[column] ? 1 : 0;
    return direction.value === 'asc' ? result : -result;
  });
}

function editDetails(data) {
  Object.assign(event, data);
  submitted.value = false;
  dataEdit.value = true;
  addContactModal.value = true;
}

function toggleModal() {
  Object.assign(event, {
    _id: '',
    image_src: '',
    name: '',
    company: '',
    designation: '',
    email: '',
    last_contacted: '',
    lead_score: '',
    phone: '',
    tags: [],
    time: ''
  });
  submitted.value = false;
  dataEdit.value = false;
  addContactModal.value = true;
}

function deleteModalToggle(data) {
  deleteModal.value = true;
  event._id = data._id;
}

function deleteData() {
  axios.delete(`https://api-node.themesbrand.website/apps/contact/${event._id}`)
    .then((response) => {
      if (response.data.status === 'success') {
        contactsList.value = contactsList.value.filter(item => item._id !== event._id);
        deleteModal.value = false;
      }
    }).catch(console.error);
}

function setPages() {
  const count = Math.ceil(contactsList.value.length / perPage.value);
  pages.value = Array.from({ length: count }, (_, i) => i + 1);
}

function dateFormat() {
  const d = new Date();
  const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
  return `${d.getDate()} ${months[d.getMonth()]}, ${d.getFullYear()}`;
}

function deleteMultiple() {
  const checkboxes = document.querySelectorAll('[name="chk_child"]:checked');
  if (checkboxes.length === 0) {
    Swal.fire({
      title: "Please select at least one checkbox",
      confirmButtonClass: "btn btn-info",
      buttonsStyling: false,
      showCloseButton: true
    });
    return;
  }

  if (!confirm("Are you sure you want to delete selected?")) return;

  const ids = Array.from(checkboxes).map(checkbox => checkbox.closest("tr").querySelector(".id a").innerText);
  contactsList.value = contactsList.value.filter(item => !ids.includes(String(item._id)));
}

onMounted(() => {
  axios.get('https://api-node.themesbrand.website/apps/contact')
    .then(({ data }) => {
      const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
      contactsList.value = data.data.map(row => {
        const d = new Date(row.last_contacted);
        const date = `${d.getDate()} ${monthNames[d.getMonth()]}, ${d.getFullYear()}`;
        const time = d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        return {
          ...row,
          last_contacted: date,
          time,
          image_src: `https://api-node.themesbrand.website/images/users/${row.image_src}`
        };
      });
    }).catch(console.error);
});
</script>

<template>
  <Layout>
    <PageHeader title="Contacts" pageTitle="CRM" />
    <BRow>
      <BCol lg="12">
        <BCard no-body>
          <BCardHeader>
            <div class="d-flex align-items-center flex-wrap gap-2">
              <div class="flex-grow-1">
                <BButton variant="info" class="add-btn me-1" @click="toggleModal">
                  <i class="ri-add-fill me-1 align-bottom"></i> Add Contacts
                </BButton>

              </div>
              <div class="flex-shrink-0">
                <div class="hstack text-nowrap gap-2">
                  <BButton variant="soft-danger" id="remove-actions" @click="deleteMultiple">
                    <i class="ri-delete-bin-2-line"></i>
                  </BButton>
                  <BButton variant="danger">
                    <i class="ri-filter-2-line me-1 align-bottom"></i> Filters
                  </BButton>
                  <BButton variant="soft-success">Import</BButton>
                  <BDropdown variant="link" class="card-header-dropdown" toggle-class="btn btn-soft-info arrow-none"
                    menu-class="dropdown-menu-end" :offset="{ alignmentAxis: -105, crossAxis: 0, mainAxis: 10 }">
                    <template #button-content><i class="ri-more-2-fill"></i></template>
                    <BDropdownItem>All</BDropdownItem>
                    <BDropdownItem>Last Week</BDropdownItem>
                    <BDropdownItem>Last Month</BDropdownItem>
                    <BDropdownItem>Last Year</BDropdownItem>
                  </BDropdown>
                </div>
              </div>
            </div>
          </BCardHeader>
        </BCard>
      </BCol>
      <BCol xxl="9">
        <BCard no-body id="contactList">
          <BCardHeader>
            <BRow class="g-3">
              <BCol md="4">
                <div class="search-box">
                  <input type="text" class="form-control search" placeholder="Search for contact..."
                    v-model="searchQuery" />
                  <i class="ri-search-line search-icon"></i>
                </div>
              </BCol>
              <BCol md="auto" class="ms-auto">
                <div class="d-flex align-items-center gap-2">
                  <span class="text-muted flex-shrink-0">Sort by: </span>
                  <Multiselect class="form-control" style="width:150px;" v-model="value" :close-on-select="true"
                    :searchable="true" :create-option="true" :options="[
                      { value: 'Name', label: 'Name' },
                      { value: 'Company', label: 'Company' },
                      { value: 'Lead', label: 'Lead' }
                    ]" />
                </div>
              </BCol>
            </BRow>
          </BCardHeader>
          <BCardBody>
            <div>
              <div class="table-responsive table-card mb-3">
                <table class="table align-middle table-nowrap mb-0" id="customerTable">
                  <thead class="table-light">
                    <tr>
                      <th scope="col" style="width: 50px">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="checkAll" value="option" />
                        </div>
                      </th>
                      <th class="sort" data-sort="name" scope="col" @click="onSort('name')">Name</th>
                      <th class="sort" data-sort="company_name" scope="col" @click="onSort('company')">
                        Company
                      </th>
                      <th class="sort" data-sort="email_id" scope="col" @click="onSort('email')">
                        Email ID
                      </th>
                      <th class="sort" data-sort="phone" scope="col" @click="onSort('phone')">
                        Phone No
                      </th>
                      <th class="sort" data-sort="lead_score" scope="col" @click="onSort('lead_score')">
                        Lead Score
                      </th>
                      <th class="sort" data-sort="Designation" scope="col" @click="onSort('tags')">
                        Tags
                      </th>
                      <th class="sort" data-sort="date" scope="col" @click="onSort('last_contacted')">
                        Last Contacted
                      </th>
                      <th scope="col">Action</th>
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
                      <td class="email_id">{{ data.email }}</td>
                      <td class="phone">{{ data.phone }}</td>
                      <td class="lead_score">{{ data.lead_score }}</td>
                      <td class="tags">
                        <span v-for="(tag, index) of data.tags" :key="index">
                          &nbsp;<BBadge variant="primary-subtle" class="bg-primary-subtle text-primary"> {{ tag
                          }}</BBadge>
                        </span>
                      </td>
                      <td> <span class="date">{{ data.last_contacted }}</span>&nbsp;<small class="text-muted time">{{
                        data.time
                      }}</small> </td>
                      <td>
                        <ul class="list-inline hstack gap-2 mb-0">
                          <li class="list-inline-item edit" v-b-tooltip.hover title="Call">
                            <BLink href="javascript:void(0);" class="text-muted d-inline-block">
                              <i class="ri-phone-line fs-16"></i>
                            </BLink>
                          </li>
                          <li class="list-inline-item edit" v-b-tooltip.hover title="Message">
                            <BLink href="javascript:void(0);" class="text-muted d-inline-block">
                              <i class="ri-question-answer-line fs-16"></i>
                            </BLink>
                          </li>
                          <li class="list-inline-item">
                            <BDropdown variant="link" toggle-class="btn btn-soft-secondary btn-sm dropdown arrow-none"
                              menu-class="dropdown-menu-end"
                              :offset="{ alignmentAxis: -130, crossAxis: 0, mainAxis: 10 }">
                              <template #button-content><i class="ri-more-fill align-middle"></i></template>
                              <BDropdownItem @click="showdetail(data)"><i
                                  class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                View</BDropdownItem>
                              <BDropdownItem @click="editDetails(data)"><i
                                  class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                Edit </BDropdownItem>
                              <BDropdownItem @click="deleteModalToggle(data)"> <i
                                  class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                Delete </BDropdownItem>
                            </BDropdown>
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
              </div>
              <div class="d-flex justify-content-end mt-3" v-if="resultQuery.length >= 1">
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
      <BCol xxl="3">
        <BCard no-body id="contact-view-detail">
          <BCardBody class="text-center">
            <div class="position-relative d-inline-block">
              <img src="@/assets/images/users/avatar-10.jpg" id="image" alt=""
                class="avatar-lg rounded-circle img-thumbnail">
              <span class="contact-active position-absolute rounded-circle bg-success"><span
                  class="visually-hidden"></span></span>
            </div>
            <h5 class="mt-4 mb-1" id="name">Tonya Noble</h5>
            <p class="text-muted" id="company">Nesta Technologies</p>

            <ul class="list-inline mb-0">
              <li class="list-inline-item avatar-xs">
                <BLink href="javascript:void(0);" class="avatar-title bg-success-subtle text-success fs-15 rounded">
                  <i class="ri-phone-line"></i>
                </BLink>
              </li>
              <li class="list-inline-item avatar-xs">
                <BLink href="javascript:void(0);" class="avatar-title bg-danger-subtle text-danger fs-15 rounded">
                  <i class="ri-mail-line"></i>
                </BLink>
              </li>
              <li class="list-inline-item avatar-xs">
                <BLink href="javascript:void(0);" class="avatar-title bg-warning-subtle text-warning fs-15 rounded">
                  <i class="ri-question-answer-line"></i>
                </BLink>
              </li>
            </ul>
          </BCardBody>
          <BCardBody>
            <h6 class="text-muted text-uppercase fw-semibold mb-3">Personal Information</h6>
            <p class="text-muted mb-4">Hello, I'm Tonya Noble, The most effective objective is
              one that is tailored to the job you are applying for. It states what kind of
              career you are seeking, and what skills and experiences.</p>
            <div class="table-responsive table-card">
              <table class="table table-borderless mb-0">
                <tbody>
                  <tr>
                    <td class="fw-medium" scope="row">Designation</td>
                    <td id="designation">Lead Designer / Developer</td>
                  </tr>
                  <tr>
                    <td class="fw-medium" scope="row">Email ID</td>
                    <td id="email">tonyanoble@velzon.com</td>
                  </tr>
                  <tr>
                    <td class="fw-medium" scope="row">Phone No</td>
                    <td id="phoneno">414-453-5725</td>
                  </tr>
                  <tr>
                    <td class="fw-medium" scope="row">Lead Score</td>
                    <td id="leadscoreno">154</td>
                  </tr>
                  <tr>
                    <td class="fw-medium" scope="row">Tags</td>
                    <td id="tags" class="hstack gap-1">
                      <BBadge variant="primary-subtle" class="bg-primary-subtle text-primary">Lead</BBadge>
                      <BBadge variant="primary-subtle" class="bg-primary-subtle text-primary">Partner</BBadge>
                    </td>
                  </tr>
                  <tr>
                    <td class="fw-medium" scope="row">Last Contacted</td>
                    <td><span id="lastdate">15 Dec, 2021 </span><small class="text-muted" id="lasttime">08:58AM</small>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <!-- add contact modal  -->
    <BModal v-model="addContactModal" id="showmodal" hide-footer title-class="exampleModalLabel"
      header-class="bg-info-subtle p-3" class="v-modal-custom" centered
      :title="dataEdit ? 'Edit Contact' : 'Add Contact'">
      <BFrom action="" id="addform" class="tablelist-form" autocomplete="off">
        <input type="hidden" id="id" />
        <BRow class="g-3">
          <BCol lg="12">
            <div class="text-center">
              <div class="position-relative d-inline-block">
                <div class="position-absolute  bottom-0 end-0">
                  <label for="customer-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right"
                    aria-label="Select Image" data-bs-original-title="Select Image">
                    <div class="avatar-xs cursor-pointer">
                      <div class="avatar-title bg-light border rounded-circle text-muted">
                        <i class="ri-image-fill"></i>
                      </div>
                    </div>
                  </label>
                  <input class="form-control d-none" value="" id="customer-image-input" type="file"
                    accept="image/png, image/gif, image/jpeg">
                </div>
                <div class="avatar-lg p-1">
                  <div class="avatar-title bg-light rounded-circle">
                    <img :src="event.image_src || require('@/assets/images/users/user-dummy-img.jpg')" id="customer-img"
                      class="avatar-md rounded-circle object-fit-cover">
                  </div>
                </div>
              </div>
            </div>
            <div>
              <label for="name-field" class="form-label">Name</label>
              <input type="text" id="customername" class="form-control" placeholder="Enter name" v-model="event.name"
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
          <BCol lg="12">
            <div>
              <label for="designation-field" class="form-label">Designation</label>
              <input type="text" id="designation-field" class="form-control" placeholder="Enter designation"
                v-model="event.designation" :class="{ 'is-invalid': submitted && !event.designation }" />
              <div class="invalid-feedback">Please enter a designation.</div>
            </div>
          </BCol>
          <BCol lg="12">
            <div>
              <label for="email_id-field" class="form-label">Email ID</label>
              <input type="text" id="emailid" class="form-control" placeholder="Enter email" v-model="event.email"
                :class="{ 'is-invalid': submitted && !event.email }" />
              <div class="invalid-feedback">Please enter a email.</div>
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
          <BCol lg="6">
            <div>
              <label for="lead_score-field" class="form-label">Lead Score</label>
              <input type="text" id="leadscore" class="form-control" placeholder="Enter value" v-model="event.lead_score"
                :class="{ 'is-invalid': submitted && !event.lead_score }" />
              <div class="invalid-feedback">Please enter a lead score.</div>
            </div>
          </BCol>
          <div>
            <label for="" class="form-label">Tags</label>
            <Multiselect mode="tags" :close-on-select="true" :searchable="true" :create-option="false"
              :options="tagoption" v-model="event.tags" :class="{ 'is-invalid': submitted && !event.tags }" />
            <div class="invalid-feedback">Please select a tags.</div>
          </div>
        </BRow>
        <div class="hstack gap-2 justify-content-end mt-3">
          <BButton type="button" variant="light" @click="addContactModal = false" id="edtclosemodal">Close</BButton>
          <BButton type="button" variant="success" id="add-btn" @click="handleSubmit">
            {{ dataEdit ? 'Update' : 'Add Contact' }}
          </BButton>
        </div>
      </BFrom>
    </BModal>

    <!-- delete modal -->
    <BModal v-model="deleteModal" modal-class="zoomIn" hide-footer no-close-on-backdrop centered>
      <div class="mt-2 text-center">
        <lottie class="avatar-xl" colors="primary:#f7b84b,secondary:#f06548" :options="defaultOptions1" :height="100"
          :width="100" />
        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
          <h4>You are about to delete a contact ?</h4>
          <p class="text-muted mx-4 mb-0">Deleting your contact will remove all of your information from our database.</p>
        </div>
      </div>
      <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
        <BButton variant="light" class="w-sm" @click="deleteModal = false">Close</BButton>
        <BButton variant="danger" class="w-sm" id="delete-record" @click="deleteData">Yes, Delete It!</BButton>
      </div>
    </BModal>
  </Layout>
</template>