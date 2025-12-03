<div class="container-fluid">
    <h2 class="page-title">THÊM SẢN PHẨM MỚI</h2>
    
    <div class="card-box" style="display: block;">
        <div class="card" style="text-align: left; max-width: 800px; margin: 0 auto;">
            
            <?php
                if(isset($thongbao) && $thongbao != "") {
                    echo '<p style="color: #00e676; margin-bottom: 15px; font-weight: bold;"><i class="fa-solid fa-check"></i> '.$thongbao.'</p>';
                }
            ?>

            <form action="index.php?act=addsp" method="post" enctype="multipart/form-data">
                <div style="display: flex; gap: 20px;">
                    <div style="flex: 1;">
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 5px; color: #fff;">Danh mục sản phẩm</label>
                            <select name="category_id" style="width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #fff; border-radius: 4px;">
                                <?php
                                    foreach ($listdanhmuc as $dm) {
                                        extract($dm);
                                        echo '<option value="'.$id.'">'.$name.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 5px; color: #fff;">Tên sản phẩm</label>
                            <input type="text" name="name" required placeholder="Nhập tên sản phẩm..." style="width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #fff; border-radius: 4px;">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 5px; color: #fff;">Giá bán (VNĐ)</label>
                            <input type="number" name="price" required placeholder="Nhập giá..." style="width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #fff; border-radius: 4px;">
                        </div>
                    </div>

                    <div style="flex: 1;">
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 5px; color: #fff;">Hình ảnh</label>
                            <input type="file" name="img" style="width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #888; border-radius: 4px;">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 5px; color: #fff;">Mô tả chi tiết</label>
                            <textarea name="description" rows="5" style="width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #fff; border-radius: 4px;"></textarea>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 20px;">
                    <input type="submit" name="themmoi" value="THÊM MỚI" class="btn-main" style="padding: 10px 25px; font-size: 14px;">
                    <a href="index.php?act=listsp"><button type="button" class="btn-main" style="background: #555;">QUAY LẠI</button></a>
                </div>
            </form>
        </div>
    </div>
</div>