<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row g-3">
    <div class="col-12">
        <div class="card stretch">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">All Users</h5>
                <?php if (can('users.create')): ?>
                    <a href="<?= base_url('admin/users/create') ?>" class="btn btn-primary">
                        <i class="feather-plus me-2"></i>Add User
                    </a>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="usersTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?= base_url('public/assets_admin/images/avatar/1.png') ?>" alt=""
                                            class="img-fluid wd-30 ht-30 rounded-circle" />
                                        <span>John Doe</span>
                                    </div>
                                </td>
                                <td>john@example.com</td>
                                <td><span class="badge bg-primary">Admin</span></td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>2024-01-15</td>
                                <td>
                                    <div class="hstack gap-2">
                                        <a href="<?= base_url('admin/users/view/1') ?>"
                                            class="btn btn-icon btn-sm btn-info"><i class="feather-eye"></i></a>
                                        <a href="<?= base_url('admin/users/edit/1') ?>"
                                            class="btn btn-icon btn-sm btn-warning"><i class="feather-edit-2"></i></a>
                                        <button type="button" class="btn btn-icon btn-sm btn-danger"
                                            onclick="deleteUser(1)"><i class="feather-trash-2"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?= base_url('public/assets_admin/images/avatar/2.png') ?>" alt=""
                                            class="img-fluid wd-30 ht-30 rounded-circle" />
                                        <span>Jane Smith</span>
                                    </div>
                                </td>
                                <td>jane@example.com</td>
                                <td><span class="badge bg-info">Manager</span></td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>2024-02-20</td>
                                <td>
                                    <div class="hstack gap-2">
                                        <a href="<?= base_url('admin/users/view/2') ?>"
                                            class="btn btn-icon btn-sm btn-info"><i class="feather-eye"></i></a>
                                        <a href="<?= base_url('admin/users/edit/2') ?>"
                                            class="btn btn-icon btn-sm btn-warning"><i class="feather-edit-2"></i></a>
                                        <button type="button" class="btn btn-icon btn-sm btn-danger"
                                            onclick="deleteUser(2)"><i class="feather-trash-2"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?= base_url('public/assets_admin/images/avatar/3.png') ?>" alt=""
                                            class="img-fluid wd-30 ht-30 rounded-circle" />
                                        <span>Mike Johnson</span>
                                    </div>
                                </td>
                                <td>mike@example.com</td>
                                <td><span class="badge bg-secondary">Staff</span></td>
                                <td><span class="badge bg-warning">Inactive</span></td>
                                <td>2024-03-10</td>
                                <td>
                                    <div class="hstack gap-2">
                                        <a href="<?= base_url('admin/users/view/3') ?>"
                                            class="btn btn-icon btn-sm btn-info"><i class="feather-eye"></i></a>
                                        <a href="<?= base_url('admin/users/edit/3') ?>"
                                            class="btn btn-icon btn-sm btn-warning"><i class="feather-edit-2"></i></a>
                                        <button type="button" class="btn btn-icon btn-sm btn-danger"
                                            onclick="deleteUser(3)"><i class="feather-trash-2"></i></button>
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