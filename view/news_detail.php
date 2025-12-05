<div class="news-detail-page">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">Trang chủ</a> / 
            <a href="index.php?act=tintuc">Tin tức</a> / 
            <span>Chi tiết bài viết</span>
        </div>

        <div class="news-content-wrapper">
            <h1 class="news-title-main"><?=$tieude?></h1>
            
            <div class="news-meta">
                <span><i class="fa-regular fa-calendar"></i> <?=$ngaydang?></span>
                <span><i class="fa-solid fa-eye"></i> Lượt xem: 1.2k</span> </div>

            <hr class="news-divider">

            <?php 
                $img_path = "img/" . $img;
                if(is_file($img_path)){
                    echo '<div class="news-main-image"><img src="'.$img_path.'" alt="'.$tieude.'"></div>';
                }
            ?>

            <div class="news-body-text">
                <?php echo $noidung; ?>
            </div>

            <div class="news-footer-action">
                <a href="index.php?act=tintuc" class="btn-back-news"><i class="fa-solid fa-arrow-left"></i> Quay lại tin tức</a>
            </div>
        </div>

        <div class="related-news">
            <h3>Bài viết khác</h3>
            </div>
    </div>
</div>