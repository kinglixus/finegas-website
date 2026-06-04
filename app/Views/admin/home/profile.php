<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="row g-3">
    <div class="col-12">
        <div class="card stretch">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit Profile</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/profile') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?= $admin_user['name'] ?? '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" value="<?= $admin_user['email'] ?? '' ?>" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password (leave blank to keep)</label>
                        <input type="password" name="current_password" id="current_password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password (leave blank to keep)</label>
                        <input type="password" name="new_password" id="new_password" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary" style="background-color: #395555; border-color: #395555;">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>