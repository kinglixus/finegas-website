# Fully Fixed `change_temp_password.php`

```php
<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">

    <div class="col-xl-6 col-lg-7 col-md-10">

        <div class="card border-0 shadow-sm overflow-hidden">

            <!-- ===================================================== -->
            <!-- HEADER -->
            <!-- ===================================================== -->

            <div class="card-header bg-danger text-white py-4">

                <div class="d-flex align-items-center justify-content-between">

                    <div>

                        <h3 class="mb-1 fw-bold">
                            Change Temporary Password
                        </h3>

                        <p class="mb-0 opacity-75">
                            Your account is currently using a temporary password.
                        </p>

                    </div>

                    <div>

                        <i class="feather-lock fs-1"></i>

                    </div>

                </div>

            </div>

            <!-- ===================================================== -->
            <!-- BODY -->
            <!-- ===================================================== -->

            <div class="card-body p-4 p-lg-5">

                <!-- ===================================================== -->
                <!-- ALERT -->
                <!-- ===================================================== -->

                <div class="alert alert-warning border-0 mb-4">

                    <div class="d-flex align-items-start gap-3">

                        <div>
                            <i class="feather-alert-triangle fs-4"></i>
                        </div>

                        <div>

                            <strong>
                                Security Notice
                            </strong>

                            <div class="mt-1 small">
                                You must change your temporary password immediately.
                                Failure to change it may result in automatic account deactivation.
                            </div>

                        </div>

                    </div>

                </div>

                <!-- ===================================================== -->
                <!-- USER -->
                <!-- ===================================================== -->

                <div class="mb-4">

                    <label class="form-label text-muted small fw-semibold">
                        Logged In User
                    </label>

                    <div class="fw-bold fs-5">

                        <?= esc(

                            trim(

                                ($user['first_name'] ?? '') .
                                    ' ' .
                                    ($user['last_name'] ?? '')
                            )
                        ) ?>

                    </div>

                    <div class="text-muted small">
                        <?= esc($user['email'] ?? '') ?>
                    </div>

                </div>

                <!-- ===================================================== -->
                <!-- FORM -->
                <!-- ===================================================== -->

                <form id="changePasswordForm">

                    <?= csrf_field() ?>

                    <div class="row g-4">

                        <!-- ===================================================== -->
                        <!-- PASSWORD -->
                        <!-- ===================================================== -->

                        <div class="col-12">

                            <label class="form-label fw-semibold">
                                New Password
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="feather-lock"></i>
                                </span>

                                <input type="password" name="password" id="password"
                                    class="form-control form-control-lg" placeholder="Enter new password"
                                    autocomplete="new-password">

                                <button type="button" class="btn btn-light border" id="togglePassword">

                                    <i class="feather-eye"></i>

                                </button>

                            </div>

                            <div class="invalid-feedback d-block"></div>

                        </div>

                        <!-- ===================================================== -->
                        <!-- PASSWORD STRENGTH -->
                        <!-- ===================================================== -->

                        <div class="col-12">

                            <div class="d-flex justify-content-between mb-2">

                                <small class="text-muted fw-semibold">
                                    Password Strength
                                </small>

                                <small id="passwordStrengthText" class="fw-bold text-danger">
                                    Weak
                                </small>

                            </div>

                            <div class="progress" style="height:10px;">

                                <div class="progress-bar bg-danger" id="passwordStrengthBar" style="width:0%">
                                </div>

                            </div>

                        </div>

                        <!-- ===================================================== -->
                        <!-- PASSWORD RULES -->
                        <!-- ===================================================== -->

                        <div class="col-12">

                            <div class="border rounded p-3 bg-light">

                                <div class="fw-bold mb-3">
                                    Password Requirements
                                </div>

                                <div class="row g-2 small">

                                    <div class="col-md-6">

                                        <div id="rule-length" class="text-danger">
                                            ✖ Minimum 8 characters
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div id="rule-uppercase" class="text-danger">
                                            ✖ At least one uppercase letter
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div id="rule-number" class="text-danger">
                                            ✖ At least one number
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div id="rule-special" class="text-danger">
                                            ✖ At least one special character
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- ===================================================== -->
                        <!-- CONFIRM PASSWORD -->
                        <!-- ===================================================== -->

                        <div class="col-12">

                            <label class="form-label fw-semibold">
                                Confirm Password
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="feather-shield"></i>
                                </span>

                                <input type="password" name="confirm_password" id="confirm_password"
                                    class="form-control form-control-lg" placeholder="Confirm password"
                                    autocomplete="new-password">

                            </div>

                            <div class="invalid-feedback d-block"></div>

                        </div>

                        <!-- ===================================================== -->
                        <!-- BUTTON -->
                        <!-- ===================================================== -->

                        <div class="col-12 pt-2">

                            <button type="submit" id="changePasswordBtn"
                                class="btn btn-danger btn-lg w-100 fw-semibold">

                                <span class="spinner-border spinner-border-sm d-none me-2"></span>

                                <span class="btn-text">
                                    Change Password
                                </span>

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    $(document).ready(function() {
        /*
        |--------------------------------------------------------------------------
        | TOGGLE PASSWORD
        |--------------------------------------------------------------------------
        */

        $('#togglePassword').on('click', function() {
            const passwordInput = $('#password');

            const type = passwordInput.attr('type') === 'password' ?
                'text' :
                'password';

            passwordInput.attr('type', type);

            $(this).find('i')
                .toggleClass('feather-eye feather-eye-off');
        });

        /*
        |--------------------------------------------------------------------------
        | PASSWORD STRENGTH + RULES
        |--------------------------------------------------------------------------
        */

        $('#password').on('keyup', function() {
            const password = $(this).val();

            let strength = 0;

            const hasLength = password.length >= 8;
            const hasUpper = /[A-Z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            const hasSpecial = /[^A-Za-z0-9]/.test(password);

            updateRule(
                '#rule-length',
                hasLength,
                'Minimum 8 characters'
            );

            updateRule(
                '#rule-uppercase',
                hasUpper,
                'At least one uppercase letter'
            );

            updateRule(
                '#rule-number',
                hasNumber,
                'At least one number'
            );

            updateRule(
                '#rule-special',
                hasSpecial,
                'At least one special character'
            );

            if (hasLength)
                strength += 25;

            if (hasUpper)
                strength += 25;

            if (hasNumber)
                strength += 25;

            if (hasSpecial)
                strength += 25;

            $('#passwordStrengthBar')
                .css('width', strength + '%');

            let text = 'Weak';
            let color = 'bg-danger';
            let textColor = 'text-danger';

            if (strength >= 75) {
                text = 'Strong';
                color = 'bg-success';
                textColor = 'text-success';
            } else if (strength >= 50) {
                text = 'Medium';
                color = 'bg-warning';
                textColor = 'text-warning';
            }

            $('#passwordStrengthBar')
                .removeClass('bg-danger bg-warning bg-success')
                .addClass(color);

            $('#passwordStrengthText')
                .removeClass('text-danger text-warning text-success')
                .addClass(textColor)
                .text(text);
        });

        /*
        |--------------------------------------------------------------------------
        | INLINE VALIDATION
        |--------------------------------------------------------------------------
        */

        $('#confirm_password').on('keyup', function() {
            const password = $('#password').val();
            const confirm = $(this).val();

            if (confirm.length === 0) {
                return;
            }

            if (password !== confirm) {
                $(this)
                    .addClass('is-invalid')
                    .removeClass('is-valid');

                $(this)
                    .closest('.col-12')
                    .find('.invalid-feedback')
                    .html('Passwords do not match');
            } else {
                $(this)
                    .removeClass('is-invalid')
                    .addClass('is-valid');

                $(this)
                    .closest('.col-12')
                    .find('.invalid-feedback')
                    .html('');
            }
        });

        /*
        |--------------------------------------------------------------------------
        | SUBMIT FORM
        |--------------------------------------------------------------------------
        */

        $('#changePasswordForm').on('submit', function(e) {
            e.preventDefault();

            clearValidation();

            $('#changePasswordBtn')
                .prop('disabled', true);

            $('#changePasswordBtn .spinner-border')
                .removeClass('d-none');

            $.ajax({

                headers: {

                    'X-Requested-With': 'XMLHttpRequest'
                },

                url: "<?= base_url('admin/change-temp-password') ?>",

                type: 'POST',

                data: $(this).serialize(),

                dataType: 'json',

                success: function(response) {
                    $('#changePasswordBtn')
                        .prop('disabled', false);

                    $('#changePasswordBtn .spinner-border')
                        .addClass('d-none');

                    if (!response.status) {
                        if (response.errors) {
                            showValidationErrors(
                                response.errors
                            );
                        }

                        showNotification(
                            response.message || 'Validation failed',
                            'error'
                        );

                        return;
                    }

                    showNotification(
                        response.message,
                        'success'
                    );

                    setTimeout(function() {
                        window.location.href =
                            response.redirect;

                    }, 1200);
                },

                error: function(xhr) {
                    $('#changePasswordBtn')
                        .prop('disabled', false);

                    $('#changePasswordBtn .spinner-border')
                        .addClass('d-none');

                    console.log(xhr.responseText);

                    showNotification(
                        'Server error occurred',
                        'error'
                    );
                }
            });
        });

        /*
        |--------------------------------------------------------------------------
        | UPDATE PASSWORD RULE
        |--------------------------------------------------------------------------
        */

        function updateRule(selector, valid, text) {
            if (valid) {
                $(selector)
                    .removeClass('text-danger')
                    .addClass('text-success')
                    .html('✔ ' + text);
            } else {
                $(selector)
                    .removeClass('text-success')
                    .addClass('text-danger')
                    .html('✖ ' + text);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | CLEAR VALIDATION
        |--------------------------------------------------------------------------
        */

        function clearValidation() {
            $('.form-control')
                .removeClass('is-invalid');

            $('.invalid-feedback')
                .html('');
        }

        /*
        |--------------------------------------------------------------------------
        | SHOW VALIDATION ERRORS
        |--------------------------------------------------------------------------
        */

        function showValidationErrors(errors) {
            $.each(errors, function(key, value) {
                const input =
                    $('[name="' + key + '"]');

                input.addClass('is-invalid');

                input.closest('.col-12')
                    .find('.invalid-feedback')
                    .html(value);
            });
        }
    });
</script>

<?= $this->endSection() ?>
```