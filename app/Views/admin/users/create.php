```php
<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="row g-3">

    <div class="col-12">

        <div class="card border-0 shadow-sm stretch">

            <div class="card-header bg-white border-0 py-3">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <div>

                        <h4 class="card-title mb-1 fw-bold">

                            Create New User

                        </h4>

                        <p class="text-muted mb-0">

                            Add a new system user with role access and account verification.

                        </p>

                    </div>

                    <a href="<?= base_url('admin/users') ?>" class="btn btn-light border">

                        <i class="feather-arrow-left me-1"></i>

                        Back to Users

                    </a>

                </div>

            </div>

            <div class="card-body">

                <form id="createUserForm" enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <div class="row g-4">

                        <div class="col-12 text-center">

                            <img id="avatarPreview"
                                src="<?= base_url('public/assets_admin/images/avatar/default-avatar.png') ?>"
                                class="rounded-circle border shadow-sm" width="110" height="110"
                                style="object-fit: cover;">

                        </div>

                        <div class="col-12">

                            <label class="form-label fw-semibold">

                                Profile Photo

                            </label>

                            <input type="file" name="avatar" id="avatarInput" class="form-control">

                            <div class="invalid-feedback"></div>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                First Name

                            </label>

                            <input type="text" name="first_name" class="form-control" placeholder="Enter first name">

                            <div class="invalid-feedback"></div>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                Last Name

                            </label>

                            <input type="text" name="last_name" class="form-control" placeholder="Enter last name">

                            <div class="invalid-feedback"></div>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                Email Address

                            </label>

                            <input type="email" name="email" class="form-control" placeholder="Enter email address">

                            <div class="invalid-feedback"></div>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                Phone Number

                            </label>

                            <input type="text" name="phone" class="form-control" placeholder="Enter phone number">

                            <div class="invalid-feedback"></div>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                Password

                            </label>

                            <input type="password" name="password" class="form-control" placeholder="Enter password">

                            <div class="invalid-feedback"></div>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                Confirm Password

                            </label>

                            <input type="password" name="confirm_password" class="form-control"
                                placeholder="Confirm password">

                            <div class="invalid-feedback"></div>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                User Role

                            </label>

                            <select name="role_id" class="form-select">

                                <option value="">

                                    Select Role

                                </option>

                                <?php foreach ($roles as $role): ?>

                                    <option value="<?= $role['id'] ?>">

                                        <?= esc($role['name']) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                            <div class="invalid-feedback"></div>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                Account Status

                            </label>

                            <select name="status" class="form-select">

                                <option value="active">

                                    Active

                                </option>

                                <option value="inactive">

                                    Inactive

                                </option>

                            </select>

                            <div class="invalid-feedback"></div>

                        </div>

                        <div class="col-12">

                            <div class="form-check form-switch">

                                <input class="form-check-input" type="checkbox" name="send_email" id="sendEmail"
                                    checked>

                                <label class="form-check-label" for="sendEmail">

                                    Send verification email and login instructions

                                </label>

                            </div>

                        </div>

                        <div class="col-12">

                            <div class="d-flex justify-content-end gap-2 flex-wrap">

                                <a href="<?= base_url('admin/users') ?>" class="btn btn-light border">

                                    Cancel

                                </a>

                                <button type="submit" id="saveUserBtn" class="btn btn-primary">

                                    <span class="btn-text">

                                        Create User

                                    </span>

                                    <span class="spinner-border spinner-border-sm d-none ms-2"></span>

                                </button>

                            </div>

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
    $(function() {

        const form =
            $('#createUserForm');

        const button =
            $('#saveUserBtn');

        const spinner =
            button.find('.spinner-border');

        const btnText =
            button.find('.btn-text');

        /*
        |--------------------------------------------------------------------------
        | AVATAR PREVIEW
        |--------------------------------------------------------------------------
        */

        $('#avatarInput').on(
            'change',
            function(e) {

                const file =
                    e.target.files[0];

                if (!file) {

                    return;
                }

                const reader =
                    new FileReader();

                reader.onload =
                    function(e) {

                        $('#avatarPreview')
                            .attr(
                                'src',
                                e.target.result
                            );
                    };

                reader.readAsDataURL(file);
            });

        /*
        |--------------------------------------------------------------------------
        | SUBMIT FORM
        |--------------------------------------------------------------------------
        */

        form.on(
            'submit',
            function(e) {

                e.preventDefault();

                clearValidation();

                showOverlay();

                loading();

                const formData =
                    new FormData(
                        form[0]
                    );

                $.ajax({

                    headers: {

                        'X-Requested-With': 'XMLHttpRequest'
                    },

                    url: "<?= site_url('admin/users/create') ?>",

                    type: "POST",

                    data: formData,

                    processData: false,

                    contentType: false,

                    dataType: "json",

                    success: function(response) {

                        hideOverlay();

                        reset();

                        if (!response.status) {

                            showErrors(
                                response.errors
                            );

                            showNotification(

                                response.message ||
                                'Validation failed',

                                'error'
                            );

                            return;
                        }

                        showNotification(

                            response.message,

                            'success'
                        );

                        form[0].reset();

                        $('#avatarPreview')
                            .attr(
                                'src',
                                "<?= base_url('assets/images/default-avatar.png') ?>"
                            );

                        setTimeout(function() {

                            window.location.href =
                                "<?= base_url('admin/users') ?>";

                        }, 1200);
                    },

                    error: function(xhr) {

                        hideOverlay();

                        reset();

                        let message =
                            'Server error occurred';

                        if (
                            xhr.responseJSON &&
                            xhr.responseJSON.message
                        ) {

                            message =
                                xhr.responseJSON.message;
                        }

                        if (
                            xhr.responseJSON &&
                            xhr.responseJSON.errors
                        ) {

                            showErrors(
                                xhr.responseJSON.errors
                            );
                        }

                        showNotification(
                            message,
                            'error'
                        );
                    }
                });
            });

        /*
        |--------------------------------------------------------------------------
        | LOADING STATE
        |--------------------------------------------------------------------------
        */

        function loading() {

            button.prop('disabled', true);

            spinner.removeClass('d-none');

            btnText.text('Creating...');
        }

        /*
        |--------------------------------------------------------------------------
        | RESET BUTTON
        |--------------------------------------------------------------------------
        */

        function reset() {

            button.prop('disabled', false);

            spinner.addClass('d-none');

            btnText.text('Create User');
        }

        /*
        |--------------------------------------------------------------------------
        | CLEAR VALIDATION
        |--------------------------------------------------------------------------
        */

        function clearValidation() {

            form.find('.is-invalid')
                .removeClass('is-invalid');

            form.find('.invalid-feedback')
                .html('');
        }

        /*
        |--------------------------------------------------------------------------
        | SHOW INLINE ERRORS
        |--------------------------------------------------------------------------
        */

        function showErrors(errors) {

            if (!errors) {

                return;
            }

            $.each(errors, function(key, value) {

                const input =
                    form.find(
                        '[name="' + key + '"]'
                    );

                input.addClass('is-invalid');

                input
                    .siblings('.invalid-feedback')
                    .html(value);
            });
        }

    });
</script>

<?= $this->endSection() ?>
```