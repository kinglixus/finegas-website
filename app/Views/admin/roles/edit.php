<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="row">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h5 class="mb-0">

                    Edit Role

                </h5>

                <a href="<?= base_url('admin/roles') ?>" class="btn btn-secondary btn-sm">

                    Back

                </a>

            </div>

            <div class="card-body">

                <form id="editRoleForm">

                    <?= csrf_field() ?>

                    <div class="mb-3">

                        <label class="form-label">

                            Role Name

                        </label>

                        <input type="text" name="name" class="form-control" value="<?= esc($role['name']) ?>">

                        <div class="invalid-feedback"></div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Slug

                        </label>

                        <input type="text" name="slug" class="form-control" value="<?= esc($role['slug']) ?>">

                        <div class="invalid-feedback"></div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Description

                        </label>

                        <textarea name="description" rows="4"
                            class="form-control"><?= esc($role['description']) ?></textarea>

                    </div>

                    <button type="submit" id="updateRoleBtn" class="btn btn-primary">

                        <span class="btn-text">

                            Update Role

                        </span>

                        <span class="spinner-border spinner-border-sm ms-2 d-none"></span>

                    </button>

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
            $('#editRoleForm');

        const button =
            $('#updateRoleBtn');

        const spinner =
            button.find('.spinner-border');

        const btnText =
            button.find('.btn-text');

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
        | LOADING
        |--------------------------------------------------------------------------
        */

        function loading() {
            button.prop('disabled', true);

            spinner.removeClass('d-none');

            btnText.text('Updating...');
        }

        /*
        |--------------------------------------------------------------------------
        | RESET
        |--------------------------------------------------------------------------
        */

        function reset() {
            button.prop('disabled', false);

            spinner.addClass('d-none');

            btnText.text('Update Role');
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATION ERRORS
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

                url: "<?= base_url('admin/roles/edit/' . $role['id']) ?>",

                type: "POST",

                data: form.serialize(),

                dataType: "json",

                success: function(response) {
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
                        response.message ||
                        'Role updated successfully',
                        'success'
                    );
                },

                error: function() {
                    reset();

                    showNotification(
                        'Server error occurred',
                        'error'
                    );
                }
            });
        });

    });
</script>

<?= $this->endSection() ?>