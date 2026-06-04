<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="keyword" content="" />
    <meta name="author" content="flexilecode" />

    <title><?= $title ?? 'Dashboard' ?> - Fine Gas Admin</title>

    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('public/assets_admin/images/favicon.ico') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets_admin/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets_admin/vendors/css/vendors.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets_admin/css/theme.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('public/assets_admin/css/daterangepicker.min.css') ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <style>
        /*
         * Bootstrap modal fix for this admin template.
         * Some template containers/sidebar/header create a stacking context that can cause
         * the backdrop to sit above the modal, making the modal look blurred/disabled.
         */
        .modal {
            z-index: 1095 !important;
        }

        .modal-backdrop {
            z-index: 1090 !important;
        }

        body.modal-open .nxl-container,
        body.modal-open .nxl-navigation,
        body.modal-open .nxl-header,
        body.modal-open .page-header,
        body.modal-open .main-content {
            filter: none !important;
            backdrop-filter: none !important;
        }

        .modal-dialog {
            pointer-events: auto;
        }

        .modal-content {
            position: relative;
            z-index: 1100 !important;
        }

        @media (max-width: 575.98px) {
            .page-header-left {
                align-items: flex-start !important;
                flex-direction: column;
                gap: .35rem;
            }

            .main-content {
                padding-left: .75rem;
                padding-right: .75rem;
            }

            .modal-dialog {
                margin: .75rem;
            }
        }

        /*
|--------------------------------------------------------------------------
| GLOBAL NOTIFICATIONS
|--------------------------------------------------------------------------
*/

        #notificationContainer {

            position: fixed;

            top: 20px;

            right: 20px;

            z-index: 999999;

            display: flex;

            flex-direction: column;

            gap: 12px;
        }

        .app-notification {

            min-width: 320px;

            max-width: 420px;

            padding: 16px 18px;

            border-radius: 14px;

            color: #fff;

            font-size: .95rem;

            font-weight: 500;

            box-shadow:
                0 10px 30px rgba(0, 0, 0, .15);

            display: flex;

            align-items: center;

            gap: 12px;

            animation:
                slideInRight .3s ease;
        }

        .app-notification.success {

            background: linear-gradient(135deg,
                    #16a34a,
                    #22c55e);
        }

        .app-notification.error {

            background: linear-gradient(135deg,
                    #dc2626,
                    #ef4444);
        }

        .app-notification.warning {

            background: linear-gradient(135deg,
                    #d97706,
                    #f59e0b);
        }

        .app-notification.info {

            background: linear-gradient(135deg,
                    #2563eb,
                    #3b82f6);
        }

        .app-notification-icon {

            font-size: 1.1rem;
        }

        .app-notification-content {

            flex: 1;
        }

        .app-notification-close {

            cursor: pointer;

            font-size: 18px;

            opacity: .8;

            transition: .2s;
        }

        .app-notification-close:hover {

            opacity: 1;
        }

        @keyframes slideInRight {

            from {

                opacity: 0;

                transform: translateX(100%);
            }

            to {

                opacity: 1;

                transform: translateX(0);
            }
        }

        @media (max-width: 576px) {

            #notificationContainer {

                left: 10px;

                right: 10px;

                top: 10px;
            }

            .app-notification {

                min-width: auto;

                width: 100%;
            }
        }


        .dropdown-menu {

            z-index: 99999 !important;
        }

        .navbar,
        .header,
        .topbar {

            overflow: visible !important;
        }

        .card,
        .page-wrapper,
        .main-content {

            overflow: visible !important;
        }

        /*
|--------------------------------------------------------------------------
| FIX MOBILE USER DROPDOWN
|--------------------------------------------------------------------------
*/

        .dropdown-menu.nxl-user-dropdown {

            z-index: 999999 !important;

            position: absolute !important;
        }

        .nxl-header,
        .nxl-container,
        .nxl-navigation,
        .nxl-navbar,
        .header-wrapper,
        .topbar,
        .navbar,
        .card {

            overflow: visible !important;
        }

        /*
|--------------------------------------------------------------------------
| MOBILE FIX
|--------------------------------------------------------------------------
*/

        @media (max-width: 991px) {
            .dropdown-menu.nxl-user-dropdown {

                right: 0 !important;

                left: auto !important;

                min-width: 300px;

                transform: none !important;
            }
        }
    </style>

    <?= $this->renderSection('styles') ?>
</head>

<body>
    <!--! ================================================================ !-->
    <!--! [Start] Navigation Menu !-->
    <!--! ================================================================ !-->
    <?= $this->include('admin/admin_partials/sidebar') ?>
    <!--! ================================================================ !-->
    <!--! [End] Navigation Menu !-->
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
                        <h5 class="m-b-10"><?= $pageTitle ?? $title ?? 'Dashboard' ?></h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><?= $pageTitle ?? $title ?? 'Dashboard' ?></li>
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

                <?= $this->renderSection('content') ?>
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
            <p>
                <span>By: <a target="_blank" href="https://wrapbootstrap.com/user/theme_ocean">theme_ocean</a></span>
                •
                <span>Distributed by: <a target="_blank" href="https://themewagon.com">ThemeWagon</a></span>
            </p>
        </footer>
        <!-- [ Footer ] end -->
    </main>

    <!-- ========================================================= -->
    <!-- GLOBAL TOAST NOTIFICATION -->
    <!-- ========================================================= -->

    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index:99999;">

        <div id="globalToast" class="toast align-items-center border-0" role="alert" aria-live="assertive"
            aria-atomic="true">

            <div class="d-flex">

                <div class="toast-body" id="globalToastMessage">

                    Notification

                </div>

                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast">
                </button>

            </div>

        </div>

    </div>

    <script src="<?= base_url('public/assets_admin/js/jquery-3.7.1.min.js') ?>"></script>
    <script src="<?= base_url('public/assets_admin/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('public/assets_admin/vendors/js/vendors.min.js') ?>"></script>

    <!-- REQUIRED -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
    <script src="<?= base_url('public/assets_admin/js/daterangepicker.min.js') ?>"></script>

    <script src="<?= base_url('public/assets_admin/vendors/js/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('public/assets_admin/vendors/js/circle-progress.min.js') ?>"></script>

    <script src="<?= base_url('public/assets_admin/js/common-init.min.js') ?>"></script>
    <script src="<?= base_url('public/assets_admin/js/dashboard-init.min.js') ?>"></script>
    <script src="<?= base_url('public/assets_admin/js/theme-customizer-init.min.js') ?>"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <!-- ========================================================= -->
    <!-- GLOBAL OVERLAY -->
    <!-- ========================================================= -->

    <div id="globalOverlay" style="
        display:none;
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:rgba(255,255,255,0.7);
        z-index:99999;
        backdrop-filter: blur(2px);
    ">

        <div class="d-flex justify-content-center align-items-center h-100">

            <div class="text-center">

                <div class="spinner-border text-primary" style="width:3rem;height:3rem;">

                </div>

                <div class="mt-3 fw-semibold text-dark">

                    Processing...

                </div>

            </div>

        </div>

    </div>

    <script>
        /*
        |--------------------------------------------------------------------------
        | SHOW OVERLAY
        |--------------------------------------------------------------------------
        */

        window.showOverlay = function() {
            $('#globalOverlay').fadeIn(150);
        };

        /*
        |--------------------------------------------------------------------------
        | HIDE OVERLAY
        |--------------------------------------------------------------------------
        */

        window.hideOverlay = function() {
            $('#globalOverlay').fadeOut(150);
        };
    </script>

    <script>
        window.showToast = function(
            message,
            success = true
        ) {

            const toastElement =
                document.getElementById('globalToast');

            const toastMessage =
                document.getElementById('globalToastMessage');

            /*
            |--------------------------------------------------------------------------
            | SET MESSAGE
            |--------------------------------------------------------------------------
            */

            toastMessage.innerHTML = message;

            /*
            |--------------------------------------------------------------------------
            | SUCCESS / ERROR STYLE
            |--------------------------------------------------------------------------
            */

            toastElement.classList.remove(
                'bg-success',
                'bg-danger',
                'text-white'
            );

            if (success) {

                toastElement.classList.add(
                    'bg-success',
                    'text-white'
                );

            } else {

                toastElement.classList.add(
                    'bg-danger',
                    'text-white'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | SHOW TOAST
            |--------------------------------------------------------------------------
            */

            const toast =
                new bootstrap.Toast(
                    toastElement, {
                        delay: 4000
                    }
                );

            toast.show();
        };
    </script>


    <!-- ========================================================= -->
    <!-- GLOBAL NOTIFICATIONS -->
    <!-- ========================================================= -->

    <div id="notificationContainer"></div>


    <script>
        window.showNotification = function(
            message,
            type = 'success'
        ) {

            /*
            |--------------------------------------------------------------------------
            | COLORS
            |--------------------------------------------------------------------------
            */

            const colors = {

                success: '#16a34a',

                error: '#dc2626',

                warning: '#d97706',

                info: '#2563eb'
            };

            /*
            |--------------------------------------------------------------------------
            | ICONS
            |--------------------------------------------------------------------------
            */

            const icons = {

                success: '✓',

                error: '✕',

                warning: '⚠',

                info: 'ℹ'
            };

            /*
            |--------------------------------------------------------------------------
            | CREATE NOTIFICATION
            |--------------------------------------------------------------------------
            */

            const notification =
                document.createElement('div');

            /*
            |--------------------------------------------------------------------------
            | INLINE STYLES
            |--------------------------------------------------------------------------
            */

            notification.style.position =
                'fixed';

            notification.style.top =
                '20px';

            notification.style.right =
                '20px';

            notification.style.zIndex =
                '999999';

            notification.style.background =
                colors[type] || '#16a34a';

            notification.style.color =
                '#ffffff';

            notification.style.padding =
                '16px 20px';

            notification.style.borderRadius =
                '12px';

            notification.style.boxShadow =
                '0 10px 30px rgba(0,0,0,.2)';

            notification.style.fontWeight =
                '500';

            notification.style.fontSize =
                '.95rem';

            notification.style.minWidth =
                '320px';

            notification.style.maxWidth =
                '420px';

            notification.style.display =
                'flex';

            notification.style.alignItems =
                'center';

            notification.style.gap =
                '12px';

            notification.style.transition =
                '.3s ease';

            notification.style.opacity =
                '1';

            /*
            |--------------------------------------------------------------------------
            | CONTENT
            |--------------------------------------------------------------------------
            */

            notification.innerHTML = `

        <div style="
            font-size:18px;
            font-weight:bold;
        ">

            ${icons[type] || 'ℹ'}

        </div>

        <div style="
            flex:1;
        ">

            ${message}

        </div>

        <div style="
            cursor:pointer;
            font-size:18px;
            font-weight:bold;
        " class="notification-close">

            &times;

        </div>
    `;

            /*
            |--------------------------------------------------------------------------
            | APPEND TO BODY
            |--------------------------------------------------------------------------
            */

            document.body.appendChild(
                notification
            );

            /*
            |--------------------------------------------------------------------------
            | CLOSE BUTTON
            |--------------------------------------------------------------------------
            */

            notification
                .querySelector(
                    '.notification-close'
                )
                .addEventListener(
                    'click',
                    function() {

                        notification.remove();
                    }
                );

            /*
            |--------------------------------------------------------------------------
            | AUTO REMOVE
            |--------------------------------------------------------------------------
            */

            setTimeout(function() {

                notification.style.opacity =
                    '0';

                setTimeout(function() {

                    notification.remove();

                }, 300);

            }, 4000);
        };
    </script>

    <!-- ========================================================= -->
    <!-- PAGE SCRIPTS -->
    <!-- ========================================================= -->
    <?= $this->renderSection('scripts') ?>
</body>

</html>