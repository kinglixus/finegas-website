<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            About Page CMS

        </h4>

        <p class="text-muted mb-0">

            Manage all About Page sections.

        </p>

    </div>

</div>

<div class="row">

    <!-- PAGE HEADER -->

    <div class="col-xl-3 col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <div class="mb-3">

                    <i class="feather-layout fs-1 text-primary"></i>

                </div>

                <h5 class="mb-2">

                    Page Header

                </h5>

                <p class="text-muted">

                    Manage About Us page header content.

                </p>

                <a href="<?= base_url('admin/aboutpage/page-header') ?>" class="btn btn-primary">

                    <i class="feather-edit me-1"></i>

                    Edit Section

                </a>

            </div>

        </div>

    </div>

    <!-- COMPANY INTRO -->

    <div class="col-xl-3 col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <div class="mb-3">

                    <i class="feather-briefcase fs-1 text-success"></i>

                </div>

                <h5 class="mb-2">

                    Company Intro

                </h5>

                <p class="text-muted">

                    Manage company introduction content.

                </p>

                <a href="<?= base_url('admin/aboutpage/company-intro') ?>" class="btn btn-success">

                    <i class="feather-edit me-1"></i>

                    Edit Section

                </a>

            </div>

        </div>

    </div>

    <!-- VISION -->

    <div class="col-xl-3 col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <div class="mb-3">

                    <i class="feather-eye fs-1 text-info"></i>

                </div>

                <h5 class="mb-2">

                    Vision

                </h5>

                <p class="text-muted">

                    Manage company vision section.

                </p>

                <a href="<?= base_url('admin/aboutpage/vision') ?>" class="btn btn-info">

                    <i class="feather-edit me-1"></i>

                    Edit Section

                </a>

            </div>

        </div>

    </div>

    <!-- ABOUT FINE GAS -->

    <div class="col-xl-3 col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <div class="mb-3">

                    <i class="feather-award fs-1 text-warning"></i>

                </div>

                <h5 class="mb-2">

                    About Fine Gas

                </h5>

                <p class="text-muted">

                    Manage detailed company information.

                </p>

                <a href="<?= base_url('admin/aboutpage/about-fine-gas') ?>" class="btn btn-warning">

                    <i class="feather-edit me-1"></i>

                    Edit Section

                </a>

            </div>

        </div>

    </div>

</div>

<!-- SECTION OVERVIEW -->

<div class="card mt-4">

    <div class="card-header">

        <h5 class="card-title mb-0">

            About Page Overview

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

                        <th width="80">Action</th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>Page Header</td>

                        <td><?= esc($page_header['title'] ?? '') ?></td>

                        <td>

                            <span class="badge bg-success">

                                Active

                            </span>

                        </td>

                        <td class="text-nowrap">

                            <a href="<?= base_url('admin/aboutpage/page-header') ?>" class="btn btn-sm btn-primary"
                                title="Edit">

                                <i class="feather-edit"></i>

                            </a>

                        </td>

                    </tr>

                    <tr>

                        <td>Company Intro</td>

                        <td><?= esc($company_intro['title'] ?? '') ?></td>

                        <td>

                            <span class="badge bg-success">

                                Active

                            </span>

                        </td>

                        <td class="text-nowrap">

                            <a href="<?= base_url('admin/aboutpage/company-intro') ?>" class="btn btn-sm btn-success"
                                title="Edit">

                                <i class="feather-edit"></i>

                            </a>

                        </td>

                    </tr>

                    <tr>

                        <td>Vision</td>

                        <td><?= esc($vision['title'] ?? '') ?></td>

                        <td>

                            <span class="badge bg-success">

                                Active

                            </span>

                        </td>

                        <td class="text-nowrap">

                            <a href="<?= base_url('admin/aboutpage/vision') ?>" class="btn btn-sm btn-info"
                                title="Edit">

                                <i class="feather-edit"></i>

                            </a>

                        </td>

                    </tr>

                    <tr>

                        <td>About Fine Gas</td>

                        <td><?= esc($about_fine_gas['title'] ?? '') ?></td>

                        <td>

                            <span class="badge bg-success">

                                Active

                            </span>

                        </td>

                        <td class="text-nowrap">

                            <a href="<?= base_url('admin/aboutpage/about-fine-gas') ?>" class="btn btn-sm btn-warning"
                                title="Edit">

                                <i class="feather-edit"></i>

                            </a>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>