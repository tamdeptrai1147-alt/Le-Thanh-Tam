<div class="news-page">
    <div class="news-hero">
        <div class="hero-content container">
            <span class="news-tag">Tin Công Nghệ</span>
            
            <h1>NVIDIA GeForce RTX 4080 Super chính thức ra mắt</h1>
            
            <p>Dòng card đồ họa mới nhất với hiệu năng vượt trội, nâng tầm trải nghiệm Gaming và Đồ họa 3D.</p>
            
            <a href="index.php?act=tintuc_chitiet&id=1" class="btn-read-more">Xem bài viết</a>
        </div>
        
        <div class="hero-overlay"></div>
        
        <img src="img/highlight.jpg" alt="Highlight Banner" class="hero-bg">
    </div>

    <div class="news-category-bar container">
        <div class="news-cate-item">
            <i class="fas fa-microchip"></i>
            <span>Công nghệ</span>
        </div>
        <div class="news-cate-item">
            <i class="fas fa-desktop"></i>
            <span>Build PC</span>
        </div>
        <div class="news-cate-item">
            <i class="fas fa-tools"></i>
            <span>Mẹo PC</span>
        </div>
        <div class="news-cate-item">
            <i class="fas fa-gamepad"></i>
            <span>Game & Gear</span>
        </div>
    </div>

    <div class="container news-list-section">
        <h2 class="section-title">Mới cập nhật</h2>
        <div class="news-grid">
            
            <?php
                // Kiểm tra xem có dữ liệu tin tức không
                if(isset($dstintuc) && count($dstintuc) > 0){
                    foreach ($dstintuc as $tt) {
                        extract($tt);
                        // $tt sẽ giải nén thành các biến: $id, $tieude, $noidung, $img, $ngaydang...

                        // Xử lý đường dẫn hình ảnh
                        $hinhpath = "img/" . $img;
                        if(is_file($hinhpath)) {
                            $hinh_tag = "<img src='".$hinhpath."' alt='".$tieude."'>";
                        } else {
                            // Link ảnh mạng dự phòng nếu trong máy không có ảnh
                            $hinh_tag = "<img src='https://via.placeholder.com/300x200?text=No+Image' alt='No Image'>";
                        }

                        // Tạo link xem chi tiết (Chuẩn bị cho bước sau)
                        $link_news = "index.php?act=tintuc_chitiet&id=" . $id;
            ?>
            
            <div class="news-card">
                <div class="news-img">
                    <a href="<?php echo $link_news; ?>">
                        <?php echo $hinh_tag; ?>
                    </a>
                </div>
                <div class="news-info">
                    <span class="date"><?php echo $ngaydang; ?></span>
                    
                    <h3>
                        <a href="<?php echo $link_news; ?>"><?php echo $tieude; ?></a>
                    </h3>
                    
                    <p class="desc">
                        <?php 
                            // Nếu nội dung dài hơn 100 ký tự thì cắt bớt và thêm ...
                            if(strlen($noidung) > 100) {
                                echo substr($noidung, 0, 100) . "...";
                            } else {
                                echo $noidung;
                            }
                        ?>
                    </p>
                    
                    <a href="<?php echo $link_news; ?>" class="read-link">Đọc tiếp &rarr;</a>
                </div>
            </div>
            <?php 
                    } // Kết thúc vòng lặp foreach
                } else {
                    echo "<p style='color: white;'>Hiện chưa có bài viết nào.</p>";
                }
            ?>

        </div>
    </div>
</div>