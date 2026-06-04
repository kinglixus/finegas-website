<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Edit Contact Information

        </h4>

        <div class="page-header-breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/home') ?>">

                        Dashboard

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/contactpage') ?>">

                        Contact Page CMS

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/contactpage/contact-info') ?>">

                        Contact Information

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

            Edit Contact Information

        </h5>

    </div>

    <div class="card-body">

        <form action="<?= base_url('admin/contactpage/update-contact-info/' . $contactInfo['id']) ?>" method="post">

            <?= csrf_field() ?>

            <div class="row">

                <!-- TITLE -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Title

                    </label>

                    <input type="text" name="title" class="form-control" value="<?= esc($contactInfo['title']) ?>"
                        required>

                </div>

                <!-- ICON -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Icon

                    </label>

                    <input type="text" name="icon" id="icon" class="form-control"
                        value="<?= esc($contactInfo['icon']) ?>">

                </div>

                <!-- ICON PREVIEW -->

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Icon Preview

                    </label>

                    <div class="border rounded p-3 text-center">

                        <i id="iconPreview" class="<?= esc($contactInfo['icon']) ?>" style="font-size:40px;"></i>

                    </div>

                </div>

                <!-- DESCRIPTION -->

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea name="description" rows="5"
                        class="form-control"><?= esc($contactInfo['description']) ?></textarea>

                </div>

                <!-- SORT ORDER -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Sort Order

                    </label>

                    <input type="number" name="sort_order" class="form-control"
                        value="<?= $contactInfo['sort_order'] ?>">

                </div>

                <!-- STATUS -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select name="status" class="form-select">

                        <option value="1" <?= $contactInfo['status'] == 1 ? 'selected' : '' ?>>

                            Active

                        </option>

                        <option value="0" <?= $contactInfo['status'] == 0 ? 'selected' : '' ?>>

                            Inactive

                        </option>

                    </select>

                </div>

            </div>

            <hr>

            <div class="d-flex gap-2">

                <button type="submit" class="btn btn-primary">

                    <i class="feather-save me-2"></i>

                    Update Contact Information

                </button>

                <a href="<?= base_url('admin/contactpage/contact-info') ?>" class="btn btn-light">

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
</script>

<?= $this->endSection() ?>