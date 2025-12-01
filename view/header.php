<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dragon Core Gaming</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php">DRAGON CORE</a>
        </div>

        <nav>
            <ul>
                <li><a href="index.php">Trang chủ</a></li>
                
                <li class="has-mega-menu">
                    <a href="index.php?act=products">LINH KIỆN PC <i class="fa-solid fa-chevron-down" style="font-size: 10px;"></i></a>
                    <div class="mega-menu">
                        <div class="mega-content">
                            <div class="mega-col">
                                <h3>VI XỬ LÝ & MAIN</h3>
                                <ul>
                                    <li><a href="#">CPU - Bộ vi xử lý</a></li>
                                    <li><a href="#">MAINBOARD - Bo mạch chủ</a></li>
                                </ul>
                            </div>
                            <div class="mega-col">
                                <h3>BỘ NHỚ & LƯU TRỮ</h3>
                                <ul>
                                    <li><a href="#">RAM - Bộ nhớ trong</a></li>
                                    <li><a href="#">SSD - Ổ cứng thể rắn</a></li>
                                </ul>
                            </div>
                            <div class="mega-col">
                                <h3>ĐỒ HỌA & MÀN HÌNH</h3>
                                <ul>
                                    <li><a href="#">VGA - Card Màn Hình</a></li>
                                    <li><a href="#">LCD - Màn hình</a></li>
                                </ul>
                            </div>
                            <div class="mega-col">
                                <h3>NGUỒN & CASE</h3>
                                <ul>
                                    <li><a href="#">PSU - Nguồn máy tính</a></li>
                                    <li><a href="#">CASE - Vỏ máy tính</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>

                <li><a href="#">Giải pháp</a></li>
                <li><a href="#">Tin tức</a></li>
                <li><a href="#">Liên hệ</a></li>
            </ul>
        </nav>

        <div class="header-icons">
            <a href="#"><i class="fa-solid fa-magnifying-glass"></i></a> 
            <a href="index.php?act=viewcart"><i class="fa-solid fa-cart-shopping"></i></a> 
            
            <?php 
            // Kiểm tra đã đăng nhập chưa để hiện tên hoặc nút đăng nhập
            if(isset($_SESSION['user']) && is_array($_SESSION['user']) && isset($_SESSION['user']['user'])){
                echo '<a href="index.php?act=thongtin"><i class="fa-regular fa-user"></i> Xin chào <strong>'.$_SESSION['user']['user'].'</strong></a>';
                echo '<a href="index.php?act=thoat" style="color: #b20000; font-weight: bold; margin-left: 10px;">Đăng xuất</a>';
          // ... đoạn if(isset($_SESSION['user'])... giữ nguyên

            } else {
                // Tách ra 2 link riêng biệt cho dễ bấm
                echo '<i class="fa-regular fa-user" style="margin-right: 5px;"></i>';
                echo '<a href="index.php?act=dangnhap" style="font-weight:bold;">Đăng nhập</a>';
                echo ' <span style="color:#fff">/</span> ';
                echo '<a href="index.php?act=dangky" style="font-weight:bold;">Đăng ký</a>';
            }
            ?>
        </div>
    </header>