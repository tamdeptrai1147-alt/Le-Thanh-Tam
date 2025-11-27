<?php
require_once 'config.php';
require_once 'helpers.php';
$user = current_user();
if (!$user || !$user['is_admin']) {
    http_response_code(403); echo "Chỉ admin."; exit;
}

$pdo = db();
$action = $_GET['action'] ?? '';
if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title']; $desc = $_POST['description']; $price = floatval($_POST['price']); $stock = intval($_POST['stock']);
    $image = $_POST['image'] ?: SAMPLE_IMAGE;
    $stmt = $pdo->prepare("INSERT INTO products (title, description, price, image, stock) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $desc, $price, $image, $stock]);
    redirect('admin_products.php');
}
if ($action === 'delete') {
    $id = intval($_GET['id'] ?? 0);
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
    redirect('admin_products.php');
}
if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $stmt = $pdo->prepare("UPDATE products SET title=?, description=?, price=?, image=?, stock=? WHERE id=?");
    $stmt->execute([$_POST['title'], $_POST['description'], floatval($_POST['price']), $_POST['image']?:SAMPLE_IMAGE, intval($_POST['stock']), $id]);
    redirect('admin_products.php');
}

$products = $pdo->query("SELECT * FROM products ORDER BY id DESC")->fetchAll();
?>
<!doctype html><html><head><meta charset="utf-8"><title>Admin - Products</title></head><body>
<h2>Quản lý sản phẩm</h2>
<a href="index.php">Về trang chính</a>
<h3>Thêm mới</h3>
<form method="post" action="admin_products.php?action=create">
Title: <input name="title"><br>
Price: <input name="price" type="number" step="0.01"><br>
Stock: <input name="stock" type="number" value="10"><br>
Image URL (hoặc để trống): <input name="image" value="<?=SAMPLE_IMAGE?>"><br>
Description: <br><textarea name="description"></textarea><br>
<button>Thêm</button>
</form>

<h3>Danh sách</h3>
<table border="1">
<tr><th>#</th><th>Title</th><th>Price</th><th>Stock</th><th>Hành động</th></tr>
<?php foreach ($products as $p): ?>
<tr>
  <td><?=h($p['id'])?></td>
  <td><?=h($p['title'])?></td>
  <td><?=number_format($p['price'],2)?></td>
  <td><?=h($p['stock'])?></td>
  <td>
    <form method="post" action="admin_products.php?action=edit" style="display:inline">
      <input type="hidden" name="id" value="<?=h($p['id'])?>">
      <input name="title" value="<?=h($p['title'])?>">
      <input name="price" value="<?=h($p['price'])?>">
      <input name="stock" value="<?=h($p['stock'])?>">
      <input name="image" value="<?=h($p['image'])?>">
      <button>Sửa</button>
    </form>
    <a href="admin_products.php?action=delete&id=<?=h($p['id'])?>" onclick="return confirm('Xóa?')">Xóa</a>
  </td>
</tr>
<?php endforeach; ?>
</table>
</body></html>
