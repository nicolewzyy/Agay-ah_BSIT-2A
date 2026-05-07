<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Product List</span>
        <a href="<?= base_url('inventory/create') ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Add Product
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td>
                            <div class="fw-bold"><?= $product['name'] ?></div>
                            <small class="text-muted"><?= truncate_to_word($product['description'] ?? '', 50) ?></small>
                        </td>
                        <td><span class="badge bg-info text-dark"><?= $product['category_name'] ?></span></td>
                        <td>₱<?= number_format($product['price'], 2) ?></td>
                        <td>
                            <span class="badge <?= $product['stock_quantity'] < 10 ? 'bg-danger' : 'bg-success' ?>">
                                <?= $product['stock_quantity'] ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= base_url('inventory/edit/' . $product['id']) ?>" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="<?= base_url('inventory/delete/' . $product['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?php
function truncate_to_word($string, $limit) {
    if (strlen($string) > $limit) {
        $string = substr($string, 0, $limit) . "...";
    }
    return $string;
}
?>
