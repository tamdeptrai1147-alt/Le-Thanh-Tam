<?php
// config.php
session_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'dragoncore');
define('DB_USER', 'root');
define('DB_PASS', ''); // <-- thay bằng mật khẩu DB của bạn

// Image path sample (ảnh bạn đã upload)
define('SAMPLE_IMAGE', '/mnt/data/14063df0-aaa3-43f8-9048-017ee16ddadf.png');

function db() {
    static $pdo;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
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
