<?php
require_once 'config.php';
require_once 'helpers.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = db()->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $error = "Email đã được sử dụng.";
    } else {
        $stmt = db()->prepare("INSERT INTO users (name, email, password, is_admin) VALUES (?, ?, ?, 0)");
        $stmt->execute([$name, $email, $password]);
        redirect('login.php');
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Đăng ký</title>
<link rel="stylesheet" href="style.css">
</head><body>
<header><h1><a href="index.php">Shop</a></h1></header>
<div class="container" style="text-align:center; max-width: 400px; margin-top: 50px; background-color: var(--card-bg); padding: 20px; border-radius: 8px;">
  <h2>Đăng ký tài khoản</h2>
  <?php if ($error): ?><p style="color:var(--primary-color); font-weight: bold;"><?=h($error)?></p><?php endif; ?>
  <form method="post">
    <p><input name="name" type="text" placeholder="Tên của bạn" required style="max-width: 100%;"></p>
    <p><input name="email" type="email" placeholder="Email" required style="max-width: 100%;"></p>
    <p><input name="password" type="password" placeholder="Mật khẩu" required style="max-width: 100%;"></p>
    <button type="submit">Đăng ký</button>
  </form>
  <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
</div>
</body></html>