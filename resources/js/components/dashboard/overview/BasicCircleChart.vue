<template>
    <div class="chart__wrapper">
        <div class="card card-fluid">
            <div class="card-body text-center d-flex flex-column justify-content-center">
                <h5 class="mb-4">Congratulations!</h5>
                <apexchart type="radialBar" height="200" :options="basic.chartOptions" :series="basic.series"></apexchart>
                <p class="mt-4 mb-0">
                    Github issues were closed this week.
                </p>
            </div>
        </div>
    </div>
</template>
<script>
    import VueApexCharts from 'vue-apexcharts';
    export default {
        components:{
            apexchart : VueApexCharts
        },
        data(){
            return{
                basic:{
                    series: [70],
                    chartOptions: {
                        chart: {
                            height: '60px',
                            type: 'radialBar',
                            zoom: {enabled: !1},
                            toolbar: {show: !1},
                            shadow: {enabled: !1},
                        },
                        plotOptions: {
                            radialBar: {
                                startAngle: 0,
                                endAngle: 360,
                                hollow: {
                                    margin: 0,
                                    size: '70%',
                                    background: '#fff',
                                    image: undefined,
                                    imageOffsetX: 0,
                                    imageOffsetY: 0,
                                    position: 'front',
                                    dropShadow: {
                                        enabled: true,
                                        top: 3,
                                        left: 0,
                                        blur: 4,
                                        opacity: 0.24
                                    }
                                },
                                track: {
                                    background: '#fff',
                                    strokeWidth: '67%',
                                    margin: 0, // margin is in pixels
                                    dropShadow: {
                                        enabled: true,
                                        top: -3,
                                        left: 0,
                                        blur: 4,
                                        opacity: 0.35
                                    }
                                },
                                dataLabels: {
                                    show: true,
                                    name: {
                                        offsetY: -10,
                                        show: true,
                                        color: '#888',
                                        fontSize: '17px'
                                    },
                                    value: {
                                        formatter: function(val) {
                                            return parseInt(val);
                                        },
                                        color: '#111',
                                        fontSize: '36px',
                                        show: true,
                                    }
                                }
                            }
                        },
                        stroke: {
                            lineCap: 'round'
                        },
                        labels: ['Sent'],
                    },


                },
            }
        }

    }
</script>
