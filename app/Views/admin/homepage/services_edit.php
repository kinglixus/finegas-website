<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Edit Service

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
                    <a href="<?= base_url('admin/homepage/services') ?>">
                        Services
                    </a>
                </li>

                <li class="breadcrumb-item active">
                    Edit Service
                </li>

            </ol>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-xl-12">

        <div class="card">

            <div class="card-header">

                <h5 class="card-title">

                    Edit Homepage Service

                </h5>

            </div>

            <div class="card-body">

                <form action="<?= base_url('admin/homepage/services-update/' . $service['id']) ?>" method="post"
                    enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <div class="row">

                        <!-- TITLE -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Title

                            </label>

                            <input type="text" name="title" class="form-control" value="<?= esc($service['title']) ?>"
                                required>

                        </div>

                        <!-- SUBTITLE -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Subtitle

                            </label>

                            <input type="text" name="subtitle" class="form-control"
                                value="<?= esc($service['subtitle']) ?>">

                        </div>

                        <!-- DESCRIPTION -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Description

                            </label>

                            <textarea name="description" rows="6"
                                class="form-control"><?= esc($service['description']) ?></textarea>

                        </div>

                        <!-- ICON -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Icon

                            </label>

                            <input type="text" name="icon" id="icon" class="form-control"
                                value="<?= esc($service['icon']) ?>">

                        </div>

                        <!-- ICON PREVIEW -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Icon Preview

                            </label>

                            <div class="border rounded p-3 text-center">

                                <i id="iconPreview" class="<?= esc($service['icon']) ?>" style="font-size:40px;"></i>

                            </div>

                        </div>

                        <!-- IMAGE -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Replace Image

                            </label>

                            <input type="file" name="image" id="image" class="form-control" accept="image/*">

                            <small class="text-muted">

                                Leave blank to keep current image.

                            </small>

                        </div>

                        <!-- IMAGE PREVIEW -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Current Image

                            </label>

                            <div>

                                <img id="imagePreview" src="<?= !empty($service['image'])
                                                                ? base_url($service['image'])
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
                                value="<?= esc($service['button_text']) ?>">

                        </div>

                        <!-- BUTTON URL -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Button URL

                            </label>

                            <input type="text" name="button_url" class="form-control"
                                value="<?= esc($service['button_url']) ?>">

                        </div>

                        <!-- SORT ORDER -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Sort Order

                            </label>

                            <input type="number" name="sort_order" class="form-control"
                                value="<?= $service['sort_order'] ?>">

                        </div>

                        <!-- STATUS -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Status

                            </label>

                            <select name="status" class="form-select">

                                <option value="1" <?= $service['status'] == 1 ? 'selected' : '' ?>>

                                    Active

                                </option>

                                <option value="0" <?= $service['status'] == 0 ? 'selected' : '' ?>>

                                    Inactive

                                </option>

                            </select>

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex gap-2">

                        <button type="submit" class="btn btn-primary">

                            <i class="feather-save me-2"></i>

                            Update Service

                        </button>

                        <a href="<?= base_url('admin/homepage/services') ?>" class="btn btn-light">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

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

                const reader =
                    new FileReader();

                reader.onload =
                    function(event) {
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