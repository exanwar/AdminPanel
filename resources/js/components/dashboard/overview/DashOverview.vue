<template>
    <div class="overview__wrapper">
        <!-- Page title -->
        <div class="page-title">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h5 class="h3 font-weight-400 mb-0 text-white">Moning, Heather!</h5>
                    <span class="text-sm text-white opacity-8">Have a nice day!</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 col-md-12">
                <Engagement></Engagement>
            </div>
            <div class="col-xl-4 col-md-6">
                <GradientCircleChart></GradientCircleChart>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <BasicCircleChart></BasicCircleChart>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card card-fluid bg-gradient-dark border-0">
                    <div class="card-header border-0 pb-0">
                        <h6 class="text-white mb-0"><span class="text-danger mr-2">●</span>Project at risk</h6>
                    </div>
                    <div class="card-body text-center">
                        <!-- Avatar -->
                        <a href="#" class="avatar avatar-lg rounded-circle">
                            <img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/theme/light/brand-avatar-1.png">
                        </a>
                        <!-- Title -->
                        <h5 class="h6 mt-4 mb-0 text-white">Website redesign</h5>
                        <!-- Actions -->
                        <div class="actions actions-dark d-flex justify-content-between px-4 mt-4">
                            <a href="#" class="action-item">
                                <i class="fas fa-chart-pie"></i>
                            </a>
                            <a href="#" class="action-item">
                                <i class="fas fa-user"></i>
                            </a>
                            <a href="#" class="action-item">
                                <i class="fas fa-info-circle"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-6">
                                <div style="max-width: 120px;">
                                    <!--                                    <div class="spark-chart" data-toggle="spark-chart" data-type="line" data-height="50" data-color="danger" data-dataset="[42, 55, 19, 16, 84, 24, 10, 11, 93, 15, 81]"></div>-->
                                </div>
                            </div>
                            <div class="col-auto text-center">
                                <span class="d-block h4 mb-0 text-white">8</span>
                                <span class="d-block text-sm text-white opacity-8">Days delay</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <BasicCircleChart></BasicCircleChart>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-7 d-sm-flex flex-sm-column">
                <div class="row flex-sm-fill">
                    <div class="col-sm-4">
                        <div class="card card-fluid">
                            <div class="card-body text-center">
                                <div class="avatar-parent-child">
                                    <a href="#" class="avatar avatar-lg rounded-circle">
                                        <img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/theme/light/team-1-800x800.jpg">
                                    </a>
                                    <span class="avatar-child avatar-badge bg-success"></span>
                                </div>
                                <h5 class="h6 mt-4 mb-0">John Sullivan</h5>
                                <a href="#" class="d-block text-sm text-muted mb-3">@john.sullivan</a>
                                <div class="actions d-flex justify-content-between px-4">
                                    <a href="#" class="action-item">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <a href="#" class="action-item">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                    <a href="#" class="action-item">
                                        <i class="fas fa-share-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card card-fluid">
                            <div class="card-body text-center">
                                <div class="avatar-parent-child">
                                    <a href="#" class="avatar avatar-lg rounded-circle">
                                        <img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/theme/light/team-2-800x800.jpg">
                                    </a>
                                    <span class="avatar-child avatar-badge bg-warning"></span>
                                </div>
                                <h5 class="h6 mt-4 mb-0">Heather Wright</h5>
                                <a href="#" class="d-block text-sm text-muted mb-3">@heather.wright</a>
                                <div class="actions d-flex justify-content-between px-4">
                                    <a href="#" class="action-item">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <a href="#" class="action-item">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                    <a href="#" class="action-item">
                                        <i class="fas fa-share-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card card-fluid">
                            <div class="card-body text-center">
                                <div class="avatar-parent-child">
                                    <a href="#" class="avatar avatar-lg rounded-circle">
                                        <img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/theme/light/team-3-800x800.jpg">
                                    </a>
                                    <span class="avatar-child avatar-badge bg-danger"></span>
                                </div>
                                <h5 class="h6 mt-4 mb-0">James Lewis</h5>
                                <a href="#" class="d-block text-sm text-muted mb-3">@james.lewis</a>
                                <div class="actions d-flex justify-content-between px-4">
                                    <a href="#" class="action-item">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <a href="#" class="action-item">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                    <a href="#" class="action-item">
                                        <i class="fas fa-share-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row flex-sm-fill">
                    <div class="col-sm-4">
                        <div class="card card-fluid">
                            <div class="card-body text-center">
                                <div class="avatar-parent-child">
                                    <a href="#" class="avatar avatar-lg rounded-circle">
                                        <img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/theme/light/team-1-800x800.jpg">
                                    </a>
                                    <span class="avatar-child avatar-badge bg-success"></span>
                                </div>
                                <h5 class="h6 mt-4 mb-0">John Snow</h5>
                                <a href="#" class="d-block text-sm text-muted mb-3">@john.snow</a>
                                <div class="actions d-flex justify-content-between px-4">
                                    <a href="#" class="action-item">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <a href="#" class="action-item">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                    <a href="#" class="action-item">
                                        <i class="fas fa-share-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card card-fluid">
                            <div class="card-body text-center">
                                <div class="avatar-parent-child">
                                    <a href="#" class="avatar avatar-lg rounded-circle">
                                        <img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/theme/light/team-2-800x800.jpg">
                                    </a>
                                    <span class="avatar-child avatar-badge bg-success"></span>
                                </div>
                                <h5 class="h6 mt-4 mb-0">John Michael</h5>
                                <a href="#" class="d-block text-sm text-muted mb-3">@john.michael</a>
                                <div class="actions d-flex justify-content-between px-4">
                                    <a href="#" class="action-item">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <a href="#" class="action-item">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                    <a href="#" class="action-item">
                                        <i class="fas fa-share-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card card-fluid">
                            <div class="card-body text-center">
                                <div class="avatar-parent-child">
                                    <a href="#" class="avatar avatar-lg rounded-circle">
                                        <img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/theme/light/team-3-800x800.jpg">
                                    </a>
                                    <span class="avatar-child avatar-badge bg-warning"></span>
                                </div>
                                <h5 class="h6 mt-4 mb-0">Monroe Parker</h5>
                                <a href="#" class="d-block text-sm text-muted mb-3">@monroe.parker</a>
                                <div class="actions d-flex justify-content-between px-4">
                                    <a href="#" class="action-item">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <a href="#" class="action-item">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                    <a href="#" class="action-item">
                                        <i class="fas fa-share-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
                <CalenderWidget></CalenderWidget>
            </div>
        </div>
    </div>
</template>
<script>
    import Engagement from "./Engagement";
    import BasicCircleChart from "./BasicCircleChart";
    import GradientCircleChart from "./GradientCircleChart";
    import CalenderWidget from "./CalendarWidget";
    export default{
        components:{
            Engagement, BasicCircleChart, GradientCircleChart, CalenderWidget
        },
        data(){
            return{

            }
        }
    }
</script>
