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

                    <a href="<?= base_url('admin/contactpage') ?>">

                        Contact Page CMS

                    </a>

                </li>

                <li class="breadcrumb-item active">

                    Page Header

                </li>

            </ol>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header">

        <h5 class="card-title mb-0">

            Contact Page Header

        </h5>

    </div>

    <div class="card-body">

        <form action="<?= base_url('admin/contactpage/page-header-update') ?>" method="post">

            <?= csrf_field() ?>

            <div class="row">

                <div class="col-md-8 mb-3">

                    <label class="form-label">

                        Title

                    </label>

                    <input type="text" name="title" class="form-control" value="<?= esc($pageHeader['title'] ?? '') ?>"
                        required>

                </div>

                <div class="col-md-4 mb-3">

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

            <button type="submit" class="btn btn-primary">

                <i class="feather-save me-2"></i>

                Save Changes

            </button>

        </form>

    </div>

</div>

<?= $this->endSection() ?>