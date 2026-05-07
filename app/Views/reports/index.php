<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4">
        <div class="card mb-4 bg-primary text-white">
            <div class="card-body">
                <h6>Lifetime Revenue</h6>
                <h3>₱<?= number_format($total_revenue, 2) ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">Daily Sales Report</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Total Sales</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($daily_sales as $report): ?>
                    <tr>
                        <td><?= date('F d, Y', strtotime($report['date'])) ?></td>
                        <td>₱<?= number_format($report['total'], 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($daily_sales)): ?>
                    <tr>
                        <td colspan="2" class="text-center">No sales data available.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
