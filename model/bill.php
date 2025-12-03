<?php
// =================================================================
// PHẦN DÀNH CHO KHÁCH HÀNG (CLIENT)
// =================================================================

function insert_bill($iduser, $name, $email, $address, $tel, $pttt, $ngaydathang, $total){
    $sql = "INSERT INTO bill(iduser, bill_name, bill_email, bill_address, bill_tel, bill_pttt, ngaydathang, total) VALUES ('$iduser', '$name', '$email', '$address', '$tel', '$pttt', '$ngaydathang', '$total')";
    return pdo_execute_return_lastInsertId($sql);
}

function insert_cart($iduser, $idpro, $img, $name, $price, $soluong, $thanhtien, $idbill){
    $sql = "INSERT INTO cart(iduser, idpro, img, name, price, soluong, thanhtien, idbill) VALUES ('$iduser', '$idpro', '$img', '$name', '$price', '$soluong', '$thanhtien', '$idbill')";
    pdo_execute($sql);
}

function loadall_bill($iduser){
    $sql = "SELECT * FROM bill WHERE iduser=".$iduser." ORDER BY id DESC";
    $listbill = pdo_query($sql);
    return $listbill;
}

function loadall_cart($idbill){
    $sql = "SELECT * FROM cart WHERE idbill=".$idbill;
    $bill = pdo_query($sql);
    return $bill;
}

function count_item_cart($idbill){
    $sql = "SELECT * FROM cart WHERE idbill=".$idbill;
    $bill = pdo_query($sql);
    return sizeof($bill);
}

// =================================================================
// PHẦN DÀNH CHO ADMIN (QUẢN LÝ ĐƠN HÀNG)
// =================================================================

// 1. Lấy danh sách đơn hàng (Có tìm kiếm theo mã đơn)
function loadall_bill_admin($kyw="", $iduser=0){
    $sql = "SELECT * FROM bill WHERE 1";
    if($iduser > 0) $sql .= " AND iduser=".$iduser;
    if($kyw != "") $sql .= " AND id LIKE '%".$kyw."%'";
    $sql .= " ORDER BY id DESC";
    $listbill = pdo_query($sql);
    return $listbill;
}

// 2. Lấy 1 đơn hàng để xem chi tiết hoặc sửa
function loadone_bill($id){
    $sql = "SELECT * FROM bill WHERE id=".$id;
    $bill = pdo_query_one($sql);
    return $bill;
}

// 3. Cập nhật trạng thái đơn hàng
function update_bill($id, $ttdh){
    $sql = "UPDATE bill SET bill_status='".$ttdh."' WHERE id=".$id;
    pdo_execute($sql);
}

// 4. Xóa đơn hàng
function delete_bill($id){
    $sql = "DELETE FROM bill WHERE id=".$id;
    pdo_execute($sql);
}

// 5. Hàm hiển thị trạng thái dạng chữ (cho dễ đọc)
function get_ttdh($n){
    switch ($n) {
        case '0': return "Đơn hàng mới"; break;
        case '1': return "Đang xử lý"; break;
        case '2': return "Đang giao hàng"; break;
        case '3': return "Đã giao hàng"; break;
        default: return "Đơn hàng mới"; break;
    }
}

// Hàm load 5 đơn mới nhất cho Dashboard (nếu bạn dùng bên admin/home.php)
function loadall_bill_home(){
    $sql = "SELECT * FROM bill ORDER BY id DESC LIMIT 0,5";
    $listbill = pdo_query($sql);
    return $listbill;
}
?>