<script setup>
import { ref, reactive, computed, watch, onMounted } from 'vue';
import Layout from '@/layouts/main.vue';
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import Multiselect from '@vueform/multiselect';
import '@vueform/multiselect/themes/default.css';
import Swal from 'vue-sweetalert2';
import { todoList as initialTodoList } from '@/common/data';
import simplebar from 'simplebar-vue';

// States
const date = ref(null);
const projectModal = ref(false);
const taskModal = ref(false);
const editFlag = ref(null);
const searchQuery = ref('');
const status = ref('All Tasks');
const todoList = ref([...initialTodoList]);
const value = ref(null);
const statusvalue = ref(null);
const priorityvalue = ref(null);
const selectedimage = ref([]);
const timeConfig = reactive({
  dateFormat: 'Y-m-d',
});

// Multiselect options
const options = [
  { name: 'James Forbes', value: '@/assets/images/users/avatar-2.jpg' },
  { name: 'John Robles', value: '@/assets/images/users/avatar-3.jpg' },
  { name: 'Mary Gant', value: '@/assets/images/users/avatar-4.jpg' },
  { name: 'Curtis Saenz', value: '@/assets/images/users/avatar-1.jpg' },
  { name: 'Virgie Price', value: '@/assets/images/users/avatar-5.jpg' },
  { name: 'Anthony Mills', value: '@/assets/images/users/avatar-10.jpg' },
  { name: 'Marian Angel', value: '@/assets/images/users/avatar-6.jpg' },
  { name: 'Johnnie Walton', value: '@/assets/images/users/avatar-7.jpg' },
  { name: 'Donna Weston', value: '@/assets/images/users/avatar-8.jpg' },
  { name: 'Diego Norris', value: '@/assets/images/users/avatar-9.jpg' },
];

// Computed: Filtered list based on query/status
const resultQuery = computed(() => {
  if (searchQuery.value) {
    const search = searchQuery.value.toLowerCase();
    return todoList.value.filter((data) =>
      data.priority.toLowerCase().includes(search) ||
      data.status.toLowerCase().includes(search) ||
      data.todo.toLowerCase().includes(search)
    );
  } else if (status.value !== null) {
    return todoList.value.filter((data) =>
      data.status === status.value || status.value === 'All Tasks'
    );
  } else {
    return todoList.value;
  }
});

// Methods
const deletedata = (event) => {
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    cancelButtonColor: '#f46a6a',
    confirmButtonColor: '#34c38f',
    confirmButtonText: 'Yes, delete it!',
  }).then((result) => {
    if (result.value) {
      todoList.value.splice(todoList.value.indexOf(event), 1);
      Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
    }
  });
};

const create = () => {
  taskModal.value = true;
  document.querySelector('.task-modal').innerHTML = 'Create Task';
  document.getElementById('addNewTodo').innerHTML = 'Add Task';
  document.getElementById('task-title-input').value = '';
  document.getElementById('task-duedate-input').value = '';
  const label = document.querySelector('.multiselect-single-label-text');
  if (label) {
    label.innerHTML = '';
    document.querySelector('.multiselect-clear').click();
  }
  selectedimage.value = [];
  value.value = null;
};

const upsert = () => {
  const isEditing = document.querySelector('.task-modal').innerHTML === 'Edit Task';
  const title = document.getElementById('task-title-input').value;
  const date = document.getElementById('task-duedate-input').value;
  const imgArray = selectedimage.value.map((item) => ({ assigneeImg: item }));
  const statusVal = statusvalue.value;
  const priorityVal = priorityvalue.value || 'High';

  if (!title || !date || !statusVal || !priorityVal) {
    document.getElementById('task-error-msg').innerHTML = 'please fill all detail';
    return;
  }

  if (isEditing) {
    const id = document.getElementById('taskid-input').value;
    const index = todoList.value.findIndex((item) => item.id == id);
    if (index > -1) {
      todoList.value[index] = {
        ...todoList.value[index],
        todo: title,
        dueDate: date,
        assignedto: imgArray,
        status: statusVal,
        priority: priorityVal,
      };
    }
  } else {
    todoList.value.unshift({
      id: todoList.value.length + 1,
      checkedElem: false,
      todo: title,
      assignedto: imgArray,
      dueDate: date,
      status: statusVal,
      priority: priorityVal,
    });
  }

  document.getElementById('createTaskBtn-close').click();
  document.getElementById('creattask-form').reset();
  statusvalue.value = '';
  priorityvalue.value = '';
  selectedimage.value = [];
  date.value = '';
};

const onChange = (selected) => {
  selectedimage.value = [...selected];
};

const editdata = (item) => {
  taskModal.value = true;
  value.value = null;
  selectedimage.value = item.assignedto.map((i) => i.assigneeImg || i);
  document.querySelector('.task-modal').innerHTML = 'Edit Task';
  document.getElementById('addNewTodo').innerHTML = 'Save';
  document.getElementById('taskid-input').value = item.id;
  document.getElementById('task-title-input').value = item.todo;
  document.getElementById('task-duedate-input').value = item.dueDate;
  statusvalue.value = item.status;
  priorityvalue.value = item.priority;
};

const sortElementsById = () => {
  todoList.value.sort((a, b) => parseInt(b.id) - parseInt(a.id));
};

const todoListStatus = (e) => {
  todoList.value.forEach((item) => {
    if (item.id == e.target.id) {
      item.status = item.status === 'Completed' ? 'Inprogress' : 'Completed';
    }
  });
};

const addNewProject = () => {
  const projectName = document.getElementById('projectname-input').value;
  const uniqueid = Math.floor(Math.random() * 100);
  if (!projectName) return;
  const html = `
    <li id="projectlist-${uniqueid}">
      <a data-bs-toggle="collapse" href="#projectCollapse-${uniqueid}" class="nav-link fs-13">${projectName}</a>
      <div class="collapse" id="projectCollapse-${uniqueid}">
        <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
          <li>
            <a href="#!"><i class="ri-stop-mini-fill align-middle fs-15 text-danger"></i> v1.0.0</a>
          </li>
        </ul>
      </div>
    </li>`;
  document.getElementById('projectlist-data').insertAdjacentHTML('beforeend', html);
  document.getElementById('addProjectBtn-close').click();
  document.getElementById('projectForm').reset();
};

onMounted(() => {
  const btn = document.getElementById('addNewProject');
  if (btn) btn.addEventListener('click', addNewProject);
  sortElementsById();
});
</script>
    
<template>
    <Layout>

        <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
            <div class="file-manager-sidebar minimal-border">
                <div class="p-4 d-flex flex-column h-100">
                    <div class="mb-3">
                        <BButton variant="success" class="w-100" @click="projectModal = !projectModal"><i
                                class="ri-add-line align-bottom"></i> Add Project</BButton>
                    </div>

                    <simplebar class="px-4 mx-n4" data-simplebar style="height: calc(100vh - 468px);">
                        <ul class="to-do-menu list-unstyled" id="projectlist-data">
                            <li>
                                <BLink v-b-toggle.velzonAdmin class="nav-link fs-13 active">
                                    Velzon
                                    Admin & Dashboard</BLink>
                                <BCollapse id="velzonAdmin" visible>
                                    <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                        <li>
                                            <BLink href="#!"><i
                                                    class="ri-stop-mini-fill align-middle fs-15 text-danger"></i>
                                                v1.4.0</BLink>
                                        </li>
                                        <li>
                                            <BLink href="#!"><i
                                                    class="ri-stop-mini-fill align-middle fs-15 text-secondary"></i>
                                                v1.5.0</BLink>
                                        </li>
                                        <li>
                                            <BLink href="#!"><i class="ri-stop-mini-fill align-middle fs-15 text-info"></i>
                                                v1.6.0</BLink>
                                        </li>
                                        <li>
                                            <BLink href="#!"><i
                                                    class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>
                                                v1.7.0</BLink>
                                        </li>
                                        <li>
                                            <BLink href="#!"><i
                                                    class="ri-stop-mini-fill align-middle fs-15 text-warning"></i>
                                                v1.8.0</BLink>
                                        </li>
                                    </ul>
                                </BCollapse >
                            </li>
                            <li>
                                <BLink v-b-toggle.projectManagement class="nav-link fs-13">
                                    Project
                                    Management</BLink>
                                <BCollapse id="projectManagement">
                                    <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                        <li>
                                            <BLink href="#!"><i
                                                    class="ri-stop-mini-fill align-middle fs-15 text-danger"></i>
                                                v2.1.0</BLink>
                                        </li>
                                        <li>
                                            <BLink href="#!"><i
                                                    class="ri-stop-mini-fill align-middle fs-15 text-secondary"></i>
                                                v2.2.0</BLink>
                                        </li>
                                        <li>
                                            <BLink href="#!"><i class="ri-stop-mini-fill align-middle fs-15 text-info"></i>
                                                v2.3.0</BLink>
                                        </li>
                                        <li>
                                            <BLink href="#!"><i
                                                    class="ri-stop-mini-fill align-middle fs-15 text-primary"></i>
                                                v2.4.0</BLink>
                                        </li>
                                    </ul>
                                </BCollapse >
                            </li>
                            <li>
                                <BLink v-b-toggle.skoteAdmin class="nav-link fs-13">Skote Admin
                                    &
                                    Dashboard</BLink>
                                <BCollapse id="skoteAdmin">
                                    <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                        <li>
                                            <BLink href="#!"><i
                                                    class="ri-stop-mini-fill align-middle fs-15 text-danger"></i>
                                                v4.1.0</BLink>
                                        </li>
                                        <li>
                                            <BLink href="#!"><i
                                                    class="ri-stop-mini-fill align-middle fs-15 text-secondary"></i>
                                                v4.2.0</BLink>
                                        </li>
                                    </ul>
                                </BCollapse >
                            </li>
                            <li>
                                <BLink v-b-toggle.ecommerceProject class="nav-link fs-13">Doot -
                                    Chat
                                    App Template</BLink>
                                <BCollapse id="ecommerceProject">
                                    <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                                        <li>
                                            <BLink href="#!"><i
                                                    class="ri-stop-mini-fill align-middle fs-15 text-danger"></i>
                                                v1.0.0</BLink>
                                        </li>
                                        <li>
                                            <BLink href="#!"><i
                                                    class="ri-stop-mini-fill align-middle fs-15 text-secondary"></i>
                                                v1.1.0</BLink>
                                        </li>
                                        <li>
                                            <BLink href="#!"><i class="ri-stop-mini-fill align-middle fs-15 text-info"></i>
                                                v1.2.0</BLink>
                                        </li>
                                    </ul>
                                </BCollapse >
                            </li>
                        </ul>
                    </simplebar>


                    <div class="mt-auto text-center">
                        <img src="@/assets/images/task.png" alt="Task" class="img-fluid" />
                    </div>
                </div>
            </div>
            <!--end side content-->
            <div class="file-manager-content minimal-border w-100 p-4 pb-0">
                <BRow class="mb-4">
                    <div order="1" class="col-auto d-block d-lg-none">
                        <BButton variant="btn-soft-success" class="btn btn-icon btn-sm fs-16 file-menu-btn">
                            <i class="ri-menu-2-fill align-bottom"></i>
                        </BButton>
                    </div>
                    <BCol order="3" order-sm="2" class="mt-3 mt-sm-0" sm>
                        <h5 class="fw-semibold mb-0">Velzon Admin & Dashboard <span
                                class="badge bg-primary align-bottom ms-2">v2.0.0</span></h5>
                    </BCol>

                    <BCol order="2" order-sm="3" class="col-auto ms-auto">
                        <div class="hstack gap-2">
                            <BButton-group>
                                <BButton variant="soft-danger" class="btn btn-icon fw-semibold material-shadow-none"><i
                                        class="ri-arrow-go-back-line"></i></BButton>
                                <BButton variant="soft-success" class="btn btn-icon fw-semibold material-shadow-none"><i
                                        class="ri-arrow-go-forward-line"></i></BButton>
                            </BButton-group>
                        </div>
                    </BCol>
                </BRow>
                <div class="p-3 bg-light rounded mb-4">
                    <BRow class="g-2">
                        <BCol lg="auto">
                            <select class="form-control" data-choices data-choices-search-false
                                name="choices-select-sortlist" id="choices-select-sortlist">
                                <option value="">Sort</option>
                                <option value="By ID">By ID</option>
                                <option value="By Name">By Name</option>
                            </select>
                        </BCol>
                        <BCol lg="auto">
                            <select class="form-control" data-choices data-choices-search-false name="choices-select-status"
                                id="choices-select-status" v-model="status">
                                <option value="All Tasks">All Tasks</option>
                                <option value="Completed">Completed</option>
                                <option value="Inprogress">Inprogress</option>
                                <option value="Pending">Pending</option>
                                <option value="New">New</option>
                            </select>
                        </BCol>
                        <BCol lg>
                            <div class="search-box">
                                <input type="text" id="searchTaskList" class="form-control search"
                                    placeholder="Search task name" v-model="searchQuery">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </BCol>
                        <BCol lg="auto">
                            <!-- <BButton variant="primary" class="createTask" type="button" data-bs-toggle="modal"
                                data-bs-target="#createTask" @click="create">
                                <i class="ri-add-fill align-bottom"></i> Add Tasks
                            </BButton> -->
                            <BButton variant="primary" class="createTask" @click="create"> <i
                                    class="ri-add-fill align-bottom"></i> Add Tasks
                            </BButton>
                        </BCol>
                    </BRow>
                </div>

                <div class="todo-content position-relative px-4 mx-n4" id="todo-content">
                    <div id="elmLoader">
                        <div class="spinner-border text-primary avatar-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="todo-task" id="todo-task">
                        <div class="table-responsive">
                            <table class="table align-middle position-relative table-nowrap">
                                <thead class="table-active">
                                    <tr>
                                        <th scope="col">Task Name</th>
                                        <th scope="col">Assigned</th>
                                        <th scope="col">Due Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Priority</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody id="task-lists">
                                    <tr v-for="(singleTodo, index) of this.resultQuery" :key="index">
                                        <td>
                                            <div class="d-flex align-items-start">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="task-handle px-1 bg-light rounded">: :</div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            :value="singleTodo.id" :id="singleTodo.id" checked
                                                            v-if="singleTodo.checkedElem" @click="(e) => todoListStatus(e)">
                                                        <input class="form-check-input" type="checkbox"
                                                            :value="singleTodo.id" :id="singleTodo.id"
                                                            v-if="!singleTodo.checkedElem"
                                                            @click="(e) => todoListStatus(e)">
                                                        <label class="form-check-label ms-1" :for="singleTodo.id">
                                                            {{ singleTodo.todo }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <span v-for="(img, index) of singleTodo.assignedto" :key="index">
                                                    <BLink href="javascript: void(0);" class="avatar-group-item"
                                                        data-img="{{img.assigneeImg}}" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="">
                                                        <img :src="img.assigneeImg" alt=""
                                                            class="rounded-circle avatar-xxs" />
                                                    </BLink>
                                                </span>
                                            </div>
                                        </td>
                                        <td> {{ singleTodo.dueDate }} </td>
                                        <td v-if="singleTodo.status == 'Pending'"><BBadge variant="warning-subtle"
                                                class="bg-warning-subtle text-warning text-uppercase">{{ singleTodo.status
                                                }}
                                            </BBadge> </td>
                                        <td v-if="singleTodo.status == 'Inprogress'"><BBadge variant="secondary-subtle"
                                                class="bg-secondary-subtle text-secondary text-uppercase">{{
                                                    singleTodo.status
                                                }}
                                            </BBadge> </td>
                                        <td v-if="singleTodo.status == 'Completed'"><BBadge variant="success-subtle"
                                                class="bg-success-subtle text-success text-uppercase">{{ singleTodo.status
                                                }}
                                            </BBadge> </td>
                                        <td v-if="singleTodo.status == 'New'"><BBadge variant="info-subtle"
                                                class="bg-info-subtle text-info text-uppercase">{{ singleTodo.status }}
                                            </BBadge> </td>
                                        <td v-if="singleTodo.priority == 'High'"><BBadge variant="danger"
                                                class="text-uppercase">{{ singleTodo.priority }}</BBadge>
                                        </td>
                                        <td v-if="singleTodo.priority == 'Low'"><BBadge variant="success"
                                                class="text-uppercase">{{ singleTodo.priority }}</BBadge>
                                        </td>
                                        <td v-if="singleTodo.priority == 'Medium'"><BBadge
                                                class="bg-warning text-uppercase">{{ singleTodo.priority }}</BBadge>
                                        </td>
                                        <td>
                                            <div class="hstack gap-2">
                                                <BButton variant="soft-danger" size="sm" class="remove-list"
                                                    data-remove-id={{singleTodo.id}} @click="deletedata(singleTodo)"><i
                                                        class="ri-delete-bin-5-fill align-bottom"></i></BButton>
                                                <BButton variant="soft-info" size="sm" class="edit-list"
                                                    data-edit-id={{singleTodo.id}} @click="editdata(singleTodo)"><i
                                                        class="ri-pencil-fill align-bottom"></i>
                                                </BButton>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="py-4 mt-4 text-center" id="noresult" style="display: none;">
                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                            colors="primary:#405189,secondary:#0ab39c" style="width:72px;height:72px"></lord-icon>
                        <h5 class="mt-4">Sorry! No Result Found</h5>
                    </div>
                </div>

            </div>
        </div>

        <BModal v-model="projectModal" hide-footer title="Create Project" class="v-modal-custom" modal-class="zoomIn"
            centered header-class="p-3 bg-success-subtle">
            <BForm id="projectForm" autocomplete="off" class="needs-validation createProject-form" novalidate>
                <div class="mb-4">
                    <label for="projectname-input" class="form-label">Project Name</label>
                    <input type="text" class="form-control" id="projectname-input" autocomplete="off"
                        placeholder="Enter project name" required>
                    <div class="invalid-feedback">Please enter a project name</div>
                    <input type="hidden" class="form-control" id="projectid-input" value=""
                        placeholder="Enter project name">
                </div>
                <div class="hstack gap-2 justify-content-end">
                    <BButton type="button" variant="ghost-success" id="addProjectBtn-close"
                        @click="projectModal = false"><i class="ri-close-line align-bottom"></i> Close</BButton>
                    <BButton type="submit" variant="primary" id="addNewProject" class="material-shadow-none">Add Project
                    </BButton>
                </div>
            </BForm>
        </BModal>

        <BModal v-model="taskModal" hide-footer title="Create Task" title-class="task-modal" class="v-modal-custom"
            modal-class="zoomIn" centered header-class="p-3 bg-success-subtle">
            <div id="task-error-msg" class="alert alert-danger py-2"></div>
            <BForm autocomplete="off" action="" id="creattask-form">
                <input type="hidden" id="taskid-input" class="form-control">
                <div class="mb-3">
                    <label for="task-title-input" class="form-label">Task Title</label>
                    <input type="text" id="task-title-input" class="form-control" placeholder="Enter task title">
                </div>
                <div class="mb-3 position-relative">
                    <label for="task-assign-input" class="form-label">Assigned To</label>
                    <div class="avatar-group justify-content-center" id="assignee-member">
                        <span v-for="(img, index) of selectedimage" :key="index">
                            <BLink href="javascript: void(0);" class="avatar-group-item mb-2" data-img="{{img}}"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="{{img}}">
                                <img :src="img" alt="" class="rounded-circle avatar-xs" />
                            </BLink>
                        </span>
                    </div>
                    <Multiselect v-model="value" :options="options" mode="multiple" :multiple="true"
                        :close-on-select="false" :clear-on-select="false" :searchable="false" :create-option="true"
                        placeholder="Pick some" label="name" @input="onChange">
                        <template v-slot="{ values, isOpen }">
                            <span class="multiselect__single" v-if="values.length && !isOpen">Assigned
                                To<b>{{ values.length
                                }}</b> Members</span>
                        </template>
                    </Multiselect>
                </div>
                <BRow class="g-4 mb-3">
                    <BCol lg="6">
                        <label for="task-status" class="form-label">Status</label>
                        <Multiselect placeholder="select status" v-model="statusvalue"
                            :options="['New', 'Inprogress', 'Pending', 'Completed']" />
                    </BCol>

                    <BCol lg="6">
                        <label for="priority-field" class="form-label">Priority</label>
                        <Multiselect v-model="priorityvalue" placeholder="select priority"
                            :options="['High', 'Medium', 'Low']" />
                    </BCol>

                </BRow>
                <div class="mb-4">
                    <label for="task-duedate-input" class="form-label">Due Date:</label>
                    <flat-pickr placeholder="Due date" v-model="date" :config="timeConfig"
                        class="form-control flatpickr-input" id="task-duedate-input"></flat-pickr>
                </div>

                <div class="hstack gap-2 justify-content-end">
                    <BButton type="button" variant="ghost-success" id="createTaskBtn-close" @click="taskModal = false">
                        <i class="ri-close-fill align-bottom"></i> Close
                    </BButton>
                    <BButton type="button" variant="primary" id="addNewTodo" @click="upsert">Add
                        Task</BButton>
                </div>
            </BForm>
        </BModal>
</Layout></template>