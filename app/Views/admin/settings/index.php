<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row g-3">
    <div class="col-lg-3">
        <div class="card stretch">
            <div class="list-group list-group-flush" id="settingsTabs">
                <a href="#general" class="list-group-item active" data-bs-toggle="pill">
                    <i class="feather-settings me-2"></i>General
                </a>
                <a href="#profile" class="list-group-item" data-bs-toggle="pill">
                    <i class="feather-user me-2"></i>Profile
                </a>
                <a href="#company" class="list-group-item" data-bs-toggle="pill">
                    <i class="feather-home me-2"></i>Company
                </a>
                <a href="#notifications" class="list-group-item" data-bs-toggle="pill">
                    <i class="feather-bell me-2"></i>Notifications
                </a>
                <a href="#security" class="list-group-item" data-bs-toggle="pill">
                    <i class="feather-shield me-2"></i>Security
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card stretch">
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="general">
                        <h5 class="mb-4">General Settings</h5>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Site Name</label>
                                    <input type="text" class="form-control" value="Fine Gas">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Timezone</label>
                                    <select class="form-select">
                                        <option>UTC</option>
                                        <option selected>America/New_York</option>
                                        <option>Europe/London</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Date Format</label>
                                    <select class="form-select">
                                        <option value="Y-m-d">YYYY-MM-DD</option>
                                        <option value="d/m/Y">DD/MM/YYYY</option>
                                        <option value="m/d/Y">MM/DD/YYYY</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Currency</label>
                                    <select class="form-select">
                                        <option value="USD" selected>USD ($)</option>
                                        <option value="EUR">EUR (€)</option>
                                        <option value="GBP">GBP (£)</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="profile">
                        <h5 class="mb-4">Profile Settings</h5>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" value="Admin User">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="admin@finegas.com">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Bio</label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="company">
                        <h5 class="mb-4">Company Settings</h5>
                        <form>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control" value="Fine Gas Company">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control" rows="2">123 Business Street, City, State 12345</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" value="+1 234 567 890">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tax ID</label>
                                    <input type="text" class="form-control" value="XX-XXXXXXX">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="notifications">
                        <h5 class="mb-4">Notification Settings</h5>
                        <div class="d-flex flex-column gap-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                                <label class="form-check-label">Email notifications for new leads</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                                <label class="form-check-label">Email notifications for new invoices</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">Email notifications for product updates</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                                <label class="form-check-label">Daily summary email</label>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="security">
                        <h5 class="mb-4">Security Settings</h5>
                        <form>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">New Password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>