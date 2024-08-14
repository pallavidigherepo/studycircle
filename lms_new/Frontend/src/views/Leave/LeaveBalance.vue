<template>
    <div>
        <h2>Leave Balance</h2>
        <ul>
            <li v-for="balance in leaveBalances" :key="balance.id">
                {{ balance.leaveType.name }}: {{ balance.balance }} days
            </li>
        </ul>
    </div>
</template>

<script setup>
import { computed, onMounted } from 'vue';
import { useStore } from 'vuex';
import axios from 'axios';

const store = useStore();

const leaveBalances = computed(() => store.state.leave.leaveBalances);

onMounted(() => {
    store.dispatch('leave/fetchLeaveBalances');
});

function applyLeave() {
    // const selectedLeaveTypeId = /* your logic to get selected leave type ID */;
    // const from = /* your logic to get start date */;
    // const to = /* your logic to get end date */;
    // const description = /* your logic to get reason */;

    axios.post('/api/v1/leaves', {
        leave_type_id: selectedLeaveTypeId,
        from: from,
        to: to,
        description: description,
    })
    .then(response => {
        console.log('Leave applied successfully:', response.data);
    })
    .catch(error => {
        console.error('Error applying leave:', error.response.data);
    });
}

</script>
