<?php
session_start();

// Khởi tạo giỏ hàng nếu chưa tồn tại
if(!isset($_SESSION['mycart'])) $_SESSION['mycart'] = [];

// 1. Gọi các file Model
include "model/pdo.php";
include "model/product.php";
include "model/category.php"; 
include "model/user.php"; 
include "model/bill.php"; 
include "model/tintuc.php";



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
                    
                    // --- ĐOẠN CODE MỚI: KIỂM TRA QUYỀN ---
                    if($checkuser['role'] == 1) {
                        // Nếu là Admin (role=1) thì vào trang Admin
                        header('Location: admin/index.php');
                    } else {
                        // Nếu là Khách thì về Trang chủ
                        header('Location: index.php');
                    }
                    // -------------------------------------
                    
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

        // --- ĐOẠN BẠN ĐANG THIẾU ĐÂY NÀY ---
        case 'edit_taikhoan':
            if(isset($_POST['capnhat']) && ($_POST['capnhat'])){
                $user = $_POST['user']; 
                $pass = $_POST['pass']; 
                $email = $_POST['email']; 
                $address = $_POST['address']; 
                $tel = $_POST['tel']; 
                $id = $_POST['id'];
        
                // Gọi hàm update trong model
                update_user($id, $user, $pass, $email, $address, $tel);
                
                // Cập nhật lại session để hiển thị ngay thông tin mới
                $_SESSION['user'] = check_user($user, $pass); 
        
                $thongbao = "Cập nhật tài khoản thành công!";
            }
            include "view/edit_taikhoan.php";
            break;
        // ------------------------------------

        /* ===============================
           2. GIỎ HÀNG
        ==================================*/
        case 'addtocart':
            if(isset($_POST['id']) && $_POST['id'] > 0){
                $id = $_POST['id'];
                $name = $_POST['name'];
                $img = $_POST['img'];
                $price = $_POST['price'];
                $soluong = 1;

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
            // Logic tăng giảm giữ nguyên như cũ
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

        /* ===============================
           3. SẢN PHẨM (DANH SÁCH - CHI TIẾT)
        ==================================*/
       /* ===============================
           3. SẢN PHẨM (TÌM KIẾM & LỌC)
        ==================================*/
        case 'products':
            // 1. Lấy từ khóa tìm kiếm (Nếu có nhập ở Header)
            if(isset($_POST['kyw']) && $_POST['kyw'] != ""){
                $kyw = $_POST['kyw'];
            } else {
                $kyw = "";
            }

            // 2. Lấy ID danh mục (Nếu bấm vào danh mục)
            if(isset($_GET['iddm']) && $_GET['iddm'] > 0){
                $iddm = $_GET['iddm'];
            } else {
                $iddm = 0;
            }

            // 3. Gọi hàm tìm kiếm (Hàm này đã có trong model/product.php)
            if(function_exists('loadall_sanpham')){
                $dssp = loadall_sanpham($kyw, $iddm);
            } else {
                $dssp = loadall_product_home(); // Dự phòng nếu chưa có hàm kia
            }
            
            // 4. Cập nhật tên tiêu đề trang cho đẹp
            if($kyw != "") $title_page = 'Kết quả tìm kiếm: "'.$kyw.'"';
            else if($iddm > 0) $title_page = "Sản phẩm theo danh mục";
            else $title_page = "Tất cả sản phẩm";

            include "view/products.php";
            break;

        case 'product_detail':
            if(isset($_GET['id']) && ($_GET['id'] > 0)){
                $id = $_GET['id'];
                tang_luotxem($id);
                if(function_exists('loadone_product')){
                    $onesp = loadone_product($id);
                    if(is_array($onesp)){
                        extract($onesp); // Quan trọng để có biến $name, $price...
                        include "view/product_detail.php"; 
                    } else {
                        // Nếu không tìm thấy sản phẩm thì về trang chủ
                        include "view/home.php";
                    }
                } else {
                    include "view/home.php";
                }
            } else {
                include "view/home.php";
            }
            break;

        /* ===============================
           4. THANH TOÁN & LỊCH SỬ ĐƠN HÀNG
        ==================================*/
       case 'bill':
            if(isset($_POST['dongydathang'])){
                // 1. LẤY DỮ LIỆU TỪ FORM
                $name = $_POST['hoten'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];
                $pttt = isset($_POST['pttt']) ? $_POST['pttt'] : 1;
                $ngaydathang = date('h:i:s d/m/Y');
                
                // 2. TÍNH TỔNG TIỀN
                $total = 0;
                foreach ($_SESSION['mycart'] as $cart) {
                    $total += $cart[3] * $cart[4];
                }

                // 3. LƯU VÀO DATABASE (BILL)
                $iduser = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
                $idbill = insert_bill($iduser, $name, $email, $address, $tel, $pttt, $ngaydathang, $total);

                // 4. LƯU CHI TIẾT GIỎ HÀNG (CART) VÀ TẠO HTML GỬI MAIL
                $mail_content_cart = ""; 
                foreach ($_SESSION['mycart'] as $cart) {
                    insert_cart($iduser, $cart[0], $cart[2], $cart[1], $cart[3], $cart[4], $cart[3]*$cart[4], $idbill);
                    
                    // Tạo dòng HTML cho bảng trong email
                    $mail_content_cart .= "
                        <tr>
                            <td>{$cart[1]}</td>
                            <td style='text-align: center;'>{$cart[4]}</td>
                            <td>".number_format($cart[3] * $cart[4])." đ</td>
                        </tr>";
                }

                // 5. GỬI EMAIL (NEW)
                include_once "model/guimail.php"; 
                if(!empty($email)){
                    gui_hoa_don_email($email, $name, $idbill, $total, $mail_content_cart);
                }

                // 6. XÓA SESSION VÀ HIỂN THỊ THÔNG BÁO
                $_SESSION['mycart'] = [];
                $bill_name = $name;
                $bill_tel = $tel;
                
                include "view/bill_confirm.php"; 
            } else {
                include "view/viewcart.php";
            }
            break;

        /* ===============================
           4. SẢN PHẨM & KHÁC
        ==================================*/
        case 'products':
            $dssp = loadall_product_home();
            include "view/products.php";
            break;
            
        case 'product_detail':
            if(isset($_GET['id']) && ($_GET['id'] > 0)){
                $id = $_GET['id'];
                $onesp = loadone_product($id);
                extract($onesp);
                include "view/product_detail.php"; 
            } else {
                include "view/home.php";
            }
            break;
            
        case 'tintuc':
            $dstintuc = loadall_tintuc(); 
            include "view/news.php";
            break;
            
        case 'lienhe':
            include "view/contact.php";
            break;
            
        default:
            include "view/home.php";
            break;
        case 'giai_phap':
        include "view/solutionsp.php";
        break;
        case 'lienhe':
            include "view/contact.php";
            break;
            
        case 'gui_lienhe':
            if(isset($_POST['gui_lh'])){
                $ten = $_POST['hoten'];
                $email = $_POST['email'];
                $sdt = $_POST['sdt'];
                $tieude = $_POST['tieude'];
                $noidung = $_POST['noidung'];

                // Gọi hàm gửi mail
                include_once "model/guimail.php";
                gui_email_lien_he($ten, $email, $sdt, $tieude, $noidung);
                
                $thongbao = "Gửi liên hệ thành công! Chúng tôi sẽ phản hồi sớm.";
            }
            include "view/contact.php";
            break;
    }
      

} else {
    include "view/home.php";        
}

include "view/footer.php";
?>

