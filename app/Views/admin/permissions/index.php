<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="row">

    <div class="col-12">

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">

                <div>

                    <h5 class="mb-0">

                        Permissions

                    </h5>

                    <small class="text-muted">

                        Manage system permissions

                    </small>

                </div>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#createPermissionModal">

                    <i class="feather-plus me-1"></i>

                    Add Permission

                </button>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle" width="100%">

                        <thead>

                            <tr>

                                <th width="40px">Name</th>

                                <th width="40">Slug</th>

                                <th width="40">Module</th>

                                <th width="120">Description</th>

                                <th width="180">

                                    Actions

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (!empty($permissions)): ?>

                                <?php foreach ($permissions as $permission): ?>

                                    <tr>

                                        <td>

                                            <?= esc($permission['name']) ?>

                                        </td>

                                        <td>

                                            <code>

                                                <?= esc($permission['slug']) ?>

                                            </code>

                                        </td>

                                        <td>

                                            <span class="badge bg-primary">

                                                <?= esc($permission['module']) ?>

                                            </span>

                                        </td>

                                        <td>

                                            <?= esc($permission['description']) ?>

                                        </td>

                                        <td>

                                            <div class="d-flex gap-1 flex-wrap">
                                                <?php if (can('permissions.edit')): ?>
                                                    <a href="<?= base_url('admin/permissions/edit/' . $permission['id']) ?>"
                                                        class="btn btn-sm btn-warning">

                                                        Edit

                                                    </a>
                                                <?php endif; ?>

                                                <?php if (can('permissions.delete')): ?>

                                                    <button type="button" class="btn btn-sm btn-danger delete-permission-btn"
                                                        data-id="<?= $permission['id'] ?>"
                                                        data-name="<?= esc($permission['name']) ?>">

                                                        Delete

                                                    </button>
                                                <?php endif; ?>

                                            </div>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>

                                    <td colspan="5" class="text-center text-muted">

                                        No permissions found

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- ========================================================= -->
<!-- CREATE PERMISSION MODAL -->
<!-- ========================================================= -->

<div class="modal fade" id="createPermissionModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    Add Permission

                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>

            </div>

            <form id="createPermissionForm">

                <div class="modal-body">

                    <?= csrf_field() ?>

                    <div class="mb-3">

                        <label class="form-label">

                            Permission Name

                        </label>

                        <input type="text" name="name" class="form-control">

                        <div class="invalid-feedback"></div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Permission Slug

                        </label>

                        <input type="text" name="slug" class="form-control" placeholder="users.create">

                        <div class="invalid-feedback"></div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Module

                        </label>

                        <input type="text" name="module" class="form-control" placeholder="Users">

                        <div class="invalid-feedback"></div>

                    </div>

                    <div class="mb-0">

                        <label class="form-label">

                            Description

                        </label>

                        <textarea name="description" rows="3" class="form-control"></textarea>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button type="submit" id="savePermissionBtn" class="btn btn-primary">

                        <span class="btn-text">

                            Save Permission

                        </span>

                        <span class="spinner-border spinner-border-sm ms-2 d-none"></span>

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<!-- ========================================================= -->
<!-- DELETE PERMISSION MODAL -->
<!-- ========================================================= -->

<div class="modal fade" id="deletePermissionModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    Delete Permission

                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <p class="mb-0">

                    Are you sure you want to delete:

                    <strong id="deletePermissionName"></strong> ?

                </p>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                    Cancel

                </button>

                <button type="button" id="confirmDeletePermissionBtn" class="btn btn-danger">

                    <span class="btn-text">

                        Delete Permission

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

        const form =
            $('#createPermissionForm');

        const modal =
            $('#createPermissionModal');

        const button =
            $('#savePermissionBtn');

        const spinner =
            button.find('.spinner-border');

        const btnText =
            button.find('.btn-text');

        /*
        |--------------------------------------------------------------------------
        | SUBMIT
        |--------------------------------------------------------------------------
        */

        form.on('submit', function(e) {

            e.preventDefault();

            clearValidation();

            loading();

            $.ajax({

                url: "<?= base_url('admin/permissions/create') ?>",

                type: "POST",

                data: form.serialize(),

                dataType: "json",

                success: function(response) {
                    reset();

                    /*
                    |--------------------------------------------------------------------------
                    | VALIDATION FAILED
                    |--------------------------------------------------------------------------
                    */

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

                    /*
                    |--------------------------------------------------------------------------
                    | SUCCESS
                    |--------------------------------------------------------------------------
                    */

                    showNotification(

                        response.message ||
                        'Permission added successfully',

                        'success'
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | RESET FORM
                    |--------------------------------------------------------------------------
                    */

                    form[0].reset();

                    clearValidation();

                    /*
                    |--------------------------------------------------------------------------
                    | CLOSE MODAL
                    |--------------------------------------------------------------------------
                    */

                    modal.modal('hide');

                    /*
                    |--------------------------------------------------------------------------
                    | RELOAD PAGE
                    |--------------------------------------------------------------------------
                    */

                    setTimeout(function() {

                        location.reload();

                    }, 1000);
                },

                error: function(xhr) {
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

                    showNotification(
                        message,
                        'error'
                    );
                }
            });
        });

        /*
        |--------------------------------------------------------------------------
        | LOADING
        |--------------------------------------------------------------------------
        */

        function loading() {
            button.prop('disabled', true);

            spinner.removeClass('d-none');

            btnText.text('Saving...');
        }

        /*
        |--------------------------------------------------------------------------
        | RESET BUTTON
        |--------------------------------------------------------------------------
        */

        function reset() {
            button.prop('disabled', false);

            spinner.addClass('d-none');

            btnText.text('Save Permission');
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
        | SHOW VALIDATION ERRORS
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


<!-- DELETE PERMISSION SCRIPT -->
<script>
    /*
|--------------------------------------------------------------------------
| DELETE PERMISSION
|--------------------------------------------------------------------------
*/

    let deletePermissionId = null;

    /*
    |--------------------------------------------------------------------------
    | OPEN DELETE MODAL
    |--------------------------------------------------------------------------
    */

    $(document).on(
        'click',
        '.delete-permission-btn',
        function() {

            deletePermissionId =
                $(this).data('id');

            const permissionName =
                $(this).data('name');

            $('#deletePermissionName')
                .text(permissionName);

            $('#deletePermissionModal')
                .modal('show');
        });

    /*
    |--------------------------------------------------------------------------
    | CONFIRM DELETE
    |--------------------------------------------------------------------------
    */

    $(document).on(
        'click',
        '#confirmDeletePermissionBtn',
        function() {

            if (!deletePermissionId) {

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

                url: "<?= base_url('admin/permissions/delete') ?>/" +
                    deletePermissionId,

                type: "POST",

                data: {

                    <?= csrf_token() ?>: "<?= csrf_hash() ?>"
                },

                dataType: "json",

                success: function(response) {
                    /*
                    |--------------------------------------------------------------------------
                    | RESET
                    |--------------------------------------------------------------------------
                    */

                    btn.prop('disabled', false);

                    spinner.addClass('d-none');

                    btnText.text('Delete Permission');

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

                    $('#deletePermissionModal')
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

                    btnText.text('Delete Permission');

                    showNotification(

                        'Server error occurred',

                        'error'
                    );
                }
            });
        });
</script>
<?= $this->endSection() ?>