<?php
// api.php - endpoint đơn giản
require_once 'config.php';
header('Content-Type: application/json; charset=utf-8');

$action = $_GET['action'] ?? 'products';

if ($action === 'products') {
    $q = trim($_GET['q'] ?? '');
    if ($q !== '') {
        $stmt = db()->prepare("SELECT id, title, price, image FROM products WHERE title LIKE ? OR description LIKE ? LIMIT 50");
        $stmt->execute(["%$q%", "%$q%"]);
    } else {
        $stmt = db()->query("SELECT id, title, price, image FROM products ORDER BY created_at DESC LIMIT 100");
    }
    $rows = $stmt->fetchAll();
    echo json_encode(['success' => true, 'data' => $rows], JSON_UNESCAPED_UNICODE);
    exit;
}
echo json_encode(['success' => false, 'message' => 'Invalid action']);
