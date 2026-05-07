<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inayawan Central Canteen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4e73df;
            --primary-dark: #224abe;
            --accent: #1cc88a;
            --bg: #f8f9fc;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #f8f9fc 0%, #e2e8f0 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }
        .login-wrapper {
            display: flex;
            width: 1000px;
            height: 600px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .login-sidebar {
            flex: 1;
            background: linear-gradient(rgba(78, 115, 223, 0.9), rgba(34, 74, 190, 0.9)), 
                        url('https://images.unsplash.com/photo-1567529684892-0f73fdba133a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');
            background-size: cover;
            background-position: center;
            padding: 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
        }
        .login-form-container {
            width: 450px;
            padding: 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .brand-logo {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 8px;
        }
        .form-control {
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
            font-weight: 500;
        }
        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(78, 115, 223, 0.1);
            border-color: var(--primary);
        }
        .btn-primary {
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            background: var(--primary);
            border: none;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.3);
        }
        .create-account-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
        .create-account-link:hover {
            text-decoration: underline;
        }
        .alert {
            border-radius: 12px;
            border: none;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-sidebar d-none d-lg-flex">
            <h1 class="brand-logo">Inayawan Central Canteen</h1>
            <p class="lead opacity-75">Student-friendly Sales & Inventory System designed for efficiency and ease of use.</p>
            <div class="mt-4 d-flex gap-3">
                <div class="p-3 bg-white bg-opacity-10 rounded-4 flex-grow-1 border border-white border-opacity-10">
                    <h5 class="mb-1">Quick POS</h5>
                    <p class="small mb-0 opacity-75">Process sales faster with our optimized interface.</p>
                </div>
                <div class="p-3 bg-white bg-opacity-10 rounded-4 flex-grow-1 border border-white border-opacity-10">
                    <h5 class="mb-1">Inventory</h5>
                    <p class="small mb-0 opacity-75">Real-time tracking for every item in stock.</p>
                </div>
            </div>
        </div>
        <div class="login-form-container">
            <div class="mb-5">
                <h2 class="fw-bold mb-2">Welcome Back</h2>
                <p class="text-muted">Sign in to manage your canteen operations.</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger mb-4"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success mb-4"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('login') ?>" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label small fw-bold text-muted">USERNAME</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required autofocus>
                </div>
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="password" class="form-label small fw-bold text-muted mb-0">PASSWORD</label>
                    </div>
                    <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-4">Sign In</button>
            </form>

            <div class="text-center">
                <p class="text-muted small">Don't have an account? <a href="<?= base_url('register') ?>" class="create-account-link">Create Account</a></p>
            </div>
        </div>
    </div>
</body>
</html>
