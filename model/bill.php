<?php
// 1. Hàm tạo đơn hàng mới
function insert_bill($iduser, $name, $email, $address, $tel, $pttt, $ngaydathang, $total){
    $sql = "INSERT INTO bill(iduser, bill_name, bill_email, bill_address, bill_tel, bill_pttt, ngaydathang, total) VALUES ('$iduser', '$name', '$email', '$address', '$tel', '$pttt', '$ngaydathang', '$total')";
    return pdo_execute_return_lastInsertId($sql);
}

// 2. Hàm thêm chi tiết giỏ hàng
function insert_cart($iduser, $idpro, $img, $name, $price, $soluong, $thanhtien, $idbill){
    $sql = "INSERT INTO cart(iduser, idpro, img, name, price, soluong, thanhtien, idbill) VALUES ('$iduser', '$idpro', '$img', '$name', '$price', '$soluong', '$thanhtien', '$idbill')";
    pdo_execute($sql);
}

// 3. Hàm lấy danh sách đơn hàng theo ID User (CÁI ÔNG ĐANG THIẾU)
function loadall_bill($iduser){
    $sql = "SELECT * FROM bill WHERE iduser=".$iduser." ORDER BY id DESC";
    $listbill = pdo_query($sql);
    return $listbill;
}

// 4. Hàm lấy chi tiết đơn hàng (Dùng để xem chi tiết sau này)
function loadall_cart($idbill){
    $sql = "SELECT * FROM cart WHERE idbill=".$idbill;
    $bill = pdo_query($sql);
    return $bill;
}
// Hàm đếm số lượng mặt hàng trong 1 đơn hàng
function count_item_cart($idbill){
    $sql = "SELECT * FROM cart WHERE idbill=".$idbill;
    $bill = pdo_query($sql);
    return sizeof($bill); // Đếm số dòng trả về
}
?>