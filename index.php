<?php
    include "model/pdo.php";
    include "model/product.php";
    include "view/header.php";

    $spnew = loadall_product_home(); // Lấy dữ liệu

    if(isset($_GET['act'])){
        $act = $_GET['act'];
        switch ($act) {
            case 'about':
                // include "view/about.php";
                break;
            default:
                include "view/home.php";
                break;
        }
    }else{
        include "view/home.php";
    }

    include "view/footer.php";
?>a