<?php
    session_start();
    // Kiểm tra giỏ hàng
    if(!isset($_SESSION['mycart'])) $_SESSION['mycart'] = [];

    // 1. Gọi các file Model (xử lý dữ liệu)
    include "model/pdo.php";
    include "model/product.php";
    include "model/category.php"; 
    
    // 2. Gọi Header (Phần đầu trang)
    include "view/header.php";

    // 3. Lấy dữ liệu dùng chung (Menu danh mục, Top sản phẩm...)
    $spnew = loadall_product_home(); // Lấy sản phẩm mới
    $dsdm = loadall_category();      // Lấy danh mục

    // 4. Điều hướng (Controller)
    if(isset($_GET['act']) && ($_GET['act'] != "")){
        $act = $_GET['act'];
        switch ($act) {
            // 1. THÊM VÀO GIỎ HÀNG
            case 'addtocart':
                if(isset($_POST['addtocart']) && ($_POST['addtocart'])){
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    $img = $_POST['img'];
                    $price = $_POST['price'];
                    $soluong = 1; // Mặc định mua 1 cái

                    // Kiểm tra sản phẩm có trong giỏ chưa (để tăng số lượng thay vì thêm dòng mới)
                    $fl = 0; // Biến cờ hiệu
                    for ($i=0; $i < sizeof($_SESSION['mycart']); $i++) { 
                        if($_SESSION['mycart'][$i][1] == $name){
                            $fl = 1;
                            $soluongnew = $soluong + $_SESSION['mycart'][$i][4];
                            $_SESSION['mycart'][$i][4] = $soluongnew;
                            break;
                        }
                    }
                    
                    // Nếu chưa có thì thêm mới
                    if($fl == 0){
                        $spadd = [$id, $name, $img, $price, $soluong];
                        array_push($_SESSION['mycart'], $spadd);
                    }
                }
                include "view/viewcart.php";
                break;

            // 2. XÓA GIỎ HÀNG
            case 'delcart':
                if(isset($_GET['idcart'])){
                    array_splice($_SESSION['mycart'], $_GET['idcart'], 1);
                } else {
                    $_SESSION['mycart'] = []; // Xóa hết
                }
                // Xóa xong quay lại trang giỏ hàng
                header('Location: index.php?act=viewcart'); 
                break;

            // 3. XEM GIỎ HÀNG
            case 'viewcart':
                include "view/viewcart.php";
                break;
            // --- CASE SẢN PHẨM (Phần bạn đang thiếu) ---
            case 'products':
                $dssp = loadall_product_home(); // Lấy tất cả sản phẩm
                include "view/products.php";    // Gọi giao diện hiển thị
                break;

            // --- Case Chi tiết sản phẩm (Chuẩn bị sẵn cho bạn luôn) ---
            case 'product_detail':
                if(isset($_GET['id']) && ($_GET['id'] > 0)){
                    // Code lấy chi tiết sản phẩm sẽ viết ở đây sau
                    // $onesp = loadone_product($_GET['id']);
                    include "view/product_detail.php"; 
                }else{
                    include "view/home.php";
                }
                break;

            // --- Case Giỏ hàng ---
            case 'viewcart':
                include "view/viewcart.php";
                break;

            // --- Mặc định: Về trang chủ ---
            default:
                include "view/home.php";
                break;
        }
    } else {
        // Nếu không có act gì hết thì về trang chủ
        include "view/home.php";
    }

    // 5. Gọi Footer (Chân trang)
    include "view/footer.php";
    
?>
