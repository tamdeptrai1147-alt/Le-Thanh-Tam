<?php
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';

    if ($name === '' || $email === '' || $pass === '') {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } else {
        $stmt = db()->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = "Email đã được sử dụng.";
        } else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $stmt = db()->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $hash]);
            $_SESSION['user_id'] = db()->lastInsertId();
            redirect('index.php');
        }
    }
}
?>
<!-- HTML -->
<!doctype html>
<html><head><meta charset="utf-8"><title>Register</title></head><body>
<h2>Đăng ký</h2>
<?php if (!empty($error)) echo "<p style='color:red'>" . h($error) . "</p>"; ?>
<form method="post">
  Tên: <input name="name"><br>
  Email: <input name="email" type="email"><br>
  Mật khẩu: <input name="password" type="password"><br>
  <button>Đăng ký</button>
</form>
<p><a href="login.php">Đăng nhập</a></p>
</body></html>
