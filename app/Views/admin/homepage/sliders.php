<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Homepage Sliders

        </h4>

        <p class="text-muted mb-0">

            Manage homepage carousel slides.

        </p>

    </div>

    <a href="<?= base_url('admin/homepage/createslider') ?>" class="btn btn-primary">

        <i class="feather-plus"></i>

        Add Slide

    </a>

</div>

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table id="sliderTable" class="table table-striped">

                <thead>

                    <tr>

                        <th>Image</th>

                        <th>Title</th>

                        <th>Button</th>

                        <th>Sort Order</th>

                        <th>Status</th>

                        <th width="180">

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($sliders as $slider): ?>

                        <tr>

                            <td>

                                <img src="<?= base_url($slider['image']) ?>" width="80" class="rounded">

                            </td>

                            <td>

                                <?= esc($slider['title']) ?>

                            </td>

                            <td>

                                <?= esc($slider['button_text']) ?>

                            </td>

                            <td>

                                <?= $slider['sort_order'] ?>

                            </td>

                            <td>

                                <?php if ($slider['status']): ?>

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

                                    <a href="<?= base_url('admin/homepage/sliders_edit/' . $slider['id']) ?>"
                                        class="btn btn-warning btn-sm px-2">

                                        <i class="feather-edit me-1"></i>
                                        Edit

                                    </a>

                                    <button type="button" class="btn btn-danger btn-sm px-2 btnDelete"
                                        data-id="<?= $slider['id'] ?>">

                                        <i class="feather-trash-2 me-1"></i>
                                        Delete

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

<!-- <script>
    console.log('DELETE SCRIPT LOADED');
</script> -->

<script>
    $(document).ready(function() {
        $('#sliderTable').DataTable({
            responsive: true
        });
    });
</script>
<script>
    $(document).on(
        'click',
        '.btnDelete',
        function() {
            const id = $(this).data('id');

            console.log('Delete button clicked');
            console.log('Slider ID:', id);

            Swal.fire({

                title: 'Delete Slider?',

                text: 'This action cannot be undone.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonText: 'Yes, Delete',

                cancelButtonText: 'Cancel'

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

                        url: '<?= base_url('admin/homepage/sliders-delete') ?>/' +
                            id,

                        type: 'POST',

                        dataType: 'json',

                        data: {
                            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                        },

                        beforeSend: function() {
                            console.log(
                                'Sending delete request...'
                            );
                        },

                        success: function(response) {
                            console.log('SUCCESS');
                            console.log(response);

                            if (response.status) {
                                Swal.fire({

                                    icon: 'success',

                                    title: 'Deleted',

                                    text: 'Slider deleted successfully.'

                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({

                                    icon: 'error',

                                    title: 'Delete Failed',

                                    text: 'Unable to delete slider.'

                                });
                            }
                        },

                        error: function(xhr) {
                            console.log('ERROR');
                            console.log(xhr.status);
                            console.log(xhr.responseText);

                            Swal.fire({

                                icon: 'error',

                                title: 'Request Failed',

                                text: 'Check browser console.'

                            });
                        }
                    });
                }
            });
        }
    );
</script>


<?= $this->endSection() ?>