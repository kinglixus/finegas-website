<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        Forgot Password - Fine Gas Admin
    </title>

    <!-- Google Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">

    <style>
        :root {
            --brand-color: #395555;
        }

        body.login-page {
            background: linear-gradient(135deg,
                    var(--brand-color) 0%,
                    #1e3c72 100%);

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;
        }

        .login-box {
            width: 100%;
            max-width: 420px;
        }

        .overlay-loader {
            background: rgba(255, 255, 255, .75);
            z-index: 9999;
        }

        .toast {
            min-width: 320px;
        }

        .btn-primary {
            background-color: var(--brand-color);
            border-color: var(--brand-color);
        }

        .btn-primary:hover {
            background-color: #2d4444;
            border-color: #2d4444;
        }
    </style>

</head>

<body class="hold-transition login-page">

    <div class="login-box">

        <div class="card card-outline card-primary position-relative">

            <!-- Overlay -->
            <div id="overlay" class="overlay-loader position-absolute top-0 start-0 w-100 h-100 d-none">

                <div class="d-flex justify-content-center align-items-center h-100">

                    <div class="spinner-border text-primary"></div>

                </div>

            </div>

            <!-- Header -->
            <div class="card-header text-center">

                <a href="<?= base_url() ?>" class="h1">

                    <img src="<?= base_url('public/assets/img/thick-logo.png') ?>" alt="Fine Gas Logo"
                        style="height:60px;">

                </a>

            </div>

            <!-- Body -->
            <div class="card-body">

                <p class="login-box-msg">

                    Reset your password

                </p>

                <form id="forgotPasswordForm">

                    <?= csrf_field() ?>

                    <!-- Email -->
                    <div class="form-group">

                        <label for="email">

                            Email Address

                        </label>

                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">

                        <div class="invalid-feedback"></div>

                    </div>

                    <!-- Submit -->
                    <button type="submit" id="submitBtn" class="btn btn-primary btn-block">

                        Send Reset Link

                    </button>

                </form>

                <!-- Footer -->
                <div class="mt-3 text-center">

                    <a href="<?= base_url('login') ?>">

                        Back to Login

                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- Toast -->
    <div class="toast-container position-fixed top-0 end-0 p-3">

        <div id="appToast" class="toast border-0">

            <div class="toast-header">

                <strong class="mr-auto">
                    Notification
                </strong>

                <button type="button" class="close" data-dismiss="toast">

                    <span>&times;</span>

                </button>

            </div>

            <div class="toast-body"></div>

        </div>

    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

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