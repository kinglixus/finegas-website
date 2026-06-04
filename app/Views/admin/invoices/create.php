<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row g-3">
    <div class="col-12">
        <div class="card stretch">
            <div class="card-header">
                <h5 class="card-title mb-0">Create New Invoice</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/invoices/store') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Customer</label>
                            <select name="customer_id" class="form-select" required>
                                <option value="">Select Customer</option>
                                <option value="1">Acme Corporation</option>
                                <option value="2">Tech Solutions</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Invoice Date</label>
                            <input type="date" name="invoice_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Due Date</label>
                            <input type="date" name="due_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Project (Optional)</label>
                            <select name="product_id" class="form-select">
                                <option value="">Select Project</option>
                                <option value="1">Website Redesign</option>
                                <option value="2">Mobile App</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Items</label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="invoiceItems">
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="items[0][description]" class="form-control" placeholder="Item description"></td>
                                            <td><input type="number" name="items[0][quantity]" class="form-control" value="1"></td>
                                            <td><input type="number" name="items[0][price]" class="form-control" placeholder="0.00"></td>
                                            <td class="item-total">$0.00</td>
                                            <td><button type="button" class="btn btn-icon btn-danger btn-sm"><i class="feather-trash-2"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="addItem()">Add Item</button>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tax Rate (%)</label>
                            <input type="number" name="tax_rate" class="form-control" value="10">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-3">
                                <a href="<?= base_url('admin/invoices') ?>" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Create Invoice</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>