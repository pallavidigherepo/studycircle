<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import { FileTextIcon, CheckSquareIcon, ClockIcon, XOctagonIcon } from "@zhuowenli/vue-feather-icons";
import Multiselect from "@vueform/multiselect";
import flatPickr from "vue-flatpickr-component";
import Swal from "sweetalert2";
import axios from 'axios';
import animationData from "@/components/widgets/msoeawqm.json";
import animationData1 from "@/components/widgets/gsqxdxog.json";
import Lottie from "@/components/widgets/lottie.vue";
import Layout from "@/layouts/main.vue";
import PageHeader from "@/components/page-header.vue";

// Props if needed for custom components can go here
const config = ref({
  mode: "range",
  wrap: true, // set wrap to true only when using 'input-group'
  altFormat: "M j, Y",
  altInput: true,
  dateFormat: "d M, Y",
});

const date = ref(null);
const page = ref(1);
const status = ref(null);
const status1 = ref(null);
const invoiceListModal = ref(false);
const perPage = ref(9);
const pages = ref([]);
const value = ref(null);
const searchQuery = ref(null);
const invoiceWidgets = ref([
  {
    id: 1,
    label: "Invoices Sent",
    percentage: "+89.24 %",
    percentageClass: "success",
    icon: "ri-arrow-right-up-line",
    counter: "559.25",
    badge: "2,258",
    caption: "Invoices sent",
    feaIcon: "file-text",
    decimals: 1,
    prefix: "$",
    suffix: "k"
  },
  {
    id: 2,
    label: "Paid Invoices",
    percentage: "+8.09 %",
    percentageClass: "danger",
    icon: "ri-arrow-right-down-line",
    counter: "409.66",
    badge: "1,958",
    caption: "Paid by clients",
    feaIcon: "check-square",
    decimals: 2,
    prefix: "$",
    suffix: "k"
  },
  {
    id: 3,
    label: "Unpaid Invoices",
    percentage: "+9.01 %",
    percentageClass: "danger",
    icon: "ri-arrow-right-down-line",
    counter: "136.98",
    badge: "338",
    caption: "Unpaid by clients",
    feaIcon: "clock",
    decimals: 2,
    prefix: "$",
    suffix: "k"
  },
  {
    id: 4,
    label: "Cancelled Invoices",
    percentage: "+7.55 %",
    percentageClass: "success",
    icon: "ri-arrow-right-up-line",
    counter: "84.2",
    badge: "502",
    caption: "Cancelled by clients",
    feaIcon: "x-octagon",
    decimals: 1,
    prefix: "$",
    suffix: "k"
  },
]);

const invoiceList = ref([]);
const defaultOptions = ref({ animationData });
const defaultOptions1 = ref({ animationData: animationData1 });
const deleteModal = ref(false);
const event = ref({ _id: "" });

// Computed properties
const displayedPosts = computed(() => paginate(invoiceList.value));
const resultQuery = computed(() => {
  if (searchQuery.value) {
    const search = searchQuery.value.toLowerCase();
    return displayedPosts.value.filter((data) => {
      return data.invoiceId.toLowerCase().includes(search) ||
        data.name.toLowerCase().includes(search) ||
        data.email.toLowerCase().includes(search) ||
        data.country.toLowerCase().includes(search) ||
        data.date.toLowerCase().includes(search) ||
        data.time.toLowerCase().includes(search) ||
        data.amount.toString().toLowerCase().includes(search) ||
        data.status.toLowerCase().includes(search);
    });
  } else if (status.value !== null) {
    return displayedPosts.value.filter((data) => {
      if (data.status === status.value || status.value == 'all') {
        return data;
      } else {
        return null;
      }
    });
  } else {
    return displayedPosts.value;
  }
});

// Methods
const SearchData = () => {
  status.value = status1.value;
};

const deleteMultiple = () => {
  let ids_array = [];
  var items = document.getElementsByName("chk_child");
  items.forEach(function (ele) {
    if (ele.checked === true) {
      var trNode = ele.parentNode.parentNode.parentNode;
      var id = trNode.querySelector(".id a").innerHTML;
      ids_array.push(id);
    }
  });
  if (ids_array.length > 0) {
    if (confirm("Are you sure you want to delete this?")) {
      let cusList = invoiceList.value;
      ids_array.forEach(function (id) {
        cusList = cusList.filter(function (orders) {
          return orders.invoiceId !== id;
        });
      });
      invoiceList.value = cusList;
      document.getElementById("checkAll").checked = false;
      var itemss = document.getElementsByName("chk_child");
      itemss.forEach(function (ele) {
        if (ele.checked === true) {
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

const setPages = () => {
  let numberOfPages = Math.ceil(invoiceList.value.length / perPage.value);
  pages.value = [];
  for (let index = 1; index <= numberOfPages; index++) {
    pages.value.push(index);
  }
};

const paginate = (invoiceList) => {
  let pageNum = page.value;
  let perPageNum = perPage.value;
  let from = pageNum * perPageNum - perPageNum;
  let to = pageNum * perPageNum;
  return invoiceList.slice(from, to);
};

const deleteModalToggle = (data) => {
  deleteModal.value = true;
  event.value._id = data._id;
};

const deleteData = () => {
  if (event.value._id) {
    axios.delete(`https://api-node.themesbrand.website/apps/invoice/${event.value._id}`)
      .then((response) => {
        if (response.data.status === 'success') {
          invoiceList.value = invoiceList.value.filter((item) => item._id !== event.value._id);
        }
      }).catch((er) => {
        console.log(er);
      });

    deleteModal.value = false;
  }
};

const onSort = (column) => {
  let direction = 'asc';
  direction = direction === 'asc' ? 'desc' : 'asc';
  const sortedArray = [...invoiceList.value];
  sortedArray.sort((a, b) => {
    const res = a[column] < b[column] ? -1 : a[column] > b[column] ? 1 : 0;
    return direction === 'asc' ? res : -res;
  });
  invoiceList.value = sortedArray;
};

const trimWords = (value) => {
  return value.split(" ").splice(0, 20).join(" ") + "...";
};

// Watchers
watch(invoiceList, setPages);

// Lifecycle Hooks
onMounted(() => {
  axios.get('https://api-node.themesbrand.website/apps/invoice')
    .then((res) => {
      invoiceList.value = [];

      const invoiceData = res?.data?.data?.data;
      if (!Array.isArray(invoiceData)) {
        console.error("Invalid invoice data:", res);
        return;
      }

      const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

      invoiceData.forEach(row => {
        const dd = new Date(row.date);
        let hours = dd.getHours();
        let minutes = dd.getMinutes();
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12 || 12;
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        const strTime = `${hours}:${minutes} ${ampm}`;
        const dt = dd.getDate() < 10 ? '0' + dd.getDate() : dd.getDate();

        row.date = `${dt} ${monthNames[dd.getMonth()]}, ${dd.getFullYear()}`;
        row.time = strTime;
        row.image_src = 'https://api-node.themesbrand.website/images/users/' + row.img;

        invoiceList.value.push(row);
      });
    })
    .catch((error) => {
      console.error("Error fetching invoice list:", error);
    });
});


</script>


<template>
  <Layout>
    <PageHeader title="Invoice List" pageTitle="Invoices" />
    <BRow>
      <BCol xl="3" md="6" v-for="(item, index) of invoiceWidgets" :key="index">
        <BCard no-body class="card-animate">
          <BCardBody>
            <div class="d-flex align-items-center">
              <div class="flex-grow-1">
                <p class="text-uppercase fw-medium text-muted mb-0">{{ item.label }}</p>
              </div>
              <div class="flex-shrink-0">
                <h5 :class="`text-${item.percentageClass} fs-14 mb-0`">
                  <i :class="`${item.icon} fs-13 align-middle`"></i> {{ item.percentage }}
                </h5>
              </div>
            </div>
            <div class="d-flex align-items-end justify-content-between mt-4">
              <div>
                <h4 class="fs-22 fw-semibold ff-secondary mb-4">{{ item.prefix }}{{ item.counter }}{{ item.suffix }}
                </h4>
                <BBadge class="bg-warning me-1">{{ item.badge }}</BBadge> <span class="text-muted">
                  {{ item.caption }}</span>
              </div>
              <div class="avatar-sm flex-shrink-0">
                <span class="avatar-title bg-light rounded fs-3">
                  <template v-if="item.feaIcon == 'file-text'">
                    <FileTextIcon class="text-success icon-md" />
                  </template>
                  <template v-if="item.feaIcon == 'check-square'">
                    <CheckSquareIcon class="text-success icon-md" />
                  </template>
                  <template v-if="item.feaIcon == 'clock'">
                    <ClockIcon class="text-success icon-md" />
                  </template>
                  <template v-if="item.feaIcon == 'x-octagon'">
                    <XOctagonIcon class="text-success icon-md" />
                  </template>
                </span>
              </div>
            </div>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <BRow>
      <BCol lg="12">
        <BCard no-body id="invoiceList">
          <BCardHeader class="border-0">
            <div class="d-flex align-items-center">
              <h5 class="card-title mb-0 flex-grow-1">Invoices</h5>
              <div class="flex-shrink-0">
                <div class="d-flex gap-2 flex-wrap">
                  <BButton variant="primary" class="me-1" id="remove-actions" @click="deleteMultiple">
                    <i class="ri-delete-bin-2-line"></i>
                  </BButton>
                  <router-link to="/invoices/create" class="btn btn-danger"><i class="ri-add-line align-bottom me-1"></i>
                    Create Invoice</router-link>
                </div>
              </div>
            </div>
          </BCardHeader>

          <BCardBody class="bg-light-subtle border border-dashed border-start-0 border-end-0">
            <BFrom>
              <BRow class="g-3">
                <BCol xxl="5" sm="12">
                  <div class="search-box">
                    <input type="text" class="form-control search bg-light border-light" v-model="searchQuery"
                      placeholder="Search for customer, email, country, status or something...">
                    <i class="ri-search-line search-icon"></i>
                  </div>
                </BCol>
                <BCol xxl="3" sm="4">

                  <flat-pickr v-model="date" :config="config" class="form-control bg-light border-light"
                    placeholder="Select date"></flat-pickr>
                </BCol>
                <BCol xxl="3" sm="4">
                  <div class="input-light">

                    <Multiselect class="form-control" v-model="status1" :close-on-select="true" :searchable="true"
                      :create-option="true" :options="[
                        { value: 'all', label: 'all' },
                        { value: 'Unpaid', label: 'Unpaid' },
                        { value: 'Paid', label: 'Paid' },
                        { value: 'Cancel', label: 'Cancel' },
                        { value: 'Refund', label: 'Refund' },
                      ]" />

                  </div>
                </BCol>

                <BCol xxl="1" sm="4">
                  <BButton type="button" variant="primary" class="w-100" @click="SearchData">
                    <i class="ri-equalizer-fill me-1 align-bottom"></i> Filters
                  </BButton>
                </BCol>
              </BRow>
            </BFrom>
          </BCardBody>
          <BCardBody>
            <div>
              <div class="table-responsive table-card">
                <table class="table align-middle table-nowrap" id="invoiceTable">
                  <thead class="text-muted">
                    <tr>
                      <th scope="col" style="width: 50px;">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                        </div>
                      </th>
                      <th class="sort text-uppercase" data-sort="invoice_id" @click="onSort('invoiceId')">ID</th>
                      <th class="sort text-uppercase" data-sort="customer_name" @click="onSort('name')">Customer</th>
                      <th class="sort text-uppercase" data-sort="email" @click="onSort('email')">Email</th>
                      <th class="sort text-uppercase" data-sort="country" @click="onSort('country')">Country</th>
                      <th class="sort text-uppercase" data-sort="date" @click="onSort('date')">Date</th>
                      <th class="sort text-uppercase" data-sort="invoice_amount" @click="onSort('amount')">Amount</th>
                      <th class="sort text-uppercase" data-sort="status" @click="onSort('status')">Payment Status</th>
                      <th class="sort text-uppercase" data-sort="action">Action</th>
                    </tr>
                  </thead>
                  <tbody class="list form-check-all">
                    <tr v-for="(item, index) of resultQuery" :key="index">
                      <th scope="row">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                        </div>
                      </th>
                      <td class="id">
                        <router-link to="/invoices/detail" class="fw-medium link-primary">{{ item.invoiceId }}
                        </router-link>
                      </td>
                      <td class="customer_name">
                        <div class="d-flex align-items-center" v-if="item.img">
                          <img :src="item.image_src" alt="" class="avatar-xs rounded-circle me-2" />
                          {{ item.name }}
                        </div>
                        <div v-if="!item.img" class="d-flex align-items-center">
                          <div class="flex-shrink-0 avatar-xs me-2">
                            <div class="avatar-title bg-success-subtle text-success rounded-circle fs-13">
                              {{ item.name.charAt(0) }}
                            </div>

                          </div>
                          {{ item.name }}
                        </div>
                      </td>
                      <td class="email">{{ item.email }}</td>
                      <td class="country">{{ item.country }}</td>
                      <td class="date">{{ item.date }} <small class="text-muted">{{ item.time }}</small></td>
                      <td class="invoice_amount">${{ item.amount }}</td>
                      <td class="status"><span class="badge text-uppercase" :class="{
                        'bg-success-subtle text-success': item.status == 'Paid',
                        'bg-warning-subtle text-warning': item.status == 'Unpaid',
                        'bg-danger-subtle text-danger': item.status == 'Cancel',
                        'bg-primary-subtle text-primary': item.status == 'Refund',
                        'bg-info-subtle text-info': item.status == 'Active',
                      }">{{ item.status }}</span></td>
                      <td>
                        <BDropdown variant="link" class="card-header-dropdown"
                          toggle-class="btn btn-soft-secondary btn-sm arrow-none" menu-class="dropdown-menu-end"
                          :offset="{ alignmentAxis: -130, crossAxis: 0, mainAxis: 10 }">
                          <template #button-content><i class="ri-more-fill align-middle"></i></template>
                          <BDropdownItem to="/invoices/detail"><i class="ri-eye-fill align-bottom me-2 text-muted"></i>View</BDropdownItem>
                          <BDropdownItem to="/invoices/create"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i>Edit</BDropdownItem>
                          <BDropdownItem><i class="ri-download-2-line align-bottom me-2 text-muted"></i>Download
                          </BDropdownItem>
                          <li class="dropdown-divider"></li>
                          <BDropdownItem @click="deleteModalToggle(item)"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete
                          </BDropdownItem>
                        </BDropdown>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="noresult" v-if="resultQuery.length < 1">
                  <div class="text-center">
                    <lottie class="avatar-xl" colors="primary:#121331,secondary:#08a88a" :options="defaultOptions"
                      :height="75" :width="75" />
                    <h5 class="mt-2">Sorry! No Result Found</h5>
                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                      orders for you search.</p>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-end mt-3" v-if="resultQuery.length >= 1">
                <div class="pagination-wrap hstack gap-2">
                  <BLink class="page-item pagination-prev" href="#" :disabled="page <= 1" @click="page--">
                    Previous
                  </BLink>
                  <ul class="pagination listjs-pagination mb-0">
                    <li :class="{
                      active: pageNumber == page,
                      disabled: pageNumber == '...',
                    }" v-for="(pageNumber, index) in pages" :key="index" @click="page = pageNumber">
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

    <!-- remove modal  -->
    <BModal v-model="deleteModal" modal-class="zoomIn" hide-footer no-close-on-backdrop centered>
      <div class="mt-2 text-center">
        <lottie class="avatar-xl" colors="primary:#f7b84b,secondary:#f06548" :options="defaultOptions1" :height="75"
          :width="75" />
        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
          <h4>Are you sure ?</h4>
          <p class="text-muted mx-4 mb-0">Are you sure you want to remove this record ?</p>
        </div>
      </div>
      <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
        <BButton variant="light" size="w-sm" @click="deleteModal = false">Close</BButton>
        <BButton variant="danger" size="w-sm" id="delete-record" @click="deleteData">Yes, Delete
          It!</BButton>
      </div>
    </BModal>
  </Layout>
</template>