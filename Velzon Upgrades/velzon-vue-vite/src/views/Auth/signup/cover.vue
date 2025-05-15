<script setup>
import { ref, reactive, watch } from 'vue';
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay, Navigation, Pagination } from "swiper/modules";

import "swiper/css";
import "swiper/css/autoplay";
import "swiper/css/navigation";
import "swiper/css/pagination";

const password = ref('');
const confirmPassword = ref('');
const showPassword = ref(false);
const showPasswordRequirements = ref(false);

const validation = reactive({
  hasLower: false,
  hasUpper: false,
  hasNumber: false,
  validLength: false,
  passwordsMatch: true,
});

const toggleShowPassword = () => {
  showPassword.value = !showPassword.value;
};

const validatePassword = (value) => {
  validation.hasLower = /[a-z]/.test(value);
  validation.hasUpper = /[A-Z]/.test(value);
  validation.hasNumber = /[0-9]/.test(value);
  validation.validLength = value.length >= 8;
};

const onPasswordFocus = () => {
  showPasswordRequirements.value = true;
};

const onPasswordBlur = () => {
  showPasswordRequirements.value = false;
};

watch(password, (newVal) => {
  validatePassword(newVal);
  validation.passwordsMatch = newVal === confirmPassword.value;
});

watch(confirmPassword, (newVal) => {
  validation.passwordsMatch = newVal === password.value;
});

const pagination = {
  clickable: true,
  el: '.swiper-pagination',
  renderBullet(index, className) {
    return `<span class="${className}">${index + 1}</span>`;
  },
};

</script>

<template>
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <BContainer>
                <BRow>
                    <BCol lg="12">
                        <BCard no-body class="overflow-hidden m-0">
                            <BRow class="justify-content-center g-0">
                                <BCol lg="6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <router-link to="/" class="d-block">
                                                    <img src="@/assets/images/logo-light.png" alt="" height="18">
                                                </router-link>
                                            </div>
                                            <div class="mt-auto">
                                                <div class="mb-3">
                                                    <i class="ri-double-quotes-l display-4 text-success"></i>
                                                </div>

                                                <div id="qoutescarouselIndicators" class="carousel slide"
                                                    data-bs-ride="carousel">
                                                    <Swiper class=" text-center text-white-50 pb-5"
                                                        :autoplay="{ delay: 3000, disableOnInteraction: false }"
                                                        :loop="true" :modules="[Autoplay, Navigation, Pagination]"
                                                        :pagination="{ clickable: true, el: '.swiper-pagination' }">
                                                        <swiper-slide>
                                                            <div class="active">
                                                                <p class="fs-15 fst-italic">" Great! Clean code, clean
                                                                    design, easy for customization. Thanks very much! "</p>
                                                            </div>
                                                        </swiper-slide>
                                                        <swiper-slide>
                                                            <div>
                                                                <p class="fs-15 fst-italic">" The theme is really great with
                                                                    an amazing customer support."</p>
                                                            </div>
                                                        </swiper-slide>
                                                        <swiper-slide>
                                                            <div>
                                                                <p class="fs-15 fst-italic">" Great! Clean code, clean
                                                                    design, easy for customization. Thanks very much! "</p>
                                                            </div>
                                                        </swiper-slide>
                                                        <div class="swiper-pagination"></div>
                                                    </Swiper>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </BCol>

                                <BCol lg="6">
                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h5 class="text-primary">Register Account</h5>
                                            <p class="text-muted">Get your Free Velzon account now.</p>
                                        </div>

                                        <div class="mt-4">
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
                                                            onpaste="return false" placeholder="Enter password"
                                                            id="password-input" aria-describedby="passwordInput"
                                                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                                        <BButton variant="link"
                                                            class="position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                            type="button" id="password-addon"><i
                                                                class="ri-eye-fill align-middle"></i></BButton>
                                                        <div class="invalid-feedback">
                                                            Please enter password
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <p class="mb-0 fs-12 text-muted fst-italic">By registering you agree
                                                        to the Velzon <BLink href="#"
                                                            class="text-primary text-decoration-underline fst-normal fw-medium">
                                                            Terms
                                                            of Use</BLink>
                                                    </p>
                                                </div>
                                                <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                                    <h5 class="fs-13">Password must contain:</h5>
                                                    <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8
                                                            characters</b>
                                                    </p>
                                                    <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b>
                                                        letter
                                                        (a-z)</p>
                                                    <p id="pass-upper" class="invalid fs-12 mb-2">At least
                                                        <b>uppercase</b>
                                                        letter (A-Z)
                                                    </p>
                                                    <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b>
                                                        (0-9)
                                                    </p>
                                                </div>
                                                <div class="mt-4">
                                                    <BButton variant="success" class="w-100" type="button">Sign Up
                                                    </BButton>
                                                </div>

                                                <div class="mt-4 text-center">
                                                    <div class="signin-other-title">
                                                        <h5 class="fs-13 mb-4 title text-muted">Create account with</h5>
                                                    </div>

                                                    <div>
                                                        <BButton type="button" variant="primary" class="btn-icon"><i
                                                                class="ri-facebook-fill fs-16"></i></BButton>
                                                        <BButton type="button" variant="danger" class="btn-icon ms-1">
                                                            <i class="ri-google-fill fs-16"></i>
                                                        </BButton>
                                                        <BButton type="button" variant="dark" class="btn-icon ms-1"><i
                                                                class="ri-github-fill fs-16"></i></BButton>
                                                        <BButton type="button" variant="info" class="btn-icon ms-1"><i
                                                                class="ri-twitter-fill fs-16"></i></BButton>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="mt-5 text-center">
                                            <p class="mb-0">Already have an account ? <router-link to="/auth/signin-cover"
                                                    class="fw-semibold text-primary text-decoration-underline"> Signin
                                                </router-link>
                                            </p>
                                        </div>
                                    </div>
                                </BCol>
                            </BRow>
                        </BCard>
                    </BCol>

                </BRow>
            </BContainer>
        </div>

        <footer class="footer">
            <BContainer>
                <BRow>
                    <BCol lg="12">
                        <div class="text-center">
                            <p class="mb-0">&copy; {{ new Date().getFullYear() }} Velzon. Crafted with <i
                                    class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                        </div>
                    </BCol>
                </BRow>
            </BContainer>
        </footer>
    </div>
</template>