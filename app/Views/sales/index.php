<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <!-- POS Interface -->
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Products</span>
                <input type="text" id="search-product" class="form-control form-control-sm w-50" placeholder="Search product...">
            </div>
            <div class="card-body">
                <div class="row" id="product-list">
                    <?php foreach ($products as $product): ?>
                    <div class="col-md-4 col-sm-6 mb-3 product-item" data-name="<?= strtolower($product['name']) ?>">
                        <div class="card h-100 product-card shadow-sm" style="cursor: pointer;" onclick="addToCart(<?= $product['id'] ?>, '<?= $product['name'] ?>', <?= $product['price'] ?>, <?= $product['stock_quantity'] ?>)">
                            <div class="card-body text-center p-3">
                                <h6 class="fw-bold mb-1"><?= $product['name'] ?></h6>
                                <p class="text-primary fw-bold mb-1">₱<?= number_format($product['price'], 2) ?></p>
                                <small class="text-muted"><?= $product['stock_quantity'] ?> in stock</small>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart / Checkout -->
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header">Current Order</div>
            <div class="card-body p-0">
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table align-middle mb-0">
                        <thead class="bg-light sticky-top">
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            <!-- Items added via JS -->
                        </tbody>
                    </table>
                </div>
                
                <div class="p-3 border-top bg-light">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span id="subtotal">₱0.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Discount</span>
                        <input type="number" id="discount-input" class="form-control form-control-sm w-25 text-end" value="0" min="0" onchange="calculateTotal()">
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="fw-bold">Total</h5>
                        <h5 class="fw-bold text-primary" id="total-amount">₱0.00</h5>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small">Amount Paid</label>
                        <input type="number" id="paid-amount" class="form-control form-control-lg" placeholder="0.00" oninput="calculateChange()">
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <span>Change</span>
                        <span id="change-amount" class="fw-bold text-success">₱0.00</span>
                    </div>

                    <button class="btn btn-primary btn-lg w-100" id="checkout-btn" onclick="processCheckout()">
                        <i class="bi bi-check-circle me-2"></i> Complete Sale
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let cart = [];

    function addToCart(id, name, price, stock) {
        const existing = cart.find(item => item.id === id);
        if (existing) {
            if (existing.quantity >= stock) {
                alert('Out of stock!');
                return;
            }
            existing.quantity++;
        } else {
            if (stock <= 0) {
                alert('Out of stock!');
                return;
            }
            cart.push({ id, name, price, quantity: 1 });
        }
        renderCart();
    }

    function removeFromCart(id) {
        cart = cart.filter(item => item.id !== id);
        renderCart();
    }

    function updateQuantity(id, qty) {
        const item = cart.find(i => i.id === id);
        if (item) {
            item.quantity = parseInt(qty);
            if (item.quantity <= 0) removeFromCart(id);
        }
        renderCart();
    }

    function renderCart() {
        const cartTbody = document.getElementById('cart-items');
        cartTbody.innerHTML = '';
        
        let subtotal = 0;
        cart.forEach(item => {
            const rowTotal = item.price * item.quantity;
            subtotal += rowTotal;
            cartTbody.innerHTML += `
                <tr>
                    <td><small class="fw-bold">${item.name}</small></td>
                    <td style="width: 80px;">
                        <input type="number" class="form-control form-control-sm" value="${item.quantity}" onchange="updateQuantity(${item.id}, this.value)">
                    </td>
                    <td>₱${rowTotal.toFixed(2)}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-danger" onclick="removeFromCart(${item.id})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
        });

        document.getElementById('subtotal').innerText = `₱${subtotal.toFixed(2)}`;
        calculateTotal();
    }

    function calculateTotal() {
        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const discount = parseFloat(document.getElementById('discount-input').value) || 0;
        const total = Math.max(0, subtotal - discount);
        
        document.getElementById('total-amount').innerText = `₱${total.toFixed(2)}`;
        calculateChange();
    }

    function calculateChange() {
        const totalText = document.getElementById('total-amount').innerText.replace('₱', '').replace(',', '');
        const total = parseFloat(totalText) || 0;
        const paid = parseFloat(document.getElementById('paid-amount').value) || 0;
        const change = paid - total;
        
        const changeElement = document.getElementById('change-amount');
        const changeLabel = changeElement.previousElementSibling;
        const checkoutBtn = document.getElementById('checkout-btn');

        if (paid === 0 && total === 0) {
            changeElement.innerText = '₱0.00';
            changeLabel.innerText = 'Change';
            changeElement.className = 'fw-bold text-success';
            checkoutBtn.disabled = true;
            return;
        }

        if (paid < total || cart.length === 0) {
            if (paid < total && cart.length > 0) {
                changeElement.innerText = `₱${Math.abs(change).toFixed(2)}`;
                changeLabel.innerText = 'Balance Due';
                changeElement.className = 'fw-bold text-danger';
            } else {
                changeElement.innerText = '₱0.00';
                changeLabel.innerText = 'Change';
                changeElement.className = 'fw-bold text-danger';
            }
            checkoutBtn.disabled = true;
        } else {
            changeElement.innerText = `₱${change.toFixed(2)}`;
            changeLabel.innerText = 'Change';
            changeElement.className = 'fw-bold text-success';
            checkoutBtn.disabled = false;
        }
    }

    function processCheckout() {
        if (cart.length === 0) {
            alert('Cart is empty!');
            return;
        }

        const total = parseFloat(document.getElementById('total-amount').innerText.replace('₱', ''));
        const paid = parseFloat(document.getElementById('paid-amount').value) || 0;

        if (paid < total) {
            alert('Insufficient payment!');
            return;
        }

        const data = {
            cart: cart,
            total_amount: cart.reduce((sum, item) => sum + (item.price * item.quantity), 0),
            discount: parseFloat(document.getElementById('discount-input').value) || 0,
            final_amount: total,
            paid_amount: paid,
            change_amount: paid - total
        };

        $.post('<?= base_url('sales/process') ?>', data, function(res) {
            if (res.status === 'success') {
                alert('Sale completed successfully!');
                cart = [];
                document.getElementById('paid-amount').value = '';
                document.getElementById('discount-input').value = 0;
                renderCart();
                location.reload(); // To update stock levels
            } else {
                alert('Error: ' + res.message);
            }
        });
    }

    // Search functionality
    document.getElementById('search-product').addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('.product-item').forEach(item => {
            const name = item.getAttribute('data-name');
            if (name.includes(term)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
<?= $this->endSection() ?>
