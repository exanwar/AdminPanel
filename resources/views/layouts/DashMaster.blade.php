<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Purpose Application UI is the following chapter we've finished in order to create a complete and robust solution next to the already known Purpose Website UI.">
    <meta name="author" content="Webpixels">
    <title>Purpose – Application UI Kit</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/brand/favicon.png" type="image/png">

    <link rel="stylesheet" href="{{ asset('/dash/css/purpose.css') }}" >
    <link rel="stylesheet" href="/css/dash.css" >
</head>

<body class="application application-offset">
<div id="app">

    <!-- Customizer modal -->
    <div class="modal fade fixed-right" id="modal-chat" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-vertical" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <div class="modal-title">
                        <h6 class="mb-0">Chat</h6>
                        <span class="d-block text-sm">3 new conversations</span>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="scrollbar-inner">
                    <!-- Chat contacts -->
                    <div class="list-group list-group-flush">
                        @foreach($users as $user)
                            <router-link to="/dashboard/user/{{$user->username}}" class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                    <div>
                                        <div class="avatar-parent-child">
                                            @if($user->image)
                                                <img alt="Image placeholder" src="{{ $user->image }}" class="avatar  rounded-circle">
                                            @else
                                                <img alt="Image placeholder" src="/images/users/default.jpg" class="avatar  rounded-circle">
                                            @endif
                                            @if($user->isOnline())
                                                <span class="avatar-child avatar-badge bg-success"></span>
                                            @else
                                                <span class="avatar-child avatar-badge bg-warning"></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-fill ml-3">
                                        <h6 class="text-sm mb-0">{{ $user->name }}</h6>
                                        <p class="text-sm mb-0">
                                            @if($user->role === 'customer')
                                                Member
                                                @elseif($user->role === 'dev')
                                                    Developer
                                                @elseif($user->role === 'admin')
                                                    Admin
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </router-link>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer py-3 mt-auto">
                    <a href="#" class="btn btn-block btn-sm btn-neutral btn-icon rounded-pill">
                        <span class="btn-inner--icon"><i class="fab fa-facebook-messenger"></i></span>
                        <span class="btn-inner--text">Open Chat</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Application container -->
    <div class="container-fluid container-application">
        <!-- Sidenav -->
        <div class="sidenav" id="sidenav-main">
            <side-nav-main></side-nav-main>
        </div>
        <!-- Content -->
        <div class="main-content position-relative">
            <!-- Main nav -->
            <nav class="navbar navbar-main navbar-expand-lg navbar-dark bg-primary navbar-border" id="navbar-main">
                <div class="container-fluid">
                    <!-- Brand + Toggler (for mobile devices) -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- User's navbar -->
                    <div class="navbar-user d-lg-none ml-auto">
                        <ul class="navbar-nav flex-row align-items-center">
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin" data-target="#sidenav-main"><i class="fas fa-bars"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-link-icon" data-action="omnisearch-open" data-target="#omnisearch"><i class="fas fa-search"></i></a>
                            </li>
                            <li class="nav-item dropdown dropdown-animate">
                                <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0">
                                    <div class="py-3 px-3">
                                        <h5 class="heading h6 mb-0">Notifications</h5>
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="2 hrs ago">
                                                <div>
                                                    <span class="avatar bg-primary text-white rounded-circle">AM</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Alex Michael <small class="float-right text-muted">2 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="3 hrs ago">
                                                <div>
                                                    <span class="avatar bg-warning text-white rounded-circle">SW</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Sandra Wayne <small class="float-right text-muted">3 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="5 hrs ago">
                                                <div>
                                                    <span class="avatar bg-info text-white rounded-circle">JM</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Jason Miller <small class="float-right text-muted">5 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="2 hrs ago">
                                                <div>
                                                    <span class="avatar bg-dark text-white rounded-circle">MJ</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Mike Thomson <small class="float-right text-muted">2 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="3 hrs ago">
                                                <div>
                                                    <span class="avatar bg-primary text-white rounded-circle">RN</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Richard Nixon <small class="float-right text-muted">3 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="py-3 text-center">
                                        <a href="#" class="link link-sm link--style-3">View all notifications</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-animate">
                                <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/theme/light/team-4-800x800.jpg">
                              </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                                    <h6 class="dropdown-header px-0">Hi, Heather!</h6>
                                    <a href="user/profile.html" class="dropdown-item">
                                        <i class="fas fa-user"></i>
                                        <span>My profile</span>
                                    </a>
                                    <a href="account/settings.html" class="dropdown-item">
                                        <i class="fas fa-cog"></i>
                                        <span>Settings</span>
                                    </a>
                                    <a href="account/billing.html" class="dropdown-item">
                                        <i class="fas fa-credit-card"></i>
                                        <span>Billing</span>
                                    </a>
                                    <a href="shop/orders.html" class="dropdown-item">
                                        <i class="fas fa-shopping-basket"></i>
                                        <span>Orders</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>{{ __('Logout') }}</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Navbar nav -->
                    <div class="collapse navbar-collapse navbar-collapse-fade" id="navbar-main-collapse">
                        <ul class="navbar-nav align-items-lg-center">
                            <!-- Overview  -->
                            <li class="nav-item d-lg-none ">
                                <a class="nav-link" href="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/index.html">
                                    Overview
                                </a>
                            </li>
                            <li class="border-top opacity-2 my-2"></li>
                            <!-- Home  -->
                            <li class="nav-item ">
                                <a class="nav-link pl-lg-0" href="home.html">
                                    Home
                                </a>
                            </li>
                            <!-- Application menu -->
                            <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Application
                                </a>
                                <div class="dropdown-menu dropdown-menu-arrow p-lg-0">
                                    <!-- Top dropdown menu -->
                                    <div class="p-lg-4">
                                        <div class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                                            <a href="#" class="dropdown-item dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Project
                                            </a>
                                            <div class="dropdown-menu"><a class="dropdown-item" href="project/card-listing.html">
                                                    Card listing
                                                </a>
                                                <a class="dropdown-item" href="project/table-listing.html">
                                                    Table listing
                                                </a>
                                                <a class="dropdown-item" href="project/overview.html">
                                                    Overview
                                                </a>
                                                <a class="dropdown-item" href="project/create-new.html">
                                                    Create new
                                                </a>
                                            </div>
                                        </div>
                                        <div class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                                            <a href="#" class="dropdown-item dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Task
                                            </a>
                                            <div class="dropdown-menu"><a class="dropdown-item" href="task/table-listing.html">
                                                    Table listing
                                                </a>
                                                <a class="dropdown-item" href="task/kanban-board.html">
                                                    Kanban board
                                                </a>
                                                <a class="dropdown-item" href="task/create-new.html">
                                                    Create new
                                                </a>
                                            </div>
                                        </div>
                                        <div class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                                            <a href="#" class="dropdown-item dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                User
                                            </a>
                                            <div class="dropdown-menu"><a class="dropdown-item" href="user/card-listing.html">
                                                    Card listing
                                                </a>
                                                <a class="dropdown-item" href="user/table-listing.html">
                                                    Table listing
                                                </a>
                                                <a class="dropdown-item" href="user/profile.html">
                                                    Profile
                                                </a>
                                            </div>
                                        </div>
                                        <div class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                                            <a href="#" class="dropdown-item dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Authentication
                                            </a>
                                            <div class="dropdown-menu"><a class="dropdown-item" href="authentication/login.html">
                                                    Login
                                                </a>
                                                <a class="dropdown-item" href="authentication/register.html">
                                                    Register
                                                </a>
                                                <a class="dropdown-item" href="authentication/recover.html">
                                                    Recover
                                                </a>
                                            </div>
                                        </div>
                                        <div class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                                            <a href="#" class="dropdown-item dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Account
                                            </a>
                                            <div class="dropdown-menu"><a class="dropdown-item" href="account/profile.html">
                                                    Profile
                                                </a>
                                                <a class="dropdown-item" href="account/settings.html">
                                                    Settings
                                                </a>
                                                <a class="dropdown-item" href="account/billing.html">
                                                    Billing
                                                </a>
                                                <a class="dropdown-item" href="account/notifications.html">
                                                    Notifications
                                                </a>
                                                <a class="dropdown-item" href="account/addresses.html">
                                                    Addresses
                                                </a>
                                            </div>
                                        </div>
                                        <div class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                                            <a href="#" class="dropdown-item dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Shop
                                            </a>
                                            <div class="dropdown-menu"><a class="dropdown-item" href="shop/card-listing.html">
                                                    Card listing
                                                </a>
                                                <a class="dropdown-item" href="shop/table-listing.html">
                                                    Table listing
                                                </a>
                                                <a class="dropdown-item" href="shop/product.html">
                                                    Product
                                                </a>
                                                <a class="dropdown-item" href="shop/orders.html">
                                                    Orders
                                                </a>
                                                <a class="dropdown-item" href="shop/order-description.html">
                                                    Order description
                                                </a>
                                                <a class="dropdown-item" href="shop/cart.html">
                                                    Cart
                                                </a>
                                                <a class="dropdown-item" href="shop/sellers.html">
                                                    Sellers
                                                </a>
                                                <a class="dropdown-item" href="shop/invoices.html">
                                                    Invoices
                                                </a>
                                                <a class="dropdown-item" href="shop/invoice-description.html">
                                                    Invoice description
                                                </a>
                                            </div>
                                        </div>
                                        <div class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                                            <a href="#" class="dropdown-item dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Utility
                                            </a>
                                            <div class="dropdown-menu"><a class="dropdown-item" href="utility/error-404.html">
                                                    Error 404
                                                </a>
                                                <a class="dropdown-item" href="utility/error-500.html">
                                                    Error 500
                                                </a>
                                                <a class="dropdown-item" href="utility/maintenance-mode.html">
                                                    Maintenance mode
                                                </a>
                                                <a class="dropdown-item" href="utility/faq.html">
                                                    Faq
                                                </a>
                                                <a class="dropdown-item" href="utility/topic.html">
                                                    Topic
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Bottom dropdown menu -->
                                    <div class="dropdown-menu-links rounded-bottom delimiter-top p-lg-4">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="calendar.html" class="dropdown-item">Calendar</a>
                                                <a href="timeline.html" class="dropdown-item">Timeline</a>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="task/kanban-board.html" class="dropdown-item">Kanban board</a>
                                                <a href="google-map.html" class="dropdown-item">Google map</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="widgets.html">
                                    Widgets
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Docs</a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0">
                                    <ul class="list-group list-group-flush">
                                        <li>
                                            <a href="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/docs/index.html" class="list-group-item list-group-item-action" role="button">
                                                <div class="media d-flex align-items-center">
                                                    <!-- SVG icon -->
                                                    <figure style="width: 50px;">
                                                        <img alt="Image placeholder" src="#" class="svg-inject img-fluid" style="height: 50px;">
                                                    </figure>
                                                    <!-- Media body -->
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-1">Documentation</h6>
                                                        <p class="mb-0">Awesome section examples for any scenario.</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/docs/components/index.html" class="list-group-item list-group-item-action" role="button">
                                                <div class="media d-flex align-items-center">
                                                    <!-- SVG icon -->
                                                    <figure style="width: 50px;">
                                                        <img alt="Image placeholder" src="#" class="svg-inject img-fluid" style="height: 50px;">
                                                    </figure>
                                                    <!-- Media body -->
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-1">Components</h6>
                                                        <p class="mb-0">Awesome section examples for any scenario.</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="dropdown-menu-links rounded-bottom delimiter-top p-4">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/docs/getting-started/installation.html" class="dropdown-item">Installation</a>
                                                <a href="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/docs/getting-started/file-structure.html" class="dropdown-item">File structure</a>
                                                <a href="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/docs/getting-started/build-tools.html" class="dropdown-item">Build tools</a>
                                                <a href="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/docs/getting-started/customization.html" class="dropdown-item">Customization</a>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/docs/getting-started/plugins.html" class="dropdown-item">Using plugins</a>
                                                <a href="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/docs/components/index.html" class="dropdown-item">Components</a>
                                                <a href="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/docs/plugins/animate.html" class="dropdown-item">Plugins</a>
                                                <a href="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/docs/support.html" class="dropdown-item">Support</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="border-top opacity-2 my-2"></li>
                            <!-- Docs menu -->
                            <li class="nav-item d-lg-none">
                                <a class="nav-link" href="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/docs/index.html">
                                    Docs
                                </a>
                            </li>
                            <li class="nav-item d-lg-none">
                                <a class="nav-link" href="authentication/register.html">
                                    Register
                                </a>
                            </li>
                            <li class="nav-item d-lg-none">
                                <a class="nav-link" href="authentication/login.html">
                                    Sign in
                                </a>
                            </li>
                        </ul><!-- Right menu -->
                        <ul class="navbar-nav ml-lg-auto align-items-center d-none d-lg-flex">
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin" data-target="#sidenav-main"><i class="fas fa-bars"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-link-icon" data-action="omnisearch-open" data-target="#omnisearch"><i class="fas fa-search"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="#modal-chat" class="nav-link nav-link-icon" data-toggle="modal"><i class="fas fa-comment-alt"></i></a>
                            </li>
                            <li class="nav-item dropdown dropdown-animate">
                                <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0">
                                    <div class="py-3 px-3">
                                        <h5 class="heading h6 mb-0">Notifications</h5>
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="2 hrs ago">
                                                <div>
                                                    <span class="avatar bg-primary text-white rounded-circle">AM</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Alex Michael <small class="float-right text-muted">2 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="3 hrs ago">
                                                <div>
                                                    <span class="avatar bg-warning text-white rounded-circle">SW</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Sandra Wayne <small class="float-right text-muted">3 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="5 hrs ago">
                                                <div>
                                                    <span class="avatar bg-info text-white rounded-circle">JM</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Jason Miller <small class="float-right text-muted">5 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="2 hrs ago">
                                                <div>
                                                    <span class="avatar bg-dark text-white rounded-circle">MJ</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Mike Thomson <small class="float-right text-muted">2 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="3 hrs ago">
                                                <div>
                                                    <span class="avatar bg-primary text-white rounded-circle">RN</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Richard Nixon <small class="float-right text-muted">3 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="py-3 text-center">
                                        <a href="#" class="link link-sm link--style-3">View all notifications</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-animate">
                                <a class="nav-link pr-lg-0" href="#" role="button" id="dropdownForUserPic" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="media media-pill align-items-center">
                                    <span class="avatar rounded-circle">
                                      <img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/theme/light/team-4-800x800.jpg">
                                    </span>
                                        <div class="ml-2 d-none d-lg-block">
                                            <span class="mb-0 text-sm  font-weight-bold">John Snow</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow" aria-labelledby="dropdownForUserPic">
                                    <h6 class="dropdown-header px-0">Hi, John!</h6>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-user"></i>
                                        <span>My profile</span>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-cog"></i>
                                        <span>Settings</span>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-credit-card"></i>
                                        <span>Billing</span>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-tasks"></i>
                                        <span>Activity</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>{{ __('Logout') }}</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Omnisearch -->
            <div id="omnisearch" class="omnisearch">
                <div class="container">
                    <!-- Search form -->
                    <form class="omnisearch-form">
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-flush">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Type and hit enter ...">
                            </div>
                        </div>
                    </form>
                    <div class="omnisearch-suggestions">
                        <h6 class="heading">Search Suggestions</h6>
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a class="list-link" href="#">
                                            <i class="fas fa-search"></i>
                                            <span>macbook pro</span> in Laptops
                                        </a>
                                    </li>
                                    <li>
                                        <a class="list-link" href="#">
                                            <i class="fas fa-search"></i>
                                            <span>iphone 8</span> in Smartphones
                                        </a>
                                    </li>
                                    <li>
                                        <a class="list-link" href="#">
                                            <i class="fas fa-search"></i>
                                            <span>macbook pro</span> in Laptops
                                        </a>
                                    </li>
                                    <li>
                                        <a class="list-link" href="#">
                                            <i class="fas fa-search"></i>
                                            <span>beats pro solo 3</span> in Headphones
                                        </a>
                                    </li>
                                    <li>
                                        <a class="list-link" href="#">
                                            <i class="fas fa-search"></i>
                                            <span>smasung galaxy 10</span> in Phones
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page content -->
            <div class="page-content" style="min-height: 75rem">
                <router-view></router-view>
            </div>

            <!-- Footer -->
            <footer class="footer pt-5 pb-4 footer-light" id="footer-main">
                <div class="row text-center text-sm-left align-items-sm-center">
                    <div class="col-sm-6">
                        <p class="text-sm mb-0">&copy; 2019 <a href="https://webpixels.io/" class="h6 text-sm" target="_blank">Webpixels</a>. All rights reserved.</p>
                    </div>
                    <div class="col-sm-6 mb-md-0">
                        <ul class="nav justify-content-center justify-content-md-end">
                            <li class="nav-item dropdown border-right">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/icons/flags/ro.svg">
                                    <span class="h6 text-sm mb-0">RO</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <a href="#" class="dropdown-item"><img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/icons/flags/es.svg" class="mr-2">Spanish</a>
                                    <a href="#" class="dropdown-item"><img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/icons/flags/us.svg" class="mr-2">English</a>
                                    <a href="#" class="dropdown-item"><img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/icons/flags/gr.svg" class="mr-2">Greek</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Support</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Terms</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pr-0" href="#">Privacy</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Scripts -->
</div>

<!-- Scripts -->
<script src="/js/app.js"></script>
<!-- Core JS - includes jquery, bootstrap, popper, in-view and sticky-kit -->
<script src="{{ asset('dash/js/purpose.core.js') }}"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script src="{{ asset('dash/js/autosize.min.js') }}"></script>
<script src="{{ asset('dash/js/dragula.min.js') }}"></script>
<!-- Purpose JS -->
<script src="{{ asset('dash/js/purpose.js') }}"></script>
</body>

</html>
