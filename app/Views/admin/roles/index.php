```php
<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="row g-3">
    <div class="col-12">
        <div class="card">
            <div
                class="card-header d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                <h5 class="mb-0">Roles Management</h5>

                <?php if (can('roles.create')): ?>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#createRoleModal">
                        <i class="feather-plus me-1"></i>
                        Add Role
                    </button>
                <?php endif; ?>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0 table-striped" width="100%" id="table">
                        <thead>
                            <tr>
                                <th style="width: 40px;">#</th>
                                <th style="width: 140px;">Name</th>
                                <th style="width: 140px;">Slug</th>
                                <th style="width: 200px;">Description</th>
                                <th style="width: 300px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($roles)): ?>
                                <?php foreach ($roles as $key => $role): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= esc($role['name']) ?></td>
                                        <td>
                                            <span class="badge bg-dark"><?= esc($role['slug']) ?></span>
                                        </td>
                                        <td><?= esc($role['description']) ?></td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <?php if (can('roles.permissions')): ?>
                                                    <a href="<?= base_url('admin/roles/permissions/' . $role['id']) ?>"
                                                        class="btn btn-warning btn-sm">
                                                        Permissions
                                                    </a>
                                                <?php endif; ?>

                                                <?php if (can('roles.edit')): ?>
                                                    <a href="<?= base_url('admin/roles/edit/' . $role['id']) ?>"
                                                        class="btn btn-info btn-sm">
                                                        Edit
                                                    </a>
                                                <?php endif; ?>

                                                <?php if (can('roles.delete')): ?>
                                                    <button type="button" class="btn btn-danger btn-sm delete-role-btn"
                                                        data-id="<?= $role['id'] ?>" data-name="<?= esc($role['name']) ?>">

                                                        Delete

                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No roles found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CREATE ROLE MODAL -->
<div class="modal fade" id="createRoleModal" tabindex="-1" aria-labelledby="createRoleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="createRoleForm" autocomplete="off">
                <?= csrf_field() ?>

                <div class="modal-header">
                    <h5 class="modal-title" id="createRoleModalLabel">Create Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Role Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Example: Manager">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role Slug <span class="text-danger">*</span></label>
                        <input type="text" name="slug" class="form-control" placeholder="Example: manager">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"
                            placeholder="Short role description"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="saveRoleBtn" class="btn btn-primary">
                        <span class="btn-text">Save Role</span>
                        <span class="spinner-border spinner-border-sm ms-2 d-none" role="status"
                            aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========================================================= -->
<!-- DELETE ROLE MODAL -->
<!-- ========================================================= -->

<div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    Delete Role

                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <p class="mb-0">

                    Are you sure you want to delete:

                    <strong id="deleteRoleName"></strong> ?

                </p>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                    Cancel

                </button>

                <button type="button" id="confirmDeleteRoleBtn" class="btn btn-danger">

                    <span class="btn-text">

                        Delete Role

                    </span>

                    <span class="spinner-border spinner-border-sm ms-2 d-none"></span>

                </button>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(function() {

        /*
        |--------------------------------------------------------------------------
        | ELEMENTS
        |--------------------------------------------------------------------------
        */

        const modal =
            $('#createRoleModal');

        const form =
            $('#createRoleForm');

        const saveBtn =
            $('#saveRoleBtn');

        const spinner =
            saveBtn.find('.spinner-border');

        const btnText =
            saveBtn.find('.btn-text');

        /*
        |--------------------------------------------------------------------------
        | MOVE MODAL TO BODY
        |--------------------------------------------------------------------------
        */

        if (!modal.parent().is('body')) {

            modal.appendTo('body');
        }

        /*
        |--------------------------------------------------------------------------
        | MODAL EVENTS
        |--------------------------------------------------------------------------
        */

        modal.on('hidden.bs.modal', function() {

            form[0].reset();

            clearValidation();

            resetButton();

            $('.modal-backdrop').remove();

            $('body')
                .removeClass('modal-open')
                .css({

                    overflow: '',

                    paddingRight: ''
                });
        });

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
        | LOADING BUTTON
        |--------------------------------------------------------------------------
        */

        function loadingButton() {
            saveBtn.prop('disabled', true);

            spinner.removeClass('d-none');

            btnText.text('Saving...');
        }

        /*
        |--------------------------------------------------------------------------
        | RESET BUTTON
        |--------------------------------------------------------------------------
        */

        function resetButton() {
            saveBtn.prop('disabled', false);

            spinner.addClass('d-none');

            btnText.text('Save Role');
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATION ERRORS
        |--------------------------------------------------------------------------
        */

        function showValidationErrors(errors) {
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

        /*
        |--------------------------------------------------------------------------
        | SAFE NOTIFICATION
        |--------------------------------------------------------------------------
        */

        function notify(message, type = 'success') {
            if (
                typeof showNotification === 'function'
            ) {

                showNotification(
                    message,
                    type
                );

            } else {

                console.log(
                    type.toUpperCase() +
                    ': ' +
                    message
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | AJAX SUBMIT
        |--------------------------------------------------------------------------
        */

        $(document).on('submit', '#createRoleForm', function(e) {

            e.preventDefault();

            e.stopImmediatePropagation();

            clearValidation();

            loadingButton();

            $.ajax({

                url: "<?= base_url('admin/roles/create') ?>",

                type: "POST",

                data: $(this).serialize(),

                dataType: "json",

                success: function(response) {

                    resetButton();

                    if (!response.status) {

                        showValidationErrors(
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
                        response.message ||
                        'Role added successfully',
                        'success'
                    );

                    $('#createRoleModal').modal('hide');

                    setTimeout(function() {

                        location.reload();

                    }, 1200);
                },

                error: function(xhr) {

                    resetButton();

                    showNotification(
                        'Server error occurred',
                        'error'
                    );
                }
            });

            return false;
        });

    });
</script>

<script>
    /*
|--------------------------------------------------------------------------
| DELETE ROLE
|--------------------------------------------------------------------------
*/

    let deleteRoleId = null;

    /*
    |--------------------------------------------------------------------------
    | OPEN DELETE MODAL
    |--------------------------------------------------------------------------
    */

    $(document).on(
        'click',
        '.delete-role-btn',
        function() {

            deleteRoleId =
                $(this).data('id');

            const roleName =
                $(this).data('name');

            $('#deleteRoleName')
                .text(roleName);

            $('#deleteRoleModal')
                .modal('show');
        });

    /*
    |--------------------------------------------------------------------------
    | CONFIRM DELETE
    |--------------------------------------------------------------------------
    */

    $(document).on(
        'click',
        '#confirmDeleteRoleBtn',
        function() {

            if (!deleteRoleId) {

                return;
            }

            const btn =
                $(this);

            const spinner =
                btn.find('.spinner-border');

            const btnText =
                btn.find('.btn-text');

            /*
            |--------------------------------------------------------------------------
            | LOADING
            |--------------------------------------------------------------------------
            */

            btn.prop('disabled', true);

            spinner.removeClass('d-none');

            btnText.text('Deleting...');

            $.ajax({

                url: "<?= base_url('admin/roles/delete') ?>/" +
                    deleteRoleId,

                type: "POST",

                data: {

                    <?= csrf_token() ?>: "<?= csrf_hash() ?>"
                },

                dataType: "json",

                success: function(response) {
                    /*
                    |--------------------------------------------------------------------------
                    | RESET BUTTON
                    |--------------------------------------------------------------------------
                    */

                    btn.prop('disabled', false);

                    spinner.addClass('d-none');

                    btnText.text('Delete Role');

                    /*
                    |--------------------------------------------------------------------------
                    | FAILED
                    |--------------------------------------------------------------------------
                    */

                    if (!response.status) {
                        showNotification(

                            response.message,

                            'error'
                        );

                        return;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | CLOSE MODAL
                    |--------------------------------------------------------------------------
                    */

                    $('#deleteRoleModal')
                        .modal('hide');

                    /*
                    |--------------------------------------------------------------------------
                    | SUCCESS
                    |--------------------------------------------------------------------------
                    */

                    showNotification(

                        response.message,

                        'success'
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | RELOAD
                    |--------------------------------------------------------------------------
                    */

                    setTimeout(function() {

                        location.reload();

                    }, 1000);
                },

                error: function() {
                    btn.prop('disabled', false);

                    spinner.addClass('d-none');

                    btnText.text('Delete Role');

                    showNotification(

                        'Server error occurred',

                        'error'
                    );
                }
            });
        });
</script>
<?= $this->endSection() ?>