<?php
require_once 'config.php';
require_once 'helpers.php';

if (!is_logged_in()) {
    // yêu cầu đăng nhập trước khi thanh toán
    redirect('login.php');
}

$cart = cart_items();
if (!$cart) {
    echo "Giỏ hàng rỗng. <a href='index.php'>Quay lại</a>"; exit;
}

// tính tổng
$ids = array_keys($cart);
$placeholders = implode(',', array_fill(0, count($ids), '?'));
$stmt = db()->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
$stmt->execute($ids);
$prods = $stmt->fetchAll(PDO::FETCH_UNIQUE);
$total = 0;
foreach ($cart as $pid => $q) {
    if (isset($prods[$pid])) $total += $prods[$pid]['price'] * $q;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // tạo đơn
    $pdo = db();
    $pdo->beginTransaction();
    try {
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, total, status) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $total, 'paid']);
        $order_id = $pdo->lastInsertId();

        $stmtItem = $pdo->prepare("INSERT INTO order_items (order_id, product_id, qty, price) VALUES (?, ?, ?, ?)");
        foreach ($cart as $pid => $q) {
            $price = $prods[$pid]['price'];
            $stmtItem->execute([$order_id, $pid, $q, $price]);
            // giảm stock (đơn giản)
            $stmtUp = $pdo->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
            $stmtUp->execute([$q, $pid]);
        }
        $pdo->commit();
        // xóa cart
        unset($_SESSION['cart']);
        echo "Thanh toán thành công. Mã đơn: $order_id. <a href='index.php'>Về trang chính</a>";
        exit;
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Lỗi: " . h($e->getMessage());
        exit;
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Checkout</title></head><body>
<h2>Thanh toán</h2>
<p>Tổng tiền: <?=number_format($total,2)?> VND</p>
<form method="post">
  <!-- Ở đây bạn có thể thêm form địa chỉ, phương thức thanh toán... -->
  <button>Thanh toán (mô phỏng)</button>
</form>
</body></html>
