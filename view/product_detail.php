<main>
    <div class="container" style="width: 1200px; margin: 40px auto; background: #fff; padding: 0;">
        
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
        
        <div class="desc-zone" style="padding: 20px; border-top: 5px solid #eee; margin-top: 30px;">
            <h3 style="text-transform: uppercase; margin-bottom: 15px;">Thông số kỹ thuật & Mô tả</h3>
            <p style="line-height: 1.6; color: #333;"><?php echo $description; ?></p>
        </div>

    </div>
</main>