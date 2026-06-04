<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Products

        </h4>

        <p class="text-muted mb-0">

            Manage Products Page product listings.

        </p>

    </div>

    <a
        href="<?= base_url('admin/productpage/create-product') ?>"
        class="btn btn-primary">

        <i class="feather-plus me-2"></i>

        Add Product

    </a>

</div>

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table
                id="productTable"
                class="table table-striped align-middle">

                <thead>

                    <tr>

                        <th>Image</th>

                        <th>Product Name</th>

                        <th>Filter Class</th>

                        <th>Sort Order</th>

                        <th>Status</th>

                        <th width="100">

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($products as $product): ?>

                        <?php
                        $extraData =
                            !empty($product['extra_data'])
                            ? json_decode(
                                $product['extra_data'],
                                true
                            )
                            : [];
                        ?>

                        <tr>

                            <td>

                                <img
                                    src="<?= !empty($product['image'])
                                                ? base_url($product['image'])
                                                : base_url('assets/admin/images/no-image.png') ?>"
                                    width="70"
                                    height="70"
                                    class="rounded"
                                    style="object-fit:cover;">

                            </td>

                            <td>

                                <?= esc($product['title']) ?>

                            </td>

                            <td>

                                <?= esc($extraData['filter_class'] ?? '-') ?>

                            </td>

                            <td>

                                <?= $product['sort_order'] ?>

                            </td>

                            <td>

                                <?php if ($product['status']): ?>

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
                                        href="<?= base_url('admin/productpage/edit-product/' . $product['id']) ?>"
                                        class="btn btn-warning btn-sm"
                                        title="Edit">

                                        <i class="feather-edit"></i>

                                    </a>

                                    <button
                                        type="button"
                                        class="btn btn-danger btn-sm btnDelete"
                                        data-id="<?= $product['id'] ?>"
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
        $('#productTable').DataTable({

            responsive: true,

            autoWidth: false
        });
    });

    $(document).on(
        'click',
        '.btnDelete',
        function() {
            const id =
                $(this).data('id');

            Swal.fire({

                title: 'Delete Product?',

                text: 'This action cannot be undone.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonText: 'Yes, Delete'

            }).then((result) => {
                if (result.value) {
                    $.ajax({

                        url: '<?= base_url('admin/productpage/delete-product') ?>/' + id,

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

                                    text: 'Product deleted successfully.'

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