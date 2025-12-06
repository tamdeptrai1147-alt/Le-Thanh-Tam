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
                    <li><a href="index.php?act=products&iddm=1">CPU - Bộ vi xử lý</a></li>
                    <li><a href="index.php?act=products&iddm=2">MAINBOARD - Bo mạch chủ</a></li>
                </ul>
            </div>
            <div class="mega-col">
                <h3>BỘ NHỚ & LƯU TRỮ</h3>
                <ul>
                    <li><a href="index.php?act=products&iddm=3">RAM - Bộ nhớ trong</a></li>
                    <li><a href="index.php?act=products&iddm=4">SSD - Ổ cứng thể rắn</a></li>
                </ul>
            </div>
            <div class="mega-col">
                <h3>ĐỒ HỌA & MÀN HÌNH</h3>
                <ul>
                    <li><a href="index.php?act=products&iddm=5">VGA - Card Màn Hình</a></li>
                    <li><a href="index.php?act=products&iddm=6">LCD - Màn hình</a></li>
                </ul>
            </div>
            <div class="mega-col">
                <h3>NGUỒN & CASE</h3>
                <ul>
                    <li><a href="index.php?act=products&iddm=7">PSU - Nguồn máy tính</a></li>
                    <li><a href="index.php?act=products&iddm=8">CASE - Vỏ máy tính</a></li>
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
            
            <form action="index.php?act=products" method="post" class="search-form">
                <input type="text" name="kyw" placeholder="Tìm sản phẩm...">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>

            <a href="index.php?act=viewcart" class="cart-btn">
                <i class="fa-solid fa-cart-shopping"></i>
                <?php 
                    $count_cart = isset($_SESSION['mycart']) ? count($_SESSION['mycart']) : 0;
                    if($count_cart > 0) echo '<span class="cart-count">'.$count_cart.'</span>';
                ?>
            </a> 

            <div class="box-user">
                <i class="fa-regular fa-user" style="font-size: 20px;"></i>
                <?php if(isset($_SESSION['user'])) echo '<span style="font-size:13px; margin-left:5px; font-weight:bold;">'.$_SESSION['user']['user'].'</span>'; ?>
                
                <div class="user-dropdown">
                    <?php if(isset($_SESSION['user'])){ ?>
                        <?php if($_SESSION['user']['role'] == 1){ ?>
                            <a href="admin/index.php" target="_blank" style="color: #ff3333; font-weight: bold; border-bottom: 1px dashed #444;">
                                <i class="fa-solid fa-user-secret"></i> Trang Quản Trị
                            </a>
                        <?php } ?>
                        <a href="index.php?act=mybill"><i class="fa-solid fa-receipt"></i> Đơn hàng</a>
                        <a href="index.php?act=edit_taikhoan"><i class="fa-solid fa-user-gear"></i> Tài khoản</a>
                        <a href="index.php?act=thoat" class="logout"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
                    <?php } else { ?>
                        <a href="index.php?act=dangnhap"><i class="fa-solid fa-arrow-right-to-bracket"></i> Đăng nhập</a>
                        <a href="index.php?act=dangky"><i class="fa-solid fa-user-plus"></i> Đăng ký</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>