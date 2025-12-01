<?php
require_once 'config.php';

// Hàm chuyển hướng
function redirect($url) {
    header("Location: $url");
    exit;
}

// Hàm chống XSS (bảo mật hiển thị)
function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

// Các hàm giỏ hàng
function add_to_cart($product_id, $qty = 1) {
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $qty;
    } else {
        $_SESSION['cart'][$product_id] = $qty;
    }
}

function remove_from_cart($product_id) {
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

function cart_items() {
    return $_SESSION['cart'] ?? [];
}

// --- CÁC HÀM BẢO MẬT (QUAN TRỌNG) ---

function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function check_csrf_token($token) {
    if (empty($token) || $token !== ($_SESSION['csrf_token'] ?? null)) {
        die("Lỗi bảo mật: CSRF Token không hợp lệ! Vui lòng tải lại trang.");
    }
}
?>  