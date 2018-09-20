<template>
    <div id="graphs" class="container">
        <div class="row">
            <div class="graph shadow-sm rounded col-lg-3">
                <h2 class="graphTitle">Purchased items per month</h2>
                <apexcharts type="bar" :options="chartOptions" :series="series"></apexcharts>
            </div>
            <div class="graph shadow-sm rounded col-lg-3 mx-auto">
                <h2 class="graphTitle">Used items per month</h2>
                <apexcharts type="bar" :options="chartOptionsUsed" :series="seriesUsed"></apexcharts>
            </div>
            <div class="graph shadow-sm rounded col-lg-3">
                <h2 class="graphTitle">Used items per month</h2>
                <apexcharts type="bar" :options="chartOptionsUsed" :series="seriesUsed"></apexcharts>
            </div>
        </div>
        <!--<div class="row">
            <div class="graph shadow-sm rounded col-lg-3">
                <h2 class="graphTitle">Inventory</h2>
                <apexcharts type="donut" width="250" height="250" :options="chartOptionsInventory" :series="seriesInventory"></apexcharts>
            </div>
            <div class="graph shadow-sm rounded col-lg-3 mx-auto">
                <h2 class="graphTitle">Items over best before</h2>
                <apexcharts type="radialBar" width="250" height="250" :options="chartOptionsBestBefore" :series="seriesBestBefore"></apexcharts>
            </div>
            <div class="graph shadow-sm rounded col-lg-3">
                <h2 class="graphTitle">Items over best before</h2>
                <apexcharts type="radialBar" width="250" height="250" :options="chartOptionsBestBefore" :series="seriesBestBefore"></apexcharts>
            </div>
        </div>-->
    </div>
</template>
<script>
    import VueApexCharts from 'vue-apexcharts'
    export default {
        components: {
            apexcharts: VueApexCharts,
        },

        data() {
            return {
                chartOptions: {
                    chart: {
                        id: 'vuechart-example1'
                    },
                    xaxis: {
                        categories: ['April','Maj','Juni']
                    }
                },
                series: [{
                    name: 'Items',
                    data: [30, 40, 45]
                }],
                chartOptionsUsed: {
                    chart: {
                        id: 'vuechart-example2'
                    },
                    xaxis: {
                        categories: ['April','Maj','Juni','Juli']
                    }
                },
                seriesUsed: [{
                    name: 'Items',
                    data: [30, 40, 45, 10]
                }],
                chartOptionsInventory: {
                    chart: {
                        id: 'vuechart-example3',
                    },
                    legend: {
                        show : false
                    },
                    labels : ['Okse', 'Svine', 'Kylling']
                },
                seriesInventory: [30, 40, 45],
                chartOptionsBestBefore: {
                    chart: {
                        id: 'vuechart-example4'
                    },
                    plotOptions: {
                        radialBar: {
                            hollow: {
                                size: '80%',
                            },
                            dataLabels : {
                                showOn: 'always',
                                name : {
                                    show : false,
                                    fontSize: '10px'
                                }
                            }
                        },
                    },

                },
                seriesBestBefore: [60],

            }
        },

        methods : {

        },
    }
</script>