<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta charset="utf-8" />

    <meta http-equiv="x-ua-compatible" content="IE=edge" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Forgot Password - Fine Gas Admin</title>

    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('public/assets_admin/images/favicon.ico') ?>" />

    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets_admin/css/bootstrap.min.css') ?>" />

    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets_admin/vendors/css/vendors.min.css') ?>" />

    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets_admin/css/theme.min.css') ?>" />

    <style>
        :root {
            --brand-color: #395555;
        }

        .btn-primary {
            background-color: var(--brand-color) !important;
            border-color: var(--brand-color) !important;
        }

        .text-primary {
            color: var(--brand-color) !important;
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

    <div class="auth-wrapper">

        <div class="auth-wrapper-inner">

            <div class="auth-wrapper-sidebar">

                <div class="auth-wrapper-sidebar-info text-center">

                    <h1 class="mb-3 text-white">
                        Fine Gas Admin
                    </h1>

                    <p class="mb-0 text-white opacity-75">
                        Reset your password securely
                    </p>

                </div>

            </div>

            <div class="auth-wrapper-content">

                <div class="container">

                    <div class="row justify-content-center">

                        <div class="col-md-8 col-lg-6">

                            <div class="card stretch position-relative">

                                <!-- Overlay -->
                                <div id="overlay"
                                    class="overlay-loader position-absolute top-0 start-0 w-100 h-100 d-none">

                                    <div class="d-flex justify-content-center align-items-center h-100">

                                        <div class="spinner-border text-primary"></div>

                                    </div>

                                </div>

                                <!-- Header -->
                                <div class="card-header">

                                    <div class="auth-header text-center">

                                        <div class="b-brand mb-3">

                                            <img src="<?= base_url('public/assets_admin/images/logo-full.png') ?>"
                                                alt="" class="logo logo-lg" />

                                        </div>

                                        <h4 class="mb-1">
                                            Reset your password
                                        </h4>

                                        <p class="text-muted">
                                            Enter your email address and a reset link will be sent to you.
                                        </p>

                                    </div>

                                </div>

                                <!-- Body -->
                                <div class="card-body">

                                    <form id="forgotPasswordForm">

                                        <?= csrf_field() ?>

                                        <!-- Email -->
                                        <div class="mb-4">

                                            <label class="form-label">
                                                Email Address
                                            </label>

                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="Enter your email">

                                            <div class="invalid-feedback"></div>

                                        </div>

                                        <!-- Submit -->
                                        <button type="submit" id="submitBtn" class="btn btn-primary w-100">

                                            Send Reset Link

                                        </button>

                                    </form>

                                </div>

                                <!-- Footer -->
                                <div class="card-footer text-center">

                                    <p class="text-muted mb-2">

                                        Remember your account?

                                        <a href="<?= base_url('login') ?>" class="fw-bold text-primary">

                                            Login

                                        </a>

                                    </p>

                                    <p class="text-muted mb-0">

                                        &copy; <?= date('Y') ?>
                                        Fine Gas.
                                        All rights reserved.

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url('public/assets_admin/vendors/js/nxlNavigation.min.js') ?>"></script>

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

                new bootstrap.Toast(toastEl[0], {
                    delay: 4000
                }).show();
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

                        showToast(
                            response.message || 'Password reset link sent'
                        );

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