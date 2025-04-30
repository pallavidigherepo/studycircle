<script>
import getChartColorsArray from "@/common/getChartColorsArray";
import { layoutComputed } from "@/state/helpers.js"
export default {
    data() {
        return {
            series: [{
                name: 'Like',
                data: [12.45, 16.2, 8.9, 11.42, 12.6, 18.1, 18.2, 14.16]
            }, {
                name: 'Share',
                data: [-11.45, -15.42, -7.9, -12.42, -12.6, -18.1, -18.2, -14.16]
            }],
            chartOptions: {
                chart: {
                    height: 260,
                    type: "bar",
                    stacked: true,
                    toolbar: {
                        show: false,
                    },
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '20%',
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                colors: getChartColorsArray('["--vz-success"]'),
                grid: {
                    borderColor: "#f1f1f1",
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                },
                yaxis: {
                    labels: {
                        show: false,
                        formatter: function (y) {
                            return y.toFixed(0) + "%";
                        }
                    }
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                    labels: {
                        rotate: -90
                    }
                }
            },
        };
    },
    mounted() {
        this.handleUpdate();
    },
    computed: {
        ...layoutComputed,
        layoutTheme() {
            return this.$store?.state.layout.layoutTheme || {};
        }
    },
    methods: {
        handleUpdate() {
            setTimeout(() => {
                switch (this.layoutTheme) {
                    case "default":
                        this.chartOptions = {
                            ...this.chartOptions,
                            colors: getChartColorsArray('["--vz-success", "--vz-warning"]')
                        };
                        break;
                    case "saas":
                        this.chartOptions = {
                            ...this.chartOptions,
                            colors: getChartColorsArray('["--vz-success", "--vz-warning"]')
                        };
                        break;
                    case "corporate":
                        this.chartOptions = {
                            ...this.chartOptions,
                            colors: getChartColorsArray('["--vz-success", "--vz-secondary"]')
                        };
                        break;
                    case "galaxy":
                        this.chartOptions = {
                            ...this.chartOptions,
                            colors: getChartColorsArray('["--vz-primary-rgb, 0.65", "--vz-primary"]')
                        };
                        break;
                    case "material":
                        this.chartOptions = {
                            ...this.chartOptions,
                            colors: getChartColorsArray('["--vz-success", "--vz-warning"]')
                        };
                        break;
                    case "creative":
                        this.chartOptions = {
                            ...this.chartOptions,
                            colors: getChartColorsArray('["--vz-success", "--vz-warning"]')
                        };
                        break;
                    case "minimal":
                        this.chartOptions = {
                            ...this.chartOptions,
                            colors: getChartColorsArray('["--vz-gray-200", "--vz-primary"]')
                        };
                        break;
                    case "modern":
                        this.chartOptions = {
                            ...this.chartOptions,
                            colors: getChartColorsArray('["--vz-success", "--vz-warning"]')
                        };
                        break;
                    case "interactive":
                        this.chartOptions = {
                            ...this.chartOptions,
                            colors: getChartColorsArray('["--vz-success", "--vz-warning"]')
                        };
                        break;
                    case "classic":
                        this.chartOptions = {
                            ...this.chartOptions,
                            colors: getChartColorsArray('["--vz-success", "--vz-warning"]')
                        };
                        break;
                    case "vintage":
                        this.chartOptions = {
                            ...this.chartOptions,
                            colors: getChartColorsArray('["--vz-success", "--vz-warning"]')
                        };
                        break;
                }
            }, 200)
        },
    },
    watch: {
        layoutTheme() {
            this.handleUpdate();
        }
    },
};
</script>
<template>
    <BCard no-body>
        <BCardHeader class="border-0 pb-0">
            <h6 class="card-title mb-0">Popularity</h6>
            <apexchart class="apex-charts" height="240" dir="ltr" :series="series" :options="chartOptions"></apexchart>
        </BCardHeader>
    </BCard>
</template>