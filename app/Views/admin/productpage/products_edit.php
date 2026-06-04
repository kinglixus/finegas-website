<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Edit Product

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

                    Edit Product

                </li>

            </ol>

        </div>

    </div>

</div>

<?php
$extraData =
    !empty($product['extra_data'])
    ? $product['extra_data']
    : [];
?>

<div class="card">

    <div class="card-header">

        <h5 class="card-title mb-0">

            Product Information

        </h5>

    </div>

    <div class="card-body">

        <form
            action="<?= base_url('admin/productpage/update-product/' . $product['id']) ?>"
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
                        value="<?= esc($product['title']) ?>"
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
                        value="<?= esc($extraData['filter_class'] ?? '') ?>">

                </div>

                <!-- DESCRIPTION -->

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        class="form-control"><?= esc($product['description']) ?></textarea>

                </div>

                <!-- CURRENT IMAGE -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Current Product Image

                    </label>

                    <div>

                        <img
                            id="imagePreview"
                            src="<?= !empty($product['image'])
                                        ? base_url($product['image'])
                                        : base_url('assets/admin/images/no-image.png') ?>"
                            class="img-thumbnail"
                            style="
                                width:150px;
                                height:150px;
                                object-fit:cover;
                            ">

                    </div>

                </div>

                <!-- CHANGE IMAGE -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Replace Product Image

                    </label>

                    <input
                        type="file"
                        name="image"
                        id="image"
                        class="form-control"
                        accept="image/*">

                </div>

                <!-- SORT ORDER -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Sort Order

                    </label>

                    <input
                        type="number"
                        name="sort_order"
                        class="form-control"
                        value="<?= $product['sort_order'] ?>">

                </div>

                <!-- STATUS -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option
                            value="1"
                            <?= $product['status'] == 1 ? 'selected' : '' ?>>

                            Active

                        </option>

                        <option
                            value="0"
                            <?= $product['status'] == 0 ? 'selected' : '' ?>>

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

                    Update Product

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