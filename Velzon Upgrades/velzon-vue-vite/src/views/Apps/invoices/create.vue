<script setup>
import { ref, onMounted, watch, nextTick } from 'vue';
import axios from 'axios';
import Multiselect from '@vueform/multiselect';
import '@vueform/multiselect/themes/default.css';
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import Layout from '@/layouts/main.vue';
import PageHeader from '@/components/page-header.vue';

// Reactive state
const value = ref('');
const paymentvalue = ref(null);
const value1 = ref('$');
const config = ref({
  wrap: true,
  altFormat: 'M j, Y',
  altInput: true,
  enableTime: true,
});
const paymentSign = ref('$');
const date = ref(null);
const count = ref(1);
const taxRate = ref(0.125);
const shippingRate = ref(65.0);
const discountRate = ref(0.15);
const inputVal = ref(0);
const inputVal1 = ref(5);
const products = ref([]);
const allproductdata = ref([]);
const productvalue = ref(null);
const newproductvalue = ref(['', '']);
const productids = ref([]);

// Watcher to track changes in selected product
watch(productvalue, (value) => {
  if (Array.isArray(newproductvalue.value)) {
    newproductvalue.value.forEach((e) => {
      console.log('the value', e);
    });
  }

  const priceInput = document.getElementById('productprice');
  if (priceInput) priceInput.value = '';

  if (value) {
    const result = allproductdata.value.findIndex((o) => o.name === value);
    if (result !== -1 && allproductdata.value[result]) {
      if (priceInput) priceInput.value = allproductdata.value[result].price;
      productids.value.push(allproductdata.value[result]._id);
    }
  }
});

// Load product list
onMounted(() => {
  axios.get('https://api-node.themesbrand.website/apps/product')
    .then((res) => {
      allproductdata.value = res.data.data;
      products.value = res.data.data.map(item => ({
        value: item.name,
        label: item.name
      }));
    })
    .catch(console.error);

  initRemoveButtons();
});

// Select product and assign price
const selectedv = (val) => {
  if (val) {
    const index = allproductdata.value.findIndex((o) => o.name === val);
    if (index !== -1) {
      const product = allproductdata.value[index];
      newproductvalue.value.forEach((item, i) => {
        if (item === val) {
          const input = document.getElementById('productprice' + (i + 1));
          if (input) input.value = product.price;
        }
      });
      productids.value.push(product._id);
    }
  }
};

// Add a new product row
const new_link = () => {
  newproductvalue.value.push('');
  count.value++;
  nextTick(() => {
    initRemoveButtons();
  });
};

// Init remove buttons
const initRemoveButtons = () => {
  document.querySelectorAll('.product-removal a').forEach((el) => {
    el.addEventListener('click', (e) => {
      e.preventDefault();
      removeItem(e);
      resetRow();
      count.value--;
    });
  });
};

// Remove row and recalculate
const removeItem = (e) => {
  const row = e.target.closest('tr');
  if (row) row.remove();
  recalculateCart();
};

// Reassign row numbers after removal
const resetRow = () => {
  const rows = document.getElementById('newlink')?.querySelectorAll('tr') || [];
  rows.forEach((row, i) => {
    row.querySelector('.product-id').innerHTML = i + 1;
  });
};

// Quantity increase/decrease and cart recalculation
const isData = () => {
  const plusBtns = document.getElementsByClassName('plus');
  const minusBtns = document.getElementsByClassName('minus');

  Array.from(plusBtns).forEach((btn) => {
    btn.addEventListener('click', () => {
      const input = btn.previousElementSibling;
      if (input && parseInt(input.value) < 10) {
        input.value++;
        updateRowPrice(btn);
      }
    });
  });

  Array.from(minusBtns).forEach((btn) => {
    btn.addEventListener('click', () => {
      const input = btn.nextElementSibling;
      if (input && parseInt(input.value) > 1) {
        input.value--;
        updateRowPrice(btn);
      }
    });
  });
};

// Update row line price and cart
const updateRowPrice = (el) => {
  const quantity = el.parentElement.querySelector('.product-quantity').value;
  const price = el.parentElement.parentElement.previousElementSibling.querySelector('.product-price').value;
  const priceEl = el.parentElement.parentElement.nextElementSibling.querySelector('.product-line-price');
  updateQuantity(quantity, price, priceEl);
};

// Calculate line price
const updateQuantity = (qty, price, outputEl) => {
  const linePrice = (qty * price).toFixed(2);
  if (outputEl) outputEl.value = paymentSign.value + linePrice;
  recalculateCart();
};

// Manual amount input keyup
const amountKeyup = () => {
  Array.from(document.getElementsByClassName('product-price')).forEach((input) => {
    input.addEventListener('keyup', (e) => {
      const price = e.target.value;
      const qty = input.parentElement.nextElementSibling.querySelector('.product-quantity').value;
      const priceEl = input.parentElement.nextElementSibling.nextElementSibling.querySelector('.product-line-price');
      updateQuantity(qty, price, priceEl);
    });
  });
};

// Calculate totals
const recalculateCart = () => {
  let subtotal = 0;
  nextTick(() => {
    Array.from(document.getElementsByClassName('product')).forEach((row) => {
      Array.from(row.getElementsByClassName('product-line-price')).forEach((priceEl) => {
        if (priceEl.value) {
          subtotal += parseFloat(priceEl.value.slice(1));
        }
      });
    });

    const tax = subtotal * taxRate.value;
    const discount = subtotal * discountRate.value;
    const shipping = subtotal > 0 ? shippingRate.value : 0;
    const total = subtotal + tax + shipping - discount;

    document.getElementById('cart-subtotal').value = paymentSign.value + subtotal.toFixed(2);
    document.getElementById('cart-tax').value = paymentSign.value + tax.toFixed(2);
    document.getElementById('cart-shipping').value = paymentSign.value + shipping.toFixed(2);
    document.getElementById('cart-total').value = paymentSign.value + total.toFixed(2);
    document.getElementById('cart-discount').value = paymentSign.value + discount.toFixed(2);
    document.getElementById('totalamountInput').value = paymentSign.value + total.toFixed(2);
    document.getElementById('amountTotalPay').value = paymentSign.value + total.toFixed(2);
  });
};

// Create invoice request
const createinvoice = () => {
  const data = {
    company_address: document.getElementById('companyAddress').value,
    postalcode: document.getElementById('companyaddpostalcode').value,
    registration_no: document.getElementById('registrationNumber').value,
    email: document.getElementById('companyEmail').value,
    website: document.getElementById('companyWebsite').value,
    contact: document.getElementById('compnayContactno').value,
    invoiceId: document.getElementById('invoicenoInput').value,
    dat: document.getElementById('invoicedate').value,
    status: document.getElementById('paymentstatus').value,
    billing_name: document.getElementById('billingName').value,
    billing_address: document.getElementById('billingAddress').value,
    billing_phone: document.getElementById('billingPhoneno').value,
    billing_taxno: document.getElementById('billingTaxno').value,
    shipping_name: document.getElementById('shippingName').value,
    shipping_address: document.getElementById('shippingAddress').value,
    shipping_phone: document.getElementById('shippingPhoneno').value,
    shipping_taxno: document.getElementById('shippingTaxno').value,
    sub_total: document.getElementById('cart-subtotal').value,
    estimated_tax: document.getElementById('cart-tax').value,
    discount: document.getElementById('cart-discount').value,
    shipping_charge: document.getElementById('cart-shipping').value,
    card_holder_name: document.getElementById('cardholderName').value,
    card_number: document.getElementById('cardNumber').value,
    total_amount: document.getElementById('amountTotalPay').value,
    notes: document.getElementById('exampleFormControlTextarea1').value,
    productDetails: productids.value,
  };

  axios.post('https://api-node.themesbrand.website/apps/invoice', data)
    .then((res) => console.log(res))
    .catch((err) => console.error(err));
};
</script>



<template>
  <Layout>
    <PageHeader title="Create Invoice" pageTitle="Invoices" />
    <BRow class="justify-content-center">
      <BCol xxl="9">
        <BCard no-body>
          <form class="needs-validation" novalidate>
            <BCardBody class="border-bottom border-bottom-dashed p-4">
              <BRow>
                <BCol lg="4">
                  <div class="profile-user mx-auto mb-3">
                    <input id="profile-img-file-input" type="file" class="profile-img-file-input" required />
                    <label for="profile-img-file-input" class="d-block" tabindex="0">
                      <span
                        class="overflow-hidden border border-dashed d-flex align-items-center justify-content-center rounded"
                        style="height: 60px; width: 256px">
                        <img src="@/assets/images/logo-dark.png"
                          class="card-logo card-logo-dark user-profile-image img-fluid" alt="logo dark" />
                        <img src="@/assets/images/logo-light.png"
                          class="card-logo card-logo-light user-profile-image img-fluid" alt="logo light" />
                      </span>
                    </label>
                  </div>
                  <div>
                    <div>
                      <label for="companyAddress">Address</label>
                    </div>
                    <div class="mb-2">
                      <textarea class="form-control bg-light border-0" id="companyAddress" rows="3"
                        placeholder="Company Address" required></textarea>
                      <div class="invalid-feedback">Please enter a address</div>
                    </div>
                    <div>
                      <input type="text" class="form-control bg-light border-0" id="companyaddpostalcode" minlength="5"
                        maxlength="6" placeholder="Enter Postal Code" required />
                      <div class="invalid-feedback">
                        The US zip code must contain 5 digits, Ex. 45678
                      </div>
                    </div>
                  </div>
                </BCol>
                <BCol lg="4" class="ms-auto">
                  <div class="mb-2">
                    <input type="text" class="form-control bg-light border-0" id="registrationNumber" maxlength="12"
                      placeholder="Legal Registration No" required />
                    <div class="invalid-feedback">
                      Please enter a registration no, Ex., 012345678912
                    </div>
                  </div>
                  <div class="mb-2">
                    <input type="email" class="form-control bg-light border-0" id="companyEmail"
                      placeholder="Email Address" required />
                    <div class="invalid-feedback">
                      Please enter a valid email, Ex., example@gamil.com
                    </div>
                  </div>
                  <div class="mb-2">
                    <input type="text" class="form-control bg-light border-0" id="companyWebsite" placeholder="Website"
                      required />
                    <div class="invalid-feedback">
                      Please enter a website, Ex., www.example.com
                    </div>
                  </div>
                  <div>
                    <input type="text" class="form-control bg-light border-0" data-plugin="cleave-phone"
                      id="compnayContactno" placeholder="Contact No" required />
                    <div class="invalid-feedback">
                      Please enter a contact number
                    </div>
                  </div>
                </BCol>
              </BRow>
            </BCardBody>
            <BCardBody class="p-4">
              <BRow class="g-3">
                <BCol lg="3" sm="6">
                  <label for="invoicenoInput">Invoice No</label>
                  <input type="text" class="form-control bg-light border-0" id="invoicenoInput" placeholder="Invoice No"
                    value="#VL25000355" readonly />
                </BCol>
                <BCol lg="3" sm="6">
                  <div>
                    <label for="date-field">Date</label>

                    <flat-pickr v-model="date" id="invoicedate" placeholder="Select date and time" :config="config"
                      class="form-control bg-light border-light border-0"></flat-pickr>
                  </div>
                </BCol>
                <BCol lg="3" sm="6">
                  <label for="choices-payment-status">Payment Status</label>
                  <div class="input-light">
                    <Multiselect class="form-control w-md" id="paymentstatus" v-model="paymentvalue"
                      :close-on-select="true" :searchable="true" :create-option="true" :options="[
                        { value: '', label: 'Select Payment Status' },
                        { value: 'Paid', label: 'Paid' },
                        { value: 'Unpaid', label: 'Unpaid' },
                        { value: 'Refund', label: 'Refund' },
                      ]" />
                  </div>
                </BCol>
                <BCol lg="3" sm="6">
                  <div>
                    <label for="totalamountInput">Total Amount</label>
                    <input type="text" class="form-control bg-light border-0" id="totalamountInput" placeholder="$0.00"
                      readonly />
                  </div>
                </BCol>
              </BRow>
            </BCardBody>
            <BCardBody class="p-4 border-top border-top-dashed">
              <BRow>
                <BCol lg="4" sm="6">
                  <div>
                    <label for="billingName" class="text-muted text-uppercase fw-semibold">Billing Address</label>
                  </div>
                  <div class="mb-2">
                    <input type="text" class="form-control bg-light border-0" id="billingName" placeholder="Full Name"
                      required />
                    <div class="invalid-feedback">Please enter a full name</div>
                  </div>
                  <div class="mb-2">
                    <textarea class="form-control bg-light border-0" id="billingAddress" rows="3" placeholder="Address"
                      required></textarea>
                    <div class="invalid-feedback">Please enter a address</div>
                  </div>
                  <div class="mb-2">
                    <input type="text" class="form-control bg-light border-0" data-plugin="cleave-phone"
                      id="billingPhoneno" placeholder="(123)456-7890" required />
                    <div class="invalid-feedback">
                      Please enter a phone number
                    </div>
                  </div>
                  <div class="mb-3">
                    <input type="text" class="form-control bg-light border-0" id="billingTaxno" placeholder="Tax Number"
                      required />
                    <div class="invalid-feedback">
                      Please enter a tax number
                    </div>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="same" name="same"
                      onchange="billingFunction()" />
                    <label class="form-check-label" for="same">
                      Will your Billing and Shipping address same?
                    </label>
                  </div>
                </BCol>
                <BCol sm="6" class="ms-auto">
                  <BRow>
                    <BCol lg="8">
                      <div>
                        <label for="shippingName" class="text-muted text-uppercase fw-semibold">Shipping Address</label>
                      </div>
                      <div class="mb-2">
                        <input type="text" class="form-control bg-light border-0" id="shippingName"
                          placeholder="Full Name" required />
                        <div class="invalid-feedback">
                          Please enter a full name
                        </div>
                      </div>
                      <div class="mb-2">
                        <textarea class="form-control bg-light border-0" id="shippingAddress" rows="3"
                          placeholder="Address" required></textarea>
                        <div class="invalid-feedback">
                          Please enter a address
                        </div>
                      </div>
                      <div class="mb-2">
                        <input type="text" class="form-control bg-light border-0" data-plugin="cleave-phone"
                          id="shippingPhoneno" placeholder="(123)456-7890" required />
                        <div class="invalid-feedback">
                          Please enter a phone number
                        </div>
                      </div>
                      <div>
                        <input type="text" class="form-control bg-light border-0" id="shippingTaxno"
                          placeholder="Tax Number" required />
                        <div class="invalid-feedback">
                          Please enter a tax number
                        </div>
                      </div>
                    </BCol>
                  </BRow>
                </BCol>
              </BRow>
            </BCardBody>
            <BCardBody class="p-4">
              <div class="table-responsive">
                <table class="invoice-table table table-borderless table-nowrap mb-0">
                  <thead class="align-middle">
                    <tr class="table-active">
                      <th scope="col" style="width: 50px">#</th>
                      <th scope="col">Product Details</th>
                      <th scope="col" style="width: 152px">
                        <div class="d-flex currency-select input-light align-items-center">
                          Rate

                          <Multiselect class="bg-light" v-model="value1" :close-on-select="true" :searchable="true"
                            :create-option="true" :options="[
                              { value: '$', label: '($)' },
                              { value: '£', label: '(£)' },
                              { value: '₹', label: '(₹)' },
                              { value: '€', label: '(€)' },
                            ]" />
                        </div>
                      </th>
                      <th scope="col" style="width: 120px">Quantity</th>
                      <th scope="col" class="text-end" style="width: 150px">
                        Amount
                      </th>
                      <th scope="col" class="text-end" style="width: 105px"></th>
                    </tr>
                  </thead>
                  <tbody id="newlink">

                    <tr v-for="n in count" :key="n" :id="n" class="product">
                      <th scope="row" class="product-id">{{ n }}</th>
                      <td class="text-start">
                        <Multiselect class="form-control w-md" v-model="newproductvalue[n - 1]" :close-on-select="true"
                          :searchable="true" :create-option="true" :options="products"
                          @select="selectedv(newproductvalue[n - 1])" />
                      </td>
                      <td>
                        <input type="number" :id="'productprice' + n"
                          class="form-control product-price bg-light border-0" placeholder="0.00" required />
                        <div class="invalid-feedback">Please enter a rate</div>
                      </td>
                      <td>
                        <div class="input-step">
                          <BButton variant="light" @click="minusamount(this)">–</BButton>
                          <input type="number" class="product-quantity" readonly />
                          <BButton variant="light" @click="plusamount(this)">+</BButton>
                        </div>
                      </td>
                      <td class="text-end">
                        <div>
                          <input type="text" class="form-control bg-light border-0 product-line-price"
                            placeholder="$0.00" readonly />
                        </div>
                      </td>
                      <td class="product-removal">
                        <BLink href="javascript:void(0)" class="btn btn-success">Delete</BLink>
                      </td>
                    </tr>

                  </tbody>
                  <tbody>
                    <tr id="newForm" style="display: none"></tr>
                  </tbody>
                  <tbody>
                    <tr>
                      <td colspan="9">
                        <BLink @click="new_link" class="btn btn-soft-secondary fw-medium"><i
                            class="ri-add-fill me-1 align-bottom"></i> Add
                          Item</BLink>
                      </td>
                    </tr>
                  </tbody>
                  <tbody>
                    <tr class="border-top border-top-dashed mt-2">
                      <td colspan="3"></td>
                      <td colspan="2" class="p-0">
                        <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                          <tbody>
                            <tr>
                              <th scope="row">Sub Total</th>
                              <td style="width: 150px">
                                <input type="text" class="form-control bg-light border-0" id="cart-subtotal"
                                  placeholder="$0.00" readonly />
                              </td>
                            </tr>
                            <tr>
                              <th scope="row">Estimated Tax (12.5%)</th>
                              <td>
                                <input type="text" class="form-control bg-light border-0" id="cart-tax"
                                  placeholder="$0.00" readonly />
                              </td>
                            </tr>
                            <tr>
                              <th scope="row">
                                Discount
                                <small class="text-muted">(VELZON15)</small>
                              </th>
                              <td>
                                <input type="text" class="form-control bg-light border-0" id="cart-discount"
                                  placeholder="$0.00" readonly />
                              </td>
                            </tr>
                            <tr>
                              <th scope="row">Shipping Charge</th>
                              <td>
                                <input type="text" class="form-control bg-light border-0" id="cart-shipping"
                                  placeholder="$0.00" readonly />
                              </td>
                            </tr>
                            <tr class="border-top border-top-dashed">
                              <th scope="row">Total Amount</th>
                              <td>
                                <input type="text" class="form-control bg-light border-0" id="cart-total"
                                  placeholder="$0.00" readonly />
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <BRow class="mt-3">
                <BCol lg="4">
                  <div class="mb-2">
                    <label for="choices-payment-type" class="form-label text-muted text-uppercase fw-semibold">Payment
                      Details</label>

                    <div class="input-light">
                      <Multiselect class="form-control w-md" v-model="value" :close-on-select="true" :searchable="true"
                        :create-option="true" :options="[
                          { value: '', label: 'Payment Method' },
                          { value: 'Mastercard', label: 'Mastercard' },
                          { value: 'Credit Card', label: 'Credit Card' },
                          { value: 'Visa', label: 'Visa' },
                          { value: 'Paypal', label: 'Paypal' },
                        ]" />
                    </div>
                  </div>
                  <div class="mb-2">
                    <input class="form-control bg-light border-0" type="text" id="cardholderName"
                      placeholder="Card Holder Name" />
                  </div>
                  <div class="mb-2">
                    <input class="form-control bg-light border-0" type="text" id="cardNumber"
                      placeholder="xxxx xxxx xxxx xxxx" />
                  </div>
                  <div>
                    <input class="form-control bg-light border-0" type="text" id="amountTotalPay" placeholder="$0.00"
                      readonly />
                  </div>
                </BCol>
              </BRow>
              <div class="mt-4">
                <label for="exampleFormControlTextarea1"
                  class="form-label text-muted text-uppercase fw-semibold">NOTES</label>
                <textarea class="form-control alert alert-info" id="exampleFormControlTextarea1" placeholder="Notes"
                  rows="2"
                  required>All accounts are to be paid within 7 days from receipt of invoice. To be paid by cheque or credit card or direct payment online. If account is not paid within 7 days the credits details supplied as confirmation of work undertaken will be charged the agreed quoted fee noted above.</textarea>
              </div>
              <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                <BButton type="button" variant="success" @click="createinvoice">
                  <i class="ri-printer-line align-bottom me-1"></i> Save
                </BButton>
                <BLink href="javascript:void(0);" class="btn btn-primary"><i
                    class="ri-download-2-line align-bottom me-1"></i> Download
                  Invoice</BLink>
                <BLink href="javascript:void(0);" class="btn btn-danger"><i
                    class="ri-send-plane-fill align-bottom me-1"></i> Send
                  Invoice</BLink>
              </div>
            </BCardBody>
          </form>
        </BCard>
      </BCol>
    </BRow>
  </Layout>
</template>