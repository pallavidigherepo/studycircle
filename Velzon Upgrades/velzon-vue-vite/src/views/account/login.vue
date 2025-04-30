<template>
    <div class="auth-page-wrapper pt-5">
      <!-- Your existing UI layout remains unchanged -->
      <form @submit.prevent="tryToLogIn">
        <!-- email input -->
        <input v-model="email" type="email" placeholder="Email" class="form-control" />
        <span v-if="v$.email.$error">{{ v$.email.$errors[0]?.$message }}</span>
  
        <!-- password input -->
        <input v-model="password" type="password" placeholder="Password" class="form-control" />
        <span v-if="v$.password.$error">{{ v$.password.$errors[0]?.$message }}</span>
  
        <button type="submit" class="btn btn-success w-100" :disabled="processing">
          {{ processing ? 'Please wait...' : 'Sign In' }}
        </button>
  
        <div v-if="authError" class="alert alert-danger mt-3">{{ authError }}</div>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import { useRouter } from 'vue-router'
  import axios from 'axios'
  import useVuelidate from '@vuelidate/core'
  import { required, email as emailRule, helpers } from '@vuelidate/validators'
  
  // Refs
  const email = ref('admin@themesbrand.com')
  const password = ref('123456')
  const authError = ref(null)
  const processing = ref(false)
  
  const router = useRouter()
  
  // Vuelidate rules
  const rules = {
    email: {
      required: helpers.withMessage('Email is required', required),
      email: helpers.withMessage('Please enter a valid email', emailRule),
    },
    password: {
      required: helpers.withMessage('Password is required', required),
    },
  }
  
  const v$ = useVuelidate(rules, { email, password })
  
  // Login method
  const tryToLogIn = async () => {
    await v$.value.$validate()
  
    if (v$.value.$invalid) return
  
    processing.value = true
    try {
      const response = await axios.post('https://api-node.themesbrand.website/auth/signin', {
        email: email.value,
        password: password.value,
      })
  
      if (response.data.status === 'errors') {
        authError.value = response.data.data
      } else {
        localStorage.setItem('jwt', response.data.token)
        router.push('/')
      }
    } catch (error) {
      authError.value = 'Login failed. Please try again.'
    } finally {
      processing.value = false
    }
  }
  </script>
  