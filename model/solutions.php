<?php
// Lấy danh sách tất cả giải pháp ra trang chủ giải pháp
function loadall_solutions(){
    $sql = "SELECT * FROM solutions ORDER BY id ASC";
    return pdo_query($sql);
}

// Lấy chi tiết 1 bài giải pháp để xem
function loadone_solution($id){
    $sql = "SELECT * FROM solutions WHERE id=".$id;
    return pdo_query_one($sql);
}
?>