<div class="news-page">
    <div class="news-hero">
        <img src="img/highlight.jpg" alt="Highlight Banner" class="hero-bg">
        <div class="hero-overlay"></div>
        
        <div class="hero-content container">
            <span class="news-tag">Tin Công Nghệ</span>
            <h1>NVIDIA GeForce RTX 4080 Super chính thức ra mắt</h1>
            <p>Dòng card đồ họa mới nhất với hiệu năng vượt trội, nâng tầm trải nghiệm Gaming và Đồ họa 3D.</p>
            <a href="index.php?act=tintuc_chitiet&id=1" class="btn-read-more">Xem bài viết</a>
        </div>
    </div>

    <div class="news-category-bar">
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
            if(isset($dstintuc) && count($dstintuc) > 0){
                foreach ($dstintuc as $tt) {
                    extract($tt);
                    $hinhpath = "img/" . $img; // Sửa lại đường dẫn ảnh cho đúng thư mục
                    if(is_file($hinhpath)) {
                        $hinh_tag = '<img src="'.$hinhpath.'" alt="'.$tieude.'">';
                    } else {
                        $hinh_tag = '<img src="https://via.placeholder.com/300x200?text=No+Image" alt="No Image">';
                    }
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
                    <h3><a href="<?php echo $link_news; ?>"><?php echo $tieude; ?></a></h3>
                    <p class="desc">
                        <?php 
                            // Cắt chữ thông minh, không cắt giữa chừng từ
                            $desc_clean = strip_tags($noidung);
                            if(strlen($desc_clean) > 100) {
                                echo substr($desc_clean, 0, 100) . "...";
                            } else {
                                echo $desc_clean;
                            }
                        ?>
                    </p>
                    <a href="<?php echo $link_news; ?>" class="read-link">Đọc tiếp &rarr;</a>
                </div>
            </div>

            <?php 
                }
            } else {
                echo '<p style="color: white; text-align: center; width: 100%;">Hiện chưa có bài viết nào.</p>';
            }
            ?>
        </div>
    </div>
</div>