<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>


<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    ```
    <div class="page-header-left">

        <h4 class="page-title">

            Edit Statistic

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

                    Edit

                </li>

            </ol>

        </div>

    </div>
    ```

</div>

<div class="row">

    ```
    <div class="col-xl-12">

        <div class="card">

            <div class="card-header">

                <div>

                    <h5 class="card-title mb-1">

                        Edit Homepage Statistic

                    </h5>

                    <p class="text-muted mb-0">

                        Update homepage statistics counter.

                    </p>

                </div>

            </div>

            <div class="card-body">

                <form action="<?= base_url(
                                    'admin/homepage/statistics_update/' .
                                        $statistic['id']
                                ) ?>" method="post" id="statisticForm">

                    <?= csrf_field() ?>

                    <div class="row">

                        <!-- TITLE -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Title

                                <span class="text-danger">*</span>

                            </label>

                            <input type="text" name="title" class="form-control"
                                value="<?= esc($statistic['title']) ?>">

                        </div>

                        <!-- COUNTER -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Counter Value

                                <span class="text-danger">*</span>

                            </label>

                            <input type="number" name="counter" class="form-control"
                                value="<?= $extraData['number'] ?? 0 ?>">

                        </div>

                        <!-- ICON -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Icon

                            </label>

                            <input type="text" name="icon" class="form-control" value="<?= esc($statistic['icon']) ?>"
                                placeholder="feather-award">

                            <small class="text-muted">

                                Example:
                                feather-award,
                                feather-users,
                                feather-briefcase

                            </small>

                        </div>

                        <!-- ICON PREVIEW -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Icon Preview

                            </label>

                            <div class="border rounded p-3 text-center">

                                <i class="<?= esc($statistic['icon']) ?>" style="font-size:40px;">

                                </i>

                            </div>

                        </div>

                        <!-- SORT ORDER -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Sort Order

                            </label>

                            <input type="number" name="sort_order" class="form-control"
                                value="<?= $statistic['sort_order'] ?>">

                        </div>

                        <!-- STATUS -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Status

                            </label>

                            <select name="status" class="form-select">

                                <option value="1" <?= $statistic['status'] == 1 ? 'selected' : '' ?>>

                                    Active

                                </option>

                                <option value="0" <?= $statistic['status'] == 0 ? 'selected' : '' ?>>

                                    Inactive

                                </option>

                            </select>

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex gap-2">

                        <button type="submit" class="btn btn-primary">

                            <i class="feather-save me-2"></i>

                            Update Statistic

                        </button>

                        <a href="<?= base_url(
                                        'admin/homepage/statistics'
                                    ) ?>" class="btn btn-light">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>
    ```

</div>

<?= $this->endSection() ?>


<?= $this->endSection() ?>