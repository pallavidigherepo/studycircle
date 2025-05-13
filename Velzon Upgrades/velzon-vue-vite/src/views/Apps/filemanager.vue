<script setup>
import { ref, onMounted, watch } from "vue";
import Layout from "@/layouts/main.vue";
import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";
import Swal from "sweetalert2";
import { folderList, fileList } from "@/common/data";
import simplebar from "simplebar-vue";
import getChartColorsArray from "@/common/getChartColorsArray";

// State
const fileModal = ref(false);
const folderModal = ref(false);
const filename_input = ref("");
const value = ref("File Type");
const folders = ref([...folderList]);
const filelist = ref([...fileList]);

const series = ref([27.01, 20.87, 33.54, 37.58]);
const chartOptions = ref({
  chart: {
    height: 330,
    type: "donut",
  },
  legend: { position: "bottom" },
  dataLabels: { dropShadow: { enabled: false } },
  colors: getChartColorsArray(
    '["--vz-info", "--vz-danger", "--vz-primary", "--vz-success"]'
  ),
});

// Watchers
watch(folders, () => {});
watch(filelist, () => {});

// Resize logic
function windowResize() {
  const windowSize = document.documentElement.clientWidth;
  if (windowSize < 1400) {
    document.body.classList.remove("file-detail-show");
  } else {
    document.body.classList.add("file-detail-show");
  }
}

// Lifecycle
onMounted(() => {
  windowResize();
  window.addEventListener("resize", windowResize);

  document.querySelectorAll(".favourite-btn").forEach((item) => {
    item.addEventListener("click", () => {
      item.classList.toggle("active");
    });
  });
});

// Functions
function fileDetailShow() {
  const bodyElement = document.body;

  document.querySelectorAll(".close-btn-overview").forEach((item) => {
    item.addEventListener("click", () => {
      bodyElement.classList.remove("file-detail-show");
    });
  });

  document.querySelectorAll("#file-list tr").forEach((item) => {
    item.querySelector(".viewfile-list")?.addEventListener("click", () => {
      bodyElement.classList.add("file-detail-show");
      document.getElementById("file-overview").style.display = "block";
      document.getElementById("folder-overview").style.display = "none";

      const id = item.querySelector(".filelist-id").value;
      const icon = item.querySelector(".filelist-icon i").className;
      const name = item.querySelector(".filelist-name").innerHTML;
      const size = item.querySelector(".filelist-size").innerHTML;
      const date = item.querySelector(".filelist-create").innerHTML;
      const type = item.querySelector(".filelist-type").innerHTML;

      document.querySelector("#file-overview .file-icon i").className = icon;

      document.querySelectorAll("#file-overview .file-name").forEach((el) => {
        el.innerHTML = name;
      });

      document.querySelectorAll("#file-overview .file-size").forEach((el) => {
        el.innerHTML = size;
      });

      document.querySelectorAll("#file-overview .create-date").forEach((el) => {
        el.innerHTML = date;
      });

      document.querySelector("#file-overview .file-type").innerHTML = type;
      document
        .querySelector("#file-overview .remove-file-overview")
        .setAttribute("data-remove-id", id);

      const isFav = item.querySelector(".favourite-btn").classList.contains("active");
      document
        .querySelector("#file-overview .favourite-btn")
        .classList.toggle("active", isFav);
    });
  });

  let isShowMenu = false;
  const sidebar = document.querySelector(".file-manager-sidebar");

  document.querySelectorAll(".file-menu-btn").forEach((item) => {
    item.addEventListener("click", () => {
      sidebar.classList.add("menubar-show");
      isShowMenu = true;
    });
  });

  window.addEventListener("click", () => {
    if (sidebar.classList.contains("menubar-show") && !isShowMenu) {
      sidebar.classList.remove("menubar-show");
    }
    isShowMenu = false;
  });
}

function changefolder(title) {
  document.getElementById("folder-list").style.display = "block";
  document.getElementById("filetype-title").innerHTML = title;
}

function changerecent(title) {
  document.getElementById("folder-list").style.display = "none";
  document.getElementById("filetype-title").innerHTML = title;
}

function changetitle(title) {
  document.getElementById("filetype-title").innerHTML = title;
}

function createfolder() {
  const id = Math.floor(Math.random() * 100);
  const name = document.getElementById("foldername-input").value;

  const data = {
    id,
    name,
    files: "0",
    storage: "0",
    ischecked: false,
  };

  folders.value.unshift(data);
  document.getElementById("addFolderBtn-close").click();
  document.getElementById("createfolder-form").reset();
}

function openFileModal() {
  fileModal.value = true;
  document.getElementById("createfile-btn").style.display = "block";
  document.getElementById("updatefile-btn").style.display = "none";
}

function openFolderModal() {
  folderModal.value = true;
  document.getElementById("createfolder-btn").style.display = "block";
  document.getElementById("updatefolder-btn").style.display = "none";
}

function createNewfile() {
  const name = document.getElementById("filename-input").value;
  if (!name) return;

  const data = {
    id: Math.floor(Math.random() * 100),
    fileName: name + ".txt",
    filetype: "Documents",
    fileItem: "01",
    fileSize: "0 KB",
    date: new Date().toUTCString().slice(5, 16),
    starred: false,
  };

  filelist.value.unshift(data);
  document.getElementById("addFileBtn-close").click();
  document.getElementById("createfile-form").reset();
}

function fileDataEdit(file) {
  fileModal.value = true;
  document.getElementById("modal-id").style.display = "block";
  document.querySelector(".exampleModalLabel").innerHTML = "Update file";
  document.getElementById("updatefile-btn").style.display = "block";
  document.getElementById("createfile-btn").style.display = "none";
  document.getElementById("filename-input").value = file.fileName;
  document.getElementById("fileId").value = file.id;
}

function updatefile() {
  const id = +document.getElementById("fileId").value;
  const idx = filelist.value.findIndex((f) => f.id === id);
  filelist.value[idx].fileName = document.getElementById("filename-input").value;
  fileModal.value = false;
}

function editfolder(folder) {
  folderModal.value = true;
  document.getElementById("modal-id").style.display = "block";
  document.querySelector(".exampleModalLabelFolder").innerHTML = "Update Folder";
  document.getElementById("updatefolder-btn").style.display = "block";
  document.getElementById("createfolder-btn").style.display = "none";
  document.getElementById("foldername-input").value = folder.name;
  document.getElementById("folderId").value = folder.id;
}

function updateFolder() {
  const id = +document.getElementById("folderId").value;
  const idx = folders.value.findIndex((f) => f.id === id);
  folders.value[idx].name = document.getElementById("foldername-input").value;
  document.getElementById("addFolderBtn-close").click();
}

function deletefolder(folder) {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    cancelButtonColor: "#f46a6a",
    confirmButtonColor: "#34c38f",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.value) {
      folders.value.splice(folders.value.indexOf(folder), 1);
      Swal.fire("Deleted!", "Folder has been deleted.", "success");
    }
  });
}

function deletefile(file) {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    cancelButtonColor: "#f46a6a",
    confirmButtonColor: "#34c38f",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.value) {
      filelist.value.splice(filelist.value.indexOf(file), 1);
      Swal.fire("Deleted!", "File has been deleted.", "success");
    }
  });
}

function toggleFavourite(e) {
  e.target.closest(".favourite-btn")?.classList.toggle("active");
}
</script>


<template>
  <Layout>
    <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
      <div class="file-manager-sidebar">
        <div class="p-3 d-flex flex-column h-100">
          <div class="mb-3">
            <h5 class="mb-0 fw-semibold">My Drive</h5>
          </div>
          <div class="search-box">
            <input type="text" class="form-control bg-light border-light" placeholder="Search here..." />
            <i class="ri-search-2-line search-icon"></i>
          </div>
          <simplebar class="mt-3 mx-n4 px-4 file-menu-sidebar-scroll" data-simplebar>
            <ul class="list-unstyled file-manager-menu">
              <li>
                <BLink role="button" v-b-toggle.collapseExample @click="changefolder('Recent Files')">
                  <i class="ri-folder-2-line align-bottom me-2"></i>
                  <span class="file-list-link">My Drive</span>
                </BLink>
                <BCollapse id="collapseExample" visible>
                  <ul class="sub-menu list-unstyled">
                    <li>
                      <BLink href="#!">Assets</BLink>
                    </li>
                    <li>
                      <BLink href="#!">Marketing</BLink>
                    </li>
                    <li>
                      <BLink href="#!">Personal</BLink>
                    </li>
                    <li>
                      <BLink href="#!">Projects</BLink>
                    </li>
                    <li>
                      <BLink href="#!">Templates</BLink>
                    </li>
                  </ul>
                </BCollapse>
              </li>
              <li>
                <BLink href="#!" @click="changetitle('Document')"><i class="ri-file-list-2-line align-bottom me-2"></i>
                  <span class="file-list-link">Documents</span>
                </BLink>
              </li>
              <li>
                <BLink href="#!" @click="changetitle('Media')"><i class="ri-image-2-line align-bottom me-2"></i>
                  <span class="file-list-link">Media</span>
                </BLink>
              </li>
              <li>
                <BLink href="#!" @click="changerecent('Recent')"><i class="ri-history-line align-bottom me-2"></i>
                  <span class="file-list-link">Recent</span>
                </BLink>
              </li>
              <li>
                <BLink href="#!" @click="changetitle('Important')"><i class="ri-star-line align-bottom me-2"></i>
                  <span class="file-list-link">Important</span>
                </BLink>
              </li>
              <li>
                <BLink href="#!" @click="changetitle('Deleted')"><i class="ri-delete-bin-line align-bottom me-2"></i>
                  <span class="file-list-link">Deleted</span>
                </BLink>
              </li>
            </ul>
          </simplebar>

          <div class="mt-auto">
            <h6 class="fs-11 text-muted text-uppercase mb-3">Storage Status</h6>
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <i class="ri-database-2-line fs-17"></i>
              </div>
              <div class="flex-grow-1 ms-3 overflow-hidden">
                <div class="progress mb-2 progress-sm">
                  <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="text-muted fs-12 d-block text-truncate"><b>47.52</b>GB used of <b>119</b>GB</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="file-manager-content w-100 p-3 py-0">
        <simplebar class="mx-n3 pt-4 px-4 file-manager-content-scroll" data-simplebar>
          <div id="folder-list" class="mb-2">
            <BRow class="justify-content-beetwen g-2 mb-3">
              <BCol>
                <div class="d-flex align-items-center">
                  <div class="flex-shrink-0 me-2 d-block d-lg-none">
                    <BButton variant="soft-success" size="sm" type="button" class="btn-icon fs-16 file-menu-btn">
                      <i class="ri-menu-2-fill align-bottom"></i>
                    </BButton>
                  </div>
                  <div class="flex-grow-1">
                    <h5 class="fs-16 mb-0">Folders</h5>
                  </div>
                </div>
              </BCol>

              <BCol cols="auto">
                <div class="d-flex gap-2 align-items-start mb-2">
                  <Multiselect class="form-control w-lg" v-model="value" :options="[
                    'File Type',
                    'All',
                    'Video',
                    'Images',
                    'Music',
                    'Documents',
                  ]" />

                  <BButton variant="success" class="create-folder-modal text-nowrap flex-shrink-0"
                    @click="openFolderModal"><i class="ri-add-line align-bottom me-1"></i> Create Folders
                  </BButton>
                </div>
              </BCol>

            </BRow>

            <BRow id="folderlist-data">
              <BCol v-for="(folder, index) of this.folders" :key="index" cols="6" xxl="3" class=" folder-card">
                <BCard no-body class="bg-light shadow-none" id="folder-1">
                  <BCardBody>
                    <div class="d-flex mb-1">
                      <div class="form-check form-check-danger mb-3 fs-15 flex-grow-1">
                        <input class="form-check-input" type="checkbox" value="" id="folderlistCheckbox_1" checked
                          v-if="folder.ischecked" />
                        <input class="form-check-input" type="checkbox" value="" id="folderlistCheckbox_1"
                          v-if="!folder.ischecked" />
                        <label class="form-check-label" for="folderlistCheckbox_1"></label>
                      </div>
                      <BDropdown variant="ghost-primary" size="sm" class="btn-icon" toggle-class="arrow-none"
                        menu-class="dropdown-menu-end" :offset="{ alignmentAxis: -125, crossAxis: 0, mainAxis: 0 }">
                        <template #button-content>
                          <i class="ri-more-2-fill fs-16 align-bottom"></i>
                        </template>
                        <BDropdownItem> Open </BDropdownItem>
                        <BDropdownItem @click="editfolder(folder)"> Rename </BDropdownItem>
                        <BDropdownItem @click="deletefolder(folder)"> Delete </BDropdownItem>
                      </BDropdown>
                    </div>

                    <div class="text-center">
                      <div class="mb-2">
                        <i class="ri-folder-2-fill align-bottom text-warning display-5"></i>
                      </div>
                      <h6 class="fs-15 folder-name">{{ folder.name }}</h6>
                    </div>
                    <div class="hstack mt-4 text-muted">
                      <span class="me-auto"><b>{{ folder.files }}</b> Files</span>
                      <span><b>{{ folder.storage }}</b>GB</span>
                    </div>
                  </BCardBody>
                </BCard>
              </BCol>

            </BRow>

          </div>
          <div>
            <div class="d-flex align-items-center mb-3">
              <h5 class="flex-grow-1 fs-16 mb-0" id="filetype-title">
                Recent File
              </h5>
              <div class="flex-shrink-0">
                <BButton variant="success" class="create-folder-modal text-nowrap flex-shrink-0" @click="openFileModal"><i
                    class="ri-add-line align-bottom me-1"></i> Create File</BButton>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-middle table-nowrap mb-0">
                <thead class="table-active">
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">File Item</th>
                    <th scope="col">File Size</th>
                    <th scope="col">Recent Date</th>
                    <th scope="col" class="text-center">Actions</th>
                  </tr>
                </thead>
                <tbody id="file-list">
                  <tr v-for="(fileData, index) of this.filelist" :key="index">
                    <td>
                      <input class="form-control filelist-id" type="hidden" value="{{fileData.id}}"
                        id="filelist-{{fileData.id}}" />
                      <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 fs-17 me-2 filelist-icon">
                          <i class="ri-gallery-fill align-bottom text-success" v-if="fileData.fileName.includes('.') &&
                            fileData.fileName.split('.')[1] == 'png'
                            "></i>
                          <i class="ri-gallery-fill align-bottom text-success" v-if="fileData.fileName.includes('.') &&
                            fileData.fileName.split('.')[1] == 'jpg'
                            "></i>
                          <i class="ri-file-pdf-fill align-bottom text-danger" v-if="fileData.fileName.includes('.') &&
                            fileData.fileName.split('.')[1] == 'pdf'
                            "></i>
                          <i class="ri-file-text-fill align-bottom text-secondary" v-if="fileData.fileName.includes('.') &&
                            fileData.fileName.split('.')[1] == 'docx'
                            "></i>
                          <i class="ri-file-text-fill align-bottom text-secondary" v-if="fileData.fileName.includes('.') &&
                            fileData.fileName.split('.')[1] == 'txt'
                            "></i>
                          <i class="ri-file-text-fill align-bottom text-secondary"
                            v-if="!fileData.fileName.includes('.')"></i>
                        </div>
                        <div class="flex-grow-1 filelist-name">
                          {{ fileData.fileName }}
                        </div>
                        <div class="d-none filelist-type">
                          {{ fileData.filetype }}
                        </div>
                      </div>
                    </td>
                    <td>{{ fileData.fileItem }}</td>
                    <td class="filelist-size">{{ fileData.fileSize }}</td>
                    <td class="filelist-create">{{ fileData.date }}</td>
                    <td>
                      <div class="d-flex gap-3 justify-content-center">
                        <BButton variant="ghost-primary" size="sm" class="btn-icon favourite-btn active"
                          v-if="fileData.starred" @click="togglefavorite">
                          <i class="ri-star-fill fs-13 align-bottom"></i>
                        </BButton>
                        <BButton variant="ghost-primary" size="sm" class="btn-icon favourite-btn" v-if="!fileData.starred">
                          <i class="ri-star-fill fs-13 align-bottom"></i>
                        </BButton>

                        <BDropdown variant="light" size="sm" class="btn-icon" toggle-class="arrow-none"
                          menu-class="dropdown-menu-end">
                          <template #button-content>
                            <i class="ri-more-fill align-bottom"></i>
                          </template>
                          <BDropdownItem class="viewfile-list"> View </BDropdownItem>
                          <BDropdownItem class="edit-list" @click="fileDataEdit(fileData)"> Rename </BDropdownItem>
                          <BDropdownItem class="remove-list" @click="deletefile(fileData)"> Delete </BDropdownItem>
                        </BDropdown>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <ul id="pagination" class="pagination pagination-lg"></ul>
            <BRow class="align-items-center mt-2 g-3 text-center text-sm-start">
              <BCol cols="sm">
                <div class="text-muted">
                  Showing<span class="fw-semibold">4</span> of
                  <span class="fw-semibold">125</span> Results
                </div>
              </BCol>
              <BCol sm="auto">
                <ul
                  class="pagination pagination-separated pagination-sm justify-content-center justify-content-sm-start mb-0">
                  <li class="page-item disabled">
                    <BLink href="#" class="page-link">←</BLink>
                  </li>
                  <li class="page-item">
                    <BLink href="#" class="page-link">1</BLink>
                  </li>
                  <li class="page-item active">
                    <BLink href="#" class="page-link">2</BLink>
                  </li>
                  <li class="page-item">
                    <BLink href="#" class="page-link">3</BLink>
                  </li>
                  <li class="page-item">
                    <BLink href="#" class="page-link">→</BLink>
                  </li>
                </ul>
              </BCol>
            </BRow>
          </div>
        </simplebar>
      </div>
      <div class="file-manager-detail-content p-3 py-0">
        <simplebar class="mx-n3 pt-3 px-3 file-detail-content-scroll" data-simplebar>
          <div id="folder-overview">
            <div class="d-flex align-items-center pb-3 border-bottom border-bottom-dashed">
              <h5 class="flex-grow-1 fw-semibold mb-0">Overview</h5>
              <div>
                <BButton type="button" variant="soft-danger" size="sm" class="btn-icon fs-16 close-btn-overview"
                  @click="fileDetailShow">
                  <i class="ri-close-fill align-bottom"></i>
                </BButton>
              </div>
            </div>
            <apexchart class="apex-charts" height="330" dir="ltr" :series="series" :options="chartOptions"></apexchart>
            <div class="mt-4">
              <ul class="list-unstyled vstack gap-4">
                <li>
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                      <div class="avatar-xs">
                        <div class="avatar-title rounded bg-secondary-subtle text-secondary">
                          <i class="ri-file-text-line fs-17"></i>
                        </div>
                      </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <h5 class="mb-1 fs-15">Documents</h5>
                      <p class="mb-0 fs-12 text-muted">2348 files</p>
                    </div>
                    <b>27.01 GB</b>
                  </div>
                </li>
                <li>
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                      <div class="avatar-xs">
                        <div class="avatar-title rounded bg-success-subtle text-success">
                          <i class="ri-gallery-line fs-17"></i>
                        </div>
                      </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <h5 class="mb-1 fs-15">Media</h5>
                      <p class="mb-0 fs-12 text-muted">12480 files</p>
                    </div>
                    <b>20.87 GB</b>
                  </div>
                </li>
                <li>
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                      <div class="avatar-xs">
                        <div class="avatar-title rounded bg-warning-subtle text-warning">
                          <i class="ri-folder-2-line fs-17"></i>
                        </div>
                      </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <h5 class="mb-1 fs-15">Projects</h5>
                      <p class="mb-0 fs-12 text-muted">349 files</p>
                    </div>
                    <b>4.10 GB</b>
                  </div>
                </li>
                <li>
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                      <div class="avatar-xs">
                        <div class="avatar-title rounded bg-primary-subtle text-primary">
                          <i class="ri-error-warning-line fs-17"></i>
                        </div>
                      </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <h5 class="mb-1 fs-15">Others</h5>
                      <p class="mb-0 fs-12 text-muted">9873 files</p>
                    </div>
                    <b>33.54 GB</b>
                  </div>
                </li>
              </ul>
            </div>
            <div class="pb-3 mt-auto">

              <BAlert :model-value="true" variant="danger" class="d-flex align-items-center mb-0" show>
                <div class="flex-shrink-0">
                  <i class="ri-cloud-line text-danger align-bottom display-5"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h5 class="text-danger fs-14">Upgrade to Pro</h5>
                  <p class="text-muted mb-2">Get more space for your...</p>
                  <BButton variant="danger" size="sm">
                    <i class="ri-upload-cloud-line align-bottom"></i> Upgrade Now
                  </BButton>
                </div>
              </BAlert>
            </div>
          </div>
          <div id="file-overview" class="h-100">
            <div class="d-flex h-100 flex-column">
              <div class="d-flex align-items-center pb-3 border-bottom border-bottom-dashed mb-3 gap-2">
                <h5 class="flex-grow-1 fw-semibold mb-0">File Preview</h5>
                <div>
                  <BButton type="button" variant="ghost-primary" size="sm" class="btn-icon fs-16 favourite-btn">
                    <i class="ri-star-fill align-bottom"></i>
                  </BButton>
                  <BButton type="button" variant="soft-danger" size="sm" class="btn-icon fs-16 close-btn-overview">
                    <i class="ri-close-fill align-bottom"></i>
                  </BButton>
                </div>
              </div>

              <div class="pb-3 border-bottom border-bottom-dashed mb-3">
                <div class="file-details-box bg-light p-3 text-center rounded-3 border border-light mb-3">
                  <div class="display-4 file-icon">
                    <i class="ri-file-text-fill text-secondary"></i>
                  </div>
                </div>
                <BButton type="button" variant="ghost-success" size="sm" class="btn-icon float-end fs-16">
                  <i class="ri-share-forward-line"></i>
                </BButton>
                <h5 class="fs-16 mb-1 file-name">html.docx</h5>
                <p class="text-muted mb-0 fs-12">
                  <span class="file-size">0.3 KB</span>,
                  <span class="create-date">19 Apr, 2022</span>
                </p>
              </div>
              <div>
                <h5 class="fs-12 text-uppercase text-muted mb-3">
                  File Description :
                </h5>

                <div class="table-responsive">
                  <table class="table table-borderless table-nowrap table-sm">
                    <tbody>
                      <tr>
                        <th scope="row" style="width: 35%">File Name :</th>
                        <td class="file-name">html.docx</td>
                      </tr>
                      <tr>
                        <th scope="row">File Type :</th>
                        <td class="file-type">Documents</td>
                      </tr>
                      <tr>
                        <th scope="row">Size :</th>
                        <td class="file-size">0.3 KB</td>
                      </tr>
                      <tr>
                        <th scope="row">Created :</th>
                        <td class="create-date">19 Apr, 2022</td>
                      </tr>
                      <tr>
                        <th scope="row">Path :</th>
                        <td class="file-path">
                          <div class="user-select-all text-truncate">
                            *:\projects\src\assets\images
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <div>
                  <h5 class="fs-12 text-uppercase text-muted mb-3">
                    Share Information:
                  </h5>
                  <div class="table-responsive">
                    <table class="table table-borderless table-nowrap table-sm">
                      <tbody>
                        <tr>
                          <th scope="row" style="width: 35%">Share Name :</th>
                          <td class="share-name">\\*\Projects</td>
                        </tr>
                        <tr>
                          <th scope="row">Share Path :</th>
                          <td class="share-path">velzon:\Documents\</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="mt-auto border-top border-top-dashed py-3">
                <div class="hstack gap-2">
                  <BButton variant="soft-primary" type="button" class="w-100">
                    <i class="ri-download-2-line align-bottom me-1"></i>
                    Download
                  </BButton>
                  <BButton variant="soft-danger" type="button" class="w-100 remove-file-overview">
                    <i class="ri-close-fill align-bottom me-1"></i> Delete
                  </BButton>
                </div>
              </div>
            </div>
          </div>
        </simplebar>
      </div>
    </div>

    <BModal v-model="folderModal" hide-footer title="Create Folder" title-class="exampleModalLabelFolder"
      class="v-modal-custom" modal-class="zoomIn" centered header-class="p-3 bg-success-subtle">
      <BForm autocomplete="off" class="needs-validation createfolder-form" id="createfolder-form" novalidate>
        <div class="mb-4">
          <div id="modal-id"></div>
          <label for="foldername-input" class="form-label">Folder Name</label>
          <input type="text" class="form-control" id="foldername-input" required placeholder="Enter folder name" />
          <div class="invalid-feedback">Please enter a folder name.</div>
          <input type="hidden" id="folderId">
          <input type="hidden" class="form-control" id="folderid-input" value="" placeholder="Enter folder name" />
        </div>
        <div class="hstack gap-2 justify-content-end">
          <BButton type="button" variant="ghost-success" data-bs-dismiss="modal" id="addFolderBtn-close"
            @click="folderModal = false">
            <i class="ri-close-line align-bottom"></i> Close
          </BButton>
          <BButton type="button" variant="success" id="updatefolder-btn" @click="updateFolder">
            Update
          </BButton>
          <BButton type="button" variant="primary" id="createfolder-btn" @click="createfolder">
            Add Folder
          </BButton>
        </div>
      </BForm>
    </BModal>

    <BModal v-model="fileModal" hide-footer title="Create File" title-class="exampleModalLabel" class="v-modal-custom"
      modal-class="zoomIn" centered header-class="p-3 bg-success-subtle">
      <BForm autocomplete="off" class="needs-validation createfile-form" id="createfile-form" novalidate>
        <div class="mb-4">
          <div id="modal-id"></div>
          <label for="filename-input" class="form-label">File Name</label>
          <input type="hidden" id="fileId">
          <input type="text" class="form-control" id="filename-input" required placeholder="Enter file name" />
          <div class="invalid-feedback">Please enter a file name.</div>
          <input type="hidden" class="form-control" id="fileid-input" placeholder="Enter file name" />
        </div>
        <div class="hstack gap-2 justify-content-end">
          <BButton type="button" variant="ghost-success" id="addFileBtn-close" @click="fileModal = false">
            <i class="ri-close-line align-bottom"></i> Close
          </BButton>
          <BButton type="button" variant="success" id="updatefile-btn" @click="updatefile">
            Update
          </BButton>
          <BButton type="button" variant="primary" id="createfile-btn" @click="createNewfile">
            Create
          </BButton>
        </div>
      </BForm>
    </BModal>
  </Layout>
</template>
