<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Layout from '@/layouts/main.vue';
import PageHeader from '@/components/page-header.vue';
import { useRoute } from 'vue-router';
const route = useRoute();

// Reactive state
const amount = ref(875);
const billing_address = ref("305 S San Gabriel Blvd, California, United States - 91776");
const billing_name = ref("David Nichols");
const billing_phone = ref("+(123) 456-7890");
const billing_taxno = ref("12-3456789");
const card_holder_name = ref("David Nichols");
const card_number = ref("xxx xxxx xxxx 1234");
const company_address = ref("403 H Fan Faranh Blvd, London, United States");
const contact = ref(8987894122);
const country = ref("Brazil");
const date = ref("2021-04-06T16:28:00.000Z");
const discount = ref("53.99");
const email = ref("velzon@themesbrand.com");
const estimated_tax = ref("44.99");
const img = ref("assets/images/users/avatar-2.jpg");
const invoiceId = ref("#VL25000351");
const name = ref("Diana Kohler");
const notes = ref("All accounts are to be paid within 7 days from receipt of invoice...");
const payment_method = ref("Mastercard");
const postalcode = ref(91798);
const product_detail = ref([
  {
    name: 'Urban Ladder Pashe Chair',
    category: 'Furniture',
    price: '160',
    stock: '2'
  },
  {
    name: '350 ml Glass Grocery Container',
    category: 'Kitchen Storage & Containers',
    price: '39.96',
    stock: '1'
  }
]);
const registration_no = ref("6561");
const shipping_address = ref("345 Elm Ave, Solvang California, United States - 91776");
const shipping_charge = ref("65.00");
const shipping_name = ref("Donald Palmer");
const shipping_phone = ref("+(234) 987-01234");
const shipping_taxno = ref("12-3456789");
const status = ref("Paid");
const sub_total = ref(359.96);
const total_amount = ref(415.96);
const website = ref("www.themesbrand.com");

// Fetch data on component mount
onMounted(() => {
  if (route.params.id) {
    axios.get(`https://api-node.themesbrand.website/apps/invoice/${route.params.id}`)
      .then((response) => {
        const data = response.data.data;
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const dd = new Date(data.date);
        data.date = `${dd.getDate()} ${monthNames[dd.getMonth()]}, ${dd.getFullYear()}`;
        let hours = dd.getHours();
        let minutes = dd.getMinutes();
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // hour '0' should be '12'
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        const strTime = `${hours}:${minutes} ${ampm}`;
        data.time = strTime;

        company_address.value = data.company_address;
        postalcode.value = data.postalcode;
        registration_no.value = data.registration_no;
        email.value = data.email;
        website.value = data.website;
        contact.value = data.contact;
        invoiceId.value = data.invoiceId;
        product_detail.value = data.product_detail;
        date.value = data.date;
        status.value = data.status;
        total_amount.value = data.total_amount;

        billing_name.value = data.billing_name;
        billing_address.value = data.billing_address;
        billing_phone.value = data.billing_phone;
        billing_taxno.value = data.billing_taxno;

        shipping_name.value = data.shipping_name;
        shipping_address.value = data.shipping_address;
        shipping_phone.value = data.shipping_phone;
        shipping_taxno.value = data.shipping_taxno;

        payment_method.value = data.payment_method;
        card_holder_name.value = data.card_holder_name;
        card_number.value = data.card_number;
        notes.value = data.notes;

        const itemclass = data.status === 'Paid' ? 'bg-success-subtle text-success' : data.status === 'Cancel' ? 
                          'bg-danger-subtle text-danger' : data.status === 'Unpaid' ? 'bg-warning-subtle text-warning' : 
                          data.status === 'Refund' ? 'bg-primary-subtle text-primary' : '';
        document.getElementById('payment-status').classList.add(itemclass);
      })
      .catch((error) => {
        console.error(error);
      });
  }
});
</script>


<template>
    <Layout>
        <PageHeader title="Invoice Details" pageTitle="Invoice" />
        <BRow class="justify-content-center">
            <BCol xxl="9">
                <BCard no-body id="demo">
                    <BCardHeader class="border-bottom-dashed p-4">
                        <div class="d-sm-flex">
                            <div class="flex-grow-1">
                                <img src="@/assets/images/logo-dark.png" class="card-logo card-logo-dark"
                                    alt="logo dark" height="17">
                                <img src="@/assets/images/logo-light.png" class="card-logo card-logo-light"
                                    alt="logo light" height="17">
                                <div class="mt-sm-5 mt-4">
                                    <h6 class="text-muted text-uppercase fw-semibold">Address</h6>
                                    <p class="text-muted mb-1" id="address-details">California, United States</p>
                                    <p class="text-muted mb-0" id="zip-code"><span>Zip-code:</span> 90201</p>
                                </div>
                            </div>
                            <div class="flex-shrink-0 mt-sm-0 mt-3">
                                <h6><span class="text-muted fw-normal">Legal
                                        Registration No: </span>
                                    <span id="legal-register-no">{{ registration_no }}</span>
                                </h6>
                                <h6><span class="text-muted fw-normal">Email: </span>
                                    <span id="email">{{ email }}</span>
                                </h6>
                                <h6><span class="text-muted fw-normal">Website:</span>
                                    <BLink href="https://themesbrand.com/" class="link-primary" target="_blank"
                                        id="website">{{ website }}</BLink>
                                </h6>
                                <h6 class="mb-0"><span class="text-muted fw-normal">Contact No: </span><span
                                        id="contact-no">{{ contact }}</span></h6>
                            </div>
                        </div>
                    </BCardHeader>
                    <BCardBody class="p-4">
                        <BRow class="g-3">
                            <BCol lg="3" cols="6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Invoice No</p>
                                <h5 class="fs-14 mb-0"><span id="invoice-no">{{ invoiceId }}</span></h5>
                            </BCol>
                            <BCol lg="3" cols="6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                <h5 class="fs-14 mb-0"><span id="invoice-date">{{ date }}</span> <small
                                        class="text-muted" id="invoice-time">02:36PM</small></h5>
                            </BCol>
                            <BCol lg="3" cols="6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Payment Status</p>
                                <span class="badge bg-success-subtle text-success fs-11" id="payment-status">{{ status }}</span>
                            </BCol>
                            <BCol lg="3" cols="6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Total Amount</p>
                                <h5 class="fs-14 mb-0">$<span id="total-amount">{{ total_amount }}</span></h5>
                            </BCol>
                        </BRow>
                    </BCardBody>
                    <BCardBody class="p-4 border-top border-top-dashed">
                        <BRow class="g-3">
                            <BCol sm="6">
                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Billing Address</h6>
                                <p class="fw-medium mb-2" id="billing-name">{{ billing_name }}</p>
                                <p class="text-muted mb-1" id="billing-address">{{ billing_address }}</p>
                                <p class="text-muted mb-1" id="billing-phone">Phone: {{ billing_phone }}</p>
                                <p class="text-muted mb-0" id="billing-tax">Tax: {{ billing_taxno }}</p>
                            </BCol>
                            <BCol sm="6">
                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Shipping Address</h6>
                                <p class="fw-medium mb-2" id="shipping-name">{{ shipping_name }}</p>
                                <p class="text-muted mb-1" id="shipping-address">{{ shipping_address }}</p>
                                <p class="text-muted mb-0" id="shipping-phone">Phone: {{ shipping_phone }}</p>
                                <p class="text-muted mb-0" id="shipping-tax">Tax: {{ shipping_taxno }}</p>
                            </BCol>
                        </BRow>
                    </BCardBody>
                    <BCardBody class="p-4">
                        <div class="table-responsive">
                            <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                <thead>
                                    <tr class="table-active">
                                        <th scope="col" style="width: 50px;">#</th>
                                        <th scope="col">Product Details</th>
                                        <th scope="col">Rate</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col" class="text-end">Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="products-list">
                                    <tr v-for="(item, index) of product_detail" :key="index">
                                        <th scope="row">01</th>
                                        <td class="text-start">
                                            <span class="fw-medium">{{ item.name }}</span>
                                            <p class="text-muted mb-0">{{ item.category }}
                                            </p>
                                        </td>
                                        <td>${{ item.price }}</td>
                                        <td>{{ item.stock }}</td>
                                        <td class="text-end">{{ item.price * item.stock }}</td>
                                    </tr>
                                    <tr class="border-top border-top-dashed mt-2">
                                        <td colspan="3"></td>
                                        <td colspan="2" class="fw-medium p-0">
                                            <table
                                                class="table table-borderless text-start table-nowrap align-middle mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>Sub Total</td>
                                                        <td class="text-end">${{ sub_total }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Estimated Tax (12.5%)</td>
                                                        <td class="text-end">${{ estimated_tax }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Discount <small class="text-muted">(VELZON15)</small></td>
                                                        <td class="text-end">- ${{ discount }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping Charge</td>
                                                        <td class="text-end">${{ shipping_charge }}</td>
                                                    </tr>
                                                    <tr class="border-top border-top-dashed">
                                                        <th scope="row">Total Amount</th>
                                                        <td class="text-end">${{ total_amount }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <h6 class="text-muted text-uppercase fw-semibold mb-3">Payment Details:</h6>
                            <p class="text-muted mb-1">Payment Method: <span class="fw-medium" id="payment-method">{{
                                    payment_method
                            }}</span></p>
                            <p class="text-muted mb-1">Card Holder: <span class="fw-medium" id="card-holder-name">{{
                                    card_holder_name
                            }}</span></p>
                            <p class="text-muted mb-1">Card Number: <span class="fw-medium" id="card-number">{{
                                    card_number
                            }}</span>
                            </p>
                            <p class="text-muted">Total Amount: <span class="fw-medium" id="">$ </span><span
                                    id="card-total-amount">{{ total_amount }}</span></p>
                        </div>
                        <div class="mt-4">
                            <BAlert variant="info" :model-value="true" show>
                                <p class="mb-0"><span class="fw-semibold">NOTES: </span>
                                    <span id="note">{{ notes }}
                                    </span>
                                </p>
                            </BAlert>
                        </div>
                        <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                            <BLink href="javascript:window.print()" class="btn btn-success"><i
                                    class="ri-printer-line align-bottom me-1"></i> Print</BLink>
                            <BLink href="javascript:void(0);" class="btn btn-primary"><i
                                    class="ri-download-2-line align-bottom me-1"></i>
                                Download</BLink>
                        </div>
                    </BCardBody>
                </BCard>
            </BCol>
        </BRow>
    </Layout>
</template>