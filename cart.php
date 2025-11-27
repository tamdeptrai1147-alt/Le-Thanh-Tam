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
?>
<!doctype html><html><head><meta charset="utf-8"><title>Giỏ hàng</title></head><body>
<h2>Giỏ hàng</h2>
<form method="post" action="cart_action.php?action=update">
<table border="1" cellpadding="6">
<tr><th>Sản phẩm</th><th>SL</th><th>Giá</th><th>Thành tiền</th><th></th></tr>
<?php foreach ($items as $it): ?>
<tr>
  <td><?=h($it['product']['title'])?></td>
  <td><input type="number" name="qty[<?=h($it['product']['id'])?>]" value="<?=h($it['qty'])?>" min="0" style="width:60px"></td>
  <td><?=number_format($it['product']['price'],2)?></td>
  <td><?=number_format($it['sub'],2)?></td>
  <td><a href="cart_action.php?action=remove&id=<?=h($it['product']['id'])?>">Xóa</a></td>
</tr>
<?php endforeach; ?>
</table>
<button type="submit">Cập nhật</button>
</form>
<p>Tổng: <?=number_format($total,2)?> VND</p>
<a href="checkout.php">Thanh toán</a> | <a href="index.php">Tiếp tục mua</a>
</body></html>
