<?php
require_once 'config.php';
require_once 'helpers.php';

$cart = cart_items();
$items = [];
$total = 0.0;
if ($cart) {
    $ids = array_keys($cart);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = db()->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($ids);
    $prods = $stmt->fetchAll(PDO::FETCH_UNIQUE);
    foreach ($cart as $pid => $qty) {
        if (isset($prods[$pid])) {
            $row = $prods[$pid];
            $sub = $row['price'] * $qty;
            $total += $sub;
            $items[] = ['product' => $row, 'qty' => $qty, 'sub' => $sub];
        }
    }
}
$user = current_user();
?>
<!doctype html><html><head><meta charset="utf-8"><title>Giỏ hàng</title>
<link rel="stylesheet" href="style.css">
</head><body>
<header>
  <h1><a href="index.php">Shop</a></h1>
  <div class="user-links">
    <?php if ($user): ?>
      Xin chào **<?=h($user['name'])?>** | <a href="logout.php">Đăng xuất</a>
    <?php else: ?>
      <a href="login.php">Đăng nhập</a> | <a href="register.php">Đăng ký</a>
    <?php endif; ?>
  </div>
</header>

<div class="container">
<h2>Giỏ hàng</h2>
<?php if (!$items): ?>
  <p>Giỏ hàng của bạn đang trống. <a href="index.php">Tiếp tục mua sắm</a>.</p>
<?php else: ?>
<form method="post" action="cart_action.php?action=update">
<table class="data-table">
<tr><th>Sản phẩm</th><th>SL</th><th>Giá</th><th>Thành tiền</th><th></th></tr>
<?php foreach ($items as $it): ?>
<tr>
  <td><?=h($it['product']['title'])?></td>
  <td><input type="number" name="qty[<?=h($it['product']['id'])?>]" value="<?=h($it['qty'])?>" min="0" style="width:60px"></td>
  <td><?=number_format($it['product']['price'], 2)?> VND</td>
  <td><?=number_format($it['sub'], 2)?> VND</td>
  <td>
    <a href="cart_action.php?action=remove&id=<?=h($it['product']['id'])?>">Xóa</a>
  </td>
</tr>
<?php endforeach; ?>
<tr class="total-row"><td colspan="3">Tổng cộng</td><td><?=number_format($total, 2)?> VND</td><td></td></tr>
</table>
<div style="text-align:right; margin-top: 15px;">
  <button type="submit">Cập nhật Giỏ hàng</button>
</div>
</form>

<div style="text-align:right; margin-top: 30px;">
  <a href="checkout.php"><button>Tiến hành Thanh toán</button></a>
</div>

<?php endif; ?>
</div>
</body></html>