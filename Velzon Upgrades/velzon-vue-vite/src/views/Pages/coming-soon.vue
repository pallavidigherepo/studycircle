<script setup>
import { onMounted } from "vue";

onMounted(() => {
  // Set the date we're counting down to
  const countDownDate = new Date("Jan 1, 2024").getTime();

  // Update the count down every 1 second
  const countDown = setInterval(() => {
    // Get today's date and time
    const currentTime = new Date().getTime();

    // Find the distance between currentTime and the count down date
    const distance = countDownDate - currentTime;

    // Time calculations for days, hours, minutes and seconds
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    const countDownBlock =
      `<div class="countdownlist-item">
        <div class="count-title">Days</div>
        <div class="count-num">${days}</div>
      </div>
      <div class="countdownlist-item">
        <div class="count-title">Hours</div>
        <div class="count-num">${hours}</div>
      </div>
      <div class="countdownlist-item">
        <div class="count-title">Minutes</div>
        <div class="count-num">${minutes}</div>
      </div>
      <div class="countdownlist-item">
        <div class="count-title">Seconds</div>
        <div class="count-num">${seconds}</div>
      </div>`;

    const countdownElement = document.getElementById("countdown");

    if (countdownElement) {
      if (distance < 0) {
        clearInterval(countDown);
        countdownElement.innerHTML = `<div class="countdown-endtxt">The countdown has ended!</div>`;
      } else {
        countdownElement.innerHTML = countDownBlock;
      }
    }
  }, 1000);
});
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
            <div class="text-center mt-sm-5 pt-4 mb-4">
              <div class="mb-sm-5 pb-sm-4 pb-5">
                <img src="@/assets/images/comingsoon.png" alt="" height="120" class="move-animation" />
              </div>
              <div class="mb-5">
                <h1 class="display-2 coming-soon-text">Coming Soon</h1>
              </div>
              <div>
                <BRow class="justify-content-center mt-5">
                  <BCol lg="8">
                    <div id="countdown" class="countdownlist"></div>
                  </BCol>
                </BRow>

                <div class="mt-5">
                  <h4>Get notified when we launch</h4>
                  <p class="text-muted">Don't worry we will not spam you 😊</p>
                </div>

                <div class="input-group countdown-input-group mx-auto my-4">
                  <input type="email" class="form-control border-light shadow" placeholder="Enter your email address"
                    aria-label="search result" aria-describedby="button-email" />
                  <BButton variant="success" type="button" id="button-email">
                    Send<i class="ri-send-plane-2-fill align-bottom ms-2"></i>
                  </BButton>
                </div>
              </div>
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
              <p class="mb-0 text-muted">
                &copy; {{ new Date().getFullYear() }} Velzon. Crafted with
                <i class="mdi mdi-heart text-danger"></i> by Themesbrand
              </p>
            </div>
          </BCol>
        </BRow>
      </BContainer>
    </footer>
  </div>
</template>
