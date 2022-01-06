<title>Administrator</title>
<style>
.std-info td{
    padding: 5px 15px 0 0;
}
</style>
</head>
<body>

<div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">
    <nav id="sidebar" aria-label="Main Navigation" style="background: #333;color: white">
        <!-- Side Header -->
        <div class="content-header bg-white-5">
            <!-- Logo -->
            <a class="font-w600 text-dual" href="">
                MUSFS
            </a>
            <!-- END Logo -->
        </div>
        <!-- END Side Header -->

        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link" href="#">
                        <i class="nav-main-link-icon si si-user"></i>
                        <span class="nav-main-link-name">Profile</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link " href="dashboard.php">
                        <i class="nav-main-link-icon fa fa-dashboard"></i>
                        <span class="nav-main-link-name"> Dashboard</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="registered-students.php">
                        <i class="nav-main-link-icon si si-list"></i>
                        <span class="nav-main-link-name">Users</span>
                    </a>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link" href="new-user.php">
                        <i class="nav-main-link-icon si si-plus"></i>
                        <span class="nav-main-link-name">New user</span>
                    </a>
                </li>

                <li class="nav-main">
                    <span class="nav-main-link">
                        <i class="nav-main-link-icon si si-speedometr"></i>
                        <span class="nav-main-link-name">MORE</span>
                    </span>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="backend/logout.php">
                        <i class="nav-main-link-icon fa fa-sign-out"></i>
                        <span class="nav-main-link-name">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </nav>
    <!-- END Sidebar -->

    <!-- Header -->
    <header id="page-header" style="background:#5c80e1;">
        <!-- Header Content -->
        <div class="content-header">
            <!-- Left Section -->
            <div class="d-flex align-items-center">
                <!-- Toggle Sidebar -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout"
                    data-action="sidebar_toggle">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                <!-- END Toggle Sidebar -->

                <!-- Open Search Section (visible on smaller screens) -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-sm btn-dual d-sm-none" data-toggle="layout"
                    data-action="header_search_on">
                    <i class="si si-magnifier"></i>
                </button>
                <!-- END Open Search Section -->

                <!-- Search Form (visible on larger screens) -->
                <form class="d-none d-sm-inline-block" action="be_pages_generic_search.html" method="POST">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-alt" placeholder="Search.."
                            id="page-header-search-input2" name="page-header-search-input2">
                        <div class="input-group-append">
                            <span class="input-group-text bg-body border-0">
                                <i class="si si-magnifier"></i>
                            </span>
                        </div>
                    </div>
                </form>
                <!-- END Search Form -->
            </div>
            <!-- END Left Section -->
        </div>
        <!-- END Header Content -->

        <!-- Header Search -->
        <div id="page-header-search" class="overlay-header bg-white">
            <div class="content-header">
                <form class="w-100" action="be_pages_generic_search.html" method="POST">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-danger" data-toggle="layout"
                                data-action="header_search_off">
                                <i class="fa fa-fw fa-times-circle"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control" placeholder="Search or hit ESC.."
                            id="page-header-search-input" name="page-header-search-input">
                    </div>
                </form>
            </div>
        </div>
        <!-- END Header Search -->

        
    </header>
    <!-- END Header -->