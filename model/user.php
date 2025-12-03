<?php
// model/user.php

// Hàm thêm tài khoản mới
function insert_user($user, $pass, $email, $address, $tel){
    // Dùng dấu ? để thay thế cho biến, an toàn tuyệt đối
    $sql = "INSERT INTO users(user, pass, email, address, tel) VALUES (?, ?, ?, ?, ?)";
    pdo_execute($sql, $user, $pass, $email, $address, $tel);
}

// Hàm kiểm tra đăng nhập
function check_user($user, $pass){
    $sql = "SELECT * FROM users WHERE user=? AND pass=?";
    $sp = pdo_query_one($sql, $user, $pass);
    return $sp;
}

// Hàm cập nhật tài khoản
function update_user($id, $user, $pass, $email, $address, $tel){
    $sql = "UPDATE users SET user=?, pass=?, email=?, address=?, tel=? WHERE id=?";
    pdo_execute($sql, $user, $pass, $email, $address, $tel, $id);
}
?>