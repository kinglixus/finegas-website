<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Safety Tips CMS

        </h4>

        <p class="text-muted mb-0">

            Manage safety tips page content.

        </p>

    </div>

    <a href="<?= base_url('safety-tips') ?>" target="_blank" class="btn btn-primary">

        <i class="feather-eye me-2"></i>

        View Page

    </a>

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

    <div class="col-xl-4 col-md-6 mb-4">

        <div class="card h-100">

            <div class="card-body">

                <h5 class="card-title">

                    Page Header

                </h5>

                <p class="text-muted">

                    Manage the safety tips page banner title and header image.

                </p>

                <a href="<?= base_url('admin/safetypage/page-header') ?>" class="btn btn-primary btn-sm">

                    Manage

                </a>

            </div>

        </div>

    </div>

    <div class="col-xl-4 col-md-6 mb-4">

        <div class="card h-100">

            <div class="card-body">

                <h5 class="card-title">

                    Safety Header

                </h5>

                <p class="text-muted">

                    Manage section subtitle and main heading.

                </p>

                <a href="<?= base_url('admin/safetypage/safety-header') ?>" class="btn btn-primary btn-sm">

                    Manage

                </a>

            </div>

        </div>

    </div>

    <div class="col-xl-4 col-md-6 mb-4">

        <div class="card h-100">

            <div class="card-body">

                <h5 class="card-title">

                    Safety Tips

                </h5>

                <p class="text-muted">

                    Add, edit, delete and reorder safety tip cards.

                </p>

                <a href="<?= base_url('admin/safetypage/safety-tips') ?>" class="btn btn-primary btn-sm">

                    Manage

                </a>

            </div>

        </div>

    </div>

    <div class="col-xl-4 col-md-6 mb-4">

        <div class="card h-100">

            <div class="card-body">

                <h5 class="card-title">

                    Emergency Header

                </h5>

                <p class="text-muted">

                    Manage emergency contact section heading.

                </p>

                <a href="<?= base_url('admin/safetypage/emergency-header') ?>" class="btn btn-primary btn-sm">

                    Manage

                </a>

            </div>

        </div>

    </div>

    <div class="col-xl-4 col-md-6 mb-4">

        <div class="card h-100">

            <div class="card-body">

                <h5 class="card-title">

                    Emergency Contact

                </h5>

                <p class="text-muted">

                    Manage emergency numbers and button.

                </p>

                <a href="<?= base_url('admin/safetypage/emergency-contact') ?>" class="btn btn-primary btn-sm">

                    Manage

                </a>

            </div>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header">

        <h5 class="card-title mb-0">

            Page Overview

        </h5>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-striped align-middle">

                <thead>

                    <tr>

                        <th>Section</th>

                        <th>Title</th>

                        <th>Subtitle</th>

                        <th>Status</th>

                        <th width="120">Action</th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>Page Header</td>

                        <td><?= esc($page_header['title'] ?? '') ?></td>

                        <td><?= esc($page_header['subtitle'] ?? '') ?></td>

                        <td>
                            <?= !empty($page_header['status']) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' ?>
                        </td>

                        <td>
                            <a href="<?= base_url('admin/safetypage/page-header') ?>" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                        </td>

                    </tr>

                    <tr>

                        <td>Safety Header</td>

                        <td><?= esc($safety_header['title'] ?? '') ?></td>

                        <td><?= esc($safety_header['subtitle'] ?? '') ?></td>

                        <td>
                            <?= !empty($safety_header['status']) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' ?>
                        </td>

                        <td>
                            <a href="<?= base_url('admin/safetypage/safety-header') ?>" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                        </td>

                    </tr>

                    <tr>

                        <td>Safety Tips</td>

                        <td><?= count($safety_tips ?? []) ?> Tip(s)</td>

                        <td>Safety card items</td>

                        <td><span class="badge bg-success">Active</span></td>

                        <td>
                            <a href="<?= base_url('admin/safetypage/safety-tips') ?>" class="btn btn-sm btn-warning">
                                Manage
                            </a>
                        </td>

                    </tr>

                    <tr>

                        <td>Emergency Header</td>

                        <td><?= esc($emergency_header['title'] ?? '') ?></td>

                        <td><?= esc($emergency_header['subtitle'] ?? '') ?></td>

                        <td>
                            <?= !empty($emergency_header['status']) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' ?>
                        </td>

                        <td>
                            <a href="<?= base_url('admin/safetypage/emergency-header') ?>"
                                class="btn btn-sm btn-warning">
                                Edit
                            </a>
                        </td>

                    </tr>

                    <tr>

                        <td>Emergency Contact</td>

                        <td><?= esc($emergency_contact['title'] ?? '') ?></td>

                        <td><?= esc($emergency_contact['button_text'] ?? '') ?></td>

                        <td>
                            <?= !empty($emergency_contact['status']) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' ?>
                        </td>

                        <td>
                            <a href="<?= base_url('admin/safetypage/emergency-contact') ?>"
                                class="btn btn-sm btn-warning">
                                Edit
                            </a>
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>