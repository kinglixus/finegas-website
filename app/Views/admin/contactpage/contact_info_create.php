<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Create Contact Information

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

                    Create

                </li>

            </ol>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header">

        <h5 class="card-title mb-0">

            Create Contact Information

        </h5>

    </div>

    <div class="card-body">

        <form action="<?= base_url('admin/contactpage/store-contact-info') ?>" method="post">

            <?= csrf_field() ?>

            <div class="row">

                <!-- TITLE -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Title

                    </label>

                    <input type="text" name="title" class="form-control" required>

                </div>

                <!-- ICON -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Icon

                    </label>

                    <input type="text" name="icon" id="icon" class="form-control" placeholder="feather-map-pin">

                </div>

                <!-- ICON PREVIEW -->

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Icon Preview

                    </label>

                    <div class="border rounded p-3 text-center">

                        <i id="iconPreview" class="feather-map-pin" style="font-size:40px;"></i>

                    </div>

                </div>

                <!-- DESCRIPTION -->

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea name="description" rows="5" class="form-control"></textarea>

                </div>

                <!-- SORT ORDER -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Sort Order

                    </label>

                    <input type="number" name="sort_order" value="1" class="form-control">

                </div>

                <!-- STATUS -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select name="status" class="form-select">

                        <option value="1">

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

                    Save Contact Information

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