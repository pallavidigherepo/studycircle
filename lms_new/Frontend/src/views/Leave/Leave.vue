<template>
  <div>
      <h2>Apply for Leave</h2>
      <form @submit.prevent="handleSubmit" ref="leaveForm">
          <div>
              <label for="leaveType">Leave Type</label>
              <select v-model="leave_type_id" id="leaveType" required>
                  <option v-for="type in leaveTypes" :key="type.id" :value="type.id">{{ type.name }}</option>
              </select>
          </div>
          <div>
                <label for="from">From</label>
                <input type="date" v-model="from" id="from" required />
            </div>
            <div>
                <label for="to">To</label>
                <input type="date" v-model="to" id="to" required />
            </div>
            <div>
                <label for="description">Description</label>
                <textarea v-model="description" id="description" required></textarea>
            </div>
          <button type="submit" :disabled="isSubmitting">
              <span v-if="isSubmitting"></span>
              <span v-else>Submit</span>
          </button>
          <p v-if="submitError" class="error-message">{{ submitError }}</p>
          <p v-if="submitSuccess" class="success-message">{{ submitSuccess }}</p>
      </form>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { useStore } from 'vuex';

const leave_type_id = ref('');
const from = ref('');
const to = ref('');
const description = ref('');
const isSubmitting = ref(false);
const submitSuccess = ref('');
const submitError = ref('');

const store = useStore();

const leaveTypes = computed(() => store.state.leave.leaveTypes);

const handleSubmit = () => {
  if (!validateForm()) {
      return;
  }

  isSubmitting.value = true;
  const payload = {
      leave_type_id: leave_type_id.value,
      from: from.value,
      to: to.value,
      description: description.value,
  };

  store.dispatch('leave/applyLeave', payload)
      .then(() => {
          submitSuccess.value = 'Leave applied successfully!';
          resetForm();
      })
      .catch((error) => {
          submitError.value = 'Failed to apply for leave.';
          console.error(error);
      })
      .finally(() => {
          isSubmitting.value = false;
      });
};

const validateForm = () => {
  if (!leave_type_id.value || !from.value || !to.value || !description.value) {
      submitError.value = 'Please fill out all fields.';
      return false;
  }
  return true;
};

const resetForm = () => {
  leave_type_id.value = '';
  from.value = '';
  to.value = '';
  description.value = '';
  submitError.value = '';
};

onMounted(() => {
  store.dispatch('leave/fetchLeaveTypes');
});
</script>


// <script>
// import { mapActions, mapState } from 'vuex';

// export default {
//     data() {
//         return {
//             leave_type_id: '',
//             from: '',
//             to: '',
//            description: '',
//         };
//     },
//     computed: {
//         ...mapState('leave', ['leaveTypes']),
//     },
//     methods: {
//         ...mapActions('leave', ['applyLeave']),
//     },
//     mounted() {
//         this.$store.dispatch('leave/fetchLeaveTypes');
//     },
// };
// </script>
