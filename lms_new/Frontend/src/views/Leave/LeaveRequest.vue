<template>
    <div>
        <h2>Leave Requests</h2>
        <ul>
            <li v-for="request in leaveRequests" :key="request.id">
                {{ request.user.name }} - {{ request.leave_type_id.name }} ({{ request.from }} to {{ request.to }}) - {{ request.leave_statuses_id.name }}
                <button @click="approveLeave(request.id)" v-if="request.status.name === 'Pending'">Approve</button>
                <button @click="rejectLeave(request.id)" v-if="request.status.name === 'Pending'">Reject</button>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { computed, onMounted } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

const leaveRequests = computed(() => store.state.leave.leaveRequests);

const approveLeave = (id) => {
    store.dispatch('leave/approveLeave', id)
        .then(() => {
            console.log('Leave approved successfully');
        })
        .catch((error) => {
            console.error('Error approving leave:', error.response.data);
        });
};

const rejectLeave = (id) => {
    store.dispatch('leave/rejectLeave', id)
        .then(() => {
            console.log('Leave rejected successfully');
        })
        .catch((error) => {
            console.error('Error rejecting leave:', error.response.data);
        });
};

onMounted(() => {
    store.dispatch('leave/fetchLeaveRequests')
        .then(() => {
            console.log('Leave requests fetched successfully');
        })
        .catch((error) => {
            console.error('Error fetching leave requests:', error.response.data);
        });
});
</script>
