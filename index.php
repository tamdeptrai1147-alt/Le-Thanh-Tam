<?php
require_once 'config.php';
require_once 'helpers.php';

// Logic tìm kiếm và lấy dữ liệu sản phẩm
$q = trim($_GET['q'] ?? '');
$params = [];
$sql = "SELECT * FROM products WHERE 1";
if ($q !== '') {
    $sql .= " AND (title LIKE ? OR description LIKE ?)";
    $params[] = "%$q%";
    $params[] = "%$q%";
}
$sql .= " ORDER BY id DESC LIMIT 50"; 
$stmt = db()->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$user = current_user();
?>
<!doctype html><html><head><meta charset="utf-8"><title>DragonCore - Gaming Gear</title>
<link rel="stylesheet" href="style.css?v=3">
</head><body>

<header>
    <div class="header-container">
        <a href="index.php" class="logo">dragoncore</a>
        
        <div class="user-nav">
            <a href="index.php">Sản phẩm</a>
            <?php if ($user): ?>
                <span style="color:white; margin-left:15px">Hi, <b><?=h($user['name'])?></b></span>
                <a href="logout.php">Đăng xuất</a>
                <?php if ($user['is_admin']): ?> <a href="admin_products.php" style="color: #ffcc00">Admin</a><?php endif; ?>
            <?php else: ?>
                <a href="login.php">Đăng nhập</a>
                <a href="register.php">Đăng ký</a>
            <?php endif; ?>
            <a href="cart.php">Giỏ hàng <span class="cart-badge"><?=array_sum(cart_items())?:0?></span></a>
        </div>
    </div>
</header>

<div class="hero-section">
    <img src="banner1.webp" alt="Nvidia Banner">
</div>

<div class="search-container">
    <form method="get" class="search-form">
        <input name="q" value="<?=h($q)?>" placeholder="Tìm kiếm linh kiện, máy tính...">
        <button>Tìm</button>
    </form>
</div>

<div class="container">
    <h2 class="section-title">Sản phẩm nổi bật</h2>

    <div class="product-grid"> 
    <?php if (empty($products)): ?>
        <p style="text-align: center; font-size: 1.2em; color: var(--text-muted);">Không tìm thấy sản phẩm nào.</p>
    <?php else: ?>
        <?php foreach ($products as $p): ?>
          <div class="product-card">
            <div class="card-img">
                <img src="<?=h($p['image']?:SAMPLE_IMAGE)?>" alt="<?=h($p['title'])?>">
            </div>
            <div class="card-body">
                <div class="card-title"><?=h($p['title'])?></div>
                <div class="card-price"><?=number_format($p['price'], 0, ',', '.')?> VND</div>
                <div class="card-actions">
                    <a href="product.php?id=<?=h($p['id'])?>" class="btn btn-outline">Chi tiết</a> 
                    <a href="cart_action.php?action=add&id=<?=h($p['id'])?>" class="btn btn-primary">Thêm giỏ</a>
                </div>
            </div>
          </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </div>
</div>

</body></html>