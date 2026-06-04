<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row g-3">
    <div class="col-md-6 col-xl-3">
        <div class="card stretch">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted mb-2">Total Users</div>
                        <h4 class="mb-1">1,234</h4>
                        <span class="badge bg-soft-success text-success">+12%</span>
                    </div>
                    <div class="avatar-text avatar-lg bg-primary text-white rounded">
                        <i class="feather-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card stretch">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted mb-2">Customers</div>
                        <h4 class="mb-1">856</h4>
                        <span class="badge bg-soft-success text-success">+8%</span>
                    </div>
                    <div class="avatar-text avatar-lg bg-success text-white rounded">
                        <i class="feather-user-plus"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card stretch">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted mb-2">Active Leads</div>
                        <h4 class="mb-1">324</h4>
                        <span class="badge bg-soft-warning text-warning">+5%</span>
                    </div>
                    <div class="avatar-text avatar-lg bg-warning text-white rounded">
                        <i class="feather-alert-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card stretch">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted mb-2">Revenue</div>
                        <h4 class="mb-1">$45,678</h4>
                        <span class="badge bg-soft-success text-success">+18%</span>
                    </div>
                    <div class="avatar-text avatar-lg bg-info text-white rounded">
                        <i class="feather-dollar-sign"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mt-4">
    <div class="col-lg-8">
        <div class="card stretch">
            <div class="card-header">
                <h5 class="card-title">Revenue Overview</h5>
            </div>
            <div class="card-body">
                <div id="revenueChart"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card stretch">
            <div class="card-header">
                <h5 class="card-title">Recent Activities</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-text avatar-sm bg-primary text-white rounded">
                                            <i class="feather-user-plus"></i>
                                        </div>
                                        <div>
                                            <span class="d-block">New customer registered</span>
                                            <span class="text-muted fs-11">2 minutes ago</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-text avatar-sm bg-success text-white rounded">
                                            <i class="feather-file-text"></i>
                                        </div>
                                        <div>
                                            <span class="d-block">New proposal created</span>
                                            <span class="text-muted fs-11">15 minutes ago</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-text avatar-sm bg-warning text-white rounded">
                                            <i class="feather-dollar-sign"></i>
                                        </div>
                                        <div>
                                            <span class="d-block">Payment received</span>
                                            <span class="text-muted fs-11">1 hour ago</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-text avatar-sm bg-info text-white rounded">
                                            <i class="feather-briefcase"></i>
                                        </div>
                                        <div>
                                            <span class="d-block">Project updated</span>
                                            <span class="text-muted fs-11">3 hours ago</span>
                                        </div>
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

<div class="row g-3 mt-4">
    <div class="col-lg-6">
        <div class="card stretch">
            <div class="card-header">
                <h5 class="card-title">Top Customers</h5>
                <a href="<?= base_url('admin/customers') ?>" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Total Spent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?= base_url('public/assets_admin/images/avatar/1.png') ?>" alt="" class="img-fluid wd-30 ht-30 rounded-circle" />
                                        <span>John Doe</span>
                                    </div>
                                </td>
                                <td>john@example.com</td>
                                <td>$5,234</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?= base_url('public/assets_admin/images/avatar/2.png') ?>" alt="" class="img-fluid wd-30 ht-30 rounded-circle" />
                                        <span>Jane Smith</span>
                                    </div>
                                </td>
                                <td>jane@example.com</td>
                                <td>$4,123</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?= base_url('public/assets_admin/images/avatar/3.png') ?>" alt="" class="img-fluid wd-30 ht-30 rounded-circle" />
                                        <span>Mike Johnson</span>
                                    </div>
                                </td>
                                <td>mike@example.com</td>
                                <td>$3,456</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card stretch">
            <div class="card-header">
                <h5 class="card-title">Recent Leads</h5>
                <a href="<?= base_url('admin/leads') ?>" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Lead</th>
                                <th>Status</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Acme Corporation</td>
                                <td><span class="badge bg-success">Qualified</span></td>
                                <td>$12,000</td>
                            </tr>
                            <tr>
                                <td>Tech Solutions Inc</td>
                                <td><span class="badge bg-warning">New</span></td>
                                <td>$8,500</td>
                            </tr>
                            <tr>
                                <td>Global Industries</td>
                                <td><span class="badge bg-info">Contacted</span></td>
                                <td>$6,200</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>