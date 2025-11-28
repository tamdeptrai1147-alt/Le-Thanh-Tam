<?php
require_once 'config.php';
require_once 'helpers.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = db()->prepare("SELECT id, name, password, is_admin FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && $password === '123') { // Mật khẩu demo: 123
        $_SESSION['user_id'] = $user['id'];
        redirect('index.php');
    } else {
        $error = "Sai email hoặc mật khẩu. (Mật khẩu demo: 123)";
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Đăng nhập</title>
<link rel="stylesheet" href="style.css">
</head><body>
<header><h1><a href="index.php">Shop</a></h1></header>
<div class="container" style="text-align:center; max-width: 400px; margin-top: 50px; background-color: var(--card-bg); padding: 20px; border-radius: 8px;">
  <h2>Đăng nhập</h2>
  <?php if ($error): ?><p style="color:var(--primary-color); font-weight: bold;"><?=h($error)?></p><?php endif; ?>
  <form method="post">
    <p><input name="email" type="text" placeholder="Email" required style="max-width: 100%;"></p>
    <p><input name="password" type="password" placeholder="Mật khẩu" required style="max-width: 100%;"></p>
    <button type="submit">Đăng nhập</button>
  </form>
  <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
</div>
</body></html>