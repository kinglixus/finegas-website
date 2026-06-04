<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    ```
    <div class="page-header-left">

        <h4 class="page-title">

            Edit Homepage Slide

        </h4>

        <div class="page-header-breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/home') ?>">

                        Dashboard

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/homepage') ?>">

                        Homepage CMS

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/homepage/sliders') ?>">

                        Sliders

                    </a>

                </li>

                <li class="breadcrumb-item active">

                    Edit

                </li>

            </ol>

        </div>

    </div>
    ```

</div>

<div class="row">

    ```
    <div class="col-xl-12">

        <div class="card">

            <div class="card-header">

                <div>

                    <h5 class="card-title mb-1">

                        Edit Homepage Slider

                    </h5>

                    <p class="text-muted mb-0">

                        Update homepage carousel slide.

                    </p>

                </div>

            </div>

            <div class="card-body">

                <form action="<?= base_url(
                                    'admin/homepage/sliders-update/' .
                                        $slider['id']
                                ) ?>" method="post" enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <div class="row">

                        <!-- TITLE -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Title

                                <span class="text-danger">*</span>

                            </label>

                            <input type="text" name="title" class="form-control" value="<?= esc($slider['title']) ?>"
                                required>

                        </div>

                        <!-- DESCRIPTION -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Description

                            </label>

                            <textarea name="description" rows="5"
                                class="form-control"><?= esc($slider['description']) ?></textarea>

                        </div>

                        <!-- IMAGE -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Replace Slider Image

                            </label>

                            <input type="file" name="image" id="image" accept="image/*" class="form-control">

                            <small class="text-muted">

                                Leave blank to keep existing image.

                            </small>

                        </div>

                        <!-- IMAGE PREVIEW -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Current Image

                            </label>

                            <div>

                                <img id="imagePreview" src="<?= !empty($slider['image'])
                                                                ? base_url($slider['image'])
                                                                : base_url('assets/admin/images/no-image.png') ?>"
                                    class="img-thumbnail" style="
                                    width:300px;
                                    height:180px;
                                    object-fit:cover;
                                ">

                            </div>

                        </div>

                        <!-- BUTTON TEXT -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Button Text

                            </label>

                            <input type="text" name="button_text" class="form-control"
                                value="<?= esc($slider['button_text']) ?>">

                        </div>

                        <!-- BUTTON URL -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Button URL

                            </label>

                            <input type="text" name="button_url" class="form-control"
                                value="<?= esc($slider['button_url']) ?>">

                        </div>

                        <!-- SORT ORDER -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Sort Order

                            </label>

                            <input type="number" name="sort_order" class="form-control"
                                value="<?= $slider['sort_order'] ?>">

                        </div>

                        <!-- STATUS -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Status

                            </label>

                            <select name="status" class="form-select">

                                <option value="1" <?= $slider['status'] == 1 ? 'selected' : '' ?>>

                                    Active

                                </option>

                                <option value="0" <?= $slider['status'] == 0 ? 'selected' : '' ?>>

                                    Inactive

                                </option>

                            </select>

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex gap-2">

                        <button type="submit" class="btn btn-primary">

                            <i class="feather-save me-2"></i>

                            Update Slider

                        </button>

                        <a href="<?= base_url(
                                        'admin/homepage/sliders'
                                    ) ?>" class="btn btn-light">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>
    ```

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
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





<?= $this->endSection() ?>