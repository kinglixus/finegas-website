<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        Reset Password
    </title>

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

        .reset-card {
            width: 100%;
            max-width: 460px;
        }

        .overlay-loader {
            background: rgba(255, 255, 255, .75);
            z-index: 9999;
        }

        .toast {
            min-width: 320px;
        }

        .strength-bar {
            height: 6px;
            border-radius: 20px;
            transition: all .3s ease;
        }

        .password-toggle {
            cursor: pointer;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-5 col-md-7">

                <div class="card shadow-lg border-0 reset-card position-relative">

                    <!-- Overlay -->
                    <div id="overlay" class="overlay-loader position-absolute top-0 start-0 w-100 h-100 d-none">

                        <div class="d-flex justify-content-center align-items-center h-100">

                            <div class="spinner-border text-primary"></div>

                        </div>

                    </div>

                    <!-- Header -->
                    <div class="card-header text-center bg-white border-0 pt-4">

                        <h3 class="fw-bold mb-2">

                            Reset Password

                        </h3>

                        <p class="text-muted">

                            Create your new password

                        </p>

                    </div>

                    <!-- Body -->
                    <div class="card-body p-4">

                        <form id="resetForm">

                            <?= csrf_field() ?>

                            <!-- Password -->
                            <div class="mb-3">

                                <label class="form-label">

                                    New Password

                                </label>

                                <div class="input-group">

                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Enter new password">

                                    <span class="input-group-text password-toggle" data-target="password">

                                        <i class="fa fa-eye"></i>

                                    </span>

                                </div>

                                <div class="invalid-feedback"></div>

                            </div>

                            <!-- Strength -->
                            <div class="mb-3">

                                <div class="progress" style="height:6px;">

                                    <div id="strengthBar" class="progress-bar strength-bar" style="width:0%;"></div>

                                </div>

                                <small id="strengthText" class="text-muted">

                                    Password strength

                                </small>

                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">

                                <label class="form-label">

                                    Confirm Password

                                </label>

                                <div class="input-group">

                                    <input type="password" name="confirm_password" id="confirm_password"
                                        class="form-control" placeholder="Confirm password">

                                    <span class="input-group-text password-toggle" data-target="confirm_password">

                                        <i class="fa fa-eye"></i>

                                    </span>

                                </div>

                                <div class="invalid-feedback"></div>

                            </div>

                            <!-- Submit -->
                            <button type="submit" id="submitBtn" class="btn btn-primary w-100">

                                Reset Password

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

            const form = $('#resetForm');

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

                new bootstrap.Toast(
                    toastEl[0]
                ).show();
            }

            /*
            |--------------------------------------------------------------------------
            | SHOW / HIDE PASSWORD
            |--------------------------------------------------------------------------
            */

            $('.password-toggle').on('click', function() {

                const target = $(this).data('target');

                const input = $('#' + target);

                const icon = $(this).find('i');

                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');

                    icon.removeClass('fa-eye')
                        .addClass('fa-eye-slash');
                } else {
                    input.attr('type', 'password');

                    icon.removeClass('fa-eye-slash')
                        .addClass('fa-eye');
                }

            });

            /*
            |--------------------------------------------------------------------------
            | PASSWORD STRENGTH
            |--------------------------------------------------------------------------
            */

            $('#password').on('input', function() {

                const password = $(this).val();

                let strength = 0;

                if (password.length >= 8)
                    strength++;

                if (/[A-Z]/.test(password))
                    strength++;

                if (/[a-z]/.test(password))
                    strength++;

                if (/[0-9]/.test(password))
                    strength++;

                if (/[^A-Za-z0-9]/.test(password))
                    strength++;

                const bar = $('#strengthBar');

                const text = $('#strengthText');

                switch (strength) {
                    case 0:
                    case 1:

                        bar.css('width', '20%')
                            .removeClass()
                            .addClass('progress-bar bg-danger');

                        text.text('Weak');

                        break;

                    case 2:
                    case 3:

                        bar.css('width', '60%')
                            .removeClass()
                            .addClass('progress-bar bg-warning');

                        text.text('Medium');

                        break;

                    case 4:
                    case 5:

                        bar.css('width', '100%')
                            .removeClass()
                            .addClass('progress-bar bg-success');

                        text.text('Strong');

                        break;
                }

            });

            /*
            |--------------------------------------------------------------------------
            | SUBMIT
            |--------------------------------------------------------------------------
            */

            form.on('submit', function(e) {

                e.preventDefault();

                $('.is-invalid').removeClass('is-invalid');

                $('.invalid-feedback').html('');

                overlay.removeClass('d-none');

                submitBtn.prop('disabled', true);

                $.ajax({

                    url: "<?= site_url('reset-password/' . $token) ?>",

                    type: "POST",

                    data: form.serialize(),

                    dataType: "json",

                    success: function(response) {
                        overlay.addClass('d-none');

                        submitBtn.prop('disabled', false);

                        if (!response.status) {
                            if (response.errors) {
                                $.each(response.errors, function(key, value) {

                                    const input = $('[name="' + key + '"]');

                                    input.addClass('is-invalid');

                                    input.closest('.mb-3, .mb-4')
                                        .find('.invalid-feedback')
                                        .html(value);
                                });
                            }

                            showToast(
                                response.message || 'Reset failed',
                                false
                            );

                            return;
                        }

                        showToast(response.message);

                        setTimeout(function() {

                            window.location.href = response.redirect;

                        }, 1500);
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