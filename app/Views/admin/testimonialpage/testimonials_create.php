<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Create Testimonial

        </h4>

        <div class="page-header-breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/home') ?>">

                        Dashboard

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/testimonialpage') ?>">

                        Testimonials CMS

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/testimonialpage/testimonials') ?>">

                        Testimonials

                    </a>

                </li>

                <li class="breadcrumb-item active">

                    Create

                </li>

            </ol>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header">

        <h5 class="card-title mb-0">

            Create Testimonial

        </h5>

    </div>

    <div class="card-body">

        <form action="<?= base_url('admin/testimonialpage/store-testimonial') ?>" method="post"
            enctype="multipart/form-data">

            <?= csrf_field() ?>

            <div class="row">

                <!-- CLIENT NAME -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Client Name

                    </label>

                    <input type="text" name="title" class="form-control" required>

                </div>

                <!-- PROFESSION -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Profession / Position

                    </label>

                    <input type="text" name="subtitle" class="form-control">

                </div>

                <!-- ICON -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Icon

                    </label>

                    <input type="text" name="icon" id="icon" class="form-control" value="feather-message-circle">

                </div>

                <!-- ICON PREVIEW -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Icon Preview

                    </label>

                    <div class="border rounded p-3 text-center">

                        <i id="iconPreview" class="feather-message-circle" style="font-size:40px;"></i>

                    </div>

                </div>

                <!-- TESTIMONIAL -->

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Testimonial Message

                    </label>

                    <textarea name="description" rows="6" class="form-control" required></textarea>

                </div>

                <!-- CLIENT PHOTO -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Client Photo

                    </label>

                    <input type="file" name="image" id="image" class="form-control" accept="image/*">

                </div>

                <!-- PHOTO PREVIEW -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Photo Preview

                    </label>

                    <div>

                        <img id="imagePreview" src="<?= base_url('assets/admin/images/no-image.png') ?>"
                            class="img-thumbnail" style="
                                width:120px;
                                height:120px;
                                object-fit:cover;
                                border-radius:50%;
                            ">

                    </div>

                </div>

                <!-- SORT ORDER -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Sort Order

                    </label>

                    <input type="number" name="sort_order" value="1" class="form-control">

                </div>

                <!-- STATUS -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select name="status" class="form-select">

                        <option value="1">

                            Active

                        </option>

                        <option value="0">

                            Inactive

                        </option>

                    </select>

                </div>

            </div>

            <hr>

            <div class="d-flex gap-2">

                <button type="submit" class="btn btn-primary">

                    <i class="feather-save me-2"></i>

                    Save Testimonial

                </button>

                <a href="<?= base_url('admin/testimonialpage/testimonials') ?>" class="btn btn-light">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
$('#icon').on(
    'keyup',
    function() {
        $('#iconPreview')
            .attr(
                'class',
                $(this).val()
            );
    }
);

document
    .getElementById('image')
    .addEventListener(
        'change',
        function(e) {
            const file =
                e.target.files[0];

            if (!file) {
                return;
            }

            const reader =
                new FileReader();

            reader.onload =
                function(event) {
                    document
                        .getElementById(
                            'imagePreview'
                        )
                        .src =
                        event.target.result;
                };

            reader.readAsDataURL(
                file
            );
        }
    );
</script>

<?= $this->endSection() ?>