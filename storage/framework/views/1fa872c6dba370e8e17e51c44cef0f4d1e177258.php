<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> - Inventory Management System</title>
    <style>
        /* Styling ASLI persis seperti P4 Teman */
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f3f4f6; margin: 0; color: #374151; }
        .navbar { background-color: #1e3a8a; color: white; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; }
        .navbar a { color: white; text-decoration: none; padding: 8px 15px; border-radius: 4px; transition: background 0.2s; font-size: 14px; }
        .navbar a:hover { background-color: #1e40af; }
        .nav-brand { font-size: 1.2rem; font-weight: bold; }
        .nav-menu { display: flex; align-items: center; }
        .container { max-width: 1100px; margin: 30px auto; padding: 0 20px; }
        .card { background: white; border-radius: 8px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .badge-role { background-color: #f59e0b; color: white; padding: 2px 8px; border-radius: 12px; font-size: 12px; font-weight: bold; text-transform: uppercase; }
        .btn { display: inline-block; padding: 8px 14px; background-color: #2563eb; color: white; text-decoration: none; border-radius: 6px; border: none; cursor: pointer; font-size: 14px; }
        .btn:hover { background-color: #1d4ed8; }
        .btn-success { background-color: #10b981; }
        .btn-success:hover { background-color: #059669; }
        .btn-danger { background-color: #dc2626; }
        .btn-danger:hover { background-color: #b91c1c; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #e5e7eb; padding: 12px; text-align: left; font-size: 14px; }
        th { background-color: #f9fafb; }
        .alert-success { background-color: #d1fae5; color: #065f46; padding: 12px; border-radius: 6px; margin-bottom: 15px; }
        .alert-danger { background-color: #fee2e2; color: #991b1b; padding: 12px; border-radius: 6px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">📦 InventoryApp</div>
        <div class="nav-menu">
            <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
            <a href="<?php echo e(route('products.index')); ?>">Data Produk</a>
            <a href="<?php echo e(route('stock.history')); ?>">Transaksi Stok</a>
            
            <span style="margin: 0 20px; border-left: 1px solid #3b82f6; padding-left: 20px;">
                Halo, <strong><?php echo e(auth()->user()->username ?? 'User'); ?></strong> 
                <span class="badge-role"><?php echo e(auth()->user()->role ?? ''); ?></span>
            </span>

            <form action="<?php echo e(route('logout')); ?>" method="POST" style="display: inline; margin: 0;">
                <?php echo csrf_field(); ?>
                <button type="submit" style="background-color: #dc2626; color: white; border: none; font-weight: bold; padding: 8px 15px; border-radius: 4px; cursor: pointer; font-size: 14px;">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <?php if(session('success')): ?>
            <div class="alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>
</html>
<?php /**PATH C:\XAMPP\htdocs\Inventory-laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>