<?php

=======
session_start();

// Khởi tạo giỏ hàng nếu chưa tồn tại
if(!isset($_SESSION['mycart'])) $_SESSION['mycart'] = [];

// 1. Gọi các file Model
include "model/pdo.php";
include "model/product.php";
include "model/category.php"; 
include "model/user.php"; 
include "model/bill.php"; // Bắt buộc có để xử lý đơn hàng

// 2. Header
include "view/header.php";

// 3. Lấy dữ liệu dùng chung
$spnew = loadall_product_home(); 
$dsdm = loadall_category();      

// 4. Điều hướng (Controller)
if(isset($_GET['act']) && ($_GET['act'] != "")) {

    $act = $_GET['act'];

    switch ($act) {
        
        /* ===============================
           1. TÀI KHOẢN (ĐĂNG KÝ - ĐĂNG NHẬP - THOÁT)
        ==================================*/
        case 'dangky':
            if(isset($_POST['dangky']) && ($_POST['dangky'])){
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];
                
                insert_user($user, $pass, $email, $address, $tel); 
                
                $thongbao = "Đăng ký thành công! Vui lòng đăng nhập.";
            }
            include "view/dangky.php";
            break;

        case 'dangnhap':
            if(isset($_POST['dangnhap']) && ($_POST['dangnhap'])){
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $checkuser = check_user($user, $pass);
                if(is_array($checkuser)){
                    $_SESSION['user'] = $checkuser;
                    header('Location: index.php');
                    exit();
                } else {
                    $thongbao = "Tài khoản hoặc mật khẩu sai!";
                }
            }
            include "view/dangnhap.php";
            break;

        case 'thoat':
            session_unset();
            header('Location: index.php');
            exit();
            break;

        /* ===============================
           2. GIỎ HÀNG (THÊM - XÓA - TĂNG GIẢM)
        ==================================*/
        case 'addtocart':
            // Chỉ cần kiểm tra có ID sản phẩm gửi lên là lụm
            if(isset($_POST['id']) && $_POST['id'] > 0){
                $id = $_POST['id'];
                $name = $_POST['name'];
                $img = $_POST['img'];
                $price = $_POST['price'];
                // Nếu có nhập số lượng thì lấy, không thì mặc định là 1
                $soluong = (isset($_POST['soluong']) && $_POST['soluong'] > 0) ? $_POST['soluong'] : 1;

                // Kiểm tra sản phẩm đã tồn tại trong giỏ chưa
                $fl = 0;
                for ($i = 0; $i < count($_SESSION['mycart']); $i++) {
                    if ($_SESSION['mycart'][$i][0] == $id) {
                        $_SESSION['mycart'][$i][4] += $soluong; // Tăng số lượng
                        $fl = 1;
                        break;
                    }
                }

                // Nếu chưa có thì thêm mới
                if ($fl == 0) {
                    $spadd = [$id, $name, $img, $price, $soluong];
                    array_push($_SESSION['mycart'], $spadd);
                }

                $_SESSION['thongbao'] = "Đã thêm sản phẩm vào giỏ hàng!";
                
                header("Location: index.php?act=viewcart");
                exit();
            }
            include "view/viewcart.php";
            break;

        case 'delcart':
            if(isset($_GET['idcart'])){
                array_splice($_SESSION['mycart'], $_GET['idcart'], 1);
            } else {
                $_SESSION['mycart'] = [];
            }
            header("Location: index.php?act=viewcart");
            break;
            
        case 'inc_cart':
            if(isset($_GET['i'])){
                $i = $_GET['i'];
                $_SESSION['mycart'][$i][4]++;
            }
            header("Location: index.php?act=viewcart");
            break;

        case 'dec_cart':
            if(isset($_GET['i'])){
                $i = $_GET['i'];
                if($_SESSION['mycart'][$i][4] > 1){
                    $_SESSION['mycart'][$i][4]--;
                } else {
                    array_splice($_SESSION['mycart'], $i, 1);
                }
            }
            header("Location: index.php?act=viewcart");
            break;

        case 'viewcart':
            include "view/viewcart.php";
            break;

        /* ===============================
           3. SẢN PHẨM (DANH SÁCH - CHI TIẾT)
        ==================================*/
        case 'products':
            $dssp = loadall_product_home();
            include "view/products.php";
            break;

        case 'product_detail':
            if(isset($_GET['id']) && ($_GET['id'] > 0)){
                $id = $_GET['id'];
                if(function_exists('loadone_product')){
                    $onesp = loadone_product($id);
                    extract($onesp); // Quan trọng để có biến $name, $price...
                }
                include "view/product_detail.php"; 
            } else {
                include "view/home.php";
            }
            break;

        /* ===============================
           4. THANH TOÁN & LỊCH SỬ ĐƠN HÀNG
        ==================================*/
        case 'bill':
            if(isset($_POST['dongydathang'])){
                // 1. Lấy thông tin từ form
                $name = $_POST['hoten'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];
                $pttt = isset($_POST['pttt']) ? $_POST['pttt'] : 1;
                $ngaydathang = date('h:i:s d/m/Y');
                $total = 0;
                
                // Tính tổng tiền
                foreach ($_SESSION['mycart'] as $cart) {
                    $total += $cart[3] * $cart[4];
                }

                // 2. Lưu vào Database (Bảng bill)
                $iduser = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
                // Cần đảm bảo hàm insert_bill đã được định nghĩa trong model/bill.php
                $idbill = insert_bill($iduser, $name, $email, $address, $tel, $pttt, $ngaydathang, $total);

                // 3. Lưu chi tiết giỏ hàng (Bảng cart)
                foreach ($_SESSION['mycart'] as $cart) {
                    insert_cart($iduser, $cart[0], $cart[2], $cart[1], $cart[3], $cart[4], $cart[3]*$cart[4], $idbill);
                }

                // 4. Xóa giỏ hàng và Thông báo
                $_SESSION['mycart'] = [];
                
                // Biến để hiển thị thông báo (nếu dùng trang confirm riêng)
                $bill_name = $name;
                $bill_tel = $tel;
                
                // Hiển thị trang xác nhận
                include "view/bill_confirm.php"; 
            } else {
                include "view/viewcart.php";
            }
            break;

        case 'mybill':
            if(isset($_SESSION['user'])){
                $iduser = $_SESSION['user']['id'];
                if(function_exists('loadall_bill')){
                    $listbill = loadall_bill($iduser); 
                }
                include "view/mybill.php";
            } else {
                header('Location: index.php?act=dangnhap');
            }
            break;
            // --- XEM CHI TIẾT ĐƠN HÀNG ---
        case 'mybill_detail':
            if(isset($_GET['idbill']) && ($_GET['idbill'] > 0)){
                $idbill = $_GET['idbill'];
                // Gọi hàm lấy chi tiết đơn hàng (đã có trong model/bill.php)
                if(function_exists('loadall_cart')){
                    $bill_detail = loadall_cart($idbill); 
                }
                include "view/mybill_detail.php";
            } else {
                include "view/mybill.php";
            }
            break;

        /* ===============================
           5. MẶC ĐỊNH
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
>>>>>>> main
