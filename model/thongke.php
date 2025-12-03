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
    $sql = "SELECT count(*) FROM users WHERE role = 0"; // Chỉ đếm khách hàng, không đếm admin
    $row = pdo_query_one($sql);
    return $row['count(*)'];
}

// 4. TÍNH TỔNG DOANH THU (Quan trọng)
function sum_doanhthu(){
    /* Lưu ý: Thường chỉ tính doanh thu các đơn ĐÃ GIAO THÀNH CÔNG.
       Trong Database của bạn chưa quy định rõ số nào là thành công.
       Giả sử: 
       0: Đơn mới
       1: Đang giao
       3: Giao thành công (Đã thu tiền)
    */
    
    // Câu lệnh này sẽ tính tổng cột 'total' của những đơn có trạng thái = 3
    $sql = "SELECT SUM(total) FROM bill WHERE bill_status = 3";
    
    // Nếu bạn muốn test hiển thị số tiền ngay bây giờ (dù đơn chưa giao), 
    // hãy dùng dòng dưới này (bỏ comment):
    // $sql = "SELECT SUM(total) FROM bill"; 

    $row = pdo_query_one($sql);
    return $row['SUM(total)'];
}
?>