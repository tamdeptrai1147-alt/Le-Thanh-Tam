<?php
require_once 'config.php';
require_once 'helpers.php';

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
$products = $stmt->fetchAll();
$user = current_user();
?>
<!doctype html><html><head><meta charset="utf-8"><title>Shop - Danh sách sản phẩm</title></head><body>
<header>
  <h1>Shop</h1>
  <?php if ($user): ?>
    Xin chào <?=h($user['name'])?> | <a href="logout.php">Đăng xuất</a>
    <?php if ($user['is_admin']): ?> | <a href="admin_products.php">Admin</a><?php endif; ?>
  <?php else: ?>
    <a href="login.php">Đăng nhập</a> | <a href="register.php">Đăng ký</a>
  <?php endif; ?>
  | <a href="cart.php">Giỏ hàng (<?=array_sum(cart_items())?:0?>)</a>
</header>

<form method="get">
  <input name="q" value="<?=h($q)?>" placeholder="Tìm kiếm...">
  <button>Tìm</button>
</form>

<div style="display:flex;flex-wrap:wrap">
<?php foreach ($products as $p): ?>
  <div style="border:1px solid #ddd;padding:10px;margin:5px;width:220px">
    <img src="<?=h($p['image']?:SAMPLE_IMAGE)?>" alt="" style="max-width:200px;height:120px;object-fit:cover"><br>
    <strong><?=h($p['title'])?></strong><br>
    <small><?=number_format($p['price'], 2)?> VND</small><br>
    <a href="product.php?id=<?=h($p['id'])?>">Chi tiết</a> |
    <a href="cart_action.php?action=add&id=<?=h($p['id'])?>">Thêm vào giỏ</a>
  </div>
<?php endforeach; ?>
</div>
</body></html>
