<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Verification</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --brand-color: #395555;
        }

        body {

            background:
                linear-gradient(135deg,
                    var(--brand-color),
                    #1e3c72);

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;
        }

        .verify-card {

            width: 100%;

            max-width: 450px;
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

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-5 col-md-7">

                <div class="card shadow-lg border-0 verify-card position-relative">

                    <!-- Overlay -->
                    <div id="overlay" class="overlay-loader position-absolute top-0 start-0 w-100 h-100 d-none">

                        <div class="d-flex justify-content-center align-items-center h-100">

                            <div class="spinner-border text-primary"></div>

                        </div>

                    </div>

                    <!-- Header -->
                    <div class="card-header text-center bg-white border-0 pt-4">

                        <h3 class="fw-bold mb-2">

                            Verification Required

                        </h3>

                        <p class="text-muted">

                            Enter the 6-character verification code sent to your email.

                        </p>

                    </div>

                    <!-- Body -->
                    <div class="card-body p-4">

                        <form id="verifyForm">

                            <?= csrf_field() ?>

                            <!-- Code -->
                            <div class="mb-4">

                                <label class="form-label">

                                    Verification Code

                                </label>

                                <input type="text" name="code" maxlength="6"
                                    class="form-control text-uppercase text-center fw-bold" placeholder="XXXXXX">

                                <div class="invalid-feedback"></div>

                            </div>

                            <!-- Verify Button -->
                            <button type="submit" id="verifyBtn" class="btn btn-primary w-100 mb-3">

                                Verify Code

                            </button>

                            <!-- Resend -->
                            <button type="button" id="resendBtn" class="btn btn-outline-secondary w-100">

                                Resend Code

                            </button>

                        </form>

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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {

            const form = $('#verifyForm');

            const overlay = $('#overlay');

            const verifyBtn = $('#verifyBtn');

            const resendBtn = $('#resendBtn');

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

                    success

                    ?
                    'bg-success text-white'

                    :
                    'bg-danger text-white'
                );

                toastEl.find('.toast-body')
                    .html(message);

                new bootstrap.Toast(
                    toastEl[0]
                ).show();
            }

            /*
            |--------------------------------------------------------------------------
            | VERIFY SUBMIT
            |--------------------------------------------------------------------------
            */

            form.on('submit', function(e) {

                /*
                |--------------------------------------------------------------------------
                | PREVENT NORMAL SUBMIT
                |--------------------------------------------------------------------------
                */

                e.preventDefault();

                $('.is-invalid')
                    .removeClass('is-invalid');

                $('.invalid-feedback')
                    .html('');

                overlay.removeClass('d-none');

                verifyBtn.prop(
                    'disabled',
                    true
                );

                $.ajax({

                    /*
                    |--------------------------------------------------------------------------
                    | IMPORTANT
                    |--------------------------------------------------------------------------
                    */

                    headers: {

                        'X-Requested-With': 'XMLHttpRequest'
                    },

                    url: "<?= base_url('verification/verify') ?>",

                    type: "POST",

                    data: form.serialize(),

                    dataType: "json",

                    success: function(response) {
                        overlay.addClass('d-none');

                        verifyBtn.prop(
                            'disabled',
                            false
                        );

                        /*
                        |--------------------------------------------------------------------------
                        | VALIDATION ERRORS
                        |--------------------------------------------------------------------------
                        */

                        if (!response.status) {
                            if (response.errors) {
                                $.each(
                                    response.errors,
                                    function(key, value) {

                                        const input =
                                            $('[name="' + key + '"]');

                                        input.addClass(
                                            'is-invalid'
                                        );

                                        input
                                            .siblings('.invalid-feedback')
                                            .html(value);
                                    });
                            }

                            showToast(

                                response.message ||
                                'Verification failed',

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

                            response.message ||
                            'Verification successful'
                        );

                        /*
                        |--------------------------------------------------------------------------
                        | IMPORTANT:
                        | USE BACKEND REDIRECT
                        |--------------------------------------------------------------------------
                        */

                        setTimeout(function() {

                            window.location.href =
                                response.redirect;

                        }, 1200);
                    },

                    error: function() {
                        overlay.addClass('d-none');

                        verifyBtn.prop(
                            'disabled',
                            false
                        );

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