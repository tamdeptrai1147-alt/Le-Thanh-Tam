<?php
session_start();
ob_start(); // Bật bộ đệm đầu ra để tránh lỗi header

// 1. Gọi các file Model (Đảm bảo các file này tồn tại đúng đường dẫn)
include "model/pdo.php";
include "model/product.php";
include "model/category.php"; 
include "model/user.php"; 
include "model/bill.php"; 
include "model/tintuc.php";
// include "model/guimail.php"; // Có thể include ở đây hoặc trong case cần dùng

// 2. Load dữ liệu dùng chung cho mọi trang (Menu, Danh mục...)
include "view/header.php";
$spnew = loadall_product_home(); 
$dsdm = loadall_category();      

// 3. Điều hướng (Controller)
if(isset($_GET['act']) && ($_GET['act'] != "")) {
    $act = $_GET['act'];

    switch ($act) {
        
        /* =========================================
           KHỐI TÀI KHOẢN (Đăng ký, Nhập, Xuất...)
        ========================================= */
        case 'dangky':
            if(isset($_POST['dangky']) && ($_POST['dangky'])){
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];
                
                // Gọi hàm insert user
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
                    
                    // Phân quyền: 1 là Admin -> trang quản trị, Khác -> trang chủ
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
                
                // Cập nhật lại session ngay lập tức
                $_SESSION['user'] = check_user($user, $pass); 
                $thongbao = "Cập nhật tài khoản thành công!";
            }
            include "view/edit_taikhoan.php";
            break;

        case 'quenmk':
            if(isset($_POST['gui_email'])){
                $email = $_POST['email'];
                
                // Kiểm tra xem hàm check_email có tồn tại trong model/user.php chưa
                if(function_exists('check_email')){
                    $check_email = check_email($email);
                    if(is_array($check_email)){
                        $thongbao = "Mật khẩu của bạn là: " . $check_email['pass'];
                        // Nâng cao: Gửi email thật qua PHPMailer
                    } else {
                        $thongbao = "Email này không tồn tại trong hệ thống!";
                    }
                } else {
                    $thongbao = "Chức năng đang bảo trì (Thiếu hàm check_email).";
                }
            }
            include "view/quenmk.php";
            break;

        /* =========================================
           KHỐI SẢN PHẨM (Danh sách, Chi tiết...)
        ========================================= */
        case 'products':
            // Xử lý tìm kiếm và lọc danh mục GỘP CHUNG
            $kyw = isset($_POST['kyw']) ? $_POST['kyw'] : "";
            $iddm = isset($_GET['iddm']) ? $_GET['iddm'] : 0;

            if(function_exists('loadall_sanpham')){
                $dssp = loadall_sanpham($kyw, $iddm);
            } else {
                $dssp = loadall_product_home(); // Fallback nếu chưa viết hàm tìm kiếm
            }
            
            // Title hiển thị cho đẹp
            if($kyw != "") $title_page = 'Kết quả tìm kiếm: "'.$kyw.'"';
            else if($iddm > 0) $title_page = "Sản phẩm theo danh mục";
            else $title_page = "Tất cả sản phẩm";

            include "view/products.php";
            break;

        case 'product_detail':
            if(isset($_GET['id']) && ($_GET['id'] > 0)){
                $id = $_GET['id'];
                
                // Tăng lượt xem
                if(function_exists('tang_luotxem')) tang_luotxem($id);
                
                $onesp = loadone_product($id);
                extract($onesp); // Bung mảng thành biến: $name, $price, ...
                
                // Gợi ý: Nên load thêm sản phẩm cùng loại
                // $sp_cung_loai = load_sanpham_cungloai($id, $iddm);
                
                include "view/product_detail.php"; 
            } else {
                include "view/home.php";
            }
            break;

        /* =========================================
           KHỐI GIỎ HÀNG (Thêm, Xóa, Xem...)
        ========================================= */
        case 'addtocart':
            // Khởi tạo giỏ hàng nếu chưa có
            if(!isset($_SESSION['mycart'])) $_SESSION['mycart'] = [];

            if(isset($_POST['id']) && $_POST['id'] > 0){
                $id = $_POST['id'];
                $name = $_POST['name'];
                $img = $_POST['img'];
                $price = $_POST['price'];
                $soluong = 1;

                // Kiểm tra sản phẩm đã có trong giỏ chưa
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
            }
            // Add xong thì chuyển về trang giỏ hàng
            header("Location: index.php?act=viewcart");
            exit();
            break;

        case 'delcart':
            if(isset($_GET['idcart'])){
                array_splice($_SESSION['mycart'], $_GET['idcart'], 1);
            } else {
                $_SESSION['mycart'] = []; // Xóa hết
            }
            header("Location: index.php?act=viewcart");
            exit();
            break;

        case 'viewcart':
            include "view/viewcart.php";
            break;
            
        case 'inc_cart':
        case 'dec_cart':
             if(isset($_GET['i']) && isset($_SESSION['mycart'])){
                $i = $_GET['i'];
                if(isset($_SESSION['mycart'][$i])){
                    if($act == 'inc_cart') {
                        $_SESSION['mycart'][$i][4]++;
                    } else {
                        // Giảm số lượng, nếu <= 1 thì xóa luôn
                        if($_SESSION['mycart'][$i][4] > 1) {
                            $_SESSION['mycart'][$i][4]--;
                        } else {
                            array_splice($_SESSION['mycart'], $i, 1);
                        }
                    }
                }
            }
            header('Location: index.php?act=viewcart');
            exit();
            break;

        /* =========================================
           KHỐI THANH TOÁN (Bill)
        ========================================= */
        case 'bill':
            if(isset($_POST['dongydathang'])){
                $name = $_POST['hoten'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];
                $pttt = isset($_POST['pttt']) ? $_POST['pttt'] : 1;
                $ngaydathang = date('h:i:s d/m/Y');
                
                // Tính tổng tiền
                $total = 0;
                if(isset($_SESSION['mycart'])){
                    foreach ($_SESSION['mycart'] as $cart) {
                        $total += $cart[3] * $cart[4];
                    }
                }

                // Insert Bill
                $iduser = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
                $idbill = insert_bill($iduser, $name, $email, $address, $tel, $pttt, $ngaydathang, $total);

                // Insert Cart Detail & Tạo nội dung Mail
                $mail_content_cart = ""; 
                if(isset($_SESSION['mycart'])){
                    foreach ($_SESSION['mycart'] as $cart) {
                        insert_cart($iduser, $cart[0], $cart[2], $cart[1], $cart[3], $cart[4], $cart[3]*$cart[4], $idbill);
                        
                        $mail_content_cart .= "
                            <tr>
                                <td>{$cart[1]}</td>
                                <td style='text-align: center;'>{$cart[4]}</td>
                                <td>".number_format($cart[3] * $cart[4])." đ</td>
                            </tr>";
                    }
                }

                // Gửi Email
                include_once "model/guimail.php"; 
                if(!empty($email) && function_exists('gui_hoa_don_email')){
                    gui_hoa_don_email($email, $name, $idbill, $total, $mail_content_cart);
                }

                // Xóa giỏ hàng sau khi đặt xong
                $_SESSION['mycart'] = [];
                
                // Biến dùng để hiển thị thông báo
                $bill_name = $name;
                $bill_tel = $tel;
                
                include "view/bill_confirm.php"; 
            } else {
                include "view/viewcart.php";
            }
            break;

        /* =========================================
           KHỐI TIN TỨC & LIÊN HỆ
        ========================================= */
        case 'tintuc':
            $dstintuc = loadall_tintuc(); 
            include "view/news.php";
            break;
            
        case 'lienhe':
            // Chỉ hiển thị form
            include "view/contact.php";
            break;

        case 'gui_lienhe':
            // Xử lý khi bấm nút gửi
            if(isset($_POST['gui_lh'])){
                $ten = $_POST['hoten'];
                $email = $_POST['email'];
                $sdt = $_POST['sdt'];
                $tieude = $_POST['tieude'];
                $noidung = $_POST['noidung'];

                include_once "model/guimail.php";
                if(function_exists('gui_email_lien_he')){
                    gui_email_lien_he($ten, $email, $sdt, $tieude, $noidung);
                }
                
                $thongbao = "Gửi liên hệ thành công! Chúng tôi sẽ phản hồi sớm.";
            }
            include "view/contact.php";
            break;

        case 'giai_phap':
            include "view/solutionsp.php";
            break;

        default:
            include "view/home.php";
            break;
    }
} else {
    // Nếu không có act, mặc định vào trang chủ
    include "view/home.php";        
}

include "view/footer.php";
ob_end_flush(); // Kết thúc bộ đệm
?>