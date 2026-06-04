<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row g-3">
    <div class="col-12">
        <div class="card stretch">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">All Customers</h5>
                <a href="<?= base_url('admin/customers/create') ?>" class="btn btn-primary">
                    <i class="feather-plus me-2"></i>Add Customer
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="customersTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Company</th>
                                <th>Contact Person</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Total Spent</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Acme Corporation</td>
                                <td>John Doe</td>
                                <td>john@acme.com</td>
                                <td>+1 234 567 890</td>
                                <td>$15,234</td>
                                <td>
                                    <div class="hstack gap-2">
                                        <a href="<?= base_url('admin/customers/view/1') ?>" class="btn btn-icon btn-sm btn-info"><i class="feather-eye"></i></a>
                                        <a href="<?= base_url('admin/customers/edit/1') ?>" class="btn btn-icon btn-sm btn-warning"><i class="feather-edit-2"></i></a>
                                        <button type="button" class="btn btn-icon btn-sm btn-danger"><i class="feather-trash-2"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Tech Solutions</td>
                                <td>Jane Smith</td>
                                <td>jane@techsol.com</td>
                                <td>+1 234 567 891</td>
                                <td>$12,456</td>
                                <td>
                                    <div class="hstack gap-2">
                                        <a href="<?= base_url('admin/customers/view/2') ?>" class="btn btn-icon btn-sm btn-info"><i class="feather-eye"></i></a>
                                        <a href="<?= base_url('admin/customers/edit/2') ?>" class="btn btn-icon btn-sm btn-warning"><i class="feather-edit-2"></i></a>
                                        <button type="button" class="btn btn-icon btn-sm btn-danger"><i class="feather-trash-2"></i></button>
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