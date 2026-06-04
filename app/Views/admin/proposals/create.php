<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row g-3">
    <div class="col-12">
        <div class="card stretch">
            <div class="card-header">
                <h5 class="card-title mb-0">Create New Proposal</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/proposals/store') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">Proposal Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Customer</label>
                            <select name="customer_id" class="form-select" required>
                                <option value="">Select Customer</option>
                                <option value="1">Acme Corporation</option>
                                <option value="2">Tech Solutions</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Valid Until</label>
                            <input type="date" name="valid_until" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Total Value</label>
                            <input type="number" name="total_value" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Proposal Content</label>
                            <div id="editor"></div>
                            <textarea name="content" class="form-control d-none" rows="10"></textarea>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-3">
                                <button type="button" class="btn btn-secondary" onclick="saveDraft()">Save as Draft</button>
                                <a href="<?= base_url('admin/proposals') ?>" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Create Proposal</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>