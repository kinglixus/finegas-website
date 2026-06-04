<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="row">

    <div class="col-12">

        <div class="card border-0 shadow-sm">

            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">All Users</h5>
                <?php if (can('users.create')): ?>
                    <a href="<?= base_url('admin/users/create') ?>" class="btn btn-primary">
                        <i class="feather-plus me-2"></i>Add User
                    </a>
                <?php endif; ?>
            </div>

            <div class="card-body">

                <!-- ===================================================== -->
                <!-- SEARCH -->
                <!-- ===================================================== -->


                <div class="row mb-4">

                    <div class="d-flex justify-content-end mt-2">

                        <div style="width: 320px;">

                            <div class="position-relative">

                                <input type="text" id="userSearch"
                                    class="form-control ps-5 border-2 shadow-sm border-primary"
                                    placeholder="Search users...">

                                <i class="feather-search position-absolute" style="
                                    top:50%;
                                    left:15px;
                                    transform:translateY(-50%);
                                    color:#6c757d;
                                ">

                                </i>

                            </div>

                        </div>

                    </div>

                </div>
                <!-- ===================================================== -->
                <!-- TABLE -->
                <!-- ===================================================== -->

                <div class="table-responsive">

                    <table class="table table-hover align-middle" width="100%">

                        <thead class="table-light">

                            <tr>

                                <th>#</th>

                                <th>User</th>

                                <th>Email</th>

                                <th>Role</th>

                                <th>Status</th>

                                <th width="120">Actions</th>

                            </tr>

                        </thead>

                        <tbody id="usersTableBody">

                            <?php include 'ajax/table_rows.php'; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- DELETE USER -->
<!-- ===================================================== -->
<!-- DELETE USER MODAL -->
<!-- ===================================================== -->

<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <div class="modal-header">

                <h5 class="modal-title">

                    Delete User

                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal">

                </button>

            </div>

            <div class="modal-body">

                <p class="mb-0">

                    Are you sure you want to delete:

                    <strong id="deleteUserName"></strong>?

                </p>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-light" data-bs-dismiss="modal">

                    Cancel

                </button>

                <button type="button" id="confirmDeleteUserBtn" class="btn btn-danger">

                    <span class="spinner-border spinner-border-sm d-none me-2"></span>

                    Delete User

                </button>

            </div>

        </div>

    </div>

</div>

<!-- ===================================================== -->
<!-- RESET USER PASSWORD MODAL -->
<!-- ===================================================== -->

<!-- ===================================================== -->
<!-- SEND TEMP PASSWORD MODAL -->
<!-- ===================================================== -->

<div class="modal fade" id="tempPasswordModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <div class="modal-header">

                <h5 class="modal-title">

                    Send Temporary Password

                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal">

                </button>

            </div>

            <div class="modal-body">

                <p class="mb-0">

                    Send temporary login password to:

                    <strong id="tempPasswordUserName"></strong>?

                </p>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-light" data-bs-dismiss="modal">

                    Cancel

                </button>

                <button type="button" id="confirmTempPasswordBtn" class="btn btn-dark">

                    <span class="spinner-border spinner-border-sm d-none me-2"></span>

                    Send Password

                </button>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>

<!-- TOGGLE STATUS  -->
<?= $this->section('scripts') ?>

<script>
    $(document).on(
        'change',
        '.user-status-toggle',
        function() {

            const toggle =
                $(this);

            const userId =
                toggle.data('id');

            const status =
                toggle.is(':checked')

                ?
                'active'

                :
                'inactive';

            /*
            |--------------------------------------------------------------------------
            | DISABLE TOGGLE
            |--------------------------------------------------------------------------
            */

            toggle.prop(
                'disabled',
                true
            );

            $.ajax({

                headers: {

                    'X-Requested-With': 'XMLHttpRequest'
                },

                url: "<?= base_url('admin/users/status') ?>/" + userId,

                type: "POST",

                data: {

                    status: status
                },

                dataType: "json",

                success: function(response) {
                    toggle.prop(
                        'disabled',
                        false
                    );

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

                        toggle.prop(
                            'checked',
                            !toggle.is(':checked')
                        );

                        return;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | UPDATE LABEL
                    |--------------------------------------------------------------------------
                    */

                    toggle
                        .closest('.form-check')
                        .find('.status-label')
                        .text(
                            status.charAt(0)
                            .toUpperCase() +
                            status.slice(1)
                        );

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
                    toggle.prop(
                        'disabled',
                        false
                    );

                    toggle.prop(
                        'checked',
                        !toggle.is(':checked')
                    );

                    showNotification(

                        'Failed to update user status',

                        'error'
                    );
                }
            });
        });
</script>

<!-- SEARCH USERS -->
<script>
    let searchTimer;

    $('#userSearch').on(
        'keyup',
        function() {

            clearTimeout(
                searchTimer
            );

            const keyword =
                $(this).val();

            /*
            |--------------------------------------------------------------------------
            | DEBOUNCE
            |--------------------------------------------------------------------------
            */

            searchTimer =
                setTimeout(function() {

                    $.ajax({

                        headers: {

                            'X-Requested-With': 'XMLHttpRequest'
                        },

                        url: "<?= base_url('admin/users/search') ?>",

                        type: "GET",

                        data: {

                            keyword: keyword
                        },

                        beforeSend: function() {
                            $('#usersTableBody')
                                .html(`

                        <tr>

                            <td colspan="7"
                                class="text-center py-5">

                                <div class="spinner-border text-primary"></div>

                            </td>

                        </tr>

                    `);
                        },

                        success: function(response) {
                            $('#usersTableBody')
                                .html(response);
                        },

                        error: function() {
                            showNotification(

                                'Failed to search users',

                                'error'
                            );
                        }
                    });

                }, 400);
        });
</script>

<!-- DELETE USER -->
<script>
    let deleteUserId = null;

    /*
    |--------------------------------------------------------------------------
    | OPEN MODAL
    |--------------------------------------------------------------------------
    */

    $(document).on(
        'click',
        '.delete-user-btn',
        function() {

            deleteUserId =
                $(this).data('id');

            const name =
                $(this).data('name');

            $('#deleteUserName')
                .text(name);

            $('#deleteUserModal')
                .modal('show');
        });

    /*
    |--------------------------------------------------------------------------
    | CONFIRM DELETE
    |--------------------------------------------------------------------------
    */

    $('#confirmDeleteUserBtn').on(
        'click',
        function() {

            if (!deleteUserId) {
                return;
            }

            const btn =
                $(this);

            /*
            |--------------------------------------------------------------------------
            | LOADING
            |--------------------------------------------------------------------------
            */

            btn.prop(
                'disabled',
                true
            );

            btn.find('.spinner-border')
                .removeClass('d-none');

            $.ajax({

                headers: {

                    'X-Requested-With': 'XMLHttpRequest'
                },

                url: "<?= base_url('admin/users/delete') ?>/" +
                    deleteUserId,

                type: "POST",

                dataType: "json",

                success: function(response) {
                    btn.prop(
                        'disabled',
                        false
                    );

                    btn.find('.spinner-border')
                        .addClass('d-none');

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
                    | REMOVE ROW
                    |--------------------------------------------------------------------------
                    */

                    $('#user-row-' + deleteUserId)
                        .fadeOut(300, function() {
                            $(this).remove();
                        });

                    /*
                    |--------------------------------------------------------------------------
                    | CLOSE MODAL
                    |--------------------------------------------------------------------------
                    */

                    $('#deleteUserModal')
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
                },

                error: function() {
                    btn.prop(
                        'disabled',
                        false
                    );

                    btn.find('.spinner-border')
                        .addClass('d-none');

                    showNotification(

                        'Failed to delete user',

                        'error'
                    );
                }
            });
        });
</script>

<!-- SEND TEMP PASSWORD -->
<script>
    let tempPasswordUserId = null;

    /*
    |--------------------------------------------------------------------------
    | OPEN MODAL
    |--------------------------------------------------------------------------
    */

    $(document).on(
        'click',
        '.send-temp-password-btn',
        function() {

            tempPasswordUserId =
                $(this).data('id');

            const name =
                $(this).data('name');

            $('#tempPasswordUserName')
                .text(name);

            $('#tempPasswordModal')
                .modal('show');
        });

    /*
    |--------------------------------------------------------------------------
    | SEND TEMP PASSWORD
    |--------------------------------------------------------------------------
    */

    $('#confirmTempPasswordBtn').on(
        'click',
        function() {

            if (!tempPasswordUserId) {
                return;
            }

            const btn =
                $(this);

            btn.prop(
                'disabled',
                true
            );

            btn.find('.spinner-border')
                .removeClass('d-none');

            $.ajax({

                headers: {

                    'X-Requested-With': 'XMLHttpRequest'
                },

                url: "<?= base_url('admin/users/send-temp-password') ?>/" +
                    tempPasswordUserId,

                type: "POST",

                dataType: "json",

                success: function(response) {
                    btn.prop(
                        'disabled',
                        false
                    );

                    btn.find('.spinner-border')
                        .addClass('d-none');

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
                    | SUCCESS
                    |--------------------------------------------------------------------------
                    */

                    $('#tempPasswordModal')
                        .modal('hide');

                    showNotification(

                        response.message,

                        'success'
                    );
                },

                error: function() {
                    btn.prop(
                        'disabled',
                        false
                    );

                    btn.find('.spinner-border')
                        .addClass('d-none');

                    showNotification(

                        'Failed to send temporary password',

                        'error'
                    );
                }
            });
        });
</script>
<?= $this->endSection() ?>