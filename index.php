<?php
session_start();

// Khởi tạo giỏ hàng nếu chưa tồn tại
if(!isset($_SESSION['mycart'])) $_SESSION['mycart'] = [];

// 1. Gọi các file Model
include "model/pdo.php";
include "model/product.php";
include "model/category.php"; 
include "model/user.php"; // <--- THÊM DÒNG NÀY

// 2. Header
include "view/header.php";

// 3. Lấy dữ liệu dùng chung
$spnew = loadall_product_home(); 
$dsdm = loadall_category();      

// 4. Điều hướng (Controller)
if(isset($_GET['act']) && ($_GET['act'] != "")) {

    $act = $_GET['act'];

    switch ($act) {
        // ... (Các case cũ) ...

            // ĐĂNG KÝ THÀNH VIÊN
            case 'dangky':
                if(isset($_POST['dangky']) && ($_POST['dangky'])){
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];
                    $tel = $_POST['tel'];
                    
                    // Gọi hàm trong Model để chèn dữ liệu vào DB
                    insert_user($user, $pass, $email, $address, $tel); 
                    
                    $thongbao = "Đăng ký thành công! Vui lòng đăng nhập."; // Thông báo
                }
                include "view/dangky.php";
                break;
                
            // ... (Các case cũ) ...

        /* ===============================
           1. THÊM VÀO GIỎ HÀNG
        ==================================*/
        case 'addtocart':
            if(isset($_POST['addtocart']) && ($_POST['addtocart'])){

                $id = $_POST['id'];
                $name = $_POST['name'];
                $img = $_POST['img'];
                $price = $_POST['price'];
                $soluong = 1;

                // Kiểm tra sản phẩm đã tồn tại trong giỏ hay chưa
                $fl = 0;
                for ($i = 0; $i < sizeof($_SESSION['mycart']); $i++) {
                    if ($_SESSION['mycart'][$i][0] == $id) {
                        $_SESSION['mycart'][$i][4] += 1; // tăng số lượng
                        $fl = 1;
                        break;
                    }
                }

                // Nếu chưa có thì thêm mới
                if ($fl == 0) {
                    $spadd = [$id, $name, $img, $price, $soluong];
                    array_push($_SESSION['mycart'], $spadd);
                }

                // Lưu thông báo
                $_SESSION['thongbao'] = "Đã thêm sản phẩm " . $name . " vào giỏ hàng!";

                // Chuyển hướng
                header("Location: index.php?act=viewcart");
                exit();
            }

            include "view/viewcart.php";
            break;

        /* ===============================
           2. XÓA SẢN PHẨM TRONG GIỎ
        ==================================*/
        case 'delcart':
            if(isset($_GET['idcart'])){
                array_splice($_SESSION['mycart'], $_GET['idcart'], 1);
            } else {
                $_SESSION['mycart'] = [];
            }
            header("Location: index.php?act=viewcart");
            break;

        /* ===============================
           3. HIỂN THỊ GIỎ HÀNG
        ==================================*/
        case 'viewcart':
            include "view/viewcart.php";
            break;

        /* ===============================
           4. TRANG SẢN PHẨM
        ==================================*/
        case 'products':
            $dssp = loadall_product_home();
            include "view/products.php";
            break;

        /* ===============================
           5. TRANG CHI TIẾT SẢN PHẨM
        ==================================*/
        case 'product_detail':
            if(isset($_GET['id']) && ($_GET['id'] > 0)){
                $id = $_GET['id'];
                include "view/product_detail.php"; 
            } else {
                include "view/home.php";
            }
            break;

        /* ===============================
           6. MẶC ĐỊNH: HOME
        ==================================*/
        default:
            include "view/home.php";
            break;
    }
    

} else {
    include "view/home.php";
}

// Footer
include "view/footer.php";
?>
