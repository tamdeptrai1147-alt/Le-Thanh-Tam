<?php
require_once 'config.php';
require_once 'helpers.php';

$action = $_GET['action'] ?? '';
$id = intval($_GET['id'] ?? 0);

if ($action === 'add' && $id) {
    add_to_cart($id, 1);
}
if ($action === 'remove' && $id) {
    remove_from_cart($id);
}
if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['qty'] as $pid => $q) {
        $pid = intval($pid);
        $q = max(0, intval($q));
        if ($q > 0) {
            $_SESSION['cart'][$pid] = $q;
        } else {
            unset($_SESSION['cart'][$pid]);
        }
    }
}
redirect('cart.php');
