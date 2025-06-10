<script setup>
import { ref, computed, watch, onMounted } from 'vue';
import axios from 'axios';
import { CountTo } from 'vue3-count-to';
import Multiselect from '@vueform/multiselect';
import flatPickr from 'vue-flatpickr-component';
import Swal from 'sweetalert2';
import Layout from '@/layouts/main.vue';
import PageHeader from '@/components/page-header.vue';
import Lottie from '@/components/widgets/lottie.vue';
import simplebar from 'simplebar-vue';
import animationData from '@/components/widgets/msoeawqm.json';
import animationData1 from '@/components/widgets/gsqxdxog.json';

const taskListModal = ref(false);
const date3 = ref(null);
const filterdate = ref(null);
const filterdate1 = ref(null);
const filtervalue = ref('All');
const filtervalue1 = ref('All');
const filtersearchQuery1 = ref(null);
const searchQuery = ref(null);
const allTask = ref([]);
const page = ref(1);
const perPage = ref(8);
const pages = ref([]);
const submitted = ref(false);
const dataEdit = ref(false);
const deleteModal = ref(false);
const event = ref({
  _id: '',
  taskId: '',
  task: '',
  creater: '',
  dueDate: '',
  priority: '',
  project: '',
  subItem: [],
  status: ''
});

const defaultOptions = ref({
  animationData
});

const defaultOptions1 = ref({
  animationData: animationData1
});

// Watch for changes in tasks to set pages
watch(allTask, () => {
  setPages();
});

// Fetch tasks on mount
onMounted(() => {
  axios.get('https://api-node.themesbrand.website/apps/task')
    .then((data) => {
      const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
      data.data.data.forEach(row => {
        const dd = new Date(row.dueDate);
        row.dueDate = `${dd.getDate()} ${monthNames[dd.getMonth()]}, ${dd.getFullYear()}`;
        row.subItem.forEach(imag => {
          imag.image_src = `https://api-node.themesbrand.website/images/users/${imag.img}`;
        });
        allTask.value.push(row);
      });
    })
    .catch((er) => {
      console.log(er);
    });
});

// Computed properties
const displayedPosts = computed(() => {
  return paginate(allTask.value);
});

const resultQuery = computed(() => {
  let filteredTasks = displayedPosts.value;

  if (searchQuery.value) {
    const search = searchQuery.value.toLowerCase();
    filteredTasks = filteredTasks.filter((data) => {
      return (
        data.taskId.toLowerCase().includes(search) ||
        data.task.toLowerCase().includes(search) ||
        data.project.toLowerCase().includes(search) ||
        data.creater.toLowerCase().includes(search) ||
        data.dueDate.toLowerCase().includes(search) ||
        data.status.toLowerCase().includes(search) ||
        data.priority.toLowerCase().includes(search)
      );
    });
  }

  if (filterdate.value) {
    const [date1, date2] = filterdate.value.split(" to ");
    filteredTasks = filteredTasks.filter((data) => {
      return new Date(data.dueDate.slice(0, 12)) >= new Date(date1) &&
             new Date(data.dueDate.slice(0, 12)) <= new Date(date2);
    });
  }

  if (filtervalue.value !== 'All') {
    filteredTasks = filteredTasks.filter((data) => {
      return data.status === filtervalue.value;
    });
  }

  return filteredTasks;
});

// Pagination methods
function setPages() {
  const numberOfPages = Math.ceil(allTask.value.length / perPage.value);
  pages.value = [];
  for (let index = 1; index <= numberOfPages; index++) {
    pages.value.push(index);
  }
}

function paginate(tasks) {
  const from = (page.value - 1) * perPage.value;
  const to = page.value * perPage.value;
  return tasks.slice(from, to);
}

// Handle task submission
function handleSubmit() {
  if (dataEdit.value) {
    submitted.value = true;
    if (validateTaskData()) {
      taskListModal.value = false;
      axios.patch(`https://api-node.themesbrand.website/apps/task/${event.value._id}`, event.value)
        .then((response) => {
          const data = response.data.data;
          allTask.value = allTask.value.map(item =>
            item._id.toString() === data._id.toString() ? { ...item, ...data } : item
          );
        })
        .catch((er) => {
          console.log(er);
        });
    }
  } else {
    submitted.value = true;
    if (validateTaskData()) {
      const data = { _id: (Math.floor(Math.random() * 100 + 20) - 20), taskId: '#VLZ4' + (Math.floor(Math.random() * 100 + 20) - 20), ...event.value };
      taskListModal.value = false;
      axios.post('https://api-node.themesbrand.website/apps/task', data)
        .then((response) => {
          allTask.value.unshift(response.data.data);
        })
        .catch((er) => {
          console.log(er);
        });
    }
  }
}

// Validate task data
function validateTaskData() {
  return event.value.project && event.value.task && event.value.creater && event.value.dueDate && event.value.status && event.value.priority;
}

// Handle task editing
function editDetails(data) {
  dataEdit.value = true;
  taskListModal.value = true;
  event.value = { ...data };
  submitted.value = false;
}

// Toggle modal visibility
function toggleModal() {
  taskListModal.value = true;
  dataEdit.value = false;
  event.value = {};
  submitted.value = false;
}

// Delete task
function deleteModalToggle(data) {
  deleteModal.value = true;
  event.value._id = data._id;
}

function deleteData() {
  if (event.value._id) {
    axios.delete(`https://api-node.themesbrand.website/apps/task/${event.value._id}`)
      .then((response) => {
        if (response.data.status === 'success') {
          allTask.value = allTask.value.filter((item) => item._id !== event.value._id);
        }
      })
      .catch((er) => {
        console.log(er);
      });
    deleteModal.value = false;
  }
}

// Delete multiple tasks
function deleteMultiple() {
  if (confirm("Are you sure you want to delete these tasks?")) {
    allTask.value = allTask.value.filter(task => !task.selected);
  } else {
    Swal.fire({
      title: "Please select at least one checkbox",
      confirmButtonClass: "btn btn-info",
      buttonsStyling: false,
      showCloseButton: true,
    });
  }
}

// Handle task selection
function onTaskSelect(task) {
  task.selected = !task.selected;
}

// Handle checkbox select all
function onSelectAll() {
  const isSelected = document.getElementById('checkAll').checked;
  allTask.value.forEach(task => {
    task.selected = isSelected;
  });
  document.getElementById('remove-actions').style.display = isSelected ? 'block' : 'none';
}
</script>

<template>
  <Layout>
    <PageHeader title="List View" pageTitle="Tasks" />
    <BRow>
      <BCol xxl="3" sm="6">
        <BCard no-body class="card-animate">
          <BCardBody>
            <div class="d-flex justify-content-between">
              <div>
                <p class="fw-medium text-muted mb-0">Total Tasks</p>
                <h2 class="mt-4 ff-secondary fw-semibold">
                  <count-to :startVal="0" :endVal="234" :duration="5000"></count-to>k
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
                <p class="fw-medium text-muted mb-0">Pending Tasks</p>
                <h2 class="mt-4 ff-secondary fw-semibold">
                  <count-to :startVal="0" :endVal="64" :duration="5000"></count-to>k
                </h2>
                <p class="mb-0 text-muted">
                  <BBadge class="bg-light text-danger mb-0">
                    <i class="ri-arrow-down-line align-middle"></i> 0.87 %
                  </BBadge>
                  vs. previous month
                </p>
              </div>
              <div>
                <div class="avatar-sm flex-shrink-0">
                  <span class="avatar-title bg-warning-subtle text-warning rounded-circle fs-4">
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
                <p class="fw-medium text-muted mb-0">Completed Tasks</p>
                <h2 class="mt-4 ff-secondary fw-semibold">
                  <count-to :startVal="0" :endVal="116" :duration="5000"></count-to>K
                </h2>
                <p class="mb-0 text-muted">
                  <BBadge class="bg-light text-danger mb-0">
                    <i class="ri-arrow-down-line align-middle"></i> 2.52 %
                  </BBadge>
                  vs. previous month
                </p>
              </div>
              <div>
                <div class="avatar-sm flex-shrink-0">
                  <span class="avatar-title bg-success-subtle text-success rounded-circle fs-4">
                    <i class="ri-checkbox-circle-line"></i>
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
                <p class="fw-medium text-muted mb-0">Deleted Tasks</p>
                <h2 class="mt-4 ff-secondary fw-semibold">
                  <count-to :startVal="0" :endVal="14" :duration="5000"></count-to>%
                </h2>
                <p class="mb-0 text-muted">
                  <BBadge class="bg-light text-success mb-0">
                    <i class="ri-arrow-up-line align-middle"></i> 0.63 %
                  </BBadge>
                  vs. previous month
                </p>
              </div>
              <div>
                <div class="avatar-sm flex-shrink-0">
                  <span class="avatar-title bg-danger-subtle text-danger rounded-circle fs-4">
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
        <BCard no-body id="tasksList">
          <BCardHeader class="border-0">
            <div class="d-flex align-items-center">
              <h5 class="card-title mb-0 flex-grow-1">All Tasks</h5>
              <div class="flex-shrink-0">
                <div class="d-flex flex-wrap gap-2">
                  <BButton variant="soft-danger" class="me-1" id="remove-actions" @click="deleteMultiple">
                    <i class="ri-delete-bin-2-line"></i>
                  </BButton>
                  <BButton variant="danger" class="add-btn" @click="toggleModal">
                    <i class="ri-add-line align-bottom me-1"></i> Create Task
                  </BButton>
                </div>
              </div>
            </div>
          </BCardHeader>
          <BCardBody class="border border-dashed border-end-0 border-start-0">
            <b-form>
              <BRow class="g-3">
                <BCol xxl="5" sm="12">
                  <div class="search-box">
                    <input type="text" class="form-control search bg-light border-light"
                      placeholder="Search for tasks or something..." v-model="searchQuery" />
                    <i class="ri-search-line search-icon"></i>
                  </div>
                </BCol>

                <BCol xxl="3" sm="4">
                  <flat-pickr v-model="filterdate1" placeholder="Select date" :config="rangeDateconfig"
                    class="form-control bg-light border-light"></flat-pickr>
                </BCol>

                <BCol xxl="3" sm="4">
                  <div class="input-light">
                    <Multiselect v-model="filtervalue1" :close-on-select="true" :searchable="true" :create-option="true"
                      :options="[
                        { value: 'All', label: 'All' },
                        { value: 'New', label: 'New' },
                        { value: 'Pending', label: 'Pending' },
                        { value: 'Inprogress', label: 'Inprogress' },
                        { value: 'Completed', label: 'Completed' },
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
            </b-form>
          </BCardBody>
          <BCardBody>
            <div class="table-responsive table-card mb-4">
              <table class="table align-middle table-nowrap mb-0" id="tasksTable">
                <thead class="table-light text-muted">
                  <tr>
                    <th scope="col" style="width: 40px">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkAll" value="option" />
                      </div>
                    </th>
                    <th class="sort" data-sort="id" @click="onSort('taskId')">ID</th>
                    <th class="sort" data-sort="project_name" @click="onSort('project')">Project</th>
                    <th class="sort" data-sort="tasks_name" @click="onSort('task')">Task</th>
                    <th class="sort" data-sort="client_name" @click="onSort('creater')">Created By</th>
                    <th class="sort" data-sort="assignedto" @click="onSort('subItem')">Assigned To</th>
                    <th class="sort" data-sort="due_date" @click="onSort('dueDate')">Due Date</th>
                    <th class="sort" data-sort="status" @click="onSort('status')">Status</th>
                    <th class="sort" data-sort="priority" @click="onSort('priority')">Priority</th>
                  </tr>
                </thead>
                <tbody class="list form-check-all">
                  <tr v-for="(task, index) of resultQuery" :key="index">
                    <th scope="row">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="chk_child" value="option1" />
                      </div>
                    </th>
                    <td class="id">
                      <router-link to="/apps/tasks-details" class="fw-medium link-primary">{{ task.taskId }}
                      </router-link>
                    </td>
                    <td class="project_name">
                      <router-link to="/apps/projects-overview" class="fw-medium link-primary">{{ task.project }}
                      </router-link>
                    </td>
                    <td>
                      <div class="d-flex">
                        <div class="flex-grow-1 tasks_name">
                          {{ task.task }}
                        </div>
                        <div class="flex-shrink-0 ms-4">
                          <ul class="list-inline tasks-list-menu mb-0">
                            <li class="list-inline-item">
                              <router-link to="/apps/tasks-details"><i
                                  class="ri-eye-fill align-bottom me-2 text-muted"></i></router-link>
                            </li>
                            <li class="list-inline-item" @click="editDetails(task)">
                              <BLink href="#"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i></BLink>
                            </li>
                            <li class="list-inline-item">
                              <BLink class="remove-item-btn" href="javascript:void(0);" @click="deleteModalToggle(task)">
                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                              </BLink>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                    <td class="client_name">{{ task.creater }}</td>
                    <td class="assignedto">
                      <div class="avatar-group">
                        <BLink href="javascript: void(0);" v-for="(task, index) of task.subItem" :key="index"
                          class="avatar-group-item" data-bs-toggle="tooltip" v-b-tooltip.hover title="Frank">
                          <img :src="task.image_src" alt="" class="rounded-circle avatar-xxs" />
                        </BLink>
                      </div>
                    </td>
                    <td class="due_date">{{ task.dueDate }}</td>
                    <td class="status">
                      <span class="badge text-uppercase" :class="{
                        'bg-secondary-subtle text-secondary': task.status == 'Inprogress',
                        'bg-info-subtle text-info': task.status == 'New',
                        'bg-success-subtle text-success': task.status == 'Completed',
                        'bg-warning-subtle text-warning': task.status == 'Pending',
                      }">{{ task.status }}</span>
                    </td>
                    <td class="priority">
                      <span class="badge text-uppercase" :class="{
                        'bg-danger': task.priority == 'High',
                        'bg-success': task.priority == 'Low',
                        'bg-warning': task.priority == 'Medium',
                      }">{{ task.priority }}</span>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="noresult" v-if="resultQuery.length < 1">
                <div class="text-center">
                  <lottie colors="primary:#121331,secondary:#08a88a" :options="defaultOptions" :height="75" :width="75" />
                  <h5 class="mt-2">Sorry! No Result Found</h5>
                  <p class="text-muted mb-0">
                    We've searched more than 200k+ tasks We did not find any
                    tasks for you search.
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
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <!-- task list modal -->
    <BModal v-model="taskListModal" id="showmodal" modal-class="zoomIn" hide-footer
      header-class="p-3 bg-info-subtle taskModal" class="v-modal-custom" centered size="lg"
      :title="dataEdit ? 'Edit Task' : 'Add Task'">
      <b-form id="addform" class="tablelist-form" autocomplete="off">
        <BRow class="g-3">
          <input type="hidden" id="id" name="">
          <BCol lg="12">
            <label for="projectName-field" class="form-label">Project Name</label>
            <input type="text" id="projectName" class="form-control" placeholder="Project name" v-model="event.project"
              :class="{ 'is-invalid': submitted && !event.project }" />
            <div class="invalid-feedback">Please enter a project name.</div>
          </BCol>
          <BCol lg="12">
            <div>
              <label for="tasksTitle-field" class="form-label">Title</label>
              <input type="text" id="tasksTitle" class="form-control" placeholder="Title" v-model="event.task"
                :class="{ 'is-invalid': submitted && !event.task }" />
              <div class="invalid-feedback">Please enter a title.</div>
            </div>
          </BCol>
          <BCol lg="12">
            <label for="createName-field" class="form-label">Client Name</label>
            <input type="text" id="createName" class="form-control" placeholder="Client name" v-model="event.creater"
              :class="{ 'is-invalid': submitted && !event.creater }" />
            <div class="invalid-feedback">Please enter a client name.</div>
          </BCol>
          <BCol lg="12">
            <label class="form-label">Assigned To</label>
            <simplebar data-simplebar style="height: 95px">
              <ul class="list-unstyled vstack gap-2 mb-0">
                <li>
                  <div class="form-check d-flex align-items-center">
                    <input class="form-check-input me-3" type="checkbox" value="" id="James Forbes" />
                    <label class="form-check-label d-flex align-items-center" for="James Forbes">
                      <span class="flex-shrink-0">
                        <img src="@/assets/images/users/avatar-2.jpg" alt="" class="avatar-xxs rounded-circle" />
                      </span>
                      <span class="flex-grow-1 ms-2"> James Forbes </span>
                    </label>
                  </div>
                </li>
                <li>
                  <div class="form-check d-flex align-items-center">
                    <input class="form-check-input me-3" type="checkbox" value="" id="john-robles" />
                    <label class="form-check-label d-flex align-items-center" for="john-robles">
                      <span class="flex-shrink-0">
                        <img src="@/assets/images/users/avatar-3.jpg" alt="" class="avatar-xxs rounded-circle" />
                      </span>
                      <span class="flex-grow-1 ms-2"> John Robles </span>
                    </label>
                  </div>
                </li>
                <li>
                  <div class="form-check d-flex align-items-center">
                    <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-4.jpg"
                      id="mary-gant">
                    <label class="form-check-label d-flex align-items-center" for="mary-gant">
                      <span class="flex-shrink-0">
                        <img src="@/assets/images/users/avatar-4.jpg" alt="" class="avatar-xxs rounded-circle">
                      </span>
                      <span class="flex-grow-1 ms-2">Mary Gant</span>
                    </label>
                  </div>
                </li>
                <li>
                  <div class="form-check d-flex align-items-center">
                    <input class="form-check-input me-3" type="checkbox" value="" id="curtis-saenz" />
                    <label class="form-check-label d-flex align-items-center" for="curtis-saenz">
                      <span class="flex-shrink-0">
                        <img src="@/assets/images/users/avatar-1.jpg" alt="" class="avatar-xxs rounded-circle" />
                      </span>
                      <span class="flex-grow-1 ms-2">
                        Curtis Saenz
                      </span>
                    </label>
                  </div>
                </li>
                <li>
                  <div class="form-check d-flex align-items-center">
                    <input class="form-check-input me-3" type="checkbox" name="assignedTo[]" value="avatar-5.jpg"
                      id="virgie-price">
                    <label class="form-check-label d-flex align-items-center" for="virgie-price">
                      <span class="flex-shrink-0">
                        <img src="@/assets/images/users/avatar-5.jpg" alt="" class="avatar-xxs rounded-circle">
                      </span>
                      <span class="flex-grow-1 ms-2">Virgie Price</span>
                    </label>
                  </div>
                </li>
                <li>
                  <div class="form-check d-flex align-items-center">
                    <input class="form-check-input me-3" type="checkbox" value="" id="anthony-mills" />
                    <label class="form-check-label d-flex align-items-center" for="anthony-mills">
                      <span class="flex-shrink-0">
                        <img src="@/assets/images/users/avatar-2.jpg" alt="" class="avatar-xxs rounded-circle" />
                      </span>
                      <span class="flex-grow-1 ms-2">
                        Anthony Mills
                      </span>
                    </label>
                  </div>
                </li>
                <li>
                  <div class="form-check d-flex align-items-center">
                    <input class="form-check-input me-3" type="checkbox" value="" id="marian-angel" />
                    <label class="form-check-label d-flex align-items-center" for="marian-angel">
                      <span class="flex-shrink-0">
                        <img src="@/assets/images/users/avatar-6.jpg" alt="" class="avatar-xxs rounded-circle" />
                      </span>
                      <span class="flex-grow-1 ms-2">
                        Marian Angel
                      </span>
                    </label>
                  </div>
                </li>
                <li>
                  <div class="form-check d-flex align-items-center">
                    <input class="form-check-input me-3" type="checkbox" value="" id="johnnie-walton" />
                    <label class="form-check-label d-flex align-items-center" for="johnnie-walton">
                      <span class="flex-shrink-0">
                        <img src="@/assets/images/users/avatar-7.jpg" alt="" class="avatar-xxs rounded-circle" />
                      </span>
                      <span class="flex-grow-1 ms-2">
                        Johnnie Walton
                      </span>
                    </label>
                  </div>
                </li>
                <li>
                  <div class="form-check d-flex align-items-center">
                    <input class="form-check-input me-3" type="checkbox" value="" id="donna-weston" />
                    <label class="form-check-label d-flex align-items-center" for="donna-weston">
                      <span class="flex-shrink-0">
                        <img src="@/assets/images/users/avatar-8.jpg" alt="" class="avatar-xxs rounded-circle" />
                      </span>
                      <span class="flex-grow-1 ms-2">
                        Donna Weston
                      </span>
                    </label>
                  </div>
                </li>
                <li>
                  <div class="form-check d-flex align-items-center">
                    <input class="form-check-input me-3" type="checkbox" value="" id="diego-norris" />
                    <label class="form-check-label d-flex align-items-center" for="diego-norris">
                      <span class="flex-shrink-0">
                        <img src="@/assets/images/users/avatar-10.jpg" alt="" class="avatar-xxs rounded-circle" />
                      </span>
                      <span class="flex-grow-1 ms-2"> Diego Norris </span>
                    </label>
                  </div>
                </li>
              </ul>
            </simplebar>
            <div class="invalid-feedback">Please select a Assignes name.</div>
          </BCol>
          <BCol lg="6">
            <label for="duedate-field" class="form-label">Due Date</label>
            <flat-pickr placeholder="Select date" :config="timeConfig" class="form-control flatpickr-input" id="date"
              v-model="event.dueDate" :class="{ 'is-invalid': submitted && !event.dueDate }"></flat-pickr>
            <div class="invalid-feedback">Please enter a date name.</div>
          </BCol>
          <BCol lg="6">
            <label for="ticket-status" class="form-label">Status</label>
            <Multiselect id="statusid" :close-on-select="true" :searchable="true" :create-option="true" :options="[
              { value: '', label: 'Status' },
              { value: 'New', label: 'New' },
              { value: 'Inprogress', label: 'Inprogress' },
              { value: 'Pending', label: 'Pending' },
              { value: 'Completed', label: 'Completed' },
            ]" v-model="event.status" :class="{ 'is-invalid': submitted && !event.status }" />
            <div class="invalid-feedback">Please select a status.</div>
          </BCol>
          <BCol lg="12">
            <label for="priority-field" class="form-label">Priority</label>
            <Multiselect id="priority" :close-on-select="true" :searchable="true" :create-option="true" :options="[
              { value: '', label: 'Priority' },
              { value: 'High', label: 'High' },
              { value: 'Medium', label: 'Medium' },
              { value: 'Low', label: 'Low' },
            ]" v-model="event.priority" :class="{ 'is-invalid': submitted && !event.priority }" />
            <div class="invalid-feedback">Please select a priority.</div>
          </BCol>
        </BRow>

        <div class="hstack gap-2 justify-content-end mt-3">
          <BButton type="button" variant="light" @click="taskListModal = false" id="closemodal"> Close </BButton>
          <BButton type="submit" variant="success" id="add-btn" @click="handleSubmit">
            {{ dataEdit ? 'Update' : 'Add Task' }}
          </BButton>
        </div>
      </b-form>
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