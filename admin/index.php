<?php
    session_start();
    // Kết nối các model cần thiết
    include "../model/pdo.php";
    include "../model/category.php";  // Để quản lý danh mục
    include "../model/product.php";   // Để quản lý sản phẩm
    include "../model/bill.php";      // Để xem đơn hàng
    include "../model/thongke.php";   // Để hiện thống kê Dashboard

    include "header.php"; // Gọi giao diện Menu bên trái + Header

    // Kiểm tra xem người dùng muốn đi đâu (biến 'act')
    if(isset($_GET['act'])){
        $act = $_GET['act'];
        switch ($act) {
            
            /* --- KHU VỰC QUẢN LÝ DANH MỤC --- */
            case 'adddm':
                // Kiểm tra xem người dùng có bấm nút "Thêm mới" không
                if(isset($_POST['themmoi']) && ($_POST['themmoi'])){
                    $tenloai = $_POST['tenloai'];
                    insert_danhmuc($tenloai); // Gọi hàm thêm trong model
                    $thongbao = "Thêm thành công";
                }
                include "danhmuc/add.php";
                break;

            case 'listdm':
                $listdanhmuc = loadall_category(); // Lấy danh sách từ DB
                include "danhmuc/list.php";
                break;

            case 'xoadm':
                if(isset($_GET['id']) && ($_GET['id']>0)){
                    delete_danhmuc($_GET['id']);
                }
                $listdanhmuc = loadall_category(); 
                include "danhmuc/list.php";
                break;

            case 'suadm':
                if(isset($_GET['id']) && ($_GET['id']>0)){
                    $dm = loadone_danhmuc($_GET['id']);
                }
                include "danhmuc/update.php";
                break;

            case 'updatedm':
                if(isset($_POST['capnhat']) && ($_POST['capnhat'])){
                    $tenloai = $_POST['tenloai'];
                    $id = $_POST['id'];
                    update_danhmuc($id, $tenloai);
                    $thongbao = "Cập nhật thành công";
                }
                $listdanhmuc = loadall_category();
                include "danhmuc/list.php";
                break;
            
            /* --- CÁC CHỨC NĂNG KHÁC (ĐỂ SAU) --- */
            case 'listsp':
                // include "sanpham/list.php";
                break;
                
            case 'thoat':
                session_unset();
                header('Location: ../index.php');
                break;

            default:
                // Mặc định vào trang Dashboard thống kê
                $count_sp = count_sanpham();
                $count_bill = count_donhang();
                $count_kh = count_taikhoan();
                $sum_total = sum_doanhthu();
                include "home.php";
                break;
        }
    } else {
        // Nếu không chọn gì thì cũng vào Dashboard
        $count_sp = count_sanpham();
        $count_bill = count_donhang();
        $count_kh = count_taikhoan();
        $sum_total = sum_doanhthu();
        include "home.php";
    }

    // Đóng thẻ div mở bên header
    echo '</div></body></html>';
?>