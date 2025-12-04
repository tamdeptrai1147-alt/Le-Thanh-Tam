<?php
session_start();

// Khởi tạo giỏ hàng nếu chưa tồn tại
if(!isset($_SESSION['mycart'])) $_SESSION['mycart'] = [];

// THÊM: Khởi tạo danh sách sản phẩm đã xem nếu chưa tồn tại
if(!isset($_SESSION['viewed_products'])) $_SESSION['viewed_products'] = [];

// 1. Gọi các file Model
include "model/pdo.php";
include "model/product.php";
include "model/category.php"; 
include "model/user.php"; 
include "model/bill.php"; 
include "model/tintuc.php"; 

// 2. Header
include "view/header.php";

// 3. Lấy dữ liệu dùng chung (Sửa lỗi loadall_product_home)
$spnew = loadall_product(); 
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
            if(isset($_POST['id']) && $_POST['id'] > 0){
                $id = $_POST['id'];
                $name = $_POST['name'];
                $img = $_POST['img'];
                $price = $_POST['price'];
                $soluong = 1;

                // Kiểm tra sản phẩm đã tồn tại trong giỏ chưa
                $fl = 0;
                for ($i = 0; $i < count($_SESSION['mycart']); $i++) {
                    if ($_SESSION['mycart'][$i][0] == $id) {
                        $_SESSION['mycart'][$i][4] += $soluong; // Tăng số lượng
                        $fl = 1;
                        break;
                    }
                }
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
            header('Location: index.php?act=viewcart');
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
            header('Location: index.php?act=viewcart');
            break;

        case 'viewcart':
            include "view/viewcart.php";
            break;

        /* ===============================
           3. THANH TOÁN & LỊCH SỬ ĐƠN HÀNG
        ==================================*/
        case 'bill':
            if(isset($_POST['dongydathang'])){
                $name = $_POST['hoten'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];
                $pttt = isset($_POST['pttt']) ? $_POST['pttt'] : 1;
                $ngaydathang = date('h:i:s d/m/Y');
                $total = 0;
                
                foreach ($_SESSION['mycart'] as $cart) {
                    $total += $cart[3] * $cart[4];
                }

                $iduser = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
                $idbill = insert_bill($iduser, $name, $email, $address, $tel, $pttt, $ngaydathang, $total);

                foreach ($_SESSION['mycart'] as $cart) {
                    insert_cart($iduser, $cart[0], $cart[2], $cart[1], $cart[3], $cart[4], $cart[3]*$cart[4], $idbill);
                }

                $_SESSION['mycart'] = [];
                $bill_name = $name;
                $bill_tel = $tel;
                
                include "view/bill_confirm.php"; 
            } else {
                include "view/viewcart.php";
            }
            break;

        case 'mybill':
            if(isset($_SESSION['user'])){
                $iduser = $_SESSION['user']['id'];
                $listbill = loadall_bill($iduser); // Lấy danh sách đơn hàng
                include "view/mybill.php";
            } else {
                header('Location: index.php?act=dangnhap');
            }
            break;

        case 'mybill_detail':
            if(isset($_GET['idbill']) && ($_GET['idbill'] > 0)){
                $idbill = $_GET['idbill'];
                $bill_detail = loadall_cart($idbill); 
                include "view/mybill_detail.php";
            } else {
                include "view/mybill.php";
            }
            break;

        /* ===============================
           4. SẢN PHẨM & TÌM KIẾM/LỌC
        ==================================*/
        case 'products':
            // Xử lý tìm kiếm/lọc
            $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : "";
            $iddm = isset($_GET['iddm']) ? $_GET['iddm'] : 0;
            
            // Dùng hàm loadall_product đã sửa đổi
            $dssp = loadall_product($keyword, $iddm); 
            
            $ten_dm = ($iddm > 0 && function_exists('load_ten_dm')) ? load_ten_dm($iddm) : "Tất cả sản phẩm";
            
            include "view/products.php";
            break;
            
        case 'product_detail':
            if(isset($_GET['id']) && ($_GET['id'] > 0)){
                $id = $_GET['id'];
                
                // Khởi tạo an toàn 
                $sp_cungloai = [];
                $iddm = 0; 
                $sp_da_xem = []; 

                if(function_exists('loadone_product')){
                    $onesp = loadone_product($id);
                    
                    if(is_array($onesp) && count($onesp) > 0){ 
                        extract($onesp); // Tạo ra các biến như $iddm, $name, $description...
                    }

                    // Tải sản phẩm cùng loại
                    if($iddm > 0) { 
                        $sp_cungloai = load_product_cungloai($id, $iddm); 
                    }
                }
                
                // LOGIC 1: Quản lý Session sản phẩm đã xem
                $id_int = (int)$id; 
                if (!in_array($id_int, $_SESSION['viewed_products'])) {
                    array_unshift($_SESSION['viewed_products'], $id_int); // Thêm ID sản phẩm hiện tại vào đầu (mới nhất)
                    if (count($_SESSION['viewed_products']) > 5) {
                        array_pop($_SESSION['viewed_products']);
                    }
                }
                
                // LOGIC 2: Tải chi tiết các sản phẩm đã xem (trừ sản phẩm hiện tại)
                $viewed_ids_for_query = array_diff($_SESSION['viewed_products'], [$id_int]);
                
                if(!empty($viewed_ids_for_query)){
                    // HÀM ĐÃ ĐƯỢC THÊM VÀO model/product.php ở bước 1
                    $sp_da_xem = loadall_product_by_ids($viewed_ids_for_query); 
                }

                include "view/product_detail.php"; 
            } else {
                include "view/home.php";
            }
            break;
            
        default:
            include "view/home.php";
            break;
        /* ===============================
           6. TIN TỨC
        ==================================*/
       case 'tintuc':
        $dstintuc = loadall_tintuc(); // Lấy dữ liệu từ DB gán vào biến
        include "view/news.php";
        break;
        
        // Chi tiết tin tức
        case 'tintuc_chitiet':
            if(isset($_GET['id']) && ($_GET['id'] > 0)){
                $id = $_GET['id'];
                $onetintuc = loadone_tintuc($id); 
                $dstintuc = loadall_tintuc();
                include "view/news_detail.php"; 
            } else {
                $dstintuc = loadall_tintuc();
                include "view/news.php";
            }
            break;
        case 'giai_phap':
            include "view/solutions.php";
            break;
        /* --- LIÊN HỆ --- */
        case 'lienhe':
            include "view/contact.php";
            break;
            
        case 'gui_lienhe':
            // Xử lý logic gửi mail ở đây (Tạm thời chỉ thông báo)
            if(isset($_POST['gui_lh'])){
                $thongbao = "Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm.";
            }
            include "view/contact.php";
            break;
        /* ---------------- */
            
    }

} else {
    include "view/home.php";        
}

// Footer
include "view/footer.php";
?>

