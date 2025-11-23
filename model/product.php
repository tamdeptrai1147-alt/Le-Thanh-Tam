<?php
function loadall_product_home(){
    $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 9";
    $listproduct = pdo_query($sql);
    return $listproduct;
}
?>