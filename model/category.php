<?php
function insert_danhmuc($tenloai){
    $sql = "INSERT INTO categories(name) VALUES('$tenloai')";
    pdo_execute($sql);
}

function delete_danhmuc($id){
    $sql = "DELETE FROM categories WHERE id=".$id;
    pdo_execute($sql);
}

function loadall_category(){
    $sql = "SELECT * FROM categories ORDER BY id ASC";
    $listdanhmuc = pdo_query($sql);
    return $listdanhmuc;
}

function loadone_danhmuc($id){
    $sql = "SELECT * FROM categories WHERE id=".$id;
    $dm = pdo_query_one($sql);
    return $dm;
}

function update_danhmuc($id, $tenloai){
    $sql = "UPDATE categories SET name='".$tenloai."' WHERE id=".$id;
    pdo_execute($sql);
}
// Hàm cập nhật trạng thái ẩn/hiện cho danh mục
function update_status_dm($id, $status){
    $sql = "UPDATE categories SET status = '".$status."' WHERE id = ".$id;
    pdo_execute($sql);
}
?>