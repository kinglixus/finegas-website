<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row g-3">
    <div class="col-12">
        <div class="card stretch">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">All Proposals</h5>
                <a href="<?= base_url('admin/proposals/create') ?>" class="btn btn-primary">
                    <i class="feather-plus me-2"></i>Create Proposal
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Customer</th>
                                <th>Value</th>
                                <th>Valid Until</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PROP-001</td>
                                <td>Website Development Proposal</td>
                                <td>Acme Corporation</td>
                                <td>$8,500</td>
                                <td>2024-04-15</td>
                                <td><span class="badge bg-success">Sent</span></td>
                                <td>
                                    <div class="hstack gap-2">
                                        <a href="<?= base_url('admin/proposals/view/1') ?>" class="btn btn-icon btn-sm btn-info"><i class="feather-eye"></i></a>
                                        <a href="#" class="btn btn-icon btn-sm btn-primary"><i class="feather-download"></i></a>
                                        <a href="#" class="btn btn-icon btn-sm btn-success"><i class="feather-send"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>PROP-002</td>
                                <td>Mobile App Proposal</td>
                                <td>Tech Solutions</td>
                                <td>$15,000</td>
                                <td>2024-05-01</td>
                                <td><span class="badge bg-warning">Draft</span></td>
                                <td>
                                    <div class="hstack gap-2">
                                        <a href="<?= base_url('admin/proposals/view/2') ?>" class="btn btn-icon btn-sm btn-info"><i class="feather-eye"></i></a>
                                        <a href="#" class="btn btn-icon btn-sm btn-primary"><i class="feather-download"></i></a>
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