<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Homepage Services

        </h4>

        <p class="text-muted mb-0">

            Manage homepage services.

        </p>

    </div>

    <a href="<?= base_url('admin/homepage/services-create') ?>" class="btn btn-primary">

        <i class="feather-plus me-1"></i>

        Add Service

    </a>

</div>

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table id="servicesTable" class="table table-striped table-hover align-middle">

                <thead>

                    <tr>

                        <th width="100">

                            Image

                        </th>

                        <th>

                            Title

                        </th>

                        <th>

                            Icon

                        </th>

                        <th width="100">

                            Sort

                        </th>

                        <th width="100">

                            Status

                        </th>

                        <th width="120">

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($services as $service): ?>

                        <tr>

                            <td>

                                <?php if (!empty($service['image'])): ?>

                                    <img src="<?= base_url($service['image']) ?>" class="rounded border" width="80" height="60"
                                        style="object-fit:cover;">

                                <?php else: ?>

                                    <img src="<?= base_url('assets/admin/images/no-image.png') ?>" class="rounded border"
                                        width="80" height="60" style="object-fit:cover;">

                                <?php endif; ?>

                            </td>

                            <td>

                                <strong>

                                    <?= esc($service['title']) ?>

                                </strong>

                                <?php if (!empty($service['subtitle'])): ?>

                                    <br>

                                    <small class="text-muted">

                                        <?= esc($service['subtitle']) ?>

                                    </small>

                                <?php endif; ?>

                            </td>

                            <td>

                                <?php if (!empty($service['icon'])): ?>

                                    <i class="<?= esc($service['icon']) ?>" style="font-size:20px;"></i>

                                    <br>

                                    <small class="text-muted">

                                        <?= esc($service['icon']) ?>

                                    </small>

                                <?php endif; ?>

                            </td>

                            <td>

                                <?= $service['sort_order'] ?>

                            </td>

                            <td>

                                <?php if ($service['status']): ?>

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

                                <div class="btn-group">

                                    <a href="<?= base_url('admin/homepage/services-edit/' . $service['id']) ?>"
                                        class="btn btn-warning btn-sm" title="Edit">

                                        <i class="feather-edit"></i>

                                    </a>
                                    &nbsp; &nbsp;

                                    <button type="button" class="btn btn-danger btn-sm btnDelete"
                                        data-id="<?= $service['id'] ?>" title="Delete">

                                        <i class="feather-trash-2"></i>

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
        $('#servicesTable').DataTable({
            responsive: true
        });
    });

    $(document).on(
        'click',
        '.btnDelete',
        function() {
            const id =
                $(this).data('id');

            Swal.fire({

                title: 'Delete Service?',

                text: 'This action cannot be undone.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonText: 'Yes, Delete'

            }).then((result) => {
                if (result.value) {
                    $.ajax({

                        url: '<?= base_url('admin/homepage/services-delete') ?>/' +
                            id,

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

                                    text: 'Service deleted successfully.'

                                }).then(() => {
                                    location.reload();
                                });
                            }
                        },

                        error: function(xhr) {
                            console.log(xhr.responseText);

                            Swal.fire({

                                icon: 'error',

                                title: 'Delete Failed',

                                text: 'Unable to delete service.'

                            });
                        }
                    });
                }
            });
        }
    );
</script>

<?= $this->endSection() ?>