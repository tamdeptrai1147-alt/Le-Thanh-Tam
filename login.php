<?php
require_once 'config.php';
require_once 'helpers.php'; // Đảm bảo helpers có chứa hàm generate_csrf_token

$error = '';

// Nếu đã đăng nhập thì đá về trang chủ
if (is_logged_in()) {
    redirect('index.php');
}

// Xử lý khi nhấn nút Đăng nhập
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Kiểm tra CSRF Token (Chống hack form)
    $token = $_POST['csrf_token'] ?? '';
    check_csrf_token($token); // Hàm này nằm trong helpers.php

    // 2. Lấy dữ liệu
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // 3. Kiểm tra DB
    $stmt = db()->prepare("SELECT id, name, password, is_admin FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // 4. So khớp mật khẩu (Sử dụng password_verify cho an toàn)
    // Lưu ý: Mật khẩu trong DB phải được mã hóa bằng password_hash()
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        redirect('index.php');
    } else {
        $error = "Email hoặc mật khẩu không chính xác.";
    }
}

// Tạo Token mới cho form
$csrf_token = generate_csrf_token();
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Đăng nhập - DragonCore</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1><a href="index.php">DRAGONCORE</a></h1>
    </header>

    <div class="login-wrapper">
        <div class="login-card">
            <h2>Đăng nhập</h2>
            
            <?php if ($error): ?>
                <div class="error-msg">
                    <?= h($error) ?>
                </div>
            <?php endif; ?>

            <form method="post">
                <input type="hidden" name="csrf_token" value="<?= h($csrf_token) ?>">
                
                <div class="form-group">
                    <input type="text" name="email" class="custom-input" placeholder="Nhập Email" required>
                </div>
                
                <div class="form-group">
                    <input type="password" name="password" class="custom-input" placeholder="Nhập Mật khẩu" required>
                </div>
                
                <button type="submit" class="btn-submit">Đăng nhập</button>
            </form>

            <div class="auth-links">
                Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a>
            </div>
        </div>
    </div>

</body>
</html>