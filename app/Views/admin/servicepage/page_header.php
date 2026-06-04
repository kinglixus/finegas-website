<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Page Header

        </h4>

        <div class="page-header-breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/home') ?>">

                        Dashboard

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/servicepage') ?>">

                        Services Page CMS

                    </a>

                </li>

                <li class="breadcrumb-item active">

                    Page Header

                </li>

            </ol>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-xl-12">

        <div class="card">

            <div class="card-header">

                <h5 class="card-title mb-1">

                    Services Page Header

                </h5>

                <p class="text-muted mb-0">

                    Manage the Services page banner and breadcrumb title.

                </p>

            </div>

            <div class="card-body">

                <form action="<?= base_url('admin/servicepage/page-header-update') ?>" method="post">

                    <?= csrf_field() ?>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Title

                            </label>

                            <input type="text" name="title" class="form-control"
                                value="<?= esc($pageHeader['title'] ?? '') ?>">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Subtitle

                            </label>

                            <input type="text" name="subtitle" class="form-control"
                                value="<?= esc($pageHeader['subtitle'] ?? '') ?>">

                        </div>

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Description

                            </label>

                            <textarea name="description" rows="5"
                                class="form-control"><?= esc($pageHeader['description'] ?? '') ?></textarea>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Status

                            </label>

                            <select name="status" class="form-select">

                                <option value="1" <?= ($pageHeader['status'] ?? 1) == 1 ? 'selected' : '' ?>>

                                    Active

                                </option>

                                <option value="0" <?= ($pageHeader['status'] ?? 1) == 0 ? 'selected' : '' ?>>

                                    Inactive

                                </option>

                            </select>

                        </div>

                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary">

                        <i class="feather-save me-2"></i>

                        Save Page Header

                    </button>

                    <a href="<?= base_url('admin/servicepage') ?>" class="btn btn-light">

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>