<main>
    <div class="container" style="width: 95%; margin: 20px auto;">
        
        <h2 style="text-align: center; font-size: 32px; font-weight: bold; margin-bottom: 30px; text-transform: uppercase; color: #b20000;">
            KHO PC WORKSTATION & GAMING
        </h2>

        <form action="index.php?act=products" method="post" style="text-align: center; margin-bottom: 40px;">
            <input type="text" name="keyword" placeholder="Nhập tên sản phẩm cần tìm..." style="padding: 10px; width: 400px; border: 1px solid #333; border-radius: 5px; background: #1a1a1a; color: #fff;">
            <button type="submit" name="timkiem" style="padding: 10px 20px; background: #d0021b; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
                <i class="fa-solid fa-magnifying-glass"></i> TÌM KIẾM
            </button>
        </form>
        <div class="top-section">
            <h3 class="top-title">🔥 TOP 5 CẤU HÌNH BÁN CHẠY 🔥</h3>
            <div class="product-row">
                <?php
                    // Lỗi loadall_product_home() đã được sửa bằng cách sử dụng $dssp (đã được load từ loadall_product)
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
                    // Dữ liệu đã được lọc/tìm kiếm trong Controller ($dssp)
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

