<?php
// 1. Lấy tất cả sản phẩm (Có sắp xếp mới nhất, và JOIN để lấy tên danh mục nếu cần)
function loadall_sanpham($kyw="", $iddm=0){
    $sql = "SELECT * FROM products WHERE 1"; // WHERE 1 tức là luôn đúng
    if($kyw != ""){
        $sql .= " AND name LIKE '%".$kyw."%'";
    }
    if($iddm > 0){
        $sql .= " AND category_id = '".$iddm."'";
    }
    $sql .= " ORDER BY id DESC";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}

// 2. Thêm sản phẩm mới
function insert_sanpham($tensp, $giasp, $hinh, $mota, $iddm){
    $sql = "INSERT INTO products(name, price, img, description, category_id) VALUES('$tensp', '$giasp', '$hinh', '$mota', '$iddm')";
    pdo_execute($sql);
}

// 3. Xóa sản phẩm
function delete_sanpham($id){
    $sql = "DELETE FROM products WHERE id=".$id;
    pdo_execute($sql);
}

// 4. Lấy 1 sản phẩm để sửa
function loadone_sanpham($id){
    $sql = "SELECT * FROM products WHERE id=".$id;
    $sp = pdo_query_one($sql);
    return $sp;
}

// 5. Cập nhật sản phẩm
function update_sanpham($id, $tensp, $giasp, $hinh, $mota, $iddm){
    if($hinh != "")
        $sql = "UPDATE products SET name='".$tensp."', price='".$giasp."', img='".$hinh."', description='".$mota."', category_id='".$iddm."' WHERE id=".$id;
    else
        $sql = "UPDATE products SET name='".$tensp."', price='".$giasp."', description='".$mota."', category_id='".$iddm."' WHERE id=".$id;
    pdo_execute($sql);
}

// Giữ lại các hàm cũ cho trang chủ (loadall_product_home...)
function loadall_product_home(){
    $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 0,9"; 
    $listproduct = pdo_query($sql);
    return $listproduct;
}
// Hàm tăng số lượt xem lên 1
function tang_luotxem($id){
    $sql = "UPDATE products SET view = view + 1 WHERE id=".$id;
    pdo_execute($sql);
}
?>