<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Services Page CMS

        </h4>

        <p class="text-muted mb-0">

            Manage all Services Page sections.

        </p>

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

<div class="row">

    <!-- PAGE HEADER -->

    <div class="col-xl-4 col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <div class="mb-3">

                    <i class="feather-layout fs-1 text-primary"></i>

                </div>

                <h5 class="mb-2">

                    Page Header

                </h5>

                <p class="text-muted">

                    Manage services page banner and breadcrumb section.

                </p>

                <a href="<?= base_url('admin/servicepage/page-header') ?>" class="btn btn-primary">

                    <i class="feather-edit me-1"></i>

                    Edit Section

                </a>

            </div>

        </div>

    </div>

    <!-- SERVICE HEADER -->

    <div class="col-xl-4 col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <div class="mb-3">

                    <i class="feather-grid fs-1 text-success"></i>

                </div>

                <h5 class="mb-2">

                    Service Header

                </h5>

                <p class="text-muted">

                    Manage services section heading and introduction.

                </p>

                <a href="<?= base_url('admin/servicepage/service-header') ?>" class="btn btn-success">

                    <i class="feather-edit me-1"></i>

                    Edit Section

                </a>

            </div>

        </div>

    </div>

    <!-- SERVICES CRUD -->

    <div class="col-xl-4 col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <div class="mb-3">

                    <i class="feather-briefcase fs-1 text-warning"></i>

                </div>

                <h5 class="mb-2">

                    Services

                </h5>

                <p class="text-muted">

                    Manage service listings, icons, images and descriptions.

                </p>

                <a href="<?= base_url('admin/servicepage/services') ?>" class="btn btn-warning">

                    <i class="feather-settings me-1"></i>

                    Manage Services

                </a>

            </div>

        </div>

    </div>

</div>

<!-- OVERVIEW -->

<div class="card mt-4">

    <div class="card-header">

        <h5 class="card-title mb-0">

            Services Page Overview

        </h5>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-striped align-middle">

                <thead>

                    <tr>

                        <th>Section</th>

                        <th>Image</th>

                        <th>Title</th>

                        <th>Status</th>

                        <th width="120">

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

                            <?php if (!empty($page_header['image'])): ?>

                                <img src="<?= base_url($page_header['image']) ?>"
                                    alt="<?= esc($page_header['title'] ?? 'Page Header') ?>" class="img-thumbnail" style="
                                        width: 120px;
                                        height: 65px;
                                        object-fit: cover;
                                    ">

                            <?php else: ?>

                                <span class="text-muted">

                                    No image

                                </span>

                            <?php endif; ?>

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

                            <a href="<?= base_url('admin/servicepage/page-header') ?>" class="btn btn-sm btn-primary">

                                Edit

                            </a>

                        </td>

                    </tr>

                    <tr>

                        <td>

                            Service Header

                        </td>

                        <td>

                            <span class="text-muted">

                                N/A

                            </span>

                        </td>

                        <td>

                            <?= esc($service_header['title'] ?? '') ?>

                        </td>

                        <td>

                            <?php if (($service_header['status'] ?? 0) == 1): ?>

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

                            <a href="<?= base_url('admin/servicepage/service-header') ?>"
                                class="btn btn-sm btn-success">

                                Edit

                            </a>

                        </td>

                    </tr>

                    <tr>

                        <td>

                            Services

                        </td>

                        <td>

                            <span class="text-muted">

                                Collection

                            </span>

                        </td>

                        <td>

                            <?= count($services ?? []) ?>

                            Service(s)

                        </td>

                        <td>

                            <span class="badge bg-info">

                                Collection

                            </span>

                        </td>

                        <td>

                            <a href="<?= base_url('admin/servicepage/services') ?>" class="btn btn-sm btn-warning">

                                Manage

                            </a>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>