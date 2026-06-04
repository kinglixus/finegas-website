<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Why Choose Us

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

                <li class="breadcrumb-item active">

                    Why Choose Us

                </li>

            </ol>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-xl-12">

        <div class="card">

            <div class="card-header">

                <div>

                    <h5 class="card-title mb-1">

                        Why Choose Us Section

                    </h5>

                    <p class="text-muted mb-0">

                        Manage homepage Why Choose Us content.

                    </p>

                </div>

            </div>

            <div class="card-body">

                <form action="<?= base_url('admin/homepage/choose-us-update') ?>" method="post"
                    enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <div class="row">

                        <!-- TITLE -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Title

                            </label>

                            <input type="text" name="title" class="form-control"
                                value="<?= esc($chooseUs['title'] ?? '') ?>">

                        </div>

                        <!-- SUBTITLE -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Subtitle

                            </label>

                            <input type="text" name="subtitle" class="form-control"
                                value="<?= esc($chooseUs['subtitle'] ?? '') ?>">

                        </div>

                        <!-- DESCRIPTION -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Description

                            </label>

                            <textarea name="description" rows="6"
                                class="form-control"><?= esc($chooseUs['description'] ?? '') ?></textarea>

                        </div>

                        <!-- IMAGE -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Replace Image

                            </label>

                            <input type="file" name="image" id="image" class="form-control" accept="image/*">

                            <small class="text-muted">

                                Leave blank to keep the current image.

                            </small>

                        </div>

                        <!-- IMAGE PREVIEW -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Current Image

                            </label>

                            <div>

                                <img id="imagePreview" src="<?= !empty($chooseUs['image'])
                                                                ? base_url($chooseUs['image'])
                                                                : base_url('assets/admin/images/no-image.png') ?>"
                                    class="img-thumbnail" style="
                                        width:300px;
                                        height:180px;
                                        object-fit:cover;
                                    ">

                            </div>

                        </div>

                        <!-- STATUS -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Status

                            </label>

                            <select name="status" class="form-select">

                                <option value="1" <?= ($chooseUs['status'] ?? 1) == 1 ? 'selected' : '' ?>>

                                    Active

                                </option>

                                <option value="0" <?= ($chooseUs['status'] ?? 1) == 0 ? 'selected' : '' ?>>

                                    Inactive

                                </option>

                            </select>

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex gap-2">

                        <button type="submit" class="btn btn-primary">

                            <i class="feather-save me-2"></i>

                            Save Why Choose Us

                        </button>

                        <a href="<?= base_url('admin/homepage') ?>" class="btn btn-light">

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