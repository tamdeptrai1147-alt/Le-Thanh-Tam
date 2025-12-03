<?php
// ===================================================
// PHẦN DÀNH CHO KHÁCH HÀNG (CLIENT)
// ===================================================

// Đăng ký tài khoản mới
function insert_user($user, $pass, $email, $address, $tel){
    $sql = "INSERT INTO users(user, pass, email, address, tel) 
            VALUES ('$user', '$pass', '$email', '$address', '$tel')";
    pdo_execute($sql); 
}

// Kiểm tra đăng nhập
function check_user($user, $pass){
    $sql = "SELECT * FROM users WHERE user='".$user."' AND pass='".$pass."'";
    $sp = pdo_query_one($sql); 
    return $sp; 
}

// Cập nhật thông tin cá nhân
function update_user($id, $user, $pass, $email, $address, $tel){
    $sql = "UPDATE users SET user='".$user."', pass='".$pass."', email='".$email."', address='".$address."', tel='".$tel."' WHERE id=".$id;
    pdo_execute($sql);
}

// ===================================================
// PHẦN DÀNH CHO ADMIN (QUẢN TRỊ VIÊN)
// ===================================================

// 1. Lấy danh sách tất cả tài khoản
function loadall_taikhoan(){
    $sql = "SELECT * FROM users ORDER BY id DESC";
    $listtaikhoan = pdo_query($sql);
    return $listtaikhoan;
}

// 2. Xóa tài khoản
function delete_taikhoan($id){
    $sql = "DELETE FROM users WHERE id=".$id;
    pdo_execute($sql);
}

// 3. Cập nhật vai trò (Nâng lên Admin hoặc hạ xuống Khách)
function update_role($id, $role){
    $sql = "UPDATE users SET role='".$role."' WHERE id=".$id;
    pdo_execute($sql);
}

// 4. Lấy thông tin 1 tài khoản (nếu cần dùng)
function loadone_taikhoan($id){
    $sql = "SELECT * FROM users WHERE id=".$id;
    $tk = pdo_query_one($sql);
    return $tk;
}
?>