<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Edit Testimonial

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

                    Edit

                </li>

            </ol>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header">

        <h5 class="card-title mb-0">

            Edit Testimonial

        </h5>

    </div>

    <div class="card-body">

        <form action="<?= base_url('admin/testimonialpage/update-testimonial/' . $testimonial['id']) ?>" method="post"
            enctype="multipart/form-data">

            <?= csrf_field() ?>

            <div class="row">

                <!-- CLIENT NAME -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Client Name

                    </label>

                    <input type="text" name="title" class="form-control" value="<?= esc($testimonial['title']) ?>"
                        required>

                </div>

                <!-- PROFESSION -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Profession / Position

                    </label>

                    <input type="text" name="subtitle" class="form-control"
                        value="<?= esc($testimonial['subtitle']) ?>">

                </div>

                <!-- ICON -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Icon

                    </label>

                    <input type="text" name="icon" id="icon" class="form-control"
                        value="<?= esc($testimonial['icon']) ?>">

                </div>

                <!-- ICON PREVIEW -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Icon Preview

                    </label>

                    <div class="border rounded p-3 text-center">

                        <i id="iconPreview" class="<?= esc($testimonial['icon']) ?>" style="font-size:40px;"></i>

                    </div>

                </div>

                <!-- TESTIMONIAL MESSAGE -->

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Testimonial Message

                    </label>

                    <textarea name="description" rows="6" class="form-control"
                        required><?= esc($testimonial['description']) ?></textarea>

                </div>

                <!-- CURRENT IMAGE -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Current Photo

                    </label>

                    <div>

                        <img id="imagePreview" src="<?= !empty($testimonial['image'])
                                                        ? base_url($testimonial['image'])
                                                        : base_url('assets/admin/images/no-image.png') ?>"
                            class="img-thumbnail" style="
                                width:120px;
                                height:120px;
                                object-fit:cover;
                                border-radius:50%;
                            ">

                    </div>

                </div>

                <!-- NEW IMAGE -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Change Photo

                    </label>

                    <input type="file" name="image" id="image" class="form-control" accept="image/*">

                </div>

                <!-- SORT ORDER -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Sort Order

                    </label>

                    <input type="number" name="sort_order" class="form-control"
                        value="<?= $testimonial['sort_order'] ?>">

                </div>

                <!-- STATUS -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select name="status" class="form-select">

                        <option value="1" <?= $testimonial['status'] == 1 ? 'selected' : '' ?>>

                            Active

                        </option>

                        <option value="0" <?= $testimonial['status'] == 0 ? 'selected' : '' ?>>

                            Inactive

                        </option>

                    </select>

                </div>

            </div>

            <hr>

            <div class="d-flex gap-2">

                <button type="submit" class="btn btn-primary">

                    <i class="feather-save me-2"></i>

                    Update Testimonial

                </button>

                <a href="<?= base_url('admin/testimonialpage/testimonial') ?>" class="btn btn-light">

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
            const file = e.target.files[0];

            if (!file) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function(event) {
                document
                    .getElementById('imagePreview')
                    .src =
                    event.target.result;
            };

            reader.readAsDataURL(file);
        }
    );
</script>

<?= $this->endSection() ?>