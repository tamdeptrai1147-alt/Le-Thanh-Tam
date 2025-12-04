<?php
// 1. Thống kê số lượng sản phẩm
function count_sanpham(){
    $sql = "SELECT count(*) FROM products";
    $row = pdo_query_one($sql);
    return $row['count(*)'];
}

// 2. Thống kê số đơn hàng mới (Ví dụ status = 0 là chờ xác nhận)
function count_donhang(){
    $sql = "SELECT count(*) FROM bill WHERE bill_status = 0"; 
    $row = pdo_query_one($sql);
    return $row['count(*)'];
}

// 3. Thống kê số lượng khách hàng
function count_taikhoan(){
    $sql = "SELECT count(*) FROM users WHERE role = 0"; // Chỉ đếm khách hàng
    $row = pdo_query_one($sql);
    return $row['count(*)'];
}

// 4. TÍNH TỔNG DOANH THU
function sum_doanhthu(){
    // Tính tổng tất cả các đơn hàng (Bỏ điều kiện WHERE để test hiển thị số tiền trước)
    // Sau này muốn chính xác chỉ đơn thành công thì sửa lại: WHERE bill_status = 3
    $sql = "SELECT SUM(total) FROM bill";
    
    $row = pdo_query_one($sql);
    
    // Nếu chưa có đơn nào thì trả về 0 để tránh lỗi
    if($row['SUM(total)'] == null) return 0;
    
    return $row['SUM(total)'];
}
?>