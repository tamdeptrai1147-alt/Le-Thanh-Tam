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
// Sắp xếp theo ID giảm dần để tránh lỗi nếu chưa thêm cột created_at
$sql .= " ORDER BY id DESC LIMIT 50"; 
$stmt = db()->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();
$user = current_user();
?>
<!doctype html><html><head><meta charset="utf-8"><title>Shop - Danh sách sản phẩm</title>
<link rel="stylesheet" href="style.css"> </head><body>
<header>
  <h1><a href="index.php">dragoncore</a></h1>
  <div class="user-links">
  <?php if ($user): ?>
    Xin chào **<?=h($user['name'])?>** | <a href="logout.php">Đăng xuất</a>
    <?php if ($user['is_admin']): ?> | <a href="admin_products.php">Admin</a><?php endif; ?>
  <?php else: ?>
    <a href="login.php">Đăng nhập</a> | <a href="register.php">Đăng ký</a>
  <?php endif; ?>
  | <a href="cart.php">Giỏ hàng (<?=array_sum(cart_items())?:0?>)</a>
  </div>
</header>

<div class="banner">
  MSI GAMING SHOP - POWERED BY DRAGON CORE
</div>

<form method="get" class="search-form">
  <input name="q" value="<?=h($q)?>" placeholder="Tìm kiếm sản phẩm...">
  <button>Tìm</button>
</form>

<div class="product-grid"> <?php if (empty($products)): ?>
    <p style="text-align: center; font-size: 1.2em; color: var(--primary-color);">Không tìm thấy sản phẩm nào.</p>
<?php else: ?>
    <?php foreach ($products as $p): ?>
      <div class="product-card">
        <img src="<?=h($p['image']?:SAMPLE_IMAGE)?>" alt="<?=h($p['title'])?>"><br>
        <strong><?=h($p['title'])?></strong><br>
        <small><?=number_format($p['price'], 2)?> VND</small><br>
        <a href="product.php?id=<?=h($p['id'])?>" class="detail">Chi tiết</a> 
        <a href="cart_action.php?action=add&id=<?=h($p['id'])?>">Thêm vào giỏ</a>
      </div>
    <?php endforeach; ?>
<?php endif; ?>
</div>
</body></html>