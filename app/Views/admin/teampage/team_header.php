<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Team Header

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

                        Team CMS

                    </a>

                </li>

                <li class="breadcrumb-item active">

                    Team Header

                </li>

            </ol>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header">

        <h5 class="card-title mb-0">

            Team Section Header

        </h5>

    </div>

    <div class="card-body">

        <form action="<?= base_url('admin/teampage/team-header-update') ?>" method="post" enctype="multipart/form-data">

            <?= csrf_field() ?>

            <div class="row">

                <!-- TITLE -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Title

                    </label>

                    <input type="text" name="title" class="form-control" value="<?= esc($teamHeader['title'] ?? '') ?>"
                        required>

                </div>

                <!-- SUBTITLE -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Subtitle

                    </label>

                    <input type="text" name="subtitle" class="form-control"
                        value="<?= esc($teamHeader['subtitle'] ?? '') ?>">

                </div>

                <!-- DESCRIPTION -->

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea name="description" rows="5"
                        class="form-control"><?= esc($teamHeader['description'] ?? '') ?></textarea>

                </div>

                <!-- IMAGE UPLOAD -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Header Image

                    </label>

                    <input type="file" name="image" id="image" class="form-control" accept="image/*">

                </div>

                <!-- IMAGE PREVIEW -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Current Image

                    </label>

                    <div>

                        <img id="imagePreview" src="<?= !empty($teamHeader['image'])
                                                        ? base_url($teamHeader['image'])
                                                        : base_url('assets/admin/images/no-image.png') ?>" class="img-thumbnail" style="
                                max-height: 150px;
                                width: auto;
                            ">

                    </div>

                </div>

                <!-- STATUS -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select name="status" class="form-select">

                        <option value="1" <?= ($teamHeader['status'] ?? 1) == 1 ? 'selected' : '' ?>>

                            Active

                        </option>

                        <option value="0" <?= ($teamHeader['status'] ?? 1) == 0 ? 'selected' : '' ?>>

                            Inactive

                        </option>

                    </select>

                </div>

            </div>

            <hr>

            <button type="submit" class="btn btn-success">

                <i class="feather-save me-2"></i>

                Save Changes

            </button>

            <a href="<?= base_url('admin/teampage') ?>" class="btn btn-light">

                Cancel

            </a>

        </form>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    document
        .getElementById('image')
        ?.addEventListener(
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