<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>


<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Homepage Statistics

        </h4>

        <p class="text-muted mb-0">

            Manage homepage counters and achievements.

        </p>

    </div>

    <a href="<?= base_url('admin/homepage/statistics_create') ?>" class="btn btn-primary">

        <i class="feather-plus"></i>

        Add Statistic

    </a>

</div>

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-striped">

                <thead>

                    <tr>

                        <th>

                            Icon

                        </th>

                        <th>

                            Title

                        </th>

                        <th>

                            Counter

                        </th>

                        <th>

                            Sort

                        </th>

                        <th>

                            Status

                        </th>

                        <th>

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($statistics as $stat): ?>

                        <?php

                        $extra =
                            json_decode(
                                $stat['extra_data'],
                                true
                            );

                        ?>

                        <tr>

                            <td>

                                <i class="<?= esc($stat['icon']) ?>"></i>

                            </td>

                            <td>

                                <?= esc($stat['title']) ?>

                            </td>

                            <td>

                                <?= $extra['number'] ?? 0 ?>

                            </td>

                            <td>

                                <?= $stat['sort_order'] ?>

                            </td>

                            <td>

                                <?php if ($stat['status']): ?>

                                    <span class="badge bg-success">

                                        Active

                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-danger">

                                        Inactive

                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <a href="<?= base_url('admin/homepage/statistics_edit/' . $stat['id']) ?>"
                                    class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>