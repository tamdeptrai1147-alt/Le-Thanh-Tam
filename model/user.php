<?php
// Hàm thêm tài khoản người dùng mới (Dùng cho Đăng ký)
function insert_user($user, $pass, $email, $address, $tel){
    $sql = "INSERT INTO users(user, pass, email, address, tel) 
            VALUES ('$user', '$pass', '$email', '$address', '$tel')";
    pdo_execute($sql); // pdo_execute là hàm thực thi lệnh (INSERT, UPDATE) mà bạn đã tạo trong pdo.php
}
function check_user($user, $pass){
    // Tìm 1 dòng user khớp với Tên đăng nhập VÀ Mật khẩu
    $sql = "SELECT * FROM users WHERE user='".$user."' AND pass='".$pass."'";
    // Hàm pdo_query_one() là hàm đã thêm ở bước sửa lỗi trước đó
    $sp = pdo_query_one($sql); 
    return $sp; // Trả về thông tin user (là 1 mảng) nếu khớp, hoặc false nếu không khớp
}

// Hàm cập nhật thông tin (sẽ dùng cho chức năng Quên mật khẩu/Cập nhật profile)
function update_user($id, $user, $pass, $email, $address, $tel){
    $sql = "UPDATE users SET user='".$user."', pass='".$pass."', email='".$email."', address='".$address."', tel='".$tel."' WHERE id=".$id;
    pdo_execute($sql);
}
?>