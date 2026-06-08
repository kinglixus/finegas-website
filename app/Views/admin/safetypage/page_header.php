<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Safety Page Header

        </h4>

        <p class="text-muted mb-0">

            Manage the safety tips page banner.

        </p>

    </div>

    <a href="<?= base_url('admin/safetypage') ?>" class="btn btn-light">

        Back

    </a>

</div>

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

    <div class="card-body">

        <form action="<?= base_url('admin/safetypage/page-header-update') ?>" method="post"
            enctype="multipart/form-data">

            <?= csrf_field() ?>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Title

                    </label>

                    <input type="text" name="title" class="form-control" value="<?= esc($page_header['title'] ?? '') ?>"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Subtitle

                    </label>

                    <input type="text" name="subtitle" class="form-control"
                        value="<?= esc($page_header['subtitle'] ?? '') ?>">

                </div>

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea name="description" rows="4"
                        class="form-control"><?= esc($page_header['description'] ?? '') ?></textarea>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Current Header Image

                    </label>

                    <div>

                        <img id="imagePreview" src="<?= !empty($page_header['image'])
                                                        ? base_url($page_header['image'])
                                                        : base_url('assets/img/carousel-1.jpg') ?>" class="img-thumbnail"
                            style="width:320px;height:180px;object-fit:cover;" alt="Safety Page Header">

                    </div>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Change Header Image

                    </label>

                    <input type="file" name="image" id="image" class="form-control" accept="image/*">

                    <small class="text-muted">

                        Recommended size: 1920 x 1080

                    </small>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select name="status" class="form-select">

                        <option value="1" <?= (($page_header['status'] ?? 1) == 1) ? 'selected' : '' ?>>

                            Active

                        </option>

                        <option value="0" <?= (($page_header['status'] ?? 1) == 0) ? 'selected' : '' ?>>

                            Inactive

                        </option>

                    </select>

                </div>

            </div>

            <button type="submit" class="btn btn-primary">

                <i class="feather-save me-2"></i>

                Update Page Header

            </button>

        </form>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];

        if (!file) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function(event) {
            document.getElementById('imagePreview').src = event.target.result;
        };

        reader.readAsDataURL(file);
    });
</script>

<?= $this->endSection() ?>