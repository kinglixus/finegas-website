<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Add Team Member

        </h4>

        <div class="page-header-breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/home') ?>">

                        Dashboard

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/teampage') ?>">

                        Team Page CMS

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/teampage/team-members') ?>">

                        Team Members

                    </a>

                </li>

                <li class="breadcrumb-item active">

                    Add

                </li>

            </ol>

        </div>

    </div>

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

<?php if (session()->getFlashdata('errors')): ?>

    <div class="alert alert-danger">

        <ul class="mb-0">

            <?php foreach (session()->getFlashdata('errors') as $error): ?>

                <li><?= esc($error) ?></li>

            <?php endforeach; ?>

        </ul>

    </div>

<?php endif; ?>

<div class="card">

    <div class="card-header">

        <h5 class="card-title mb-0">

            Create Team Member

        </h5>

    </div>

    <div class="card-body">

        <form action="<?= base_url('admin/teampage/store-team-member') ?>" method="post" enctype="multipart/form-data">

            <?= csrf_field() ?>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Member Name

                    </label>

                    <input type="text" name="title" class="form-control" value="<?= old('title') ?>" required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Position / Role

                    </label>

                    <input type="text" name="subtitle" class="form-control" value="<?= old('subtitle') ?>" required>

                </div>

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Short Bio / Description

                    </label>

                    <textarea name="description" rows="5" class="form-control"><?= old('description') ?></textarea>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Team Member Photo

                    </label>

                    <input type="file" name="image" id="image" class="form-control" accept="image/*">

                    <small class="text-muted">

                        Recommended size: 600 x 600 or square image.

                    </small>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Image Preview

                    </label>

                    <div>

                        <img id="imagePreview" src="<?= base_url('assets/img/team-1.jpg') ?>" class="img-thumbnail"
                            style="width:140px;height:140px;object-fit:cover;border-radius:50%;"
                            alt="Team Member Preview">

                    </div>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Facebook URL

                    </label>

                    <input type="text" name="facebook" class="form-control" value="<?= old('facebook') ?>"
                        placeholder="https://facebook.com/...">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Twitter / X URL

                    </label>

                    <input type="text" name="twitter" class="form-control" value="<?= old('twitter') ?>"
                        placeholder="https://twitter.com/...">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        LinkedIn URL

                    </label>

                    <input type="text" name="linkedin" class="form-control" value="<?= old('linkedin') ?>"
                        placeholder="https://linkedin.com/in/...">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Instagram URL

                    </label>

                    <input type="text" name="instagram" class="form-control" value="<?= old('instagram') ?>"
                        placeholder="https://instagram.com/...">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Sort Order

                    </label>

                    <input type="number" name="sort_order" class="form-control" value="<?= old('sort_order') ?? 0 ?>">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select name="status" class="form-select">

                        <option value="1" selected>

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

                    Save Team Member

                </button>

                <a href="<?= base_url('admin/teampage/team-members') ?>" class="btn btn-light">

                    Cancel

                </a>

            </div>

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