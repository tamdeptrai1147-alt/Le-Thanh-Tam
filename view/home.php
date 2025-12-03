<main>
    <div class="banner slideshow-container">
        <div class="mySlides fade" style="display:block;">
            <img src="img/banner.png" alt="Banner 1"> </div>
        <div class="mySlides fade">
            <img src="img/banner1.png" alt="Banner 2">
        </div>
        <div class="mySlides fade">
            <img src="img/banner2.png" alt="Banner 3">
        </div>
        
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

    <div class="category-section" style="margin-top: -50px; position: relative; z-index: 10;">
        <?php
            foreach($dsdm as $dm){
                extract($dm);
                $linkdm = "index.php?act=products&iddm=".$id;
                echo '
                    <div class="cate-box">
                        <a href="'.$linkdm.'">
                            <i class="fa-solid fa-layer-group"></i>
                            <p>'.$name.'</p>
                        </a>
                    </div>
                ';
            }
        ?>
    </div>

    <div class="black-zone" style="background-color: #000; width: 100%; padding: 80px 0; margin-top: 80px;">
        
        <div class="container about-row" style="display: flex; align-items: center; justify-content: center; gap: 50px; margin-bottom: 60px;">
            
            <div class="about-img" style="flex: 1;">
                <img src="img/Rectangle 63.png" alt="Về DragonCore" style="width: 100%; border-radius: 5px; box-shadow: 0 0 20px rgba(229, 9, 20, 0.3);">
            </div>

            <div class="about-content" style="flex: 1; text-align: left;">
                <h2 style="color: #fff; border-left: 5px solid #b20000; padding-left: 15px; margin-bottom: 20px; text-transform: uppercase;">
                    VỀ CHÚNG TÔI
                </h2>
                
                <div class="about-text" style="text-align: justify; line-height: 1.8; font-size: 14px; color: #ccc;">
                    <p style="margin-bottom: 15px;">
                        <strong style="color: #fff;">DragonCore</strong> - Đơn vị chuyên cung cấp các Sản phẩm và Giải pháp về hệ thống Máy Tính, Đồ Họa, Diễn Họa chuyên nghiệp, Dựng Phim - Render Video 4K - 8K cao cấp...
                    </p>
                    <p>
                        Chúng tôi cam kết vững chắc về dòng sản phẩm chất lượng cao và sự kết hợp linh kiện tối ưu. Tự hào là đơn vị dẫn đầu với những bài test đánh giá hiệu năng chân thực.
                    </p>
                </div>

                <br>
                <a href="#" class="btn-readmore" style="background: #b20000; color: #fff; padding: 10px 30px; border-radius: 30px; font-weight: bold; text-decoration: none;">Xem Hồ Sơ Năng Lực</a>
            </div>
        </div>

        <hr style="width: 80%; margin: 0 auto 50px auto; border: 0; border-top: 1px solid #333;">

        <div style="text-align: center;">
            <h2 style="margin-bottom: 30px; text-transform: uppercase; color: #fff; font-size: 24px;">
                Khám phá kho linh kiện & PC khủng
            </h2>
            
            <a href="index.php?act=products">
                <button style="background: #b20000; color: #fff; padding: 20px 80px; font-size: 18px; font-weight: bold; border: none; border-radius: 50px; cursor: pointer; box-shadow: 0 0 20px rgba(178, 0, 0, 0.6); transition: 0.3s;">
                    XEM TẤT CẢ SẢN PHẨM <i class="fa-solid fa-arrow-right"></i>
                </button>
            </a>
        </div>

    </div> 
    </main>

<script>
    let slideIndex = 1;
    showSlides(slideIndex);
    let slideTimer = setInterval(function(){ plusSlides(1) }, 3000);

    function plusSlides(n) {
        clearInterval(slideTimer);
        showSlides(slideIndex += n);
        slideTimer = setInterval(function(){ plusSlides(1) }, 3000);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        slides[slideIndex-1].style.display = "block";  
    }
</script>