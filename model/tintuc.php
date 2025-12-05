<?php
function loadall_tintuc(){
    $sql = "select * from tintuc order by id desc";
    return pdo_query($sql); // Hàm pdo_query này nằm trong file pdo.php bạn đã có
}
// Lấy chi tiết 1 tin tức theo ID
function loadone_tintuc($id){
    $sql = "SELECT * FROM tintuc WHERE id=".$id;
    $sp = pdo_query_one($sql);
    return $sp;
}
?>
