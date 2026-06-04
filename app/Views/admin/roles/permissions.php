<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="col-12">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">

            <div>

                <h5 class="mb-1">

                    Role Permissions

                </h5>

                <p class="text-muted mb-0">

                    <?= esc($role['name']) ?>

                </p>

            </div>

            <button id="savePermissionsBtn" class="btn btn-primary">

                Save Permissions

            </button>

        </div>

        <div class="card-body">

            <form id="permissionsForm">

                <?= csrf_field() ?>

                <div class="row">

                    <?php if (!empty($permissions)): ?>

                        <?php foreach ($permissions as $module => $items): ?>

                            <div class="col-md-6 col-lg-4 mb-4">

                                <div class="card h-100 border">

                                    <div class="card-header bg-light">

                                        <h6 class="mb-0 text-uppercase">

                                            <?= esc($module) ?>

                                        </h6>

                                    </div>

                                    <div class="card-body">

                                        <?php foreach ($items as $permission): ?>

                                            <div class="form-check mb-3">

                                                <input class="form-check-input permission-checkbox" type="checkbox"
                                                    name="permissions[]" value="<?= $permission['id'] ?>"
                                                    id="permission<?= $permission['id'] ?>" <?= in_array(
                                                                                                $permission['id'],
                                                                                                $assignedPermissions
                                                                                            ) ? 'checked' : '' ?>>

                                                <label class="form-check-label" for="permission<?= $permission['id'] ?>">

                                                    <strong>

                                                        <?= esc($permission['name']) ?>

                                                    </strong>

                                                    <br>

                                                    <small class="text-muted">

                                                        <?= esc($permission['slug']) ?>

                                                    </small>

                                                </label>

                                            </div>

                                        <?php endforeach; ?>

                                    </div>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <div class="col-12">

                            <div class="alert alert-warning">

                                No permissions found.

                            </div>

                        </div>

                    <?php endif; ?>

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
        | SAVE ROLE PERMISSIONS
        |--------------------------------------------------------------------------
        */

        $('#savePermissionsBtn').on('click', function() {

            const btn =
                $(this);

            btn.prop('disabled', true);

            $.ajax({

                url: "<?= base_url('admin/roles/permissions/' . $role['id']) ?>",

                type: "POST",

                data: $('#permissionsForm').serialize(),

                dataType: "json",

                success: function(response) {
                    btn.prop('disabled', false);

                    if (!response.status) {
                        showToast(
                            response.message || 'Failed to save permissions',
                            false
                        );

                        return;
                    }

                    showToast(
                        response.message || 'Permissions updated'
                    );
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