<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Testimonials CMS

        </h4>

        <p class="text-muted mb-0">

            Manage all Testimonials Page content and testimonials.

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

                    Manage page title and breadcrumbs.

                </p>

                <a href="<?= base_url('admin/testimonialpage/page-header') ?>" class="btn btn-primary">

                    Edit Section

                </a>

            </div>

        </div>

    </div>

    <!-- TESTIMONIAL HEADER -->

    <div class="col-xl-4 col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <i class="feather-message-square fs-1 text-success"></i>

                <h5 class="mt-3">

                    Testimonial Header

                </h5>

                <p class="text-muted">

                    Manage testimonial section heading.

                </p>

                <a href="<?= base_url('admin/testimonialpage/testimonial-header') ?>" class="btn btn-success">

                    Edit Section

                </a>

            </div>

        </div>

    </div>

    <!-- TESTIMONIALS -->

    <div class="col-xl-4 col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <i class="feather-users fs-1 text-warning"></i>

                <h5 class="mt-3">

                    Testimonials

                </h5>

                <p class="text-muted">

                    Manage client testimonials.

                </p>

                <a href="<?= base_url('admin/testimonialpage/testimonials') ?>" class="btn btn-warning">

                    Manage Testimonials

                </a>

            </div>

        </div>

    </div>

</div>

<!-- OVERVIEW -->

<div class="card mt-4">

    <div class="card-header">

        <h5 class="card-title mb-0">

            Testimonials Page Overview

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

                            <span class="badge bg-success">

                                Active

                            </span>

                        </td>

                        <td>

                            <a href="<?= base_url('admin/testimonialpage/page-header') ?>"
                                class="btn btn-sm btn-primary">

                                <i class="feather-edit"></i>

                            </a>

                        </td>

                    </tr>

                    <tr>

                        <td>

                            Testimonial Header

                        </td>

                        <td>

                            <?= esc($testimonial_header['title'] ?? '') ?>

                        </td>

                        <td>

                            <span class="badge bg-success">

                                Active

                            </span>

                        </td>

                        <td>

                            <a href="<?= base_url('admin/testimonialpage/testimonial-header') ?>"
                                class="btn btn-sm btn-success">

                                <i class="feather-edit"></i>

                            </a>

                        </td>

                    </tr>

                    <tr>

                        <td>

                            Testimonials

                        </td>

                        <td>

                            <?= count($testimonials) ?>

                            Item(s)

                        </td>

                        <td>

                            <span class="badge bg-info">

                                Collection

                            </span>

                        </td>

                        <td>

                            <a href="<?= base_url('admin/testimonialpage/testimonial') ?>"
                                class="btn btn-sm btn-warning">

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