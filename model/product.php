<?php
// 1. Hàm lấy tất cả sản phẩm cho trang chủ
function loadall_product_home(){
    $sql = "SELECT * FROM products ORDER BY id DESC";
    $listproduct = pdo_query($sql);
    return $listproduct;
}

// 2. Hàm lấy chi tiết 1 sản phẩm (CÁI BẠN ĐANG THIẾU)
function loadone_product($id){
    $sql = "SELECT * FROM products WHERE id=".$id;
    $sp = pdo_query_one($sql); // Gọi hàm lấy 1 dòng trong pdo.php
    return $sp;
}

// 3. Hàm lấy các sản phẩm cùng loại
function load_product_cungloai($id, $iddm){
    $sql = "SELECT * FROM products WHERE iddm=".$iddm." AND id <> ".$id;
    $listproduct = pdo_query($sql);
    return $listproduct;
}
?>