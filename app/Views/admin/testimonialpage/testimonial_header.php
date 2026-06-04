<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Testimonial Header

        </h4>

        <div class="page-header-breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/home') ?>">

                        Dashboard

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/testimonialpage') ?>">

                        Testimonials CMS

                    </a>

                </li>

                <li class="breadcrumb-item active">

                    Testimonial Header

                </li>

            </ol>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header">

        <h5 class="card-title mb-0">

            Testimonial Section Header

        </h5>

    </div>

    <div class="card-body">

        <form action="<?= base_url('admin/testimonialpage/testimonial-header-update') ?>" method="post">

            <?= csrf_field() ?>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Title

                    </label>

                    <input type="text" name="title" class="form-control"
                        value="<?= esc($testimonialHeader['title'] ?? '') ?>" required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Subtitle

                    </label>

                    <input type="text" name="subtitle" class="form-control"
                        value="<?= esc($testimonialHeader['subtitle'] ?? '') ?>">

                </div>

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea name="description" rows="5"
                        class="form-control"><?= esc($testimonialHeader['description'] ?? '') ?></textarea>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select name="status" class="form-select">

                        <option value="1" <?= ($testimonialHeader['status'] ?? 1) == 1 ? 'selected' : '' ?>>

                            Active

                        </option>

                        <option value="0" <?= ($testimonialHeader['status'] ?? 1) == 0 ? 'selected' : '' ?>>

                            Inactive

                        </option>

                    </select>

                </div>

            </div>

            <hr>

            <button type="submit" class="btn btn-success">

                <i class="feather-save me-2"></i>

                Save Changes

            </button>

            <a href="<?= base_url('admin/testimonialpage') ?>" class="btn btn-light">

                Cancel

            </a>

        </form>

    </div>

</div>

<?= $this->endSection() ?>