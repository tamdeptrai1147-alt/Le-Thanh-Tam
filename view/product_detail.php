<main>
    <div class="container" style="width: 1000px; margin: 50px auto; min-height: 500px; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        
        <h2 style="color: #b20000; text-align: center; margin-bottom: 30px; border-bottom: 2px solid #b20000; padding-bottom: 10px; text-transform: uppercase;">
            <?php echo $name; ?>
        </h2>

        <div class="detail-content" style="display: flex; gap: 40px;">
            
            <div class="detail-img" style="flex: 1;">
                <img src="img/<?php echo $img; ?>" alt="<?php echo $name; ?>" style="width: 100%; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
            </div>

            <div class="detail-info" style="flex: 1.5; padding-top: 10px;">
                <p style="font-size: 14px; color: #555;">Mã sản phẩm: #<?php echo $id; ?></p>
                
                <h3 style="color: #d0021b; font-size: 36px; margin: 15px 0;">
                    <?php echo number_format($price); ?> VNĐ
                </h3>
                
                <p style="margin-bottom: 20px; font-weight: bold; color: #333;">Tình trạng: <span style="color:green">Còn hàng</span></p>

                <form action="index.php?act=addtocart" method="post" style="display: flex; gap: 10px; align-items: center;">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="img" value="<?php echo $img; ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    
                    <input type="number" name="soluong" value="1" min="1" style="width: 60px; padding: 10px; text-align: center; font-weight: bold; border: 1px solid #ccc; border-radius: 4px;">

                    <button type="submit" name="addtocart" style="background: #b20000; color: white; padding: 12px 40px; border: none; font-weight: bold; border-radius: 4px; cursor: pointer; font-size: 16px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-cart-plus"></i> THÊM VÀO GIỎ
                    </button>
                </form>

                <div style="margin-top: 40px;">
                    <h4 style="border-bottom: 1px dashed #ddd; padding-bottom: 10px; margin-bottom: 15px; text-transform: uppercase;">Mô tả sản phẩm</h4>
                    <p style="color: #666; line-height: 1.6; text-align: justify;">
                        <?php echo $description; ?>
                    </p>
                </div>
            </div>
        </div>

    </div>
</main>