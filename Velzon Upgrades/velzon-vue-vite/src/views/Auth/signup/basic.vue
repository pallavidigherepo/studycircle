<script setup>
import { ref, onMounted } from 'vue'

// Refs for inputs and validation items
const password = ref('')
const confirmPassword = ref('')
const showPassword = ref(false)
const passwordContainVisible = ref(false)

const letterValid = ref(false)
const capitalValid = ref(false)
const numberValid = ref(false)
const lengthValid = ref(false)
const passwordsMatch = ref(true)

// Validate password complexity and matching
function validatePassword() {
  // Check lowercase
  letterValid.value = /[a-z]/.test(password.value)
  // Check uppercase
  capitalValid.value = /[A-Z]/.test(password.value)
  // Check numbers
  numberValid.value = /[0-9]/.test(password.value)
  // Check length >= 8
  lengthValid.value = password.value.length >= 8
  // Check passwords match
  passwordsMatch.value = password.value === confirmPassword.value
}

// Toggle password visibility
function togglePasswordVisibility() {
  showPassword.value = !showPassword.value
}

// Show password requirements box
function onFocus() {
  passwordContainVisible.value = true
}

// Hide password requirements box
function onBlur() {
  passwordContainVisible.value = false
}

// Watch password and confirmPassword changes
// (optional: use watch from 'vue' to trigger validatePassword automatically)
// Here, just call validatePassword manually on input events in template

onMounted(() => {
  // Initialization if needed
})
</script>

<template>
    <div class="auth-page-wrapper pt-5">
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">

                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <div class="auth-page-content">
            <BContainer>
                <BRow>
                    <BCol lg="12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <router-link to="/" class="d-inline-block auth-logo">
                                    <img src="@/assets/images/logo-light.png" alt="" height="20">
                                </router-link>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p>
                        </div>
                    </BCol>
                </BRow>

                <BRow class="justify-content-center">
                    <BCol md="8" lg="6" xl="5">
                        <BCard no-body class="mt-4 card-bg-fill">

                            <BCardBody class="p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Create New Account</h5>
                                    <p class="text-muted">Get your free velzon account now</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form class="needs-validation" novalidate>

                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="useremail"
                                                placeholder="Enter email address" required>
                                            <div class="invalid-feedback">
                                                Please enter email
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="username"
                                                placeholder="Enter username" required>
                                            <div class="invalid-feedback">
                                                Please enter username
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password" class="form-control pe-5 password-input"
                                                    onpaste="return false" placeholder="Enter password" id="password-input"
                                                    aria-describedby="passwordInput"
                                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                                <BButton variant="link"
                                                    class="position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></BButton>
                                                <div class="invalid-feedback">
                                                    Please enter password
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <p class="mb-0 fs-12 text-muted fst-italic">By registering you agree to the
                                                Velzon <BLink href="#"
                                                    class="text-primary text-decoration-underline fst-normal fw-medium">
                                                    Terms
                                                    of Use</BLink>
                                            </p>
                                        </div>
                                        <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                            <h5 class="fs-13">Password must contain:</h5>
                                            <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b>
                                            </p>
                                            <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter
                                                (a-z)</p>
                                            <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b>
                                                letter (A-Z)</p>
                                            <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)
                                            </p>
                                        </div>
                                        <div class="mt-4">
                                            <BButton variant="success" class="w-100" type="button">Sign
                                                Up</BButton>
                                        </div>

                                        <div class="mt-4 text-center">
                                            <div class="signin-other-title">
                                                <h5 class="fs-13 mb-4 title text-muted">Create account with</h5>
                                            </div>

                                            <div>
                                                <BButton type="button" variant="primary" class="btn-icon"><i
                                                        class="ri-facebook-fill fs-16"></i></BButton>
                                                <BButton type="button" variant="danger" class="btn-icon ms-1"><i
                                                        class="ri-google-fill fs-16"></i></BButton>
                                                <BButton type="button" variant="dark" class="btn-icon ms-1"><i
                                                        class="ri-github-fill fs-16"></i></BButton>
                                                <BButton type="button" variant="info" class="btn-icon ms-1"><i
                                                        class="ri-twitter-fill fs-16"></i></BButton>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </BCardBody>
                        </BCard>

                        <div class="mt-4 text-center">
                            <p class="mb-0">Already have an account ? <router-link to="/auth/signin-basic"
                                    class="fw-semibold text-primary text-decoration-underline"> Signin </router-link>
                            </p>
                        </div>
                    </BCol>
                </BRow>
            </BContainer>
        </div>

        <footer class="footer">
            <BContainer>
                <BRow>
                    <BCol lg="12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy; {{ new Date().getFullYear() }} Velzon. Crafted with <i
                                    class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                        </div>
                    </BCol>
                </BRow>
            </BContainer>
        </footer>
    </div>
</template>