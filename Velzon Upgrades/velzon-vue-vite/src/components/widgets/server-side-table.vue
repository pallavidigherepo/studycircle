<template>
  <BRow class="w-100 h-100 d-flex flex-row justify-content-center align-items-center">
    <BCol md="10">
      <h3>Client Side</h3>
      <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
    </BCol>
  </BRow>
</template>

<script setup>
import { ref } from 'vue';

const columns = ref(["id", "name", "age"]);
const tableData = ref([
  { id: 1, name: "John", age: "20" },
  { id: 2, name: "Jane", age: "24" },
  { id: 3, name: "Susan", age: "16" },
  { id: 4, name: "Chris", age: "55" },
  { id: 5, name: "Dan", age: "40" },
  { id: 6, name: "Mary", age: "32" },
  { id: 7, name: "Sam", age: "28" },
  { id: 8, name: "Sarah", age: "22" },
  { id: 9, name: "Tom", age: "18" },
  { id: 10, name: "Alice", age: "60" },
]);
</script>

<style>

</style>
