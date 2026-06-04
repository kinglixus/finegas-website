<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="col-12">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">

            <h5 class="mb-0">

                Permissions Management

            </h5>

            <?php if (can('permissions.create')): ?>

                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createPermissionModal">

                    <i class="feather-plus"></i>

                    Add Permission

                </button>

            <?php endif; ?>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered align-middle">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Name</th>

                            <th>Slug</th>

                            <th>Module</th>

                            <th>Description</th>

                            <th width="120">

                                Actions

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($permissions)): ?>

                            <?php foreach ($permissions as $key => $permission): ?>

                                <tr>

                                    <td>

                                        <?= $key + 1 ?>

                                    </td>

                                    <td>

                                        <?= esc($permission['name']) ?>

                                    </td>

                                    <td>

                                        <span class="badge bg-dark">

                                            <?= esc($permission['slug']) ?>

                                        </span>

                                    </td>

                                    <td>

                                        <span class="badge bg-info">

                                            <?= esc($permission['module']) ?>

                                        </span>

                                    </td>

                                    <td>

                                        <?= esc($permission['description']) ?>

                                    </td>

                                    <td>

                                        <?php if (can('permissions.delete')): ?>

                                            <a href="<?= base_url('admin/permissions/delete/' . $permission['id']) ?>"
                                                class="btn btn-danger btn-sm" onclick="return confirm('Delete permission?')">

                                                Delete

                                            </a>

                                        <?php endif; ?>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>

                                <td colspan="6" class="text-center">

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

<?= $this->endSection() ?>

<!-- ========================================================= -->
<!-- MODALS -->
<!-- ========================================================= -->

<?= $this->section('modals') ?>

<div class="modal fade" id="createPermissionModal" tabindex="-1">

    <div class="modal-dialog
                modal-dialog-centered
                modal-lg
                modal-fullscreen-sm-down">

        <div class="modal-content">

            <form id="createPermissionForm">

                <?= csrf_field() ?>

                <div class="modal-header">

                    <h5 class="modal-title">

                        Create Permission

                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <div class="container-fluid">

                        <!-- NAME -->
                        <div class="mb-3">

                            <label class="form-label">

                                Permission Name

                            </label>

                            <input type="text" name="name" class="form-control">

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- SLUG -->
                        <div class="mb-3">

                            <label class="form-label">

                                Permission Slug

                            </label>

                            <input type="text" name="slug" class="form-control" placeholder="users.view">

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- MODULE -->
                        <div class="mb-3">

                            <label class="form-label">

                                Module

                            </label>

                            <input type="text" name="module" class="form-control" placeholder="users">

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- DESCRIPTION -->
                        <div class="mb-3">

                            <label class="form-label">

                                Description

                            </label>

                            <textarea name="description" class="form-control" rows="4"></textarea>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button type="submit" id="savePermissionBtn" class="btn btn-primary">

                        Save Permission

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>

<!-- ========================================================= -->
<!-- SCRIPTS -->
<!-- ========================================================= -->

<?= $this->section('scripts') ?>

<script>
    $(document).ready(function() {

        /*
        |--------------------------------------------------------------------------
        | CREATE PERMISSION
        |--------------------------------------------------------------------------
        */

        $('#createPermissionForm').on('submit', function(e) {

            e.preventDefault();

            $('.is-invalid').removeClass('is-invalid');

            $('.invalid-feedback').html('');

            const btn =
                $('#savePermissionBtn');

            btn.prop('disabled', true);

            $.ajax({

                url: "<?= base_url('admin/permissions/create') ?>",

                type: "POST",

                data: $(this).serialize(),

                dataType: "json",

                success: function(response) {
                    btn.prop('disabled', false);

                    /*
                    |--------------------------------------------------------------------------
                    | VALIDATION ERRORS
                    |--------------------------------------------------------------------------
                    */

                    if (!response.status) {
                        if (response.errors) {
                            $.each(response.errors, function(key, value) {

                                const input =
                                    $('[name="' + key + '"]');

                                input.addClass('is-invalid');

                                input
                                    .siblings('.invalid-feedback')
                                    .html(value);
                            });
                        }

                        showToast(
                            response.message || 'Validation failed',
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
                        response.message || 'Permission created'
                    );

                    setTimeout(function() {

                        location.reload();

                    }, 1000);
                },

                error: function() {
                    btn.prop('disabled', false);

                    showToast(
                        'Server error occurred',
                        false
                    );
                }

            });

        });

    });
</script>

<?= $this->endSection() ?>