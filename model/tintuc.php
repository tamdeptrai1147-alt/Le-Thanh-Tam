<?php
function loadall_tintuc(){
    $sql = "select * from tintuc order by id desc";
    return pdo_query($sql); // Hàm pdo_query này nằm trong file pdo.php bạn đã có
}
?>
