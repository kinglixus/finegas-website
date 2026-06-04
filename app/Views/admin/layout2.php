<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="keyword" content="" />
    <meta name="author" content="flexilecode" />
    <!--! The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags !-->
    <!--! BEGIN: Apps Title-->
    <title><?= $title ?? 'Dashboard' ?> - Fine Gas Admin</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('public/assets_admin/images/favicon.ico') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets_admin/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets_admin/vendors/css/vendors.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets_admin/css/theme.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('public/assets_admin/css/daterangepicker.min.css') ?>">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>



<body>
    <style>
        .modal {
            z-index: 999999 !important;
        }

        .modal-backdrop {
            z-index: 999998 !important;
        }

        .modal-dialog {
            z-index: 999999 !important;
            position: relative;
        }

        .auth-wrapper,
        .main-content,
        .nxl-container,
        .nxl-content {
            transform: none !important;
        }
    </style>
    <!--! ================================================================ !-->
    <!--! [Start] Navigation Manu !-->
    <!--! ================================================================ !-->
    <?= $this->include('admin/admin_partials/sidebar') ?>
    <!--! ================================================================ !-->
    <!--! [End]  Navigation Manu !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! [Start] Header !-->
    <!--! ================================================================ !-->
    <?= $this->include('admin/admin_partials/header') ?>
    <!--! ================================================================ !-->
    <!--! [End] Header !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Dashboard</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <div class="d-flex d-md-none">
                            <a href="javascript:void(0)" class="page-header-right-close-toggle">
                                <i class="feather-arrow-left me-2"></i>
                                <span>Back</span>
                            </a>
                        </div>

                    </div>
                    <div class="d-md-none d-flex align-items-center">
                        <a href="javascript:void(0)" class="page-header-right-open-toggle">
                            <i class="feather-align-right fs-20"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- [ page-header ] end -->
            <!-- [ Main Content ] start -->
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


                <div class="row">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
        <!-- [ Footer ] start -->
        <footer class="footer">
            <p class="fs-11 text-muted fw-medium text-uppercase mb-0 copyright">
                <span>Copyright ©</span>
                <script>
                    document.write(new Date().getFullYear());
                </script>
            </p>
            <p><span>By: <a target="_blank" href="https://wrapbootstrap.com/user/theme_ocean"
                        target="_blank">theme_ocean</a></span> • <span>Distributed by: <a target="_blank"
                        href="https://themewagon.com" target="_blank">ThemeWagon</a></span></p>

        </footer>
        <!-- [ Footer ] end -->
    </main>
    <!--! ================================================================ !-->
    <!--! [End] Main Content !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! BEGIN: Theme Customizer !-->
    <!--! ================================================================ !-->

    <!--! ================================================================ !-->
    <!--! [End] Theme Customizer !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! Footer Script !-->
    <!--! ================================================================ !-->
    <script src="<?= base_url('public/assets_admin/js/jquery-3.7.1.min.js') ?>"></script>
    <script src="<?= base_url('public/assets_admin/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('public/assets_admin/vendors/js/vendors.min.js') ?>"></script>

    <!-- REQUIRED -->
    <script src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
    <script src="<?= base_url('public/assets_admin/js/daterangepicker.min.js') ?>"></script>

    <script src="<?= base_url('public/assets_admin/vendors/js/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('public/assets_admin/vendors/js/circle-progress.min.js') ?>"></script>

    <script src="<?= base_url('public/assets_admin/js/common-init.min.js') ?>"></script>
    <script src="<?= base_url('public/assets_admin/js/dashboard-init.min.js') ?>"></script>
    <script src="<?= base_url('public/assets_admin/js/theme-customizer-init.min.js') ?>"></script>
</body>

</html>