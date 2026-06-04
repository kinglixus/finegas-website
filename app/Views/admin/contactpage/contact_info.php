<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Contact Information

        </h4>

        <p class="text-muted mb-0">

            Manage address, phones, emails and working hours.

        </p>

    </div>

    <a href="<?= base_url('admin/contactpage/create-contact-info') ?>" class="btn btn-primary">

        <i class="feather-plus me-2"></i>

        Add Contact Information

    </a>

</div>

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table id="contactInfoTable" class="table table-striped align-middle">

                <thead>

                    <tr>

                        <th>Title</th>

                        <th>Icon</th>

                        <th>Description</th>

                        <th>Sort Order</th>

                        <th>Status</th>

                        <th width="100">

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($contactInfo as $item): ?>

                        <tr>

                            <td>

                                <?= esc($item['title']) ?>

                            </td>

                            <td>

                                <?= esc($item['icon']) ?>

                            </td>

                            <td>

                                <?= esc(
                                    mb_strimwidth(
                                        strip_tags($item['description']),
                                        0,
                                        80,
                                        '...'
                                    )
                                ) ?>

                            </td>

                            <td>

                                <?= $item['sort_order'] ?>

                            </td>

                            <td>

                                <?php if ($item['status']): ?>

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

                                <div class="d-flex align-items-center gap-1">

                                    <a href="<?= base_url('admin/contactpage/edit-contact-info/' . $item['id']) ?>"
                                        class="btn btn-warning btn-sm d-flex align-items-center justify-content-center"
                                        style="width:32px;height:32px;padding:0;" title="Edit">

                                        <i class="feather-edit"></i>

                                    </a>

                                    <button type="button"
                                        class="btn btn-danger btn-sm btnDelete d-flex align-items-center justify-content-center"
                                        style="width:32px;height:32px;padding:0;" data-id="<?= $item['id'] ?>"
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

        $('#contactInfoTable').DataTable({
            responsive: true,
            autoWidth: false
        });

    });

    $(document).on(
        'click',
        '.btnDelete',
        function() {

            const id = $(this).data('id');

            Swal.fire({

                title: 'Delete Contact Information?',

                text: 'This action cannot be undone.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonText: 'Yes, Delete'

            }).then((result) => {

                if (result.value) {

                    $.ajax({

                        url: '<?= base_url('admin/contactpage/delete-contact-info') ?>/' + id,

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

                                    text: 'Contact information deleted successfully.'

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