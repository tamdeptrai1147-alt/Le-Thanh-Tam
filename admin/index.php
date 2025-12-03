<?php
    session_start();
    
    // 1. KẾT NỐI CÁC MODEL (Thêm dòng thongke.php vào đây)
    include "../model/pdo.php";
    include "../model/category.php";  
    include "../model/product.php";   
    include "../model/bill.php";      
    include "../model/thongke.php";   // <--- DÒNG MỚI THÊM: Để lấy số liệu thống kê
    
    // 2. GỌI GIAO DIỆN HEADER (MENU TRÁI)
    include "header.php"; 

    // 3. ĐIỀU HƯỚNG (CONTROLLER)
    if(isset($_GET['act'])){
        $act = $_GET['act'];
        switch ($act) {
            
            /* --- KHU VỰC QUẢN LÝ DANH MỤC --- */
            case 'adddm':
                if(isset($_POST['themmoi']) && ($_POST['themmoi'])){
                    $tenloai = $_POST['tenloai'];
                    insert_danhmuc($tenloai); 
                    $thongbao = "Thêm thành công";
                }
                include "danhmuc/add.php";
                break;

            case 'listdm':
                $listdanhmuc = loadall_category(); 
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
                }
                $listdanhmuc = loadall_category();
                include "danhmuc/list.php";
                break;
            
            /* --- CÁC CHỨC NĂNG KHÁC --- */
            // case 'listsp': ...

            case 'thoat':
                session_unset();
                header('Location: ../index.php');
                break;

            default:
                // --- ĐÂY LÀ CHỖ THÊM CODE THỐNG KÊ (Khi bấm vào mục khác không tồn tại) ---
                $count_sp = count_sanpham();    // Đếm sản phẩm
                $count_bill = count_donhang();  // Đếm đơn hàng
                $count_kh = count_taikhoan();   // Đếm khách hàng
                $sum_total = sum_doanhthu();    // Tính tổng tiền
                
                include "home.php";
                break;
        }
    } else {
        // --- ĐÂY LÀ CHỖ THÊM CODE THỐNG KÊ (Khi mới vào trang admin) ---
        $count_sp = count_sanpham();
        $count_bill = count_donhang();
        $count_kh = count_taikhoan();
        $sum_total = sum_doanhthu();

        include "home.php";
    }

    echo '</div></body></html>';
?>