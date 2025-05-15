<script setup>
import { ref, computed, onMounted } from 'vue';
import Layout from '@/layouts/main.vue';
import PageHeader from '@/components/page-header.vue';

// State
const searchQuery = ref(null);
const data = ref([
  { id: 1, name: "Janathan", email: "jonathan@example.com", position: "Senior Implementation Architect", company: "Koelpin - Goldner", country: "Vanuatu" },
  { id: 2, name: "Harold", email: "harold@example.com", position: "Forward Creative Coordinator", company: "Feeney, Langworth and Tremblay", country: "Niger" },
  { id: 3, name: "Shannan", email: "shannon@example.com", position: "Legacy Functionality Associate", company: "Streich Group", country: "Niue" },
  { id: 4, name: "Robert", email: "robert@example.com", position: "Product Accounts Technician", company: "Ebert, Schamberger and Johnston", country: "Mexico" },
  { id: 5, name: "Noel", email: "noel@example.com", position: "Customer Data Director", company: "Raynor, Rolfson and Daugherty", country: "Qatar" },
  { id: 6, name: "Tracl", email: "traci@example.com", position: "Corporate Identity Director", company: "Hauck Inc", country: "Holy See" },
  { id: 7, name: "Kerry", email: "kerry@example.com", position: "Lead Applications Associate", company: "Metz Inc", country: "Iran" },
  { id: 8, name: "Patsy", email: "patsy@example.com", position: "Dynamic Assurance Director", company: "Zemlak Group", country: "South Georgia" },
  { id: 9, name: "Cathy", email: "cathy@example.com", position: "Customer Data Director", company: "Hoeger", country: "San Marino" },
  { id: 10, name: "Tyrone", email: "yrone@example.com", position: "Senior Response Liaison", company: "Howell - Rippin", country: "Germany" },
]);

const page = ref(1);
const perPage = ref(5);
const pages = ref([]);
const direction = ref('asc');

// Computed
const displayedPosts = computed(() => {
  return paginate(data.value);
});

const resultQuery = computed(() => {
  if (searchQuery.value) {
    const search = searchQuery.value.toLowerCase();
    return displayedPosts.value.filter((d) =>
      d.id.toString().includes(search) ||
      d.name.toLowerCase().includes(search) ||
      d.email.toLowerCase().includes(search) ||
      d.position.toLowerCase().includes(search) ||
      d.company.toLowerCase().includes(search) ||
      d.country.toLowerCase().includes(search)
    );
  } else {
    return displayedPosts.value;
  }
});

// Methods
const setPages = () => {
  const numberOfPages = Math.ceil(data.value.length / perPage.value);
  pages.value = [];
  for (let i = 1; i <= numberOfPages; i++) {
    pages.value.push(i);
  }
};

const paginate = (dataArray) => {
  const from = page.value * perPage.value - perPage.value;
  const to = page.value * perPage.value;
  return dataArray.slice(from, to);
};

const onSort = (column) => {
  direction.value = direction.value === 'asc' ? 'desc' : 'asc';
  const sorted = [...data.value].sort((a, b) => {
    const res = a[column] < b[column] ? -1 : a[column] > b[column] ? 1 : 0;
    return direction.value === 'asc' ? res : -res;
  });
  data.value = sorted;
  setPages();
};

// Lifecycle
onMounted(() => {
  setPages();
});
</script>


<template>
  <Layout>
    <PageHeader title="Grid Js" pageTitle="Tables" />
    <BRow>
      <BCard no-body class="card-body">
        <BCardBody>
          <div class="table-responsive table-card">
            <table class="table align-middle table-nowrap" id="customerTable">
              <thead class="table-light text-muted">
                <tr>
                  <th class="sort" data-sort="currency_name" scope="col" @click="onSort('id')">ID</th>
                  <th class="sort" data-sort="current_value" scope="col" @click="onSort('name')">Name</th>
                  <th class="sort" data-sort="pairs" scope="col" @click="onSort('email')">Email</th>
                  <th class="sort" data-sort="high" scope="col" @click="onSort('position')">Position</th>
                  <th class="sort" data-sort="low" scope="col" @click="onSort('company')">Company</th>
                  <th class="sort" data-sort="market_cap" scope="col" @click="onSort('country')">Country</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody class="list form-check-all">
                <tr v-for="(data, index) of resultQuery" :key="index">
                  <td class="id">
                    {{ data.id }}
                  </td>
                  <td>{{ data.name }}</td>
                  <td class="pairs">{{ data.email }}</td>
                  <td class="high">{{ data.position }}</td>
                  <td class="low">{{ data.company }}</td>
                  <td class="market_cap">{{ data.country }}</td>
                  <td>
                    <span>
                      <BLink  href="#" class="text-reset text-decoration-underline">Details</BLink >
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-end mt-3" v-if="resultQuery.length >= 1">
            <div class="pagination-wrap hstack gap-2">
              <BLink  class="page-item pagination-prev" href="#" :disabled="page <= 1" @click="page--">
                Previous
              </BLink >
              <ul class="pagination listjs-pagination mb-0">
                <li :class="{
                  active: pageNumber == page,
                  disabled: pageNumber == '...',
                }" v-for="(pageNumber, index) in pages.slice(page - 1, page + 5)" :key="index"
                  @click="page = pageNumber">
                  <BLink  class="page" href="#">{{ pageNumber }}</BLink >
                </li>
              </ul>
              <BLink  class="page-item pagination-next" href="#" :disabled="page >= pages.length" @click="page++">
                Next
              </BLink >
            </div>
          </div>
        </BCardBody>
      </BCard> 
    </BRow>
  </Layout>
</template>