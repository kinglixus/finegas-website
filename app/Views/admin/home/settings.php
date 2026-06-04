<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Settings</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/settings') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="form-group">
                        <label for="site_name">Site Name</label>
                        <input type="text" name="site_name" id="site_name" class="form-control" value="Fine Gas">
                    </div>

                    <button type="submit" class="btn btn-primary" style="background-color: #395555; border-color: #395555;">Save Settings</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>