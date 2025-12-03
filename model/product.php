<?php
// Xóa chữ LIMIT 9 đi, hoặc sửa thành LIMIT 50 nếu muốn hiện 50 cái
function loadall_product_home(){
    $sql = "SELECT * FROM products ORDER BY id DESC"; // Bỏ LIMIT là nó hiện tất tần tật
    $listproduct = pdo_query($sql);
    return $listproduct;
}

function loadone_product($id){
    $sql = "SELECT * FROM products WHERE id = ?";
    $product = pdo_query_one($sql, $id);
    return $product;
}
?>