<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row g-3">
    <div class="col-md-4">
        <div class="card stretch">
            <div class="card-body text-center">
                <h2 class="mb-1">$125,450</h2>
                <p class="text-muted">Total Revenue</p>
                <span class="badge bg-success">+18% vs last month</span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stretch">
            <div class="card-body text-center">
                <h2 class="mb-1">45</h2>
                <p class="text-muted">Total Invoices</p>
                <span class="badge bg-primary">+5 this month</span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stretch">
            <div class="card-body text-center">
                <h2 class="mb-1">92%</h2>
                <p class="text-muted">Collection Rate</p>
                <span class="badge bg-success">+2% vs last month</span>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card stretch">
            <div class="card-header">
                <h5 class="card-title">Revenue by Month</h5>
            </div>
            <div class="card-body">
                <div id="salesChart"></div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card stretch">
            <div class="card-header">
                <h5 class="card-title">Recent Invoices</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Invoice #</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>INV-001</td>
                                <td>Acme Corporation</td>
                                <td>$5,000</td>
                                <td><span class="badge bg-success">Paid</span></td>
                            </tr>
                            <tr>
                                <td>INV-002</td>
                                <td>Tech Solutions</td>
                                <td>$3,500</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>