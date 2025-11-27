<?php
require_once 'config.php';
require_once 'helpers.php';
$id = intval($_GET['id'] ?? 0);
$stmt = db()->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$p = $stmt->fetch();
if (!$p) {
    http_response_code(404);
    echo "Không tìm thấy sản phẩm"; exit;
}
?>
<!doctype html><html><head><meta charset="utf-8"><title><?=h($p['title'])?></title></head><body>
<h2><?=h($p['title'])?></h2>
<img src="<?=h($p['image']?:SAMPLE_IMAGE)?>" style="max-width:400px"><br>
<p><?=nl2br(h($p['description']))?></p>
<p>Giá: <?=number_format($p['price'],2)?> VND</p>
<p>Kho: <?=h($p['stock'])?></p>
<a href="cart_action.php?action=add&id=<?=h($p['id'])?>">Thêm vào giỏ</a>
<br><a href="index.php">Quay lại</a>
</body></html>
