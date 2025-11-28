<?php
require_once 'config.php';
require_once 'helpers.php';

// Lấy ID sản phẩm từ URL
$id = intval($_GET['id'] ?? 0);

// Nếu không có ID hợp lệ, chuyển hướng về trang chính
if ($id === 0) {
    redirect('index.php');
}

// Truy vấn lấy thông tin sản phẩm
$stmt = db()->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

// Nếu không tìm thấy sản phẩm, thông báo lỗi
if (!$product) {
    http_response_code(404);
    echo "Sản phẩm không tồn tại.";
    exit;
}

$user = current_user();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= h($product['title']) ?> - Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <header>
        <h1><a href="index.php">Shop</a></h1>
        <div class="user-links">
            <a href="index.php">Sản phẩm</a> | 
            <?php if ($user): ?>
                Xin chào **<?=h($user['name'])?>** | <a href="logout.php">Đăng xuất</a>
                <?php if ($user['is_admin']): ?> | <a href="admin_products.php">Admin</a><?php endif; ?>
            <?php else: ?>
                <a href="login.php">Đăng nhập</a> | <a href="register.php">Đăng ký</a>
            <?php endif; ?>
            | <a href="cart.php">Giỏ hàng (<?=array_sum(cart_items())?:0?>)</a>
        </div>
    </header>

    <div class="container product-detail">
        <h2><?= h($product['title']) ?></h2>

        <div class="detail-content">
            <img src="<?=h($product['image']?:SAMPLE_IMAGE)?>" alt="<?=h($product['title'])?>">
            
            <div class="info">
                <p class="price-big">
                    Giá: <strong><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</strong>
                </p>
                <p>
                    Kho: <span class="stock-status stock-<?= $product['stock'] > 0 ? 'in' : 'out' ?>">
                        <?= $product['stock'] > 0 ? 'Còn hàng (' . h($product['stock']) . ')' : 'Hết hàng' ?>
                    </span>
                </p>
                
                <h3>Mô tả chi tiết:</h3>
                <div class="description-box">
                    <?= nl2br(h($product['description'])) ?>
                </div>

                <div class="actions">
                    <?php if ($product['stock'] > 0): ?>
                        <a href="cart_action.php?action=add&id=<?=h($product['id'])?>" class="add-to-cart-btn">
                            Thêm vào giỏ hàng
                        </a>
                    <?php endif; ?>
                    <a href="index.php" class="back-btn">
                        <i class="fas fa-arrow-left"></i> Quay lại danh sách
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>