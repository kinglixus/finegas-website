<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row g-3">
    <div class="col-12">
        <div class="card stretch">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">All Invoices</h5>
                <a href="<?= base_url('admin/invoices/create') ?>" class="btn btn-primary">
                    <i class="feather-plus me-2"></i>Create Invoice
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Invoice #</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Due Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>INV-001</td>
                                <td>Acme Corporation</td>
                                <td>2024-01-15</td>
                                <td>2024-02-15</td>
                                <td>$5,000</td>
                                <td><span class="badge bg-success">Paid</span></td>
                                <td>
                                    <div class="hstack gap-2">
                                        <a href="<?= base_url('admin/invoices/view/1') ?>" class="btn btn-icon btn-sm btn-info"><i class="feather-eye"></i></a>
                                        <a href="#" class="btn btn-icon btn-sm btn-primary"><i class="feather-download"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>INV-002</td>
                                <td>Tech Solutions</td>
                                <td>2024-02-01</td>
                                <td>2024-03-01</td>
                                <td>$3,500</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>
                                    <div class="hstack gap-2">
                                        <a href="<?= base_url('admin/invoices/view/2') ?>" class="btn btn-icon btn-sm btn-info"><i class="feather-eye"></i></a>
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