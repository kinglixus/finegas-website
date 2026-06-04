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

                    <a href="<?= base_url('admin/teampage') ?>">

                        Team CMS

                    </a>

                </li>

                <li class="breadcrumb-item active">

                    Page Header

                </li>

            </ol>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header">

        <h5 class="card-title mb-0">

            Team Page Header

        </h5>

    </div>

    <div class="card-body">

        <form action="<?= base_url('admin/teampage/page-header-update') ?>" method="post" enctype="multipart/form-data">

            <?= csrf_field() ?>

            <div class="row">

                <!-- TITLE -->

                <div class="col-md-8 mb-3">

                    <label class="form-label">

                        Title

                    </label>

                    <input type="text" name="title" class="form-control" value="<?= esc($pageHeader['title'] ?? '') ?>"
                        required>

                </div>

                <!-- STATUS -->

                <div class="col-md-4 mb-3">

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

                <!-- BANNER IMAGE -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Banner Image

                    </label>

                    <input type="file" name="image" id="image" class="form-control" accept="image/*">

                </div>

                <!-- IMAGE PREVIEW -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Current Banner

                    </label>

                    <div>

                        <img id="imagePreview" src="<?= !empty($pageHeader['image'])
                                                        ? base_url($pageHeader['image'])
                                                        : base_url('assets/admin/images/no-image.png') ?>" class="img-thumbnail" style="
                                max-height: 150px;
                                width: auto;
                            ">

                    </div>

                </div>

            </div>

            <hr>

            <button type="submit" class="btn btn-primary">

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