<?php
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';
    $stmt = db()->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $u = $stmt->fetch();
    if ($u && password_verify($pass, $u['password'])) {
        $_SESSION['user_id'] = $u['id'];
        redirect('index.php');
    } else {
        $error = "Thông tin đăng nhập không chính xác.";
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Login</title></head><body>
<h2>Đăng nhập</h2>
<?php if (!empty($error)) echo "<p style='color:red'>" . h($error) . "</p>"; ?>
<form method="post">
  Email: <input name="email" type="email"><br>
  Mật khẩu: <input name="password" type="password"><br>
  <button>Đăng nhập</button>
</form>
<p><a href="register.php">Đăng ký</a></p>
</body></html>
