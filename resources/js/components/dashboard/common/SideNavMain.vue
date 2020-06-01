<template>
    <div class="sidenavmain__wrapper">

        <!-- Sidenav header -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/index.html">
<!--                <img src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/brand/white.png" class="navbar-brand-img" alt="...">-->
                <span class="text-light font-weight-bolder h3">TechyPark</span>
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- User mini profile -->
        <div class="sidenav-user d-flex flex-column align-items-center justify-content-between text-center">
            <!-- Avatar -->
            <div>
                <a href="#" class="avatar rounded-circle avatar-xl">
                    <img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/theme/light/team-1-800x800.jpg" class="">
                </a>
                <div class="mt-4">
                    <h5 class="mb-0 text-white">Heather Parker</h5>
                    <span class="d-block text-sm text-white opacity-8 mb-3">Web Architect</span>
                    <a href="#" class="btn btn-sm btn-white btn-icon rounded-pill shadow hover-translate-y-n3">
                        <span class="btn-inner--icon"><i class="fas fa-coins"></i></span>
                        <span class="btn-inner--text">$2.300</span>
                    </a>
                </div>
            </div>
            <!-- User info -->
            <!-- Actions -->
            <div class="w-100 mt-4 actions d-flex justify-content-between">
                <a href="user/profile.html" class="action-item action-item-lg text-white pl-0">
                    <i class="fas fa-user"></i>
                </a>
                <a href="#modal-chat" class="action-item action-item-lg text-white" data-toggle="modal">
                    <i class="fas fa-comment-alt"></i>
                </a>
                <a href="shop/invoices.html" class="action-item action-item-lg text-white pr-0">
                    <i class="fas fa-receipt"></i>
                </a>
            </div>
        </div>
        <!-- Application nav -->
        <div class="nav-application clearfix">
            <router-link to="/dashboard/overview" class="btn btn-square text-sm">
                <span class="btn-inner--icon d-block"><i class="fas fa-home fa-2x"></i></span>
                <span class="btn-inner--icon d-block pt-2">Overview</span>
            </router-link>
            <router-link to="/dashboard/projects" class="btn btn-square text-sm">
                <span class="btn-inner--icon d-block"><i class="fas fa-project-diagram fa-2x"></i></span>
                <span class="btn-inner--icon d-block pt-2">Projects</span>
            </router-link>
            <router-link to="/dashboard/services" class="btn btn-square text-sm">
                <span class="btn-inner--icon d-block"><i class="fas fa-tasks fa-2x"></i></span>
                <span class="btn-inner--icon d-block pt-2">Services</span>
            </router-link>
            <router-link to="/dashboard/blog" class="btn btn-square text-sm">
                <span class="btn-inner--icon d-block"><i class="fas fa-columns fa-2x"></i></span>
                <span class="btn-inner--icon d-block pt-2">Blog</span>
            </router-link>
            <router-link to="/dashboard/users" class="btn btn-square text-sm">
                <span class="btn-inner--icon d-block"><i class="fas fa-users-cog fa-2x"></i></span>
                <span class="btn-inner--icon d-block pt-2">Users</span>
            </router-link>
            <router-link :to="'/dashboard/user/' + authUser.username" class="btn btn-square text-sm">
                <span class="btn-inner--icon d-block"><i class="fas fa-user-ninja fa-2x"></i></span>
                <span class="btn-inner--icon d-block pt-2">Profile</span>
            </router-link>
            <a href="shop/invoices.html" class="btn btn-square text-sm">
                <span class="btn-inner--icon d-block"><i class="fas fa-receipt fa-2x"></i></span>
                <span class="btn-inner--icon d-block pt-2">Invoices</span>
            </a>
            <a href="widgets.html" class="btn btn-square text-sm">
                <span class="btn-inner--icon d-block"><i class="fas fa-cogs fa-2x"></i></span>
                <span class="btn-inner--icon d-block pt-2">Widgets</span>
            </a>
        </div>
        <!-- Misc area -->
        <div class="card bg-gradient-warning">
            <div class="card-body">
                <h5 class="text-white">Hello, Friend!</h5>
                <p class="text-white mb-4">
                    Why not start using Purpose Application UI Kit and create something amazing today?
                </p>
                <a href="https://themes.getbootstrap.com/product/purpose-application-ui-kit/" class="btn btn-sm btn-block btn-white rounded-pill" target="_blank">Get started</a>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                authUser:{},
            }
        },
        methods:{
            getAuthUser(){
                axios.get('/api/user')
                    .then( ({data}) => {
                        this.authUser = data
                    })
            },
        },

        created(){
            this.getAuthUser();
        }
    }
</script>
