<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row g-3">
    <div class="col-12">
        <div class="card stretch">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">All Projects</h5>
                <a href="<?= base_url('admin/products/create') ?>" class="btn btn-primary">
                    <i class="feather-plus me-2"></i>Add Project
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Project Name</th>
                                <th>Customer</th>
                                <th>Start Date</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Website Redesign</td>
                                <td>Acme Corp</td>
                                <td>2024-01-15</td>
                                <td>2024-03-15</td>
                                <td><span class="badge bg-primary">In Progress</span></td>
                                <td>
                                    <div class="hstack gap-2">
                                        <a href="<?= base_url('admin/products/view/1') ?>" class="btn btn-icon btn-sm btn-info"><i class="feather-eye"></i></a>
                                        <a href="<?= base_url('admin/products/edit/1') ?>" class="btn btn-icon btn-sm btn-warning"><i class="feather-edit-2"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Mobile App Development</td>
                                <td>Tech Solutions</td>
                                <td>2024-02-01</td>
                                <td>2024-06-01</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td>
                                    <div class="hstack gap-2">
                                        <a href="<?= base_url('admin/products/view/2') ?>" class="btn btn-icon btn-sm btn-info"><i class="feather-eye"></i></a>
                                        <a href="<?= base_url('admin/products/edit/2') ?>" class="btn btn-icon btn-sm btn-warning"><i class="feather-edit-2"></i></a>
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