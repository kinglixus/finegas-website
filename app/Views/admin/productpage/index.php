<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Products CMS

        </h4>

        <p class="text-muted mb-0">

            Manage Products Page content and product listings.

        </p>

    </div>

</div>

<div class="row">

    <!-- PAGE HEADER -->

    <div class="col-xl-4 col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <i class="feather-layout fs-1 text-primary"></i>

                <h5 class="mt-3">

                    Page Header

                </h5>

                <p class="text-muted">

                    Manage page title, banner image and breadcrumbs.

                </p>

                <a href="<?= base_url('admin/productpage/page-header') ?>" class="btn btn-primary">

                    Edit Section

                </a>

            </div>

        </div>

    </div>

    <!-- PRODUCT HEADER -->

    <div class="col-xl-4 col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <i class="feather-package fs-1 text-success"></i>

                <h5 class="mt-3">

                    Product Header

                </h5>

                <p class="text-muted">

                    Manage product section heading and image.

                </p>

                <a href="<?= base_url('admin/productpage/product-header') ?>" class="btn btn-success">

                    Edit Section

                </a>

            </div>

        </div>

    </div>

    <!-- PRODUCTS -->

    <div class="col-xl-4 col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <i class="feather-grid fs-1 text-warning"></i>

                <h5 class="mt-3">

                    Products

                </h5>

                <p class="text-muted">

                    Manage product catalogue.

                </p>

                <a href="<?= base_url('admin/productpage/products') ?>" class="btn btn-warning">

                    Manage Products

                </a>

            </div>

        </div>

    </div>

</div>

<div class="card mt-4">

    <div class="card-header">

        <h5 class="card-title mb-0">

            Products Page Overview

        </h5>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-striped align-middle">

                <thead>

                    <tr>

                        <th>Section</th>

                        <th>Title</th>

                        <th>Status</th>

                        <th width="80">

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>

                            Page Header

                        </td>

                        <td>

                            <?= esc($page_header['title'] ?? '') ?>

                        </td>

                        <td>

                            <?php if (($page_header['status'] ?? 0) == 1): ?>

                                <span class="badge bg-success">

                                    Active

                                </span>

                            <?php else: ?>

                                <span class="badge bg-danger">

                                    Inactive

                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <a href="<?= base_url('admin/productpage/page-header') ?>" class="btn btn-sm btn-primary">

                                <i class="feather-edit"></i>

                            </a>

                        </td>

                    </tr>

                    <tr>

                        <td>

                            Product Header

                        </td>

                        <td>

                            <?= esc($product_header['title'] ?? '') ?>

                        </td>

                        <td>

                            <?php if (($product_header['status'] ?? 0) == 1): ?>

                                <span class="badge bg-success">

                                    Active

                                </span>

                            <?php else: ?>

                                <span class="badge bg-danger">

                                    Inactive

                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <a href="<?= base_url('admin/productpage/product-header') ?>"
                                class="btn btn-sm btn-success">

                                <i class="feather-edit"></i>

                            </a>

                        </td>

                    </tr>

                    <tr>

                        <td>

                            Products

                        </td>

                        <td>

                            <?= count($products) ?>

                            Product(s)

                        </td>

                        <td>

                            <span class="badge bg-info">

                                Collection

                            </span>

                        </td>

                        <td>

                            <a href="<?= base_url('admin/productpage/products') ?>" class="btn btn-sm btn-warning">

                                <i class="feather-settings"></i>

                            </a>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>