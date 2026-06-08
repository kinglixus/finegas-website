<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Safety Tips

        </h4>

        <p class="text-muted mb-0">

            Manage safety tip cards.

        </p>

    </div>

    <a href="<?= base_url('admin/safetypage/create-safety-tip') ?>" class="btn btn-primary">

        <i class="feather-plus me-2"></i>

        Add Safety Tip

    </a>

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

            <table id="safetyTipsTable" class="table table-striped align-middle">

                <thead>

                    <tr>

                        <th>Icon</th>

                        <th>Title</th>

                        <th>Description</th>

                        <th>Sort Order</th>

                        <th>Status</th>

                        <th width="100">Action</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (!empty($safety_tips)): ?>

                        <?php foreach ($safety_tips as $tip): ?>

                            <tr>

                                <td>

                                    <i class="<?= esc($tip['icon'] ?? 'fa fa-check-circle') ?> text-primary"
                                        style="font-size:24px;"></i>

                                </td>

                                <td><?= esc($tip['title'] ?? '') ?></td>

                                <td><?= esc(character_limiter($tip['description'] ?? '', 90)) ?></td>

                                <td><?= esc($tip['sort_order'] ?? 0) ?></td>

                                <td>

                                    <?php if (($tip['status'] ?? 0) == 1): ?>

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

                                        <a href="<?= base_url('admin/safetypage/edit-safety-tip/' . $tip['id']) ?>"
                                            class="btn btn-warning btn-sm" title="Edit">

                                            <i class="feather-edit"></i>

                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm btnDelete"
                                            data-id="<?= esc($tip['id']) ?>" title="Delete">

                                            <i class="feather-trash"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="6" class="text-center text-muted">

                                No safety tips found.

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
        $('#safetyTipsTable').DataTable({
            responsive: true,
            autoWidth: false
        });
    });

    $(document).on('click', '.btnDelete', function() {
        const id = $(this).data('id');

        Swal.fire({
            title: 'Delete Safety Tip?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?= base_url('admin/safetypage/delete-safety-tip') ?>/' + id,
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
                                text: response.message ||
                                    'Safety Tip deleted successfully.'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed',
                                text: response.message || 'Unable to delete safety tip.'
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