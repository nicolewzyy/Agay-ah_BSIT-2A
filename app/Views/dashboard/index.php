<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <!-- Total Sales Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2" style="border-left: 0.25rem solid #4e73df !important;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Sales</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">₱<?= number_format($total_sales, 2) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-currency-dollar fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Products Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success h-100 py-2" style="border-left: 0.25rem solid #1cc88a !important;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Products</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_products ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-box-seam fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning h-100 py-2" style="border-left: 0.25rem solid #f6c23e !important;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Low Stock Items</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($low_stock) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-exclamation-triangle fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Sales -->
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">Recent Sales</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Discount</th>
                                <th>Final Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_sales as $sale): ?>
                            <tr>
                                <td><?= date('M d, Y h:i A', strtotime($sale['created_at'])) ?></td>
                                <td>₱<?= number_format($sale['total_amount'], 2) ?></td>
                                <td>₱<?= number_format($sale['discount'], 2) ?></td>
                                <td>₱<?= number_format($sale['final_amount'], 2) ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($recent_sales)): ?>
                            <tr>
                                <td colspan="4" class="text-center">No sales recorded yet.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Items List -->
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header">Low Stock Alert</div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <?php foreach ($low_stock as $item): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= $item['name'] ?>
                        <span class="badge bg-danger rounded-pill"><?= $item['stock_quantity'] ?> left</span>
                    </li>
                    <?php endforeach; ?>
                    <?php if (empty($low_stock)): ?>
                    <li class="list-group-item text-center">All items are well stocked!</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
