<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Team Members

        </h4>

        <p class="text-muted mb-0">

            Manage all team member profiles.

        </p>

    </div>

    <div class="d-flex gap-2">

        <a href="<?= base_url('admin/teampage') ?>" class="btn btn-light">

            Back

        </a>

        <a href="<?= base_url('admin/teampage/create-team-member') ?>" class="btn btn-primary">

            <i class="feather-plus me-2"></i>

            Add Team Member

        </a>

    </div>

</div>

<?php if (session()->getFlashdata('success')): ?>

    <div class="alert alert-success">

        <?= esc(session()->getFlashdata('success')) ?>

    </div>

<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>

    <div class="alert alert-danger">

        <?= esc(session()->getFlashdata('error')) ?>

    </div>

<?php endif; ?>

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table id="teamMembersTable" class="table table-striped align-middle">

                <thead>

                    <tr>

                        <th>Photo</th>

                        <th>Name</th>

                        <th>Position</th>

                        <th>Sort Order</th>

                        <th>Status</th>

                        <th width="110">Action</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (!empty($teamMembers)): ?>

                        <?php foreach ($teamMembers as $member): ?>

                            <tr>

                                <td>

                                    <img src="<?= !empty($member['image'])
                                                    ? base_url($member['image'])
                                                    : base_url('assets/img/team-1.jpg') ?>" width="60" height="60"
                                        class="rounded-circle" style="object-fit:cover;"
                                        alt="<?= esc($member['title'] ?? 'Team Member') ?>">

                                </td>

                                <td>

                                    <?= esc($member['title'] ?? '') ?>

                                </td>

                                <td>

                                    <?= esc($member['subtitle'] ?? '') ?>

                                </td>

                                <td>

                                    <?= esc($member['sort_order'] ?? 0) ?>

                                </td>

                                <td>

                                    <?php if (($member['status'] ?? 0) == 1): ?>

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

                                        <a href="<?= base_url('admin/teampage/edit-team-member/' . $member['id']) ?>"
                                            class="btn btn-warning btn-sm" title="Edit">

                                            <i class="feather-edit"></i>

                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm btnDelete"
                                            data-id="<?= esc($member['id']) ?>" title="Delete">

                                            <i class="feather-trash"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="6" class="text-center text-muted">

                                No team members found.

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    $(document).ready(function() {
        $('#teamMembersTable').DataTable({
            responsive: true,
            autoWidth: false
        });
    });

    $(document).on('click', '.btnDelete', function() {
        const id = $(this).data('id');

        Swal.fire({
            title: 'Delete Team Member?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?= base_url('admin/teampage/delete-team-member') ?>/' + id,
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
                                text: 'Team member deleted successfully.'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed',
                                text: response.message ||
                                    'Unable to delete team member.'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong. Please try again.'
                        });
                    }
                });
            }
        });
    });
</script>

<?= $this->endSection() ?>