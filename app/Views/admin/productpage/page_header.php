<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Page Header

        </h4>

        <div class="page-header-breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/home') ?>">

                        Dashboard

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/productpage') ?>">

                        Products CMS

                    </a>

                </li>

                <li class="breadcrumb-item active">

                    Page Header

                </li>

            </ol>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-xl-12">

        <?php if (session()->getFlashdata('success')): ?>

            <div class="alert alert-success">

                <?= esc(session()->getFlashdata('success')) ?>

            </div>

        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>

            <div class="alert alert-danger">

                <?= esc(session()->getFlashdata('error')) ?>

            </div>

        <?php endif; ?>

        <div class="card">

            <div class="card-header">

                <div>

                    <h5 class="card-title mb-1">

                        Product Page Header

                    </h5>

                    <p class="text-muted mb-0">

                        Manage the Products page banner image, title, and breadcrumb title.

                    </p>

                </div>

            </div>

            <div class="card-body">

                <form action="<?= base_url('admin/productpage/page-header-update') ?>" method="post"
                    enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <div class="row">

                        <!-- TITLE -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Title

                            </label>

                            <input type="text" name="title" class="form-control"
                                value="<?= esc($pageHeader['title'] ?? '') ?>" required>

                        </div>

                        <!-- SUBTITLE -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Subtitle

                            </label>

                            <input type="text" name="subtitle" class="form-control"
                                value="<?= esc($pageHeader['subtitle'] ?? '') ?>">

                        </div>

                        <!-- DESCRIPTION -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Description

                            </label>

                            <textarea name="description" rows="5"
                                class="form-control"><?= esc($pageHeader['description'] ?? '') ?></textarea>

                        </div>

                        <!-- HEADER IMAGE -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Header Image

                            </label>

                            <input type="file" name="image" id="image" class="form-control" accept="image/*">

                            <small class="text-muted">

                                Leave blank to keep the current header image.

                            </small>

                        </div>

                        <!-- CURRENT IMAGE PREVIEW -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Current Header Image

                            </label>

                            <div>

                                <img id="imagePreview" src="<?= !empty($pageHeader['image'])
                                                                ? base_url($pageHeader['image'])
                                                                : base_url('assets/admin/images/no-image.png') ?>"
                                    class="img-thumbnail" style="
                                        width: 320px;
                                        height: 180px;
                                        object-fit: cover;
                                    " alt="Product Page Header Image">

                            </div>

                        </div>

                        <!-- STATUS -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Status

                            </label>

                            <select name="status" class="form-select">

                                <option value="1" <?= ($pageHeader['status'] ?? 1) == 1 ? 'selected' : '' ?>>

                                    Active

                                </option>

                                <option value="0" <?= ($pageHeader['status'] ?? 1) == 0 ? 'selected' : '' ?>>

                                    Inactive

                                </option>

                            </select>

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex gap-2">

                        <button type="submit" class="btn btn-primary">

                            <i class="feather-save me-2"></i>

                            Save Page Header

                        </button>

                        <a href="<?= base_url('admin/productpage') ?>" class="btn btn-light">

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
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');

    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (!file) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function(event) {
                imagePreview.src = event.target.result;
            };

            reader.readAsDataURL(file);
        });
    }
</script>

<?= $this->endSection() ?>