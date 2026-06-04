<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="theme_ocean">
    <!--! The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags !-->
    <!--! BEGIN: Apps Title-->
    <title>Duralux || Reset Minimal</title>
    <!--! END:  Apps Title-->
    <!--! BEGIN: Favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('public/assets_admin/images/favicon.ico') ?>" />

    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets_admin/css/bootstrap.min.css') ?>" />

    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets_admin/vendors/css/vendors.min.css') ?>" />

    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets_admin/css/theme.min.css') ?>" />
    <!-- Google Fonts -->
    <!-- <link rel="stylesheet" -->
    <!-- href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap"> -->

    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> -->

    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->

    <!-- AdminLTE -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css"> -->
    <style>
        :root {
            --brand-color: #395555;
        }

        .btn-primary {
            background-color: var(--brand-color) !important;
            border-color: var(--brand-color) !important;
        }

        .auth-header .b-brand img {
            height: 50px;
        }

        .overlay-loader {
            background: rgba(255, 255, 255, .75);
            z-index: 9999;
        }

        .toast {
            min-width: 320px;
        }
    </style>
</head>

<body>
    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    <main class="auth-minimal-wrapper">
        <div class="auth-minimal-inner">
            <div class="minimal-card-wrapper">
                <div class="card mb-4 mt-5 mx-4 mx-sm-0 position-relative">
                    <!-- Overlay -->
                    <div id="overlay" class="overlay-loader position-absolute top-0 start-0 w-100 h-100 d-none">

                        <div class="d-flex justify-content-center align-items-center h-100">

                            <div class="spinner-border text-primary"></div>

                        </div>

                    </div>
                    <div
                        class="wd-50 bg-white p-2 rounded-circle shadow-lg position-absolute translate-middle top-0 start-50">
                        <img src="<?= base_url('public/assets_admin/images/logo-abbr.png') ?>" alt="" class="img-fluid">
                    </div>
                    <div class="card-body p-sm-5">
                        <h2 class="fs-20 fw-bolder mb-4"> Reset your password</h2>
                        <!-- <h4 class="fs-13 fw-bold mb-2">Reset to your username/password</h4> -->
                        <p class="fs-14 fw-medium text-muted">Enter your email and a reset link will be sent to
                            you.</p>
                        <form id="forgotPasswordForm" class="w-100 mt-4 pt-2">
                            <?= csrf_field() ?>
                            <div class="mb-4">
                                <label class="form-label">
                                    Email Address
                                </label>
                                <input class="form-control" id="email" name="email" placeholder="Email">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mt-5">
                                <button type="submit" id="submitBtn" class="btn btn-lg btn-primary w-100"> Send Reset
                                    Link</button>
                            </div>
                        </form>
                        <div class="mt-5 text-muted">
                            <span> Remember account?</span>
                            <a href="<?= base_url('login') ?>" class="fw-bold">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Toast -->
    <div class="toast-container position-fixed top-0 end-0 p-3">

        <div id="appToast" class="toast border-0">

            <div class="toast-header">

                <strong class="me-auto">
                    Notification
                </strong>

                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>

            </div>

            <div class="toast-body"></div>

        </div>

    </div>
    <!--! ================================================================ !-->
    <!--! [End] Main Content !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->

    <!--! ================================================================ !-->
    <!--! Footer Script !-->
    <!--! ================================================================ !-->

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->
    <!--! BEGIN: Vendors JS !-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url('public/assets_admin/vendors/js/nxlNavigation.min.js') ?>"></script>
    <!--! END: Theme Customizer !-->

    <script>
        $(document).ready(function() {

            const form = $('#forgotPasswordForm');

            const overlay = $('#overlay');

            const submitBtn = $('#submitBtn');

            /*
            |--------------------------------------------------------------------------
            | TOAST
            |--------------------------------------------------------------------------
            */

            function showToast(message, success = true) {
                const toastEl = $('#appToast');

                toastEl.removeClass(
                    'bg-success bg-danger text-white'
                );

                toastEl.addClass(
                    success ?
                    'bg-success text-white' :
                    'bg-danger text-white'
                );

                toastEl.find('.toast-body').html(message);

                toastEl.toast({
                    delay: 4000
                });

                toastEl.toast('show');
            }

            /*
            |--------------------------------------------------------------------------
            | FORM SUBMIT
            |--------------------------------------------------------------------------
            */

            form.on('submit', function(e) {

                e.preventDefault();

                $('.is-invalid').removeClass('is-invalid');

                $('.invalid-feedback').html('');

                overlay.removeClass('d-none');

                submitBtn.prop('disabled', true);

                $.ajax({

                    url: "<?= base_url('forgot-password') ?>",

                    type: "POST",

                    data: form.serialize(),

                    dataType: "json",

                    success: function(response) {
                        overlay.addClass('d-none');

                        submitBtn.prop('disabled', false);

                        /*
                        |--------------------------------------------------------------------------
                        | VALIDATION ERRORS
                        |--------------------------------------------------------------------------
                        */

                        if (!response.status) {
                            if (response.errors) {
                                $.each(response.errors, function(key, value) {

                                    const input = $('[name="' + key + '"]');

                                    input.addClass('is-invalid');

                                    input.siblings('.invalid-feedback')
                                        .html(value);
                                });
                            }

                            showToast(
                                response.message || 'Request failed',
                                false
                            );

                            return;
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | SUCCESS
                        |--------------------------------------------------------------------------
                        */

                        showToast(response.message);

                        form.trigger('reset');
                    },

                    error: function() {
                        overlay.addClass('d-none');

                        submitBtn.prop('disabled', false);

                        showToast(
                            'Server error occurred',
                            false
                        );
                    }

                });

            });

        });
    </script>
</body>

</html>