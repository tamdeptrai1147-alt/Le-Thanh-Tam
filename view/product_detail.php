<main>
    <div class="container" style="width: 1200px; margin: 40px auto; background: #fff; padding: 0; color: #333;"> 
        
        <div class="detail-wrapper">
            <div class="detail-left">
                <div class="main-img-box">
                    <?php $img_path = "img/" . $img; ?>
                    <img src="<?php echo $img_path; ?>" alt="<?php echo $name; ?>" id="mainImage">
                </div>
                
                <div class="thumb-list">
                    <div class="thumb-item active"><img src="<?php echo $img_path; ?>"></div>
                    <div class="thumb-item"><img src="<?php echo $img_path; ?>"></div> <div class="thumb-item"><img src="<?php echo $img_path; ?>"></div>
                </div>
            </div>

            <div class="detail-right">
                <h1 class="product-title"><?php echo $name; ?></h1>
                
                <div class="meta-info">
                    <p>Mã sp: <span style="color: #555;">DC-<?php echo $id; ?></span></p>
                    <p>Bảo hành: <span style="color: #d0021b;">Linh kiện</span></p>
                    <p>Tình trạng: <span style="color: #28a745; font-weight: bold;">Còn hàng</span></p>
                </div>

                <div class="option-group">
                    <div class="option-box active">
                        <span class="opt-name"><?php echo $name; ?></span>
                        <span class="opt-price"><?php echo number_format($price); ?>đ</span>
                    </div>
                    <div class="option-box">
                        <span class="opt-name">BẢN NÂNG CẤP CASE TRẮNG</span>
                        <span class="opt-price" style="color:#d0021b;"><?php echo number_format($price + 1000000); ?>đ</span>
                    </div>
                </div>

                <div class="gift-section">
                    <div class="gift-header">
                        <i class="fa-solid fa-gift"></i> Quà tặng và ưu đãi kèm theo
                    </div>
                    <ul class="gift-list">
                        <li>* Tặng ngay Bộ phím chuột và Bàn di chuột Full Size khi mua kèm Màn Hình Máy Tính</li>
                        <li>* Tặng ngay USB cài win đã update sẵn bản Win</li>
                        <li>* Giảm ngay 100.000đ khi mua thêm RAM / SSD/ Màn hình thứ 2</li>
                        <li>* Cài đặt phần mềm và Giao hàng hoàn toàn miễn phí</li>
                    </ul>
                </div>

                <form action="index.php?act=addtocart" method="post" class="action-buttons">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="img" value="<?php echo $img; ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <input type="hidden" name="soluong" value="1">

                    <button type="submit" name="addtocart" class="btn-buy-now">
                        ĐẶT MUA HÀNG
                        <span>Giao hàng tận nơi nhanh chóng</span>
                    </button>

                    <div class="btn-row-bottom">
                        <button type="submit" name="addtocart" class="btn-add-cart-black">
                            THÊM VÀO GIỎ HÀNG
                            <span>Thêm vào giỏ hàng để chọn tiếp</span>
                        </button>
                        
                        <button type="button" class="btn-installment-gray">
                            MUA TRẢ GÓP
                            <span>Lãi suất 0% qua thẻ tín dụng</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
        
        <div class="product-info-zone" style="display: flex; gap: 30px; padding: 30px 20px 50px 20px; border-top: 5px solid #eee; margin-top: 30px;">
            
            <div class="info-main" style="flex: 2;">
                <h3 style="text-transform: uppercase; margin-bottom: 20px; color: #000; border-left: 5px solid #d0021b; padding-left: 10px;">
                    Thông tin sản phẩm
                </h3>
                
                <div class="detail-description" style="line-height: 1.8; color: #333; padding: 0 10px;">
                    <p style="color: #333; margin-bottom: 20px;">
                        PC Đồ Họa INTEL CORE I7 14700K/ 32GB/ RTX 4080 SUPER 16GB là cỗ máy hoàn hảo cho các tác vụ Rendering nặng, thiết kế 3D chuyên nghiệp và Gaming 4K/8K.
                    </p>
                    
                    <?php 
                        // Sửa lỗi: Nếu $description chưa được định nghĩa
                        if(isset($description)){
                            echo '<p style="color: #333;">'.$description.'</p>';
                        } else {
                            echo '<p style="color: #333;">Thông tin chi tiết sản phẩm đang được cập nhật.</p>';
                        }
                    ?>
                    
                    <div style="text-align: center; margin: 20px 0;">
                        <?php 
                            $img_detail_path = "img/pc_mau.png"; 
                            if(is_file($img_detail_path)){
                                echo "<img src='".$img_detail_path."' alt='PC Demo' style='max-width: 80%; height: auto; border-radius: 8px;'>";
                            }
                        ?>
                    </div>
                    
                    <p style="color: #333;">
                        Với cấu hình mạnh mẽ và thiết kế tối ưu, đây là lựa chọn hàng đầu cho các chuyên gia đồ họa và game thủ.
                    </p>
                </div>
            </div>
            
            <div class="info-sidebar" style="flex: 1;">
                
                <div class="tech-specs-box" style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 30px; border: 1px solid #ddd; color: #333;">
                    <h3 style="text-transform: uppercase; margin-bottom: 15px; color: #000; font-size: 16px;">
                        Thông số kỹ thuật
                    </h3>
                    
                    <table style="width: 100%; font-size: 13px; color: #333;">
                        <tr style="background: #fff;">
                            <td style="padding: 8px; font-weight: bold; width: 40%; color: #333;">CPU</td>
                            <td style="padding: 8px; color: #333;">Intel Core i7 14700K</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px; font-weight: bold; color: #333;">VGA</td>
                            <td style="padding: 8px; color: #333;">NVIDIA RTX 4080 SUPER 16GB</td>
                        </tr>
                        <tr style="background: #fff;">
                            <td style="padding: 8px; font-weight: bold; color: #333;">RAM</td>
                            <td style="padding: 8px; color: #333;">32GB DDR5 Bus 6000MHz</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px; font-weight: bold; color: #333;">Ổ cứng</td>
                            <td style="padding: 8px; color: #333;">1TB SSD NVMe Gen 4</td>
                        </tr>
                    </table>
                </div>

                <div class="related-products">
                    <h3 style="text-transform: uppercase; margin-bottom: 15px; color: #000; font-size: 16px;">
                        Sản phẩm tương tự
                    </h3>
                    <div class="related-list">
                        <?php
                            if(isset($sp_cungloai) && is_array($sp_cungloai) && count($sp_cungloai) > 0) {
                                foreach($sp_cungloai as $sp_cl) {
                                    extract($sp_cl);
                                    $linksp = "index.php?act=product_detail&id=".$id;
                                    $img_cl_path = "img/" . $img;
                                    echo '
                                    <div class="related-item" style="display: flex; gap: 10px; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #eee;">
                                        <div style="width: 80px;">
                                            <a href="'.$linksp.'"><img src="'.$img_cl_path.'" alt="'.$name.'" style="width: 100%; height: 80px; object-fit: contain; border: 1px solid #ddd;"></a>
                                        </div>
                                        <div style="flex: 1;">
                                            <a href="'.$linksp.'" style="font-size: 14px; color: #333; font-weight: bold; display: block; margin-bottom: 5px;">'.$name.'</a>
                                            <span style="color: #d0021b; font-weight: bold; font-size: 15px;">'.number_format($price).' đ</span>
                                        </div>
                                    </div>';
                                }
                            } else {
                                echo '<p style="font-size: 14px; color: #777;">Không có sản phẩm tương tự.</p>';
                            }
                        ?>
                    </div>
                </div>
                
            </div>
            
        </div>
        <div style="padding: 20px; border-top: 1px solid #ddd; margin-top: 30px;">
            <h3 style="text-transform: uppercase; margin-bottom: 15px; color: #000; font-size: 18px;">Bình luận</h3>
            <div style="background: #f1f1f1; padding: 15px; border-radius: 5px;">
                <input type="text" placeholder="Nhập bình luận của bạn..." style="width: 80%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; color: #333; background: #fff;">
                <button style="background: #d0021b; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer;">Gửi</button>
            </div>
        </div>
        
        <div class="viewed-products-zone" style="padding: 30px 20px 50px 20px; border-top: 5px solid #eee; margin-top: 30px;">
            <h3 style="text-transform: uppercase; margin-bottom: 25px; color: #000; font-size: 18px;">
                Sản phẩm đã xem
            </h3>
            
            <div class="product-row" style="display: flex; gap: 20px; justify-content: flex-start;">
                <?php
                    // BẮT BUỘC: Kiểm tra $sp_da_xem có tồn tại và là mảng không
                    if(isset($sp_da_xem) && is_array($sp_da_xem) && count($sp_da_xem) > 0) {
                        
                        foreach($sp_da_xem as $sp_dx){
                            // Khởi tạo lại biến cho mỗi sản phẩm đã xem
                            $id = $sp_dx['id'];
                            $name = $sp_dx['name'];
                            $img = $sp_dx['img'];
                            $price = $sp_dx['price'];
                            
                            $linksp = "index.php?act=product_detail&id=".$id;
                            $img_path = "img/" . $img;
                            $old_price = $price * 1.1;

                            echo '
                            <div class="pc-card" style="width: 200px; background: #f9f9f9; border: 1px solid #ddd; padding: 10px; border-radius: 5px; text-align: center;">
                                <div class="img-box" style="height: 150px;">
                                    <a href="'.$linksp.'"><img src="'.$img_path.'" alt="'.$name.'" style="width: 100%; height: 100%; object-fit: contain;"></a>
                                </div>
                                <div class="pc-info" style="margin-top: 10px;">
                                    <a href="'.$linksp.'" class="pc-name" style="font-size: 14px; font-weight: bold; color: #333;">'.$name.'</a>
                                    <div class="price-group" style="margin-top: 5px;">
                                        <del style="font-size: 12px; color: #888;">'.number_format($old_price).' đ</del>
                                        <span class="price-new" style="font-size: 16px; color: #d0021b; font-weight: bold;">'.number_format($price).' đ</span>
                                    </div>
                                </div>
                            </div>';
                        }
                    } else {
                         echo '<p style="font-size: 14px; color: #777;">Chưa có sản phẩm nào được xem gần đây. Hãy xem thêm sản phẩm!</p>';
                    }
                ?>
            </div>
        </div>
        </div>
</main>