<div class="solutions-page">
    
    <div class="sol-banner">
        <div class="sol-overlay"></div>
        <img src="img/banner2.png" alt="Giải pháp Workstation" class="sol-bg-img">
        <div class="sol-content container">
            <span class="sol-subtitle">DRAGON CORE ENTERPRISE</span>
            <h1>GIẢI PHÁP MÁY TÍNH ĐỒ HỌA & WORKSTATION</h1>
            <p>Tối ưu hóa hiệu năng cho Kiến trúc sư, Designer, Editor và Chuyên gia AI. <br>Sự ổn định tuyệt đối - Sức mạnh xử lý vượt trội.</p>
            <a href="#list-sol" class="btn-scroll-down">KHÁM PHÁ NGAY</a>
        </div>
    </div>

    <div class="container" id="list-sol" style="padding: 60px 0;">
        <h2 class="section-title-center">DANH MỤC GIẢI PHÁP CHUYÊN DỤNG</h2>
        
        <div class="sol-grid">
            
            <?php
            // Kiểm tra xem biến $ds_giaiphap có dữ liệu không (lấy từ Controller)
            if(isset($ds_giaiphap) && is_array($ds_giaiphap) && count($ds_giaiphap) > 0){
                foreach ($ds_giaiphap as $sol) {
                    extract($sol);
                    
                    // Tạo link dẫn sang trang chi tiết bài viết (giai_phap_chitiet)
                    $link_detail = "index.php?act=giai_phap_chitiet&id=" . $id;
                    
                    // Xử lý icon: Nếu trong database không có icon thì dùng icon mặc định
                    $icon_hien_thi = ($icon != "") ? $icon : "fa-solid fa-microchip";
            ?>
            
                <div class="sol-card">
                    <div class="sol-icon">
                        <i class="<?=$icon_hien_thi?>"></i>
                    </div>
                    <h3><?=$tieude?></h3>
                    
                    <p class="sol-desc">
                        <?=$mota_ngan?>
                    </p>
                    
                    <a href="<?=$link_detail?>" class="btn-sol-detail">
                        XEM CHI TIẾT <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

            <?php 
                } // Kết thúc vòng lặp foreach
            } else {
                // Trường hợp chưa nhập dữ liệu vào Database
                echo '<p style="text-align:center; width:100%; color:#888;">Hệ thống đang cập nhật danh mục giải pháp...</p>';
            }
            ?>

        </div>
    </div>
    
    <div class="service-commit">
        <div class="container">
            <div class="commit-row">
                <div class="commit-item">
                    <i class="fa-solid fa-truck-fast"></i>
                    <h4>GIAO HÀNG SIÊU TỐC</h4>
                    <p>Miễn phí vận chuyển nội thành Hà Nội trong 2h</p>
                </div>
                <div class="commit-item">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                    <h4>BẢO HÀNH TẬN NƠI</h4>
                    <p>Xử lý sự cố phần cứng tại chỗ cho doanh nghiệp</p>
                </div>
                <div class="commit-item">
                    <i class="fa-solid fa-headset"></i>
                    <h4>HỖ TRỢ 24/7</h4>
                    <p>Team kỹ thuật support Teamviewer mọi lúc</p>
                </div>
            </div>
        </div>
    </div>

</div>