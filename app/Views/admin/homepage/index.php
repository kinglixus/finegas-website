<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="col-xl-6">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <div>

                <h5 class="card-title mb-1">

                    Homepage Slider

                </h5>

                <p class="text-muted mb-0">

                    Manage homepage carousel slides.

                </p>

            </div>

            <a href="<?= base_url('admin/homepage/sliders') ?>" class="btn btn-primary">

                <i class="feather-plus"></i>

                Manage Slides

            </a>

        </div>

        <div class="card-body">

            <div class="display-6 fw-bold">

                <?= count($sliders ?? []) ?>

            </div>

            <div class="text-muted">

                Active Slides

            </div>

        </div>

    </div>

</div>

<div class="col-xl-6">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <div>

                <h5 class="card-title mb-1">

                    Statistics

                </h5>

                <p class="text-muted mb-0">

                    Manage homepage counters.

                </p>

            </div>

            <a href="<?= base_url('admin/homepage/statistics') ?>" class="btn btn-success">

                <i class="feather-bar-chart-2"></i>

                Manage Statistics

            </a>

        </div>

        <div class="card-body">

            <div class="display-6 fw-bold">

                <?= count($statistics ?? []) ?>

            </div>

            <div class="text-muted">

                Statistics Records

            </div>

        </div>

    </div>

</div>

<div class="col-xl-4">

    <div class="card">

        <div class="card-header">

            <h5 class="card-title">

                About Section

            </h5>

        </div>

        <div class="card-body">

            <p class="text-muted">

                Manage About Fine Gas content.

            </p>

            <a href="<?= base_url('admin/homepage/about') ?>" class="btn btn-warning">

                Edit About Section

            </a>

        </div>

    </div>

</div>

<div class="col-xl-4">

    <div class="card">

        <div class="card-header">

            <h5 class="card-title">

                Services Header

            </h5>

        </div>

        <div class="card-body">

            <p class="text-muted">

                Manage services introduction.

            </p>

            <a href="<?= base_url('admin/homepage/services-header') ?>" class="btn btn-info">

                Edit Header

            </a>

        </div>

    </div>

</div>

<div class="col-xl-4">

    <div class="card">

        <div class="card-header">

            <h5 class="card-title">

                Services

            </h5>

        </div>

        <div class="card-body">

            <div class="display-6 fw-bold">

                <?= count($services ?? []) ?>

            </div>

            <div class="text-muted mb-3">

                Services Available

            </div>

            <a href="<?= base_url('admin/homepage/services') ?>" class="btn btn-primary">

                Manage Services

            </a>

        </div>

    </div>

</div>

<div class="col-xl-12">

    <div class="card">

        <div class="card-header">

            <h5 class="card-title">

                Why Choose Us

            </h5>

        </div>

        <div class="card-body">

            <p class="text-muted">

                Manage the Why Choose Us section.

            </p>

            <a href="<?= base_url('admin/homepage/choose-us') ?>" class="btn btn-dark">

                Edit Section

            </a>

        </div>

    </div>

</div>

<?= $this->endSection() ?>