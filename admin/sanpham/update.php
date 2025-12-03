<?php
    if(is_array($sp)){
        extract($sp);
    }
    // Xử lý đường dẫn ảnh để hiện ảnh cũ
    $hinhpath = "../img/" . $img;
    if(is_file($hinhpath)){
        $hinh_tag = "<img src='".$hinhpath."' height='80' style='margin-top: 10px; border: 1px solid #555;'>";
    } else {
        $hinh_tag = "No photo";
    }
?>

<div class="container-fluid">
    <h2 class="page-title">CẬP NHẬT SẢN PHẨM</h2>
    
    <div class="card-box" style="display: block;">
        <div class="card" style="text-align: left; max-width: 800px; margin: 0 auto;">
            
            <form action="index.php?act=updatesp" method="post" enctype="multipart/form-data">
                <div style="display: flex; gap: 20px;">
                    <div style="flex: 1;">
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 5px; color: #fff;">Danh mục</label>
                            <select name="category_id" style="width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #fff; border-radius: 4px;">
                                <option value="0" selected>Chọn danh mục</option>
                                <?php
                                    foreach ($listdanhmuc as $dm) {
                                        // Nếu ID danh mục trùng với category_id của sản phẩm thì chọn sẵn (selected)
                                        if($dm['id'] == $category_id) $s = "selected"; else $s = "";
                                        echo '<option value="'.$dm['id'].'" '.$s.'>'.$dm['name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 5px; color: #fff;">Tên sản phẩm</label>
                            <input type="text" name="name" value="<?=$name?>" required style="width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #fff; border-radius: 4px;">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 5px; color: #fff;">Giá bán</label>
                            <input type="number" name="price" value="<?=$price?>" required style="width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #fff; border-radius: 4px;">
                        </div>
                    </div>

                    <div style="flex: 1;">
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 5px; color: #fff;">Hình ảnh</label>
                            <input type="file" name="img" style="width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #888; border-radius: 4px;">
                            <?=$hinh_tag?> </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 5px; color: #fff;">Mô tả</label>
                            <textarea name="description" rows="5" style="width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #fff; border-radius: 4px;"><?=$description?></textarea>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 20px;">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <input type="submit" name="capnhat" value="CẬP NHẬT" class="btn-main" style="padding: 10px 25px; font-size: 14px; background: #2979ff;">
                    <a href="index.php?act=listsp"><button type="button" class="btn-main" style="background: #555;">HỦY BỎ</button></a>
                </div>
            </form>
        </div>
    </div>
</div>