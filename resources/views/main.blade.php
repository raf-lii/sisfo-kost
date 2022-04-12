<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield("title") | {{ env("APP_NAME") }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- plugins -->
    <link href="/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
    <link href="/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" disabled />

    <!-- icons -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <div class="navbar-custom">
            <div class="container-fluid">
                <ul class="list-unstyled topnav-menu float-end mb-0">

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="/assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
                            <span class="pro-user-name ms-1">
                                Nik Patel <i class="uil uil-angle-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <a href="pages-profile.html" class="dropdown-item notify-item">
                                <i data-feather="user" class="icon-dual icon-xs me-1"></i><span>My Account</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="pages-logout.html" class="dropdown-item notify-item">
                                <i data-feather="log-out" class="icon-dual icon-xs me-1"></i><span>Logout</span>
                            </a>

                        </div>
                    </li>

                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="index-2.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="/assets/images/logo-sm.png" alt="" height="24">
                            <!-- <span class="logo-lg-text-light">Shreyu</span> -->
                        </span>
                        <span class="logo-lg">
                            <img src="/assets/images/logo-dark.png" alt="" height="24">
                            <!-- <span class="logo-lg-text-light">S</span> -->
                        </span>
                    </a>

                    <a href="index-2.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="/assets/images/logo-sm.png" alt="" height="24">
                        </span>
                        <span class="logo-lg">
                            <img src="/assets/images/logo-light.png" alt="" height="24">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile">
                            <i data-feather="menu"></i>
                        </button>
                    </li>

                    <li>
                        <!-- Mobile menu toggle (Horizontal Layout)-->
                        <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <div class="h-100" data-simplebar>

                <!-- User box -->
                <div class="user-box text-center">
                    <img src="/assets/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
                    <div class="dropdown">
                        <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown">Nik Patel</a>
                        <div class="dropdown-menu user-pro-dropdown">

                            <a href="pages-profile.html" class="dropdown-item notify-item">
                                <i data-feather="user" class="icon-dual icon-xs me-1"></i><span>My Account</span>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i data-feather="settings" class="icon-dual icon-xs me-1"></i><span>Settings</span>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i data-feather="help-circle" class="icon-dual icon-xs me-1"></i><span>Support</span>
                            </a>
                            <a href="pages-lock-screen.html" class="dropdown-item notify-item">
                                <i data-feather="lock" class="icon-dual icon-xs me-1"></i><span>Lock Screen</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i data-feather="log-out" class="icon-dual icon-xs me-1"></i><span>Logout</span>
                            </a>

                        </div>
                    </div>
                    <p class="text-muted">Admin Head</p>
                </div>

                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <ul id="side-menu">

                        <!-- <li class="menu-title">Navigation</li> -->

                        <li>
                            <a href="#sidebarDashboard" data-bs-toggle="collapse">
                                <span class="badge bg-success float-end">02</span>
                                <i data-feather="home"></i>
                                <span> Dashboards </span>
                                <!-- <span class="menu-arrow"></span> -->
                            </a>
                            <div class="collapse" id="sidebarDashboard">
                                <ul class="nav-second-level">
                                    <li><a href="index-2.html">Ecommerce</a></li>
                                    <li><a href="dashboard-analytics.html">Analytics</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="menu-title mt-2">Apps</li>

                        <li>
                            <a href="apps-calendar.html">
                                <i data-feather="calendar"></i>
                                <span> Calendar </span>
                            </a>
                        </li>

                        <li>
                            <a href="apps-chat.html">
                                <i data-feather="message-square"></i>
                                <span> Chat </span>
                            </a>
                        </li>

                        <li>
                            <a href="#sidebarEmail" data-bs-toggle="collapse">
                                <i data-feather="mail"></i>
                                <span> Email </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEmail">
                                <ul class="nav-second-level">
                                    <li><a href="email-inbox.html">Inbox</a></li>
                                    <li><a href="email-read.html">Read Email</a></li>
                                    <li><a href="email-compose.html">Compose Email</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarProjects" data-bs-toggle="collapse">
                                <i data-feather="briefcase"></i>
                                <span> Projects </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarProjects">
                                <ul class="nav-second-level">
                                    <li><a href="project-list.html">List</a></li>
                                    <li><a href="project-detail.html">Detail</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarTasks" data-bs-toggle="collapse">
                                <i data-feather="clipboard"></i>
                                <span> Tasks </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarTasks">
                                <ul class="nav-second-level">
                                    <li><a href="task-list.html">List</a></li>
                                    <li><a href="task-board.html">Kanban Board</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="apps-file-manager.html">
                                <i data-feather="file-plus"></i>
                                <span> File Manager </span>
                            </a>
                        </li>

                        <li class="menu-title mt-2">Custom</li>

                        <li>
                            <a href="#sidebarExpages" data-bs-toggle="collapse">
                                <i data-feather="file-text"></i>
                                <span> Pages </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarExpages">
                                <ul class="nav-second-level">
                                    <li><a href="pages-starter.html">Starter</a></li>
                                    <li><a href="pages-profile.html">Profile</a></li>
                                    <li><a href="pages-activity.html">Activity</a></li>
                                    <li><a href="pages-invoice.html">Invoice</a></li>
                                    <li><a href="pages-pricing.html">Pricing</a></li>
                                    <li><a href="pages-maintenance.html">Maintenance</a></li>
                                    <li><a href="pages-login.html">Login</a></li>
                                    <li><a href="pages-register.html">Register</a></li>
                                    <li><a href="pages-logout.html">Logout</a></li>
                                    <li><a href="pages-recoverpw.html">Recover Password</a></li>
                                    <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                                    <li><a href="pages-confirm-mail.html">Confirm</a></li>
                                    <li><a href="pages-404.html">Error 404</a></li>
                                    <li><a href="pages-500.html">Error 500</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarLayouts" data-bs-toggle="collapse">
                                <i data-feather="layout"></i>
                                <span class="badge bg-danger float-end">New</span>
                                <span> Layouts </span>
                            </a>
                            <div class="collapse" id="sidebarLayouts">
                                <ul class="nav-second-level">
                                    <li><a href="layouts-horizontal.html">Horizontal</a></li>
                                    <li><a href="layouts-detached.html">Detached</a></li>
                                    <li><a href="layouts-two-column.html">Two Column Menu</a></li>
                                    <li><a href="layouts-preloader.html">Preloader</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="menu-title mt-2">Components</li>

                        <li>
                            <a href="ui-elements.html">
                                <i data-feather="package"></i>
                                <span> UI Elements </span>
                            </a>
                        </li>

                        <li>
                            <a href="widgets.html">
                                <i data-feather="gift"></i>
                                <span> Widgets </span>
                            </a>
                        </li>

                        <li>
                            <a href="#sidebarIcons" data-bs-toggle="collapse">
                                <i data-feather="cpu"></i>
                                <span> Icons </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarIcons">
                                <ul class="nav-second-level">
                                    <li><a href="icons-unicons.html">Unicons</a></li>
                                    <li><a href="icons-feather.html">Feather</a></li>
                                    <li><a href="icons-bootstrap.html">Bootstrap</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarForms" data-bs-toggle="collapse">
                                <i data-feather="bookmark"></i>
                                <span> Forms </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarForms">
                                <ul class="nav-second-level">
                                    <li><a href="forms-basic.html">Basic Elements</a></li>
                                    <li><a href="forms-advanced.html">Advanced</a></li>
                                    <li><a href="forms-validation.html">Validation</a></li>
                                    <li><a href="forms-wizard.html">Wizard</a></li>
                                    <li><a href="forms-editor.html">Editor</a></li>
                                    <li><a href="forms-file-uploads.html">File Uploads</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="charts.html">
                                <i data-feather="bar-chart-2"></i>
                                <span> Charts </span>
                            </a>
                        </li>

                        <li>
                            <a href="#sidebarTables" data-bs-toggle="collapse">
                                <i data-feather="grid"></i>
                                <span> Tables </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarTables">
                                <ul class="nav-second-level">
                                    <li><a href="tables-basic.html">Basic</a></li>
                                    <li><a href="tables-datatables.html">Data Tables</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarMaps" data-bs-toggle="collapse">
                                <i data-feather="map"></i>
                                <span> Maps </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarMaps">
                                <ul class="nav-second-level">
                                    <li><a href="maps-google.html">Google Maps</a></li>
                                    <li><a href="maps-vector.html">Vector Maps</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarMultilevel" data-bs-toggle="collapse">
                                <i data-feather="share-2"></i>
                                <span> Multi Level </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarMultilevel">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="#sidebarMultilevel2" data-bs-toggle="collapse">
                                            Second Level <span class="menu-arrow"></span>
                                        </a>
                                        <div class="collapse" id="sidebarMultilevel2">
                                            <ul class="nav-second-level">
                                                <li><a href="javascript: void(0);">Item 1</a></li>
                                                <li><a href="javascript: void(0);">Item 2</a></li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li>
                                        <a href="#sidebarMultilevel3" data-bs-toggle="collapse">
                                            Third Level <span class="menu-arrow"></span>
                                        </a>
                                        <div class="collapse" id="sidebarMultilevel3">
                                            <ul class="nav-second-level">
                                                <li><a href="javascript: void(0);">Item 1</a></li>
                                                <li>
                                                    <a href="#sidebarMultilevel4" data-bs-toggle="collapse">
                                                        Item 2 <span class="menu-arrow"></span>
                                                    </a>
                                                    <div class="collapse" id="sidebarMultilevel4">
                                                        <ul class="nav-second-level">
                                                            <li><a href="javascript: void(0);">Item 1</a></li>
                                                            <li><a href="javascript: void(0);">Item 2</a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">
                    @yield("content")
                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> &copy; Shreyu theme by <a href="#">Coderthemes</a>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-end footer-links d-none d-sm-block">
                                <a href="javascript:void(0);">About Us</a>
                                <a href="javascript:void(0);">Help</a>
                                <a href="javascript:void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">

            <h6 class="fw-medium px-3 m-0 py-2 text-uppercase bg-light">
                <span class="d-block py-1">Theme Settings</span>
            </h6>

            <div class="p-3">
                <div class="alert alert-warning" role="alert">
                    <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                </div>

                <h6 class="fw-medium mt-4 mb-2 pb-1">Color Scheme</h6>
                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="color-scheme-mode" value="light" id="light-mode-check" checked />
                    <label class="form-check-label" for="light-mode-check">Light Mode</label>
                </div>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="color-scheme-mode" value="dark" id="dark-mode-check" />
                    <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                </div>

                <!-- Width -->
                <h6 class="fw-medium mt-4 mb-2 pb-1">Width</h6>
                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="width" value="fluid" id="fluid-check" checked />
                    <label class="form-check-label" for="fluid-check">Fluid</label>
                </div>
                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="width" value="boxed" id="boxed-check" />
                    <label class="form-check-label" for="boxed-check">Boxed</label>
                </div>

                <!-- Menu positions -->
                <h6 class="fw-medium mt-4 mb-2 pb-1">Menus (Leftsidebar and Topbar) Positon</h6>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="menus-position" value="fixed" id="fixed-check" checked />
                    <label class="form-check-label" for="fixed-check">Fixed</label>
                </div>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="menus-position" value="scrollable" id="scrollable-check" />
                    <label class="form-check-label" for="scrollable-check">Scrollable</label>
                </div>

                <!-- Left Sidebar-->
                <h6 class="fw-medium mt-4 mb-2 pb-1">Left Sidebar Color</h6>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="leftsidebar-color" value="light" id="light-check" checked />
                    <label class="form-check-label" for="light-check">Light</label>
                </div>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="leftsidebar-color" value="dark" id="dark-check" />
                    <label class="form-check-label" for="dark-check">Dark</label>
                </div>

                <!-- size -->
                <h6 class="fw-medium mt-4 mb-2 pb-1">Left Sidebar Size</h6>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="leftsidebar-size" value="default" id="default-size-check" checked />
                    <label class="form-check-label" for="default-size-check">Default</label>
                </div>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="leftsidebar-size" value="condensed" id="condensed-check" />
                    <label class="form-check-label" for="condensed-check">Condensed <small>(Extra Small size)</small></label>
                </div>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="leftsidebar-size" value="compact" id="compact-check" />
                    <label class="form-check-label" for="compact-check">Compact <small>(Small size)</small></label>
                </div>

                <!-- User info -->
                <h6 class="fw-medium mt-4 mb-2 pb-1">Sidebar User Info</h6>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="leftsidebar-user" value="fixed" id="sidebaruser-check" />
                    <label class="form-check-label" for="sidebaruser-check">Enable</label>
                </div>


                <!-- Topbar -->
                <h6 class="fw-medium mt-4 mb-2 pb-1">Topbar</h6>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="topbar-color" value="dark" id="darktopbar-check" checked />
                    <label class="form-check-label" for="darktopbar-check">Dark</label>
                </div>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="topbar-color" value="light" id="lighttopbar-check" />
                    <label class="form-check-label" for="lighttopbar-check">Light</label>
                </div>


                <button class="btn btn-primary w-100 mt-4" id="resetBtn">Reset to Default</button>

                <a href="https://1.envato.market/shreyu_admin" class="btn btn-danger d-block mt-3" target="_blank">
                    <i class="mdi mdi-basket me-1"></i> Purchase Now
                </a>

            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="/assets/js/vendor.min.js"></script>

    <!-- optional plugins -->
    <script src="/assets/libs/moment/min/moment.min.js"></script>
    <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/libs/flatpickr/flatpickr.min.js"></script>

    <!-- page js -->
    <script src="/assets/js/pages/dashboard.init.js"></script>

    <!-- App js -->
    <script src="/assets/js/app.min.js"></script>

</body>

<!-- Mirrored from shreyu.coderthemes.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 10 Apr 2022 09:57:59 GMT -->

</html>