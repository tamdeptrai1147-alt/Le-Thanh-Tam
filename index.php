<?php
session_start();

// Khởi tạo giỏ hàng
if(!isset($_SESSION['mycart'])) $_SESSION['mycart'] = [];
if(!isset($_SESSION['viewed_products'])) $_SESSION['viewed_products'] = [];

// 1. Gọi các file Model
include "model/pdo.php";
include "model/product.php";
include "model/category.php"; 
include "model/user.php"; 
include "model/bill.php"; 
include "model/tintuc.php";
include "model/lienhe.php";
include "model/solutions.php";

// 2. Header
include "view/header.php";

// 3. Lấy dữ liệu dùng chung (cho trang chủ)
$spnew = loadall_product_home(); 
$dsdm = loadall_category();      

// 4. Điều hướng (Controller)
if(isset($_GET['act']) && ($_GET['act'] != "")) {

    $act = $_GET['act'];

    switch ($act) {
        
        /* ===============================
           1. TÀI KHOẢN
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
                    if($checkuser['role'] == 1) {
                        header('Location: admin/index.php');
                    } else {
                        header('Location: index.php');
                    }
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

        case 'edit_taikhoan':
            if(isset($_POST['capnhat']) && ($_POST['capnhat'])){
                $user = $_POST['user']; 
                $pass = $_POST['pass']; 
                $email = $_POST['email']; 
                $address = $_POST['address']; 
                $tel = $_POST['tel']; 
                $id = $_POST['id'];
        
                update_user($id, $user, $pass, $email, $address, $tel);
                $_SESSION['user'] = check_user($user, $pass); 
                $thongbao = "Cập nhật hồ sơ thành công!";
            }
            include "view/edit_taikhoan.php";
            break;

        case 'address':
            if(isset($_POST['capnhat_address']) && ($_POST['capnhat_address'])){
                $id = $_POST['id'];
                $address = $_POST['address'];
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $email = $_POST['email'];
                $tel = $_POST['tel'];

                update_user($id, $user, $pass, $email, $address, $tel);
                $_SESSION['user'] = check_user($user, $pass);
                $thongbao = "Đã lưu địa chỉ mới!";
            }
            if(isset($_SESSION['user'])) extract($_SESSION['user']);
            include "view/address.php";
            break;

        /* ===============================
           2. GIỎ HÀNG
        ==================================*/
        case 'addtocart':
            if(isset($_POST['id']) && $_POST['id'] > 0){
                $id = $_POST['id'];
                $name = $_POST['name'];
                $img = $_POST['img'];
                $price = $_POST['price'];
                $soluong = isset($_POST['soluong']) ? $_POST['soluong'] : 1; // Lấy số lượng từ form

                $fl = 0;
                for ($i = 0; $i < count($_SESSION['mycart']); $i++) {
                    if ($_SESSION['mycart'][$i][0] == $id) {
                        $_SESSION['mycart'][$i][4] += $soluong;
                        $fl = 1;
                        break;
                    }
                }
                if ($fl == 0) {
                    $spadd = [$id, $name, $img, $price, $soluong];
                    array_push($_SESSION['mycart'], $spadd);
                }
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
        case 'dec_cart':
             if(isset($_GET['i'])){
                $i = $_GET['i'];
                if($act == 'inc_cart') $_SESSION['mycart'][$i][4]++;
                else {
                    if($_SESSION['mycart'][$i][4] > 1) $_SESSION['mycart'][$i][4]--;
                    else array_splice($_SESSION['mycart'], $i, 1);
                }
            }
            header('Location: index.php?act=viewcart');
            break;

        case 'viewcart':
            include "view/viewcart.php";
            break;

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
                
                // Lấy danh sách đơn hàng (Code cũ giữ nguyên)
                $listbill = loadall_bill($iduser);
                
                // --- THÊM 2 DÒNG NÀY ---
                $tongTienDaMua = get_tong_tien_da_mua($iduser);
                $soDonHuy = get_so_don_huy($iduser);
                // -----------------------
                
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
           3. SẢN PHẨM 
        ==================================*/
        case 'products':
            if(isset($_POST['kyw']) && $_POST['kyw'] != ""){
                $kyw = $_POST['kyw'];
            } else {
                $kyw = "";
            }
            if(isset($_GET['iddm']) && $_GET['iddm'] > 0){
                $iddm = $_GET['iddm'];
            } else {
                $iddm = 0;
            }

            if(function_exists('loadall_sanpham')){
                $dssp = loadall_sanpham($kyw, $iddm);
            } else {
                $dssp = loadall_product_home();
            }
            
            if($kyw != "") $title_page = 'Kết quả tìm kiếm: "'.$kyw.'"';
            else if($iddm > 0) $title_page = "Sản phẩm theo danh mục";
            else $title_page = "Tất cả sản phẩm";

            include "view/products.php";
            break;

        case 'product_detail':
            if(isset($_GET['id']) && ($_GET['id'] > 0)){
                $id = $_GET['id'];
                tang_luotxem($id);
                
                // Lấy thông tin sản phẩm (đã sửa đúng tên hàm loadone_sanpham)
                $onesp = loadone_sanpham($id);
                
                if(is_array($onesp)){
                    extract($onesp); // Giải nén biến $name, $price, $category_id...
                    
                    // Lấy sản phẩm cùng loại
                    if(function_exists('load_product_cungloai')){
                        $sp_cungloai = load_product_cungloai($id, $category_id);
                    } else {
                        $sp_cungloai = []; // Tránh lỗi nếu hàm chưa có
                    }
                    
                    include "view/product_detail.php"; 
                } else {
                    include "view/home.php";
                }
            } else {
                include "view/home.php";
            }
            break;

        /* ===============================
           4. TIN TỨC & GIẢI PHÁP
        ==================================*/
        case 'tintuc':
            $dstintuc = loadall_tintuc(); 
            include "view/news.php";
            break;

        case 'tintuc_chitiet':
            if(isset($_GET['id']) && ($_GET['id'] > 0)){
                $id = $_GET['id'];
                $onesp = loadone_tintuc($id);
                extract($onesp);
                include "view/news_detail.php";
            } else {
                include "view/news.php";
            }
            break;

        case 'giai_phap':
            $ds_giaiphap = loadall_solutions(); 
            include "view/solutionsp.php";
            break;

        case 'giai_phap_chitiet':
            if(isset($_GET['id']) && ($_GET['id'] > 0)){
                $id = $_GET['id'];
                $one_sol = loadone_solution($id);
                if(is_array($one_sol)) extract($one_sol);
                include "view/solution_detail.php";
            } else {
                include "view/solutionsp.php";
            }
            break;

        /* ===============================
           5. LIÊN HỆ
        ==================================*/
        case 'lienhe':
            include "view/contact.php";
            break;
            
        case 'gui_lienhe':
            if(isset($_POST['gui_lh'])){
                $name = $_POST['hoten'];
                $email = $_POST['email'];
                $tel = $_POST['sdt'];
                $subject = $_POST['tieude'];
                $content = $_POST['noidung'];
                send_mail_lienhe($name, $email, $tel, $subject, $content);
                insert_lienhe($name, $email, $tel, $subject, $content);
                $thongbao = "Gửi liên hệ thành công! Chúng tôi sẽ sớm phản hồi.";
            }
            include "view/contact.php";
            break;

        default:
            include "view/home.php";
            break;
    }

} else {
    include "view/home.php";        
}

include "view/footer.php";
?>

