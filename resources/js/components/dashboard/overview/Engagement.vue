<template>
    <div class="chart__wrapper">
        <div class="card card-fluid">
            <div class="card-header">
                <h6 class="mb-0">Engagement</h6>
            </div>
            <div class="card-body">

                <div id="chart">
                    <apexchart type="line" height="350" :options="engagement.chartOptions" data-color="primary" :series="engagement.series"></apexchart>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import VueApexCharts from 'vue-apexcharts'
    export default{
        components:{
            apexchart: VueApexCharts,

        },
        data(){
            return{
                engagement: {
                    series: [
                        {
                            name: "Likes",
                            data: [
                                4, 3, 10, 9, 29, 19, 22, 9
                            ]
                        }
                    ],
                    chartOptions: {
                        chart: {
                            width: "100%",
                            zoom: {enabled: !1},
                            toolbar: {show: !1},
                            shadow: {enabled: !1},
                        },
                        stroke: {width: 7, curve: "smooth"},

                        colors:['#5800cc'],
                        xaxis: {
                            labels: {
                                format: "MMM",
                                style: {
                                    colors: '#757575',
                                    fontSize: "14px",
                                    //fontFamily: PurposeStyle.fonts.base,
                                    cssClass: "apexcharts-xaxis-label",
                                },
                            },
                            axisBorder: {show: !1},
                            axisTicks: {
                                show: !0,
                                borderType: "solid",
                                color: '#E0E0E0',
                                height: 6,
                                offsetX: 0,
                                offsetY: 0,
                            },
                            type: "datetime",
                            categories: [
                                "1/11/2000",
                                "2/11/2000",
                                "3/11/2000",
                                "4/11/2000",
                                "5/11/2000",
                                "6/11/2000",
                                "7/11/2000",
                                "8/11/2000",
                            ],
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    color: '#757575',
                                    fontSize: "12px",
                                    //fontFamily: ,
                                },
                            },
                            axisBorder: {show: !1},
                            axisTicks: {
                                show: !0,
                                borderType: "solid",
                                color: '#E0E0E0',
                                height: 6,
                                offsetX: 0,
                                offsetY: 0,
                            },
                        },
                        fill: {type: "solid"},
                        markers: {
                            size: 4,
                            opacity: 0.7,
                            strokeColor: "#fff",
                            strokeWidth: 3,
                            hover: {size: 7},
                        },
                        grid: {
                            borderColor: '#E0E0E0',
                            strokeDashArray: 5,
                        },
                        dataLabels: {enabled: !1},
                    }
                }


            }

        }


    }
</script>
