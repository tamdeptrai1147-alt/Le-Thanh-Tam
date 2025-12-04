<?php
function loadall_tintuc(){
    $sql = "select * from tintuc order by id desc";
    return pdo_query($sql); // Hàm pdo_query này nằm trong file pdo.php bạn đã có
}
function loadone_tintuc($id){
    $sql = "SELECT * FROM tintuc WHERE id=".$id;
    $tt = pdo_query_one($sql); // Gọi hàm lấy 1 dòng trong pdo.php
    return $tt;
}
?>