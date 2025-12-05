<div class="solutions-page" style="padding-bottom: 50px;">
    <div style="background: #000; padding: 40px 0; border-bottom: 1px solid #333;">
        <div class="container">
             <div class="breadcrumb" style="margin: 0;">
                <a href="index.php">Trang chủ</a> / 
                <a href="index.php?act=giai_phap">Giải pháp</a> / 
                <span style="color: #d0021b;"><?=$tieude?></span>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 40px; display: flex; gap: 40px;">
        
        <div class="news-content-wrapper" style="flex: 3;">
            <h1 class="news-title-main" style="color: #d0021b;"><?=$tieude?></h1>
            
            <div class="news-body-text">
                <?php 
                    $img_path = "img/" . $img;
                    if(is_file($img_path)) echo '<img src="'.$img_path.'" style="width:100%; margin-bottom: 20px;">';
                ?>
                
                <?=$noidung?>
            </div>
        </div>

        <div class="sol-sidebar" style="flex: 1; position: sticky; top: 20px; height: fit-content;">
            <div style="background: #111; border: 1px solid #333; padding: 25px; border-radius: 8px; text-align: center;">
                <i class="<?=$icon?>" style="font-size: 40px; color: #d0021b; margin-bottom: 15px;"></i>
                <h3 style="color: #fff; margin-bottom: 10px;">Cấu hình đề xuất</h3>
                <p style="color: #888; font-size: 13px; margin-bottom: 20px;">
                    Xem ngay các bộ PC <?=$tieude?> đã được tối ưu sẵn linh kiện.
                </p>
                <a href="index.php?act=products&iddm=<?=$iddm_sp?>" class="btn-buy-now">
                    XEM CẤU HÌNH NGAY
                </a>
            </div>
        </div>

    </div>
</div>