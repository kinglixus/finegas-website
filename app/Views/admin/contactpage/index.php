<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Contact Page CMS

        </h4>

        <p class="text-muted mb-0">

            Manage all Contact Page sections.

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

                    Manage page title and breadcrumb section.

                </p>

                <a href="<?= base_url('admin/contactpage/page-header') ?>" class="btn btn-primary">

                    Edit Section

                </a>

            </div>

        </div>

    </div>

    <!-- CONTACT INTRO -->

    <div class="col-xl-4 col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <i class="feather-message-square fs-1 text-success"></i>

                <h5 class="mt-3">

                    Contact Intro

                </h5>

                <p class="text-muted">

                    Manage introduction content.

                </p>

                <a href="<?= base_url('admin/contactpage/contact-intro') ?>" class="btn btn-success">

                    Edit Section

                </a>

            </div>

        </div>

    </div>

    <!-- CONTACT INFO -->

    <div class="col-xl-4 col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <i class="feather-phone fs-1 text-warning"></i>

                <h5 class="mt-3">

                    Contact Information

                </h5>

                <p class="text-muted">

                    Manage address, phones, emails and working hours.

                </p>

                <a href="<?= base_url('admin/contactpage/contact-info') ?>" class="btn btn-warning">

                    Manage Items

                </a>

            </div>

        </div>

    </div>

</div>

<!-- OVERVIEW -->

<div class="card mt-4">

    <div class="card-header">

        <h5 class="card-title mb-0">

            Contact Page Overview

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

                            <a href="<?= base_url('admin/contactpage/page-header') ?>" class="btn btn-sm btn-primary">

                                <i class="feather-edit"></i>

                            </a>

                        </td>

                    </tr>

                    <tr>

                        <td>

                            Contact Intro

                        </td>

                        <td>

                            <?= esc($contact_intro['title'] ?? '') ?>

                        </td>

                        <td>

                            <span class="badge bg-success">

                                Active

                            </span>

                        </td>

                        <td>

                            <a href="<?= base_url('admin/contactpage/contact-intro') ?>" class="btn btn-sm btn-success">

                                <i class="feather-edit"></i>

                            </a>

                        </td>

                    </tr>

                    <tr>

                        <td>

                            Contact Information

                        </td>

                        <td>

                            <?= count($contact_info) ?>

                            Item(s)

                        </td>

                        <td>

                            <span class="badge bg-info">

                                Collection

                            </span>

                        </td>

                        <td>

                            <a href="<?= base_url('admin/contactpage/contact-info') ?>" class="btn btn-sm btn-warning">

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