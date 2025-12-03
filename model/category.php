<?php
function loadall_category(){
    $sql = "SELECT * FROM categories ORDER BY id ASC";
    $listdanhmuc = pdo_query($sql);
    return $listdanhmuc;
}
?>