<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row g-3">
    <div class="col-12">
        <div class="card stretch">
            <div class="card-header">
                <h5 class="card-title mb-0">Create New Lead</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/leads/store') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Company Name</label>
                            <input type="text" name="company_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact Person</label>
                            <input type="text" name="contact_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Source</label>
                            <select name="source" class="form-select">
                                <option value="website">Website</option>
                                <option value="referral">Referral</option>
                                <option value="social">Social Media</option>
                                <option value="ads">Paid Ads</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Estimated Value</label>
                            <input type="number" name="value" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-3">
                                <a href="<?= base_url('admin/leads') ?>" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Create Lead</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>