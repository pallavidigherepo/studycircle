<script setup>
import { ref, computed, watch, onMounted } from "vue";
import { CountTo } from "vue3-count-to";
import Layout from "@/layouts/main.vue";
import PageHeader from "@/components/page-header.vue";
import { buySellList } from "@/common/data";

// Pagination state
const posts = ref([...buySellList]);
const page = ref(1);
const perPage = ref(8);
const pages = ref([]);
const searchQuery = ref(null);

// Chart options and series
const options = {
  chart: {
    type: "candlestick",
    height: 360,
    toolbar: { show: false },
  },
  plotOptions: {
    candlestick: {
      colors: {
        upward: "#0AB39C",
        downward: "#F06548",
      },
    },
  },
  xaxis: {
    type: "datetime",
  },
  yaxis: {
    tooltip: { enabled: true },
    labels: {
      formatter: value => `$${value}`,
    },
  },
  tooltip: {
    shared: true,
    y: [
      {
        formatter: y => (typeof y !== "undefined" ? y.toFixed(0) : y),
      },
      {
        formatter: y => (typeof y !== "undefined" ? `$${y.toFixed(2)}k` : y),
      },
      {
        formatter: y => (typeof y !== "undefined" ? `${y.toFixed(0)} Sales` : y),
      },
    ],
  },
};

const series = [
  {
    data: [
      {
        x: new Date(1538778600000),
        y: [6629.81, 6650.5, 6623.04, 6633.33],
      },
      // ... more data points
    ],
  },
];

// Computed pagination
const displayedPosts = computed(() => {
  const from = page.value * perPage.value - perPage.value;
  const to = page.value * perPage.value;
  return posts.value.slice(from, to);
});

// Search functionality
const resultQuery = computed(() => {
  if (!searchQuery.value) return displayedPosts.value;
  const q = searchQuery.value.toLowerCase();
  return displayedPosts.value.filter((data) =>
    [
      data.currency_name,
      data.price,
      data.pairs,
      data.high,
      data.low,
      data.market,
      data.volume.toString(),
    ].some(field => field.toLowerCase().includes(q))
  );
});

// Sorting
const direction = ref("asc");
const onSort = (column) => {
  direction.value = direction.value === "asc" ? "desc" : "asc";
  posts.value.sort((a, b) => {
    const res = a[column] < b[column] ? -1 : a[column] > b[column] ? 1 : 0;
    return direction.value === "asc" ? res : -res;
  });
};

// Pagination setup
const setPages = () => {
  const total = Math.ceil(posts.value.length / perPage.value);
  pages.value = Array.from({ length: total }, (_, i) => i + 1);
};

watch(posts, setPages);
onMounted(setPages);

// Filter (replacement as method or computed)
const trimWords = (value) => {
  return value.split(" ").slice(0, 20).join(" ") + "...";
};
</script>


<template>
  <Layout>
    <PageHeader title="Buy & Sell" pageTitle="Crypto" />

    <BRow>
      <BCol xl="3" sm="6">
        <BCard no-body class="card-animate">
          <BCardBody>
            <div class="d-flex">
              <div class="flex-grow-1">
                <h6 class="text-muted mb-3">Total Buy</h6>
                <h2 class="mb-0">
                  $<count-to :startVal="0" :duration="5000" :endVal="243"></count-to><small
                    class="text-muted fs-13">.10k</small>
                </h2>
              </div>
              <div class="flex-shrink-0 avatar-sm">
                <div class="avatar-title bg-danger-subtle text-danger fs-22 rounded">
                  <i class="ri-shopping-bag-line"></i>
                </div>
              </div>
            </div>
          </BCardBody>
        </BCard>
      </BCol>
      <BCol xl="3" sm="6">
        <BCard no-body class="card-animate">
          <BCardBody>
            <div class="d-flex">
              <div class="flex-grow-1">
                <h6 class="text-muted mb-3">Total Sell</h6>
                <h2 class="mb-0">
                  $<count-to :startVal="0" :duration="5000" :endVal="658"></count-to><small
                    class="text-muted fs-13">.00k</small>
                </h2>
              </div>
              <div class="flex-shrink-0 avatar-sm">
                <div class="avatar-title bg-info-subtle text-info fs-22 rounded">
                  <i class="ri-funds-line"></i>
                </div>
              </div>
            </div>
          </BCardBody>
        </BCard>
      </BCol>
      <BCol xl="3" sm="6">
        <BCard no-body class="card-animate">
          <BCardBody>
            <div class="d-flex">
              <div class="flex-grow-1">
                <h6 class="text-muted mb-3">Today's Buy</h6>
                <h2 class="mb-0">
                  $<count-to :startVal="0" :duration="5000" :endVal="104"></count-to><small
                    class="text-muted fs-13">.85k</small>
                </h2>
              </div>
              <div class="flex-shrink-0 avatar-sm">
                <div class="avatar-title bg-warning-subtle text-warning fs-22 rounded">
                  <i class="ri-arrow-left-down-fill"></i>
                </div>
              </div>
            </div>
          </BCardBody>
        </BCard>
      </BCol>
      <BCol xl="3" sm="6">
        <BCard no-body class="card-animate">
          <BCardBody>
            <div class="d-flex">
              <div class="flex-grow-1">
                <h6 class="text-muted mb-3">Today's Sell</h6>
                <h2 class="mb-0">
                  $<count-to :startVal="0" :duration="5000" :endVal="87"></count-to><small
                    class="text-muted fs-13">.35k</small>
                </h2>
              </div>
              <div class="flex-shrink-0 avatar-sm">
                <div class="avatar-title bg-success-subtle text-success fs-22 rounded">
                  <i class="ri-arrow-right-up-fill"></i>
                </div>
              </div>
            </div>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <BRow>
      <BCol xxl="9">
        <BCard no-body class="card-height-100">
          <BCardHeader class="border-0 align-items-center d-flex">
            <BCardTitle class="mb-0 flex-grow-1">Market Graph</BCardTitle>
            <div class="hstack gap-1">
              <BButton type="button" variant="soft-secondary" size="sm">
                1H
              </BButton>
              <BButton type="button" variant="soft-secondary" size="sm">
                7D
              </BButton>
              <BButton type="button" variant="soft-secondary" size="sm">
                1M
              </BButton>
              <BButton type="button" variant="soft-secondary" size="sm">
                1Y
              </BButton>
              <BButton type="button" variant="soft-primary" size="sm">
                ALL
              </BButton>
            </div>
          </BCardHeader>
          <BCardBody class="p-0">
            <div
              class="bg-light-subtle border-top-dashed border border-start-0 border-end-0 border-bottom-dashed py-3 px-4">
              <BRow class="align-items-center">
                <BCol cols="6">
                  <div class="d-flex flex-wrap gap-4 align-items-center">
                    <div>
                      <h3 class="fs-19">
                        $46,959.<small class="fs-14 text-muted">00</small>
                      </h3>
                      <p class="text-muted text-uppercase fw-medium mb-0">
                        Bitcoin (BTC)
                        <BBadge variant="success-subtle" class="bg-success-subtle text-success"><i
                            class="ri-arrow-right-up-line align-bottom"></i>
                          2.15%</BBadge>
                      </p>
                    </div>
                  </div>
                </BCol>
                <BCol cols="6">
                  <div class="d-flex">
                    <div class="d-flex justify-content-end text-end flex-wrap gap-4 ms-auto">
                      <div class="pe-3">
                        <h6 class="mb-2 text-muted">High</h6>
                        <h5 class="text-success mb-0">$28,722.76</h5>
                      </div>
                      <div class="pe-3">
                        <h6 class="mb-2 text-muted">Low</h6>
                        <h5 class="text-danger mb-0">$68,789.63</h5>
                      </div>
                      <div>
                        <h6 class="mb-2 text-muted">Market Volume</h6>
                        <h5 class="text-danger mb-0">$888,411,910</h5>
                      </div>
                    </div>
                  </div>
                </BCol>
              </BRow>
            </div>
          </BCardBody>
          <BCardBody class="p-0 pb-3">
            <apexchart class="apex-charts" height="350" dir="ltr" :series="options.series"
              :options="options.chartOptions"></apexchart>
          </BCardBody>
        </BCard>
      </BCol>
      <BCol xxl="3">
        <BCard no-body class="card-height-100">
          <BCardBody class="p-0">
            <BTabs nav-class="nav-tabs-custom rounded  border-bottom-0 mx-n3 text-muted pt-3" style="overflow: hidden;" justified>
              <BTab title="Buy" class="nav-item ">
                <div class="p-3 bg-warning-subtle">
                  <div class="float-end ms-2">
                    <h6 class="text-warning mb-0">
                      USD Balance : <span class="text-body">$12,426.07</span>
                    </h6>
                  </div>
                  <h6 class="mb-0 text-danger">Buy Coin</h6>
                </div>
                <div class="p-3">
                  <BRow>
                    <BCol cols="6">
                      <div class="mb-3">
                        <label>Currency :</label>
                        <select class="form-select">
                          <option>BTC</option>
                          <option>ETH</option>
                          <option>LTC</option>
                        </select>
                      </div>
                    </BCol>
                    <BCol cols="6">
                      <div class="mb-3">
                        <label>Payment Method :</label>
                        <select class="form-select">
                          <option>Wallet Balance</option>
                          <option>Credit / Debit Card</option>
                          <option>PayPal</option>
                          <option>Payoneer</option>
                        </select>
                      </div>
                    </BCol>
                  </BRow>
                  <div>
                    <div class="input-group mb-3">
                      <label class="input-group-text">Amount</label>
                      <input type="text" class="form-control" placeholder="0" />
                    </div>

                    <div class="input-group mb-3">
                      <label class="input-group-text">Price</label>
                      <input type="text" class="form-control" placeholder="2.045585" />
                      <label class="input-group-text">$</label>
                    </div>

                    <div class="input-group mb-0">
                      <label class="input-group-text">Total</label>
                      <input type="text" class="form-control" placeholder="2700.16" />
                    </div>
                  </div>
                  <div class="mt-3 pt-2">
                    <div class="d-flex mb-2">
                      <div class="flex-grow-1">
                        <p class="fs-13 mb-0">
                          Transaction Fees<span class="text-muted ms-1 fs-11">(0.05%)</span>
                        </p>
                      </div>
                      <div class="flex-shrink-0">
                        <h6 class="mb-0">$1.08</h6>
                      </div>
                    </div>
                    <div class="d-flex mb-2">
                      <div class="flex-grow-1">
                        <p class="fs-13 mb-0">
                          Minimum Received<span class="text-muted ms-1 fs-11">(2%)</span>
                        </p>
                      </div>
                      <div class="flex-shrink-0">
                        <h6 class="mb-0">$7.85</h6>
                      </div>
                    </div>
                    <div class="d-flex">
                      <div class="flex-grow-1">
                        <p class="fs-13 mb-0">Estimated Rate</p>
                      </div>
                      <div class="flex-shrink-0">
                        <h6 class="mb-0">1 BTC ~ $46982.70</h6>
                      </div>
                    </div>
                  </div>
                  <div class="mt-3 pt-2">
                    <BButton type="button" variant="primary" class="w-100">
                      Buy Coin
                    </BButton>
                  </div>
                </div>
              </BTab>
              <BTab title="sell" class="nav-item">
                <div class="p-3 bg-warning-subtle">
                  <div class="float-end ms-2">
                    <h6 class="text-warning mb-0">
                      USD Balance : <span class="text-body">$12,426.07</span>
                    </h6>
                  </div>
                  <h6 class="mb-0 text-danger">Sell Coin</h6>
                </div>
                <div class="p-3">
                  <BRow>
                    <BCol cols="6">
                      <div class="mb-3">
                        <label for="currencySelect">Currency :</label>
                        <select class="form-select" id="currencySelect">
                          <option value="BTC" selected>BTC</option>
                          <option value="ETH">ETH</option>
                          <option value="EUR">EUR</option>
                          <option value="JPY">JPY</option>
                          <option value="LTC">LTC</option>
                        </select>
                      </div>
                    </BCol>
                    <BCol cols="6">
                      <div class="mb-3">
                        <div class="mb-3">
                          <label for="paymentMethod">Payment Method :</label>
                          <select class="form-select" id="paymentMethod">
                            <option>Wallet Balance</option>
                            <option>Credit / Debit Card</option>
                            <option>PayPal</option>
                            <option>Payoneer</option>
                          </select>
                        </div>
                      </div>
                    </BCol>
                  </BRow>
                  <div>
                    <div class="input-group mb-3">
                      <label class="input-group-text">Amount</label>
                      <input type="text" class="form-control" placeholder="0" />
                    </div>
                    <div class="input-group mb-3">
                      <label class="input-group-text">Price</label>
                      <input type="text" class="form-control" placeholder="2.045585" />
                      <label class="input-group-text">$</label>
                    </div>
                    <div class="input-group mb-0">
                      <label class="input-group-text">Total</label>
                      <input type="text" class="form-control" placeholder="2700.16" />
                    </div>
                  </div>
                  <div class="mt-3 pt-2">
                    <div class="d-flex mb-2">
                      <div class="flex-grow-1">
                        <p class="fs-13 mb-0">
                          Transaction Fees<span class="text-muted ms-1 fs-11">(0.05%)</span>
                        </p>
                      </div>
                      <div class="flex-shrink-0">
                        <h6 class="mb-0">$1.08</h6>
                      </div>
                    </div>
                    <div class="d-flex mb-2">
                      <div class="flex-grow-1">
                        <p class="fs-13 mb-0">
                          Minimum Received<span class="text-muted ms-1 fs-11">(2%)</span>
                        </p>
                      </div>
                      <div class="flex-shrink-0">
                        <h6 class="mb-0">$7.85</h6>
                      </div>
                    </div>
                    <div class="d-flex">
                      <div class="flex-grow-1">
                        <p class="fs-13 mb-0">Estimated Rate</p>
                      </div>
                      <div class="flex-shrink-0">
                        <h6 class="mb-0">1 BTC ~ $46982.70</h6>
                      </div>
                    </div>
                  </div>
                  <div class="mt-3 pt-2">
                    <BButton type="button" variant="danger" class="w-100">
                      Sell Coin
                    </BButton>
                  </div>
                </div>
              </BTab>
            </BTabs>
          </BCardBody>
        </BCard>
      </BCol>
    </BRow>

    <BCard no-body>
      <BCardHeader class="border-bottom-dashed">
        <BRow class="align-items-center">
          <BCol cols="3">
            <h5 class="card-title mb-0">Markets</h5>
          </BCol>
          <div class="col-auto ms-auto">
            <div class="d-flex gap-2">
              <BButton variant="success">
                <i class="ri-equalizer-line align-bottom me-1"></i> Filters
              </BButton>
            </div>
          </div>
        </BRow>
      </BCardHeader>
      <BCardBody class="p-0 border-bottom border-bottom-dashed">
        <div class="search-box">
          <input type="text" class="form-control search border-0 py-3" placeholder="Search to currency..." />
          <i class="ri-search-line search-icon"></i>
        </div>
      </BCardBody>
      <BCardBody>
        <div class="table-responsive table-card">
          <table class="table align-middle table-nowrap" id="customerTable">
            <thead class="table-light text-muted">
              <tr>
                <th class="sort" data-sort="currency_name" scope="col" @click="onSort('currency_name')">Currency</th>
                <th class="sort" data-sort="current_value" scope="col" @click="onSort('price')">Price</th>
                <th class="sort" data-sort="pairs" scope="col" @click="onSort('pairs')">Pairs</th>
                <th class="sort" data-sort="high" scope="col" @click="onSort('high')">24 High</th>
                <th class="sort" data-sort="low" scope="col" @click="onSort('low')">24 Low</th>
                <th class="sort" data-sort="market_cap" scope="col" @click="onSort('market')">Market Volume</th>
                <th class="sort" data-sort="valume" scope="col" @click="onSort('volume')">Volume %</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="list form-check-all">
              <tr v-for="(data, index) of resultQuery" :key="index">
                <td class="id" style="display: none">
                  <BLink href="javascript:void(0);" class="fw-medium link-primary">#VZ001</BLink>
                </td>
                <td>
                  <div class="d-flex align-items-center fw-medium">
                    <img :src="data.image" alt="" class="avatar-xxs me-2" />
                    <BLink href="javascript:void(0);" class="currency_name">{{
                      data.currency_name
                    }}</BLink>
                  </div>
                </td>
                <td class="current_value">{{ data.price }}</td>
                <td class="pairs">{{ data.pairs }}</td>
                <td class="high">{{ data.high }}</td>
                <td class="low">{{ data.low }}</td>
                <td class="market_cap">{{ data.market }}</td>
                <td class="valume">
                  <h6 class="fs-13 mb-0" :class="{
                    'text-danger': data.volume > 1,
                    'text-success': data.volume < 1,
                  }">
                    <i class="mdi mdi-trending-up align-middle me-1"></i>{{ data.volume }}%
                  </h6>
                </td>
                <td>
                  <BButton variant="soft-info" size="sm">Trade Now</BButton>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="d-flex justify-content-end mt-3" v-if="resultQuery.length >= 1">
          <div class="pagination-wrap hstack gap-2">
            <BLink class="page-item pagination-prev" href="#" :disabled="page <= 1" @click="page--"> Previous </BLink>
            <ul class="pagination listjs-pagination mb-0">
              <li :class="{ active: pageNumber == page, disabled: pageNumber == '...', }"
                v-for="(pageNumber, index) in pages" :key="index" @click="page = pageNumber">
                <BLink class="page" href="#" data-i="1" data-page="8">{{ pageNumber }}</BLink>
              </li>
            </ul>
            <BLink class="page-item pagination-next" href="#" :disabled="page >= pages.length" @click="page++">
              Next
            </BLink>
          </div>
        </div>
      </BCardBody>
    </BCard>
  </Layout>
</template>
