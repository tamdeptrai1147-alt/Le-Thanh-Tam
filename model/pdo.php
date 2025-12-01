<?php
// 1. Kết nối Database
function pdo_get_connection(){
    $dburl = "mysql:host=localhost;dbname=dragoncore;charset=utf8";
    $username = "root";
    $password = "";

    $conn = new PDO($dburl, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

// 2. Lấy danh sách nhiều dòng (Dùng cho trang chủ, danh sách sp)
function pdo_query($sql){
    $sql_args = array_slice(func_get_args(), 1);
    try{
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        return $stmt->fetchAll();
    }
    catch(PDOException $e){
        throw $e;
    }
    finally{
        unset($conn);
    }
}

// 3. Lấy 1 dòng (Dùng cho Đăng nhập, Chi tiết sp) <--- CÁI ÔNG ĐANG THIẾU
function pdo_query_one($sql){
    $sql_args = array_slice(func_get_args(), 1);
    try{
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e){
        throw $e;
    }
    finally{
        unset($conn);
    }
}

// 4. Thực thi lệnh Thêm/Sửa/Xóa (Dùng cho Đăng ký, Đặt hàng) <--- CÁI ÔNG ĐANG LỖI
function pdo_execute($sql){
    $sql_args = array_slice(func_get_args(), 1);
    try{
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
    }
    catch(PDOException $e){
        throw $e;
    }
    finally{
        unset($conn);
    }
}

// 5. Thực thi và lấy ID vừa thêm (Dùng cho Hóa đơn)
function pdo_execute_return_lastInsertId($sql){
    $sql_args = array_slice(func_get_args(), 1);
    try{
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        return $conn->lastInsertId();
    }
    catch(PDOException $e){
        throw $e;
    }
    finally{
        unset($conn);
    }
}
?>