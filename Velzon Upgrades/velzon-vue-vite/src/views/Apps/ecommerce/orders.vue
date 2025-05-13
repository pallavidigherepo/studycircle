<script setup>
import { ref, reactive, computed, onMounted, watch, onBeforeMount } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';

import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";

import Layout from "@/layouts/main.vue";
import PageHeader from "@/components/page-header.vue";
import animationData from "@/components/widgets/msoeawqm.json";
import animationData1 from "@/components/widgets/gsqxdxog.json";
import Lottie from "@/components/widgets/lottie.vue";

// UI State
const createModal = ref(false);
const editOrderModal = ref(false);
const deleteModal = ref(false);

// Pagination
const page = ref(1);
const perPage = ref(8);
const pages = ref([]);

// Filters
const searchQuery = ref(null);
const status = ref(null);
const value = ref(null);
const date = ref(null);
const date2 = ref(null);
const status1 = ref(null);
const value1 = ref(null);
const statuscategory = ref('All');

// Form + Submission
const submitted = ref(false);
const dataEdit = ref(false);
const event = reactive({
  _id: '',
  customer: '',
  orderId: '',
  orderDate: '',
  amount: '',
  payment: '',
  product: '',
  status: ''
});

// Date pickers
const config = {
  wrap: true,
  altFormat: "M j, Y",
  altInput: true,
  dateFormat: "d M, Y",
  mode: "range"
};

const timeConfig = {
  enableTime: false,
  dateFormat: "d M, Y"
};

// Animation
const defaultOptions = { animationData };
const defaultOptions1 = { animationData: animationData1 };

// Orders
const orders = ref([]);
const isStatus = ref(null);
const isPayment = ref(null);

// Utils
const paginate = (items) => {
  const from = page.value * perPage.value - perPage.value;
  const to = page.value * perPage.value;
  return items.slice(from, to);
};

const displayedPosts = computed(() => paginate(orders.value));

const resultQuery = computed(() => {
  if (searchQuery.value) {
    const search = searchQuery.value.toLowerCase();
    return displayedPosts.value.filter(data =>
      data.orderId.toLowerCase().includes(search) ||
      data.customer.toLowerCase().includes(search) ||
      data.product.toLowerCase().includes(search) ||
      data.orderDate.toLowerCase().includes(search) ||
      data.amount.toString().toLowerCase().includes(search) ||
      data.payment.toLowerCase().includes(search) ||
      data.status.toLowerCase().includes(search)
    );
  } else if (date.value) {
    const [date1, date2] = date.value.split(" to ");
    return displayedPosts.value.filter(data => {
      const orderDate = new Date(data.orderDate.slice(0, 12));
      return orderDate >= new Date(date1) && orderDate <= new Date(date2);
    });
  } else if (status.value || value.value) {
    return displayedPosts.value.filter(data => {
      const statusMatch = status.value === 'All' || data.status === status.value;
      const paymentMatch = value.value === 'All' || data.payment === value.value;
      return statusMatch && paymentMatch;
    });
  } else {
    return displayedPosts.value;
  }
});

watch(orders, () => {
  setPages();
});

const setPages = () => {
  const numberOfPages = Math.ceil(orders.value.length / perPage.value);
  pages.value = Array.from({ length: numberOfPages }, (_, i) => i + 1);
};

const handleSubmit = () => {
  submitted.value = true;
  if (event.customer && event.payment && event.orderDate && event.amount && event.status) {
    createModal.value = false;

    if (dataEdit.value) {
      axios.patch(`https://api-node.themesbrand.website/apps/order/${event._id}`, event)
        .then(response => {
          const updated = response.data.data;
          orders.value = orders.value.map(item =>
            item._id === updated._id ? { ...item, ...updated } : item
          );
        });
    } else {
      const newOrder = {
        _id: Math.floor(Math.random() * 100 + 20),
        orderId: "#VZ2" + Math.floor(Math.random() * 100 + 20),
        ...event
      };

      axios.post(`https://api-node.themesbrand.website/apps/order`, newOrder)
        .then(response => {
          orders.value.unshift(response.data.data);
        });
    }
  }
};

const editDetails = (data) => {
  dataEdit.value = true;
  createModal.value = true;
  Object.assign(event, data);
  submitted.value = false;
};

const toggleModal = () => {
  createModal.value = true;
  dataEdit.value = false;
  Object.assign(event, {});
  submitted.value = false;
};

const deleteModalToggle = (data) => {
  deleteModal.value = true;
  event._id = data._id;
};

const deleteData = () => {
  if (event._id) {
    axios.delete(`https://api-node.themesbrand.website/apps/order/${event._id}`)
      .then(response => {
        if (response.data.status === 'success') {
          orders.value = orders.value.filter(item => item._id !== event._id);
        }
      });
    deleteModal.value = false;
  }
};

const onSort = (column) => {
  direction.value = direction.value === 'asc' ? 'desc' : 'asc';
  const sorted = [...orders.value].sort((a, b) => {
    const result = a[column] < b[column] ? -1 : a[column] > b[column] ? 1 : 0;
    return direction.value === 'asc' ? result : -result;
  });
  orders.value = sorted;
};

const deleteMultiple = () => {
  const checkboxes = document.querySelectorAll('[name="chk_child"]:checked');
  if (checkboxes.length) {
    if (confirm("Are you sure you want to delete this?")) {
      const idsToRemove = Array.from(checkboxes).map(cb =>
        cb.closest("tr").querySelector(".id a").innerText
      );
      orders.value = orders.value.filter(order => !idsToRemove.includes(order.orderId));
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

const SearchData = () => {
  date.value = date2.value;
  status.value = status1.value;
  value.value = value1.value;
};

const changecategory = (val) => {
  statuscategory.value = val;
};

const direction = ref('asc');

onBeforeMount(() => {
  axios.get('https://api-node.themesbrand.website/apps/order')
    .then(response => {
      const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
      orders.value = response.data.data.map(order => {
        const dd = new Date(order.orderDate);
        order.orderDate = `${dd.getDate()} ${monthNames[dd.getMonth()]}, ${dd.getFullYear()}`;
        return order;
      });
    });
});

onMounted(() => {
  const checkAll = document.getElementById("checkAll");
  if (checkAll) {
    checkAll.onclick = () => {
      const checkboxes = document.querySelectorAll('.form-check-all input[type="checkbox"]');
      checkboxes.forEach(cb => {
        cb.checked = checkAll.checked;
        cb.closest("tr").classList.toggle("table-active", checkAll.checked);
      });
      document.getElementById("remove-actions").style.display = checkAll.checked ? "block" : "none";
    };
  }

  document.querySelectorAll('#orderTable .form-check-input').forEach(checkbox => {
    checkbox.addEventListener('change', () => {
      const count = document.querySelectorAll('#orderTable .form-check-input:checked').length;
      document.getElementById("remove-actions").style.display = count > 0 ? "block" : "none";
    });
  });
});
</script>

<template>
  <Layout>
    <PageHeader title="Orders" pageTitle="Ecommerce" />
    <BRow>
      <BCol lg="12">
        <BCard no-body id="orderList">
          <BCardHeader class="border-0">
            <BRow class="align-items-center gy-3">
              <BCol cols="sm">
                <h5 class="card-title mb-0">Order History</h5>
              </BCol>
              <BCol sm="auto">
                <div class="d-flex gap-1 flex-wrap">
                  <BButton type="button" variant="success" class="add-btn" id="create-btn" @click="toggleModal">
                    <i class="ri-add-line align-bottom me-1"></i> Create Order
                  </BButton>
                  <BButton type="button" variant="info" class="ms-1">
                    <i class="ri-file-download-line align-bottom me-1"></i> Import
                  </BButton>
                  <BButton variant="soft-danger" class="me-1" id="remove-actions" @click="deleteMultiple">
                    <i class="ri-delete-bin-2-line"></i>
                  </BButton>
                </div>
              </BCol>
            </BRow>
          </BCardHeader>
          <BCardBody class="border border-dashed border-end-0 border-start-0">
            <BFrom>
              <BRow class="g-3">
                <BCol xxl="5" sm="6">
                  <div class="search-box">
                    <input type="text" class="form-control search" v-model="searchQuery"
                      placeholder="Search for order ID, customer, order status or something..." />
                    <i class="ri-search-line search-icon"></i>
                  </div>
                </BCol>
                <BCol xxl="2" sm="6">
                  <div>
                    <flat-pickr placeholder="Select date" v-model="date2" :config="config"
                      class="form-control flatpickr-input" id="demo-datepicker"></flat-pickr>
                  </div>
                </BCol>
                <BCol xxl="2" sm="4">
                  <div>
                    <Multiselect class="form-control" v-model="status1" :close-on-select="true" :searchable="true"
                      :create-option="true" @input="onChangePayment" :options="[
                        { value: '', label: 'Status' },
                        { value: 'All', label: 'All' },
                        { value: 'Pending', label: 'Pending' },
                        { value: 'Inprogress', label: 'Inprogress' },
                        { value: 'Cancelled', label: 'Cancelled' },
                        { value: 'Pickups', label: 'Pickups' },
                        { value: 'Returns', label: 'Returns' },
                        { value: 'Delivered', label: 'Delivered' },
                      ]" />
                  </div>
                </BCol>
                <BCol xxl="2" sm="4">
                  <div>
                    <Multiselect class="form-control" v-model="value1" :close-on-select="true" :searchable="true"
                      :create-option="true" @input="onChangeStatus" :options="[
                        { value: '', label: 'Select Payment' },
                        { value: 'All', label: 'All' },
                        { value: 'Mastercard', label: 'Mastercard' },
                        { value: 'Paypal', label: 'Paypal' },
                        { value: 'Visa', label: 'Visa' },
                        { value: 'COD', label: 'COD' },
                      ]" />
                  </div>
                </BCol>
                <BCol xxl="1" sm="4">
                  <div>
                    <BButton type="button" variant="primary" class="w-100" @click="SearchData">
                      <i class="ri-equalizer-fill me-1 align-bottom"></i>
                      Filters
                    </BButton>
                  </div>
                </BCol>
              </BRow>
            </BFrom>
          </BCardBody>
          <BCardBody class="pt-0">
            <div>
              <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                <li class="nav-item">
                  <BLink class="nav-link  All py-3 active" data-bs-toggle="tab" id="All" href="#home1" role="tab"
                    @click="changecategory('All')" aria-selected="true">
                    <i class="ri-store-2-fill me-1 align-bottom"></i> All Orders
                  </BLink>
                </li>
                <li class="nav-item">
                  <BLink class="nav-link py-3  Delivered" data-bs-toggle="tab" id="Delivered" href="#delivered" role="tab"
                    @click="changecategory('Delivered')" aria-selected="false">
                    <i class="ri-checkbox-circle-line me-1 align-bottom"></i>
                    Delivered
                  </BLink>
                </li>
                <li class="nav-item">
                  <BLink class="nav-link py-3 Pickups" data-bs-toggle="tab" id="Pickups" href="#pickups" role="tab"
                    @click="changecategory('Pickups')" aria-selected="false">
                    <i class="ri-truck-line me-1 align-bottom"></i> Pickups
                    <BBadge variant="danger" class="align-middle ms-1">2</BBadge>
                  </BLink>
                </li>
                <li class="nav-item">
                  <BLink class="nav-link py-3 Returns" data-bs-toggle="tab" id="Returns" href="#returns" role="tab"
                    @click="changecategory('Returns')" aria-selected="false">
                    <i class="ri-arrow-left-right-fill me-1 align-bottom"></i>
                    Returns
                  </BLink>
                </li>
                <li class="nav-item">
                  <BLink class="nav-link py-3 Cancelled" data-bs-toggle="tab" id="Cancelled" href="#cancelled" role="tab"
                    @click="changecategory('Cancelled')" aria-selected="false">
                    <i class="ri-close-circle-line me-1 align-bottom"></i>
                    Cancelled
                  </BLink>
                </li>
              </ul>

              <div class="table-responsive table-card mb-1">
                <table class="table table-nowrap align-middle" id="orderTable">
                  <thead class="text-muted table-light">
                    <tr class="text-uppercase">
                      <th scope="col" style="width: 25px">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="checkAll" value="option" />
                        </div>
                      </th>
                      <th class="sort" data-sort="id" @click="onSort('orderId')">Order ID</th>
                      <th class="sort" data-sort="customer_name" @click="onSort('customer')">Customer</th>
                      <th class="sort" data-sort="product_name" @click="onSort('orderDate')">Product</th>
                      <th class="sort" data-sort="date" @click="onSort('customer')">Order Date</th>
                      <th class="sort" data-sort="amount" @click="onSort('amount')">Amount</th>
                      <th class="sort" data-sort="payment" @click="onSort('payment')">Payment Method</th>
                      <th class="sort" data-sort="status" @click="onSort('status')">Delivery Status</th>
                      <th class="sort" data-sort="city">Action</th>
                    </tr>
                  </thead>
                  <tbody class="list form-check-all" v-for="(data, index) of resultQuery" :key="index">

                    <tr v-if="statuscategory == 'All' || statuscategory == data.status">
                      <th scope="row">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="chk_child" value="option1" />
                        </div>
                      </th>
                      <td class="id">
                        <router-link to="/ecommerce/order-details" class="fw-medium link-primary">{{ data.orderId }}
                        </router-link>
                      </td>
                      <td class="customer_name">{{ data.customer }}</td>
                      <td class="product_name">{{ data.product }}</td>
                      <td class="date">
                        {{ data.orderDate }}
                        <small class="text-muted">02:21 AM</small>
                      </td>
                      <td class="amount">${{ data.amount }}</td>
                      <td class="payment">{{ data.payment }}</td>
                      <td class="status">
                        <span class="badge text-uppercase" :class="{
                          'bg-primary-subtle text-primary': data.status == 'Inprogress',
                          'bg-info-subtle text-info': data.status == 'Pickups',
                          'bg-success-subtle text-success': data.status == 'Delivered',
                          'bg-danger-subtle text-danger': data.status == 'Cancelled',
                          'bg-secondary-subtle text-secondary': data.status == 'Returns',
                          'bg-warning-subtle text-warning': data.status == 'Pending',
                        }">{{ data.status }}</span>

                      </td>
                      <td>
                        <ul class="list-inline hstack gap-2 mb-0">
                          <li class="list-inline-item" v-b-tooltip.hover title="View">
                            <router-link to="/ecommerce/order-details" class="text-primary d-inline-block">
                              <i class="ri-eye-fill fs-16"></i>
                            </router-link>
                          </li>
                          <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                            data-bs-placement="top" title="Edit">
                            <BLink variant="text-primary" class="d-inline-block edit-item-btn" @click="editDetails(data)">
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
                    <p class="text-muted">
                      We've searched more than 150+ Orders We did not find any
                      orders for you search.
                    </p>
                  </div>
                </div>
              </div>

              <div class="d-flex justify-content-end" v-if="resultQuery.length >= 1">
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
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <!-- order modal -->
    <BModal v-model="createModal" hide-footer :title="dataEdit ? 'Edit Order' : 'Add Order'" header-class="p-3 bg-light"
      class="v-modal-custom" centered>
      <BFrom action="#" id="addform" class="tablelist-form" autocomplete="off">
        <input type="hidden" id="id-field" />

        <div class="mb-3">
          <label for="customername-field" class="form-label">Customer Name</label>
          <input type="text" id="customername" class="form-control" placeholder="Enter Name" v-model="event.customer"
            :class="{ 'is-invalid': submitted && !event.customer }" />
          <div class="invalid-feedback">Please enter customer name.</div>
        </div>

        <div class="mb-3">
          <label for="productname" class="form-label">Product</label>
          <select class="form-control" data-trigger name="productname-field" id="productname" v-model="event.product"
            :class="{ 'is-invalid': submitted && !event.product }">
            <option value="">Product</option>
            <option value="Puma Tshirt">Puma Tshirt</option>
            <option value="Adidas Sneakers">
              Adidas Sneakers
            </option>
            <option value="350 ml Glass Grocery Container">
              350 ml Glass Grocery Container
            </option>
            <option value="American egale outfitters Shirt">
              American egale outfitters Shirt
            </option>
            <option value="Galaxy Watch4">Galaxy Watch4</option>
            <option value="Apple iPhone 12">
              Apple iPhone 12
            </option>
            <option value="Funky Prints T-shirt">
              Funky Prints T-shirt
            </option>
            <option value="USB Flash Drive Personalized with 3D Print">
              USB Flash Drive Personalized with 3D Print
            </option>
            <option value="Oxford Button-Down Shirt">
              Oxford Button-Down Shirt
            </option>
            <option value="Classic Short Sleeve Shirt">
              Classic Short Sleeve Shirt
            </option>
            <option value="Half Sleeve T-Shirts (Blue)">
              Half Sleeve T-Shirts (Blue)
            </option>
            <option value="Noise Evolve Smartwatch">
              Noise Evolve Smartwatch
            </option>
          </select>
          <div class="invalid-feedback">Please select product.</div>
        </div>

        <div class="mb-3">
          <label for="date-field" class="form-label">Order Date</label>
          <flat-pickr placeholder="Select date" :config="timeConfig" v-model="event.orderDate"
            :class="{ 'is-invalid': submitted && !event.orderDate }" class="form-control flatpickr-input"
            id="orderdate"></flat-pickr>
          <div class="invalid-feedback">Please enter date.</div>
        </div>

        <BRow class="gy-4 mb-3">
          <BCol md="6">
            <div>
              <label for="amount-field" class="form-label">Amount</label>
              <input type="text" id="amount" class="form-control" placeholder="Total amount" v-model="event.amount"
                :class="{ 'is-invalid': submitted && !event.amount }" />
              <div class="invalid-feedback">Please enter an amount.</div>
            </div>
          </BCol>
          <BCol md="6">
            <div>
              <label for="payment-field" class="form-label">Payment Method</label>
              <select class="form-control" data-trigger name="payment-method" id="payment" v-model="event.payment"
                :class="{ 'is-invalid': submitted && !event.payment }">
                <option value="">Payment Method</option>
                <option value="Mastercard">Mastercard</option>
                <option value="Visa">Visa</option>
                <option value="COD">COD</option>
                <option value="Paypal">Paypal</option>
              </select>
              <div class="invalid-feedback">Please select payment method.</div>
            </div>
          </BCol>
        </BRow>

        <div class="mb-3">
          <label for="delivered-status" class="form-label">Delivery Status</label>
          <select class="form-control" data-trigger name="delivered-status" id="delivered" v-model="event.status"
            :class="{ 'is-invalid': submitted && !event.status }">
            <option value="">Delivery Status</option>
            <option value="Pending">Pending</option>
            <option value="Inprogress">Inprogress</option>
            <option value="Cancelled">Cancelled</option>
            <option value="Pickups">Pickups</option>
            <option value="Delivered">Delivered</option>
            <option value="Returns">Returns</option>
          </select>
          <div class="invalid-feedback">Please select delivered status.</div>
        </div>

        <div class="hstack gap-2 justify-content-end">
          <BButton type="button" variant="light" @click="createModal = false" id="closemodal">
            Close
          </BButton>
          <BButton type="button" variant="success" id="add-btn" @click="handleSubmit">
            {{ dataEdit ? 'Update' : 'Add Order' }}
          </BButton>
        </div>
      </BFrom>
    </BModal>

    <!-- delete modal -->
    <BModal v-model="deleteModal" modal-class="zoomIn" hide-footer no-close-on-backdrop centered>
      <div class="mt-2 text-center">
        <lottie class="avatar-xl" colors="primary:#f7b84b,secondary:#f06548" :options="defaultOptions1" :height="75"
          :width="75" />
        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
          <h4>You are about to delete a order ?</h4>
          <p class="text-muted mx-4 mb-0">Deleting your order will remove all of your information from our database.</p>
        </div>
      </div>
      <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
        <BButton variant="light" class="w-sm" @click="deleteModal = false">Close</BButton>
        <BButton variant="danger" class="w-sm" id="delete-record" @click="deleteData">Yes, Delete It!</BButton>
      </div>
    </BModal>
  </Layout>
</template>