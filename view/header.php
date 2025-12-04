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

                <li><a href="index.php?act=giai_phap">Giải pháp</a></li>
                <li><a href="index.php?act=tintuc">Tin Tức</a></li>
                <li><a href="index.php?act=lienhe">Liên hệ</a></li>
                
            </ul>
        </nav>

        <div class="header-icons">
            <a href="#"><i class="fa-solid fa-magnifying-glass"></i></a> 
            <a href="index.php?act=viewcart"><i class="fa-solid fa-cart-shopping"></i></a> 

            <div class="box-user">
                <i class="fa-regular fa-user" style="font-size: 18px;"></i>
                
                <?php if(isset($_SESSION['user'])) echo '<span style="font-size:13px; margin-left:5px; font-weight:bold;">'.$_SESSION['user']['user'].'</span>'; ?>

                <div class="user-dropdown">
                    <?php if(isset($_SESSION['user'])){ ?>
                        <a href="index.php?act=mybill"><i class="fa-solid fa-receipt"></i> Đơn hàng</a>
                        <a href="index.php?act=thongtin"><i class="fa-solid fa-user-gear"></i> Tài khoản</a>
                        <a href="index.php?act=thoat" class="logout"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
                    <?php } else { ?>
                        <a href="index.php?act=dangnhap"><i class="fa-solid fa-arrow-right-to-bracket"></i> Đăng nhập</a>
                        <a href="index.php?act=dangky"><i class="fa-solid fa-user-plus"></i> Đăng ký</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>