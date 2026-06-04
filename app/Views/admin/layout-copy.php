<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $title ?? 'Dashboard' ?> - Fine Gas Admin</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('public/assets_admin/images/favicon.ico') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets_admin/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets_admin/css/vendors/vendors.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets_admin/css/theme.min.css') ?>" />
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        :root {
            --brand-color: #395555;
        }

        .btn-primary {
            background-color: var(--brand-color) !important;
            border-color: var(--brand-color) !important;
        }
    </style>
</head>

<body>
    <nav class="nxl-navigation">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="<?= base_url('admin/home') ?>" class="b-brand">
                    <img src="<?= base_url('public/assets_admin/images/logo-full.png') ?>" alt=""
                        class="logo logo-lg" />
                    <img src="<?= base_url('public/assets_admin/images/logo-abbr.png') ?>" alt=""
                        class="logo logo-sm" />
                </a>
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar">
                    <li class="nxl-item nxl-caption">
                        <label>Main</label>
                    </li>
                    <li class="nxl-item">
                        <a href="<?= base_url('admin/home') ?>"
                            class="nxl-link <?= uri_string() == 'admin/home' ? 'active' : '' ?>">
                            <span class="nxl-micon"><i class="feather-airplay"></i></span>
                            <span class="nxl-mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class="nxl-item nxl-caption">
                        <label>Management</label>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-users"></i></span>
                            <span class="nxl-mtext">Users</span><span class="nxl-arrow"><i
                                    class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/users') ?>">All Users</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/users/create') ?>">Add
                                    User</a></li>
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-user-plus"></i></span>
                            <span class="nxl-mtext">Customers</span><span class="nxl-arrow"><i
                                    class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/customers') ?>">All
                                    Customers</a></li>
                            <li class="nxl-item"><a class="nxl-link"
                                    href="<?= base_url('admin/customers/create') ?>">Add Customer</a></li>
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-alert-circle"></i></span>
                            <span class="nxl-mtext">Leads</span><span class="nxl-arrow"><i
                                    class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/leads') ?>">All Leads</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/leads/create') ?>">Add
                                    Lead</a></li>
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-briefcase"></i></span>
                            <span class="nxl-mtext">Products</span><span class="nxl-arrow"><i
                                    class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/products') ?>">All
                                    Products</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/products/create') ?>">Add
                                    Product</a></li>
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-file-text"></i></span>
                            <span class="nxl-mtext">Proposals</span><span class="nxl-arrow"><i
                                    class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/proposals') ?>">All
                                    Proposals</a></li>
                            <li class="nxl-item"><a class="nxl-link"
                                    href="<?= base_url('admin/proposals/create') ?>">Create Proposal</a></li>
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-dollar-sign"></i></span>
                            <span class="nxl-mtext">Invoices</span><span class="nxl-arrow"><i
                                    class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/invoices') ?>">All
                                    Invoices</a></li>
                            <li class="nxl-item"><a class="nxl-link"
                                    href="<?= base_url('admin/invoices/create') ?>">Create Invoice</a></li>
                        </ul>
                    </li>
                    <li class="nxl-item nxl-caption">
                        <label>Reports</label>
                    </li>
                    <li class="nxl-item">
                        <a href="<?= base_url('admin/reports/sales') ?>" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-bar-chart"></i></span>
                            <span class="nxl-mtext">Sales Report</span>
                        </a>
                    </li>
                    <li class="nxl-item">
                        <a href="<?= base_url('admin/reports/leads') ?>" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-target"></i></span>
                            <span class="nxl-mtext">Leads Report</span>
                        </a>
                    </li>
                    <li class="nxl-item nxl-caption">
                        <label>Settings</label>
                    </li>
                    <li class="nxl-item">
                        <a href="<?= base_url('admin/settings') ?>" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-settings"></i></span>
                            <span class="nxl-mtext">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="nxl-header">
        <div class="header-wrapper">
            <div class="header-left d-flex align-items-center gap-4">
                <a href="javascript:void(0);" class="nxl-head-mobile-toggler" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
                <div class="nxl-navigation-toggle">
                    <a href="javascript:void(0);" id="menu-mini-button">
                        <i class="feather-align-left"></i>
                    </a>
                </div>
            </div>
            <div class="header-right ms-auto">
                <div class="d-flex align-items-center">
                    <div class="nxl-h-item dark-light-theme">
                        <a href="javascript:void(0);" class="nxl-head-link me-0 dark-button">
                            <i class="feather-moon"></i>
                        </a>
                        <a href="javascript:void(0);" class="nxl-head-link me-0 light-button" style="display:none">
                            <i class="feather-sun"></i>
                        </a>
                    </div>
                    <div class="dropdown nxl-h-item">
                        <a href="javascript:void(0);" class="nxl-head-link me-3" data-bs-toggle="dropdown">
                            <i class="feather-bell"></i>
                            <span class="badge bg-danger nxl-h-badge">3</span>
                        </a>
                    </div>
                    <div class="dropdown nxl-h-item">
                        <a href="javascript:void(0);" class="nxl-head-link me-0" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside">
                            <img src="<?= base_url('public/assets_admin/images/avatar/1.png') ?>" alt=""
                                class="img-fluid wd-32 ht-32 rounded-circle" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-profile-dropdown">
                            <div class="dropdown-header">
                                <h6 class="dropdown-title"><?= session()->get('admin_name') ?? 'Admin User' ?></h6>
                                <span class="dropdown-subtitle">Administrator</span>
                            </div>
                            <div class="dropdown-body">
                                <a href="<?= base_url('admin/profile') ?>" class="dropdown-item">
                                    <i class="feather-user"></i>
                                    <span>Profile</span>
                                </a>
                                <a href="<?= base_url('admin/settings') ?>" class="dropdown-item">
                                    <i class="feather-settings"></i>
                                    <span>Settings</span>
                                </a>
                            </div>
                            <div class="dropdown-footer">
                                <a href="<?= base_url('logout') ?>" class="btn btn-primary btnLogout">
                                    <i class="feather-log-out me-2"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left">
                <div class="page-title">
                    <h1 class="h3 mb-0"><?= $title ?? 'Dashboard' ?></h1>
                </div>
            </div>
            <div class="page-header-right ms-auto">
                <div class="d-flex align-items-center gap-3">
                    <?= isset($breadcrumb) ? $breadcrumb : '' ?>
                </div>
            </div>
        </div>

        <div class="main-content">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <script src="<?= base_url('public/assets_admin/js/vendors/vendors.min.js') ?>"></script>
    <script src="<?= base_url('public/assets_admin/js/vendors/daterangepicker.min.js') ?>"></script>
    <script src="<?= base_url('public/assets_admin/js/vendors/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('public/assets_admin/js/vendors/circle-progress.min.js') ?>"></script>
    <script src="<?= base_url('public/assets_admin/js/common-init.min.js') ?>"></script>
    <script src="<?= base_url('public/assets_admin/js/dashboard-init.min.js') ?>"></script>
    <script src="<?= base_url('public/assets_admin/js/theme-customizer-init.min.js') ?>"></script>
</body>

</html>