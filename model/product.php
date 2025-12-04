<?php
// 1. Hàm lấy tất cả sản phẩm (Sửa lỗi loadall_product_home)
function loadall_product($keyword="", $iddm=0){ 
    $sql = "SELECT * FROM products WHERE 1"; 
    
    if($iddm > 0){
        $sql .= " AND iddm = ".$iddm; 
    }
    
    if($keyword != ""){
        $sql .= " AND name LIKE '%".$keyword."%'";
    }

    $sql .= " ORDER BY id DESC";

    $listproduct = pdo_query($sql);
    return $listproduct;
}

// 2. Hàm lấy chi tiết 1 sản phẩm
function loadone_product($id){
    $sql = "SELECT * FROM products WHERE id=".$id;
    $sp = pdo_query_one($sql); 
    return $sp;
}

// 3. Hàm lấy các sản phẩm cùng loại
function load_product_cungloai($id, $iddm){
    $sql = "SELECT * FROM products WHERE iddm=".$iddm." AND id <> ".$id;
    $listproduct = pdo_query($sql);
    return $listproduct;
}

// 4. Hàm loadall_product_by_ids (Sửa lỗi undefined function)
function loadall_product_by_ids($id_array){
    if (empty($id_array)) {
        return [];
    }
    $id_list = implode(",", $id_array); 
    $sql = "SELECT * FROM products WHERE id IN ($id_list) ORDER BY FIELD(id, $id_list)";
    $listproduct = pdo_query($sql);
    return $listproduct;
}
?>