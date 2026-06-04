<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row g-3">
    <div class="col-12">
        <div class="card stretch">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">All Leads</h5>
                <a href="<?= base_url('admin/leads/create') ?>" class="btn btn-primary">
                    <i class="feather-plus me-2"></i>Add Lead
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Company</th>
                                <th>Contact</th>
                                <th>Source</th>
                                <th>Value</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Global Tech</td>
                                <td>Mike Wilson</td>
                                <td>Website</td>
                                <td>$8,500</td>
                                <td><span class="badge bg-warning">New</span></td>
                                <td>
                                    <div class="hstack gap-2">
                                        <a href="<?= base_url('admin/leads/view/1') ?>" class="btn btn-icon btn-sm btn-info"><i class="feather-eye"></i></a>
                                        <a href="<?= base_url('admin/leads/edit/1') ?>" class="btn btn-icon btn-sm btn-warning"><i class="feather-edit-2"></i></a>
                                        <button class="btn btn-icon btn-sm btn-success"><i class="feather-check"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Startup Inc</td>
                                <td>Sarah Lee</td>
                                <td>Referral</td>
                                <td>$12,000</td>
                                <td><span class="badge bg-success">Qualified</span></td>
                                <td>
                                    <div class="hstack gap-2">
                                        <a href="<?= base_url('admin/leads/view/2') ?>" class="btn btn-icon btn-sm btn-info"><i class="feather-eye"></i></a>
                                        <a href="<?= base_url('admin/leads/edit/2') ?>" class="btn btn-icon btn-sm btn-warning"><i class="feather-edit-2"></i></a>
                                        <button class="btn btn-icon btn-sm btn-success"><i class="feather-check"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>