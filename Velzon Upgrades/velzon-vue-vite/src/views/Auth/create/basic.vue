<script setup>
import { onMounted } from 'vue'

function validatePassword() {
  const password = document.getElementById("password-input")
  const confirm_password = document.getElementById("confirm-password-input")

  if (password.value !== confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match")
  } else {
    confirm_password.setCustomValidity("")
  }
}

onMounted(() => {
  const password = document.getElementById("password-input")
  const confirm_password = document.getElementById("confirm-password-input")

  password.onchange = validatePassword
  confirm_password.onkeyup = validatePassword

  document.querySelectorAll("form .auth-pass-inputgroup").forEach((item) => {
    item.querySelectorAll(".password-addon").forEach((subitem) => {
      subitem.addEventListener("click", () => {
        const passwordInput = item.querySelector(".password-input")
        if (passwordInput.type === "password") {
          passwordInput.type = "text"
        } else {
          passwordInput.type = "password"
        }
      })
    })
  })

  const myInput = document.getElementById("password-input")
  const letter = document.getElementById("pass-lower")
  const capital = document.getElementById("pass-upper")
  const number = document.getElementById("pass-number")
  const length = document.getElementById("pass-length")

  myInput.onfocus = () => {
    document.getElementById("password-contain").style.display = "block"
  }

  myInput.onblur = () => {
    document.getElementById("password-contain").style.display = "none"
  }

  myInput.onkeyup = () => {
    const lowerCaseLetters = /[a-z]/g
    if (myInput.value.match(lowerCaseLetters)) {
      letter.classList.remove("invalid")
      letter.classList.add("valid")
    } else {
      letter.classList.remove("valid")
      letter.classList.add("invalid")
    }

    const upperCaseLetters = /[A-Z]/g
    if (myInput.value.match(upperCaseLetters)) {
      capital.classList.remove("invalid")
      capital.classList.add("valid")
    } else {
      capital.classList.remove("valid")
      capital.classList.add("invalid")
    }

    const numbers = /[0-9]/g
    if (myInput.value.match(numbers)) {
      number.classList.remove("invalid")
      number.classList.add("valid")
    } else {
      number.classList.remove("valid")
      number.classList.add("invalid")
    }

    if (myInput.value.length >= 8) {
      length.classList.remove("invalid")
      length.classList.add("valid")
    } else {
      length.classList.remove("valid")
      length.classList.add("invalid")
    }
  }
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
                        <BCard no-body class="mt-4">

                            <BCardBody class="p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Create new password</h5>
                                    <p class="text-muted">Your new password must be different from previous used
                                        password.</p>
                                </div>

                                <div class="p-2">
                                    <form>
                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password" class="form-control pe-5 password-input"
                                                    onpaste="return false" placeholder="Enter password" id="password-input"
                                                    aria-describedby="passwordInput"
                                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                                <BButton variant="link"
                                                    class="position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i>
                                                </BButton>
                                            </div>
                                            <div id="passwordInput" class="form-text">Must be at least 8 characters.
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="confirm-password-input">Confirm
                                                Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input"
                                                    onpaste="return false" placeholder="Confirm password"
                                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                    id="confirm-password-input" required>
                                                <BButton variant="link"
                                                    class="position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="confirm-password-input"><i
                                                        class="ri-eye-fill align-middle"></i>
                                                </BButton>
                                            </div>
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

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember
                                                me</label>
                                        </div>

                                        <div class="mt-4">
                                            <BButton variant="success" class="w-100" @click="validatepassword"
                                                type="submit">Reset Password</BButton>
                                        </div>

                                    </form>
                                </div>
                            </BCardBody>
                        </BCard>

                        <div class="mt-4 text-center">
                            <p class="mb-0">Wait, I remember my password... <router-link to="/auth/signin-basic"
                                    class="fw-semibold text-primary text-decoration-underline"> Click
                                    here </router-link>
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