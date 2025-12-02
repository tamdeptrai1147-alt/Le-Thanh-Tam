<?php
require_once 'config.php';
require_once 'helpers.php';

$error = '';
$success = '';

if (is_logged_in()) {
    redirect('index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validate đơn giản
    if (empty($name) || empty($email) || empty($password)) {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } elseif ($password !== $confirm_password) {
        $error = "Mật khẩu xác nhận không khớp.";
    } else {
        // Kiểm tra email tồn tại
        $stmt = db()->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = "Email này đã được sử dụng.";
        } else {
            // Tạo tài khoản mới
            // Lưu ý: Trong thực tế nên dùng password_hash() để mã hóa mật khẩu
            // Ở đây mình làm đơn giản theo database của bạn (nếu bạn chưa hash)
            // Nếu muốn bảo mật: $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
            $stmt = db()->prepare("INSERT INTO users (name, email, password, is_admin) VALUES (?, ?, ?, 0)");
            if ($stmt->execute([$name, $email, $password])) { // Thay $password bằng $hashed_pass nếu dùng hash
                $success = "Đăng ký thành công! <a href='login.php'>Đăng nhập ngay</a>";
            } else {
                $error = "Có lỗi xảy ra, vui lòng thử lại.";
            }
        }
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Đăng ký - DragonCore</title>
    <link rel="stylesheet" href="style.css?v=3">
</head>
<body>

<header>
    <div class="header-container">
        <a href="index.php" class="logo">dragoncore</a>
        <div class="user-nav">
            <a href="index.php">Trang chủ</a>
            <a href="login.php">Đăng nhập</a>
        </div>
    </div>
</header>

<div class="auth-wrapper">
    <div class="auth-card">
        <h2>Đăng Ký</h2>
        
        <?php if ($error): ?>
            <p style="color: #ff4d4d; background: rgba(255,0,0,0.1); padding: 10px; border-radius: 4px;"><?=h($error)?></p>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <p style="color: #4dff4d; background: rgba(0,255,0,0.1); padding: 10px; border-radius: 4px;"><?= $success ?></p>
        <?php else: ?>

        <form method="post">
            <div class="form-group">
                <label>Họ và Tên</label>
                <input type="text" name="name" class="form-input" placeholder="Nhập tên của bạn" required>
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-input" placeholder="example@email.com" required>
            </div>
            
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="form-input" placeholder="Nhập mật khẩu" required>
            </div>

            <div class="form-group">
                <label>Xác nhận mật khẩu</label>
                <input type="password" name="confirm_password" class="form-input" placeholder="Nhập lại mật khẩu" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 16px; text-transform: uppercase;">Tạo tài khoản</button>
        </form>
        
        <?php endif; ?>

        <div class="auth-footer">
            Đã có tài khoản? <a href="login.php">Đăng nhập</a>
        </div>
    </div>
</div>

</body>
</html>