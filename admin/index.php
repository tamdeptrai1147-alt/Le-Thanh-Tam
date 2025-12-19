<?php
    session_start();
    
    // 1. KẾT NỐI CÁC MODEL (Thêm dòng thongke.php vào đây)
    include "../model/pdo.php";
    include "../model/category.php";  
    include "../model/product.php";   
    include "../model/bill.php";      
    include "../model/thongke.php"; 
    include "../model/user.php";
    // <--- DÒNG MỚI THÊM: Để lấy số liệu thống kê
    
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
            /* --- QUẢN LÝ KHÁCH HÀNG --- */
            case 'dskh':
                $listtaikhoan = loadall_taikhoan();
                include "taikhoan/list.php";
                break;
            
            case 'xoakh':
                if(isset($_GET['id']) && ($_GET['id'] > 0)){
                    delete_taikhoan($_GET['id']);
                }
                $listtaikhoan = loadall_taikhoan();
                include "taikhoan/list.php";
                break;
            
            // Xử lý khi bấm nút "Lưu" vai trò (Admin/Khách)
            case 'suarole':
                if(isset($_POST['capnhat_role']) && ($_POST['capnhat_role'])){
                    $id = $_POST['id'];
                    $role = $_POST['role'];
                    update_role($id, $role);
                }
                $listtaikhoan = loadall_taikhoan();
                include "taikhoan/list.php";
                break;
            case 'listsp':
                // Kiểm tra xem có tìm kiếm hay lọc danh mục không
                $kyw = isset($_POST['kyw']) ? $_POST['kyw'] : "";
                $iddm = isset($_POST['iddm']) ? $_POST['iddm'] : 0;
                
                $listdanhmuc = loadall_category(); // Lấy danh mục để hiện vào bộ lọc
                $listsanpham = loadall_sanpham($kyw, $iddm); // Lấy danh sách sản phẩm
                include "sanpham/list.php";
                break;

            case 'addsp':
                if(isset($_POST['themmoi']) && ($_POST['themmoi'])){
                    $category_id = $_POST['category_id'];
                    $name = $_POST['name'];
                    $price = $_POST['price'];
                    $description = $_POST['description'];
                    
                    // Xử lý hình ảnh
                    $img = $_FILES['img']['name'];
                    $target_dir = "../img/";
                    $target_file = $target_dir . basename($_FILES["img"]["name"]);
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                        // Upload thành công
                    } else {
                        // Lỗi upload
                    }

                    insert_sanpham($name, $price, $img, $description, $category_id);
                    $thongbao = "Thêm thành công!";
                }
                $listdanhmuc = loadall_category(); // Load danh mục để chọn khi thêm
                include "sanpham/add.php";
                break;

            case 'xoasp':
                if(isset($_GET['id']) && ($_GET['id']>0)){
                    delete_sanpham($_GET['id']);
                }
                // Xóa xong thì load lại danh sách
                $listsanpham = loadall_sanpham("", 0);
                include "sanpham/list.php";
                break;
            
          // ... (Sau case xoasp)

            case 'suasp':
                if(isset($_GET['id']) && ($_GET['id']>0)){
                    // Lấy thông tin sản phẩm cần sửa
                    $sp = loadone_sanpham($_GET['id']);
                }
                // Load danh mục để hiển thị trong select box
                $listdanhmuc = loadall_category();
                include "sanpham/update.php";
                break;

            case 'updatesp':
                if(isset($_POST['capnhat']) && ($_POST['capnhat'])){
                    $id = $_POST['id'];
                    $category_id = $_POST['category_id'];
                    $name = $_POST['name'];
                    $price = $_POST['price'];
                    $description = $_POST['description'];
                    
                    // Xử lý ảnh (nếu người dùng chọn ảnh mới)
                    $img = $_FILES['img']['name'];
                    $target_dir = "../img/";
                    $target_file = $target_dir . basename($_FILES["img"]["name"]);
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                        // Upload thành công
                    } else {
                        // Không có ảnh mới thì giữ nguyên ảnh cũ (model sẽ tự xử lý)
                    }

                    update_sanpham($id, $name, $price, $img, $description, $category_id);
                    $thongbao = "Cập nhật thành công!";
                }
                // Sửa xong thì quay lại danh sách
                $listdanhmuc = loadall_category();
                $listsanpham = loadall_sanpham("", 0); 
                include "sanpham/list.php";
                break;
                /* --- QUẢN LÝ ĐƠN HÀNG --- */
            case 'listdh':
                $kyw = isset($_POST['kyw']) ? $_POST['kyw'] : "";
                // Gọi hàm lấy danh sách đơn hàng
                $listbill = loadall_bill_admin($kyw, 0);
                include "donhang/list.php";
                break;
            
            case 'chitietdh':
                if(isset($_GET['id']) && ($_GET['id'] > 0)){
                    // Lấy thông tin chung của đơn hàng
                    $bill = loadone_bill($_GET['id']);
                    
                    // Lấy danh sách sản phẩm trong đơn hàng (Hàm này đã có trong model/bill.php)
                    $bill_detail = loadall_cart($_GET['id']);
                }
                include "donhang/detail.php";
                break;

            case 'suadh':
                if(isset($_GET['id']) && ($_GET['id'] > 0)){
                    $bill = loadone_bill($_GET['id']);
                }
                include "donhang/update.php";
                break;

            case 'updatedh':
                if(isset($_POST['capnhat']) && ($_POST['capnhat'])){
                    $ttdh = $_POST['ttdh']; // Lấy trạng thái mới
                    $id = $_POST['id'];
                    update_bill($id, $ttdh); // Cập nhật vào DB
                    $thongbao = "Cập nhật trạng thái thành công!";
                }
                // Quay lại danh sách
                $listbill = loadall_bill_admin("", 0);
                include "donhang/list.php";
                break;
                
            case 'xoadh':
                if(isset($_GET['id']) && ($_GET['id'] > 0)){
                    delete_bill($_GET['id']);
                }
                $listbill = loadall_bill_admin("", 0);
                include "donhang/list.php";
                break;

            /* 👇👇👇 CHÈN THÊM ĐOẠN NÀY VÀO ĐÂY 👇👇👇 */
            case 'thongke':
                include "thong-ke.php";
                break;
            /* 👆👆👆 ------------------------------ 👆👆👆 */

            case 'thoat':
                session_unset();
                header('Location: ../index.php');
                break;

            default:
                // Code trang chủ admin (Dashboard)
                $count_sp = count_sanpham();
                $count_bill = count_donhang();
                $count_kh = count_taikhoan();
                $sum_total = sum_doanhthu();
                
                include "home.php";
                break;
        }
    } else {
        // Code trang chủ admin (Khi mới vào)
        $count_sp = count_sanpham();
        $count_bill = count_donhang();
        $count_kh = count_taikhoan();
        $sum_total = sum_doanhthu();

        include "home.php";
    }

    echo '</div></body></html>';
?>