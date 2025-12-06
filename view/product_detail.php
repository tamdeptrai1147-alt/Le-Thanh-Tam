<main>
    <div class="container" style="width: 1200px; margin: 40px auto; background: #fff; padding: 0; color: #333;"> 
        
        <div class="detail-wrapper" style="display: flex; gap: 30px; padding: 20px;">
            <div class="detail-left" style="flex: 4;">
                <div class="main-img-box" style="border: 1px solid #eee; border-radius: 5px; overflow: hidden; text-align: center; padding: 10px;">
                    <?php $img_path = "img/" . $img; ?>
                    <img src="<?php echo $img_path; ?>" alt="<?php echo $name; ?>" style="max-width: 100%; height: auto; object-fit: contain;">
                </div>
            </div>

            <div class="detail-right" style="flex: 5;">
                <h1 class="product-title" style="font-size: 26px; font-weight: bold; text-transform: uppercase; margin-bottom: 15px; color: #000; line-height: 1.4;"><?php echo $name; ?></h1>
                
                <div class="meta-info" style="font-size: 14px; margin-bottom: 20px; color: #666; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                    <span style="margin-right: 20px;">Mã SP: <strong style="color: #333;">DC-<?php echo $id; ?></strong></span>
                    <span style="margin-right: 20px;">Lượt xem: <strong><?php echo $view; ?></strong></span>
                    <span>Tình trạng: <span style="color: #28a745; font-weight: bold;"><i class="fa-solid fa-check"></i> Còn hàng</span></span>
                </div>

                <div class="price-box" style="margin-bottom: 25px; background: #fafafa; padding: 15px; border-radius: 5px;">
                     <span style="font-size: 32px; color: #d0021b; font-weight: bold;"><?php echo number_format($price); ?> đ</span>
                     <span style="margin-left: 10px; color: #999; text-decoration: line-through;">
                        <?php echo number_format($price * 1.15); ?> đ
                     </span>
                </div>

                <div style="margin-bottom: 25px; border: 1px dashed #d0021b; padding: 15px; border-radius: 5px;">
                    <div style="font-weight: bold; color: #d0021b; margin-bottom: 10px; text-transform: uppercase;">
                        <i class="fa-solid fa-gift"></i> Khuyến mãi - Ưu đãi
                    </div>
                    <ul style="list-style: none; padding: 0; font-size: 14px;">
                        <li style="margin-bottom: 5px;"><i class="fa-solid fa-check-circle" style="color: green;"></i> Miễn phí vận chuyển toàn quốc</li>
                        <li style="margin-bottom: 5px;"><i class="fa-solid fa-check-circle" style="color: green;"></i> Bảo hành chính hãng 36 tháng</li>
                        <li style="margin-bottom: 5px;"><i class="fa-solid fa-check-circle" style="color: green;"></i> Hỗ trợ trả góp 0% lãi suất</li>
                    </ul>
                </div>

                <form action="index.php?act=addtocart" method="post" style="display: flex; gap: 10px;">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="img" value="<?php echo $img; ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <input type="hidden" name="soluong" value="1">

                    <button type="submit" name="addtocart" class="btn-buy-now" style="flex: 1; background: #d0021b; color: #fff; border: none; padding: 15px; font-weight: bold; font-size: 18px; border-radius: 5px; cursor: pointer; text-transform: uppercase; transition: 0.3s;">
                        ĐẶT MUA NGAY
                        <span style="display: block; font-size: 12px; font-weight: normal; margin-top: 5px; text-transform: none;">Giao hàng tận nơi hoặc nhận tại cửa hàng</span>
                    </button>
                    
                    <button type="submit" name="addtocart" style="width: 60px; background: #fff; color: #d0021b; border: 2px solid #d0021b; border-radius: 5px; cursor: pointer; font-size: 24px;">
                        <i class="fa-solid fa-cart-plus"></i>
                    </button>
                </form>
            </div>
        </div>
        
        <div class="product-info-zone" style="display: flex; gap: 40px; padding: 40px 20px; border-top: 5px solid #f5f5f5; margin-top: 20px;">
            
            <div class="info-main" style="flex: 7;">
                
                <h3 style="font-size: 24px; font-weight: bold; text-transform: uppercase; margin-bottom: 25px; display: flex; align-items: center;">
                    <span style="display: inline-block; width: 6px; height: 30px; background-color: #d0021b; margin-right: 15px;"></span>
                    <span style="color: #333;">ĐẶC ĐIỂM NỔI BẬT</span>
                </h3>
                
                <div class="detail-description" style="line-height: 1.8; color: #444; text-align: justify; font-size: 16px; margin-bottom: 40px;">
                    <?php 
                        if(isset($description) && !empty($description)){
                            echo nl2br($description); 
                        } else {
                            echo '<p>Sản phẩm này sở hữu cấu hình mạnh mẽ, đáp ứng tốt nhu cầu làm việc và giải trí của bạn.</p>';
                        }
                    ?>
                </div>

                <h3 style="font-size: 24px; font-weight: bold; text-transform: uppercase; margin-bottom: 25px; display: flex; align-items: center;">
                    <span style="display: inline-block; width: 6px; height: 30px; background-color: #d0021b; margin-right: 15px;"></span>
                    <span style="color: #333;">HIỆU NĂNG VƯỢT TRỘI</span>
                </h3>
                <div style="margin-bottom: 40px; font-size: 16px; color: #444; line-height: 1.8;">
                    <p>Sản phẩm được trang bị những linh kiện thế hệ mới nhất, đảm bảo tốc độ xử lý nhanh chóng cho mọi tác vụ từ cơ bản đến nâng cao. Khả năng đa nhiệm mượt mà giúp bạn thoải mái làm việc với nhiều ứng dụng cùng lúc.</p>
                    <div style="margin-top: 20px; text-align: center;">
                        <img src="img/giaiphap1.jpg" style="max-width: 100%; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                        <p style="font-size: 13px; color: #888; margin-top: 10px;"><i>Trải nghiệm hiệu năng đỉnh cao với Dragon Core</i></p>
                    </div>
                </div>

                <h3 style="font-size: 24px; font-weight: bold; text-transform: uppercase; margin-bottom: 25px; display: flex; align-items: center;">
                    <span style="display: inline-block; width: 6px; height: 30px; background-color: #d0021b; margin-right: 15px;"></span>
                    <span style="color: #333;">THIẾT KẾ & TẢN NHIỆT</span>
                </h3>
                <div style="margin-bottom: 40px; font-size: 16px; color: #444; line-height: 1.8;">
                    <p>Hệ thống tản nhiệt được tối ưu hóa luồng khí (Air Flow) giúp máy luôn mát mẻ trong quá trình hoạt động dài. Thiết kế hiện đại, dải đèn LED RGB cá tính tạo điểm nhấn cho góc làm việc của bạn.</p>
                    <div style="margin-top: 20px; text-align: center;">
                        <img src="img/giaiphap2.png" style="max-width: 100%; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    </div>
                </div>

            </div>
            
            <div class="info-sidebar" style="flex: 3;">
                
                <div style="background: #fdfdfd; border: 1px solid #eee; border-radius: 8px; padding: 20px; margin-bottom: 30px;">
                    <h4 style="margin-top: 0; text-transform: uppercase; border-bottom: 2px solid #d0021b; padding-bottom: 10px; display: inline-block; margin-bottom: 15px;">
                        Thông số tóm tắt
                    </h4>
                    <ul style="list-style: none; padding: 0; font-size: 14px; color: #555;">
                        <li style="padding: 8px 0; border-bottom: 1px dashed #ddd;"><strong>Sản phẩm:</strong> <?php echo $name; ?></li>
                        <li style="padding: 8px 0; border-bottom: 1px dashed #ddd;"><strong>Tình trạng:</strong> Mới 100%</li>
                        <li style="padding: 8px 0; border-bottom: 1px dashed #ddd;"><strong>Bảo hành:</strong> 36 Tháng</li>
                        <li style="padding: 8px 0;"><strong>Xuất xứ:</strong> Chính hãng</li>
                    </ul>
                </div>

                <h3 style="text-transform: uppercase; margin-bottom: 20px; color: #333; font-size: 18px; font-weight: bold; border-left: 4px solid #d0021b; padding-left: 10px;">
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
                                <div class="related-item" style="display: flex; gap: 10px; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
                                    <div style="width: 80px; height: 80px; border: 1px solid #eee; padding: 2px; flex-shrink: 0; border-radius: 5px;">
                                        <a href="'.$linksp.'"><img src="'.$img_cl_path.'" alt="'.$name.'" style="width: 100%; height: 100%; object-fit: contain;"></a>
                                    </div>
                                    <div style="flex: 1;">
                                        <a href="'.$linksp.'" style="font-size: 14px; color: #333; font-weight: bold; display: block; margin-bottom: 5px; line-height: 1.3; text-decoration: none;">'.$name.'</a>
                                        <span style="color: #d0021b; font-weight: bold; font-size: 15px;">'.number_format($price).' đ</span>
                                    </div>
                                </div>';
                            }
                        } else {
                            echo '<p style="font-size: 13px; color: #777;">Đang cập nhật...</p>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main> 