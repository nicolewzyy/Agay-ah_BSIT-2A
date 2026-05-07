<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Inayawan Central Canteen</title>
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
            height: 650px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .login-sidebar {
            flex: 1;
            background: linear-gradient(rgba(28, 200, 138, 0.9), rgba(22, 160, 110, 0.9)), 
                        url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');
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
            overflow-y: auto;
        }
        .brand-logo {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 8px;
        }
        .form-control {
            padding: 10px 16px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
            font-weight: 500;
        }
        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(28, 200, 138, 0.1);
            border-color: var(--accent);
        }
        .btn-accent {
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            background: var(--accent);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-accent:hover {
            background: #16a06e;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(28, 200, 138, 0.3);
            color: white;
        }
        .login-link {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }
        .login-link:hover {
            text-decoration: underline;
        }
        .alert {
            border-radius: 12px;
            border: none;
            font-size: 0.85rem;
            padding: 10px 15px;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-sidebar d-none d-lg-flex">
            <h1 class="brand-logo">Join the Team</h1>
            <p class="lead opacity-75">Start managing your canteen more effectively today. Create an account to get started.</p>
            <div class="mt-4">
                <div class="p-3 bg-white bg-opacity-10 rounded-4 mb-3 border border-white border-opacity-10">
                    <h5 class="mb-1">Secure & Reliable</h5>
                    <p class="small mb-0 opacity-75">Your data is safe with our encrypted system.</p>
                </div>
                <div class="p-3 bg-white bg-opacity-10 rounded-4 border border-white border-opacity-10">
                    <h5 class="mb-1">Staff Management</h5>
                    <p class="small mb-0 opacity-75">Easily track who is handling the sales.</p>
                </div>
            </div>
        </div>
        <div class="login-form-container">
            <div class="mb-4">
                <h2 class="fw-bold mb-2">Create Account</h2>
                <p class="text-muted">Enter your details to register as a staff member.</p>
            </div>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0 ps-3">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('register') ?>" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label small fw-bold text-muted">FULL NAME</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" value="<?= old('name') ?>" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label small fw-bold text-muted">USERNAME</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="johndoe123" value="<?= old('username') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label small fw-bold text-muted">PASSWORD</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="form-label small fw-bold text-muted">CONFIRM PASSWORD</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn btn-accent w-100 mb-3">Register Account</button>
            </form>

            <div class="text-center">
                <p class="text-muted small">Already have an account? <a href="<?= base_url('login') ?>" class="login-link">Sign In</a></p>
            </div>
        </div>
    </div>
</body>
</html>
