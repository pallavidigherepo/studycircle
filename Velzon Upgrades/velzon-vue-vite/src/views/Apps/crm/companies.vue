<script setup>
import { ref, reactive, computed, watch, onMounted, onBeforeMount } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';

import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";

import Layout from "@/layouts/main.vue";
import PageHeader from "@/components/page-header.vue";
import Lottie from "@/components/widgets/lottie.vue";
import animationData from "@/components/widgets/msoeawqm.json";
import animationData1 from "@/components/widgets/gsqxdxog.json";

// Components
const components = { Layout, PageHeader, Lottie, Multiselect };

// Reactive state
const addCompanyModal = ref(false);
const value = ref(null);
const page = ref(1);
const perPage = ref(8);
const pages = ref([]);
const searchQuery = ref('');
const companies = ref([]);

const defaultOptions = { animationData };
const defaultOptions1 = { animationData: animationData1 };

const submitted = ref(false);
const dataEdit = ref(false);
const deleteModal = ref(false);

const event = reactive({
  _id: "",
  image_src: "",
  name: "",
  owner: "",
  industry_type: "",
  star_value: "",
  location: "",
  employee: "",
  website: "",
  contact_email: "",
  since: "",
});

// Pagination
const setPages = () => {
  const numberOfPages = Math.ceil(companies.value.length / perPage.value);
  pages.value = Array.from({ length: numberOfPages }, (_, i) => i + 1);
};

const paginate = (data) => {
  const from = page.value * perPage.value - perPage.value;
  const to = page.value * perPage.value;
  return data.slice(from, to);
};

const displayedPosts = computed(() => paginate(companies.value));

// Search filter
const resultQuery = computed(() => {
  if (searchQuery.value) {
    const search = searchQuery.value.toLowerCase();
    return displayedPosts.value.filter(data =>
      data.contact_email.toLowerCase().includes(search) ||
      data.employee.toLowerCase().includes(search) ||
      data.owner.toLowerCase().includes(search) ||
      data.industry_type.toLowerCase().includes(search) ||
      data.website.toLowerCase().includes(search) ||
      data.star_value.toString().toLowerCase().includes(search) ||
      data.name.toLowerCase().includes(search) ||
      data.location.toLowerCase().includes(search)
    );
  }
  return displayedPosts.value;
});

// Watch for data changes
watch(companies, setPages);

// CRUD and sorting logic
const handleSubmit = () => {
  submitted.value = true;
  const requiredFields = [
    event.name, event.owner, event.industry_type, event.star_value,
    event.location, event.employee, event.website, event.contact_email, event.since
  ];

  if (!requiredFields.every(Boolean)) return;

  if (dataEdit.value) {
    addCompanyModal.value = false;
    axios.patch(`https://api-node.themesbrand.website/apps/company/${event._id}`, event)
      .then(({ data }) => {
        companies.value = companies.value.map(item =>
          item._id === data.data._id ? { ...item, ...data.data } : item
        );
      }).catch(console.log);
  } else {
    const newCompany = {
      _id: Math.floor(Math.random() * 100 + 20),
      image_src: require("@/assets/images/users/multi-user.jpg"),
      ...event
    };

    addCompanyModal.value = false;
    axios.post('https://api-node.themesbrand.website/apps/company', newCompany)
      .then(({ data }) => {
        companies.value.unshift(data.data);
      }).catch(console.log);
  }
};

const onSort = (column) => {
  const dir = direction.value === 'asc' ? 'desc' : 'asc';
  direction.value = dir;
  companies.value.sort((a, b) => {
    const res = a[column] < b[column] ? -1 : a[column] > b[column] ? 1 : 0;
    return dir === 'asc' ? res : -res;
  });
};

const direction = ref('asc');

const editDetails = (data) => {
  dataEdit.value = true;
  addCompanyModal.value = true;
  Object.assign(event, data);
  submitted.value = false;
};

const toggleModal = () => {
  addCompanyModal.value = true;
  dataEdit.value = false;
  Object.keys(event).forEach(key => event[key] = '');
  submitted.value = false;
};

const deleteModalToggle = (data) => {
  deleteModal.value = true;
  event._id = data._id;
};

const deleteData = () => {
  if (!event._id) return;
  axios.delete(`https://api-node.themesbrand.website/apps/company/${event._id}`)
    .then(({ data }) => {
      if (data.status === 'success') {
        companies.value = companies.value.filter(item => item._id !== event._id);
      }
    }).catch(console.log);
  deleteModal.value = false;
};

const deleteMultiple = () => {
  const ids = [];
  document.getElementsByName("chk_child").forEach(ele => {
    if (ele.checked) {
      const id = ele.closest("tr").querySelector(".id a").innerHTML;
      ids.push(id);
    }
  });

  if (ids.length > 0) {
    if (confirm("Are you sure you want to delete this?")) {
      companies.value = companies.value.filter(item => !ids.includes(item._id.toString()));
      document.getElementById("checkAll").checked = false;
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

const showdetail = (data) => {
  document.getElementById('imageid').src = data.image_src;
  document.getElementById('cname').innerText = data.name;
  document.getElementById('oname').innerText = data.owner;
  document.getElementById('iname').innerText = data.industry_type;
  document.getElementById('rtng').innerText = data.star_value;
  document.getElementById('loc').innerText = data.location;
  document.getElementById('emp').innerText = data.employee;
  document.getElementById('webs').innerText = data.website;
  document.getElementById('eml').innerText = data.contact_email;
  document.getElementById('sic').innerText = data.since;
};

// Lifecycle hooks
onBeforeMount(() => {
  axios.get('https://api-node.themesbrand.website/apps/company')
    .then(({ data }) => {
      companies.value = data.data.map(row => ({
        ...row,
        image_src: `https://api-node.themesbrand.website/images/${row.image_src}`
      }));
    }).catch(console.log);
});

onMounted(() => {
  const checkAll = document.getElementById("checkAll");
  if (checkAll) {
    checkAll.onclick = () => {
      const checkboxes = document.querySelectorAll('.form-check-all input[type="checkbox"]');
      const checked = checkAll.checked;
      checkboxes.forEach(cb => {
        cb.checked = checked;
        cb.closest("tr").classList.toggle("table-active", checked);
      });
      document.getElementById('remove-actions').style.display = checked ? 'block' : 'none';
    };
  }

  document.querySelectorAll('#companyList .form-check-input').forEach(element => {
    element.addEventListener('change', () => {
      const checkedCount = document.querySelectorAll('#companyList .form-check-input:checked').length;
      document.getElementById("remove-actions").style.display = checkedCount > 0 ? 'block' : 'none';
    });
  });
});
</script>


<template>
  <Layout>
    <PageHeader title="Companies" pageTitle="CRM" />
    <BRow>
      <BCol lg="12">
        <BCard no-body>
          <BCardHeader>
            <div class="d-flex align-items-center flex-wrap gap-2">
              <div class="flex-grow-1">
                <BButton variant="info" class="add-btn me-1" @click="toggleModal">
                  <i class="ri-add-fill me-1 align-bottom"></i> Add Company
                </BButton>

              </div>
              <div class="flex-shrink-0">
                <div class="hstack text-nowrap gap-2">
                  <BButton variant="soft-danger" id="remove-actions" class="material-shadow-none" @click="deleteMultiple">
                    <i class="ri-delete-bin-2-line"></i>
                  </BButton>
                  <BButton variant="danger" class="material-shadow-none">
                    <i class="ri-filter-2-line me-1 align-bottom"></i> Filters
                  </BButton>
                  <BButton variant="soft-success" class="material-shadow-none">Import</BButton>
                  <BDropdown variant="link" class="card-header-dropdown material-shadow-none" toggle-class="btn btn-soft-info" no-caret
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
        <BCard no-body id="companyList">
          <BCardHeader>
            <BRow class="g-2">
              <BCol md="3">
                <div class="search-box">
                  <input type="text" class="form-control search" placeholder="Search for company..."
                    v-model="searchQuery" />
                  <i class="ri-search-line search-icon"></i>
                </div>
              </BCol>
              <BCol md="auto" class="ms-auto">
                <div class="d-flex align-items-center gap-2">
                  <span class="text-muted flex-shrink-0">Sort by: </span>

                  <Multiselect class="form-control" style="width:150px;" v-model="value" :close-on-select="true"
                    :searchable="true" :create-option="true" :options="[
                      { value: 'Owner', label: 'Owner' },
                      { value: 'Company', label: 'Company' },
                      { value: 'location', label: 'Location' },
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
                      <th class="sort" data-sort="name" scope="col" @click="onSort('name')">
                        Company Name
                      </th>
                      <th class="sort" data-sort="owner" scope="col" @click="onSort('owner')">Owner</th>
                      <th class="sort" data-sort="industry_type" scope="col" @click="onSort('industry_type')">
                        Industry Type
                      </th>
                      <th class="sort" data-sort="star_value" scope="col" @click="onSort('star_value')">
                        Rating
                      </th>
                      <th class="sort" data-sort="location" scope="col" @click="onSort('location               ')">
                        Location
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
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="flex-shrink-0">
                            <img :src="data.image_src" alt="" class="avatar-xxs rounded-circle" />
                          </div>
                          <div class="flex-grow-1 ms-2 name">
                            {{ data.name }}
                          </div>
                        </div>
                      </td>
                      <td class="owner">{{ data.owner }}</td>
                      <td class="industry_type">{{ data.industry_type }}</td>
                      <td>
                        <span class="star_value">{{ data.star_value }}</span>
                        <i class="ri-star-fill text-warning align-bottom"></i>
                      </td>
                      <td class="location">{{ data.location }}</td>
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
                          <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="View"
                            @click="showdetail(data)">
                            <BLink href="javascript:void(0);"><i class="ri-eye-fill align-bottom text-muted"></i>
                            </BLink>
                          </li>
                          <li class="list-inline-item" data-bs-trigger="hover" title="Edit" @click="editDetails(data)">
                            <BLink class="edit-item-btn"><i class="ri-pencil-fill align-bottom text-muted"></i>
                            </BLink>
                          </li>
                          <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Delete"
                            @click="deleteModalToggle(data)">
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
                <BLink class="page-item pagination-next" href="#" @click="page++" :disabled="page >= pages.length">
                  Next
                </BLink>
              </div>
            </div>
          </BCardBody>
        </BCard>
      </BCol>
      <BCol xxl="3">
        <BCard no-body>
          <BCardBody class="text-center">
            <div class="position-relative d-inline-block">
              <div class="avatar-md">
                <div class="avatar-title bg-light rounded-circle">
                  <img src="@/assets/images/brands/mail_chimp.png" alt=""
                    class="avatar-sm rounded-circle object-fit-cover" id="imageid" />
                </div>
              </div>
            </div>
            <h5 class="mt-3 mb-1" id="cname">Syntyce Solution</h5>
            <p class="text-muted" id="oname">Michael Morris</p>

            <ul class="list-inline mb-0">
              <li class="list-inline-item avatar-xs">
                <BLink href="javascript:void(0);" class="avatar-title bg-success-subtle text-success fs-15 rounded">
                  <i class="ri-global-line"></i>
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
            <h6 class="text-muted text-uppercase fw-semibold mb-3">
              Information
            </h6>
            <p class="text-muted mb-4">
              A company incurs fixed and variable costs such as the purchase of
              raw materials, salaries and overhead, as explained by
              AccountingTools, Inc. Business owners have the discretion to
              determine the actions.
            </p>
            <div class="table-responsive table-card">
              <table class="table table-borderless mb-0">
                <tbody>
                  <tr>
                    <td class="fw-medium" scope="row">Industry Type</td>
                    <td id="iname">Chemical Industries</td>
                  </tr>
                  <tr>
                    <td class="fw-medium" scope="row">Location</td>
                    <td id="loc">Damascus, Syria</td>
                  </tr>
                  <tr>
                    <td class="fw-medium" scope="row">Employee</td>
                    <td id="emp">10-50</td>
                  </tr>
                  <tr>
                    <td class="fw-medium" scope="row">Rating</td>
                    <td>
                      <span id="rtng">4.0</span> <i class="ri-star-fill text-warning align-bottom"></i>
                    </td>
                  </tr>
                  <tr>
                    <td class="fw-medium" scope="row">Website</td>
                    <td>
                      <BLink href="javascript:void(0);" class="link-primary text-decoration-underline" id="webs">
                        www.syntycesolution.com</BLink>
                    </td>
                  </tr>
                  <tr>
                    <td class="fw-medium" scope="row">Contact Email</td>
                    <td id="eml">info@syntycesolution.com</td>
                  </tr>
                  <tr>
                    <td class="fw-medium" scope="row">Since</td>
                    <td id="sic">1995</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <BModal v-model="addCompanyModal" id="showmodal" hide-footer title-class="exampleModalLabel"
      header-class="bg-info-subtle p-3" class="v-modal-custom" centered size="lg"
      :title="dataEdit ? 'Edit Company' : 'Add Company'">
      <b-form id="addform" class="tablelist-form" autocomplete="off">
        <input type="hidden" id="id">
        <BRow class="g-3">
          <BCol lg="12">
            <div class="text-center">
              <div class="position-relative d-inline-block">
                <div class="position-absolute bottom-0 end-0">
                  <label for="company-logo-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right"
                    aria-label="Select Image">
                    <div class="avatar-xs cursor-pointer">
                      <div class="avatar-title bg-light border rounded-circle text-muted">
                        <i class="ri-image-fill"></i>
                      </div>
                    </div>
                  </label>
                  <input class="form-control d-none" value="" id="company-logo-input" type="file"
                    accept="image/png, image/gif, image/jpeg">
                </div>
                <div class="avatar-lg p-1">
                  <div class="avatar-title bg-light rounded-circle">
                    <img :src="event.image_src || require('@/assets/images/users/multi-user.jpg')" id="companylogo-img"
                      class="avatar-md rounded-circle object-fit-cover">
                  </div>
                </div>
              </div>
              <h5 class="fs-13 mt-3">Company Logo</h5>
            </div>
            <div>
              <label for="companyname" class="form-label">Name</label>
              <input type="text" id="companyname" class="form-control" placeholder="Enter company name"
                v-model="event.name" :class="{ 'is-invalid': submitted && !event.name }">
              <div class="invalid-feedback">Please enter a company name.</div>
            </div>
          </BCol>
          <BCol lg="6">
            <div>
              <label for="ownername" class="form-label">Owner Name</label>
              <input type="text" id="ownername" class="form-control" placeholder="Enter owner name" v-model="event.owner"
                :class="{ 'is-invalid': submitted && !event.owner }">
              <div class="invalid-feedback">Please enter a owner name.</div>
            </div>
          </BCol>
          <BCol lg="6">
            <div>
              <label for="industrytype" class="form-label">Industry Type</label>
              <select class="form-select" id="industrytype" v-model="event.industry_type"
                :class="{ 'is-invalid': submitted && !event.industry_type }">
                <option value="">Select industry type</option>
                <option value="Computer Industry">Computer Industry</option>
                <option value="Chemical Industries">Chemical Industries</option>
                <option value="Health Services">Health Services</option>
                <option value="Telecommunications Services">Telecommunications Services</option>
                <option value="Textiles: Clothing, Footwear">Textiles: Clothing, Footwear</option>
              </select>
              <div class="invalid-feedback">Please select a industry type.</div>
            </div>
          </BCol>
          <BCol lg="4">
            <div>
              <label for="starvalue" class="form-label">Rating</label>
              <input type="text" id="starvalue" class="form-control" placeholder="Enter rating" v-model="event.star_value"
                :class="{ 'is-invalid': submitted && !event.star_value }">
              <div class="invalid-feedback">Please enter a rating.</div>
            </div>
          </BCol>
          <BCol lg="4">
            <div>
              <label for="location" class="form-label">Location</label>
              <input type="text" id="location" class="form-control" placeholder="Enter location" v-model="event.location"
                :class="{ 'is-invalid': submitted && !event.location }">
              <div class="invalid-feedback">Please enter a location.</div>
            </div>
          </BCol>
          <BCol lg="4">
            <div>
              <label for="employee" class="form-label">Employee</label>
              <input type="text" id="employee" class="form-control" placeholder="Enter employee" v-model="event.employee"
                :class="{ 'is-invalid': submitted && !event.employee }">
              <div class="invalid-feedback">Please enter a employee.</div>
            </div>
          </BCol>
          <BCol lg="6">
            <div>
              <label for="website" class="form-label">Website</label>
              <input type="text" id="website" class="form-control" placeholder="Enter website" v-model="event.website"
                :class="{ 'is-invalid': submitted && !event.website }">
              <div class="invalid-feedback">Please enter a website.</div>
            </div>
          </BCol>
          <BCol lg="6">
            <div>
              <label for="contactemail" class="form-label">Contact Email</label>
              <input type="text" id="contactemail" class="form-control" placeholder="Enter contact email"
                v-model="event.contact_email" :class="{ 'is-invalid': submitted && !event.contact_email }">
              <div class="invalid-feedback">Please enter a email.</div>
            </div>
          </BCol>
          <BCol lg="12">
            <div>
              <label for="since" class="form-label">Since</label>
              <input type="text" id="since" class="form-control" placeholder="Enter since" v-model="event.since"
                :class="{ 'is-invalid': submitted && !event.since }">
              <div class="invalid-feedback">Please enter a year.</div>
            </div>
          </BCol>
        </BRow>
        <div class="hstack gap-2 justify-content-end mt-3">
          <BButton type="button" variant="light" id="closemodal" @click="addCompanyModal = false">Close</BButton>
          <BButton type="button" variant="success" id="add-btn" @click="handleSubmit">
            {{ dataEdit ? 'Update' : 'Add Company' }}
          </BButton>
        </div>
      </b-form>
    </BModal>

    <!-- delete modal -->
    <BModal v-model="deleteModal" modal-class="zoomIn" hide-footer no-close-on-backdrop centered>
      <div class="mt-2 text-center">
        <lottie class="avatar-xl" colors="primary:#f7b84b,secondary:#f06548" :options="defaultOptions1" :height="100"
          :width="100" />
        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
          <h4>You are about to delete a contact ?</h4>
          <p class="text-muted mx-4 mb-0">ADeleting your contact will remove all of your information from our database.</p>
        </div>
      </div>
      <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
        <BButton variant="light" class="w-sm" @click="deleteModal = false">Close</BButton>
        <BButton variant="danger" class="w-sm" id="delete-record" @click="deleteData">Yes, Delete It!</BButton>
      </div>
    </BModal>
  </Layout>
</template>