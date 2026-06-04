<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Services

        </h4>

        <p class="text-muted mb-0">

            Manage Services Page service listings.

        </p>

    </div>

    <a href="<?= base_url('admin/servicepage/create-service') ?>" class="btn btn-primary">

        <i class="feather-plus me-2"></i>

        Add Service

    </a>

</div>

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table id="serviceTable" class="table table-striped align-middle">

                <thead>

                    <tr>

                        <th>Image</th>

                        <th>Title</th>

                        <th>Icon</th>

                        <th>Sort Order</th>

                        <th>Status</th>

                        <th width="100">

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($services as $service): ?>

                        <tr>

                            <td class="align-middle">

                                <img src="<?= base_url($service['image']) ?>" width="80" class="rounded">

                            </td>

                            <td class="align-middle">

                                <?= esc($service['title']) ?>

                            </td>

                            <td class="align-middle">

                                <?= esc($service['icon']) ?>

                            </td>

                            <td class="align-middle">

                                <?= $service['sort_order'] ?>

                            </td>

                            <td class="align-middle">

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

                            <td class="align-middle">

                                <div class="d-flex gap-1">

                                    <a href="<?= base_url('admin/servicepage/edit-service/' . $service['id']) ?>"
                                        class="btn btn-warning btn-sm" title="Edit">

                                        <i class="feather-edit"></i>

                                    </a>

                                    <button type="button" class="btn btn-danger btn-sm btnDelete"
                                        data-id="<?= $service['id'] ?>" title="Delete">

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
<script>
    console.log('SERVICE DELETE SCRIPT LOADED');
</script>
<?= $this->section('scripts') ?>

<script>
    $(document).ready(function() {

        $('#serviceTable').DataTable({
            responsive: true,
            autoWidth: false
        });

    });
</script>

<script>
    $(document).on(
        'click',
        '.btnDelete',
        function() {
            const id = $(this).data('id');

            console.log('Delete clicked');
            console.log('Service ID:', id);

            Swal.fire({

                title: 'Delete Service?',

                text: 'This action cannot be undone.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonText: 'Yes, Delete'

            }).then((result) => {
                console.log(result);

                /*
                |--------------------------------------------------------------------------
                | SWEETALERT VERSION COMPATIBILITY
                |--------------------------------------------------------------------------
                */

                if (result.value) {
                    console.log('YES CLICKED');

                    $.ajax({

                        url: '<?= base_url('admin/servicepage/delete-service') ?>/' + id,

                        type: 'POST',

                        dataType: 'json',

                        data: {
                            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                        },

                        beforeSend: function() {
                            console.log('AJAX STARTED');
                        },

                        success: function(response) {
                            console.log('SUCCESS');
                            console.log(response);

                            if (response.status) {
                                Swal.fire({

                                    icon: 'success',

                                    title: 'Deleted',

                                    text: 'Service deleted successfully.'

                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({

                                    icon: 'error',

                                    title: 'Error',

                                    text: 'Unable to delete service.'

                                });
                            }
                        },

                        error: function(xhr) {
                            console.log('ERROR');
                            console.log(xhr.status);
                            console.log(xhr.responseText);

                            Swal.fire({

                                icon: 'error',

                                title: 'Delete Failed',

                                text: 'Check browser console for details.'

                            });
                        }

                    });
                }
            });
        }
    );
</script>

<?= $this->endSection() ?>