<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Create Product

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

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/productpage/products') ?>">

                        Products

                    </a>

                </li>

                <li class="breadcrumb-item active">

                    Create Product

                </li>

            </ol>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header">

        <h5 class="card-title mb-0">

            Product Information

        </h5>

    </div>

    <div class="card-body">

        <form
            action="<?= base_url('admin/productpage/store-product') ?>"
            method="post"
            enctype="multipart/form-data">

            <?= csrf_field() ?>

            <div class="row">

                <!-- PRODUCT NAME -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Product Name

                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        required>

                </div>

                <!-- FILTER CLASS -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Filter Class

                    </label>

                    <input
                        type="text"
                        name="filter_class"
                        class="form-control"
                        placeholder="e.g. first, second, LPG">

                </div>

                <!-- DESCRIPTION -->

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        class="form-control"></textarea>

                </div>

                <!-- PRODUCT IMAGE -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Product Image

                    </label>

                    <input
                        type="file"
                        name="image"
                        id="image"
                        class="form-control"
                        accept="image/*">

                </div>

                <!-- IMAGE PREVIEW -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Preview

                    </label>

                    <div>

                        <img
                            id="imagePreview"
                            src="<?= base_url('assets/admin/images/no-image.png') ?>"
                            class="img-thumbnail"
                            style="
                                width:150px;
                                height:150px;
                                object-fit:cover;
                            ">

                    </div>

                </div>

                <!-- SORT ORDER -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Sort Order

                    </label>

                    <input
                        type="number"
                        name="sort_order"
                        value="1"
                        class="form-control">

                </div>

                <!-- STATUS -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-select">

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

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="feather-save me-2"></i>

                    Save Product

                </button>

                <a
                    href="<?= base_url('admin/productpage/products') ?>"
                    class="btn btn-light">

                    Cancel

                </a>

            </div>

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