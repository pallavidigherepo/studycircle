<template>
  <!-- Contact Start -->
  <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
      <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
        <h5 class="fw-bold text-primary text-uppercase">Contact Us</h5>
        <h1 class="mb-0">If You Have Any Query, Feel Free To Contact Us</h1>
      </div>
      <div class="row g-5 mb-5">
        <div class="col-lg-4">
          <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.1s">
            <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
              <i class="fa fa-phone-alt text-white"></i>
            </div>
            <div class="ps-4">
              <h5 class="mb-2">Call to ask any question</h5>
              <h4 class="text-primary mb-0"><a href="tel:+91 762 009 8848">+91 762 009 8848</a></h4>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.4s">
            <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
              <i class="fa fa-envelope-open text-white"></i>
            </div>
            <div class="ps-4">
              <h5 class="mb-2">Email to get free quote</h5>
              <h4 class="text-primary mb-0">info@meritest.in</h4>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.8s">
            <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
              <i class="fa fa-map-marker-alt text-white"></i>
            </div>
            <div class="ps-4">
              <h5 class="mb-2">Visit our office</h5>
              <h4 class="text-primary mb-0">Wathoda Layout, Nagpur, INDIA</h4>
            </div>
          </div>
        </div>
      </div>
      <div class="row g-5">
        <div class="col-lg-6 wow slideInUp" data-wow-delay="0.3s">
          <form class="contact-form-wrapper" data-toggle="validator" @submit.prevent="submitForm">
            <div class="row g-3">
              <div class="col-md-6">
                <input type="text"
                       class="form-control bg-light px-4"
                       placeholder="Your Name"
                       style="height: 55px;"
                       data-error="Your name is required"
                       v-model.trim="data.name"
                       tabindex="0"
                       :class="{ 'has-errors': submitted && v$.name.$error }"
                >
                <span v-if="submitted && v$.name.$error" class="help-block with-errors">
                  {{ v$.name.$errors[0].$message }}
                </span>
              </div>
              <div class="col-md-6">
                <input
                    type="email"
                    class="form-control bg-light px-4"
                    placeholder="Your Email"
                    style="height: 55px;"
                    v-model.trim="data.email"
                    :class="{ 'has-errors': submitted && v$.email.$error }"
                >
                <span v-if="submitted && v$.email.$error" class="help-block with-errors">
                  {{ v$.email.$errors[0].$message }}
                </span>
              </div>
              <div class="col-md-6">
                <input
                    type="number"
                    class="form-control bg-light px-4"
                    placeholder="Your Mobile number"
                    style="height: 55px;"
                    v-model.trim="data.mobile_no"
                    :class="{ 'has-errors': submitted && v$.mobile_no.$error }"
                >
                <span v-if="submitted && v$.mobile_no.$error" class="help-block with-errors">
                  {{ v$.mobile_no.$errors[0].$message }}
                </span>
              </div>
              <div class="col-md-6">
                <textarea id="address"
                          class="form-control bg-light px-4"
                          rows="2"
                          data-minlength="4"
                          placeholder="Your address"
                          v-model.trim="data.address"
                          style="height: 55px;"
                          :class="{ 'has-errors': submitted && v$.address.$error }"
                          tabindex="3"></textarea>
                <span v-if="submitted && v$.address.$error" class="help-block with-errors">
                  {{ v$.address.$errors[0].$message }}
                </span>
              </div>
              <div class="col-12">
                <select id="heard-from-me"
                        class="form-control select2 bg-light px-4"
                        :class="{ 'has-errors': submitted && v$.heard_from.$error }"
                        v-model="data.heard_from"
                        tabindex="4">

                  <option value="">Select from where you heard about us</option>
                  <option v-for="(heardFromOption, index) in heardFromOptions"
                          :key="index" :value="index">
                    {{ heardFromOption }}
                  </option>
                </select>
                <span v-if="submitted && v$.heard_from.$error" class="help-block with-errors">
                  {{ v$.heard_from.$errors[0].$message }}
                </span>
              </div>
              <div class="col-12">
                <input type="text"
                       class="form-control bg-light px-4"
                       placeholder="Subject"
                       style="height: 55px;"
                       v-model.trim="data.subject"
                       :class="{ 'has-errors': submitted && v$.subject.$error }"
                >
                <span v-if="submitted && v$.subject.$error" class="help-block with-errors">
                  {{ v$.subject.$errors[0].$message }}
                </span>
              </div>
              <div class="col-12">
                <textarea class="form-control bg-light px-4 py-3"
                          rows="4"
                          data-minlength="50"
                          placeholder="Message"
                          v-model.trim="data.message"
                          :class="{ 'has-errors': submitted && v$.message.$error }"
                ></textarea>
                <span v-if="submitted && v$.message.$error" class="help-block with-errors">
                  {{ v$.message.$errors[0].$message }}
                </span>
              </div>
              <div class="col-12">
                <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s">
          <iframe class="position-relative rounded w-100 h-100"
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3721.5190421435436!2d79.13633541493434!3d21.131732685942712!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bd4c7508f5ba96f%3A0xe4d60de7608672a2!2sMeritest%20Solutions%20Private%20Limited!5e0!3m2!1sen!2sin!4v1682015508609!5m2!1sen!2sin"
                  width="350"
                  height="350"
                  style="min-height: 350px; border:0;"
                  allowfullscreen=""
                  loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>
  <!-- Contact End -->
</template>

<script setup>
import { onBeforeRouteLeave } from 'vue-router';
import { ref, reactive, computed } from 'vue';
import useVuelidate from '@vuelidate/core';
import { required,
  email,
  maxLength,
  minLength,
  numeric,
  helpers
} from '@vuelidate/validators';
import axios from "axios";
import { load } from 'recaptcha-v3';
import { useRouter } from 'vue-router'
const submitted = ref(false);
const loading = ref(false);
const router = useRouter();
var showMessage = '';

const heardFromOptions = {
  google: 'Google',
  facebook: 'Facebook',
  twitter: 'Twitter',
  sms: 'Mobile SMS',
  executive: 'Marketing Executive',
  friends: 'Friends',
  mobile: 'Mobile Application',
};
const data = reactive({
  name: '',
  email: '',
  mobile_no: null,
  address: '',
  heard_from: '',
  subject: '',
  message: '',
  recaptcha_token: '',
});
const rules = computed(() => {
  return {
    name: {
      required: helpers.withMessage('Please enter your name.', required),
    },
    email: {
      required: helpers.withMessage('Please enter your email address.', required),
      email: helpers.withMessage('Please enter valid email address.', email),
    },
    mobile_no: {
      required: helpers.withMessage('Please enter your mobile number.', required),
      numeric,
      maxLength: maxLength(10),
      minLength: minLength(8)
    },
    address: {
      required: helpers.withMessage('Please enter your address.', required),
    },
    heard_from: {
      required: helpers.withMessage('Please select from where you heard about us.', required),
    },
    subject: {
      required: helpers.withMessage('Please enter subject.', required),
    },
    message: {
      required: helpers.withMessage('Please enter your message.', required),
    },
  }
});

const v$ = useVuelidate(rules, data);

asyncFunction();

async function asyncFunction() {
  const recaptcha = await load('6LfL6wAVAAAAAFvQtjwR1gpXwz-u3D25KPpTNN3Q');
  const token = await recaptcha.execute('/api/contactus');

  data.recaptcha_token = token;
  var thingToShow = document.querySelectorAll(".grecaptcha-badge")[0];
  thingToShow.parentNode.classList.remove("hidden");
}

function submitForm() {
  submitted.value = true;

  v$.value.$validate(); // checks all inputs

  if (!v$.value.$error) {
    loading.value = true;
    saveContact();

  } else {
    // if ANY fail validation
    return ;
  }
}


async function saveContact()
{
  await axios.post('/api/contactus', data)
      .then(response => {
        showMessage = response.data.message;
      })
      .catch(e => {
        showMessage = e.message;
      });
  loading.value = false;
  submitted.value = false;
  alert(showMessage);
  //router.push('/contact-us');
  clearForm();
  router.push({
    name: 'ContactUs',
  })
  //location.reload();
}

function clearForm()
{
  data.name = '';
  data.email = '';
  data.mobile_no = null;
  data.address = '';
  data.heard_from = '';
  data.subject = '';
  data.message = '';
}
// same as beforeRouteLeave option with no access to `this`
onBeforeRouteLeave((to, from) => {
  var thingToHide = document.querySelectorAll(".grecaptcha-badge")[0];
  thingToHide.parentNode.classList.add("hidden");
});

</script>

<style scoped>

</style>