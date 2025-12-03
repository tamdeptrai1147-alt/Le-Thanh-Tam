<main>
    <div class="container" style="width: 95%; margin: 20px auto;">
        
        <h2 style="text-align: center; font-size: 32px; font-weight: bold; margin-bottom: 30px; text-transform: uppercase; color: #b20000;">
            KHO PC WORKSTATION & GAMING
        </h2>

        <div class="top-section">
            <h3 class="top-title">🔥 TOP 5 CẤU HÌNH BÁN CHẠY 🔥</h3>
            <div class="product-row">
                <?php
                    $top5 = array_slice($dssp, 0, 5);
                    foreach($top5 as $sp){
                        extract($sp);
                        $linksp = "index.php?act=product_detail&id=".$id;
                        $img_path = "img/" . $img;
                        $old_price = $price * 1.15; 

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
                                <form action="index.php?act=addtocart" method="post" style="width: 100%;">
                                    <input type="hidden" name="id" value="'.$id.'">
                                    <input type="hidden" name="name" value="'.$name.'">
                                    <input type="hidden" name="img" value="'.$img.'">
                                    <input type="hidden" name="price" value="'.$price.'">
                                    
                                    <button type="submit" name="addtocart" class="btn-add-cart">
                                        <i class="fa-solid fa-cart-plus"></i> THÊM VÀO GIỎ
                                    </button>
                                </form>
                            </div>
                        </div>';
                    }
                ?>
            </div>
        </div>

        <div class="main-list">
            <h3 style="margin: 30px 0 20px 0; font-weight: bold; border-left: 5px solid #b20000; padding-left: 10px; color: #fff;">
                DANH SÁCH LINH KIỆN & PC
            </h3>
            
            <div class="product-row wrap-row">
                <?php
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
                                <form action="index.php?act=addtocart" method="post" style="width: 100%;">
                                    <input type="hidden" name="id" value="'.$id.'">
                                    <input type="hidden" name="name" value="'.$name.'">
                                    <input type="hidden" name="img" value="'.$img.'">
                                    <input type="hidden" name="price" value="'.$price.'">
                                    
                                    <button type="submit" name="addtocart" class="btn-add-cart">
                                        <i class="fa-solid fa-cart-plus"></i> THÊM VÀO GIỎ
                                    </button>
                                </form>
                            </div>
                        </div>';
                    }
                ?>
            </div>
        </div>

    </div>
</main>

<style>
    /* CSS Nút Thêm vào giỏ (Dán đè vào đây cho chắc) */
    .btn-add-cart {
        background-color: #d0021b;
        color: #fff;
        border: none;
        width: 100%;
        padding: 10px 0;
        font-size: 13px;
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 4px;
        cursor: pointer;
        transition: 0.3s;
        display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .btn-add-cart:hover {
        background-color: #ff0000;
        box-shadow: 0 0 10px rgba(255, 0, 0, 0.4);
        transform: translateY(-2px);
    }
    /* Các CSS khác giữ nguyên */
    .top-section { background-color: #3e3333; padding: 30px; border-radius: 10px; margin-bottom: 40px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); }
    .top-title { color: #fff; text-align: center; margin-bottom: 25px; font-size: 20px; text-transform: uppercase; letter-spacing: 1px; }
    .product-row { display: flex; justify-content: flex-start; gap: 1.2%; }
    .wrap-row { flex-wrap: wrap; } 
    .mb-20 { margin-bottom: 20px; }
    .pc-card { background: #111; border: 1px solid #333; width: 19%; padding: 10px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.5); display: flex; flex-direction: column; justify-content: space-between; transition: 0.3s; }
    .pc-card:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(200,0,0,0.2); border-color: #b20000; }
    .img-box { position: relative; margin-bottom: 10px; overflow: hidden; }
    .pc-card img { width: 100%; height: 160px; object-fit: contain; transition: 0.5s; background: #fff; padding: 5px; border-radius: 3px; }
    .pc-card:hover img { transform: scale(1.05); }
    .discount-badge { position: absolute; top: 0; right: 0; background: #d0021b; color: white; padding: 2px 6px; font-size: 11px; border-radius: 3px; font-weight: bold; }
    .pc-name { display: block; font-size: 13px; font-weight: bold; color: #eee; height: 38px; overflow: hidden; margin-bottom: 5px; text-transform: uppercase; }
    .pc-name:hover { color: #b20000; }
    .price-group del { font-size: 12px; color: #888; }
    .price-new { font-size: 16px; color: #d0021b; font-weight: bold; display: block; }
    .pc-action { margin-top: 10px; }
</style>