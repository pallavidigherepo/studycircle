<script setup>
import { ref, computed, watch, onMounted } from 'vue';

const searchQuery = ref(null);
const page = ref(1);
const perPage = ref(6);
const pages = ref([]);
const recomendedjob = ref([
  {
    id: '1',
    position: 'Assistant / Store Keeper',
    c_name: 'Moetic Fashion',
    location: 'Limestone, US',
    salary: '$340 - $800',
    experience: '0-3 year',
    job_type: 'Internship'
  },
  {
    id: '2',
    position: 'Education Training',
    c_name: 'Micro Design',
    location: 'Germany',
    salary: '$750 - $940',
    experience: '1.5+ year',
    job_type: 'Freelancer'
  },
  {
    id: '3',
    position: 'Executive, HR Operations',
    c_name: 'Micro Design',
    location: 'Texanna, US',
    salary: '$50 - $120',
    experience: '1-5 year',
    job_type: 'Part Time'
  },
  // (other job objects)
]);

const displayedPosts = computed(() => paginate(recomendedjob.value));

const resultQuery = computed(() => {
  if (searchQuery.value) {
    const search = searchQuery.value.toLowerCase();
    return displayedPosts.value.filter((data) => {
      return (
        data.position.toLowerCase().includes(search) ||
        data.c_name.toLowerCase().includes(search) ||
        data.location.toLowerCase().includes(search) ||
        data.salary.toLowerCase().includes(search) ||
        data.experience.toLowerCase().includes(search) ||
        data.job_type.toLowerCase().includes(search)
      );
    });
  }
  return displayedPosts.value;
});

const setPages = () => {
  const numberOfPages = Math.ceil(recomendedjob.value.length / perPage.value);
  pages.value = [];
  for (let index = 1; index <= numberOfPages; index++) {
    pages.value.push(index);
  }
};

const paginate = (recomendedjob) => {
  const from = page.value * perPage.value - perPage.value;
  const to = page.value * perPage.value;
  return recomendedjob.slice(from, to);
};

watch(recomendedjob, () => {
  setPages();
});

onMounted(() => {
  setPages();
});
</script>


<template>
    <BRow>
        <BCol lg="12">
            <BCard no-body>
                <BCardHeader>
                    <BRow class="g-4 align-items-center">
                        <BCol sm="auto">
                            <div>
                                <BCardTitle class="mb-0 flex-grow-1">Recommended Jobs</BCardTitle>
                            </div>
                        </BCol>
                        <BCol sm>
                            <div class="d-flex justify-content-sm-end">
                                <div class="search-box ms-2">
                                    <input type="text" class="form-control" id="searchResultList"
                                        placeholder="Search for jobs..." v-model="searchQuery">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                        </BCol>
                    </BRow>
                </BCardHeader>
                <BCardBody>
                    <div id="recomended-jobs" class="table-card">
                        <div role="complementary" class="gridjs gridjs-container" style="width: 100%;">
                            <div class="gridjs-wrapper" style="height: auto;">
                                <table role="grid" class="gridjs-table" style="height: auto;">
                                    <thead class="gridjs-thead">
                                        <tr class="gridjs-tr">
                                            <th data-column-id="position" class="gridjs-th gridjs-th-sort" tabindex="0">
                                                <div class="gridjs-th-content">Position</div>
                                            </th>
                                            <th data-column-id="companyName" class="gridjs-th gridjs-th-sort"
                                                tabindex="0">
                                                <div class="gridjs-th-content">Company Name</div>
                                            </th>
                                            <th data-column-id="location" class="gridjs-th gridjs-th-sort" tabindex="0">
                                                <div class="gridjs-th-content">Location</div>
                                            </th>
                                            <th data-column-id="salary" class="gridjs-th gridjs-th-sort" tabindex="0">
                                                <div class="gridjs-th-content">Salary</div>
                                            </th>
                                            <th data-column-id="experience" class="gridjs-th gridjs-th-sort"
                                                tabindex="0">
                                                <div class="gridjs-th-content">Experience</div>
                                            </th>
                                            <th data-column-id="jobType" class="gridjs-th gridjs-th-sort" tabindex="0">
                                                <div class="gridjs-th-content">Job Type</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="gridjs-tbody">
                                        <tr class="gridjs-tr" v-for="(data, index) of resultQuery" :key="index">
                                            <td data-column-id="position" class="gridjs-td">{{ data.position }}</td>
                                            <td data-column-id="companyName" class="gridjs-td">{{ data.c_name }}</td>
                                            <td data-column-id="location" class="gridjs-td">{{ data.location }}</td>
                                            <td data-column-id="salary" class="gridjs-td">{{ data.salary }}</td>
                                            <td data-column-id="experience" class="gridjs-td">{{ data.experience }}</td>
                                            <td data-column-id="jobType" class="gridjs-td">{{ data.job_type }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="gridjs-footer">
                                <div class="gridjs-pagination">
                                    <div role="status" aria-live="polite" class="gridjs-summary" title="Page 1 of 3">
                                        Showing <b>{{ page }}</b> to <b>{{ resultQuery.length }}</b> of <b>{{
                                                recomendedjob.length
                                        }}</b> results
                                    </div>
                                    <div class="gridjs-pages">
                                        <BButton variant="link" tabindex="0" role="button" title="Previous" href="#" :disabled="page <= 1" @click="page--">Previous</BButton>

                                        <BButton variant="link" tabindex="0" role="button" class="gridjs"
                                            :class="{ active: pageNumber == page, disabled: pageNumber == '...', }"
                                            v-for="(pageNumber, index) in pages" :key="index"
                                            @click="page = pageNumber">{{ pageNumber }}</BButton>

                                        <BButton variant="link" tabindex="0" role="button" title="Next" :disabled="page >= pages.length" @click="page++">Next</BButton>
                                    </div>
                                </div>
                            </div>
                            <div id="gridjs-temp" class="gridjs-temp"></div>
                        </div>
                    </div>
                </BCardBody>
            </BCard>
        </BCol>
    </BRow>
</template>
