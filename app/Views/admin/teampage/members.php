<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Team Members

        </h4>

        <p class="text-muted mb-0">

            Manage team member profiles.

        </p>

    </div>

    <a
        href="<?= base_url('admin/teampage/create-member') ?>"
        class="btn btn-primary">

        <i class="feather-plus me-2"></i>

        Add Member

    </a>

</div>

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table
                id="memberTable"
                class="table table-striped align-middle">

                <thead>

                    <tr>

                        <th>Photo</th>

                        <th>Name</th>

                        <th>Position</th>

                        <th>Sort Order</th>

                        <th>Status</th>

                        <th width="100">

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($members as $member): ?>

                        <tr>

                            <td>

                                <img
                                    src="<?= !empty($member['image'])
                                                ? base_url($member['image'])
                                                : base_url('assets/admin/images/no-image.png') ?>"
                                    width="60"
                                    height="60"
                                    class="rounded-circle"
                                    style="object-fit:cover;">

                            </td>

                            <td>

                                <?= esc($member['title']) ?>

                            </td>

                            <td>

                                <?= esc($member['subtitle']) ?>

                            </td>

                            <td>

                                <?= $member['sort_order'] ?>

                            </td>

                            <td>

                                <?php if ($member['status']): ?>

                                    <span class="badge bg-success">

                                        Active

                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-danger">

                                        Inactive

                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <div class="d-flex gap-1">

                                    <a
                                        href="<?= base_url('admin/teampage/edit-member/' . $member['id']) ?>"
                                        class="btn btn-warning btn-sm"
                                        title="Edit">

                                        <i class="feather-edit"></i>

                                    </a>

                                    <button
                                        type="button"
                                        class="btn btn-danger btn-sm btnDelete"
                                        data-id="<?= $member['id'] ?>"
                                        title="Delete">

                                        <i class="feather-trash"></i>

                                    </button>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    $(document).ready(function() {
        $('#memberTable').DataTable({
            responsive: true
        });
    });

    $(document).on(
        'click',
        '.btnDelete',
        function() {
            const id = $(this).data('id');

            Swal.fire({

                title: 'Delete Team Member?',

                text: 'This action cannot be undone.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonText: 'Yes, Delete'

            }).then((result) => {
                if (result.value) {
                    $.ajax({

                        url: '<?= base_url('admin/teampage/delete-member') ?>/' + id,

                        type: 'POST',

                        dataType: 'json',

                        data: {
                            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                        },

                        success: function(response) {
                            if (response.status) {
                                Swal.fire({

                                    icon: 'success',

                                    title: 'Deleted',

                                    text: 'Member deleted successfully.'

                                }).then(() => {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
        }
    );
</script>

<?= $this->endSection() ?>