<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Testimonials

        </h4>

        <p class="text-muted mb-0">

            Manage client testimonials.

        </p>

    </div>

    <a href="<?= base_url('admin/testimonialpage/create-testimonial') ?>" class="btn btn-primary">

        <i class="feather-plus me-2"></i>

        Add Testimonial

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

            <table id="testimonialTable" class="table table-striped align-middle">

                <thead>

                    <tr>

                        <th>Photo</th>

                        <th>Name</th>

                        <th>Profession</th>

                        <th>Sort Order</th>

                        <th>Status</th>

                        <th width="100">

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (!empty($testimonials)): ?>

                        <?php foreach ($testimonials as $testimonial): ?>

                            <tr>

                                <td>

                                    <img src="<?= !empty($testimonial['image'])
                                                    ? base_url($testimonial['image'])
                                                    : base_url('public/assets/img/testimonial-1.jpg') ?>" width="60"
                                        height="60" class="rounded-circle" style="object-fit:cover;"
                                        alt="<?= esc($testimonial['title'] ?? 'Testimonial') ?>">

                                </td>

                                <td>

                                    <?= esc($testimonial['title'] ?? '') ?>

                                </td>

                                <td>

                                    <?= esc($testimonial['subtitle'] ?? '') ?>

                                </td>

                                <td>

                                    <?= esc($testimonial['sort_order'] ?? 0) ?>

                                </td>

                                <td>

                                    <?php if (($testimonial['status'] ?? 0) == 1): ?>

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

                                        <a href="<?= base_url('admin/testimonialpage/edit-testimonial/' . $testimonial['id']) ?>"
                                            class="btn btn-warning btn-sm" title="Edit">

                                            <i class="feather-edit"></i>

                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm btnDelete"
                                            data-id="<?= esc($testimonial['id']) ?>" title="Delete">

                                            <i class="feather-trash"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="6" class="text-center text-muted">

                                No testimonials found.

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
        $('#testimonialTable').DataTable({
            responsive: true,
            autoWidth: false
        });
    });

    $(document).on('click', '.btnDelete', function() {
        const id = $(this).data('id');

        Swal.fire({
            title: 'Delete Testimonial?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?= base_url('admin/testimonialpage/delete-testimonial') ?>/' + id,
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
                                text: 'Testimonial deleted successfully.'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed',
                                text: response.message ||
                                    'Unable to delete testimonial.'
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