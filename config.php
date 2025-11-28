<?php
// config.php
session_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'dragoncore'); // <-- ĐÃ SỬA LẠI THÀNH 'dragoncore'
define('DB_USER', 'root');
define('DB_PASS', ''); // <-- THAY BẰNG MẬT KHẨU DB CỦA BẠN (Nếu không có mật khẩu thì giữ nguyên '')

// Image path sample (Sử dụng placeholder để đảm bảo ảnh sản phẩm hiển thị)
define('SAMPLE_IMAGE', 'https://via.placeholder.com/200x150/1f1f1f/cc0000?text=NO+IMAGE');

function db() {
    static $pdo;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        // Thử kết nối, nếu lỗi sẽ ném ra PDOException
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    }
    return $pdo;
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function current_user() {
    if (!is_logged_in()) return null;
    $stmt = db()->prepare("SELECT id, name, email, is_admin FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}
?>