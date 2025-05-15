<script setup>
import { ref, reactive, computed, watch, onMounted, onBeforeMount } from 'vue';
import { CountTo } from "vue3-count-to";
import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";

import Layout from "@/layouts/main.vue";
import PageHeader from "@/components/page-header.vue";
import Swal from "sweetalert2";
import axios from 'axios';
import Lottie from "@/components/widgets/lottie.vue";
import animationData from "@/components/widgets/msoeawqm.json";
import animationData1 from "@/components/widgets/gsqxdxog.json";

const modalShow = ref(false);
const deleteModal = ref(false);
const dataEdit = ref(false);
const submitted = ref(false);
const page = ref(1);
const perPage = ref(8);
const pages = ref([]);
const searchQuery = ref(null);
const filtersearchQuery1 = ref(null);
const filtervalue = ref('All');
const filtervalue1 = ref('All');
const filterdate = ref(null);
const filterdate1 = ref(null);

const date = ref(null);
const date1 = ref(null);
const date2 = ref(null);

const rangeDateconfig = reactive({
  wrap: true,
  altFormat: "M j, Y",
  altInput: true,
  dateFormat: "d M, Y",
  mode: "range"
});

const config = reactive({
  enableTime: false,
  dateFormat: "d M, Y"
});

const ticketsList = ref([]);

const defaultOptions = reactive({ animationData });
const defaultOptions1 = reactive({ animationData: animationData1 });

const event = reactive({
  _id: "", id: "", assigned: "", client: "",
  create: "", due: "", title: "", priority: "", status: ""
});

const displayedPosts = computed(() => paginate(ticketsList.value));

const resultQuery = computed(() => {
  const search = searchQuery.value?.toLowerCase();
  if (search) {
    return displayedPosts.value.filter(data =>
      Object.values(data).some(val => val?.toString().toLowerCase().includes(search))
    );
  } else if (filterdate.value) {
    const [date1, date2] = filterdate.value.split(" to ");
    return displayedPosts.value.filter(data => {
      const dueDate = new Date(data.due.slice(0, 12));
      return dueDate >= new Date(date1) && dueDate <= new Date(date2);
    });
  } else if (filtervalue.value !== null) {
    return displayedPosts.value.filter(data =>
      data.status === filtervalue.value || filtervalue.value === 'All'
    );
  } else {
    return displayedPosts.value;
  }
});

watch(ticketsList, setPages);

function SearchData() {
  filterdate.value = filterdate1.value;
  filtervalue.value = filtervalue1.value;
}

function handleSubmit() {
  submitted.value = true;
  if (event.title && event.client && event.assigned && event.create && event.due && event.priority && event.status) {
    modalShow.value = false;
    if (dataEdit.value) {
      axios.patch(`https://api-node.themesbrand.website/apps/ticket/${event._id}`, event)
        .then(response => {
          const updated = response.data.data;
          ticketsList.value = ticketsList.value.map(item =>
            item._id === updated._id ? { ...item, ...updated } : item
          );
        });
    } else {
      const data = {
        _id: Math.floor(Math.random() * 100 + 20),
        id: '#VLZ4' + Math.floor(Math.random() * 100 + 20),
        ...event
      };
      axios.post(`https://api-node.themesbrand.website/apps/ticket`, data)
        .then(response => {
          ticketsList.value.unshift(response.data.data);
        });
    }
  }
}

function editDetails(data) {
  dataEdit.value = true;
  modalShow.value = true;
  Object.assign(event, data);
  submitted.value = false;
}

function toggleModal() {
  modalShow.value = true;
  dataEdit.value = false;
  Object.keys(event).forEach(key => event[key] = "");
  submitted.value = false;
}

function deleteModalToggle(data) {
  deleteModal.value = true;
  event._id = data._id;
}

function deleteData() {
  axios.delete(`https://api-node.themesbrand.website/apps/ticket/${event._id}`)
    .then(response => {
      if (response.data.status === 'success') {
        ticketsList.value = ticketsList.value.filter(item => item._id !== event._id);
      }
      deleteModal.value = false;
    });
}

function setPages() {
  const numberOfPages = Math.ceil(ticketsList.value.length / perPage.value);
  pages.value = Array.from({ length: numberOfPages }, (_, i) => i + 1);
}

function paginate(list) {
  const from = page.value * perPage.value - perPage.value;
  const to = page.value * perPage.value;
  return list.slice(from, to);
}

function fetchData() {
  axios.get('https://api-node.themesbrand.website/apps/ticket')
    .then(({ data }) => {
      ticketsList.value = data.data.map(row => {
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const dd = new Date(row.create);
        const due = new Date(row.due);
        row.create = `${dd.getDate()} ${monthNames[dd.getMonth()]}, ${dd.getFullYear()}`;
        row.due = `${due.getDate()} ${monthNames[due.getMonth()]}, ${due.getFullYear()}`;
        return row;
      });
    });
}

function setupCheckboxListeners() {
  const checkAll = document.getElementById("checkAll");
  const listContainer = document.getElementById("ticketsList");
  if (!checkAll || !listContainer) return;

  checkAll.onclick = () => {
    const checkboxes = listContainer.querySelectorAll('.form-check-all input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
      checkbox.checked = checkAll.checked;
      checkbox.closest("tr").classList.toggle("table-active", checkAll.checked);
      document.getElementById('remove-actions').style.display = checkAll.checked ? 'block' : 'none';
    });
  };

  listContainer.querySelectorAll('.form-check-input').forEach(el => {
    el.addEventListener('change', () => {
      const checkedCount = listContainer.querySelectorAll('.form-check-input:checked').length;
      document.getElementById("remove-actions").style.display = checkedCount > 0 ? 'block' : 'none';
    });
  });
}

onBeforeMount(fetchData);
onMounted(setupCheckboxListeners);
</script>

<template>
  <Layout>
    <PageHeader title="Tickets List" pageTitle="Tickets" />
    <BRow>
      <BCol xxl="3" sm="6">
        <BCard no-body class="card-animate">
          <BCardBody>
            <div class="d-flex justify-content-between">
              <div>
                <p class="fw-medium text-muted mb-0">Total Tickets</p>
                <h2 class="mt-4 ff-secondary fw-semibold">
                  <count-to :duration="1000" :startVal="0" :endVal="547"></count-to>k
                </h2>
                <p class="mb-0 text-muted">
                  <BBadge class="bg-light text-success mb-0">
                    <i class="ri-arrow-up-line align-middle"></i> 17.32 %
                  </BBadge>
                  vs. previous month
                </p>
              </div>
              <div>
                <div class="avatar-sm flex-shrink-0">
                  <span class="avatar-title bg-info-subtle text-info rounded-circle fs-4">
                    <i class="ri-ticket-2-line"></i>
                  </span>
                </div>
              </div>
            </div>
          </BCardBody>
        </BCard>
      </BCol>
      <BCol xxl="3" sm="6">
        <BCard no-body class="card-animate">
          <BCardBody>
            <div class="d-flex justify-content-between">
              <div>
                <p class="fw-medium text-muted mb-0">Pending Tickets</p>
                <h2 class="mt-4 ff-secondary fw-semibold">
                  <count-to :duration="1000" :startVal="0" :endVal="124"></count-to>k
                </h2>
                <p class="mb-0 text-muted">
                  <BBadge class="bg-light text-danger mb-0">
                    <i class="ri-arrow-down-line align-middle"></i> 0.96 %
                  </BBadge>
                  vs. previous month
                </p>
              </div>
              <div>
                <div class="avatar-sm flex-shrink-0">
                  <span class="avatar-title bg-info-subtle text-info rounded-circle fs-4">
                    <i class="mdi mdi-timer-sand"></i>
                  </span>
                </div>
              </div>
            </div>
          </BCardBody>
        </BCard>
      </BCol>
      <BCol xxl="3" sm="6">
        <BCard no-body class="card-animate">
          <BCardBody>
            <div class="d-flex justify-content-between">
              <div>
                <p class="fw-medium text-muted mb-0">Closed Tickets</p>
                <h2 class="mt-4 ff-secondary fw-semibold">
                  <count-to :duration="1000" :startVal="0" :endVal="107"></count-to>K
                </h2>
                <p class="mb-0 text-muted">
                  <BBadge class="bg-light text-danger mb-0">
                    <i class="ri-arrow-down-line align-middle"></i> 3.87 %
                  </BBadge>
                  vs. previous month
                </p>
              </div>
              <div>
                <div class="avatar-sm flex-shrink-0">
                  <span class="avatar-title bg-info-subtle text-info rounded-circle fs-4">
                    <i class="ri-shopping-bag-line"></i>
                  </span>
                </div>
              </div>
            </div>
          </BCardBody>
        </BCard>
      </BCol>
      <BCol xxl="3" sm="6">
        <BCard no-body class="card-animate">
          <BCardBody>
            <div class="d-flex justify-content-between">
              <div>
                <p class="fw-medium text-muted mb-0">Deleted Tickets</p>
                <h2 class="mt-4 ff-secondary fw-semibold">
                  <count-to :duration="1000" :startVal="0" :endVal="15.95" :decimals="2"></count-to>%
                </h2>
                <p class="mb-0 text-muted">
                  <BBadge class="bg-light text-success mb-0">
                    <i class="ri-arrow-up-line align-middle"></i> 1.09 %
                  </BBadge>
                  vs. previous month
                </p>
              </div>
              <div>
                <div class="avatar-sm flex-shrink-0">
                  <span class="avatar-title bg-info-subtle text-info rounded-circle fs-4">
                    <i class="ri-delete-bin-line"></i>
                  </span>
                </div>
              </div>
            </div>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <BRow>
      <BCol lg="12">
        <BCard no-body id="ticketsList">
          <BCardHeader class="border-0">
            <div class="d-flex align-items-center">
              <h5 class="card-title mb-0 flex-grow-1">Tickets</h5>
              <div class="flex-shrink-0">
                <div class="d-flex flex-wrap gap-2">
                  <BButton variant="soft-danger" class="me-1" id="remove-actions" @click="deleteMultiple">
                    <i class="ri-delete-bin-2-line"></i>
                  </BButton>
                  <BButton variant="danger" class="add-btn" @click="toggleModal">
                    <i class="ri-add-line align-bottom me-1"></i> Create Tickets
                  </BButton>
                </div>
              </div>
            </div>
          </BCardHeader>
          <BCardBody class="border border-dashed border-end-0 border-start-0">
            <form>
              <BRow class="g-3">
                <BCol xxl="5" sm="12">
                  <div class="search-box">
                    <input type="text" class="form-control search bg-light border-light"
                      placeholder="Search for ticket details or something..." v-model="searchQuery" />
                    <i class="ri-search-line search-icon"></i>
                  </div>
                </BCol>

                <BCol xxl="3" sm="4">
                  <flat-pickr v-model="filterdate1" :config="rangeDateconfig" class="form-control bg-light border-light"
                    placeholder="Select date"></flat-pickr>
                </BCol>

                <BCol xxl="3" sm="4">
                  <div class="input-light">
                    <Multiselect v-model="filtervalue1" :close-on-select="true" :searchable="true" :create-option="true"
                      :options="[
                        { value: '', label: 'Status' },
                        { value: 'All', label: 'All' },
                        { value: 'Open', label: 'Open' },
                        { value: 'Inprogress', label: 'Inprogress' },
                        { value: 'Closed', label: 'Closed' },
                        { value: 'New', label: 'New' },
                      ]" />
                  </div>
                </BCol>
                <BCol xxl="1" sm="4">
                  <BButton type="button" variant="primary" class="w-100" @click="SearchData">
                    <i class="ri-equalizer-fill me-1 align-bottom"></i>
                    Filters
                  </BButton>
                </BCol>
              </BRow>
            </form>
          </BCardBody>
          <BCardBody>
            <div class="table-responsive table-card mb-4">
              <table class="table align-middle table-nowrap mb-0" id="ticketTable">
                <thead>
                  <tr>
                    <th scope="col" style="width: 40px">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkAll" value="option" />
                      </div>
                    </th>
                    <th class="sort" data-sort="id" @click="onSort('id')">ID</th>
                    <th class="sort" data-sort="tasks_name" @click="onSort('title')">Title</th>
                    <th class="sort" data-sort="client_name" @click="onSort('client')">Client</th>
                    <th class="sort" data-sort="assignedto" @click="onSort('assigned')">Assigned To</th>
                    <th class="sort" data-sort="create_date" @click="onSort('create')">Create Date</th>
                    <th class="sort" data-sort="due_date" @click="onSort('due')">Due Date</th>
                    <th class="sort" data-sort="status" @click="onSort('status')">Status</th>
                    <th class="sort" data-sort="priority" @click="onSort('priority')">Priority</th>
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
                    <td class="id">
                      <router-link to="/apps/tickets-details" class="fw-medium link-primary">{{ data.id }}</router-link>
                    </td>
                    <td class="tasks_name">
                      {{ data.title }}
                    </td>
                    <td class="client_name">{{ data.client }}</td>
                    <td class="assignedto">{{ data.assigned }}</td>
                    <td class="create_date">{{ data.create }}</td>
                    <td class="due_date">{{ data.due }}</td>
                    <td class="status">
                      <span class="badge text-uppercase" :class="{
                        'bg-warning-subtle text-warning': data.status == 'Inprogress',
                        'bg-info-subtle text-info': data.status == 'New',
                        'bg-success-subtle text-success': data.status == 'Open',
                        'bg-danger-subtle text-danger': data.status == 'Closed',
                      }">{{ data.status }}</span>
                    </td>
                    <td class="priority">
                      <span class="badge text-uppercase" :class="{
                        'bg-danger': data.priority == 'High',
                        'bg-success': data.priority == 'Low',
                        'bg-warning': data.priority == 'Medium',
                      }">{{ data.priority }}</span>
                    </td>
                    <td>
                      <BDropdown toggle-class="btn btn-soft-secondary btn-sm arrow-none" size="sm" no-caret>
                        <template #button-content> <i class="ri-more-fill align-middle"></i> </template>
                        <BDropdownItem to="/apps/tickets-details"><i
                            class="ri-eye-fill align-bottom me-2 text-muted"></i>View</BDropdownItem>
                        <BDropdownItem href="#" class="edit-item-btn" @click="editDetails(data)"><i
                            class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</BDropdownItem>
                        <BDropdownItem href="javascript:void(0);" class="remove-item-btn"
                          @click="deleteModalToggle(data)"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                          Delete</BDropdownItem>
                      </BDropdown>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="noresult" v-if="resultQuery.length < 1">
                <div class="text-center">
                  <lottie class="avatar-xl" colors="primary:#121331,secondary:#08a88a" :options="defaultOptions"
                    :height="90" :width="90" />
                  <h5 class="mt-2">Sorry! No Result Found</h5>
                  <p class="text-muted mb-0">
                    We've searched more than 150+ Tickets We did not find any
                    Tickets for you search.
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
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <!-- ticket list modal -->
    <BModal v-model="modalShow" id="showModal" modal-class="zoomIn" :title="dataEdit ? 'Edit Ticket' : 'Add Ticket'"
      title-class="exampleModalLabel" hide-footer header-class="p-3 bg-info-subtle" class="v-modal-custom" size="lg"
      centered>
      <BFrom id="addform" class="tablelist-form" autocomplete="off">
        <BRow class="g-3">
          <BCol lg="12">
            <div id="modal-id" style="display: none;">
              <label for="orderId" class="form-label">ID</label>
              <input type="text" id="orderId" class="form-control" placeholder="ID" value="#VLZ462" readonly="">
            </div>
          </BCol>
          <BCol lg="12">
            <div>
              <label for="tasksTitle-field" class="form-label">Title</label>
              <input type="text" id="tasksTitle" class="form-control" placeholder="Title" v-model="event.title"
                :class="{ 'is-invalid': submitted && !event.title }" />
              <div class="invalid-feedback">Please enter a title.</div>
            </div>
          </BCol>
          <BCol lg="6">
            <div>
              <label for="clientName-field" class="form-label">Client</label>
              <input type="text" id="clientName" class="form-control" placeholder="Client Name" v-model="event.client"
                :class="{ 'is-invalid': submitted && !event.client }" />
              <div class="invalid-feedback">Please enter a client name.</div>
            </div>
          </BCol>
          <BCol lg="6">
            <div>
              <label for="assignedtoName-field" class="form-label">Assigned To</label>
              <input type="text" id="assignedtoName" class="form-control" placeholder="Assigned to"
                v-model="event.assigned" :class="{ 'is-invalid': submitted && !event.assigned }" />
              <div class="invalid-feedback">Please enter a Assignes.</div>
            </div>
          </BCol>
          <BCol lg="6">
            <label for="date-field" class="form-label">Create Date</label>
            <flat-pickr :config="config" placeholder="Create Date" class="form-control" id="cdate" v-model="event.create"
              :class="{ 'is-invalid': submitted && !event.create }">
            </flat-pickr>
            <div class="invalid-feedback">Please enter a create date.</div>
          </BCol>
          <BCol lg="6">
            <label for="duedate-field" class="form-label">Due Date</label>
            <flat-pickr :config="config" placeholder="Due Date" class="form-control" id="ddate" v-model="event.due"
              :class="{ 'is-invalid': submitted && !event.due }">
            </flat-pickr>
            <div class="invalid-feedback">Please enter a due date.</div>
          </BCol>
          <BCol lg="6">
            <label for="ticket-status" class="form-label">Status</label>
            <select class="form-control" data-plugin="choices" name="ticket-status" id="ticketstatus"
              v-model="event.status" :class="{ 'is-invalid': submitted && !event.status }">
              <option value="">Status</option>
              <option value="New">New</option>
              <option value="Inprogress">Inprogress</option>
              <option value="Closed">Closed</option>
              <option value="Open">Open</option>
            </select>
            <div class="invalid-feedback">Please select a status.</div>
          </BCol>
          <BCol lg="6">
            <label for="priority-field" class="form-label">Priority</label>
            <select class="form-control" data-plugin="choices" name="priority-field" id="priority"
              v-model="event.priority" :class="{ 'is-invalid': submitted && !event.priority }">
              <option value="">Priority</option>
              <option value="High">High</option>
              <option value="Medium">Medium</option>
              <option value="Low">Low</option>
            </select>
            <div class="invalid-feedback">Please select a priority.</div>
          </BCol>
        </BRow>
        <div class="modal-footer v-modal-footer mt-3">
          <div class="hstack gap-2 justify-content-end">
            <BButton type="button" variant="light" @click="modalShow = false" id="closemodal"> Close </BButton>
            <BButton type="submit" variant="success" id="add-btn" @click="handleSubmit">
              {{ dataEdit ? 'Update' : 'Add Ticket' }}
            </BButton>
          </div>
        </div>
      </BFrom>
    </BModal>

    <!-- delete modal -->
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
        <BButton variant="danger" size="w-sm" id="delete-record" @click="deleteData">Yes, Delete It!</BButton>
      </div>
    </BModal>
  </Layout>
</template>