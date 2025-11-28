<main>
    <div class="container" style="width: 95%; margin: 20px auto;">
        
        <h2 style="text-align: center; font-size: 32px; font-weight: bold; margin-bottom: 30px; text-transform: uppercase; color: #b20000;">
            KHO PC WORKSTATION & GAMING
        </h2>

        <div class="top-section">
            <h3 class="top-title">🔥 TOP 5 CẤU HÌNH BÁN CHẠY 🔥</h3>
            <div class="product-row">
                <?php
                    // Lấy 5 sản phẩm đầu tiên làm nổi bật
                    $top5 = array_slice($dssp, 0, 5);
                    foreach($top5 as $sp){
                        extract($sp);
                        $linksp = "index.php?act=product_detail&id=".$id;
                        $img_path = "img/" . $img;
                        $old_price = $price * 1.15; // Giá ảo cao hơn 15%

                        echo '
                        <div class="pc-card">
                            <div class="img-box">
                                <a href="'.$linksp.'"><img src="'.$img_path.'" alt="'.$name.'"></a>
                                <span class="discount-badge">HOT</span>
                            </div>
                            <div class="pc-info">
                                <a href="'.$linksp.'" class="pc-name">'.$name.'</a>
                                <div class="price-group">
                                    <del>'.number_format($old_price).' đ</del>
                                    <span class="price-new">'.number_format($price).' đ</span>
                                </div>
                            </div>
                            <div class="pc-action">
                                <form action="index.php?act=addtocart" method="post" style="flex:1;">
                                    <input type="hidden" name="id" value="'.$id.'">
                                    <input type="hidden" name="name" value="'.$name.'">
                                    <input type="hidden" name="img" value="'.$img.'">
                                    <input type="hidden" name="price" value="'.$price.'">
                                    <input type="submit" value="Mua Ngay" class="btn-buy">
                                </form>
                                <a href="'.$linksp.'" class="btn-detail">Chi Tiết</a>
                            </div>
                        </div>';
                    }
                ?>
            </div>
        </div>

        <div class="main-list">
            <h3 style="margin: 30px 0 20px 0; font-weight: bold; border-left: 5px solid #b20000; padding-left: 10px;">
                DANH SÁCH LINH KIỆN & PC
            </h3>
            
            <div class="product-row wrap-row">
                <?php
                    // Hiển thị tất cả sản phẩm
                    foreach($dssp as $sp){
                        extract($sp);
                        $linksp = "index.php?act=product_detail&id=".$id;
                        $img_path = "img/" . $img;
                        $old_price = $price * 1.1;

                        echo '
                        <div class="pc-card mb-20">
                            <div class="img-box">
                                <a href="'.$linksp.'"><img src="'.$img_path.'" alt="'.$name.'"></a>
                                <span class="discount-badge">-10%</span>
                            </div>
                            <div class="pc-info">
                                <a href="'.$linksp.'" class="pc-name">'.$name.'</a>
                                <div class="price-group">
                                    <del>'.number_format($old_price).' đ</del>
                                    <span class="price-new">'.number_format($price).' đ</span>
                                </div>
                            </div>
                            <div class="pc-action">
                                <form action="index.php?act=addtocart" method="post" style="flex:1;">
                                    <input type="hidden" name="id" value="'.$id.'">
                                    <input type="hidden" name="name" value="'.$name.'">
                                    <input type="hidden" name="img" value="'.$img.'">
                                    <input type="hidden" name="price" value="'.$price.'">
                                    <input type="submit" value="Mua Ngay" class="btn-buy">
                                </form>
                                <a href="'.$linksp.'" class="btn-detail">Chi Tiết</a>
                            </div>
                        </div>';
                    }
                ?>
            </div>
        </div>

    </div>
</main>

<style>
    /* Khung Nâu Đen ở trên */
    .top-section {
        background-color: #3e3333; /* Màu nâu đen */
        padding: 30px;
        border-radius: 10px;
        margin-bottom: 40px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    .top-title { color: #fff; text-align: center; margin-bottom: 25px; font-size: 20px; text-transform: uppercase; letter-spacing: 1px; }

    /* Dàn trang Flexbox */
    .product-row {
        display: flex;
        justify-content: flex-start; /* Xếp từ trái qua phải */
        gap: 1.2%; /* Khoảng cách nhỏ */
    }
    .wrap-row { flex-wrap: wrap; } 
    .mb-20 { margin-bottom: 20px; }

    /* Thẻ Sản Phẩm - CHIA 5 CỘT */
    .pc-card {
        background: #fff;
        width: 19%; /* 19% x 5 = 95% + khoảng hở là vừa đẹp */
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        display: flex; flex-direction: column; justify-content: space-between;
        transition: 0.3s;
        border: 1px solid #eee;
    }
    .pc-card:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); border-color: #b20000; }

    /* Ảnh & Info */
    .img-box { position: relative; margin-bottom: 10px; overflow: hidden; }
    .pc-card img { width: 100%; height: 160px; object-fit: contain; transition: 0.5s; }
    .pc-card:hover img { transform: scale(1.05); } /* Rê chuột vào ảnh phóng to xíu */
    
    .discount-badge { position: absolute; top: 0; right: 0; background: #d0021b; color: white; padding: 2px 6px; font-size: 11px; border-radius: 3px; font-weight: bold; }
    
    .pc-name { display: block; font-size: 13px; font-weight: bold; color: #333; height: 38px; overflow: hidden; margin-bottom: 5px; text-transform: uppercase; }
    .pc-name:hover { color: #b20000; }
    
    .price-group del { font-size: 12px; color: #999; }
    .price-new { font-size: 16px; color: #d0021b; font-weight: bold; display: block; }

    /* Nút bấm đỏ */
    .pc-action { display: flex; gap: 5px; margin-top: 10px; }
    .btn-buy, .btn-detail {
        background: #b22222; color: #fff; border: none; padding: 6px 0;
        width: 100%; display: block; text-align: center;
        font-size: 11px; font-weight: bold; border-radius: 3px; cursor: pointer; transition: 0.3s;
    }
    .btn-buy:hover, .btn-detail:hover { background: #ff0000; }
</style>