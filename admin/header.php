<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - DragonCore</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            /* BỘ MÀU DARK MODE */
            --primary-bg: #050505;      /* Nền chính đen tuyền */
            --sidebar-bg: #000000;      /* Nền sidebar đen */
            --card-bg: #111111;         /* Nền các ô thẻ/bảng */
            --text-color: #e0e0e0;      /* Chữ màu xám trắng */
            --border-color: #333333;    /* Viền xám mờ */
            --highlight: #d0021b;       /* Màu đỏ điểm nhấn */
            
            --header-height: 60px;
            --sidebar-width: 250px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Roboto', sans-serif; }
        
        body { 
            display: flex; min-height: 100vh; 
            background: var(--primary-bg); 
            color: var(--text-color); 
        }
        
        /* 1. SIDEBAR (CỘT TRÁI) */
        aside {
            width: var(--sidebar-width); 
            background-color: var(--sidebar-bg); 
            border-right: 1px solid var(--border-color);
            position: fixed; height: 100vh; top: 0; left: 0; z-index: 100;
        }
        .brand {
            height: var(--header-height); display: flex; align-items: center; padding-left: 20px;
            font-size: 18px; font-weight: bold; 
            background: linear-gradient(90deg, #b20000, #000); /* Hiệu ứng đỏ đen */
            color: #fff; text-transform: uppercase; letter-spacing: 1px;
            border-bottom: 1px solid var(--border-color);
        }
        .menu { list-style: none; margin-top: 20px; }
        .menu li a {
            display: flex; align-items: center; padding: 15px 25px; 
            color: #888; text-decoration: none; 
            border-left: 3px solid transparent; transition: 0.3s;
        }
        .menu li a:hover, .menu li a.active {
            background-color: #1a1a1a; 
            color: #fff; 
            border-left-color: var(--highlight); /* Viền đỏ khi chọn */
        }
        .menu li a i { margin-right: 15px; width: 20px; text-align: center; color: #555; }
        .menu li a:hover i, .menu li a.active i { color: var(--highlight); }

        /* 2. MAIN CONTENT (BÊN PHẢI) */
        .main-content {
            margin-left: var(--sidebar-width); flex: 1; display: flex; flex-direction: column; width: calc(100% - var(--sidebar-width));
        }
        header {
            height: var(--header-height); 
            background: var(--sidebar-bg); 
            border-bottom: 1px solid var(--border-color);
            display: flex; justify-content: space-between; align-items: center; padding: 0 30px;
        }
        .header-right a { color: #ccc; text-decoration: none; font-size: 13px; margin-left: 20px; transition: 0.3s; }
        .header-right a:hover { color: var(--highlight); }
        
        .container-fluid { padding: 30px; }

        /* 3. STYLE CHO CÁC THẺ CARD / BẢNG */
        .card-box {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;
        }
        .card {
            background: var(--card-bg); padding: 25px; border-radius: 5px;
            border: 1px solid var(--border-color);
            text-align: center; position: relative; overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.5);
        }
        .card:hover { border-color: var(--highlight); transform: translateY(-3px); transition: 0.3s; }

        .card p { font-size: 12px; color: #888; text-transform: uppercase; font-weight: bold; margin-bottom: 10px; }
        .card h3 { font-size: 32px; font-weight: bold; margin: 0; color: #fff; }
        
        /* Màu số liệu nổi bật trên nền đen */
        .text-green { color: #00e676 !important; } 
        .text-orange { color: #ff9100 !important; }
        .text-blue { color: #2979ff !important; } 
        .text-red { color: #ff1744 !important; }    

        /* 4. TITLE & TABLE */
        .page-title {
            font-size: 24px; font-weight: bold; color: #fff; text-transform: uppercase;
            margin-bottom: 25px; border-left: 5px solid var(--highlight); padding-left: 15px;
        }

        /* Style bảng dữ liệu (Table) dùng chung */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: var(--card-bg); border: 1px solid var(--border-color); }
        th { background: #1f1f1f; color: #fff; padding: 15px; text-align: left; border-bottom: 2px solid var(--highlight); font-size: 13px; text-transform: uppercase; }
        td { padding: 15px; border-bottom: 1px solid var(--border-color); color: #ccc; }
        tr:hover td { background: #1a1a1a; color: #fff; }
        
        /* Nút bấm */
        .btn-main { background: var(--highlight); color: #fff; padding: 8px 15px; border-radius: 3px; text-decoration: none; font-size: 13px; font-weight: bold; border: none; cursor: pointer; }
        .btn-main:hover { background: #b20000; }
    </style>
</head>
<body>
    <aside>
        <div class="brand"><i class="fa-solid fa-dragon" style="margin-right: 10px;"></i> DRAGON ADMIN</div>
        <ul class="menu">
            <li><a href="index.php" class="<?=(!isset($_GET['act']))?'active':''?>"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
            <li><a href="index.php?act=listdm" class="<?=(isset($_GET['act'])&&$_GET['act']=='listdm')?'active':''?>"><i class="fa-solid fa-folder"></i> Danh mục</a></li>
            <li><a href="index.php?act=listsp" class="<?=(isset($_GET['act'])&&$_GET['act']=='listsp')?'active':''?>"><i class="fa-solid fa-microchip"></i> Sản phẩm</a></li>
            <li><a href="index.php?act=listdh" class="<?=(isset($_GET['act'])&&$_GET['act']=='listdh')?'active':''?>"><i class="fa-solid fa-file-invoice-dollar"></i> Đơn hàng</a></li>
            <li><a href="index.php?act=dskh" class="<?=(isset($_GET['act'])&&$_GET['act']=='dskh')?'active':''?>"><i class="fa-solid fa-users"></i> Khách hàng</a></li>
        </ul>
    </aside>

    <div class="main-content">
        <header>
            <div style="font-weight: bold; color: #fff; text-transform: uppercase;">HỆ THỐNG QUẢN TRỊ</div>
            <div class="header-right">
                <span>Xin chào, <strong style="color: var(--highlight);"><?php echo isset($_SESSION['user']['user']) ? $_SESSION['user']['user'] : 'Admin'; ?></strong></span>
                <a href="../index.php" target="_blank"><i class="fa-solid fa-globe"></i> Xem Website</a>
                <a href="../index.php?act=thoat" style="color: #ff4d4d;"><i class="fa-solid fa-power-off"></i> Thoát</a>
            </div>
        </header>