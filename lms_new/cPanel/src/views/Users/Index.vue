<script setup lang="ts">
import UserTable from "@/custom_components/DataTable/UserTable.vue";

function handleView(row: any) {
  alert(`Viewing: ${JSON.stringify(row)}`)
}

function handleEdit(row: any) {
  alert(`Editing: ${JSON.stringify(row)}`)
}

function handleDelete(row: any) {
  if (confirm(`Are you sure you want to delete user ${row.name}?`)) {
    // call API to delete
    alert(`Deleted user: ${row.id}`)
  }
}
</script>

<template>
  <div class="grid grid-cols-12 gap-y-10 gap-x-6">
    <div class="col-span-12">
      <UserTable
        apiUrl="http://127.0.0.1:8000/api/v1/users"
        :columns="[
          { key: 'id', label: 'ID' },
          { key: 'name', label: 'Name' },
          { key: 'email', label: 'Email' },
          { key: 'role', label: 'Role' },
          { key: 'status', label: 'Status' },
        ]"
        :filters="[
          { key: 'role', label: 'Role', options: ['admin', 'user', 'guest'] },
          { key: 'status', label: 'Status', options: ['active', 'inactive'] },
        ]"
        @view="handleView"
        @edit="handleEdit"
        @delete="handleDelete"
      ></UserTable>
    </div>
  </div>
</template>
