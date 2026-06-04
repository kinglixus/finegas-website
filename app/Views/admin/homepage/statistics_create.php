<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Create Statistic

        </h4>

        <div class="page-header-breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/home') ?>">

                        Dashboard

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/homepage') ?>">

                        Homepage CMS

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/homepage/statistics') ?>">

                        Statistics

                    </a>

                </li>

                <li class="breadcrumb-item active">

                    Create

                </li>

            </ol>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-xl-12">

        <div class="card">

            <div class="card-header">

                <div>

                    <h5 class="card-title mb-1">

                        Homepage Statistic

                    </h5>

                    <p class="text-muted mb-0">

                        Create a homepage statistics counter.

                    </p>

                </div>

            </div>

            <div class="card-body">

                <form action="<?= base_url('admin/homepage/statistics_store') ?>" method="post" id="statisticForm">

                    <?= csrf_field() ?>

                    <div class="row">

                        <!-- Title -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Title

                                <span class="text-danger">*</span>

                            </label>

                            <input type="text" name="title" class="form-control" placeholder="Happy Customers">

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- Counter -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Counter Value

                                <span class="text-danger">*</span>

                            </label>

                            <input type="number" name="counter" class="form-control" placeholder="3453">

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- Icon -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Icon

                            </label>

                            <input type="text" name="icon" class="form-control" placeholder="feather-award">

                            <small class="text-muted">

                                Example:
                                feather-award,
                                feather-users,
                                feather-briefcase

                            </small>

                        </div>

                        <!-- Sort Order -->

                        <div class="col-md-3 mb-3">

                            <label class="form-label">

                                Sort Order

                            </label>

                            <input type="number" name="sort_order" value="1" class="form-control">

                        </div>

                        <!-- Status -->

                        <div class="col-md-3 mb-3">

                            <label class="form-label">

                                Status

                            </label>

                            <select name="status" class="form-select">

                                <option value="1">

                                    Active

                                </option>

                                <option value="0">

                                    Inactive

                                </option>

                            </select>

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex gap-2">

                        <button type="submit" class="btn btn-primary">

                            <i class="feather-save me-2"></i>

                            Save Statistic

                        </button>

                        <a href="<?= base_url('admin/homepage/statistics') ?>" class="btn btn-light">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>