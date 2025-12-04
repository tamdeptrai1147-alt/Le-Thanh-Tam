<?php
    if(is_array($onetintuc)){
        extract($onetintuc);
        $hinhpath = "img/" . $img;
    } else {
        // Fallback or redirection if news item not found
        header('Location: index.php?act=tintuc');
        exit();
    }
?>

<main>
    <div class="container news-detail-page" style="width: 1200px; margin: 50px auto; display: flex; gap: 30px; min-height: 500px;">
        
        <div class="main-content-news" style="flex: 3; background: #111; padding: 30px; border-radius: 10px; border: 1px solid #333;">
            <p class="news-date" style="color: #999; font-size: 13px; margin-bottom: 10px;"><i class="fa-regular fa-clock"></i> <?php echo $ngaydang; ?></p>
            
            <h1 style="font-size: 32px; color: #d0021b; margin-bottom: 20px; border-bottom: 2px solid #222; padding-bottom: 10px;"><?php echo $tieude; ?></h1>
            
            <div class="news-meta" style="font-size: 14px; color: #ccc; margin-bottom: 30px; border-left: 5px solid #d0021b; padding-left: 10px;">
                <p><?php echo substr($noidung, 0, 200); ?>...</p>
            </div>
            
            <div class="news-image" style="margin-bottom: 30px; text-align: center;">
                <?php 
                    if(is_file($hinhpath)){
                        echo "<img src='".$hinhpath."' alt='".$tieude."' style='max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 0 15px rgba(208, 2, 27, 0.2);'>";
                    }
                ?>
            </div>
            
            <div class="news-body" style="font-size: 16px; line-height: 1.8; color: #eee; text-align: justify;">
                <?php echo nl2br($noidung); // Hiển thị nội dung chi tiết ?>
            </div>
        </div>

        <div class="sidebar-news" style="flex: 1; background: #000; padding: 20px; border-radius: 10px; border: 1px solid #333;">
            <h3 style="color: #fff; border-bottom: 2px solid #d0021b; padding-bottom: 10px; margin-bottom: 20px; text-transform: uppercase; font-size: 18px;">
                Tin Tức Khác
            </h3>
            
            <div class="other-news-list">
                <?php
                    $i = 0;
                    if(isset($dstintuc) && count($dstintuc) > 0){
                        foreach ($dstintuc as $tt_other) {
                            if($tt_other['id'] != $id && $i < 5) { // Hiển thị tối đa 5 bài khác, và không phải bài đang xem
                                $link_news = "index.php?act=tintuc_chitiet&id=" . $tt_other['id'];
                                echo '
                                <div class="news-link-item" style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px dashed #333;">
                                    <a href="'.$link_news.'" style="color: #ccc; font-size: 14px; display: block;">
                                        <i class="fa-solid fa-angle-right" style="color: #d0021b; margin-right: 5px;"></i> '.$tt_other['tieude'].'
                                    </a>
                                    <span style="font-size: 11px; color: #666; display: block; margin-top: 5px; padding-left: 15px;">'.$tt_other['ngaydang'].'</span>
                                </div>';
                                $i++;
                            }
                        }
                    }
                ?>
            </div>
        </div>

    </div>
</main>