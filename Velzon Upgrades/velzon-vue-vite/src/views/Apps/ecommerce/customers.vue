<script setup>
import { ref, reactive, computed, onMounted, onBeforeMount, watch } from 'vue';
import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
import Layout from "@/layouts/main.vue";
import PageHeader from "@/components/page-header.vue";
import Swal from "sweetalert2";
import axios from "axios";
import Lottie from "@/components/widgets/lottie.vue";
import animationData from "@/components/widgets/msoeawqm.json";
import animationData1 from "@/components/widgets/gsqxdxog.json";

const date1 = ref(null);
const date = ref(null);
const value = ref('All');
const value1 = ref(null);
const searchQuery = ref(null);
const customerList = ref([]);
const page = ref(1);
const perPage = ref(8);
const pages = ref([]);

const addCustomerModal = ref(false);
const editCustomerModal = ref(false);
const deleteModal = ref(false);
const submitted = ref(false);
const dataEdit = ref(false);
const direction = ref('asc');

const defaultOptions = { animationData };
const defaultOptions2 = { animationData: animationData1 };

const rangeDateconfig = {
  wrap: true,
  altFormat: "M j, Y",
  altInput: true,
  dateFormat: "d M, Y",
  mode: "range",
};

const config = {
  enableTime: false,
  dateFormat: "d M, Y",
};

const event = reactive({
  _id: "",
  customer: "",
  customerId: "",
  date: "",
  email: "",
  phone: "",
  status: ""
});

const paginate = (list) => {
  const from = page.value * perPage.value - perPage.value;
  const to = page.value * perPage.value;
  return list.slice(from, to);
};

const setPages = () => {
  const numberOfPages = Math.ceil(customerList.value.length / perPage.value);
  pages.value = Array.from({ length: numberOfPages }, (_, i) => i + 1);
};

const displayedPosts = computed(() => paginate(customerList.value));

const resultQuery = computed(() => {
  const search = searchQuery.value?.toLowerCase();

  if (search) {
    return displayedPosts.value.filter((data) =>
      data.customer.toLowerCase().includes(search) ||
      data.email.toLowerCase().includes(search) ||
      data.phone.includes(search) ||
      data.date.toLowerCase().includes(search) ||
      data.status.toLowerCase().includes(search)
    );
  } else if (date.value) {
    const [date1, date2] = date.value.split(" to ");
    return displayedPosts.value.filter((data) => {
      const dataDate = new Date(data.date.slice(0, 12));
      return dataDate >= new Date(date1) && dataDate <= new Date(date2);
    });
  } else if (value.value !== null) {
    return displayedPosts.value.filter((data) =>
      data.status === value.value || value.value === 'All'
    );
  } else {
    return displayedPosts.value;
  }
});

watch(customerList, setPages);

onBeforeMount(async () => {
  try {
    const res = await axios.get('https://api-node.themesbrand.website/apps/customer');
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    customerList.value = res.data.data.map(row => {
      const dd = new Date(row.date);
      row.date = `${dd.getDate()} ${monthNames[dd.getMonth()]}, ${dd.getFullYear()}`;
      return row;
    });
  } catch (error) {
    console.error(error);
  }
});
</script>


<template>
  <Layout>
    <PageHeader title="Customers" pageTitle="Ecommerce" />
    <BRow>
      <BCol lg="12">
        <BCard no-body id="customerList">
          <BCardHeader class="border-bottom-dashed">
            <BRow class="g-4 align-items-center">
              <BCol sm>
                <div>
                  <h5 class="card-title mb-0">Customer List</h5>
                </div>
              </BCol>
              <BCol sm="auto">
                <div class="d-flex flex-wrap align-items-start gap-2">
                  <BButton variant="soft-danger" class="me-1" id="remove-actions" @click="deleteMultiple">
                    <i class="ri-delete-bin-2-line"></i>
                  </BButton>
                  <BButton type="button" variant="success" class="add-btn me-1" id="create-btn" @click="toggleModal">
                    <i class="ri-add-line align-bottom me-1"></i> Add Customer
                  </BButton>
                  <BButton type="button" variant="info">
                    <i class="ri-file-download-line align-bottom me-1"></i> Import
                  </BButton>
                </div>
              </BCol>
            </BRow>
          </BCardHeader>
          <BCardBody class="border-bottom-dashed border-bottom">
            <BFrom>
              <BRow class="g-3">
                <BCol xl="6">
                  <div class="search-box">
                    <input type="text" class="form-control search"
                      placeholder="Search for customer, email, phone, status or something..." v-model="searchQuery" />
                    <i class="ri-search-line search-icon"></i>
                  </div>
                </BCol>
                <BCol xl="6">
                  <BRow class="g-3">
                    <BCol sm="4">
                      <div class="">
                        <flat-pickr v-model="date" placeholder="Select date" :config="rangeDateconfig"
                          class="form-control"></flat-pickr>
                      </div>
                    </BCol>
                    <BCol sm="4">
                      <div>
                        <Multiselect class="form-control" v-model="value1" :close-on-select="true" :searchable="true"
                          :create-option="true" :options="[
                            { value: '', label: 'Status', disabled: true },
                            { value: 'All', label: 'All' },
                            { value: 'Active', label: 'Active' },
                            { value: 'Block', label: 'Block' },
                          ]" />
                      </div>
                    </BCol>

                    <BCol sm="4">
                      <div>
                        <BButton type="button" variant="primary" class="w-100" @click="SearchData">
                          <i class="ri-equalizer-fill me-2 align-bottom"></i>Filters
                        </BButton>
                      </div>
                    </BCol>
                  </BRow>
                </BCol>
              </BRow>
            </BFrom>
          </BCardBody>
          <BCardBody>
            <div>
              <div class="table-responsive table-card mb-1">
                <table class="table align-middle" id="customerTable">
                  <thead class="table-light text-muted">
                    <tr>
                      <th scope="col" style="width: 50px">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="checkAll" value="option" />
                        </div>
                      </th>
                      <th class="sort" data-sort="customer_name" @click="onSort('customer')">Customer</th>
                      <th class="sort" data-sort="email" @click="onSort('email')">Email</th>
                      <th class="sort" data-sort="phone" @click="onSort('phone')">Phone</th>
                      <th class="sort" data-sort="date" @click="onSort('date')">Joining Date</th>
                      <th class="sort" data-sort="status" @click="onSort('status')">Status</th>
                      <th class="sort" data-sort="action">Action</th>
                    </tr>
                  </thead>
                  <tbody class="list form-check-all">
                    <tr v-for="(item, index) of resultQuery" :key="index">
                      <th scope="row">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="chk_child" value="option1" />
                        </div>
                      </th>
                      <td class="id" style="display: none">
                        <BLink href="javascript:void(0);" class="fw-medium link-primary">{{ item.customerId }}</BLink>
                      </td>
                      <td class="customer_name">{{ item.customer }}</td>
                      <td class="email">{{ item.email }}</td>
                      <td class="phone">{{ item.phone }}</td>
                      <td class="date">{{ item.date }}</td>
                      <td class="status">
                        <span class="badge text-uppercase"
                          :class="{ 'bg-success-subtle text-success': item.status == 'Active', 'bg-danger-subtle text-danger': item.status == 'Block' }">
                          {{ item.status }}
                        </span>
                      </td>
                      <td>
                        <ul class="list-inline hstack gap-2 mb-0">
                          <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                            data-bs-placement="top" title="Edit">
                            <BLink variant="text-primary" class="d-inline-block edit-item-btn"
                              @click="editDetails(item)">
                              <i class="ri-pencil-fill fs-16"></i>
                            </BLink>
                          </li>
                          <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                            data-bs-placement="top" title="Remove">
                            <BLink class="text-danger d-inline-block remove-item-btn" @click="deleteModalToggle(item)">
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
                      We've searched more than 150+ customer We did not find any
                      customer for you search.
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
                  <BLink class="page-item pagination-next" href="#" @click="page++" :disabled="page >= pages.length">
                    Next
                  </BLink>
                </div>
              </div>
            </div>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <!-- customer modal  -->
    <BModal v-model="addCustomerModal" id="showModal" hide-footer :title="dataEdit ? 'Edit Customer' : 'Add Customer'"
      header-class="p-3 bg-light" class="v-modal-custom" centered>
      <BFrom action="#" id="addform" class="tablelist-form" autocomplete="off">
        <input type="hidden" id="id-field" />

        <div class="mb-3" id="modal-id" style="display: none">
          <label for="id-field1" class="form-label">ID</label>
          <input type="text" id="idfield1" class="form-control" placeholder="ID" readonly />
        </div>

        <div class="mb-3">
          <label for="customername-field" class="form-label">Customer Name</label>
          <input type="text" id="customername" class="form-control" placeholder="Enter Name" v-model="event.customer" :class="{ 'is-invalid': submitted && !event.customer }" />
          <div class="invalid-feedback">Please enter a customer name.</div>
        </div>

        <div class="mb-3">
          <label for="email-field" class="form-label">Email</label>
          <input type="email" id="email" class="form-control" placeholder="Enter Email" 
          v-model="event.email" :class="{ 'is-invalid': submitted && !event.email }" />
          <div class="invalid-feedback">Please enter an email.</div>
        </div>

        <div class="mb-3">
          <label for="phone-field" class="form-label">Phone</label>
          <input type="text" id="phone" class="form-control" placeholder="Enter Phone no." v-model="event.phone"
            :class="{ 'is-invalid': submitted && !event.phone }" />
          <div class="invalid-feedback">Please enter a phone.</div>
        </div>

        <div class="mb-3">
          <label for="date-field" class="form-label">Joining Date</label>
          <flat-pickr :config="config" class="form-control" id="joindate" v-model="event.date"
            :class="{ 'is-invalid': submitted && !event.date }"></flat-pickr>
          <div class="invalid-feedback">Please select a date.</div>
        </div>
        <div class="mb-3">
          <label for="status-field" class="form-label">Status</label>
          <select class="form-control" data-trigger id="statusfield" v-model="event.status"
            :class="{ 'is-invalid': submitted && !event.status }">
            <option value="">Status</option>
            <option value="Active">Active</option>
            <option value="Block">Block</option>
          </select>
          <div class="invalid-feedback">Please select a status.</div>
        </div>

        <div class="hstack gap-2 justify-content-end">
          <BButton type="button" id="closemodal" variant="light" @click="addCustomerModal = false">
            Close
          </BButton>
          <BButton type="button" variant="success" @click="handleSubmit">
            {{ dataEdit ? 'Update' : 'Add Customer' }}
          </BButton>
        </div>
      </BFrom>
    </BModal>

    <!-- delete modal -->
    <BModal v-model="deleteModal" modal-class="zoomIn" hide-footer no-close-on-backdrop centered>
      <div class="mt-2 text-center">
        <lottie class="avatar-xl" colors="primary:#f7b84b,secondary:#f06548" :options="defaultOptions2" :height="100"
          :width="100" />
        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
          <h4>Are you sure ?</h4>
          <p class="text-muted mx-4 mb-0">Are you sure you want to remove this record ?</p>
        </div>
      </div>
      <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
        <BButton variant="light" class="w-sm" @click="deleteModal = false">Close</BButton>
        <BButton variant="danger" class="w-sm" id="delete-record" @click="deleteData">Yes, Delete It!</BButton>
      </div>
    </BModal>
  </Layout>
</template>