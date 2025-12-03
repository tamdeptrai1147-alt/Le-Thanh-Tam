<div class="container-fluid">
    <h2 class="page-title">THÊM DANH MỤC MỚI</h2>
    
    <div class="card-box" style="display: block;">
        <div class="card" style="text-align: left; max-width: 600px; margin: 0 auto;">
            
            <?php
                if(isset($thongbao) && $thongbao != "") {
                    echo '<p style="color: #00e676; margin-bottom: 15px; font-weight: bold;"><i class="fa-solid fa-check"></i> '.$thongbao.'</p>';
                }
            ?>

            <form action="index.php?act=adddm" method="post">
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 5px; color: #ccc;">Mã loại (Auto)</label>
                    <input type="text" disabled placeholder="Tự động sinh mã" style="width: 100%; padding: 10px; background: #333; border: 1px solid #555; color: #888; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 5px; color: #fff; font-weight: bold;">Tên danh mục</label>
                    <input type="text" name="tenloai" required placeholder="Nhập tên danh mục..." style="width: 100%; padding: 10px; background: #222; border: 1px solid #555; color: #fff; border-radius: 4px;">
                </div>

                <div>
                    <input type="submit" name="themmoi" value="THÊM MỚI" class="btn-main" style="padding: 10px 25px; font-size: 14px;">
                    <a href="index.php?act=listdm"><button type="button" class="btn-main" style="background: #555;">DANH SÁCH</button></a>
                </div>
            </form>
        </div>
    </div>
</div>