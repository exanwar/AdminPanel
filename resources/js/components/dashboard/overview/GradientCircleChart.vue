<template>
    <div class="chart__wrapper">
        <div class="card card-fluid">
            <div class="card-body text-center d-flex flex-column justify-content-center">
                <h5 class="mb-4">Emails sent</h5>
                <div id="char">
                    <apexchart type="radialBar" height="300" :options="emailSent.chartOptions" :series="emailSent.series"></apexchart>
                </div>
                <div class="d-flex mt-4">
                    <div class="col">
                    <span class="d-block badge badge-dot badge-lg h6">
                      <i class="bg-danger"></i>30 not sent
                    </span>
                        <span class="d-block badge badge-dot badge-lg h6">
                      <i class="bg-success"></i>68 success
                    </span>
                    </div>
                    <div class="col">
                    <span class="d-block badge badge-dot badge-lg h6">
                      <i class="bg-warning"></i>38 opened
                    </span>
                        <span class="d-block badge badge-dot badge-lg h6">
                      <i class="bg-danger"></i>SMTP error
                    </span>
                    </div>
                </div>
                <a href="#" class="btn btn-block btn-secondary mt-auto">Open insights</a>
            </div>
        </div>
    </div>
</template>
<script>
    import VueApexCharts from 'vue-apexcharts';
    export default {
        components:{
            apexchart: VueApexCharts
        },
        data(){
            let emailSentSeries = [75]
            return{
                emailSent:{
                    series: emailSentSeries,
                    chartOptions: {
                        chart: {
                            height: '100%',
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
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shade: 'dark',
                                type: 'horizontal',
                                shadeIntensity: 0.5,
                                gradientToColors: ['#ABE5A1'],
                                inverseColors: true,
                                opacityFrom: 1,
                                opacityTo: 1,
                                stops: [0, 100]
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
