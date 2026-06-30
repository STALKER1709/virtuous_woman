<!Doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Virtuous Woman') }}</title>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="surfside media" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/animation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('font/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('icon/style.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/virtuous assets/web/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('assets/images/virtuous assets/web/favicon.ico')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">

    @stack("styles")
</head>
<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">

                <div class="section-menu-left virtuous-admin-menu">
                    <div class="box-logo">
                        <a href="{{route('admin.index')}}" id="site-logo-inner">
                            <img class=".logo__image" id="" alt="Virtuous Woman Admin" src="{{ asset('assets/images/virtuous assets/web/icon-512-maskable.png') }}" style="border-radius: 50%; width: 60px;"
                                data-light="images/logo/virtuous-woman-logo.png" data-dark="images/logo/virtuous-woman-logo.png">
                        </a>
                        <div class="button-show-hide">
                            <i class="icon-menu-left"></i>
                        </div>
                    </div>
                    <div class="center">
                        <div class="center-item">
                            <div class="center-heading">Virtuous Woman Admin</div>
                            <ul class="menu-list">
                                <li class="menu-item">
                                    <a href="{{route('admin.index')}}" class="virtuous-menu-link">
                                        <div class="icon"><i class="icon-grid"></i></div>
                                        <div class="text">Dashboard</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="center-item">
                            <ul class="menu-list">
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button virtuous-menu-link">
                                        <div class="icon"><i class="icon-shopping-cart"></i></div>
                                        <div class="text">Products</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.product.add') }}" class="virtuous-submenu-link">
                                                <div class="text">Add Product</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.products') }}" class="virtuous-submenu-link">
                                                <div class="text">Products</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button virtuous-menu-link">
                                        <div class="icon"><i class="icon-layers"></i></div>
                                        <div class="text">Brands</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.brand.add') }}" class="virtuous-submenu-link">
                                                <div class="text">New Brand</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.brands') }}" class="virtuous-submenu-link">
                                                <div class="text">Brands</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button virtuous-menu-link">
                                        <div class="icon"><i class="icon-layers"></i></div>
                                        <div class="text">Categories</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.category.add') }}" class="virtuous-submenu-link">
                                                <div class="text">New Category</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.categories') }}" class="virtuous-submenu-link">
                                                <div class="text">Categories</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button virtuous-menu-link">
                                        <div class="icon"><i class="icon-file-plus"></i></div>
                                        <div class="text">Orders</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.orders') }}" class="virtuous-submenu-link">
                                                <div class="text">All Orders</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.returns') }}" class="virtuous-submenu-link">
                                                <div class="text">Returns</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item">
                                    <a href="slider.html" class="virtuous-menu-link">
                                        <div class="icon"><i class="icon-image"></i></div>
                                        <div class="text">Daily Inspiration</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('admin.coupons') }}" class="virtuous-menu-link">
                                        <div class="icon"><i class="icon-gift"></i></div>
                                        <div class="text">Coupons</div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="users.html" class="virtuous-menu-link">
                                        <div class="icon"><i class="icon-user"></i></div>
                                        <div class="text">Sisterhood Members</div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="settings.html" class="virtuous-menu-link">
                                        <div class="icon"><i class="icon-settings"></i></div>
                                        <div class="text">Settings</div>
                                    </a>
                                </li>

                                 <li class="menu-item">
                                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                        @csrf
                                        <a href="{{ route('logout') }}" class="virtuous-menu-link"
                                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            <div class="icon"><i class="icon-log-out"></i></div>
                                            <div class="text">Logout</div>
                                        </a>
                                    </form>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="section-content-right">

                    <div class="header-dashboard virtuous-admin-header">
                        <div class="wrap">
                            <div class="header-left">
                                <a href="index-2.html">
                                    <img class="" id="logo_header_mobile" alt="Virtuous Woman" src="images/logo/virtuous-woman-logo.png"
                                        data-light="images/logo/virtuous-woman-logo.png" data-dark="images/logo/virtuous-woman-logo.png"
                                        data-width="154px" data-height="52px" data-retina="images/logo/virtuous-woman-logo.png">
                                </a>
                                <div class="button-show-hide">
                                    <i class="icon-menu-left"></i>
                                </div>

                                <form class="form-search flex-grow">
                                    <fieldset class="name">
                                        <input type="text" placeholder="Search empowerment products..." class="show-search" name="name"
                                            tabindex="2" value="" aria-required="true" required="">
                                    </fieldset>
                                    <div class="button-submit">
                                        <button class="" type="submit"><i class="icon-search"></i></button>
                                    </div>
                                    <div class="box-content-search" id="box-content-search">
                                        <ul class="mb-24">
                                            <li class="mb-14">
                                                <div class="body-title virtuous-search-title">Top Empowerment Products</div>
                                            </li>
                                            <li class="mb-14">
                                                <div class="divider"></div>
                                            </li>
                                            <li>
                                                <ul>
                                                    <!-- Conserve les images originales -->
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="images/products/17.png" alt="Empowerment Dress">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text virtuous-product-name">Empowerment Silk Dress</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="images/products/18.png" alt="Community Blouse">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text virtuous-product-name">Community Comfort Blouse</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <!-- Ajouter d'autres produits avec noms adaptés -->
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </form>

                            </div>
                            <div class="header-grid">

                                <div class="popup-wrap message type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle virtuous-notification-btn" type="button"
                                            id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-item">
                                                <span class="text-tiny virtuous-notification-count">1</span>
                                                <i class="icon-bell"></i>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content virtuous-notification-dropdown"
                                            aria-labelledby="dropdownMenuButton2">
                                            <li>
                                                <h6 class="virtuous-dropdown-title">Notifications</h6>
                                            </li>
                                            <li>
                                                <div class="message-item item-1">
                                                    <div class="image virtuous-notification-icon">
                                                        <i class="icon-noti-1"></i>
                                                    </div>
                                                    <div>
                                                        <div class="body-title-2">Empowerment Discount Available</div>
                                                        <div class="text-tiny">Special offer for our community members</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="message-item item-2">
                                                    <div class="image virtuous-notification-icon">
                                                        <i class="icon-noti-2"></i>
                                                    </div>
                                                    <div>
                                                        <div class="body-title-2">New Sisterhood Member</div>
                                                        <div class="text-tiny">Welcome to our empowerment community</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- Continuer avec les autres notifications -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="popup-wrap user type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle virtuous-user-btn" type="button"
                                            id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-user wg-user virtuous-admin-user">
                                                <span class="image">
                                                    <img src="images/avatar/user-1.png" alt="Admin">
                                                </span>
                                                <span class="flex flex-column">
                                                    <span class="body-title mb-2">Community Manager</span>
                                                    <span class="text-tiny virtuous-admin-role">Admin</span>
                                                </span>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content virtuous-user-dropdown"
                                            aria-labelledby="dropdownMenuButton3">
                                            <li>
                                                <a href="#" class="user-item virtuous-dropdown-item">
                                                    <div class="icon">
                                                        <i class="icon-user"></i>
                                                    </div>
                                                    <div class="body-title-2">My Profile</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="user-item virtuous-dropdown-item">
                                                    <div class="icon">
                                                        <i class="icon-mail"></i>
                                                    </div>
                                                    <div class="body-title-2">Community Messages</div>
                                                    <div class="number virtuous-message-count">27</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="user-item virtuous-dropdown-item">
                                                    <div class="icon">
                                                        <i class="icon-file-text"></i>
                                                    </div>
                                                    <div class="body-title-2">Empowerment Tasks</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="login.html" class="user-item virtuous-dropdown-item">
                                                    <div class="icon">
                                                        <i class="icon-log-out"></i>
                                                    </div>
                                                    <div class="body-title-2">Log out</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="main-content">

                        @yield('content')


                        <div class="bottom-page virtuous-footer">
                            <div class="body-text">© 2024 Virtuous Woman - Empowerment Community, Style. All rights reserved.</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>   
    <script src="{{asset('js/sweetalert.min.js')}}"></script>    
    <script src="{{asset('js/apexcharts/apexcharts.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script>
        (function ($) {

            var tfLineChart = (function () {

                var chartBar = function () {

                    var options = {
                        series: [{
                            name: 'Total',
                            data: [0.00, 0.00, 0.00, 0.00, 0.00, 273.22, 208.12, 0.00, 0.00, 0.00, 0.00, 0.00]
                        }, {
                            name: 'Pending',
                            data: [0.00, 0.00, 0.00, 0.00, 0.00, 273.22, 208.12, 0.00, 0.00, 0.00, 0.00, 0.00]
                        },
                        {
                            name: 'Delivered',
                            data: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00]
                        }, {
                            name: 'Canceled',
                            data: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00]
                        }],
                        chart: {
                            type: 'bar',
                            height: 325,
                            toolbar: {
                                show: false,
                            },
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '10px',
                                endingShape: 'rounded'
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        legend: {
                            show: false,
                        },
                        colors: ['#FF6800', '#FF8C42', '#078407', '#FF0000'], // Orange Virtuous Woman
                        stroke: {
                            show: false,
                        },
                        xaxis: {
                            labels: {
                                style: {
                                    colors: '#2C2C2C',
                                    fontFamily: "'Jost', sans-serif",
                                },
                            },
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        },
                        yaxis: {
                            show: false,
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return "$ " + val + ""
                                }
                            },
                            style: {
                                fontFamily: "'Jost', sans-serif",
                            }
                        }
                    };

                    chart = new ApexCharts(
                        document.querySelector("#line-chart-8"),
                        options
                    );
                    if ($("#line-chart-8").length > 0) {
                        chart.render();
                    }
                };

                return {
                    init: function () { },
                    load: function () {
                        chartBar();
                    },
                    resize: function () { },
                };
            })();

            jQuery(document).ready(function () { });

            jQuery(window).on("load", function () {
                tfLineChart.load();
            });

            jQuery(window).on("resize", function () { });
        })(jQuery);
    </script>
     @stack("scripts")

    <style>
        /* Styles Virtuous Woman pour l'administration */
        :root {
            --virtuous-orange: #FF6800;
            --virtuous-orange-light: #FF8C42;
            --virtuous-orange-lighter: #FFA500;
            --virtuous-dark: #2C2C2C;
            --virtuous-light: #F8F8F8;
            --virtuous-success: #078407;
            --virtuous-danger: #FF0000;
        }

        /* Menu latéral */
        .virtuous-admin-menu {
            border-right: 3px solid var(--virtuous-orange);
        }

        .logo__image {
            filter: none !important; /* Supprime les filtres éventuels */
            border-radius: 50% !important; /* Supprime les bordures arrondies éventuelles */
            width: 70px !important; /* Ajuste la taille du logo */
        }

        .virtuous-admin-menu .box-logo {
            background: rgba(255, 104, 0, 0.1);
            border-bottom: 1px solid rgba(255, 104, 0, 0.2);
        }

        .virtuous-menu-link {
            color: #ffffff !important;
            transition: all 0.3s ease;
        }

        .virtuous-menu-link:hover {
            background: rgba(255, 104, 0, 0.2) !important;
            color: var(--virtuous-orange) !important;
            border-left: 3px solid var(--virtuous-orange);
        }

        .virtuous-submenu-link {
            color: #cccccc !important;
        }

        .virtuous-submenu-link:hover {
            color: var(--virtuous-orange) !important;
        }

        /* Header */
        .virtuous-admin-header {
            background: white;
            border-bottom: 2px solid var(--virtuous-orange);
            box-shadow: 0 2px 10px rgba(255, 104, 0, 0.1);
        }

        .virtuous-notification-btn {
            background: transparent !important;
            border: 1px solid var(--virtuous-orange) !important;
            color: var(--virtuous-orange) !important;
        }

        .virtuous-notification-count {
            background: var(--virtuous-orange);
            color: white;
        }

        .virtuous-user-btn {
            background: transparent !important;
            border: 1px solid var(--virtuous-dark) !important;
        }

        .virtuous-admin-role {
            color: var(--virtuous-orange);
        }

        /* Cartes de statistiques */
        .virtuous-stat-card {
            background: white;
            border: 1px solid #eaeaea;
            border-radius: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .virtuous-stat-card:hover {
            border-color: var(--virtuous-orange);
            box-shadow: 0 5px 15px rgba(255, 104, 0, 0.1);
            transform: translateY(-2px);
        }

        .virtuous-stat-icon {
            background: rgba(255, 104, 0, 0.1) !important;
            color: var(--virtuous-orange) !important;
        }

        .virtuous-stat-number {
            color: var(--virtuous-orange);
            font-size: 1.8rem;
            font-weight: bold;
        }

        /* Graphique */
        .virtuous-chart-box {
            background: white;
            border: 1px solid #eaeaea;
            border-radius: 10px;
            border-top: 3px solid var(--virtuous-orange);
        }

        .virtuous-chart-title {
            color: var(--virtuous-dark);
            border-bottom: 2px solid var(--virtuous-orange);
            padding-bottom: 10px;
        }

        .virtuous-legend-dot.t1 {
            background: var(--virtuous-orange) !important;
        }

        .virtuous-legend-dot.t2 {
            background: var(--virtuous-orange-light) !important;
        }

        .virtuous-revenue-number {
            color: var(--virtuous-orange);
        }

        .virtuous-trending {
            background: rgba(7, 132, 7, 0.1) !important;
            color: var(--virtuous-success) !important;
        }

        /* Table */
        .virtuous-table-box {
            border: 1px solid #eaeaea;
            border-radius: 10px;
            border-top: 3px solid var(--virtuous-orange);
        }

        .virtuous-table-title {
            color: var(--virtuous-dark);
        }

        .virtuous-table-header {
            background: rgba(255, 104, 0, 0.05) !important;
        }

        .virtuous-table-header th {
            color: var(--virtuous-dark) !important;
            font-weight: 600;
            border-bottom: 2px solid var(--virtuous-orange) !important;
        }

        .virtuous-table-row:hover {
            background: rgba(255, 104, 0, 0.03) !important;
        }

        .virtuous-total-amount {
            color: var(--virtuous-orange);
            font-weight: bold;
        }

        .virtuous-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .virtuous-status.ordered {
            background: rgba(255, 104, 0, 0.1);
            color: var(--virtuous-orange);
            border: 1px solid var(--virtuous-orange);
        }

        .virtuous-action-link:hover .virtuous-view-icon {
            background: var(--virtuous-orange);
            color: white;
        }

        /* Boutons */
        .virtuous-view-all-btn {
            background: var(--virtuous-orange) !important;
            color: white !important;
            border: none !important;
        }

        .virtuous-view-all-btn:hover {
            background: var(--virtuous-orange-light) !important;
        }

        /* Footer */
        .virtuous-footer {
            background: var(--virtuous-dark);
            color: white;
            border-top: 2px solid var(--virtuous-orange);
        }

        /* Dropdowns */
        .virtuous-notification-dropdown,
        .virtuous-user-dropdown,
        .virtuous-dropdown-menu {
            border: 1px solid var(--virtuous-orange) !important;
            box-shadow: 0 5px 15px rgba(255, 104, 0, 0.1) !important;
        }

        .virtuous-dropdown-title {
            color: var(--virtuous-orange);
            border-bottom: 1px solid rgba(255, 104, 0, 0.2);
            padding-bottom: 10px;
        }

        .virtuous-dropdown-item:hover {
            background: rgba(255, 104, 0, 0.1) !important;
            color: var(--virtuous-orange) !important;
        }

        .virtuous-notification-icon {
            color: var(--virtuous-orange);
        }

        .virtuous-message-count {
            background: var(--virtuous-orange);
            color: white;
        }

        /* Search */
        .virtuous-search-title {
            color: var(--virtuous-orange);
        }

        .virtuous-product-name:hover {
            color: var(--virtuous-orange) !important;
        }

        /* Typographie */
        body {
            font-family: 'Jost', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Jost', sans-serif;
            font-weight: 600;
        }
    </style>
</body>

</html>
