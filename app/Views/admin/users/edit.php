<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="row">

    <div class="col-12">

        <div class="card border-0 shadow-sm">

            <!-- ===================================================== -->
            <!-- HEADER -->
            <!-- ===================================================== -->

            <div class="card-header bg-white border-0 py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h4 class="mb-1 fw-bold">

                            Edit User

                        </h4>

                        <p class="text-muted mb-0">

                            Update user account details and access settings.

                        </p>

                    </div>

                    <a href="<?= base_url('admin/users') ?>" class="btn btn-light">

                        <i class="feather-arrow-left me-1"></i>

                        Back

                    </a>

                </div>

            </div>

            <!-- ===================================================== -->
            <!-- BODY -->
            <!-- ===================================================== -->

            <div class="card-body">

                <form id="editUserForm" enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <div class="row g-4">

                        <!-- ===================================================== -->
                        <!-- AVATAR -->
                        <!-- ===================================================== -->

                        <div class="col-12 text-center">

                            <?php

                            $avatar = !empty($user['avatar'])

                                ? base_url(
                                    'uploads/avatars/' .
                                        $user['avatar']
                                )

                                : base_url(
                                    'public/assets_admin/images/avatar/default-avatar.png'
                                );

                            ?>

                            <img src="<?= $avatar ?>" id="avatarPreview" class="rounded-circle border shadow-sm mb-3"
                                width="120" height="120" style="object-fit:cover;">

                            <div>

                                <input type="file" name="avatar" id="avatarInput" class="form-control" accept="image/*">

                                <div class="invalid-feedback"></div>

                            </div>

                        </div>

                        <!-- ===================================================== -->
                        <!-- FIRST NAME -->
                        <!-- ===================================================== -->

                        <div class="col-md-6">

                            <label class="form-label">

                                First Name

                            </label>

                            <input type="text" name="first_name" class="form-control"
                                value="<?= esc($user['first_name']) ?>">

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- ===================================================== -->
                        <!-- LAST NAME -->
                        <!-- ===================================================== -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Last Name

                            </label>

                            <input type="text" name="last_name" class="form-control"
                                value="<?= esc($user['last_name']) ?>">

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- ===================================================== -->
                        <!-- EMAIL -->
                        <!-- ===================================================== -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Email Address

                            </label>

                            <input type="email" name="email" class="form-control" value="<?= esc($user['email']) ?>">

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- ===================================================== -->
                        <!-- PHONE -->
                        <!-- ===================================================== -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Phone Number

                            </label>

                            <input type="text" name="phone" class="form-control" value="<?= esc($user['phone']) ?>">

                            <div class="invalid-feedback"></div>

                        </div>



                        <!-- ===================================================== -->
                        <!-- ROLE -->
                        <!-- ===================================================== -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Role

                            </label>

                            <select name="role_id" class="form-select">

                                <?php foreach ($roles as $role): ?>

                                    <option value="<?= $role['id'] ?>" <?= $role['id'] == $user['role_id']
                                                                            ? 'selected'
                                                                            : '' ?>>

                                        <?= esc($role['name']) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- ===================================================== -->
                        <!-- STATUS -->
                        <!-- ===================================================== -->

                        <div class="col-md-6">

                            <label class="form-label">

                                Status

                            </label>

                            <select name="status" class="form-select">

                                <option value="active" <?= $user['status'] === 'active'
                                                            ? 'selected'
                                                            : '' ?>>

                                    Active

                                </option>

                                <option value="inactive" <?= $user['status'] === 'inactive'
                                                                ? 'selected'
                                                                : '' ?>>

                                    Inactive

                                </option>

                            </select>

                            <div class="invalid-feedback"></div>

                        </div>

                    </div>

                    <!-- ===================================================== -->
                    <!-- ACTIONS -->
                    <!-- ===================================================== -->

                    <div class="mt-5 d-flex justify-content-end gap-2">

                        <a href="<?= base_url('admin/users') ?>" class="btn btn-light">

                            Cancel

                        </a>

                        <button type="submit" id="saveUserBtn" class="btn btn-primary">

                            <span class="spinner-border spinner-border-sm d-none me-2"></span>

                            <span class="btn-text">

                                Update User

                            </span>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    $('#avatarInput').on(
        'change',
        function(e) {
            const file =
                e.target.files[0];

            if (file) {
                $('#avatarPreview')
                    .attr(
                        'src',
                        URL.createObjectURL(file)
                    );
            }
        });

    /*
    |--------------------------------------------------------------------------
    | SUBMIT
    |--------------------------------------------------------------------------
    */

    $('#editUserForm').on(
        'submit',
        function(e) {

            e.preventDefault();

            clearValidation();

            const form =
                document.getElementById(
                    'editUserForm'
                );

            const formData =
                new FormData(form);

            $('#saveUserBtn')
                .prop('disabled', true);

            $('#saveUserBtn .spinner-border')
                .removeClass('d-none');

            $.ajax({

                headers: {

                    'X-Requested-With': 'XMLHttpRequest'
                },

                url: "<?= base_url('admin/users/edit/' . $user['id']) ?>",

                type: "POST",

                data: formData,

                processData: false,

                contentType: false,

                dataType: "json",

                success: function(response) {
                    $('#saveUserBtn')
                        .prop('disabled', false);

                    $('#saveUserBtn .spinner-border')
                        .addClass('d-none');

                    /*
                    |--------------------------------------------------------------------------
                    | VALIDATION
                    |--------------------------------------------------------------------------
                    */

                    if (!response.status) {
                        if (response.errors) {
                            showValidationErrors(
                                response.errors
                            );
                        }

                        showNotification(

                            response.message ||
                            'Validation failed',

                            'error'
                        );

                        return;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | SUCCESS
                    |--------------------------------------------------------------------------
                    */

                    showNotification(

                        response.message,

                        'success'
                    );
                },

                error: function() {
                    $('#saveUserBtn')
                        .prop('disabled', false);

                    $('#saveUserBtn .spinner-border')
                        .addClass('d-none');

                    showNotification(

                        'Server error occurred',

                        'error'
                    );
                }
            });
        });

    /*
    |--------------------------------------------------------------------------
    | VALIDATION HELPERS
    |--------------------------------------------------------------------------
    */

    function clearValidation() {
        $('.is-invalid')
            .removeClass('is-invalid');

        $('.invalid-feedback')
            .html('');
    }

    function showValidationErrors(errors) {
        $.each(errors, function(key, value) {
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
</script>

<?= $this->endSection() ?>